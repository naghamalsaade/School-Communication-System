<?php

namespace App\Http\Controllers\Auth\Student;

use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class AuthController extends Controller
{
    use GeneralTrait;

    public function login(Request $request)
    {
        try {
            $rules = [
                "user_name" => "required",
                "password" => "required"
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            $credentials = $request->only(['user_name', 'password']);

            if(Auth::guard('student-api')->attempt($credentials))
            {

                $student = Auth::guard('student-api')->user();
               
                $token = $student->createToken('MyApp', ['student-api'])->plainTextToken;

                if (!$token)
                    return $this->returnError('E001', 'The login information is incorrect');

                // $student->api_token = $token;

                Auth::guard('student-api')->user()->update(['fcm_token'=>$token]);
                
                // auth()->user()->update(['fcm_token'=>$token]);

                return $this->returnData('student', $student);
            }
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

        return $this->returnError('E001', 'The login information is incorrect');
      
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return $this->returnSuccessMessage('Logged out successfully');
    }
}
