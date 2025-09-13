<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;
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
        // cache 
        $categories = Cache::remember('categories', 60*60*24, function() {
            return Category::all();
        });
        View::share('categories', $categories);
        Paginator::useBootstrapFive(); // For Bootstrap 5
        // Paginator::useBootstrapFour(); // For Bootstrap 4
    }
}
