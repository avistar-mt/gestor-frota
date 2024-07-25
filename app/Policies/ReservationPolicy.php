<?php

namespace App\Policies;

use App\Models\User;

class ReservationPolicy
{

    public function viewAny(User $user)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->isAdmin() || $user->isAdminFrota() || $user->isGestor() || $user->isOperation();
    }


    public function manage(User $user)
    {
        return  $user->isAdmin() || $user->isAdminFrota() || $user->isGestor();
    }

    public function delete(User $user) {
        return $user->isAdmin();
    }
}
