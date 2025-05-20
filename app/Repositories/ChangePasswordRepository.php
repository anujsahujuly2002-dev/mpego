<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ChangePasswordRepository
{
    /**
     * Change the password for a given user.
     *
     * @param  User   $user
     * @param  string $currentPassword
     * @param  string $newPassword
     * @return bool
     */
    public function changePassword(User $user, string $currentPassword, string $newPassword): bool
    {
        if (!Hash::check($currentPassword, $user->password)) {
            return false;
        }

        return $user->update([
            'password' => Hash::make($newPassword),
        ]);
    }
}
