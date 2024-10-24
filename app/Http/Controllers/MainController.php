<?php

namespace App\Http\Controllers;
use Illuminate\View\View;

use Illuminate\Http\Request;

class MainController
{
    public function index(): View
    {
        return view('index');
    }
}
