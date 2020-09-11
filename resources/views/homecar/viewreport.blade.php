@extends('layouts.master')
@section('title','ข้อมูลรถยนต์มือ 2')
@section('content')

@php
  date_default_timezone_set('Asia/Bangkok');
  $Y = date('Y') + 543;
  $m = date('m');
  $d = date('d');
  $date1 = date('Y-m-d');
  $time = date('H:i');
  $date = $Y.'-'.$m.'-'.$d;
@endphp

    <!-- Main content -->
    <section class="content">
      <div class="content-header">
        @if(session()->has('success'))
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <strong>สำเร็จ!</strong> {{ session()->get('success') }}
          </div>
        @endif

        <div class="card">
          <div class="card-header">
            <h3 class="" style="text-align:center;"><b>รายงาน {{ $title }}</b></h3>
          </div>

          <div class="card-body">
            <form method="get" action="{{ route('report',$type) }}">
              <div class="float-right form-inline">
                  <!-- <a target="_blank" href="{{ action('ReportController@ReportExpire') }}?id={{$type}}&Fromdate={{$fdate}}&Todate={{$tdate}}" class="btn bg-primary btn-app">
                  <span class="fas fa-print"></span> ปริ้นรายการ
                  </a> -->
                @if($type != 7)
                  <a href="#" data-toggle="modal" data-target="#modal-report" class="btn bg-primary btn-app" data-backdrop="static" data-keyboard="false">
                    <span class="fas fa-print"></span> ปริ้นรายการ
                  </a>
                @endif
                @if($type != 3)
                  <button type="submit" class="btn bg-warning btn-app">
                    <span class="fas fa-search"></span> Search
                  </button>
                @endif
              </div>
              
              @if($type != 3)
                <br><br><br>
                <div class="float-right form-inline"> 
                  <label>จากวันที่ : </label>
                  <input type="date" name="Fromdate" style="width: 170px;" value="{{ ($fdate != '') ?$fdate: date('Y-m-d') }}" class="form-control" />

                  <label>ถึงวันที่ : </label>
                  <input type="date" name="Todate" style="width: 170px;" value="{{ ($tdate != '') ?$tdate: date('Y-m-d') }}" class="form-control" />

                </div>
              @endif

            </form>
            <br><br>
            <hr>
            <div class="table-responsive">
              <table class="table table-bordered" id="table1">
                @if($type == 3)
                  <thead class="thead-dark bg-gray-light">
                    <tr>
                      <th class="text-center" >วันที่ซื้อ</th>
                      <th class="text-center" >เลขทะเบียน</th>
                      <th class="text-center" >ยี่ห้อ</th>
                      <th class="text-center" >รุ่น</th>
                      <th class="text-center" >ลักษณะ</th>
                      <th class="text-center" >ที่มา</th>
                      <th class="text-center" >สถานะ</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $row)
                      <tr>
                        <td class="text-center">
                          @php
                            $create_date = date_create($row->create_date);
                          @endphp
                          {{ date_format($create_date, 'd-m-Y')}}
                        </td>
                        <td class="text-center">{{$row->Number_Regist}}</td>
                        <td class="text-center">{{$row->Brand_Car}}</td>
                        <td class="text-center">{{$row->Version_Car}}</td>
                        <td class="text-center">{{$row->Model_Car}}</td>
                        <td class="text-center">
                          @if($row->Origin_Car == 1 )
                            CKL
                          @elseif($row->Origin_Car == 2 )
                            รถประมูล
                          @elseif($row->Origin_Car == 3 )
                            รถยึด
                          @elseif($row->Origin_Car == 4 )
                            รถฝากขาย
                          @endif
                        </td>

                        <td class="text-center">
                          @if($row->Car_type == 1)
                            นำเข้าใหม่
                          @elseif ($row->Car_type  == 2)
                            ระหว่างทำสี
                          @elseif ($row->Car_type  == 3)
                            รอซ่อม
                          @elseif ($row->Car_type  == 4)
                            ระหว่างซ่อม
                          @elseif ($row->Car_type  == 5)
                            พร้อมขาย
                          @elseif ($row->Car_type  == 6)
                            ขายแล้ว
                          @endif
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                @endif

                @if($type == 4)
                  <thead class="thead-dark bg-gray-light">
                    <tr>
                      <th class="text-center" >วันทีหมดอายุบัตร</th>
                      <th class="text-center" >เลขทะเบียน</th>
                      <th class="text-center" >ยี่ห้อ</th>
                      <th class="text-center" >รุ่น</th>
                      <th class="text-center" >ลักษณะ</th>
                      <th class="text-center" >ที่มา</th>
                      <th class="text-center" >สถานะ</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $row)
                      <tr>
                        <td class="text-center">
                          @php
                            $Date_Num = date_create($row->Date_NumberUser);
                          @endphp
                          {{ date_format($Date_Num, 'd-m-Y')}}
                        </td>
                        <td class="text-center">{{$row->Number_Regist}}</td>
                        <td class="text-center">{{$row->Brand_Car}}</td>
                        <td class="text-center">{{$row->Version_Car}}</td>
                        <td class="text-center">{{$row->Model_Car}}</td>
                        <td class="text-center">
                          @if($row->Origin_Car == 1 )
                            CKL
                          @elseif($row->Origin_Car == 2 )
                            รถประมูล
                          @elseif($row->Origin_Car == 3 )
                            รถยึด
                          @elseif($row->Origin_Car == 4 )
                            รถฝากขาย
                          @endif
                        </td>
                        <td class="text-center">
                          @if($row->Car_type == 1)
                            นำเข้าใหม่
                          @elseif ($row->Car_type  == 2)
                            ระหว่างทำสี
                          @elseif ($row->Car_type  == 3)
                            รอซ่อม
                          @elseif ($row->Car_type  == 4)
                            ระหว่างซ่อม
                          @elseif ($row->Car_type  == 5)
                            พร้อมขาย
                          @elseif ($row->Car_type  == 6)
                            ขายแล้ว
                          @endif
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                @endif

                @if($type == 5) {{--รายงาน รถยึด--}}
                  <thead class="thead-dark bg-gray-light">
                    <tr>
                      <th class="text-center" >วันที่ซื้อ</th>
                      <th class="text-center" >เลขทะเบียน</th>
                      <th class="text-center" >ยี่ห้อ</th>
                      <th class="text-center" >รุ่น</th>
                      <th class="text-center" >ลักษณะ</th>
                      <th class="text-center" >สี</th>
                      <th class="text-center" >ซีซี</th>
                      <th class="text-center" >ราคาซื้อ</th>
                      <th class="text-center" >ต้นทุนบัญชี</th>
                      <th class="text-center" >ประเภท</th>
                      <th class="text-center" >สถานะ</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $row)
                      <tr>
                        <td class="text-center">
                          @php
                            $create_date = date_create($row->create_date);
                          @endphp
                          {{ date_format($create_date, 'd-m-Y')}}
                        </td>
                        <td class="text-center">{{$row->Number_Regist}}</td>
                        <td class="text-center">{{$row->Brand_Car}}</td>
                        <td class="text-center">{{$row->Version_Car}}</td>
                        <td class="text-center">{{$row->Model_Car}}</td>
                        <td class="text-center">{{$row->Color_Car}}</td>
                        <td class="text-center">{{$row->Size_Car}}</td>
                        <!-- <td class="text-center">{{$row->Fisrt_Price}}</td> -->

                        @if($row->Fisrt_Price == null)
                        <td class="text-center">{{$row->Fisrt_Price}}</td>
                        @else
                        <td class="text-center">{{number_format($row->Fisrt_Price, 2)}}</td>
                        @endif

                        @if($row->Accounting_Cost == null)
                        <td class="text-center">{{$row->Accounting_Cost}}</td>
                        @else
                        <td class="text-center">{{number_format($row->Accounting_Cost, 2)}}</td>
                        @endif
                        <td class="text-center">
                          @if($row->Origin_Car == 1)
                            CKL
                          @elseif ($row->Origin_Car  == 2)
                            รถประมูล
                          @elseif ($row->Origin_Car  == 3)
                            รถยึด
                          @elseif ($row->Origin_Car  == 4)
                            ฝากขาย
                          @endif
                        </td>
                        <td class="text-center">
                          @if($row->Car_type == 1)
                            นำเข้าใหม่
                          @elseif ($row->Car_type  == 2)
                            ระหว่างทำสี
                          @elseif ($row->Car_type  == 3)
                            รอซ่อม
                          @elseif ($row->Car_type  == 4)
                            ระหว่างซ่อม
                          @elseif ($row->Car_type  == 5)
                            พร้อมขาย
                          @elseif ($row->Car_type  == 6)
                            ขายแล้ว
                          @endif
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                @endif

                @if($type == 6)
                  <thead class="thead-dark bg-gray-light">
                    <tr>
                      <th class="text-center" >วันที่ขาย</th>
                      <th class="text-center" >เลขทะเบียน</th>
                      <th class="text-center" >ยี่ห้อ</th>
                      <th class="text-center" >รุ่น</th>
                      <th class="text-center" >ราคาซื้อ</th>
                      <th class="text-center" >ราคาต้นทุน</th>
                      <th class="text-center" >ราคาขาย</th>
                      <th class="text-center" >ราคาหัก VAT</th>
                      <th class="text-center" >กำไรขาดทุน</th>
                      <th class="text-center" >ประเภท</th>
                      <th class="text-center" >สถานะ</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $row)
                      <tr>
                        <td class="text-center">
                          @php
                            $DateSoldout = date_create($row->Date_Soldout_plus);
                          @endphp
                          {{ date_format($DateSoldout, 'd-m-Y')}}
                        </td>
                        <td class="text-center">{{$row->Number_Regist}}</td>
                        <td class="text-center">{{$row->Brand_Car}}</td>
                        <td class="text-center">{{$row->Version_Car}}</td>
                        <td class="text-center">{{number_format($row->Fisrt_Price, 2)}}</td>
                        <td class="text-center">
                          @php
                            $SumAmount = $row->Fisrt_Price + $row->Repair_Price + $row->Offer_Price + $row->Color_Price + $row->Add_Price;
                          @endphp
                          {{number_format($SumAmount, 2)}}
                        </td>
                        <td class="text-center">
                          {{number_format($row->Net_Priceplus, 2)}}
                        </td>
                        <td class="text-center">
                          @php
                            $SumPrice = 0;
                            $SumPrice = (($row->Net_Priceplus * 100)/107);
                          @endphp
                          {{number_format($SumPrice, 2)}}
                        </td>
                        <td class="text-center">
                          {{number_format($SumPrice - $SumAmount, 2)}}
                        </td>
                        <td class="text-center">
                          @if($row->Origin_Car == 1)
                            CKL
                          @elseif ($row->Origin_Car  == 2)
                            รถประมูล
                          @elseif ($row->Origin_Car  == 3)
                            รถยึด
                          @elseif ($row->Origin_Car  == 4)
                            ฝากขาย
                          @endif
                        </td>
                        <td class="text-center">
                          @if($row->Car_type == 1)
                            นำเข้าใหม่
                          @elseif ($row->Car_type  == 2)
                            ระหว่างทำสี
                          @elseif ($row->Car_type  == 3)
                            รอซ่อม
                          @elseif ($row->Car_type  == 4)
                            ระหว่างซ่อม
                          @elseif ($row->Car_type  == 5)
                            พร้อมขาย
                          @elseif ($row->Car_type  == 6)
                            ขายแล้ว
                          @endif
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                @endif
              </table>
            </div>
          </div>

          <a id="button"></a>
        </div>
      </div>
    </section>

  <form target="_blank" action="{{ route('report.holdcar') }}" method="post">
    @csrf
    <div class="modal fade" id="modal-report" aria-hidden="true" style="display: none;">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            @if($type == 3)
            <h4 class="modal-title">รายงาน สต๊อกบัญชี</h4>
            @elseif($type == 4)
            <h4 class="modal-title">รายงาน วันหมดอายุบัตร</h4>
            @elseif($type == 5)
            <h4 class="modal-title">รายงาน รถยึด / CKL</h4>
            @elseif($type == 6)
            <h4 class="modal-title">รายงาน ยอดต้นทุนรถต่อคัน</h4>
            @endif
            <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <div class="form-group row mb-1">
                  <label class="col-sm-4 col-form-label text-right">จากวันที่ : </label>
                  <div class="col-sm-7">
                  <input type="date" id="Fromdate" name="Fromdate" value="{{ ($fdate != '') ?$fdate: '' }}" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group row mb-1">
                <label class="col-sm-4 col-form-label text-right">ถึงวันที่ : </label>
                  <div class="col-sm-7">
                    <input type="date" id="Todate" name="Todate" value="{{ ($tdate != '') ?$tdate: '' }}" class="form-control" />
                  </div>
                </div>
              </div>
            </div>
              <br>
              <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-11">
                  <!-- checkbox -->
                  @if($type == 3 or $type == 4 or $type == 5 or $type == 6)
                  <div class="form-group clearfix">
                    <div class="icheck-primary d-inline">
                      <input type="checkbox" name="originType[]" id="checkboxPrimary1" value="1">
                      <label for="checkboxPrimary1">
                        รถ CKL
                      </label>
                    </div>
                    &nbsp;
                    @endif
                    @if($type == 3 or $type == 4 or $type == 6)
                    <div class="icheck-primary d-inline">
                      <input type="checkbox" name="originType[]" id="checkboxPrimary2" value="2">
                      <label for="checkboxPrimary2">
                        รถประมูล
                      </label>
                    </div>
                    &nbsp;
                    @endif
                    @if($type == 3 or $type == 4 or $type == 5 or $type == 6)
                      <div class="icheck-primary d-inline">
                        <input type="checkbox" name="originType[]" id="checkboxPrimary3" value="3">
                        <label for="checkboxPrimary3">
                          รถยึด
                        </label>
                      </div>
                      &nbsp;
                    @endif
                    @if($type == 3 or $type == 4 or $type == 6)
                      <div class="icheck-primary d-inline">
                        <input type="checkbox" name="originType[]" id="checkboxPrimary4" value="4">
                        <label for="checkboxPrimary4">
                          รถฝากขาย
                        </label>
                      </div>
                    @endif
                  </div>
                </div>
              </div>
          <hr>
          </div>
          <input type="hidden" name="id" value="{{$type}}">
          <div class="text-center">
            <button type="submit" class="btn btn-primary">ปริ้นรายงาน</button>
          </div>
          <br>
        </div>
      </div>
    </div>
  </form>

  {{-- button-to-top --}}
  <script>
    var btn = $('#button');

    $(window).scroll(function() {
      if ($(window).scrollTop() > 300) {
        btn.addClass('show');
      } else {
        btn.removeClass('show');
      }
    });

    btn.on('click', function(e) {
      e.preventDefault();
      $('html, body').animate({scrollTop:0}, '300');
    });
  </script>
  
  <script>
    $(function () {
      $('#table1').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
      });
    });
  </script>

  <script>
    function blinker() {
      $('.prem').fadeOut(1000);
      $('.prem').fadeIn(1000);
    }
    setInterval(blinker, 1000);
  </script>

  <script type="text/javascript">
      $("#close").click(function () {
        $("#modal-report").modal('hide');
        var Datepay = ''
        $('#Fromdate').val(Datepay);
        $('#Todate').val(Datepay);
      });
  </script>

@endsection
