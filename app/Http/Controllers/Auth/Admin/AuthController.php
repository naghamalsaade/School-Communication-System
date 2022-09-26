<?php

namespace App\Http\Controllers\Auth\Admin;

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
                "email" => "required|email",
                "password" => "required"
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            $credentials = $request->only(['email', 'password']);

            if(Auth::guard('admin-api')->attempt($credentials))
            {
                $student = Auth::guard('admin-api')->user();
               
                $token = $student->createToken('MyApp', ['admin-api'])->plainTextToken;

                if (!$token)
                    return $this->returnError('E001', 'The login information is incorrect');

                $student->api_token = $token;

                return $this->returnData('admin', $student);
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
