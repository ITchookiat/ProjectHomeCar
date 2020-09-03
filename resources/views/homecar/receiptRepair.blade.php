<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    @php
      function DateThai($strDate){
        $strYear = date("Y",strtotime($strDate))+543;
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
    @endphp
  </head>
    <label align="right">ปริ้นวันที่ : <u>{{DateThai2(date('Y-m-d'))}}</u></label>
    <h2 class="card-title p-3" align="center" style="line-height: 3px;">รายการซ่อมรถ ( {{$plate}} )</h2>
    <!-- <h4 class="card-title p-3" align="center">บริษัท ชูเกียรติลิสซิ่ง จำกัด โทรศัพท์. ( 073-450-700 )</h4> -->
    <br>
    <hr>
  <body>
    <br />
    <table border="1">
      <thead>
        <tr align="center" style="line-height: 150%;">
          <th width="30px" align="center" style="background-color: #FFFF00;"><b>ลำดับ</b></th>
          <th width="280px" align="center" style="background-color: #FFFF00;"><b>รายการ</b></th>
          <th width="50px" align="center" style="background-color: #FFFF00;"><b>จำนวน</b></th>
          <th width="75px" align="center" style="background-color: #FFFF00;"><b>ราคา/หน่วย</b></th>
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
          <td width="280px" align="left"> {{$value->Repair_list}}</td>
          <td width="50px">{{$value->Repair_amount}}</td>
          <td width="75px" align="right">{{number_format($value->Repair_price,2)}} &nbsp;</td>
          <td width="70px" align="right">{{number_format($value->Repair_amount * $value->Repair_price,2)}} &nbsp;</td>
        </tr>
        @endforeach
        <tr>
          <td colspan="3"></td>
          <td align="right">รวมทั้งสิ้น &nbsp;</td>
          <td align="right">{{number_format(@$Totalprice,2)}} &nbsp;</td>
        </tr>
        <br>
      </tbody>
    </table>

  </body>
</html>
