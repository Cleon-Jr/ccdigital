<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class p_DashboardController extends Controller
{
    public function viewMain(){
        return view('public.main');
    }

    public function viewDashboard(){
        return view('public.dashboard');
    }
}
