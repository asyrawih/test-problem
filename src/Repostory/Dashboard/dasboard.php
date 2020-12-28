<?php

namespace Repostory\Dashboard;

use App\Models\Expanse;
use App\Models\Income;
use App\Models\User;

class Dashboard
{
    public function getAllUser()
    {
        $user = User::all()->count();
        return $user;
    }

    public function getTotalExpanse()
    {
        $expanse = Expanse::query()
            ->pluck('total')
            ->sum();
        return $expanse;
    }

    public function getTotalIncome()
    {
        $income = Income::query()
            ->pluck('total')
            ->sum();
        return $income;
    }
}
