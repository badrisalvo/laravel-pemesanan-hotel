<?php

namespace App\Providers;
use App\Models\About;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        if (Schema::hasTable('abouts')) {
            // Mengambil semua data About hanya jika tabel ada
            $abouts = About::all();
    
            // Membagikan data About ke seluruh view
            View::share('abouts', $abouts);
        }
    }
}
