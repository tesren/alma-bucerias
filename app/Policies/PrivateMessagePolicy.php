<?php

namespace App\Policies;

use App\Models\PrivateMessage;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PrivateMessagePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if($user->role == 'superadmin' or $user->role == 'admin' or $user->role == 'agent'){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PrivateMessage $privateMessage): bool
    {
        if($user->role == 'superadmin' or $user->role == 'admin' or $user->role == 'agent'){
            return true;
        }
        elseif( $user->id == $model->id ){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PrivateMessage $privateMessage): bool
    {
        if($user->role == 'superadmin'){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PrivateMessage $privateMessage): bool
    {
        if($user->role == 'superadmin'){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PrivateMessage $privateMessage): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PrivateMessage $privateMessage): bool
    {
        return false;
    }
}
