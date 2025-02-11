<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\User;

class UserPolicy
{
    /**
     * Determine if the given user can update another user's avatar.
     */
    public function updateUser(User $authUser, User $user): bool
    {
        // Admin can update anyone's avatar
        if ($authUser->hasRole(UserRole::Admin->value)) {
            return true;
        }

        // Manager can only update staff, but not other managers or admins
        if ($authUser->hasRole(UserRole::Manager->value) && $user->hasRole(UserRole::Staff->value)) {
            return true;
        }

        // Users can only update their own avatar
        return $authUser->id === $user->id;
    }

    public function manageStaffs(User $authUser): bool
    {
        if ($authUser->hasRole([UserRole::Admin->value, UserRole::Manager->value]))
            return true;

        return false;
    }
}
