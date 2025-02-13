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

    public function deleteStaff(User $authUser, User $user): bool
    {
        // Admin can delete any user except themselves
        if ($authUser->role === UserRole::Admin->value) {
            return $authUser->id !== $user->id;
        }

        // Manager can only delete staff, but not themselves
        if ($authUser->role === UserRole::Manager->value && $user->role === UserRole::Staff->value) {
            return $authUser->id !== $user->id;
        }

        // Other roles cannot delete users
        return false;
    }
}
