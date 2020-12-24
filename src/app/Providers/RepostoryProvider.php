<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Repostory\Income\RepoIncome;

class RepostoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * REGISTER SERVICE PROVIDER / CONTAINER 
         * Berikan Concrate dalam hal ini Interface
         * Ketika Interface nya di bind 
         * Maka Buat instance RepoIncome
         */
        $this->app->bind(
            \Repostory\Contaract\IncomeContract::class,
            \Repostory\Income\RepoIncome::class,
            function () {
                return new RepoIncome();
            }
        );
    }
}
