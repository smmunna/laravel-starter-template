<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //admin dashboard
    public function adminDashboard()
    {
        return view('pages.admin.dashboard.dashboard');
    }
    //user dashboard
    public function userDashboard()
    {
        return view('pages.users.dashboard.dashboard');
    }
}
