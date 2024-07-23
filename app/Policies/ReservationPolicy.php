<?php

namespace App\Policies;

use App\Models\User;

class ReservationPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }


    public function viewAny(User $user)
    {
        return $user->isAdmin() || $user->isAdminFrota() || $user->isGestor() || $user->isOperation();
    }

    public function create(User $user)
    {
        return $user->isAdmin() || $user->isAdminFrota() || $user->isGestor() || $user->isOperation();
    }


    public function update(User $user)
    {
        return  $user->isAdmin() || $user->isAdminFrota() || $user->isGestor();
    }

    public function delete(User $user) {
        return $user->isAdmin();
    }
}
