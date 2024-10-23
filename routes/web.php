<?php

use App\Http\Controllers\MainController;

Route::get('/route', [MainController::class, 'method']);
