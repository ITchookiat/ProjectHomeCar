<?php

namespace App\Exports;

use App\dataCustomer;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersCusExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = DB::table('data_customers')
                    ->leftJoin('data_cars','data_customers.DataCus_id','=','data_cars.F_DataCus_id')
                    // ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                    //     return $q->whereBetween('data_customers.DateSale_Cus',[$newfdate,$newtdate]);
                    // })
                    ->orderBy('data_customers.DataCus_id', 'ASC')
                    ->get();
        return $data;
        // return dataCustomer::all();
    }

    public function headings():array
    {
        return [
            '#',
            '#',
            'ชื่อ-สกุล'
        ];
    }
}
