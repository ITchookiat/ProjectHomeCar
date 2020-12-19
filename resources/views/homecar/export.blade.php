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
    $strYear = date("Y",strtotime($strDate));
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("d",strtotime($strDate));
    $strMonthCut = Array("" , "01","02","03","04","05","06","07","08","09","10","11","12");
    $strMonthThai=$strMonthCut[$strMonth];

    return "$strDay-$strMonthThai-$strYear";
    }

    $DateNew = date('d-m-Y');
  @endphp

    วันที่ปริ้น {{ DateThai($DateNew)}}
    <hr>

    @if($ReportType == 1)
      <h2 class="card-title p-3" align="center" style="font-weight: bold;line-height:5px;">รายการ {{$txtType}} ({{$txtorigin}})</h2>
      @if($fdate != null)
        @php
          $Fdate = date_create($fdate);
          $Tdate = date_create($tdate);
        @endphp
        <h3 class="card-title p-3" align="center" style="font-weight: bold;line-height:10px;">ระหว่างวันที่ {{date_format($Fdate, 'd-m-Y')}} ถึงวันที่ {{date_format($Tdate, 'd-m-Y')}}</h3>
      @else
        <h3 style="font-weight: bold;line-height:10px;"> </h3>
      @endif

      @if($AdminType == 2)
        <table border="1">
          <thead>
            <tr align="center" style="background-color:#B7B8AE;line-height:150%;">
              <th class="text-center" width="30px"><b>ลำดับ</b></th>
              <th class="text-center" width="60px"><b>วันที่ซื้อ</b></th>
              <th class="text-center" width="45px"><b>ระยะเวลา</b></th>
              <th class="text-center" width="65px"><b>ทะเบียน</b></th>
              <th class="text-center" width="60px"><b>ยี่ห้อ</b></th>
              <th class="text-center" width="65px"><b>รุ่น</b></th>
              <th class="text-center" width="60px"><b>ลักษณะ</b></th>
              <th class="text-center" width="30px"><b>เกียร์</b></th>
              <th class="text-center" width="55px"><b>สี</b></th>
              <th class="text-center" width="35px"><b>ปี</b></th>
              <th class="text-center"width="35px"><b>CC</b></th>
              <th class="text-center"width="70px"><b>ราคาต้นทุน</b></th>
              <th class="text-center" width="55px"><b>ที่มา</b></th>
              <th class="text-center"width="85px"><b>สถานะ</b></th>
              @if($txtType == 'รถพร้อมขาย')
                <th class="text-center"width="50px"><b>ราคาตั้งขาย</b></th>
              @elseif($txtType == 'รถขายแล้ว')
                <th class="text-center"width="50px"><b>ราคาขาย</b></th>
              @else
                <th class="text-center"width="50px"><b>การจอง</b></th>
              @endif
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
                <td width="45px">
                  @php
                    date_default_timezone_set('Asia/Bangkok');
                    $Y = date('Y') + 543;
                    $m = date('m');
                    $d = date('d');
                    $ifdate = $Y.'-'.$m.'-'.$d;
                  @endphp

                  @if($ifdate > $value->create_date && $value->Date_Soldout == Null)
                    @php
                      $Cldate = date_create($value->create_date);
                      $nowCldate = date_create($ifdate);
                      $ClDateDiff = date_diff($Cldate,$nowCldate);
                    @endphp
                    {{$ClDateDiff->format("%a วัน")}}

                  @elseif($value->Date_Soldout != Null)
                    @php
                      $Cldate = date_create($value->create_date);
                      $nowCldate = date_create($value->Date_Sale);
                      $ClDateDiff = date_diff($Cldate,$nowCldate);
                    @endphp
                    {{$ClDateDiff->format("%a วัน")}}
                  @endif
                </td>
                <td width="65px">{{$value->Number_Regist}}</td>
                <td width="60px">{{$value->Brand_Car}}</td>
                <td width="65px">{{$value->Version_Car}}</td>
                <td width="60px">{{$value->Model_Car}}</td>
                <td width="30px">{{$value->Gearcar}}</td>
                <td width="55px">{{$value->Color_Car}}</td>
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

                  @php 
                    @$TotalCapital += $FirstPrice+$RepairPrice+$OfferPrice+$ColorPrice+$AddPrice;
                  @endphp
                <td align="right" width="70px">{{number_format($FirstPrice+$RepairPrice+$OfferPrice+$ColorPrice+$AddPrice, 2)}} &nbsp;</td>
                <td width="55px">
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
                <td width="85px">
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
                  @elseif ($value->Car_type  == 7)
                    ส่งประมูล
                  @endif
                </td>
                <td width="50px">
                  @if($txtType == 'รถพร้อมขาย')
                    {{number_format($value->Net_Price)}}
                  @elseif($txtType == 'รถขายแล้ว')
                    {{number_format($value->Net_Priceplus)}}
                  @else
                    @if($value->BookStatus_Car == 'จอง')
                      ลูกค้าจอง
                    @endif
                  @endif
                </td>
              </tr>
            @endforeach
            <tr>
              <td width="540px" align="right"><b>รวมราคาต้นทุน &nbsp;</b></td>
              <td width="70px" align="right"><b>{{number_format(@$TotalCapital,2)}} &nbsp;</b></td>
              <td width="190px"> <b>บาท</b></td>
            </tr>
          </tbody>
        </table>
      @elseif($AdminType == 1)  
        <table border="1">
          <thead>
            <tr align="center" style="background-color:#B7B8AE;line-height:150%;">
            <th class="text-center" width="30px"><b>ลำดับ</b></th>
            <th class="text-center" width="60px"><b>วันที่ซื้อ</b></th>
            <th class="text-center" width="60px"><b>ระยะเวลา</b></th>
            <th class="text-center" width="70px"><b>ทะเบียน</b></th>
            <th class="text-center" width="70px"><b>ยี่ห้อ</b></th>
            <th class="text-center" width="70px"><b>รุ่น</b></th>
            <th class="text-center" width="70px"><b>ลักษณะ</b></th>
            <th class="text-center" width="30px"><b>เกียร์</b></th>
            <th class="text-center" width="60px"><b>สี</b></th>
            <th class="text-center" width="40px"><b>ปี</b></th>
            <th class="text-center"width="40px"><b>CC</b></th>
            <th class="text-center" width="60px"><b>ที่มา</b></th>
            <th class="text-center"width="90px"><b>สถานะ</b></th>
            @if($txtType == 'รถพร้อมขาย')
              <th class="text-center"width="50px"><b>ราคาตั้งขาย</b></th>
            @elseif($txtType == 'รถขายแล้ว')
              <th class="text-center"width="50px"><b>ราคาขาย</b></th>
            @else
              <th class="text-center"width="50px"><b>การจอง</b></th>
            @endif
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
                <td width="60px">
                  @php
                    date_default_timezone_set('Asia/Bangkok');
                    $Y = date('Y') + 543;
                    $m = date('m');
                    $d = date('d');
                    $ifdate = $Y.'-'.$m.'-'.$d;
                  @endphp

                  @if($ifdate > $value->create_date && $value->Date_Soldout == Null)
                    @php
                      $Cldate = date_create($value->create_date);
                      $nowCldate = date_create($ifdate);
                      $ClDateDiff = date_diff($Cldate,$nowCldate);
                    @endphp
                    {{$ClDateDiff->format("%a วัน")}}

                  @elseif($value->Date_Soldout != Null)
                    @php
                      $Cldate = date_create($value->create_date);
                      $nowCldate = date_create($value->Date_Sale);
                      $ClDateDiff = date_diff($Cldate,$nowCldate);
                    @endphp
                    {{$ClDateDiff->format("%a วัน")}}
                  @endif
                </td>
                <td width="70px">{{$value->Number_Regist}}</td>
                <td width="70px">{{$value->Brand_Car}}</td>
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
                <td width="90px">
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
                  @elseif ($value->Car_type  == 7)
                    ส่งประมูล
                  @endif
                </td>
                <td width="50px">
                  @if($txtType == 'รถพร้อมขาย')
                    {{number_format($value->Net_Price)}}
                  @elseif($txtType == 'รถขายแล้ว')
                    {{number_format($value->Net_Priceplus)}}
                  @else
                    @if($value->BookStatus_Car == 'จอง')
                      ลูกค้าจอง
                    @endif
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @endif
    @elseif($ReportType == 3)
      <h2 class="card-title p-3" align="center" style="font-weight: bold;line-height:5px;">รายการรถยนต์ส่งประมูล</h2>
      @if($fdate != null)
        @php
          $Fdate = date_create($fdate);
          $Tdate = date_create($tdate);
        @endphp
        <h3 class="card-title p-3" align="center" style="font-weight: bold;line-height:10px;">ระหว่างวันที่ {{date_format($Fdate, 'd-m-Y')}} ถึงวันที่ {{date_format($Tdate, 'd-m-Y')}}</h3>
      @else
        <h3 style="font-weight: bold;line-height:10px;"> </h3>
      @endif

      <table border="1">
        <thead>
          <tr align="center" style="background-color:#B7B8AE;line-height:150%;">
            <th class="text-center" width="30px"><b>ลำดับ</b></th>
            <th class="text-center" width="80px"><b>ทะเบียน</b></th>
            <th class="text-center" width="80px"><b>ยี่ห้อ</b></th>
            <th class="text-center" width="70px"><b>รุ่น</b></th>
            <th class="text-center" width="50px"><b>เกียร์</b></th>
            <th class="text-center" width="50px"><b>สี</b></th>
            <th class="text-center" width="40px"><b>ปี</b></th>
            <th class="text-center" width="70px"><b>ที่มา</b></th>
            <th class="text-center" width="80px"><b>ราคาต้นทุน</b></th>
            <th class="text-center" width="80px"><b>ราคาเปิดประมูล</b></th>
            <th class="text-center" width="80px"><b>ราคาปิดประมูล</b></th>
            <th class="text-center" width="80px"><b>รวม</b></th>
          </tr>
        </thead>
        <tbody>
          @php $SumAll = 0; @endphp
          @foreach($dataReport as $key => $value)
            <tr align="center">
              <td width="30px">{{ $key+1 }}</td>
              <td width="80px">{{$value->Number_Regist}}</td>
              <td width="80px">{{$value->Brand_Car}}</td>
              <td width="70px">{{$value->Version_Car}}</td>
              <td width="50px">{{$value->Gearcar}}</td>
              <td width="50px">{{$value->Color_Car}}</td>
              <td width="40px">{{$value->Year_Product}}</td>
              <td width="70px">
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
                @php
                    $SumTopcar = $value->Fisrt_Price+$value->Repair_Price+$value->Offer_Price+$value->Color_Price+$value->Add_Price;
                    $Sumamount = $value->Close_auction - $SumTopcar;
                    $SumAll += $SumTopcar;
                @endphp
              <td width="80px" align="right">{{number_format($SumTopcar)}} &nbsp;</td>
              <td width="80px" align="right">{{number_format($value->Open_auction)}} &nbsp;</td>
              <td width="80px" align="right">{{number_format($value->Close_auction)}} &nbsp;</td>
              <td width="80px" align="right">{{number_format($Sumamount)}} &nbsp;</td>
            </tr>
          @endforeach
          <tr style="background-color: yellow">
            <td width="550px" align="right"><b>รวมคงเหลือ &nbsp;</b></td>
            <td width="80px" align="right"><b>{{number_format($SumAll,2)}} &nbsp;</b></td>
            <td width="160px"> <b>บาท</b></td>
          </tr>
        </tbody>
      </table>
    @endif

  </body>
</html>
