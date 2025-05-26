<?php

namespace App\Repositories;

use Illuminate\Http\Request;
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
        } catch (\Exception $e) {
            return false;
        }
    }
}
