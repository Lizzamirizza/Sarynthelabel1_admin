<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Midtrans\Config as MidtransConfig;

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
        // Konfigurasi Midtrans
        MidtransConfig::$serverKey = env('MIDTRANS_SERVER_KEY');
        MidtransConfig::$isProduction = false; // TRUE kalau sudah live
        MidtransConfig::$isSanitized = true;
        MidtransConfig::$is3ds = true;
    }
}
