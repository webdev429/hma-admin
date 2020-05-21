<?php

namespace App\Providers;

use App\Tag;
use App\Item;
use App\Role;
use App\User;
use App\Category;
use App\Make;
use App\Modeld;
use App\Truckmake;
use App\Type;
use App\Deal;
use App\Policies\TagPolicy;
use App\Policies\ItemPolicy;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\SpacificPolicy;
use App\Policies\MakePolicy;
use App\Policies\ModeldPolicy;
use App\Policies\TypePolicy;
use App\Policies\TruckmakePolicy;
use App\Policies\DealPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Category::class => CategoryPolicy::class,
        Item::class => ItemPolicy::class,
        Role::class => RolePolicy::class,
        Tag::class => TagPolicy::class,
        Make::class => MakePolicy::class,
        Modeld::class => ModeldPolicy::class,
        Specific::class => SpecificPolicy::class,
        Type::class => TypePolicy::class,
        Truckmake::class => TruckmakePolicy::class,
        Deal::class => DealPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-items', 'App\Policies\UserPolicy@manageItems');

        Gate::define('manage-users', 'App\Policies\UserPolicy@manageUsers');
        Gate::define('manage-categories', 'App\Policies\UserPolicy@manageCategories');
        Gate::define('manage-makes', 'App\Policies\UserPolicy@manageMakes');
        Gate::define('manage-modelds', 'App\Policies\UserPolicy@manageModelds');
        Gate::define('manage-specifics', 'App\Policies\UserPolicy@manageSpecifics');
        Gate::define('manage-truckmakes', 'App\Policies\UserPolicy@manageTruckmakes');
        Gate::define('manage-types', 'App\Policies\UserPolicy@manageTypes');
        Gate::define('manage-deals', 'App\Policies\UserPolicy@manageDeals');
        Gate::define('manage-auctioneers', 'App\Policies\UserPolicy@manageAuctioneers');
    }
}
