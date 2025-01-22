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
            if($request->id == null){
                dd($request->id);
                try {
                    $pass = Hash::make($request->pass, ['rounds' => 10]);

                    $admin = DB::insert('insert into tbadmins values(null,?,?,?,?,?,?,?)', [
                        preg_replace('/[^a-zA-Z0-9]/','',$request->cpf),
                        $request->fullname,
                        $request->email,
                        $pass,
                        null,
                        0,
                        date('Y-m-d H:i:s')
                    ]);

                    return back()->with('success', 'Administrador adicionado com sucesso!');

                } catch (Exception $ex) {
                    // Log
                    Log::error('OCORREU UMA EXCEÇÃO AO EXECUTAR O [CADASTRO DE ADMIN]! '.$ex->getMessage(),[
                        'exception' => $ex
                    ]);

                    return back()->with('error', 'Não foi possível adicionar o administrador!');
                }
            }
            else{
                try {
                    $pass = Hash::make($request->pass, ['rounds' => 10]);

                    $admin = DB::update('update tbadmins set adm_cpf = ?, adm_name = ?, adm_email = ?, adm_pass = ?, adm_date = ? where adm_id = ?', [
                        preg_replace('/[^a-zA-Z0-9]/','',$request->cpf),
                        $request->fullname,
                        $request->email,
                        $pass,
                        date('Y-m-d H:i:s'),
                        $request->id
                    ]);

                    return back()->with('success', 'Alterações salvas com sucesso!');

                } catch (Exception $ex) {
                    // Log
                    Log::error('OCORREU UMA EXCEÇÃO AO EXECUTAR O [EDITAR DE ADMIN]! '.$ex->getMessage(),[
                        'exception' => $ex
                    ]);

                    return back()->with('error', 'Não foi possível salvar as alterações!');
                }
            }

        }
        else{
            return back()->with('error','Este E-mail já existe!')->withInput();
        }
    }




    public function viewUserList(){
        $adminUsers = adminModel::orderBy('adm_name', 'asc')->paginate(12);
        $amountUsers = count($adminUsers);

        return view('admin.griduser', [
            'adminUser' => $adminUsers,
            'qnt' => $amountUsers
        ]);
    }



    public function viewFormAdmin($id){
        $adminUser = DB::select('select * from tbadmins where adm_id = ?', [
            $id
        ]);
        if($adminUser){
            foreach($adminUser as $item){
                $id = $item->adm_id;
                $cpf = $item->adm_cpf;
                $name = $item->adm_name;
                $email = $item->adm_email;
            }

            return view('admin.frmadmin', [
                'id' => $id,
                'cpf' => $cpf,
                'name' => $name,
                'email' => $email
            ]);
        }
        else{
            return view('admin.frmadmin');
        }
    }



    public function searchAdmin(Request $request){
        $adminUsers = adminModel::where('adm_cpf', $request->search)
        ->orWhere('adm_name', 'like', '%'.$request->search.'%')
        ->orWhere('adm_email', 'like', '%'.$request->search.'%')
        ->orderBy('adm_name', 'asc')->paginate(12);

        $qnt = count($adminUsers);
        if(count($adminUsers) > 0){
            return view('admin.griduser', [
                'adminUser' => $adminUsers,
                'qnt' => $qnt
            ]);
        }
        else{
            return back()->with('attention','Registro não encontrado!');
        }
    }


    public function viewAdmin($id){
        $adminUser = DB::select('select * from tbadmins where adm_id = ?', [
            $id
        ]);
        if($adminUser){
            foreach($adminUser as $item){
                $id = $item->adm_id;
                $cpf = $item->adm_cpf;
                $name = $item->adm_name;
                $email = $item->adm_email;
                $lastAccess = $item->adm_last_access;
                $date = $item->adm_date;
            }

            return view('admin.viewadmin',[
                'id' => $id,
                'cpf' => $cpf,
                'name' => $name,
                'email' => $email,
                'lastAccess' => $lastAccess,
                'date' => $date
            ]);
        }
    }



    public function delAdmin($id){
        // dd($id);
        try {
            $admin = DB::delete('delete from tbadmins where adm_id = ?', [
                $id
            ]);

            return redirect('/admin/userlist')->with('success', 'Usuário excluído com sucesso!');

        } catch (Exception $ex) {
            Log::error('HOUVE UMA EXCEÇÃO AO TENTAR EXCLUIR O ADMIN! '.$ex->getMessage());

            return back()->with('error', 'Não foi possível excluir este usuário!');
        }

    }



}
