<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\LogoutRepository;
use App\Http\Requests\Api\UserTokenRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Repositories\ChangePasswordRepository;

class LogoutController extends Controller
{
    protected  $logoutRepo,$changePasswordRepo;

    public function __construct(LogoutRepository $logoutRepo)
    {
        $this->logoutRepo = $logoutRepo;
        $this->changePasswordRepo = New ChangePasswordRepository();
    }

    public function logout(Request $request)
    {
        $success = $this->logoutRepo->logout($request);
        return response()->json([
            'success' => $success,
            'message' => $success ? 'Logged out successfully' : 'Logout failed'
        ]);
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $currentPassword = $request->input('current_password');
        $newPassword = $request->input('new_password');
        if (!$this->changePasswordRepo->changePassword($currentPassword, $newPassword)) {
            return response()->json([
                'status' => false,
                'message' => 'Current password is incorrect'
            ], 400);
        }
        return response()->json([
            'status' => false,
            'message' => 'Password changed successfully'
        ], 200);

    }

    public function accountDelete(Request $request)
    {
        try {
            $request->validate([
                'reason_id' => 'required|exists:account_delete_reasons,id',
                'comment' => 'nullable|string|max:255'
            ]);
            $userId = auth()->user()->id;
            $reason = $request->input('reason_id');
            $comment = $request->input('comment');
            if ($this->logoutRepo->deleteAccount($userId, $reason,$comment)) {
                return response()->json([
                    'status' => true,
                    'message' => 'Account deleted successfully'
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Failed to delete account'
                ], 500);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
        
    }

    public function userToken(UserTokenRequest $request)
    {
        try {
            $user = auth()->user();
            $token  = $this->logoutRepo->craeteUserToken($user->id,$request->input('device_name'),$request->input('device_type'),$request->input('token'));
            return response()->json([
                'status' => true,
                'message'=> 'User token created successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }
}
