<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Booking;

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
        // Berbagi data ke semua view
        View::composer('*', function ($view) {
            if (auth()->check()) {

                $unverifiedCount = User::where('role', 'user')
                                       ->where('is_active', false)
                                       ->count();

   
                $pendingBookingCount = Booking::where('status', 'pending')->count();

                $view->with([
                    'unverifiedCount' => $unverifiedCount,
                    'pendingBookingCount' => $pendingBookingCount,
                ]);
            }
        });
    }
}
