<?php

namespace App\Http\Controllers\Admin\Auth;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthRequest;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Repositories\Auth\AuthRepository;
use App\Repositories\Auth\ForgetPasswordRepository;

class AuthController extends Controller
{
    private $authRepository,$forgetPasswordRepository;

    public function __construct()
    {
        $this->authRepository = new AuthRepository();
        $this->forgetPasswordRepository = New ForgetPasswordRepository();
    }

    public function login() {
        return view('admin.auth.login');
    }

     public function doLogin(AuthRequest $request){
         try{
            $user = $this->authRepository->attemptLogin($request->input('email_or_phone'), $request->input('password'),true);
            if ($user) {
                return response()->json([
                    'status' => true,
                    'message' => 'You’re now logged in',
                    'url'=>route('admin.dashboard')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid credentials'
                ], 401);
            }
        }catch(Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function forgetPasswordResetLink(Request $request) {
        $token = $request->input('token');
        return view('admin.auth.forget-password',compact('token'));
    }

    public function changePassword(ChangePasswordRequest $request) {
        $checkValidToken =$this->forgetPasswordRepository->checkTokenValid($request->input('token'));
        if(!$checkValidToken):
            return response()->json([
                'status'=>false,
                "message"=>"Your token is invalid. Please resend the link."
            ],500);
        endif;
        // dd(now(),$checkValidToken->expires_at);
        if(now() >=$checkValidToken->expires_at):
            return response()->json([
                'status'=>false,
                "message"=>"Your token has been expired. Please resend the link."
            ],500);
        endif;

        if($this->forgetPasswordRepository->changePassword($checkValidToken->user_id,$request->input("new_password"))):
            return response()->json([
                'status'=>true,
                "message"=>"Your password has been changed successfully.",
                'url'=>route('admin.forget.password.link')
            ],200);
        else:
            return response()->json([
                'status'=>false,
                "message"=>"Your password could not be changed. Please try again."
            ],500);
        endif;

    }
}
