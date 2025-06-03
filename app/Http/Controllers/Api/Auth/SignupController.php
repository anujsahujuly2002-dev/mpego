<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResendOTPRequest;
use App\Http\Requests\Auth\UserStoreRequest;
use App\Http\Requests\Auth\VerifyOtpRequest;
use App\Repositories\Auth\SignUpRepository;
use App\Repositories\Upload\UploadImageRepository;
use Exception;
use Illuminate\Http\Request;

class SignupController extends Controller
{
    private $signUpRepository ;

    public function __construct()
    {
        $this->signUpRepository = New SignUpRepository;
    }

    public function signUp(UserStoreRequest $request) {
       try{
            $user = $this->signUpRepository->signUp($request->all());
            if(!empty($request->file('image'))):
                $directory = "upload/user-image/".$user->id;
                foreach($request->file('image') as $file):
                    $imageUpload = New UploadImageRepository($file,$directory);
                    $fileName = $imageUpload->upload();
                    $data = [
                        'user_id'=>$user->id,
                        'image'=>$fileName
                    ];
                    $this->signUpRepository->storeUserImage($data);
                endforeach;
            endif;
            if( $user):
                return response()->json([
                    'status'=>true,
                    'message'=>"User information store succssfully",
                ],200);
            else:
                return response()->json([
                    'status'=>true,
                    'message'=>"User information not store, Please try again",
                ],500);
            endif;
       }catch(Exception $e) {
            return response()->json([
                'status'=>false,
                'message'=>$e->getMessage()
            ],500);
       }
    }

    public function verifyOtp(VerifyOtpRequest $request){
        try{
            $result = $this->signUpRepository->verifyOTP($request->input('otp'));
            if (!$result['status']) {
                return response()->json([
                    'status' => false,
                    'message' => $result['message']
                ], 400);
            }
            return response()->json([
                'status' => true,
                'message' => $result['message'],
                'data' => $result['data']
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>$e->getMessage()
            ],500);
        }
    }

    public function resendOTP(ResendOTPRequest $request) {
        try{
            $result = $this->signUpRepository->resendOTP($request->input('email'));
            if (!$result) {
                return response()->json([
                    'status' => false,
                    'message' => "Unable to send OTP. Kindly try again."
                ], 400);
            }
            return response()->json([
                'status' => true,
                'message' => "Your OTP has been sent successfully.",
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>$e->getMessage()
            ],500);
        }
    }
}
