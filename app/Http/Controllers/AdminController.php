<?php

namespace App\Http\Controllers;

use App\Services\AdminService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(AdminService $adminService): View
    {
        $stat = $adminService->getStat();

        return view('admin.dashboard', compact('stat'));
    }
}
