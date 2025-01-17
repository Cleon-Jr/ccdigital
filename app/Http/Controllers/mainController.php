<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class mainController extends Controller
{
    public function viewMain(){
            $userInfo = DB::select('select * from tbadmins where adm_id = ?', [
                Session::get('userID')
            ]);

            if(Session::has('cnpjSession') !== 0){
                $institution = DB::select('select * from tbinstitution limit 1');
                if($institution){
                    $item = $institution[0];
                    $cnpj = $item->inst_cnpj;
                    $descriptionInstitution = $item->inst_description;
                }
                else{
                    $cnpj = '';
                    $descriptionInstitution = '';
                }

            }


            return view('admin.main', [
                'userInfo' => $userInfo,
                'cnpj' => $cnpj,
                'description' => $descriptionInstitution
            ]);
    }

}


