<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class p_LoginController extends Controller
{
    public function loginUser(Request $request){
        return redirect('/contrachequedigital');
    }
}
