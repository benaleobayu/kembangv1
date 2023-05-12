<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        
        // Gate::define('Read_Customers', function ($user) {
        //     return $user->hasPermissionTo('Read_Customers');
        // });

       Gate::after(function ($user, $ability) {
        return $user->hasRole('Admin'); // note this returns boolean
     });

    }
}
