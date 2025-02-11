<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class p_UsersControlller extends Controller
{
    public function confirmData(Request $request){
        // dd($request);
        $user = DB::select('select * from tbemployee emp where emp.emp_cpf = ? and emp.emp_birthdate = ?', [
            $request->cpf,
            $request->birth
        ]);

        if(count($user) > 0){
            foreach($user as $item){
                $cpf = $item->emp_cpf;
                $username = $item->emp_name;
                $birth = $item->emp_birthdate;
                $mother = $item->emp_mother;
            }

            return redirect('/createpass')->with([
                'cpf' => $cpf,
                'username' => $username,
                'birth' => $birth,
                'mother' => $mother
            ]);

        }
        else{
            return back();
        }
    }



    public function viewCreatePass(){
        return view('public.createpass');
    }
}
