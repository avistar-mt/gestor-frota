<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Policies\TagPolicy;
use App\Policies\UserPolicy;
use App\Policies\ItemPolicy;
use App\Policies\RolePolicy;
use App\Policies\CategoryPolicy;
use App\Policies\ReservationPolicy;
use App\Models\Tags;
use App\Models\User;
use App\Models\Item;
use App\Models\Role;
use App\Models\Category;
use App\Models\Reservation;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [

        User::class => UserPolicy::class,
        Item::class => ItemPolicy::class,
        Role::class => RolePolicy::class,
        Category::class => CategoryPolicy::class,
        Reservation::class => ReservationPolicy::class,
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

        Gate::define('manage-drivers', 'App\Policies\UserPolicy@manageDrivers');

        Gate::define('manage-role', 'App\Policies\UserPolicy@create');

        Gate::define('view-reservation', 'App\Policies\ReservationPolicy@viewAny');
        
        Gate::define('manage-reservation', 'App\Policies\ReservationPolicy@create');

        Gate::define('manage-reservation', 'App\Policies\ReservationPolicy@manage');

        Gate::define('delete-reservation', 'App\Policies\ReservationPolicy@delete');

    }
}
