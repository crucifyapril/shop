<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController
{
    public function index(): View
    {
        return view('show');
    }
}
