<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use Carbon\Carbon;
use App\data_car;
use App\checkDocument;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $fdate = '';
      $tdate = '';

      if ($request->has('Fromdate')) {
        $fdate = $request->get('Fromdate');
      }
      if ($request->has('Todate')) {
        $tdate = $request->get('Todate');
      }

      if ($request->type == 1) {     //รายงาน รถยนต์ทั้งหมด
        $data = DB::connection('sqlsrv2')->table('data_cars')
                      ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
                      ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
                             return $q->whereBetween('data_cars.create_date',[$fdate,$tdate]);
                             })
                      ->where('data_cars.Car_type','<>',6)
                      ->orderBy('data_cars.create_date', 'ASC')
                      ->get();
        $title = 'รถยนต์ทั้งหมด';

      }
      elseif ($request->type == 2) {  //รายงาน รถยนต์พร้อมขาย
        $data = DB::connection('sqlsrv2')->table('data_cars')
                      ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
                      ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
                             return $q->whereBetween('data_cars.create_date',[$fdate,$tdate]);
                             })
                      ->where('data_cars.Car_type','=',5)
                      ->orderBy('data_cars.create_date', 'ASC')
                      ->get();
        $title = 'รถยนต์พร้อมขาย';
      }
      elseif ($request->type == 3) {  //รายงาน สต๊อกบัญชี
        $data = DB::connection('sqlsrv2')->table('data_cars')
                      ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
                      ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
                             return $q->whereBetween('data_cars.create_date',[$fdate,$tdate]);
                             })
                      ->where('data_cars.Origin_Car','<',3)
                      ->where('data_cars.Car_type','<>',6)
                      ->orderBy('data_cars.create_date', 'ASC')
                      ->get();
       $title = 'สต๊อกบัญชี';
      }
      elseif ($request->type == 4) {  //รายงาน วันหมดอายุบัตร
        $data = DB::connection('sqlsrv2')->table('data_cars')
                      ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
                      ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
                             return $q->whereBetween('check_documents.Date_NumberUser',[$fdate,$tdate]);
                             })
                      ->whereNotNull('check_documents.Date_NumberUser')
                      ->where('data_cars.Car_type','<>',6)
                      ->orderBy('check_documents.Date_NumberUser', 'ASC')
                      ->get();
         // dd($data);
         $title = 'วันหมดอายุบัตร';
      }
      elseif ($request->type == 5) {  //รายงาน รถยึด
        $data = DB::connection('sqlsrv2')->table('data_cars')
                   ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
                   ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
                          return $q->whereBetween('data_cars.create_date',[$fdate,$tdate]);
                          })
                    // ->when(!empty($originType), function($q) use($originType){
                    //   return $q->where('data_cars.Origin_Car',$originType);
                    // })
                   ->where('data_cars.Origin_Car','=',3)
                   ->where('data_cars.Car_type','<>',6)
                   ->orderBy('data_cars.create_date', 'ASC')
                   ->get();
         $title = 'รถยึด / CKL';
      }
      elseif ($request->type == 6) {  //รายงาน ยอดทุนรถต่อคัน
        $data = DB::connection('sqlsrv2')->table('data_cars')
                  ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
                  ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
                         return $q->whereBetween('data_cars.Date_Soldout_plus',[$fdate,$tdate]);
                         })
                  // ->when(!empty($originType), function($q) use($originType){
                  //   return $q->where('data_cars.Origin_Car',$originType);
                  // })
                  ->where('data_cars.Car_type','=',6)
                  ->where('data_cars.Name_Buyer','!=',"โมบายฝ่ายกฎหมาย")
                  ->orderBy('data_cars.Date_Soldout_plus', 'ASC')
                  ->get();
         $title = 'ยอดทุนรถต่อคัน';
      }

      $type = $request->type;
      $fdate = $request->get('Fromdate');
      $tdate = $request->get('Todate');

      return view('homecar.viewreport', compact('data','title','type','fdate','tdate','originType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ReportStockcar(Request $request)
    {
      $fdate = '';
      $tdate = '';
      $originType = '';

      // if ($request->has('Fromdate')) {
      //     $fdate = $request->get('Fromdate');
      // }
      // if ($request->has('Todate')) {
      //     $tdate = $request->get('Todate');
      // }
      if ($request->Fromdate != '') {
        $b_fdate = $request->get('Fromdate');
        $fdate = \Carbon\Carbon::parse($b_fdate)->format('Y') + 543 ."-". \Carbon\Carbon::parse($b_fdate)->format('m')."-". \Carbon\Carbon::parse($b_fdate)->format('d');
      }else{
        $fdate = $request->get('Fromdate');
      }
      if ($request->Todate != '') {
        $b_tdate = $request->get('Todate');
        $tdate = \Carbon\Carbon::parse($b_tdate)->format('Y') + 543 ."-". \Carbon\Carbon::parse($b_tdate)->format('m')."-". \Carbon\Carbon::parse($b_tdate)->format('d');
      }else{
        $tdate = $request->get('Todate');
      }
      if ($request->has('originType')) {
        $originType = $request->originType;
      }

      if ($request->id == 3) {
        $dataReport = DB::connection('sqlsrv2')->table('data_cars')
                        ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
                        ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
                          return $q->whereBetween('data_cars.create_date',[$fdate,$tdate]);
                        })
                        ->when(!empty($originType), function($q) use($originType){
                          return $q->whereIn('data_cars.Origin_Car',$originType);
                        })
                        ->where('data_cars.Car_type','<>',6)
                        ->orderBy('data_cars.create_date', 'ASC')
                        ->get();
                        // dd($fdate,$tdate,$dataReport);
      }
      elseif ($request->id == 4) {
        $dataReport = DB::connection('sqlsrv2')->table('data_cars')
                        ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
                        ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
                               return $q->whereBetween('check_documents.Date_NumberUser',[$fdate,$tdate]);
                               })
                        ->where('check_documents.Date_NumberUser','!=', NULL)
                        ->where('data_cars.Car_type','<>',6)
                        ->orderBy('check_documents.Date_NumberUser', 'ASC')
                        ->get();
          // dd($dataReport);

      }
      elseif ($request->id == 5) { // pdf รถยึด กับ ckl
        $dataReport = DB::connection('sqlsrv2')->table('data_cars')
                      ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
                      ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
                            return $q->whereBetween('data_cars.create_date',[$fdate,$tdate]);
                            })
                      ->when(!empty($originType), function($q) use($originType){
                        return $q->whereIn('data_cars.Origin_Car',$originType);
                      })
                      ->where('data_cars.Origin_Car', '!=', 2)
                      ->where('data_cars.Car_type','<>',6)
                      ->orderBy('data_cars.create_date', 'ASC')
                      ->get();

      }
      elseif ($request->id == 6) {
        $dataReport = DB::connection('sqlsrv2')->table('data_cars')
                        ->join('check_documents','data_cars.id','=','check_documents.Datacar_id')
                        ->when(!empty($fdate)  && !empty($tdate), function($q) use ($fdate, $tdate) {
                               return $q->whereBetween('data_cars.Date_Soldout_plus',[$fdate,$tdate]);
                               })
                        ->when(!empty($originType), function($q) use($originType){
                          return $q->whereIn('data_cars.Origin_Car',$originType);
                        })
                        ->where('data_cars.Car_type','=',6)
                       ->where('data_cars.Name_Buyer','!=',"โมบายฝ่ายกฎหมาย")
                        ->orderBy('data_cars.Date_Soldout_plus', 'ASC')
                        ->get();
                        //  dd($fdate,$tdate,$dataReport);
      }

      $ReportType = $request->id;
      // $fdate = $request->get('Fromdate');
      // $tdate = $request->get('Todate');

      $view = \View::make('homecar.reportcar' ,compact(['dataReport','ReportType','fdate','tdate','originType']));
      $html = $view->render();

      $pdf = new PDF();
      if ($request->id == 3) {
        $pdf::SetTitle('รายงาน สต๊อกบัญชี');
        // $pdf::SetFont('freeserif','',13,'false');
        $pdf::SetFont('thsarabunpsk', '', 15, '', true);
      }elseif ($request->id == 4) {
        $pdf::SetTitle('รายงาน วันหมดอายุบัตร');
        // $pdf::SetFont('freeserif','',13,'false');
        $pdf::SetFont('thsarabunpsk', '', 15, '', true);
      }elseif ($request->id == 5) {
        $pdf::SetTitle('รายงาน รถยึด / CKL');
        // $pdf::SetFont('freeserif','',10,'false');
        $pdf::SetFont('thsarabunpsk', '', 15, '', true);
      }elseif ($request->id == 6) {
        $pdf::SetTitle('รายงาน ยอดทุนรถต่อคัน');
        // $pdf::SetFont('freeserif','',10,'false');
        $pdf::SetFont('thsarabunpsk', '', 15, '', true);
      }

      $pdf::AddPage('L', 'A4');
      $pdf::SetMargins(10, 5, 5, 0);
      $pdf::SetAutoPageBreak(TRUE, 30);
      $pdf::WriteHTML($html,true,false,true,false,'');
      $pdf::Output('report.pdf');

    }
}
