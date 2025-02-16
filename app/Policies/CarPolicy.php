<?php

namespace App\Policies;

use App\Models\Car;
use App\Models\User;

class CarPolicy
{
    /**
     * Only admins and managers can create cars.
     */
    public function create(User $user)
    {
        return in_array($user->role, ['admin', 'manager']);
    }

    /**
     * Only admins and managers can update cars.
     */
    public function update(User $user, Car $car)
    {
        return in_array($user->role, ['admin', 'manager']);
    }

    /**
     * Only admins can delete cars.
     */
    public function delete(User $user, Car $car)
    {
        return $user->role === 'admin';
    }
}
