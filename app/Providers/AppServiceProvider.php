<?php

namespace App\Providers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View as FacadesView;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        FacadesView::composer('*', function ($view) {
            $user = Auth::user();
            $profileData = null;

            if ($user) {
                if ($user->admin) {
                    $profileData = $user->admin;
                } elseif ($user->pengaju) {
                    $profileData = $user->pengaju;
                }
            }

            $view->with('profileData', $profileData);
        });
    }
}
