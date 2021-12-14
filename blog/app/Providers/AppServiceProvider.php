<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // for using bootstrap paginator, add, use Illuminate\Pagination\Paginator;
        // tailwind default, no action required for using it
        // Paginator::useBootstrap();

        Gate::define('admin', function(User $user)
        {
            return $user->username === 'nasif_ahmed';
        });
    }
}
