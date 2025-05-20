<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\LogoutRepository;

class LogoutController extends Controller
{
    protected  $logoutRepo;

    public function __construct(LogoutRepository $logoutRepo)
    {
        $this->logoutRepo = $logoutRepo;
    }

    public function logout(Request $request)
    {
        $success = $this->logoutRepo->logout($request);
        return response()->json([
            'success' => $success,
            'message' => $success ? 'Logged out successfully' : 'Logout failed'
        ]);
    }
}
