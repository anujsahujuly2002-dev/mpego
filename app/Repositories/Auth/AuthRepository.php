<?php

namespace App\Repositories\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthRepository
{
    /**
     * Attempt login using email or phone
     *
     * @param string $identifier
     * @param string $password
     * @param bool $loginAsSession (true = web login, false = API token-based logic)
     * @return User|null
     */
    public function attemptLogin(string $identifier, string $password, bool $loginAsSession = false): ?User
    {
        $user = User::where(function ($query) use ($identifier) {
            $query->where('email', $identifier)->orWhere('phone', $identifier);
        })->first();
        if ($user && Hash::check($password, $user->password)) {
            if ($loginAsSession) {
                Auth::login($user); // This creates a session for web users
            }
            return $user;
        }

        return null;
    }
}
