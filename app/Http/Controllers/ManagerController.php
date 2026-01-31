<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function ManagerDashboard()
    {
        return view('backend.manager_dashboard');
    }
}
