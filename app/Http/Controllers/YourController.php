<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class YourController
{
    public function showView(): View
    {
        return view('your-view');
    }
}
