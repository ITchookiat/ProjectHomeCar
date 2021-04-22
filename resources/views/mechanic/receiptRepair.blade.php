<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    @php
      function DateThai($strDate){
        $strYear = date("Y")+543;
        $strMonth= date("n",strtotime($strDate));
        $strDay= date("d",strtotime($strDate));
        $strMonthCut = Array("" , "ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $strMonthThai=$strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear";
      }
      function DateThai2($strDate){
        $strYear = date("Y",strtotime($strDate))+543;
        $strMonth= date("n",strtotime($strDate));
        $strDay= date("j",strtotime($strDate));
        $strMonthCut = Array("" , "มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
        $strMonthThai=$strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear";
      }
      $SetDatecreate = date_create($datacar->create_date);
      $Datecreate = date_format($SetDatecreate,'d-m-Y');
    @endphp
  </head>
    <label align="right">No: {{$datacar->Job_Number}}</label>
    <h1 class="card-title p-3" align="center" style="line-height: 3px;">คู่มือตรวจเช็ครถ CKL</h1>
    <!-- <h4 class="card-title p-3" align="center">บริษัท ชูเกียรติลิสซิ่ง จำกัด โทรศัพท์. ( 073-450-700 )</h4> -->
    <br>
    <table border="0">
        <tr align="center" style="line-height: 100%;">
          <th width="30px" align="center"><b></b></th>
          <th width="280px" align="center"><b></b></th>
          <th width="50px" align="center"><b></b></th>
          <th width="75px" align="right"><b>วันที่รับรถ </b></th>
          <th width="70px" align="left" style="border-bottom-style: dotted;"> {{$Datecreate}}</th>
        </tr>
        <tr align="center" style="line-height: 100%;">
          <th width="30px" align="center"><b></b></th>
          <th width="280px" align="center"><b></b></th>
          <th width="50px" align="center"><b></b></th>
          <th width="75px" align="right"><b>ทะเบียนรถ </b></th>
          <th width="70px" align="left" style="border-bottom-style: dotted;"> {{$datacar->Number_Regist}}</th>
        </tr>
        <tr align="center" style="line-height: 100%;">
          <th width="40px" align="center"><b>ยี่ห้อรถ</b></th>
          <th width="100px" align="left" style="border-bottom-style: dotted;"> {{$datacar->Brand_Car}}</th>
          <th width="30px" align="center"><b>รุ่นรถ</b></th>
          <th width="120px" align="left" style="border-bottom-style: dotted;"> {{$datacar->Version_Car}}</th>
          <th width="70px" align="center"><b>เครื่องยนต์ (cc)</b></th>
          <th width="80px" align="left" style="border-bottom-style: dotted;"> {{$datacar->Size_Car}}</th>
          <th width="10px" align="center"><b>สี</b></th>
          <th width="55px" align="left" style="border-bottom-style: dotted;"> {{$datacar->Color_Car}}</th>
        </tr>
        <tr align="center" style="line-height: 100%;">
          <th width="50px" align="center"><b>เลขตัวถัง</b></th>
          <th width="150px" align="left" style="border-bottom-style: dotted;"> {{$datacar->Chassis_car}}</th>
          <th width="50px" align="center"><b>เลขเครื่อง</b></th>
          <th width="120px" align="left" style="border-bottom-style: dotted;"> </th>
          <th width="50px" align="center"><b>ประเภทรถ</b></th>
          <th width="80px" align="left">
            ( @if($datacar->Origin_Car == 1)
              CKL
            @elseif ($datacar->Origin_Car  == 2)
              รถประมูล
            @elseif ($datacar->Origin_Car  == 3)
              รถยึด
            @elseif ($datacar->Origin_Car  == 4)
              ฝากขาย
            @endif )
          </th>
        </tr>
        <tr align="center" style="line-height: 50%;">
          <th width="510px" style="border-bottom-style: solid;"></th>
        </tr>
        <tr align="center" style="line-height: 100%;">
          <th></th>
        </tr>
    </table>
    <!-- <hr> -->
  <body>
    <table border="1">
      <thead>
        <tr align="center" style="line-height: 150%;">
          <th width="30px" align="center" style="background-color: #FFFF00;"><b>ลำดับ</b></th>
          <th width="280px" align="center" style="background-color: #FFFF00;"><b>รายละเอียดการซ่อมและอะไหล่</b></th>
          <th width="50px" align="center" style="background-color: #FFFF00;"><b>จำนวน</b></th>
          <th width="75px" align="center" style="background-color: #FFFF00;"><b>ราคาอะไหล่</b></th>
          <th width="70px" align="center" style="background-color: #FFFF00;"><b>รวมเป็นเงิน</b></th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $key => $value)
            @php 
             @$Totalprice += $value->Repair_amount * $value->Repair_price;
            @endphp
        <tr align="center" style="line-height: 150%;">
          <td width="30px">{{$key+1}}</td>
          <td width="280px" align="left"> 
          {{$value->Repair_list}}
          @if($value->Repair_detail)
          <br style="line-height: 100%;">
          - {{$value->Repair_detail}}
          @endif
          </td>
          <td width="50px">{{$value->Repair_amount}}</td>
          <td width="75px" align="right">{{number_format($value->Repair_price,2)}} &nbsp;</td>
          <td width="70px" align="right">{{number_format($value->Repair_amount * $value->Repair_price,2)}} &nbsp;</td>
        </tr>
        @endforeach
        <tr>
          <td colspan="3"></td>
          <td align="right">รวมราคาอะไหล่ &nbsp;</td>
          <td align="right">{{number_format(@$Totalprice,2)}} &nbsp;</td>
        </tr>
        <br>
      </tbody>
    </table>

  </body>
</html>
