<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class adminDashController extends Controller
{
    public function viewDash(){
        //Informações da instituição
        if(Session::has('cnpjSession') !== 0){
            $institution = DB::select('select * from tbinstitution limit 1');
            if($institution){
                $item = $institution[0];
                $cnpj = $item->inst_cnpj;
                $desc = $item->inst_description;
                $tel = $item->inst_tel1.' '.$item->inst_tel2;
                $email = $item->inst_email;
                $address = $item->inst_address.', '.$item->inst_number.' - '.$item->inst_district;
                $location = $item->inst_city.'-'.$item->inst_uf;
            }
        }

        //Informações de envio

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
                $competence = $month.'/'.$year;
                $register = $countEmployee.'/'.$countRegister;
                $earning = number_format($earning, 2, ',', '.');

            }
            else{
                $dateSend = 'Nenhum envio foi feito ainda.';
                $earning = '0,00';
                $competence = 'Nenhuma.';
                $register = '0/0';
            }

            return view('admin.dashboard', [
                'cnpj' => $cnpj,
                'desc' => $desc,
                'tel' => $tel,
                'email' => strtolower($email),
                'address' => $address,
                'location' => $location,
                'earning' => $earning,
                'competence' => $competence,
                'register' => $register,
                'lastDate' => $dateSend
            ]);

    }
}
