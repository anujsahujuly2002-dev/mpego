<?php

namespace App\Http\Controllers\Admin\Auth;

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
}
