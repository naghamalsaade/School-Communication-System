<?php

namespace App\Http\Controllers\Auth\Administrator;

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

            if(Auth::guard('administrator-api')->attempt($credentials)){

                $administrator = Auth::guard('administrator-api')->user();
               
                $token = $administrator->createToken('MyApp', ['administrator-api'])->plainTextToken;

                if (!$token)
                    return $this->returnError('E001', 'The login information is incorrect');

                Auth::guard('administrator-api')->user()->update(['fcm_token'=>$token]);
                // $administrator->api_token = $token;

                return $this->returnData('administrator', $administrator);
            }
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }

    public function logout(Request $request)
    {  
        auth()->user()->tokens()->delete();
        return $this->returnSuccessMessage('Logged out successfully');
    }
}
