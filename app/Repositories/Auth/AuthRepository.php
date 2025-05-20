<?php

namespace App\Repositories\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthRepository
{
    public function attemptLogin(string $identifier, string $password): ?User
    {
        $user = User::where(function ($query) use ($identifier) {
            $query->where('email', $identifier)
                  ->orWhere('phone', $identifier);
        })->first();
        return ($user && Hash::check($password, $user->password)) ? $user : null;
    }

}
