<?php

namespace App\Providers;
use App\Models\About;
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
    public function boot()
    {
        // Mengambil semua data About
        $abouts = About::all();

        // Membagikan data About ke seluruh view
        View::share('abouts', $abouts);
    }
}
