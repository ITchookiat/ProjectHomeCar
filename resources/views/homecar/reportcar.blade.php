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
      $strYear = date("Y",strtotime($strDate))+543;
      $strMonth= date("n",strtotime($strDate));
      $strDay= date("d",strtotime($strDate));

      $strMonthCut = Array("" , "ม.ค","ก.พ","มี.ค","เม.ย","พ.ค","มิ.ย","ก.ค","ส.ค","ก.ย","ต.ค","พ.ย","ธ.ค");
      $strMonthThai=$strMonthCut[$strMonth];

      return "$strDay $strMonthThai $strYear";
      //return "$strDay-$strMonthThai-$strYear";
      }

      $DateNew = date('d-m-Y');
    @endphp

    @if($originType == 1) 
      @php
        $origin_car = 'รถ CKL';
      @endphp
    @elseif($originType == 3)
      @php
        $origin_car = 'รถยึด';
      @endphp
    @else
      @php
        $origin_car = 'รถยึด / CKL';
      @endphp
    @endif
    


    วันที่พิมพ์ {{ DateThai($DateNew)}}
    <hr>
    <b align="center">
      <h2 style="line-height:50%;">
        @if( $ReportType == 3)
          รายงาน สต๊อกบัญชี
        @elseif( $ReportType == 4)
          รายงาน วันหมดอายุบัตร
        @elseif( $ReportType == 5)
          รายงานรถ
        @elseif( $ReportType == 6)
          รายงาน ยอดทุนรถต่อคัน
        @endif

        @php
          $create_fdate = date_create($fdate);
          $create_tdate = date_create($tdate);
        @endphp
      </h2>
      <h4 style="line-height:10%;">
          @if($fdate != Null)
            จากวันที่
            {{ date_format($create_fdate, 'd-m-Y')}}
          @endif

          @if($tdate != Null)
            ถึงวันที่
            {{ date_format($create_tdate, 'd-m-Y')}}
          @endif
      </h4>
      <!-- <p></p> -->
    </b>
    
      <table border="1">
        @if( $ReportType == 3)
          <thead>
            <tr align="center" style="line-height:150%;background-color:#CCCCCC;">
              <th class="text-center" width="50px"><b>ลำดับ</b></th>
              <th class="text-center" width="80px"><b>วันที่ซื้อรถ</b></th>
              <th class="text-center" width="70px"><b>ราคาซื้อ</b></th>
              <th class="text-center" width="110px"><b>ระยะเวลา</b></th>
              <th class="text-center" width="80px"><b>ทะเบียน</b></th>
              <th class="text-center" width="80px"><b>ยี่ห้อ</b></th>
              <th class="text-center" width="70px"><b>รุ่น</b></th>
              <th class="text-center" width="70px"><b>ลักษณะ</b></th>
              <th class="text-center" width="70px"><b>ประเภท</b></th>
              <th class="text-center" width="90px"><b>สถานะ</b></th>
            </tr>
          </thead>
          <tbody>
            @foreach($dataReport as $key => $value)
              @php
                $create_date = date_create($value->create_date);
              @endphp

              <tr align="center" style="line-height:120%;">
                <td width="50px">{{ $key+1 }}</td>
                <td width="80px">{{ date_format($create_date, 'd-m-Y')}}</td>
                @if($value->Fisrt_Price == '')
                <td width="70px">{{ $value->Fisrt_Price }}</td>
                @else
                <td width="70px">{{ Number_format($value->Fisrt_Price,2) }}</td>
                @endif
                <td width="110px">
                  @php
                      date_default_timezone_set('Asia/Bangkok');
                      $Y = date('Y') + 543;
                      $m = date('m');
                      $d = date('d');
                      $ifdate = $Y.'-'.$m.'-'.$d;

                      @$TotalFirstprice += $value->Fisrt_Price;
                  @endphp

                  @if($ifdate > $value->create_date && $value->Date_Sale == Null)
                    @php
                      $Cldate = date_create($value->create_date);
                      $nowCldate = date_create($ifdate);
                      $ClDateDiff = date_diff($Cldate,$nowCldate);
                    @endphp

                      {{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน
                  @elseif($value->Date_Sale != Null)
                    @php
                      $Cldate = date_create($value->create_date);
                      $nowCldate = date_create($value->Date_Sale);
                      $ClDateDiff = date_diff($Cldate,$nowCldate);
                    @endphp
                      {{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน
                  @endif
                </td>
                <td width="80px">{{$value->Number_Regist}}</td>
                <td width="80px">{{$value->Brand_Car}}</td>
                <td width="70px">{{$value->Version_Car}}</td>
                <td width="70px">{{$value->Model_Car}}</td>
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
                <td width="90px">
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
              </tr>
            @endforeach
            <tr style="line-height:150%;">
              <td align="right" width="130px"><b>รวมราคาซื้อ &nbsp;</b></td>
              <td align="center" width="70px"><b>{{number_format(@$TotalFirstprice,2)}}&nbsp;</b></td>
              <td align="left" width="570px"> บาท</td>
            </tr>
          </tbody>
        @endif

        @if( $ReportType == 4)
          <thead>
            <tr align="center" style="line-height:150%;background-color:#CCCCCC;">
              <th class="text-center" width="50px"><b>ลำดับ</b></th>
              <th class="text-center" width="130px"><b>วันหมดอายุบัตร</b></th>
              <th class="text-center" width="90px"><b>ทะเบียน</b></th>
              <th class="text-center" width="90px"><b>ยี่ห้อ</b></th>
              <th class="text-center" width="90px"><b>รุ่น</b></th>
              <th class="text-center" width="90px"><b>ลักษณะ</b></th>
              <th class="text-center" width="90px"><b>ประเภท</b></th>
              <th class="text-center" width="110px"><b>สถานะ</b></th>
            </tr>
          </thead>
          <tbody>
            @foreach($dataReport as $key => $value)
              @php
                $Date_NumberUser = date_create($value->Date_NumberUser);
              @endphp

              <tr align="center" style="line-height:120%;">
                <td width="50px">{{ $key+1 }}</td>
                <td width="130px">{{ date_format($Date_NumberUser, 'd-m-Y')}}</td>
                <td width="90px">{{$value->Number_Regist}}</td>
                <td width="90px">{{$value->Brand_Car}}</td>
                <td width="90px">{{$value->Version_Car}}</td>
                <td width="90px">{{$value->Model_Car}}</td>
                <td width="90px">
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
                <td width="110px">
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
              </tr>
            @endforeach
          </tbody>
        @endif

        @if( $ReportType == 5)
          <thead>
            <tr align="center" style="line-height: 150%;background-color:grey;">
              <th class="text-center" width="30px"><b>ลำดับ</b></th>
              <th class="text-center" width="60px"><b>วันที่ซื้อรถ</b></th>
              <th class="text-center" width="85px"><b>ระยะเวลา</b></th>
              <th class="text-center" width="65px"><b>ทะเบียน</b></th>
              <th class="text-center" width="65px"><b>ยี่ห้อ</b></th>
              <th class="text-center" width="70px"><b>รุ่น</b></th>
              <th class="text-center" width="70px"><b>ลักษณะ</b></th>
              <th class="text-center" width="40px"><b>ซีซี</b></th>
              <th class="text-center" width="40px"><b>ปีรถ</b></th>
              <th class="text-center" width="50px"><b>สีรถ</b></th>
              <th class="text-center" width="60px"><b>ราคาซื้อ</b></th>
              <th class="text-center" width="70px"><b>ต้นทุนบัญชี</b></th>
              <th class="text-center" width="40px"><b>ที่มา</b></th>
              <th class="text-center" width="60px"><b>สถานะ</b></th>
            </tr>
          </thead>
          <tbody>
            @foreach($dataReport as $key => $value)
              @php
                $create_date = date_create($value->create_date);
                @$TotalAccountCost += $value->Accounting_Cost;
              @endphp

              <tr align="center" style="line-height: 120%;">
                <td width="30px">{{ $key+1 }}</td>
                <td width="60px">{{ date_format($create_date, 'd-m-Y')}}</td>
                <td width="85px">
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

                      {{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน
                  @elseif($value->Date_Sale != Null)
                    @php
                      $Cldate = date_create($value->create_date);
                      $nowCldate = date_create($value->Date_Sale);
                      $ClDateDiff = date_diff($Cldate,$nowCldate);
                    @endphp
                      {{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน
                  @endif
                </td>
                <td width="65px">{{$value->Number_Regist}}</td>
                <td width="65px">{{$value->Brand_Car}}</td>
                <td width="70px">{{$value->Version_Car}}</td>
                <td width="70px">{{$value->Model_Car}}</td>
                <td width="40px">{{$value->Size_Car}}</td>
                <td width="40px">{{$value->Year_Product}}</td>
                <td width="50px">{{$value->Color_Car}}</td>
                @if($value->Fisrt_Price == null)
                  <td width="60px">{{ $value->Fisrt_Price }}</td>
                @else
                  <td width="60px">{{ number_format($value->Fisrt_Price,2) }}</td>
                @endif
                @if($value->Accounting_Cost == null)
                  <td width="70px">{{$value->Accounting_Cost}}</td>
                @else
                  <td width="70px">{{number_format($value->Accounting_Cost, 2)}}</td>
                @endif
                <td width="40px">
                  @if($value->Origin_Car == 1 )
                    CKL
                  @elseif($value->Origin_Car == 2 )
                    รถประมูล
                  @elseif($value->Origin_Car == 3 )
                    รถยึด
                  @elseif($value->Origin_Car == 4 )
                    รถฝากขาย
                  @endif
                </td>
                <td width="60px">
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
              </tr>
            @endforeach
              <tr style="line-height: 200%;">
                <td width="635px" align="right"><b>รวมต้นทุน &nbsp;</b></td>
                <td width="70px" align="right"><b>{{number_format(@$TotalAccountCost,2)}} &nbsp;</b></td>
                <td width="100px" align="left"> <b>บาท</b></td>
              </tr>
          </tbody>
        @endif

        @if( $ReportType == 6)
          <thead>
            <tr align="center" style="line-height:200%;background-color:#CCCCCC;">
              <th class="text-center" width="30px"><b>ลำดับ</b></th>
              <th class="text-center" width="55px"><b>วันที่ขาย</b></th>
              <th class="text-center" width="65px"><b>ทะเบียน</b></th>
              <th class="text-center" width="60px"><b>ยี่ห้อ</b></th>
              <th class="text-center" width="70px"><b>รุ่น</b></th>
              <th class="text-center" width="35px"><b>ปีรถ</b></th>
              <th class="text-center" width="65px"><b>ราคาซื้อ</b></th>
              <th class="text-center" width="65px"><b>รวม คชจ.</b></th>
              <th class="text-center" width="65px"><b>ราคาขาย</b></th>
              <th class="text-center" width="70px"><b>ราคาหลัง VAT</b></th>
              <th class="text-center" width="70px"><b>กำไรขาดทุน</b></th>
              <th class="text-center" width="50px"><b>เปอร์เซ็นต์</b></th>
              <th class="text-center" width="50px"><b>ประเภท</b></th>
              <th class="text-center" width="50px"><b>สถานะ</b></th>
            </tr>
          </thead>
          <tbody>
            @foreach($dataReport as $key => $value)
              @php
                $DateSoldout = date_create($value->Date_Soldout_plus);
              @endphp

              <tr align="center" style="line-height:150%;">
                <td width="30px">{{ $key+1 }}</td>
                <td width="55px">{{ date_format($DateSoldout, 'd-m-Y')}}</td>
                <td width="65px">{{$value->Number_Regist}}</td>
                <td width="60px">{{$value->Brand_Car}}</td>
                <td width="70px">{{$value->Version_Car}}</td>
                <td width="35px">{{$value->Year_Product}}</td>
                <td width="65px">{{number_format($value->Fisrt_Price, 2)}}</td>
                <td width="65px">
                  @php
                    $SumAmount = $value->Fisrt_Price + $value->Repair_Price + $value->Offer_Price + $value->Color_Price + $value->Add_Price;
                    @$SumBuyprice += $value->Fisrt_Price;
                    @$SumPayprice += $SumAmount;
                    @$SumNetprice += $value->Net_Priceplus;
                  @endphp
                  {{number_format($SumAmount, 2)}}
                </td>
                <td width="65px">
                  {{number_format($value->Net_Priceplus, 2)}}
                </td>
                <td width="70px">
                  @php
                    $SumPrice = 0;
                    $SumPrice = (($value->Net_Priceplus * 100)/107);
                    @$SumVatprice += $SumPrice;
                    @$SumProfitprice += $SumPrice - $SumAmount;
                    $Profit = $SumPrice - $SumAmount;
                  @endphp
                  {{number_format($SumPrice, 2)}}
                </td>
                <td width="70px">
                  {{number_format($SumPrice - $SumAmount, 2)}}
                </td>
                <td width="50px">
                  @if($SumAmount == 0)
                    0
                  @else
                    {{number_format(($Profit/$SumAmount)*100, 2)}}
                  @endif
                </td>
                <td width="50px">
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
                <td width="50px">
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
              </tr>
            @endforeach
            <tr style="line-height:150%;">
              <td align="right" width="315px"><b>รวมยอด &nbsp;</b></td>
              <td align="center" width="65px"><b>{{number_format(@$SumBuyprice,2)}}&nbsp;</b></td>
              <td align="center" width="65px"><b>{{number_format(@$SumPayprice,2)}}&nbsp;</b></td>
              <td align="center" width="65px"><b>{{number_format(@$SumNetprice,2)}}&nbsp;</b></td>
              <td align="center" width="70px"><b>{{number_format(@$SumVatprice,2)}}&nbsp;</b></td>
              <td align="center" width="70px"><b>{{number_format(@$SumProfitprice,2)}}&nbsp;</b></td>
              <td align="center" width="150px"></td>
            </tr>
          </tbody>
        @endif
      </table>
  </body>
</html>
