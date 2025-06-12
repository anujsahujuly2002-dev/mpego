<?php

namespace App\Repositories;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AccountDeleteRequest;
use App\Models\UserToken;
use Illuminate\Support\Facades\Auth;

class LogoutRepository
{
    public function logout(Request $request): bool
    {
        try {
            if ($request->is('api/*')) {
                auth()->user()->token()?->revoke();
                return true;
            }
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function deleteAccount(int $userId, $reason,$comment=NULL): bool
    {
        try {
            AccountDeleteRequest::create([
                'user_id' => $userId,
                'reason_id' => $reason,
                'comment' => $comment
            ]);
           $user = User::find($userId);
            if ($user) {
                // Revoke all tokens for this user (if using Laravel Passport)
                if (method_exists($user, 'tokens')) {
                    $user->tokens()->delete();
                }
                $user->delete();
                return true;
            }
            return false;
        } catch (Exception $e) {
            return false;
        }
    }

    public function craeteUserToken($userId,$deviceName, $token, $deviceType): bool
    {
        try {
            UserToken::create([
                'user_id' => $userId,
                'device_name' => $deviceName,
                'token' =>$token,
                'device_type' => $deviceType,
            ]);  
            return false;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getAccountDeleteRequest() {
        return AccountDeleteRequest::latest()->with(['user','accountDeleteReason'])->get();
    }

    public function getDeleteAccountList(){
        return User::onlyTrashed()->latest();
            
    }

    public function deleteAccountRecover($id): bool
    {
        try {
            $user = User::withTrashed()->findOrFail($id);
            $user->restore();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
