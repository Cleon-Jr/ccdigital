<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class adminLogoutController extends Controller
{
    public function adminLogout(){
        if(Session::has('userID')){
            Session::flush();

            return redirect('/admin');
        }
    }
}
