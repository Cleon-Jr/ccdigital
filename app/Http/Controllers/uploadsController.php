<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class uploadsController extends Controller
{
    public function viewUploads(){

            // Data do envio mais recente
            $sendDate = DB::select('select * from tbcompetence order by com_id desc limit 1');
            if(count($sendDate) > 0){
                $fields = $sendDate;

                $cnpj = $fields[0]->com_cnpj;
                $year = $fields[0]->com_year;
                $month = $fields[0]->com_month;
                $dateSend = $fields[0]->com_date;

                $numberEmployee = DB::select('select distinct epay_cpf from tbpayroll where epay_year = ? and epay_month = ?', [
                    $year,
                    $month
                ]);
                $countEmployee = count($numberEmployee);

                $numberRegister = DB::select('select distinct epay_mat from tbpayroll where epay_year = ? and epay_month = ?', [
                    $year,
                    $month
                ]);
                $countRegister = count($numberRegister);

                $totals = DB::select('select sum(pay_earnings) as earnings, sum(pay_discounts) as discounts, (sum(pay_earnings) - sum(pay_discounts)) as netvalue from tbpaycheck where pay_year = ? and pay_month = ?', [
                    $year,
                    $month
                ]);

                $total = $totals;
                $earning = $total[0]->earnings;
                $discount = $total[0]->discounts;
                $netvalue = $total[0]->netvalue;

                return view('admin.uploads', [
                    'competence' => $month.'/'.$year,
                    'sendLast' => $dateSend,
                    'numberEmployee' => $countEmployee,
                    'numberRegister' => $countRegister,
                    'earning' => number_format($earning, 2, ',','.'),
                    'discount' => number_format($discount, 2, ',', '.'),
                    'netvl' => number_format($netvalue, 2, ',', '.')
                ]);

            }
            else{

                return view('admin.uploads', [
                    'sendLast' => 'Ainda não foram registrados.',
                    'numberEmployee' => '0',
                    'numberRegister' => '0',
                    'competence' => 'Nenhuma.',
                    'earning' => '0,00',
                    'discount' => '0,00',
                    'netvl' => '0,00'
                ]);
            }

    }



    public function sendFiles(Request $request){
        ini_set('max_execution_time', 3600);
        set_time_limit(3600);

        //Validação e mensagens
        $request->validate([
            'jsonfile1' => 'required|file|mimes:json',
            'jsonfile2' => 'required|file|mimes:json',
            'jsonfile3' => 'required|file|mimes:json',
            'jsonfile4' => 'required|file|mimes:json',
            'jsonfile5' => 'required|file|mimes:json',
        ],
        [
            'jsonfile1.required' => 'O arquivo 1-competencia é obrigatório!',
            'jsonfile2.required' => 'O arquivo 2-servidores é obrigatório!',
            'jsonfile3.required' => 'O arquivo 3-servidoresfolha é obrigatório!',
            'jsonfile4.required' => 'O arquivo 4-contracheque é obrigatório!',
            'jsonfile5.required' => 'O arquivo 5-itenscontracheque é obrigatório!',
            'jsonfile1.file' => 'Arquivo 1-competencia inválido!',
            'jsonfile2.file' => 'Arquivo 2-servidores inválido!',
            'jsonfile3.file' => 'Arquivo 3-servidoresfolha inválido!',
            'jsonfile4.file' => 'Arquivo 4-contracheque inválido!',
            'jsonfile5.file' => 'Arquivo 5-itenscontracheque inválido!',
            'jsonfile1.mimes' => 'O arquivo 1-competencia deve ser do tipo .Json!',
            'jsonfile2.mimes' => 'O arquivo 2-servidores deve ser do tipo .Json!',
            'jsonfile3.mimes' => 'O arquivo 3-servidoresfolha deve ser do tipo .Json!',
            'jsonfile4.mimes' => 'O arquivo 4-contracheque deve ser do tipo .Json!',
            'jsonfile5.mimes' => 'O arquivo 5-itenscontracheque deve ser do tipo .Json!',
        ]);

        // processamento dos arquivos jsonfile1
        $path = $request->file('jsonfile1')->store('competencia');
            if(!$path){
                return back()->with('error', 'Falha ao salvar o arquivo 1-competencia!');
            }

        $json = Storage::get($path);
            if(!$json){
                return back()->with('error', 'Falha ao ler o conteúdo do arquivo 1-competencia!');
            }

        $data = json_decode($json, true);
            if(json_last_error() !== JSON_ERROR_NONE){
                return back()->with('error', 'Falha ao decodificar o arquivo 1-competencia! '.json_last_error_msg());
            }

        foreach($data as $item_comp){
            $competence = DB::select('select * from tbcompetence where com_year = ? and com_month = ? and com_seq = ?', [
                $item_comp['Ano'],
                $item_comp['Mes'],
                $item_comp['Sequencia']
            ]);

            if(count($competence) <= 0){
                if(Session::get('cnpjSession') !== $item_comp['CNPJInstituicao']){
                    return back()->with('error','Arquivos não correspondem à Instituição registrada no sistema!');
                }

                try {
                    $competence = DB::insert('insert into tbcompetence values(null, ?, ? ,? , ?, ?, ?)', [
                        $item_comp['CNPJInstituicao'],
                        $item_comp['Ano'],
                        $item_comp['Mes'],
                        $item_comp['Sequencia'],
                        0,
                        date('Y-m-d H:i:s')
                    ]);

                    //Envio da competência realizado


                } catch (Exception $ex) {
                    Log::error('HOUVE UMA EXCEÇÃO AO SALVAR A COMPETÊNCIA '.$item_comp['Ano'].'/'.$item_comp['Mes'].$ex->getMessage(), [
                        'exception' => $ex
                    ]);
                    return back()->with('error', 'Não foi possível adicionar a competência '.$item_comp['Ano'].'/'.$item_comp['Mes']);
                }

            }
            else{
                return back()->with('error', 'A competência '.$item_comp['Ano'].'/'.$item_comp['Mes'].' já foi enviado. Exclua-a antes de enviá-la novamente!');
            }
        }



        // Processamento do arquivo Jsonfile2
        $path = $request->file('jsonfile2')->store('servidores');
            if(!$path){
                return back()->with('error', 'Falha ao salvar o arquivo 2-servidores!');
            }

        $json = Storage::get($path);
            if(!$json){
                return back()->with('error', 'Faha ao ler o conteúdo do arquivo 2-servidores!');
            }

        $data = json_decode($json, true);
            if(json_last_error() !== JSON_ERROR_NONE){
                return back()->with('error', 'Falha ao decodificar o arquivo 2-servidores! '.json_last_error_msg());
            }

        foreach($data as $item){
            $payRollEmployee = DB::select('select * from tbemployee where emp_cnpj = ? and emp_cpf = ? and emp_year = ? and emp_month = ?', [
                $item['CNPJ'],
                $item['CPF'],
                $item['Ano'],
                $item['Mes'],
            ]);

            if(count($payRollEmployee) <= 0){
                try {
                    $payRollEmployee = DB::insert('insert into tbemployee values (null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [
                        $item['CNPJ'],
                        $item['CPF'],
                        $item['Nome'],
                        $item['Nascimento'],
                        $item['Mae'],
                        $item['RG'],
                        $item['PISPASEP'],
                        $item['Email'],
                        $item['Cidade'],
                        $item['Ano'],
                        $item['Mes'],
                        null,
                        0,
                        null,
                        date('Y-m-d H:i:s')
                    ]);

                    // envio realizado


                } catch (Exception $ex) {
                    Log::error('HOUVE UMA EXCEÇÃO AO SALVAR O REGISTRO '.$item['CPF'].' DO ARQUIVO 2-servidores! '.$ex->getMessage(), [
                        'exception' => $ex
                    ]);

                    return back()->with('error', 'Não foi possível salvar o registro '.$item['CPF'].' do arquivo 2-servidores!');
                }

            }
            else{
                // registro já existente
            }
        }

        // Processamento do arquivo Jsonfile3
        $path = $request->file('jsonfile3')->store('servidoresfolha');
            if(!$path){
                return back()->with('error', 'Falha ao salvar o arquivo 3-servidoresfolha!');
            }

        $json = Storage::get($path);
            if(!$json){
                return back()->with('error', 'Faha ao ler o conteúdo do arquivo 3-servidoresfolha!');
            }

        $data = json_decode($json, true);
            if(json_last_error() !== JSON_ERROR_NONE){
                return back()->with('error', 'Falha ao decodificar o arquivo 3-servidoresfolha! '.json_last_error_msg());
            }

        foreach($data as $item){
            $payRollEmployee = DB::select('select * from tbpayroll where epay_cnpj = ? and epay_mat = ? and epay_year = ? and epay_month = ? and epay_seq = ?', [
                $item['CNPJInstituicao'],
                $item['Matricula'],
                $item['Ano'],
                $item['Mes'],
                $item['Sequencia']
            ]);

            if(count($payRollEmployee) <= 0){
                try {
                    $payRollEmployee = DB::insert('insert into tbpayroll values (null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [
                        $item['CNPJInstituicao'],
                        $item['CPF'],
                        $item['Matricula'],
                        $item['Nome'],
                        $item['DataAdmissao'],
                        $item['GrupoTrabalho'],
                        $item['Secretaria'],
                        $item['Departamento'],
                        $item['CodLotacao'],
                        $item['Lotacao'],
                        $item['CodCargo'],
                        $item['Cargo'],
                        $item['CBO'],
                        $item['HorasMes'],
                        $item['Funcao'],
                        $item['Ano'],
                        $item['Mes'],
                        $item['Sequencia'],
                        date('Y-m-d H:i:s')
                    ]);

                    // envio realizado


                } catch (Exception $ex) {
                    Log::error('HOUVE UMA EXCEÇÃO AO SALVAR O REGISTRO '.$item['CPF'].' DO ARQUIVO 3-servidoresfolha! '.$ex->getMessage(), [
                        'exception' => $ex
                    ]);

                    return back()->with('error', 'Não foi possível salvar o registro '.$item['CPF'].' do arquivo 3-servidoresfolha!');
                }

            }
            else{
                // registro já existente
            }
        }


        // Processamento do arquivo Jsonfile4
        $path = $request->file('jsonfile4')->store('contracheque');
            if(!$path){
                return back()->with('error', 'Falha ao salvar o arquivo 4-contracheque!');
            }

        $json = Storage::get($path);
            if(!$json){
                return back()->with('error', 'Falha ao ler o conteúdo do arquivo 4-contracheque!');
            }

        $data = json_decode($json, true);
            if(json_last_error() !== JSON_ERROR_NONE){
                return back()->with('error', 'Falha ao decodificar o arquivo 4-contracheque! '.json_last_error_msg());
            }

        foreach ($data as $item) {
            $paycheck = DB::select('select * from tbpaycheck where pay_cnpj = ? and pay_mat = ? and pay_year = ? and pay_month =  ? and pay_seq = ?', [
                $item['CNPJInstituicao'],
                $item['Matricula'],
                $item['Ano'],
                $item['Mes'],
                $item['Sequencia']
            ]);

            if(count($paycheck) <= 0){
                try {
                    $paycheck = DB::insert('insert into tbpaycheck values (null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [
                        $item['CNPJInstituicao'],
                        $item['CPF'],
                        $item['Matricula'],
                        $item['Nome'],
                        $item['DataAdmissao'],
                        $item['PISPASEP'],
                        $item['INSS'],
                        $item['IR'],
                        $item['SalarioBase'],
                        $item['FGTS'],
                        $item['DepIR'],
                        $item['FaixaIR'],
                        $item['Banco'],
                        $item['Agencia'],
                        $item['Conta'],
                        $item['Proventos'],
                        $item['Descontos'],
                        $item['ValorLiquido'],
                        $item['Ano'],
                        $item['Mes'],
                        $item['Sequencia']
                    ]);

                    //Envio realizado


                } catch (Exception $ex) {
                    Log::error('HOUVE UMA EXCEÇÃO AO SALVAR O REGISTRO '.$item['Matricula'].' DO ARQUIVO 4-contracheque! '.$ex->getMessage(), [
                        'exception' => $ex
                    ]);

                    return back()->with('error', 'Não foi possível salvar o registro '.$item['Matricula'].' do arquivo 4-contracheque!');
                }
            }
            else{
                // registro já existente
            }
        }



        // Processamento do arquivo Jsonfile5
        $path = $request->file('jsonfile5')->store('itenscontracheque');
            if(!$path){
                return back()->with('error', 'Falha ao salvar o arquivo 5-itenscontracheque!');
            }

        $json = Storage::get($path);
            if(!$json){
                return back()->with('error', 'Falha ao ler o conteúdo do arquivo 5-itenscontracheque!');
            }

        $data = json_decode($json, true);
            if(json_last_error() !== JSON_ERROR_NONE){
                return back()->with('error', 'Falha ao decodificar o arquivo 5-itenscontracheque! '.json_last_error_msg());
            }

        foreach($data as $item){
            $items = DB::select('select * from tbitems where ite_mat = ? and ite_cod = ? and ite_year = ? and ite_month = ? and ite_seq = ?', [
                $item['Matricula'],
                $item['Codigo'],
                $item['Ano'],
                $item['Mes'],
                $item['Sequencia']
            ]);

            if(count($items) <= 0){
                try {
                    $items = DB::insert('insert into tbitems values(null,?,?,?,?,?,?,?,?,?,?)', [
                        $item['Matricula'],
                        $item['CPF'],
                        $item['Codigo'],
                        $item['Descricao'],
                        $item['Remuneracao'],
                        $item['Descontos'],
                        $item['Referencia'],
                        $item['Ano'],
                        $item['Mes'],
                        $item['Sequencia']
                    ]);

                    //Envio realizado

                } catch (Exception $ex) {
                    Log::error('HOUVE UMA EXCEÇÃO AO SALVAR O REGISTRO '.$item['Matricula'].' do arquivo 5-itenscontracheque! '.$ex->getMessage(), [
                        'exception' => $ex
                    ]);

                    return back()->with('error', 'Não foi possível salvar o registro '.$item['Matricula'].' do arquivo 5-itenscontracheque!');
                }
            }
            else{
                // registro já existe
            }
        }

        return redirect('/admin/uploads');

    }

}
