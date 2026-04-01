<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Post;
use App\Observers\PostObserver;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Post::observe(PostObserver::class);

        Gate::define('verify-email', function (User $user) {
            return $user->email_verified_at !== null;
        });

        RateLimiter::for('api',function(Request $request){
            return Limit::perMinute(2)->response(function(){
                return response()->json([
                    'message' => 'Too many requests. Please try again later.'
                ], 429);
            });
        });
    }
}
