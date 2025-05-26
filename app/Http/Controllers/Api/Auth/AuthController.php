<?php

namespace App\Http\Controllers\Api\Auth;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthRequest;
use App\Repositories\Auth\AuthRepository;

class AuthController extends Controller
{
    private $authRepository;

    public function __construct()
    {
        $this->authRepository = new AuthRepository();
    }

    public function login(AuthRequest $request)
    {

        try{
            $user = $this->authRepository->attemptLogin($request->input('email_or_phone'), $request->input('password'));
            if ($user) {
                $token=$user->createToken('auth_token')->accessToken;
                return response()->json([
                    'status' => true,
                    'message' => 'Login successful',
                    'token' => $token,
                    'data' => $user
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
}
