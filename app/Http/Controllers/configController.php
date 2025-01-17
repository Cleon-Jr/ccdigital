<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class configController extends Controller
{
    public function configInit(){

        $admin = DB::select('select * from tbadmins');

        if(count($admin) <= 0){
            $pass = Hash::make('11460137@tread', ['rounds' => 10]);

            $admin = DB::insert('insert nto tbadmins values(null,?,?,?,?,?,?,?',[
                null,
                'Administrador',
                'infortread.am@gmail.com',
                $pass,
                null,
                0,
                date('Y:m:d')
            ]);

            return redirect('/admin')->with('success','Acesso básico realizado com sucesso. Realize o Login e complete outras configurações!');
        }
        else{
            return redirect('/admin')->with('error', 'Não há necessidade de configurações de acesso básico!');
        }

    }
}
