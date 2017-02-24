<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        if ( Auth::user() ) {
            $view->with('user', Auth::user());
        }

        Gate::define('temper', function ($user, $file) {
            return $user->id == $file->author_id;
        });

        Gate::define('view', function ($user, $user_id) {
            return $user->id == $user_id;
        });

    }
}
