<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Auth\Access\Response;

class VehiclePolicy
{


    public function before(User $user)
    {
        if ($user->role->isAdmin()) {
            return true;
        }
    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; 
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Vehicle $vehicle): bool
    {
        if($user->role->isAdmin()){
            return true;
        }

        if($user->role->isGestor()){
            return $vehicle->branches->where('id', $user->branch_id)->exists();
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Vehicle $vehicle): bool
    {
        if($user->role->isAdmin()){
            return true;
        }

        if($user->role->isGestor()){
            return $vehicle->branches->where('id', $user->branch_id)->exists();
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Vehicle $vehicle): bool
    {
        if($user->role->isAdmin()){
            return true;
        }

        if($user->role->isGestor()){
            return $vehicle->branches->where('id', $user->branch_id)->exists();
        }

        return false;
    }
}
