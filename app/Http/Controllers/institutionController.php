<?php

namespace App\Http\Controllers;

use App\Http\Requests\adminInstitutionRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class institutionController extends Controller
{
    public function viewInstitution(){
        $institution = DB::select('select * from tbinstitution limit 1');
            if($institution){
                $item = $institution[0];

                $id = $item->inst_id;
                $cnpj = $item->inst_cnpj;
                $desc = $item->inst_description;
                $address = $item->inst_address;
                $number = $item->inst_number;
                $district = $item->inst_district;
                $cep = $item->inst_cep;
                $uf = $item->inst_uf;
                $city = $item->inst_city;
                $tel1 = $item->inst_tel1;
                $tel2 = $item->inst_tel2;
                $email = $item->inst_email;
                $logo = $item->inst_logo;
            }

        return view('admin.institution', [
            'id' => $id,
            'cnpj' => $cnpj,
            'desc' => $desc,
            'address' => $address,
            'number' => $number,
            'district' => $district,
            'cep' => $cep,
            'uf' => $uf,
            'city' => $city,
            'tel1' => $tel1,
            'tel2' => $tel2,
            'email' => $email,
            'logo' => $logo
        ]);
    }


    public function saveInstitution(adminInstitutionRequest $request){ //Adição de gestão via formulário

        $inst = DB::select('select * from tbinstitution limit 1');

        if(!$inst){                                 // Se não houvr registro, insert...
            try {
                $request->validated();
                // dd($request);
                if($request->hasFile('logo')){
                    $filename = time().'.'.$request->logo->extension();
                    $request->logo->move(public_path('images'), $filename);
                }
                $inst = DB::insert('insert into tbinstitution values(null,?,?,?,?,?,?,?,?,?,?,?,?,?)', [
                    strtoupper($request->cnpj),
                    strtoupper($request->description),
                    strtoupper($request->address),
                    strtoupper($request->number),
                    strtoupper($request->district),
                    strtoupper($request->cep),
                    strtoupper($request->uf),
                    strtoupper($request->city),
                    strtoupper($request->tel1),
                    strtoupper($request->tel2),
                    strtoupper($request->email),
                    $filename,
                    date('Y-m-d')
                ]);

                return back()->with('success', 'Registro da instituição realizado com sucesso!')->withInput();

            } catch (Exception $ex) {
                Log::error('OCORREU UMA EXCEÇÃO NA FUNÇÃO DE CADASTRAR A INSTITUIÇÃO! '.$ex->getMessage(),[
                    'exception' => $ex
                ]);

                return back()->with('error', 'Não foi possível registrar a Instituição!')->withInput();
            }

        }
        else{
                                                        //Se houver registro, update...
            try {
                $request->validated();
                // dd($request);
                if($request->hasFile('logo')){
                    $filename = time().'.'.$request->logo->extension();
                    $request->logo->move(public_path('img/brand'), $filename);
                }
                $inst = DB::update('update tbinstitution set inst_cnpj = ?, inst_description = ?, inst_address = ?, inst_number = ?, inst_district = ?, inst_cep = ?, inst_uf = ?, inst_city = ?, inst_tel1 = ?, inst_tel2 = ?, inst_email = ?, inst_logo =?, inst_date = ? where inst_id = ?', [
                    strtoupper($request->cnpj),
                    strtoupper($request->description),
                    strtoupper($request->address),
                    strtoupper($request->number),
                    strtoupper($request->district),
                    strtoupper($request->cep),
                    strtoupper($request->uf),
                    strtoupper($request->city),
                    strtoupper($request->tel1),
                    strtoupper($request->tel2),
                    strtoupper($request->email),
                    $filename,
                    date('Y-m-d'),
                    $request->id
                ]);

                return back()->with('success', 'Alterações salvas com sucesso!')->withInput();

            } catch (Exception $ex) {
                Log::error('OCORREU UMA EXCEÇÃO NA FUNÇÃO DE EDITAR A INSTITUIÇÃO! '.$ex->getMessage(),[
                    'exception' => $ex
                ]);

                return back()->with('error', 'Não foi possível salvar as alterações da Instituição!')->withInput();
            }

        }
    }



    public function addInstitutionJson(Request $request){ //Adição de gestão via arquivo Json

        $inst = DB::select('select * from tbinstitution order by inst_id desc limit 1');

        if(!$inst){
            $request->validate([
                'jsonfile' => 'required|file|mimes:json'
            ],[
                'jsonfile.required' => 'O arquivo Json é obrigatório!',
                'jsonfile.file' => 'Arquivo Json inválido!',
                'jsonfile.mimes' => 'O arquivo selecionado deve ser do tipo Json!'
            ]);

                $path = $request->file('jsonfile')->store('instituicao');
                    if(!$path){
                        return back()->with('error_json', 'Falha ao salvar o arquivo Json!');
                    }

                $json = Storage::get($path);
                    if(!$json){
                        return back()->with('error_json', 'Falha ao ler o conteúdo do arquivo Json!');
                    }

                $data = json_decode($json, true);
                    if(json_last_error() !== JSON_ERROR_NONE){
                        return back()->with('error_json', 'Falha ao decodificar o arquivo Json! '.json_last_error_msg());
                    }

                foreach($data as $field){ //Percorre os campos guardados na variável $data
                    try {                   //Insert dos valores do json na tabela
                        $inst = DB::insert('insert into tbinstitution values(null,?,?,?,?,?,?,?,?,?,?,?,?,?)',[
                            $field['CNPJ'],
                            $field['Descricao'],
                            $field['Endereco'],
                            $field['Numero'],
                            $field['Bairro'],
                            $field['CEP'],
                            $field['UF'],
                            $field['Cidade'],
                            $field['Telefone1'],
                            $field['Telefone2'],
                            $field['Email'],
                            null,
                            date('Y-m-d')
                        ]);

                        return back()->with('success_json', 'Instituição registrada com sucesso!');

                    } catch (Exception $ex) {
                        Log::error('OCORREU UMA EXCEÇÃO AO REGISTRAR O GESTOR VIA ARQUIVO JSON! '.$ex->getMessage(), [
                            'exception' => $ex
                        ]);

                        return back()->with('error_json', 'Falha ao tentar importar as informações da Instituição!');
                    }
                }

        }
        else{
            return back()->with('error_json', 'Instituição já registrada!')->withInput();
        }
    }



    public function addBrand(Request $request){     // Adiciona a logomarca
        dd($request);
    }
}
