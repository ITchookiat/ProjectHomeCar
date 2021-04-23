<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class BoardController extends Controller
{
    public function index(Request $request)
    {
        $fdate = '';
        $tdate = '';
        $Sale = '';
        $GetMoth = '';

        if ($request->has('Fromdate')) {
            $fdate = $request->get('Fromdate');
        }
        if ($request->has('Todate')) {
            $tdate = $request->get('Todate');
        }
        if ($request->has('Sale')) {
            $Sale = $request->get('Sale');
        }

        $fdate = \Carbon\Carbon::parse($fdate)->format('Y') + 543 ."-". \Carbon\Carbon::parse($fdate)->format('m')."-". \Carbon\Carbon::parse($fdate)->format('d');
        $tdate = \Carbon\Carbon::parse($tdate)->format('Y') + 543 ."-". \Carbon\Carbon::parse($tdate)->format('m')."-". \Carbon\Carbon::parse($tdate)->format('d');

        if ($request->type == 1) {
            if ($request->get('Fromdate') == NULL or $request->get('Todate') == NULL) {
                $GetMoth = date('m');
                $GetYear = date('Y')+543;

                $data = DB::table('data_cars')
                    ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
                    ->whereMonth('data_cars.Date_Soldout_plus', $GetMoth)
                    ->whereYear('data_cars.Date_Soldout_plus', $GetYear)
                    ->where('data_cars.Car_type','=',6)
                    ->orderBy('data_cars.Date_Soldout_plus', 'DESC')
                    ->get();
                
            }else {
                $data = DB::table('data_cars')
                    ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
                    ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
                        return $q->whereBetween('data_cars.Date_Soldout_plus',[$fdate,$tdate]);
                        })
                    ->when(!empty($Sale), function($q) use($Sale){
                        return $q->where('data_cars.Name_Saleplus',$Sale);
                        })
                    ->where('data_cars.Car_type','=',6)
                    ->orderBy('data_cars.Date_Soldout_plus', 'DESC')
                    ->get();
            }

            // dd($data);

            $SumCom = 0;
            $SumBlow = 0;
            $Num1 = 0;
            $Num2 = 0;
            $Num3 = 0;
            $Num4 = 0;
            $Num5 = 0;
            $Num6 = 0;

            if ($data != NULL or $Sale != NULL) {
                foreach ($data as $key => $value) {
                    $SumCom += 3000;
                    if ($value->Name_Saleplus == 'แบมะ') {
                        $Num1 += 1;
                    }elseif ($value->Name_Saleplus == 'ลี') {
                        $Num2 += 1;
                    }elseif ($value->Name_Saleplus == 'วัน') {
                        $Num3 += 1;
                    }elseif ($value->Name_Saleplus == 'วรรณ') {
                        $Num4 += 1;
                    }
                }
            }

            if ($Num1 > 7) {
                $SumBlow += 2000;
            }
            if ($Num2 > 7) {
                $SumBlow += 2000;
            }
            if ($Num3 > 7) {
                $SumBlow += 2000;
            }
            if ($Num4 > 7) {
                $SumBlow += 2000;
            }

            $fdate = $request->get('Fromdate');
            $tdate = $request->get('Todate');
            $type = $request->type;

            return view('Board.view', compact('data','type','fdate','tdate','Sale','SumCom','SumBlow',
                        'Num1','Num2','Num3','Num4'));
        }
    }
}
