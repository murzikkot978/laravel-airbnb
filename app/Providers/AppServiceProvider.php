<?php

namespace App\Providers;

use App\Models\Apartment;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('user_is_owner_apartment', function(User $user, Apartment $apartment) {
            return $user->id === $apartment->user_id || $user->role === true;
        });

        Gate::define('user_is_owner_profile', function(User $user, int $id) {
            return $user->id === $id || $user->role === true;
        });

        Gate::define('user_is_admin', function(User $user) {
            return $user->role === true;
        });
    }
}
