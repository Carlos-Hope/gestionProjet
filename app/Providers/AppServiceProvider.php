<?php

namespace App\Providers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
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
        Gate::define('isRse', function ($user) {
            return $user->role->name === 'RSE' || $user->role->name === 'DP';
        });

        Gate::define('isOwners', function ($authUser, $targetUser) {
            return $authUser->id === $targetUser->id || $authUser->role->name === 'DP';;
        });

        // Gate::define('isOwner', function ($user) {
        //     return $user->role->name === 'RSE';
        // });

        Gate::define('isRsenv', function ($user) {
            return $user->role->name === 'RSENV' || $user->role->name === 'DP';
        });

        Gate::define('isRpm', function ($user) {
            return $user->role->name === 'RPM' || $user->role->name === 'DP';
        });

        Gate::define('isRaf', function ($user) {
            return $user->role->name === 'RAF' || $user->role->name === 'DP';
        });

        Gate::define('isRai', function ($user) {
            return $user->role->name === 'RAI' || $user->role->name === 'DP';
        });

        Gate::define('isCp', function ($user) {
            return $user->role->name === 'CP' || $user->role->name === 'DP';
        });

        Gate::define('isCpt', function ($user) {
            return $user->role->name === 'CPT' || $user->role->name === 'DP';
        });

        Gate::define('isDP', function ($user) {
            return $user->role->name === 'DP';
        });

        Gate::define('nonDp', function($user){
            return $user->role->name != 'DP';
        });

        //View in dashboard
        view::composer('components.card-dashboard', function ($view) {
            $view->with('projectCount',Project::count());
            $view->with('userCount', User::count());
        });
    }
}
