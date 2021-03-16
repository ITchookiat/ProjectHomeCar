<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Report</title>
  </head>
  <body style="margin-top: 0px">
    พิมพ์วันที่ : {{ date('d-m-Y')}}
    @php
      $Fdate = date_create($newfdate);
      $Tdate = date_create($newtdate);

      if ($PrintStatus == NULL) {
        $PrintStatus = 'ทั้งหมด';
      }
    @endphp
    <h2 class="card-title p-3" align="center" style="font-weight: bold;line-height:5px;">รายงานข้อมูลลูกค้า ประเภท{{$PrintStatus}} (Research Customer)</h2>
    <h3 class="card-title p-3" align="center" style="font-weight: bold;line-height:10px;">ระหว่างวันที่ {{date_format($Fdate, 'd-m-Y')}} ถึงวันที่ {{date_format($Tdate, 'd-m-Y')}}</h3>
    <hr><br />
    <table border="1">
      <thead>
        <tr align="center" style="background-color:#B7B8AE;line-height:150%;">
          <th class="text-center" width="30px"><b>ลำดับ</b></th>
          <th class="text-center" width="60px"><b>วันที่รับลูกค้า</b></th>
          <th class="text-center" width="140px"><b>ชื่อ-สกุล</b></th>
          <th class="text-center" width="80px"><b>ป้ายทะเบียน</b></th>
          <th class="text-center" width="55px"><b>ที่มารถ</b></th>
          <th class="text-center" width="60px"><b>สถานะลูกค้า</b></th>
          <th class="text-center" width="60px"><b>วันที่</b></th>
          <th class="text-center" width="65px"><b>ประเภทลูกค้า</b></th>
          <th class="text-center" width="140px"><b>แหล่งที่มาลูกค้า</b></th>
          <th class="text-center" width="60px"><b>รูปแบบลูกค้า</b></th>
          <th class="text-center" width="60px"><b>Sale รับลูกค้า</b></th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $key => $value)
          <tr align="center">
            <td width="30px">{{ $key+1 }}</td>
            <td width="60px">{{ $value->DateSale_Cus}}</td>
            <td width="140px">{{$value->Name_Cus}}</td>
            <td width="80px">{{$value->RegistCar_Cus}}</td>
            <td width="55px">
              @if($value->Origin_Car == 1)
                CKL
              @elseif($value->Origin_Car == 2)
                รถประมูล
              @elseif($value->Origin_Car == 3)
                รถยึด
              @elseif($value->Origin_Car == 4)
                ฝากขาย
              @endif
            </td>
            <td width="60px">{{$value->Status_Cus}}</td>
            <td width="60px">{{$value->DateStatus_Cus}}</td>
            <td width="65px">{{$value->Type_Cus}}</td>
            <td width="140px">{{$value->Origin_Cus}}</td>
            <td width="60px">{{$value->model_Cus}}</td>
            <td width="60px">{{$value->Sale_Cus}}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>
