<?php

namespace App\Providers;

use App\Models\RequestService;
use App\Policies\RequestServicePolicy;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        Gate::define('is-admin', function ($user) {
            return $user->role === 'admin';
        });
        Gate::policy(RequestService::class, RequestServicePolicy::class);
    }
}
