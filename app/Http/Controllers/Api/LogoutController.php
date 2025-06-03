<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Repositories\LogoutRepository;
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
}
