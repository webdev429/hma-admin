<?php

namespace App\Policies;

use App\Deal;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DealPolicy
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
        return true;
    }

    /**
     * Determine whether the user can view the specific.
     *
     * @param  \App\User  $user
     * @param  \App\Deal  $specific
     * @return mixed
     */
    public function view(User $user, Deal $specific)
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
     * @param  \App\Deal  $specific
     * @return mixed
     */
    public function update(User $user, Deal $specific)
    {
        return $user->isAdmin() || $user->isCreator();
    }

    /**
     * Determine whether the user can delete the specific.
     *
     * @param  \App\User  $user
     * @param  \App\Deal  $specific
     * @return mixed
     */
    public function delete(User $user, Deal $specific)
    {
        return $user->isAdmin() || $user->isCreator();
    }

    /**
     * Determine whether the user can restore the specific.
     *
     * @param  \App\User  $user
     * @param  \App\Deal  $specific
     * @return mixed
     */
    public function restore(User $user, Deal $specific)
    {
        return $user->isAdmin() || $user->isCreator();
    }

    /**
     * Determine whether the user can permanently delete the specific.
     *
     * @param  \App\User  $user
     * @param  \App\Deal  $specific
     * @return mixed
     */
    public function forceDelete(User $user, Deal $specific)
    {
        return $user->isAdmin() || $user->isCreator();
    }
}
