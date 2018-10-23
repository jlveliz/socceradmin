<?php

namespace HappyFeet\Http\Controllers\Backend\Dashboard;

use Illuminate\Http\Request;
use HappyFeet\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function showDash()
    {
    	return view('backend.dashboard.dashboard');
    }
}
