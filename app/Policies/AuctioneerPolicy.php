<?php

namespace App\Policies;

use App\Auctioneer;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AuctioneerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any auctioneers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin() || $user->isCreator();
    }

    /**
     * Determine whether the user can view the auctioneer.
     *
     * @param  \App\User  $user
     * @param  \App\Auctioneer  $auctioneer
     * @return mixed
     */
    public function view(User $user, Auctioneer $auctioneer)
    {
        return $user->isAdmin() || $user->isCreator();
    }

    /**
     * Determine whether the user can create auctioneers.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin() || $user->isCreator();
    }

    /**
     * Determine whether the user can update the auctioneer.
     *
     * @param  \App\User  $user
     * @param  \App\Auctioneer  $auctioneer
     * @return mixed
     */
    public function update(User $user, Auctioneer $auctioneer)
    {
        return $user->isAdmin() || $user->isCreator();
    }

    /**
     * Determine whether the user can delete the auctioneer.
     *
     * @param  \App\User  $user
     * @param  \App\Auctioneer  $auctioneer
     * @return mixed
     */
    public function delete(User $user, Auctioneer $auctioneer)
    {
        return $user->isAdmin() || $user->isCreator();
    }

    /**
     * Determine whether the user can restore the auctioneer.
     *
     * @param  \App\User  $user
     * @param  \App\Auctioneer  $auctioneer
     * @return mixed
     */
    public function restore(User $user, Auctioneer $auctioneer)
    {
        return $user->isAdmin() || $user->isCreator();
    }

    /**
     * Determine whether the user can permanently delete the auctioneer.
     *
     * @param  \App\User  $user
     * @param  \App\Auctioneer  $auctioneer
     * @return mixed
     */
    public function forceDelete(User $user, Auctioneer $auctioneer)
    {
        return $user->isAdmin() || $user->isCreator();
    }
}
