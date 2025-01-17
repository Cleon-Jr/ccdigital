<?php

namespace App\Http\Controllers;

use App\Http\Requests\adminLoginRequest;
use App\Models\adminModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class adminLoginController extends Controller
{
    public function viewLogin(){
        return view('admin.login');
    }


    public function login(adminLoginRequest $request){
        $email = trim($request->input('login'));
        $pass = trim($request->input('pass'));

        $request->validated();

        $userConfirm = adminModel::where('adm_email', $email)->first();

        if($userConfirm && Hash::check($pass, $userConfirm->adm_pass)){
            Session::put('userID', $userConfirm->adm_id);

            $institution = DB::select('select * from tbinstitution limit 1');
            if($institution){
                $cnpj = $institution[0];
                Session::put('cnpjSession', $cnpj->inst_cnpj);
            }
            else{
                Session::put('cnpjSession', 0);
            }

            return back()->with('login-success', 'Seja bem vindo(a), '.$userConfirm->adm_name.'!');
        }
        else{
            return back()->with('login-error', 'Login inválido!')->withInput();
        }

    }




}
