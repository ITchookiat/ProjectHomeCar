<?php

namespace App\Exports;

use App\dataCustomer;
use App\data_car;
use DB;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class UsersCusExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function view(): View
    {

        $input = request()->all();
        $newfdate = $input['Fromdate'];
        $newtdate = $input['Todate'];
        $flag = $input['Flag'];

        if($flag == 2){ //Report Customer
            return view('dataCus.export', [
                'data' => DB::table('data_customers')
                        ->leftJoin('data_cars','data_customers.DataCus_id','=','data_cars.F_DataCus_id')
                        ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                            return $q->whereBetween('data_customers.DateSale_Cus',[$newfdate,$newtdate]);
                        })
                        ->orderBy('data_customers.DataCus_id', 'ASC')
                        ->get(),
                'newfdate' => $newfdate,
                'newtdate' => $newtdate,
                'Flag' => $flag,
            ]);
        }
        elseif($flag == 22){ //Report Cars sale
            $newfdate = \Carbon\Carbon::parse($newfdate)->format('Y') + 543 ."-". \Carbon\Carbon::parse($newfdate)->format('m')."-". \Carbon\Carbon::parse($newfdate)->format('d');
            $newtdate = \Carbon\Carbon::parse($newtdate)->format('Y') + 543 ."-". \Carbon\Carbon::parse($newtdate)->format('m')."-". \Carbon\Carbon::parse($newtdate)->format('d');
            
            return view('dataCus.export', [
                'data' => DB::table('data_cars')
                        // ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
                        ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                                return $q->whereBetween('data_cars.Date_Soldout_plus',[$newfdate,$newtdate]);
                                })
                        ->where('data_cars.Car_type','=',6)
                        ->orderBy('data_cars.Date_Soldout_plus', 'ASC')
                        ->get(),
                'newfdate' => $newfdate,
                'newtdate' => $newtdate,
                'Flag' => $flag,
            ]);
        }

    }

}
