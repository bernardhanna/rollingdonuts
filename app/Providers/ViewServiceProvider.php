<?php
/**
 * @Author: Bernard Hanna
 * @Date:   2023-07-04 13:00:04
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-07-04 13:05:44
 */


namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\View\Composers\Navigation;

class ViewServiceProvider extends ServiceProvider
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
        View::composer('*', Navigation::class);
    }
}
