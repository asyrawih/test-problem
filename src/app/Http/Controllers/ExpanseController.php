<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExpanseController extends Controller
{
    
    public function index()
    {
        return view('expanse.expanse');
    }
}
