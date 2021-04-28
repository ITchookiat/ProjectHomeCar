<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use Excel;

use Carbon\Carbon;
use App\dataCustomer;
use App\data_car;
use App\tracking_cus;
use App\Exports\UsersCusExport;

class ResearchCusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->type == 1) {      //index
            $newfdate = '';
            $newtdate = '';
            $TypeCus = '';
            if ($request->has('Fromdate')){
                $newfdate = $request->get('Fromdate');
            }
            if ($request->has('Todate')){
                $newtdate = $request->get('Todate');
            }
            if ($request->has('TypeCus')){
                $TypeCus = $request->get('TypeCus');
            }

            if ($request->has('Fromdate') == false and $request->has('Todate') == false) {
                $data = DB::table('data_customers')
                    ->leftJoin('data_cars','data_customers.DataCus_id','=','data_cars.F_DataCus_id')
                    ->orwhere('data_customers.Status_Cus','!=', 'ส่งมอบ')
                    ->orderBy('data_customers.DataCus_id', 'ASC')
                    ->get();
            }
            else {
                $data = DB::table('data_customers')
                    ->leftJoin('data_cars','data_customers.DataCus_id','=','data_cars.F_DataCus_id')
                    ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                        return $q->whereBetween('data_customers.DateSale_Cus',[$newfdate,$newtdate]);
                    })
                    // ->when(!empty($TypeCus), function($q) use($TypeCus){
                    //     return $q->where('data_customers.Status_Cus',$TypeCus);
                    // })
                    ->orderBy('data_customers.DataCus_id', 'ASC')
                    ->get();
            }

            $dataTrack = DB::table('tracking_cuses')
                ->where('tracking_cuses.Tag_Tracking','=', 'Y')
                ->get();

            $type = $request->type;
            return view('dataCus.view', compact('data','dataTrack','newfdate','newtdate','type','TypeCus'));
        }
        elseif ($request->type == 2) {  //create
            $data = DB::table('data_cars')
                    ->where('data_cars.car_type','<>',6)
                    ->whereNull('data_cars.BookStatus_Car')
                    ->orwhere('data_cars.BookStatus_Car','=', 'ติดตาม')
                    ->orderBy('data_cars.Number_Regist', 'ASC')
                    ->get();

            $type = $request->type;
            return view('dataCus.create', compact('type','data'));
        }
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

    public function SearchData(Request $request, $type){
        if ($type == 1) {       //ค้นหาป้ายทเะบียน ตาราง data_cars
            $GetRegis = $request->get('select');
            
            $data = DB::table('data_cars')
                ->where('data_cars.id','=', $GetRegis)
                ->get();

                foreach($data as $row){
                    if ($GetRegis != 'NULL') {
                        $output ='<div class="row">
                                    <div class="col-6">
                                        <div class="form-group row mb-0">
                                        <label class="col-sm-3 col-form-label text-right">ยี่ห้อ : </label>
                                            <div class="col-sm-8">
                                                <input type="text" name="BrandCar" class="form-control" style="height:30px;" value="'.$row->Brand_Car.'" readonly/>
                                                <input type="hidden" name="RegistCar" value="'.$row->Number_Regist.'"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group row mb-0">
                                        <label class="col-sm-3 col-form-label text-right">รุ่น/สี : </label>
                                            <div class="col-sm-4">
                                                <input type="text" name="VersionCar" class="form-control" style="height:30px;" value="'.$row->Version_Car.'" readonly/>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" name="ColorCar" class="form-control" style="height:30px;" value="'.$row->Color_Car.'" readonly/>
                                            </div>
                                        </div>
                                    </div>
                                </div>';

                        $output.='<div class="row">
                                <div class="col-6">
                                    <div class="form-group row mb-0">
                                    <label class="col-sm-3 col-form-label text-right">เกียร์/ปี : </label>
                                        <div class="col-sm-4">
                                            <input type="text" name="GearCar" class="form-control" style="height:30px;"value="'.$row->Gearcar.'" readonly/>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" name="YearCar" class="form-control" style="height:30px;" value="'.$row->Year_Product.'" readonly/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group row mb-0">
                                    <label class="col-sm-3 col-form-label text-right">ราคา : </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="PriceCar" class="form-control" style="height:30px;" value="'.number_format($row->Net_Price, 2).'" readonly/>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                    }
                }

            echo $output;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->type == 1) {       //เพิ่มรายการ ลูกค้า
            //ประเภทลูกค้า
            if ($request->get('TypeCus') == "Very Hot") {
                $SetDateType = date('Y-m-d');
            }elseif ($request->get('TypeCus') == "Hot") {
                $SetDateType = date('Y-m-d', strtotime('+5 days'));
            }elseif ($request->get('TypeCus') == "Warm") {
                $SetDateType = date('Y-m-d', strtotime('+15 days'));
            }elseif ($request->get('TypeCus') == "Cold") {
                $SetDateType = date('Y-m-d', strtotime('+30 days'));
            }else {
                $SetDateType = NULL;
            }

            //ดึงจาก สถานะลูกค้า
            if ($request->get('StatusCus') != NULL) {
                $SetDateStatus = date('Y-m-d');
            }else {
                $SetDateStatus = NULL;
            }

            if($request->get('CashStatusCus') != NULL){
                $SetCash = str_replace (",","",$request->get('CashStatusCus'));
            }else{
                $SetCash = NULL;
            }

            if($request->get('PriceCar') != NULL){
                $SetPriceCar = str_replace (",","",$request->get('PriceCar'));
            }else{
                $SetPriceCar = NULL;
            }

            $GetID[] = NULL;
            $dataCus = dataCustomer::where('RegistCar_Cus',$request->get('RegistCar'))->get();

            if ($request->get('StatusCus') == 'จอง') {
                foreach ($dataCus as $key => $value) {
                    $GetID[] = $value->DataCus_id;
                }
                if ($GetID != NULL) {
                    dataCustomer::whereIn('DataCus_id', $GetID)->update([
                        'Status_Cus' => NULL,
                        'DateStatus_Cus' => NULL,
                        'Type_Cus' => NULL,
                        'DateType_Cus' => NULL,
                        'RegistCar_Cus' => NULL,
                        'BrandCar_Cus' =>  NULL,
                        'VersionCar_Cus' => NULL,
                        'ColorCar_Cus' => NULL,
                        'GearCar_Cus' => NULL,
                        'YearCar_Cus' => NULL,
                        'PriceCar_Cus' => NULL,
                    ]);
                }
            }

            $dataCus = new dataCustomer([
                'Name_Cus' => $request->get('NameCus'),
                'Phone_Cus' =>  $request->get('PhoneCus'),
                'IDCard_Cus' =>  $request->get('IDCardCus'),
                'Address_Cus' =>  $request->get('AddressCus'),
                'Province_Cus' =>  $request->get('ProvinceCus'),
                'Zip_Cus' =>  $request->get('ZipCus'),
                'Career_Cus' =>  $request->get('CareerCus'),
                'Email_Cus' => $request->get('EmailCus'),
                'Origin_Cus' => $request->get('OriginCus'),
                'model_Cus' => $request->get('modelCus'),
                'Sale_Cus' => $request->get('SaleCus'),
                'DateSale_Cus' => $request->get('DateSaleCus'),
                'CashStatus_Cus' => $SetCash,
                'Status_Cus' => $request->get('StatusCus'),
                'DateStatus_Cus' => $SetDateStatus,
                'Type_Cus' => $request->get('TypeCus'),
                'DateType_Cus' => $SetDateType,
                'RegistCar_Cus' =>  $request->get('RegistCar'),
                'BrandCar_Cus' =>  $request->get('BrandCar'),
                'VersionCar_Cus' => $request->get('VersionCar'),
                'ColorCar_Cus' => $request->get('ColorCar'),
                'GearCar_Cus' => $request->get('GearCar'),
                'YearCar_Cus' => $request->get('YearCar'),
                'PriceCar_Cus' => $SetPriceCar,
                'Note_Cus' => $request->get('CusNote'),
              ]);
            $dataCus->save();

            if ($request->get('StatusCus') == 'จอง') {
                if ($request->get('RegisterCar') != NULL) {
                    $dataCars = data_car::find($request->RegisterCar);
                        $dataCars->F_DataCus_id = $dataCus->DataCus_id;
                        $dataCars->BookStatus_Car = $request->get('StatusCus');
                        $dataCars->DateStatus_Car = $SetDateStatus;
                    $dataCars->update();

                    $dataCus = dataCustomer::where('RegistCar_Cus',$request->get('RegistCar'))->first();
                    if ($dataCus != NULL) {
                        $dataCus->Datacar_id = $dataCars->id;
                        $dataCus->update();
                    }
                }
            }

            $type = $request->type;
            return redirect()->Route('ResearchCus',$type)->with('success','บันทึกข้อมูลเรียบร้อย');
        }
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
    public function edit(Request $request, $id)
    {
        if ($request->type == 1) {       // edit
            $data = DB::table('data_customers')
                    ->leftJoin('data_cars','data_customers.DataCus_id','=','data_cars.F_DataCus_id')
                    ->where('data_customers.DataCus_id',$id)
                    ->first();

            $dataRegis = DB::table('data_cars')
                    ->where('data_cars.car_type','<>',6)
                    ->whereNull('data_cars.BookStatus_Car')
                    ->orwhere('data_cars.BookStatus_Car','=', 'ติดตาม')
                    ->orderBy('data_cars.Number_Regist', 'ASC')
                    ->get();

            $tracking = DB::table('tracking_cuses')
                    ->where('tracking_cuses.F_DataCus_id',$id)
                    ->orderBy('tracking_cuses.Date_Tracking', 'ASC')
                    ->get();

            // dd($dataRegis);
            $type = $request->type;

             return view('dataCus.edit', compact('data','dataRegis','tracking','id','type'));
        }
        elseif ($request->type == 2) {   // view createTracking
            $type = $request->type;

            return view('dataCus.createTracking', compact('id','type'));
        }
        elseif ($request->type == 3) {   // edit Tracking
            $tracking = DB::table('tracking_cuses')
                    ->where('tracking_cuses.Tracking_id',$id)
                    ->orderBy('tracking_cuses.Date_Tracking', 'ASC')
                    ->first();

            $type = $request->type;

            return view('dataCus.editTracking', compact('tracking','type'));
        }
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
        if ($request->type == 1) {           //edit
            //ข้อมูลลูกค้า
            $dataCus = dataCustomer::find($id);
                $dataCus->Name_Cus = $request->get('NameCus');
                $dataCus->Phone_Cus = $request->get('PhoneCus');
                $dataCus->IDCard_Cus = $request->get('IDCardCus');
                $dataCus->Address_Cus = $request->get('AddressCus');
                $dataCus->Province_Cus = $request->get('ProvinceCus');
                $dataCus->Zip_Cus = $request->get('ZipCus');
                $dataCus->Career_Cus = $request->get('CareerCus');
                $dataCus->Email_Cus = $request->get('EmailCus');
                $dataCus->Origin_Cus = $request->get('OriginCus');
                $dataCus->model_Cus = $request->get('modelCus');
                $dataCus->Sale_Cus = $request->get('SaleCus');
                $dataCus->DateSale_Cus = $request->get('DateSaleCus');
                $dataCus->Note_Cus = $request->get('CusNote');

                if($request->get('CashStatusCus') != NULL){
                    $dataCus->CashStatus_Cus = str_replace (",","",$request->get('CashStatusCus'));
                }else{
                    $dataCus->CashStatus_Cus = NULL;
                }

                if ($request->get('StatusCus') == $dataCus->Status_Cus) {
                    $SetDateStatus = $dataCus->DateSale_Cus;
                }else {
                    $SetDateStatus = date('Y-m-d');
                }
                $dataCus->Status_Cus = $request->get('StatusCus');
                $dataCus->DateStatus_Cus = $SetDateStatus;
                
                if ($request->get('TypeCus') == $dataCus->Type_Cus) {
                    $SetDateType = $dataCus->DateType_Cus;
                }else {
                    if ($request->get('TypeCus') == "Very Hot") {
                        $SetDateType = date('Y-m-d');
                    }elseif ($request->get('TypeCus') == "Hot") {
                        $SetDateType = date('Y-m-d', strtotime('+5 days'));
                    }elseif ($request->get('TypeCus') == "Warm") {
                        $SetDateType = date('Y-m-d', strtotime('+15 days'));
                    }elseif ($request->get('TypeCus') == "Cold") {
                        $SetDateType = date('Y-m-d', strtotime('+30 days'));
                    }
                }
                $dataCus->Type_Cus = $request->get('TypeCus');
                $dataCus->DateType_Cus = $SetDateType;

                if ($request->get('RegistCar') != NULL) {
                    $dataCus->RegistCar_Cus =  $request->get('RegistCar');
                }else {
                    $dataCus->RegistCar_Cus =  $request->get('Regist_Car');
                }

                if ($request->get('BrandCar') != NULL) {
                    $dataCus->BrandCar_Cus =  $request->get('BrandCar');
                }else {
                    $dataCus->BrandCar_Cus =  $request->get('Brand_Car');
                }

                if ($request->get('VersionCar') != NULL) {
                    $dataCus->VersionCar_Cus =  $request->get('VersionCar');
                }else {
                    $dataCus->VersionCar_Cus =  $request->get('Version_Car');
                }

                if ($request->get('ColorCar') != NULL) {
                    $dataCus->ColorCar_Cus =  $request->get('ColorCar');
                }else {
                    $dataCus->ColorCar_Cus =  $request->get('Color_Car');
                }

                if ($request->get('GearCar') != NULL) {
                    $dataCus->GearCar_Cus =  $request->get('GearCar');
                }else {
                    $dataCus->GearCar_Cus =  $request->get('Gear_Car');
                }

                if ($request->get('YearCar') != NULL) {
                    $dataCus->YearCar_Cus =  $request->get('YearCar');
                }else {
                    $dataCus->YearCar_Cus =  $request->get('Year_Car');
                }
                
                if($request->get('PriceCar') != NULL){
                    $SetPrice = str_replace (",","",$request->get('PriceCar'));
                    $dataCus->PriceCar_Cus = $SetPrice;
                }else{
                    $SetPrice = str_replace (",","",$request->get('Price_Car'));
                    $dataCus->PriceCar_Cus = $SetPrice;
                }
            $dataCus->update();

            // $dataCar = data_car::where('F_DataCus_id',$id)->first();
            // if ($dataCar != NULL) {
            //         $dataCar->BookStatus_Car = $request->get('StatusCus');
            //         $dataCar->DateStatus_Car = $SetDateStatus;
            //     $dataCar->update();
            // }

            //กรณี เลือกป้ายทะเบียนใหม่ หรือ เพิ่มป้ายใหม่
            if ($request->get('RegisterCar') != NULL) {
                // $dataCar = data_car::where('Number_Regist',$request->get('Regist_Car'))->first();
                // //กรณี รถติดสถานะ ติดตาม อยู่แล้ว
                // if ($dataCar != NULL) {
                //         $dataCar->F_DataCus_id = NULL;
                //         $dataCar->BookStatus_Car = NULL;
                //         $dataCar->DateStatus_Car = NULL;
                //     $dataCar->update();
                // }

                //เพิ่มสถานะรถใหม่ เข้าไปใหม่
                if ($request->get('StatusCus') == 'จอง') {
                    $dataCar = data_car::find($request->get('RegisterCar'));
                        $dataCar->F_DataCus_id = $id;
                        $dataCar->BookStatus_Car = $request->get('StatusCus');
                        $dataCar->DateStatus_Car = date('Y-m-d');
                    $dataCar->update();
                    
                    $dataCus = dataCustomer::where('DataCus_id',$id)->first();
                    if ($dataCus != NULL) {
                        $dataCus->Datacar_id = $dataCar->id;
                        $dataCus->update();
                    }
                }

            }

            if ($request->get('StatusCus') == 'จอง') {
                $GetID[] = NULL;
                $dataCus = dataCustomer::where('RegistCar_Cus',$request->get('Regist_Car'))
                        ->where('DataCus_id','!=', $id)
                        ->get();

                foreach ($dataCus as $key => $value) {
                    $GetID[] = $value->DataCus_id;
                }

                if ($GetID != NULL) {
                    dataCustomer::whereIn('DataCus_id', $GetID)->update([
                        'Status_Cus' => NULL,
                        'DateStatus_Cus' => NULL,
                        'Type_Cus' => NULL,
                        'DateType_Cus' => NULL,
                        'RegistCar_Cus' => NULL,
                        'BrandCar_Cus' =>  NULL,
                        'VersionCar_Cus' => NULL,
                        'ColorCar_Cus' => NULL,
                        'GearCar_Cus' => NULL,
                        'YearCar_Cus' => NULL,
                        'PriceCar_Cus' => NULL,
                    ]);
                }

                $dataCar = data_car::where('Number_Regist',$request->get('Regist_Car'))->first();
                    $dataCar->F_DataCus_id = $id;
                    $dataCar->BookStatus_Car = $request->get('StatusCus');
                    $dataCar->DateStatus_Car = date('Y-m-d');
                $dataCar->update();

                $dataCus = dataCustomer::where('DataCus_id',$id)->first();
                if ($dataCus != NULL) {
                    $dataCus->Datacar_id = $dataCar->id;
                    $dataCus->update();
                }

            }
            elseif ($request->get('StatusCus') == 'ยกเลิกจอง') {
                $dataCar = data_car::where('F_DataCus_id', $id)->first();
                    if ($dataCar != NULL) {
                            $dataCar->F_DataCus_id = NULL;
                            $dataCar->BookStatus_Car = NULL;
                            $dataCar->DateStatus_Car = NULL;
                        $dataCar->update();
                    }

                $dataCus = dataCustomer::find($id);
                    $dataCus->RegistCar_Cus = NULL;
                    $dataCus->BrandCar_Cus = NULL;
                    $dataCus->VersionCar_Cus = NULL;
                    $dataCus->ColorCar_Cus = NULL;
                    $dataCus->GearCar_Cus = NULL;
                    $dataCus->YearCar_Cus = NULL;
                    $dataCus->PriceCar_Cus = NULL;
                $dataCus->update();
            }

            return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
        }
        elseif ($request->type == 2) {       //เพิ่ม รายการ Tracking
            $data = DB::table('tracking_cuses')
                ->where('F_DataCus_id', $id)
                ->orderBy('F_DataCus_id', 'desc')->limit(1)
                ->first();

            if ($data != NULL) {
                $dataTrack = tracking_cus::find($data->Tracking_id);
                    $dataTrack->Tag_Tracking = 'N';
                $dataTrack->update();
            }

            $dataTrack = new tracking_cus([
                'F_DataCus_id' => $id,
                'User_Tracking' => auth()->user()->name,
                'Date_Tracking' => $request->get('DateTrack'),
                'Status_Tracking' => $request->get('StatusTrack'),
                'Tag_Tracking' => 'Y',
                'Follow_Tracking' => $request->get('FollowTrack'),
                'Note_tracking' => $request->get('NoteTrack'),
              ]);
            $dataTrack->save();

            return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
        }
        elseif ($request->type == 3) {       //แก้ไข รายการ Tracking
            $dataTrack = tracking_cus::find($id);
                $dataTrack->Date_Tracking = $request->get('DateTrack');
                $dataTrack->Status_Tracking = $request->get('StatusTrack');
                $dataTrack->Follow_Tracking = $request->get('FollowTrack');
                $dataTrack->Note_tracking = $request->get('NoteTrack');
            $dataTrack->update();

            return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->type == 1) {           //ลบรายการ
            $item = dataCustomer::find($id);
            $dataCar = data_car::where('F_DataCus_id',$id)->first();

            if ($dataCar != NULL) {
                $dataCar->F_DataCus_id = NULL;
                $dataCar->BookStatus_Car = NULL;
                $dataCar->DateStatus_Car = NULL;

                $dataCar->update();
            }

            $item->Delete();
        }
        elseif ($request->type == 2) {       //ลบบันทึกการติดตาม
            $item = tracking_cus::find($id);
            $item->Delete();
        }

        return redirect()->back()->with('success','ลบข้อมูลเรียบร้อย');
    }

    public function ReportCustoms(Request $request, $type)
    {
        $newfdate = '';
        $newtdate = '';
        $PrintStatus = '';

        if ($request->has('Fromdate')) {
          $newfdate = $request->get('Fromdate');
        }
        if ($request->has('Todate')) {
          $newtdate = $request->get('Todate');
        }
        if ($request->has('CheckBook')) {
            $PrintStatus = $request->get('CheckBook');
        }
        
        if ($type == 1) {
            if ($request->Flag == 1) {
                $data = DB::table('data_customers')
                    ->leftJoin('data_cars','data_customers.DataCus_id','=','data_cars.F_DataCus_id')
                    ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                        return $q->whereBetween('data_customers.DateSale_Cus',[$newfdate,$newtdate]);
                    })
                    ->when(!empty($PrintStatus), function($q) use($PrintStatus){
                        return $q->where('data_customers.Status_Cus',$PrintStatus);
                      })
                    ->orderBy('data_customers.DataCus_id', 'ASC')
                    ->get();
    
                $view = \View::make('dataCus.report' ,compact(['data','newfdate','newtdate','PrintStatus']));
                $html = $view->render();
                $pdf = new PDF();
                $pdf::SetTitle('ข้อมูลลูกค้าทั้งหมด');
                $pdf::AddPage('L', 'A4');
                $pdf::SetFont('thsarabunpsk', '', 12, '', true);
                $pdf::SetMargins(5, 5, 5, 5);
                $pdf::SetAutoPageBreak(TRUE, 25);
                $pdf::WriteHTML($html,true,false,true,false,'');
                $pdf::Output('report.pdf');
            }
            elseif ($request->Flag == 2) {
                // $data = DB::table('data_customers')
                //     ->leftJoin('data_cars','data_customers.DataCus_id','=','data_cars.F_DataCus_id')
                //     ->when(!empty($newfdate)  && !empty($newtdate), function($q) use ($newfdate, $newtdate) {
                //         return $q->whereBetween('data_customers.DateSale_Cus',[$newfdate,$newtdate]);
                //     })
                //     ->orderBy('data_customers.DataCus_id', 'ASC')
                //     ->get();
                // $status = 'ข้อมูลลูกค้าทั้งหมด';

                // Excel::download('Research Customer', function ($excel) use($data,$status,$newfdate,$newtdate) {
                //     $excel->sheet($status, function ($sheet) use($data,$status) {
                //         $sheet->prependRow(1, array("บริษัท ชูเกียรติรถบ้าน จำกัด"));
                //         $sheet->prependRow(2, array($status."จากวันที่  ".$newfdate,"ถึงวันที่  ".$newtdate));
                //         $sheet->cells('A3:W3', function($cells) {
                //         $cells->setBackground('#FFCC00');
                //         });
                //         $row = 3;
                //         $sheet->row($row, array('ลำดับ','วันที่รับลูกค้า','ชื่อ-สกุล','ป้ายทะะเบียน',
                //             'สถานะลูกค้า','ประเภทลูกค้า',' แหล่งที่มาลูกค้า','รูปแบบลูกค้า','Sale รับลูกค้า'));
        
                //         foreach ($data as $key => $value) {
                //         $sheet->row(++$row, array(
                //             $key+1,
                //             $value->DateSale_Cus,
                //             $value->Name_Cus,
                //             $value->RegistCar_Cus,
                //             $value->Status_Cus,
                //             $value->Type_Cus,
                //             $value->Origin_Cus,
                //             $value->model_Cus,
                //             $value->Sale_Cus,
                //         ));
                //         }
                //     });
                // })->export('xlsx');

                return Excel::download(new UsersCusExport, 'ReportCustomer.xlsx');

            }
        }
        elseif($type == 2){
            if ($request->Flag == 11) { //PDF

            }
            elseif ($request->Flag == 22){ //Excel
                return Excel::download(new UsersCusExport, 'ReportCarsSale.xlsx');
            }
        }
    }
}
