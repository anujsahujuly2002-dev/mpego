<?php

namespace App\Repositories\Auth;

use App\Models\ForgetPasswordToken;
use App\Models\User;
use App\Notifications\ForgetPasswordNotification;
use Illuminate\Support\Str;

class ForgetPasswordRepository {

    public function sendForgetPasswordLink($email) {

        $token = Str::random(60);
        $url = route('admin.forget.password.link',['token'=>$token]);
        $getUserDetails = User::where("email",$email)->first();
        if(is_null($getUserDetails)):
            return false;
        endif;
        $checkExsitingToken = ForgetPasswordToken::where('user_id',$getUserDetails->id)->first();
        if(!is_null($checkExsitingToken)):
            $checkExsitingToken->update([
                'token'=>$token,
                "expires_at"=>now()->addMinutes(60)
            ]);
            $getUserDetails->notify(New ForgetPasswordNotification($getUserDetails->name,$url));
            return  true;
        endif;
        ForgetPasswordToken::create([
            'user_id'=>$getUserDetails->id,
            'token'=>$token,
            "expires_at"=>now()->addMinutes(60)
        ]);
        $getUserDetails->notify(New ForgetPasswordNotification($getUserDetails->name,$url));
        return true;
    }
}
