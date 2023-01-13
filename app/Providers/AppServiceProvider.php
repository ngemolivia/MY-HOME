<?php

namespace App\Providers;

use App\interfaces\IHistorique;
use App\interfaces\ILogement;
use App\interfaces\IUser;
use App\services\HistoriqueService;
use App\services\LogementService;
use App\services\UserService;
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
        $this->app->bind(IUser::class, UserService::class);
        $this->app->bind(ILogement::class, LogementService::class);
        $this->app->bind(IHistorique::class, HistoriqueService::class);
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
}
