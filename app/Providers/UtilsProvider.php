<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class UtilsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $glob = glob(base_path('app/Utils/*.php'));
        foreach($glob as $file){
            require_once($file);
        }
    }
}
