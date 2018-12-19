<?php

namespace HappyFeet\Http\Controllers\Backend\Dashboard;

use Illuminate\Http\Request;
use HappyFeet\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth.backend')->except('logout');
    }

    public function showDash()
    {
    	return view('backend.dashboard.dashboard');
    }
}
