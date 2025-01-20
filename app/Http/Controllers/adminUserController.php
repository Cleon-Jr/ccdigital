<?php

namespace App\Http\Controllers;

use App\Http\Requests\adminUserRequest;
use App\Models\adminModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class adminUserController extends Controller
{
    public function addUser(adminUserRequest $request){
        // dd($request);
        $emailConfirm = DB::select('select * from tbadmins where adm_email = ?', [
            $request->email
        ]);

        $request->validated();

        if(!$emailConfirm){
            try {
                $pass = Hash::make($request->pass, ['rounds' => 10]);

                $admin = DB::insert('insert into tbadmins values(null,?,?,?,?,?,?,?)', [
                    $request->cpf,
                    $request->fullname,
                    $request->email,
                    $pass,
                    null,
                    null,
                    date('Y-m-d H:i:s')
                ]);

                return redirect('/admin')->with('success', 'Administrador adicionado com sucesso!');

            } catch (Exception $ex) {
                // Log
                Log::error('OCORREU UMA EXCEÇÃO AO EXECUTAR O [CADASTRO DE ADMIN]! '.$ex->getMessage(),[
                    'exception' => $ex
                ]);

                return redirect('/admin')->with('error', 'Não foi possível adicionar o administrador!');
            }
        }
        else{
            return back()->with('error','Este E-mail já existe!')->withInput();
        }
    }



    public function viewUserList(){
        $adminUsers = adminModel::paginate(12);

        return view('admin.griduser', ['adminUser' => $adminUsers]);
    }



    public function viewFormAdmin(){
        return view('admin.frmadmin');
    }


}
