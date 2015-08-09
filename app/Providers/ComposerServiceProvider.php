<?php

namespace App\Providers;

use Auth;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // view()->composer(
        //     'navbar', 'App\Http\ViewComposers\NavbarComposer'
        // );

        view()->composer([
            'layouts.navigation'
        ], function($view){
            $view->with('user', auth()->user());
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
