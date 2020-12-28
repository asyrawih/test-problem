<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Repostory\Contaract\ExpanseContract;
use Repostory\Contaract\IncomeContract;
use Repostory\Expanse\RepoExpanse;
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
        $this->app->bind(ExpanseContract::class, RepoExpanse::class);
        $this->app->bind(IncomeContract::class, RepoIncome::class);
    }
}
