<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Report</title>
  </head>
  <body style="margin-top: 0px">

    @php
    function DateThai($strDate)
      {
      //$strYear = date("Y",strtotime($strDate))+543;
      $strYear = date("Y",strtotime($strDate));
      $strMonth= date("n",strtotime($strDate));
      $strDay= date("d",strtotime($strDate));

      //$strMonthCut = Array("" , "ม.ค","ก.พ","มี.ค","เม.ย","พ.ค","มิ.ย","ก.ค","ส.ค","ก.ย","ต.ค","พ.ย","ธ.ค");
      $strMonthCut = Array("" , "01","02","03","04","05","06","07","08","09","10","11","12");
      $strMonthThai=$strMonthCut[$strMonth];

      //return "$strDay $strMonthThai $strYear";
      return "$strDay-$strMonthThai-$strYear";
      }

      $DateNew = date('d-m-Y');

    @endphp

    วันที่ {{ DateThai($DateNew)}}
    <hr>
    @if( $ReportType == 1)
      <h2 class="card-title p-3" align="center" style="font-weight: bold;line-height:10px;">รายการรถยนต์ทั้งหมด</h2>
      @if($fdate != null)
        @php
          $Fdate = date_create($fdate);
          $Tdate = date_create($tdate);
        @endphp
        <h5 class="card-title p-3" align="center">ระหว่างวันที่ {{date_format($Fdate, 'd-m-Y')}} ถึงวันที่ {{date_format($Tdate, 'd-m-Y')}}</h5>
      @endif
    @elseif($ReportType == 5)
      <b align="center"><h2>รายการรถยนต์พร้อมขาย</h2></b>
    @else
      <h2 class="card-title p-3" align="center" style="font-weight: bold;line-height:10px;">รายการรถยนต์ขายแล้ว</h2>
      @if($fdate != null)
        @php
          $Fdate = date_create($fdate);
          $Tdate = date_create($tdate);
        @endphp
        <h5 class="card-title p-3" align="center">ระหว่างวันที่ {{date_format($Fdate, 'd-m-Y')}} ถึงวันที่ {{date_format($Tdate, 'd-m-Y')}}</h5>
      @endif
    @endif

    @if( $ReportType == 1 && $AdminType != 1)
      <table border="1">
        <thead>
          <tr align="center">
          <th class="text-center" width="30px"><b>ลำดับ</b></th>
          <th class="text-center" width="70px"><b>วันที่ซื้อ</b></th>
          <th class="text-center" width="60px"><b>ระยะเวลา</b></th>
          <th class="text-center" width="70px"><b>ทะเบียน</b></th>
          <th class="text-center" width="80px"><b>ยี่ห้อ</b></th>
          <th class="text-center" width="70px"><b>รุ่น</b></th>
          <th class="text-center" width="70px"><b>ลักษณะ</b></th>
          <th class="text-center" width="30px"><b>เกียร์</b></th>
          <th class="text-center" width="60px"><b>สี</b></th>
          <th class="text-center" width="40px"><b>ปี</b></th>
          <th class="text-center"width="40px"><b>CC</b></th>
          <th class="text-center" width="60px"><b>ประเภท</b></th>
          <th class="text-center"width="100px"><b>สถานะ</b></th>
          </tr>
        </thead>

      <tbody>

      @foreach($dataReport as $key => $value)
      @php
      $create_date = date_create($value->create_date);
      $Date_NumberUser = date_create($value->Date_NumberUser);
      @endphp
      <tr align="center">
      <td width="30px">{{ $key+1 }}</td>
      <td width="70px">{{ date_format($create_date, 'd-m-Y')}}</td>
      <td width="60px">
      @php
      date_default_timezone_set('Asia/Bangkok');
      $Y = date('Y') + 543;
      $m = date('m');
      $d = date('d');
      $ifdate = $Y.'-'.$m.'-'.$d;
      @endphp

      @if($ifdate > $value->create_date && $value->Date_Sale == Null)
      @php
      $Cldate = date_create($value->create_date);
      $nowCldate = date_create($ifdate);
      $ClDateDiff = date_diff($Cldate,$nowCldate);
      @endphp

      {{$ClDateDiff->format("%a วัน")}}

      @elseif($value->Date_Sale != Null)
      @php
      $Cldate = date_create($value->create_date);
      $nowCldate = date_create($value->Date_Sale);
      $ClDateDiff = date_diff($Cldate,$nowCldate);
      @endphp

      {{$ClDateDiff->format("%a วัน")}}
      @endif
      </td>
      <td width="70px">{{$value->Number_Regist}}</td>
      <td width="80px">{{$value->Brand_Car}}</td>
      <td width="70px">{{$value->Version_Car}}</td>
      <td width="70px">{{$value->Model_Car}}</td>
      <td width="30px">{{$value->Gearcar}}</td>
      <td width="60px">{{$value->Color_Car}}</td>
      <td width="40px">{{$value->Year_Product}}</td>
      <td width="40px">{{$value->Size_Car}}</td>
      <td width="60px">
      @if($value->Origin_Car == 1)
      CKL
      @elseif ($value->Origin_Car  == 2)
      รถประมูล
      @elseif ($value->Origin_Car  == 3)
      รถยึด
      @elseif ($value->Origin_Car  == 4)
      ฝากขาย
      @endif
      </td>
      <td width="100px">
      @if($value->Car_type == 1)
      นำเข้าใหม่ @if($value->BorrowStatus == 1) (ยืม) @endif
      @elseif ($value->Car_type  == 2)
      ระหว่างทำสี @if($value->BorrowStatus == 1) (ยืม) @endif
      @elseif ($value->Car_type  == 3)
      รอซ่อม @if($value->BorrowStatus == 1) (ยืม) @endif
      @elseif ($value->Car_type  == 4)
      ระหว่างซ่อม @if($value->BorrowStatus == 1) (ยืม) @endif
      @elseif ($value->Car_type  == 5)
      พร้อมขาย @if($value->BorrowStatus == 1) (ยืม) @endif
      @elseif ($value->Car_type  == 6)
      ขายแล้ว
      @endif
      </td>
      </tr>
      @endforeach
      </tbody>
      </table>
    @endif

    @if( $ReportType == 1 && $AdminType == 1)
        <table border="1">
            <thead>
                <tr align="center">
                <th class="text-center" width="30px"><b>ลำดับ</b></th>
                <th class="text-center" width="60px"><b>วันที่ซื้อ</b></th>
                <th class="text-center" width="50px"><b>ระยะเวลา</b></th>
                <th class="text-center" width="70px"><b>ทะเบียน</b></th>
                <th class="text-center" width="75px"><b>ยี่ห้อ</b></th>
                <th class="text-center" width="67px"><b>รุ่น</b></th>
                <th class="text-center" width="70px"><b>ลักษณะ</b></th>
                <th class="text-center" width="30px"><b>เกียร์</b></th>
                <th class="text-center" width="60px"><b>สี</b></th>
                <th class="text-center" width="35px"><b>ปี</b></th>
                <th class="text-center"width="35px"><b>CC</b></th>
                <th class="text-center"width="65px"><b>ราคาต้นทุน</b></th>
                <th class="text-center" width="60px"><b>ประเภท</b></th>
                <th class="text-center"width="83px"><b>สถานะ</b></th>
                </tr>
            </thead>

            <tbody>

            @foreach($dataReport as $key => $value)
            @php
            $create_date = date_create($value->create_date);
            $Date_NumberUser = date_create($value->Date_NumberUser);
            @endphp
              <tr align="center">
                <td width="30px">{{ $key+1 }}</td>
                <td width="60px">{{ date_format($create_date, 'd-m-Y')}}</td>
                <td width="50px">
                @php
                date_default_timezone_set('Asia/Bangkok');
                $Y = date('Y') + 543;
                $m = date('m');
                $d = date('d');
                $ifdate = $Y.'-'.$m.'-'.$d;
                @endphp

                @if($ifdate > $value->create_date && $value->Date_Sale == Null)
                @php
                $Cldate = date_create($value->create_date);
                $nowCldate = date_create($ifdate);
                $ClDateDiff = date_diff($Cldate,$nowCldate);
                @endphp

                {{$ClDateDiff->format("%a วัน")}}

                @elseif($value->Date_Sale != Null)
                @php
                $Cldate = date_create($value->create_date);
                $nowCldate = date_create($value->Date_Sale);
                $ClDateDiff = date_diff($Cldate,$nowCldate);
                @endphp

                {{$ClDateDiff->format("%a วัน")}}
                @endif
                </td>
                <td width="70px">{{$value->Number_Regist}}</td>
                <td width="75px">{{$value->Brand_Car}}</td>
                <td width="67px">{{$value->Version_Car}}</td>
                <td width="70px">{{$value->Model_Car}}</td>
                <td width="30px">{{$value->Gearcar}}</td>
                <td width="60px">{{$value->Color_Car}}</td>
                <td width="35px">{{$value->Year_Product}}</td>
                <td width="35px">{{$value->Size_Car}}</td>
                
                  @if($value->Fisrt_Price == null)
                    @php 
                    $FirstPrice = 0;
                    @endphp
                  @else
                    @php 
                    $FirstPrice = $value->Fisrt_Price;
                    @endphp
                  @endif

                  @if($value->Repair_Price == null)
                    @php 
                    $RepairPrice = 0;
                    @endphp
                  @else
                    @php 
                    $RepairPrice = $value->Repair_Price;
                    @endphp
                  @endif

                  @if($value->Offer_Price == null)
                    @php 
                    $OfferPrice = 0;
                    @endphp
                  @else
                    @php 
                    $OfferPrice = $value->Offer_Price;
                    @endphp
                  @endif

                  @if($value->Color_Price == null)
                    @php 
                    $ColorPrice = 0;
                    @endphp
                  @else
                    @php 
                    $ColorPrice = $value->Color_Price;
                    @endphp
                  @endif

                  @if($value->Add_Price == null)
                    @php 
                    $AddPrice = 0;
                    @endphp
                  @else
                    @php 
                    $AddPrice = $value->Add_Price;
                    @endphp
                  @endif
                
                <td width="65px">{{number_format($FirstPrice+$RepairPrice+$OfferPrice+$ColorPrice+$AddPrice, 2)}}</td>
                <td width="60px">
                @if($value->Origin_Car == 1)
                CKL
                @elseif ($value->Origin_Car  == 2)
                รถประมูล
                @elseif ($value->Origin_Car  == 3)
                รถยึด
                @elseif ($value->Origin_Car  == 4)
                ฝากขาย
                @endif
                </td>
                <td width="83px">
                @if($value->Car_type == 1)
                นำเข้าใหม่ @if($value->BorrowStatus == 1) (ยืม) @endif
                @elseif ($value->Car_type  == 2)
                ระหว่างทำสี @if($value->BorrowStatus == 1) (ยืม) @endif
                @elseif ($value->Car_type  == 3)
                รอซ่อม @if($value->BorrowStatus == 1) (ยืม) @endif
                @elseif ($value->Car_type  == 4)
                ระหว่างซ่อม @if($value->BorrowStatus == 1) (ยืม) @endif
                @elseif ($value->Car_type  == 5)
                พร้อมขาย @if($value->BorrowStatus == 1) (ยืม) @endif
                @elseif ($value->Car_type  == 6)
                ขายแล้ว
                @endif
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    @endif

    @if( $ReportType != 1)
        <table border="1">
            <thead>
              <tr align="center">
                <th class="text-center" width="30px"><b>ลำดับ</b></th>
                <th class="text-center" width="70px"><b>วันที่ซื้อ</b></th>
                <th class="text-center" width="50px"><b>ระยะเวลา</b></th>
                <th class="text-center" width="75px"><b>ทะเบียน</b></th>
                <th class="text-center" width="75px"><b>ยี่ห้อ</b></th>
                <th class="text-center" width="70px"><b>รุ่น</b></th>
                <th class="text-center" width="70px"><b>ลักษณะ</b></th>
                <th class="text-center" width="40px"><b>เกียร์</b></th>
                <th class="text-center" width="65px"><b>สี</b></th>
                <th class="text-center" width="30px"><b>ปี</b></th>
                <th class="text-center" width="30px"><b>CC</b></th>
                <th class="text-center" width="65px"><b>ประเภท</b></th>
                <th class="text-center"width="65px"><b>สถานะ</b></th>
                <th class="text-center" width="65px"><b>ราคาขาย</b></th>
              </tr>
            </thead>

        <tbody>

        @foreach($dataReport as $key => $value)
        @php
        $create_date = date_create($value->create_date);
        $Date_NumberUser = date_create($value->Date_NumberUser);
        @endphp
            <tr align="center">
              <td width="30px">{{ $key+1 }}</td>
              <td width="70px">{{ date_format($create_date, 'd-m-Y')}}</td>
              <td width="50px">
              @php
              date_default_timezone_set('Asia/Bangkok');
              $Y = date('Y') + 543;
              $m = date('m');
              $d = date('d');
              $ifdate = $Y.'-'.$m.'-'.$d;
              @endphp

              @if($ifdate > $value->create_date)
              @php
              $Cldate = date_create($value->create_date);
              $nowCldate = date_create($ifdate);
              $ClDateDiff = date_diff($Cldate,$nowCldate);
              @endphp

              {{$ClDateDiff->format("%a วัน")}}

              @elseif($value->Date_Sale != Null)
              @php
              $Cldate = date_create($value->create_date);
              $nowCldate = date_create($value->Date_Sale);
              $ClDateDiff = date_diff($Cldate,$nowCldate);
              @endphp

              {{$ClDateDiff->format("%a วัน")}}

              @endif
              </td>
              <td width="75px">{{$value->Number_Regist}}</td>
              <td width="75px">{{$value->Brand_Car}}</td>
              <td width="70px">{{$value->Version_Car}}</td>
              <td width="70px">{{$value->Model_Car}}</td>
              <td width="40px">{{$value->Gearcar}}</td>
              <td width="65px">{{$value->Color_Car}}</td>
              <td width="30px">{{$value->Year_Product}}</td>
              <td width="30px">{{$value->Size_Car}}</td>
              <td width="65px">
              @if($value->Origin_Car == 1)
              CKL
              @elseif ($value->Origin_Car  == 2)
              รถประมูล
              @elseif ($value->Origin_Car  == 3)
              รถยึด
              @elseif ($value->Origin_Car  == 4)
              ฝากขาย
              @endif
              </td>
              <td width="65px">
              @if($value->Car_type == 1)
              นำเข้าใหม่
              @elseif ($value->Car_type  == 2)
              ระหว่างทำสี
              @elseif ($value->Car_type  == 3)
              รอซ่อม
              @elseif ($value->Car_type  == 4)
              ระหว่างซ่อม
              @elseif ($value->Car_type  == 5)
              พร้อมขาย
              @elseif ($value->Car_type  == 6)
              ขายแล้ว
              @endif
              </td>
              <td width="65px">{{number_format($value->Net_Price)}}</td>
            </tr>
        @endforeach
        </tbody>
        </table>
    @endif

  </body>
</html>
