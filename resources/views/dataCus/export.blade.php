@php
    function DateThai($strDate)
    {
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("d",strtotime($strDate));

    $strMonthCut = Array("" , "ม.ค","ก.พ","มี.ค","เม.ย","พ.ค","มิ.ย","ก.ค","ส.ค","ก.ย","ต.ค","พ.ย","ธ.ค");
    $strMonthThai=$strMonthCut[$strMonth];

    return "$strDay $strMonthThai $strYear";
    //return "$strDay-$strMonthThai-$strYear";
    }

    //dd($data);
@endphp

@if($Flag == 2) {{-- excel research customer--}}
    <table>
        <tr>
        <td><b>ข้อมูลลูกค้าทั้งหมด</b></td>
        </tr>
        <tr>
        <td><b>ระหว่างวันที่ {{DateThai($newfdate)}} ถึงวันที่ {{DateThai($newtdate)}}</b></td>
        </tr>
    </table>
    <table>
        <thead>
        <tr>
            <th><b>ลำดับ</b></th>
            <th><b>วันที่รับลูกค้า</b></th>
            <th><b>ชื่อ-สกุลลูกค้า</b></th>
            <th><b>เบอร์ติดต่อ</b></th>
            <th><b>บัตร ปชช.</b></th>
            <th><b>ที่อยู่</b></th>
            <th><b>จังหวัด</b></th>
            <th><b>รหัสไปรษณีย์</b></th>
            <th><b>อาชีพ</b></th>
            <th><b>อีเมล์</b></th>
            <th><b>แหล่งที่มาลูกค้า</b></th>
            <th><b>รูปแบบลูกค้า</b></th>
            <th><b>เซลล์รับลูกค้า</b></th>
            <th><b>เงินจอง(มัดจำ)</b></th>
            <th><b>สถานะลูกค้า</b></th>
            <th><b>ประเภทลูกค้า</b></th>
            <th><b>ป้ายทะเบียนรถ</b></th>
            <th><b>ยี่ห้อรถ</b></th>
            <th><b>รุ่นรถ</b></th>
            <th><b>สีรถ</b></th>
            <th><b>เกียร์รถ</b></th>
            <th><b>ปีรถ</b></th>
            <!-- <th>วันที่ขาย</th>
            <th>ราคาขาย</th>
            <th>ประเภทขาย</th>
            <th>ยอดจัด</th>
            <th>เซลล์ขาย</th>
            <th>ผู้ซื้อ</th>
            <th>เงินดาวน์</th>
            <th>เงินซับดาวน์</th>
            <th>ค่าใช้จ่ายโอน</th>
            <th>ค่าประกัน</th> -->
        </tr>
        </thead>
        <tbody>
        @foreach($data as $key => $value)
            @php
                $DateSale_Cus = date_create($value->DateSale_Cus);
                $DateSale_Cus = date_format($DateSale_Cus, 'd-m-Y');
            @endphp
            <tr>
                <td>{{ $key + 1  }}</td>
                <td> {{ $DateSale_Cus}}</td>
                <td>{{ $value->Name_Cus }}</td>
                <td>{{ $value->Phone_Cus }}</td>
                <td>{{ $value->IDCard_Cus }}</td>
                <td>{{ $value->Address_Cus }}</td>
                <td>{{ $value->Province_Cus }}</td>
                <td>{{ $value->Zip_Cus }}</td>
                <td>{{ $value->Career_Cus }}</td>
                <td>{{ $value->Email_Cus }}</td>
                <td>{{ $value->Origin_Cus }}</td>
                <td>{{ $value->model_Cus }}</td>
                <td>{{ $value->Sale_Cus }}</td>
                <td>{{ $value->CashStatus_Cus }}</td>
                <td>{{ $value->Status_Cus }}</td>
                <td>{{ $value->Type_Cus }}</td>
                <td>{{ $value->RegistCar_Cus }}</td>
                <td>{{ $value->BrandCar_Cus }}</td>
                <td>{{ $value->VersionCar_Cus }}</td>
                <td>{{ $value->ColorCar_Cus }}</td>
                <td>{{ $value->GearCar_Cus }}</td>
                <td>{{ $value->YearCar_Cus }}</td>
                <!-- <td>{{ $value->Date_Soldout }}</td>
                <td>{{ $value->Net_Priceplus }}</td>
                <td>{{ $value->Type_Sale }}</td>
                <td>{{ $value->Topcar_Price }}</td>
                <td>{{ $value->Name_Saleplus }}</td>
                <td>{{ $value->Name_Buyer }}</td>
                <td>{{ $value->Down_Price }}</td>
                <td>{{ $value->Subdown_Price }}</td>
                <td>{{ $value->Transfer_Price }}</td>
                <td>{{ $value->Insurance_Price }}</td> -->
            </tr>
        @endforeach
        </tbody>
    </table>
@elseif($Flag == 22) {{-- excel soldout cars --}}
    <table>
        <tr>
        <td><b>รถยนต์ขายแล้วทั้งหมด</b></td>
        </tr>
        @php 
            $Newfdate = date_create($newfdate);
            $Newfdate = date_format($Newfdate, 'd-m-Y');
            $Newtdate = date_create($newtdate);
            $Newtdate = date_format($Newtdate, 'd-m-Y');
        @endphp
        <tr>
        <td><b>ระหว่างวันที่ {{$Newfdate}} ถึงวันที่ {{$Newtdate}}</b></td>
        </tr>
    </table>
    <table>
        <thead>
        <tr>
            <th><b>ลำดับ</b></th>
            <th><b>วันที่ขาย</b></th>
            <th><b>ป้ายทะเบียนรถ</b></th>
            <th><b>ยี่ห้อรถ</b></th>
            <th><b>รุ่นรถ</b></th>
            <th><b>ประเถทรถ</b></th>
            <th><b>สีรถ</b></th>
            <th><b>เกียร์รถ</b></th>
            <th><b>ขนาดรถ (cc.)</b></th>
            <th><b>ปีรถ</b></th>
            <th><b>ราคาขาย</b></th>
            <th><b>ประเภทขาย</b></th>
            <th><b>ยอดจัด</b></th>
            <th><b>เซลล์ขาย</b></th>
            <th><b>ผู้ซื้อ</b></th>
            <th><b>เงินดาวน์</b></th>
            <th><b>เงินซับดาวน์</b></th>
            <th><b>ค่าใช้จ่ายโอน</b></th>
            <th><b>ค่าประกัน</b></th>
            <th><b>ราคาเปิดประมูล</b></th>
            <th><b>ราคาปิดประมูล</b></th>
            <th><b>ค่านายหน้า</b></th>
            <th><b>ชื่อ-สกุลนายหน้า</b></th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $key => $value)
            @php
                $Date_Soldout = date_create($value->Date_Soldout);
                $Date_Soldout = date_format($Date_Soldout, 'd-m-Y');
                @$TotalNet_Priceplus += $value->Net_Priceplus;
                @$TotalTopcar_Price += $value->Topcar_Price;
                @$TotalDown_Price += $value->Down_Price;
                @$TotalSubdown_Price += $value->Subdown_Price;
                @$TotalTransfer_Price += $value->Transfer_Price;
                @$TotalInsurance_Price += $value->Insurance_Price;
                @$TotalOpen_auction += $value->Open_auction;
                @$TotalClose_auction += $value->Close_auction;
                @$TotalAmount_Price += $value->Amount_Price;
            @endphp
            <tr>
                <td>{{ $key + 1  }}</td>
                <td>{{ $Date_Soldout }}</td>
                <td>{{ $value->Number_Regist }}</td>
                <td>{{ $value->Brand_Car }}</td>
                <td>{{ $value->Version_Car }}</td>
                <td>{{ $value->Model_Car }}</td>
                <td>{{ $value->Color_Car }}</td>
                <td>{{ $value->Gearcar }}</td>
                <td>{{ $value->Size_Car }}</td>
                <td>{{ $value->Year_Product }}</td>
                <td>{{ $value->Net_Priceplus }}</td>
                <td>{{ $value->Type_Sale }}</td>
                <td>{{ $value->Topcar_Price }}</td>
                <td>{{ $value->Name_Saleplus }}</td>
                <td>{{ $value->Name_Buyer }}</td>
                <td>{{ $value->Down_Price }}</td>
                <td>{{ $value->Subdown_Price }}</td>
                <td>{{ $value->Transfer_Price }}</td>
                <td>{{ $value->Insurance_Price }}</td>
                <td>{{ $value->Open_auction }}</td>
                <td>{{ $value->Close_auction }}</td>
                <td>{{ $value->Amount_Price }}</td>
                <td>{{ $value->Name_Agent }}</td>
            </tr>
        @endforeach
            <!-- <tr>
                <td colspan="21"></td>
            </tr>
            <tr>
                <td colspan="10"></td>
                <td>{{$TotalNet_Priceplus}}</td>
                <td></td>
                <td>{{$TotalTopcar_Price}}</td>
                <td colspan="2"></td>
                <td>{{$TotalDown_Price}}</td>
                <td>{{$TotalSubdown_Price}}</td>
                <td>{{$TotalTransfer_Price}}</td>
                <td>{{$TotalInsurance_Price}}</td>
                <td>{{$TotalOpen_auction}}</td>
                <td>{{$TotalClose_auction}}</td>
                <td>{{$TotalAmount_Price}}</td>
            </tr> -->
        </tbody>
    </table>
@endif