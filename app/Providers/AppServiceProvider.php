<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use App\Observers\PostObserver;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use App\Policies\PostPolicy;
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
        // Bootstarping any application services.
        Paginator::useBootstrapFive();

        

        Post::observe(PostObserver::class);
        Gate::policy(Post::class, PostPolicy::class);

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
