<?php

namespace App\Http\Controllers;

use Repostory\Contaract\IncomeContract;

class FinanceController extends Controller
{
    protected $finance;

    public function __construct(IncomeContract $finance)
    {
        $this->finance = $finance;
    }

    public function index()
    {
        $finance = $this->finance->all();
        return view('finance.finance', ['finances' => $finance]);
    }
}
