<?php

namespace App\Policies;

use App\Specific;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SpecificPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any specifics.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin() || $user->isCreator();
    }

    /**
     * Determine whether the user can view the specific.
     *
     * @param  \App\User  $user
     * @param  \App\Specific  $specific
     * @return mixed
     */
    public function view(User $user, Specific $specific)
    {
        return $user->isAdmin() || $user->isCreator();
    }

    /**
     * Determine whether the user can create specifics.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin() || $user->isCreator();
    }

    /**
     * Determine whether the user can update the specific.
     *
     * @param  \App\User  $user
     * @param  \App\Specific  $specific
     * @return mixed
     */
    public function update(User $user, Specific $specific)
    {
        return $user->isAdmin() || $user->isCreator();
    }

    /**
     * Determine whether the user can delete the specific.
     *
     * @param  \App\User  $user
     * @param  \App\Specific  $specific
     * @return mixed
     */
    public function delete(User $user, Specific $specific)
    {
        return $user->isAdmin() || $user->isCreator();
    }

    /**
     * Determine whether the user can restore the specific.
     *
     * @param  \App\User  $user
     * @param  \App\Specific  $specific
     * @return mixed
     */
    public function restore(User $user, Specific $specific)
    {
        return $user->isAdmin() || $user->isCreator();
    }

    /**
     * Determine whether the user can permanently delete the specific.
     *
     * @param  \App\User  $user
     * @param  \App\Specific  $specific
     * @return mixed
     */
    public function forceDelete(User $user, Specific $specific)
    {
        return $user->isAdmin() || $user->isCreator();
    }
}
