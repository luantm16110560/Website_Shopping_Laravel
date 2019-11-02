<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Type_Product;
class AppServiceProvider extends ServiceProvider
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
        //
        view()->composer('header',function($view){
            $loai_sp = Type_Product::all();
            $view->with('loai_sp',$loai_sp);
        });
    }
}
