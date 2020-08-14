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

        // dd($fdate,$tdate);
        
        if ($request->type == 1) {
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

            $SumCom = 0;
            if ($data != NULL and $Sale != NULL) {
                foreach ($data as $key => $value) {
                    $SumCom += 3000;
                }
            }

            $fdate = $request->get('Fromdate');
            $tdate = $request->get('Todate');
            $type = $request->type;

            return view('Board.view', compact('data','type','fdate','tdate','Sale','SumCom'));
        }
    }
}
