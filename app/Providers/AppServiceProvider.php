<?php

namespace App\Providers;

use Inertia\Inertia;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->shareLanguage();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public function shareLanguage(){
        Inertia::share([
            // ...
            'locale' => function () {
                return App::getLocale();
            },
            'language' => function () {
                return translations(
                    app_path('../lang/'. App::getLocale() .'.json')
                );
            },
            // ...
        ]);
    }

}
