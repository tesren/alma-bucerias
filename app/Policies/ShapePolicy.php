<?php

namespace App\Policies;

use App\Models\Shape;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShapePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        if($user->role == 'superadmin' or $user->role == 'admin'){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Shape  $shape
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Shape $shape)
    {
        if($user->role == 'superadmin' or $user->role == 'admin'){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        if($user->role == 'superadmin' or $user->role == 'admin'){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Shape  $shape
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Shape $shape)
    {
        if($user->role == 'superadmin' or $user->role == 'admin'){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Shape  $shape
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Shape $shape)
    {
        if($user->role == 'superadmin' or $user->role == 'admin'){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Shape  $shape
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Shape $shape)
    {
        
        return true;
        
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Shape  $shape
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Shape $shape)
    {
        //
    }
}
