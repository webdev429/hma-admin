<?php

namespace App\Policies;

use App\Truckmake;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TruckmakePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any truckmakes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin() || $user->isCreator();
    }

    /**
     * Determine whether the user can view the truckmake.
     *
     * @param  \App\User  $user
     * @param  \App\Truckmake  $truckmake
     * @return mixed
     */
    public function view(User $user, Truckmake $truckmake)
    {
        return $user->isAdmin() || $user->isCreator();
    }

    /**
     * Determine whether the user can create truckmakes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin() || $user->isCreator();
    }

    /**
     * Determine whether the user can update the truckmake.
     *
     * @param  \App\User  $user
     * @param  \App\Truckmake  $truckmake
     * @return mixed
     */
    public function update(User $user, Truckmake $truckmake)
    {
        return $user->isAdmin() || $user->isCreator();
    }

    /**
     * Determine whether the user can delete the truckmake.
     *
     * @param  \App\User  $user
     * @param  \App\Truckmake  $truckmake
     * @return mixed
     */
    public function delete(User $user, Truckmake $truckmake)
    {
        return $user->isAdmin() || $user->isCreator();
    }

    /**
     * Determine whether the user can restore the truckmake.
     *
     * @param  \App\User  $user
     * @param  \App\Truckmake  $truckmake
     * @return mixed
     */
    public function restore(User $user, Truckmake $truckmake)
    {
        return $user->isAdmin() || $user->isCreator();
    }

    /**
     * Determine whether the user can permanently delete the truckmake.
     *
     * @param  \App\User  $user
     * @param  \App\Truckmake  $truckmake
     * @return mixed
     */
    public function forceDelete(User $user, Truckmake $truckmake)
    {
        return $user->isAdmin() || $user->isCreator();
    }
}
