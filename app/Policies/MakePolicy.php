<?php

namespace App\Policies;

use App\Make;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MakePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any makes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin() || $user->isCreator();
    }

    /**
     * Determine whether the user can view the make.
     *
     * @param  \App\User  $user
     * @param  \App\Make  $make
     * @return mixed
     */
    public function view(User $user, Make $make)
    {
        return $user->isAdmin() || $user->isCreator();
    }

    /**
     * Determine whether the user can create makes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin() || $user->isCreator();
    }

    /**
     * Determine whether the user can update the make.
     *
     * @param  \App\User  $user
     * @param  \App\Make  $make
     * @return mixed
     */
    public function update(User $user, Make $make)
    {
        return $user->isAdmin() || $user->isCreator();
    }

    /**
     * Determine whether the user can delete the make.
     *
     * @param  \App\User  $user
     * @param  \App\Make  $make
     * @return mixed
     */
    public function delete(User $user, Make $make)
    {
        return $user->isAdmin() || $user->isCreator();
    }

    /**
     * Determine whether the user can restore the make.
     *
     * @param  \App\User  $user
     * @param  \App\Make  $make
     * @return mixed
     */
    public function restore(User $user, Make $make)
    {
        return $user->isAdmin() || $user->isCreator();
    }

    /**
     * Determine whether the user can permanently delete the make.
     *
     * @param  \App\User  $user
     * @param  \App\Make  $make
     * @return mixed
     */
    public function forceDelete(User $user, Make $make)
    {
        return $user->isAdmin() || $user->isCreator();
    }
}
