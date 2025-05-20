<?php

namespace App\Repositories\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Models\UserImage;
use App\Models\UserOtp;
use GuzzleHttp\Psr7\Message;
use App\Notifications\OTPNotification;

class SignUpRepository {
    protected $user;
    public  function signUp ($data) {
        $this->user = User::create($data);
        if($this->user):
            $this->sendOtpViaEmail($this->user);
            return $this->user;
        else:
            return false;
        endif;
    }

    private function sendOtpViaEmail($user)
    {
        $otpRecord = UserOtp::where('user_id', $user->id)->first();
        $otpLifetime = 10; // minutes

        if ($otpRecord && Carbon::parse($otpRecord->expires_at)->isFuture()) {
            $otp = $otpRecord->otp;
        } else {
            $otp = random_int(11111, 99999);
            UserOtp::updateOrCreate(['user_id' => $user->id],  ['user_id'=> $user->id,'otp' => $otp,'expires_at' => now()->addMinutes($otpLifetime)]);
        }
        $user->notify(new OTPNotification($otp));
        return true;
    }

    public function verifyOTP($otp) {
        $otpRecord = UserOtp::where('otp', $otp)->with('user')->first();
        if (!$otpRecord || !Carbon::parse($otpRecord->expires_at)->isFuture()) {
            return [
                'status' => false,
                'message' => "The one-time password you entered has expired or is invalid. Please request a new OTP to proceed.",
            ];
        }
        return [
            'status' => true,
            'message' => "OTP verified successfully.",
            'data' => $otpRecord->user
        ];
    }


    public function resendOTP($email) {
        $user = User::where('email',$email)->first();
        if($user):
            $this->sendOtpViaEmail($user);
            return true;
        else:
            return false;
        endif;
    }

    public function storeUserImage($data) {
        return  UserImage::create($data);
    }

}
