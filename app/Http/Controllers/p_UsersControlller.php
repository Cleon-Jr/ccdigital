<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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
                $email = $item->emp_email;
            }

            return redirect('/createpass')->with([
                'cpf' => $cpf,
                'username' => $username,
                'birth' => Carbon::parse($birth)->format('d/m/Y'),
                'mother' => $mother,
                'email' => $email
            ]);

        }
        else{
            return back()->with('error','Não foi possível confirmar suas informações! Entre em contato com o gestor de sua instituição para mais informações.');
        }
    }



    public function viewCreatePass(){
        return view('public.createpass');
    }


    public function createAccess(Request $request){
        // dd($request);           
        
        // Capturando as informações da tela de criação de senha e criptografando a senha
        $cpf = $request->input('cpf');
        $username = $request->input('username');
        $birthdate = Carbon::parse($request->input('birthdate'))->format('Y-m-d');

        $pass = Hash::make($request->input('pass'), ['rounds' => 10]);

        $user = DB::select('select * from tbusers where use_cpf = ?', [
            $cpf
        ]);

        if(!$user){    //Se ainda não houver esse usuário, o mesmo, é adicionado
            try {
                $addUser = DB::insert('insert into tbusers values(null,?,?,?,?,?,?,?)', [
                    $cpf,
                    $username,
                    $birthdate,
                    $pass,
                    null,
                    0,
                    date('Y-m-d H:i:s')
                ]);

                return redirect()->back()->with('success', 'Credencial de acesso foi criada com sucesso!');
            } catch (Exception $ex) {
                Log::error('OCORREU UMA EXCEÇÃO AO EXECUTAR O [ADDUSER]! '.$ex->getMessage());
                return redirect()->back()->with('error','Não foi possível criar o seu acesso!');
            }
        }
        else{
            return back()->with('error','O CPF informado já foi cadastrado no Sistema! Tente recuperar seu acesso.');
        }


    }
}
