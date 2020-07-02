<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\dataCustomer;
use App\data_car;

class ResearchCusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->type == 1) {
            $data = DB::table('data_customers')
                    ->orderBy('data_customers.DataCus_id', 'ASC')
                    ->get();

            $type = $request->type;
            return view('dataCus.view', compact('data','type'));
        }
        elseif ($request->type == 2) {
            $data = DB::table('data_cars')
                    ->where('data_cars.car_type','<>',6)
                    ->orderBy('data_cars.create_date', 'ASC')
                    ->get();

            // dd($data);
            $type = $request->type;
            return view('dataCus.create', compact('type','data'));
        }
        elseif ($request->type == 3) {

            $type = $request->type;
            return view('dataCus.createTracking', compact('type'));
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
                    $output ='<div class="row">
                                <div class="col-6">
                                    <div class="form-group row mb-0">
                                    <label class="col-sm-3 col-form-label text-right">ยี่ห้อ : </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="BrandCar" class="form-control" style="height:30px;" value="'.$row->Brand_Car.'" readonly/>
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
                                        <input type="text" name="YearCar" class="form-control" style="height:30px;" value="'.number_format($row->Net_Price, 2).'" readonly/>
                                    </div>
                                </div>
                            </div>
                        </div>';
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
    public function store(Request $request, $type)
    {
        if ($type == 1) {       //เพิ่มรายการ ลูกค้า
            // dd($request);
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

            $dataCus = new dataCustomer([
                'Name_Cus' => $request->get('NameCus'),
                'Phone_Cus' =>  $request->get('PhoneCus'),
                'Address_Cus' =>  $request->get('AddressCus'),
                'Province_Cus' =>  $request->get('ProvinceCus'),
                'Zip_Cus' =>  $request->get('ZipCus'),
                'Career_Cus' =>  $request->get('CareerCus'),
                'Email_Cus' => $request->get('EmailCus'),
                'Origin_Cus' => $request->get('OriginCus'),
                'model_Cus' => $request->get('modelCus'),
                'Sale_Cus' => $request->get('SaleCus'),
                'DateSale_Cus' => $request->get('DateSaleCus'),
                'Status_Cus' => $request->get('StatusCus'),
                'DateStatus_Cus' => $SetDateStatus,
                'Type_Cus' => $request->get('TypeCus'),
                'DateType_Cus' => $SetDateType,
              ]);
            $dataCus->save();

            if ($request->get('RegisterCar') != NULL) {
                $dataCars = data_car::find($request->RegisterCar);
                    $dataCars->F_DataCus_id = $dataCus->DataCus_id;
                    $dataCars->BookStatus_Car = $request->get('StatusCus');
                    $dataCars->DateStatus_Car = $SetDateStatus;
                $dataCars->update();
            }
            return redirect()->Route('ResearchCus',$type)->with('success','บันทึกข้อมูลเรียบร้อย');
        }
        elseif ($type == 2) {   //เพิ่ม Tracking
            // dd('sdf');
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
    public function edit(Request $request ,$id, $type)
    {
        if ($type == 1) { 
            $data = DB::table('data_customers')
                        ->leftJoin('data_cars','data_customers.DataCus_id','=','data_cars.F_DataCus_id')
                        ->where('data_customers.DataCus_id',$id)
                        ->first();

             return view('dataCus.edit', compact('data','id','type'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $type)
    {
        if ($type == 1) {

        //ข้อมูลลูกค้า
        $dataCus = dataCustomer::find($id);
            $dataCus->Name_Cus = $request->get('NameCus');
            $dataCus->Phone_Cus = $request->get('PhoneCus');
            $dataCus->Address_Cus = $request->get('AddressCus');
            $dataCus->Province_Cus = $request->get('ProvinceCus');
            $dataCus->Zip_Cus = $request->get('ZipCus');
            $dataCus->Career_Cus = $request->get('CareerCus');
            $dataCus->Email_Cus = $request->get('EmailCus');
            $dataCus->Origin_Cus = $request->get('OriginCus');
            $dataCus->model_Cus = $request->get('modelCus');
            $dataCus->Sale_Cus = $request->get('SaleCus');
            $dataCus->DateSale_Cus = $request->get('DateSaleCus');

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
        $dataCus->update();

        //รถที่ต้องการ & ค่าใช้จ่ายออกรถ
        $dataCar = data_car::where('F_DataCus_id',$id)->where('Car_type', 20)->first();
            $dataCar->Brand_Car = $request->get('BrandCar');
            $dataCar->Version_Car = $request->get('VersionCar');
            $dataCar->Color_Car = $request->get('ColorCar');
            $dataCar->Gearcar = $request->get('GearCar');
            $dataCar->Year_Product = $request->get('YearCar');

            if($request->get('CashCar') != NULL){
                $dataCar->Net_Price = str_replace (",","",$request->get('CashCar'));
            }else{
                $dataCar->Net_Price = NULL;
            }
            if($request->get('CashdownCar') != Null){
                $dataCar->Down_Price = str_replace (",","",$request->get('CashdownCar'));
            }else{
                $dataCar->Down_Price  = Null;
            }
            $dataCar->Interest_Car = $request->get('InterestCar');
            $dataCar->Period_Car = $request->get('PeriodCar');

            if($request->get('PaymentCar') != Null){
                $dataCar->Payment_Car = str_replace (",","",$request->get('PaymentCar'));
            }else{
                $dataCar->Payment_Car = Null;
            }
            $dataCar->Note_Car = $request->get('NoteCar');

            //ค่าใช้จ่ายออกรถ
            if($request->get('By_CashDown') != Null){
                $dataCar->Subdown_Price = str_replace (",","",$request->get('By_CashDown'));
            }else{
                $dataCar->Subdown_Price = Null;
            }
            if($request->get('By_Transfer') != Null){
                $dataCar->Transfer_Price = str_replace (",","",$request->get('By_Transfer'));
            }else{
                $dataCar->Transfer_Price = Null;
            }
            if($request->get('By_Register') != Null){
                $dataCar->Regis_Price = str_replace (",","",$request->get('By_Register'));
            }else{
                $dataCar->Regis_Price = Null;
            }
            if($request->get('By_Act') != Null){
                $dataCar->Act_Price = str_replace (",","",$request->get('By_Act'));
            }else{
                $dataCar->Act_Price = Null;
            }
            if($request->get('SumPrice') != Null){
                $dataCar->Topcar_Price = str_replace (",","",$request->get('SumPrice'));
            }else{
                $dataCar->Topcar_Price = Null;
            }
        $dataCar->update();

        //รถแลกเปลี่ยน
        $dataCar = data_car::where('F_DataCus_id',$id)->where('Car_type', 21)->first();
            $dataCar->Brand_Car = $request->get('Turn_BrandCar');
            $dataCar->Version_Car = $request->get('Turn_VersionCar');
            $dataCar->Color_Car = $request->get('Turn_ColorCar');
            $dataCar->Gearcar = $request->get('Turn_GearCar');
            $dataCar->Year_Product = $request->get('Turn_YearCar');
            $dataCar->Number_Miles = $request->get('Turn_MileCar');
            $dataCar->Inside_Car = $request->get('Turn_InsideCar');
            $dataCar->Outside_Car = $request->get('Turn_OutsideCar');

            if($request->get('Turn_WantPriceCar') != Null){
                $dataCar->Fisrt_Price = str_replace (",","",$request->get('Turn_WantPriceCar'));
            }else{
                $dataCar->Fisrt_Price = Null;
            }
            if($request->get('Turn_ComPriceCar') != Null){
                $dataCar->Offer_Price = str_replace (",","",$request->get('Turn_ComPriceCar'));
            }else{
                $dataCar->Offer_Price = Null;
            }
            $dataCar->Note_Car = $request->get('Turn_anotherCar');
        $dataCar->update();
  
          return redirect()->back()->with('success','บันทึกข้อมูลเรียบร้อยแล้ว');
        }
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
}
