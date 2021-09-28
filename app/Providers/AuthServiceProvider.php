<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


        Gate::define('isAdmin', function($user) {
            return $user->role == 'admin';
        });
    
        // define user role
        Gate::define('isManagement', function($user) {
            return $user->role == 'management';
        });
        
        Gate::define('isSquad', function($user) {
            return $user->role == 'squad';
        });
    }
}
