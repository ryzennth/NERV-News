<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            // API Routes
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // Public Routes (no auth required)
            Route::middleware('web')
                ->group(base_path('routes/web/public.php'));

            // Authenticated User Routes
            Route::middleware(['web', 'auth', 'verified'])
                ->group(base_path('routes/web/auth.php'));

            // Writer Routes
            Route::middleware(['web', 'auth', 'verified', 'profile.complete', 'role:writer|moderator|admin|super-admin'])
                ->prefix('writer')
                ->name('writer.')
                ->group(base_path('routes/web/writer.php'));

            // Moderator Routes  
            Route::middleware(['web', 'auth', 'verified', 'profile.complete', 'permission:moderate-content'])
                ->prefix('moderator')
                ->name('moderator.')
                ->group(base_path('routes/web/moderator.php'));

            // Admin Routes
            Route::middleware(['web', 'auth', 'verified', 'profile.complete', 'permission:manage-writers'])
                ->prefix('admin')
                ->name('admin.')
                ->group(base_path('routes/web/admin.php'));

            // Super Admin Routes
            Route::middleware(['web', 'auth', 'verified', 'profile.complete', 'role:super-admin'])
                ->prefix('super-admin')
                ->name('super-admin.')
                ->group(base_path('routes/web/super-admin.php'));

            // Main Web Routes (fallback & auth)
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}