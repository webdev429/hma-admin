<?php

namespace App\Policies;

use App\Modeld;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModeldPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any modelds.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin() || $user->isCreator();
    }

    /**
     * Determine whether the user can view the modeld.
     *
     * @param  \App\User  $user
     * @param  \App\Modeld  $modeld
     * @return mixed
     */
    public function view(User $user, Modeld $modeld)
    {
        return $user->isAdmin() || $user->isCreator();
    }

    /**
     * Determine whether the user can create modelds.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin() || $user->isCreator();
    }

    /**
     * Determine whether the user can update the modeld.
     *
     * @param  \App\User  $user
     * @param  \App\Modeld  $modeld
     * @return mixed
     */
    public function update(User $user, Modeld $modeld)
    {
        return $user->isAdmin() || $user->isCreator();
    }

    /**
     * Determine whether the user can delete the modeld.
     *
     * @param  \App\User  $user
     * @param  \App\Modeld  $modeld
     * @return mixed
     */
    public function delete(User $user, Modeld $modeld)
    {
        return $user->isAdmin() || $user->isCreator();
    }

    /**
     * Determine whether the user can restore the modeld.
     *
     * @param  \App\User  $user
     * @param  \App\Modeld  $modeld
     * @return mixed
     */
    public function restore(User $user, Modeld $modeld)
    {
        return $user->isAdmin() || $user->isCreator();
    }

    /**
     * Determine whether the user can permanently delete the modeld.
     *
     * @param  \App\User  $user
     * @param  \App\Modeld  $modeld
     * @return mixed
     */
    public function forceDelete(User $user, Modeld $modeld)
    {
        return $user->isAdmin() || $user->isCreator();
    }
}
