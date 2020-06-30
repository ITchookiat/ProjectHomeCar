@extends('layouts.master')
@section('title','ข้อมูลรถยนต์มือ 2')
@section('content')

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
@endphp

@php
  date_default_timezone_set('Asia/Bangkok');
  $Y = date('Y') + 543;
  $m = date('m');
  $d = date('d');
  //$date = date('Y-m-d');
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

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h1 class="" style="text-align:center;"><b>รายการ {{ $title }}</b></h1>
                </div>
                <!-- /.card-header -->
                  <div class="card-body">
                    @if($type == 1 or $type == 6)
                      <form method="get" action="{{ route('datacar',$type) }}">
                        <div style="text-align:right;">
                          @if($type == 1)
                            <a href="{{ route('datacar.create',1) }}" class="btn bg-success btn-app">
                              <span class="fas fa-plus"></span> เพิ่มข้อมูล
                            </a>
                            <div class="btn-group">
                              <button type="button" class="btn bg-primary btn-app" data-toggle="dropdown">
                                <span class="fas fa-print"></span> ปริ้นรายการ
                              </button>
                              <ul class="dropdown-menu" role="menu">
                                <li><a target="_blank" class="dropdown-item" href="{{ action('DatacarController@ReportPDFIndex') }}?id={{$type}}&Fromdate={{$fdate}}&Todate={{$tdate}}&carType={{$carType}}">สำหรับพนักงาน</a></li>
                                <li class="divider"></li>
                                <li><a target="_blank" class="dropdown-item" href="{{ action('DatacarController@ReportPDFIndex') }}?id={{$type}}&Fromdate={{$fdate}}&Todate={{$tdate}}&carType={{$carType}}&admin={{1}}">สำหรับผู้บริหาร</a></li>
                              </ul>
                            </div>
                          @elseif($type == 6)
                            <a class="btn bg-danger btn-app" data-toggle="modal" data-target="#modal-1" data-link="{{ route('datacar', 13) }}">
                              <i class="fas fa-car"></i> เทียบราคา
                            </a>
                            <a target="_blank"  class="btn bg-primary btn-app" href="{{ action('DatacarController@ReportPDFIndex') }}?id={{$type}}&Fromdate={{$fdate}}&Todate={{$tdate}}&carType={{$carType}}">
                              <span class="fas fa-print"></span> ปริ้นรายการ
                            </a>
                          @endif
                          <button type="submit" class="btn bg-warning btn-app">
                            <span class="fas fa-search"></span> Search
                          </button>
                          <br>
                        </div>

                        @if($type != 6)
                          <div class="float-right form-inline">
                            <label>ประเภท :</lable>
                              <select name="carType" class="form-control">
                                <option selected disabled value="">---เลือกประเภทรถ---</option>
                                <option value="1" {{ ($carType == '1') ? 'selected' : '' }}>นำเข้าใหม่</otion>
                                <option value="2" {{ ($carType == '2') ? 'selected' : '' }}>ระหว่างทำสี</otion>
                                <option value="3" {{ ($carType == '3') ? 'selected' : '' }}>รอซ่อม</otion>
                                <option value="4" {{ ($carType == '4') ? 'selected' : '' }}>ระหว่างซ่อม</otion>
                              </select>
                          </div>
                        @endif
                        <div class="float-right form-inline">
                          <label>จากวันที่ : </label>
                          <input type="date" name="Fromdate" value="{{ ($fdate != '') ?$fdate: $date }}" class="form-control" />
                          <label>ถึงวันที่ : </label>
                          <input type="date" name="Todate" value="{{ ($tdate != '') ?$tdate: $date }}" class="form-control" />
                        </div>
                        <br>
                        <p></P>
                      </form>
                    @endif

                    @if($type == 5)
                      <div class="float-right form-inline">
                        <a target="_blank" href="{{ action('DatacarController@ReportPDF') }}?id={{$type}}" class="btn bg-primary btn-app">
                          <span class="fas fa-print"></span> ปริ้นรายการ
                        </a>
                      </div>
                    @endif

                    @if($type == 12)
                      <div class="table-responsive">
                        <table id="table1" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th class="text-center">ลำดับ</th>
                              <th class="text-center">เลขที่สัญญา</th>
                              <th class="text-center">ชื่อ - สกุล</th>
                              <th class="text-center">ยี่ห้อรถ</th>
                              <th class="text-center">ทะเบียน</th>
                              <th class="text-center">วันที่ยึด</th>
                              <th class="text-center">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $key => $row)
                              @php
                                @$StrCon = explode("/",$row->Contno_hold);
                                $SetStr1 = $StrCon[0];
                                $SetStr2 = $StrCon[1];
                                $Flag = "N";
                              @endphp
                              <tr>
                                <td class="text-center">{{$key+1}}</td>
                                <td class="text-center">{{$row->Contno_hold}}</td>
                                <td class="text-left"> {{$row->Name_hold}}</td>
                                <td class="text-center">{{$row->Brandcar_hold}}</td>
                                <td class="text-center">{{$row->Number_Regist}}</td>
                                <td class="text-center">{{DateThai($row->Date_hold)}}</td>
                                <td class="text-center">
                                  @foreach($dataDB as $key => $row2)
                                    @if($row->Number_Regist == $row2->Number_Regist)
                                    <a id="edit" class="btn btn-success btn-sm" title="ส่งแล้ว">
                                      <span class="glyphicon glyphicon-lock"></span> นำเข้าแล้ว
                                    </a>
                                      @php
                                      $Flag = "Y";
                                      @endphp
                                    @endif
                                  @endforeach
                                  @if($Flag == 'N')
                                    <a href="{{ route('datacar.Savestore', [$SetStr1,$SetStr2,1]) }}" id="edit" class="btn btn-info btn-sm" title="จัดเตรียมเอกสาร">
                                      <span class="glyphicon glyphicon-edit"></span> นำเข้าสต็อก
                                    </a>
                                  @endif
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    @else
                      <div class="table-responsive">
                        <table id="table1" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              @if($type != 6)
                              <th class="text-center" style="width: 100px">วันที่รับ</th>
                              <th class="text-center" style="width: 120px">วันที่เปลี่ยนสถานะ</th>
                              @endif
                              @if($type == 5)
                                <th class="text-center" style="width: 100px">ราคาขาย</th>
                              @endif
                              @if($type == 6)
                                <th class="text-center" style="width: 100px">วันที่ขาย</th>
                              @endif
                              <th class="text-center" style="width: 120px">เลขทะเบียน</th>
                              <th class="text-center" style="width: 80px">ที่มา</th>
                              <th class="text-center" style="width: 80px">Job No.</th>
                              <th class="text-center" style="width: 100px">สถานะ</th>
                              <th class="text-center" style="width: 150px">หมายเหตุ</th>

                              <th class="text-center" style="width: 180px">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($data as $row)
                              <tr>
                                @php
                                  $create_date = date_create($row->create_date);
                                  $date_status = date_create($row->Date_Status);
                                  $Date_Soldout_plus = date_create($row->Date_Soldout_plus);

                                  // dd(date_format($create_date, 'd-m-Y'));
                                @endphp

                                @if($type != 6)
                                  <td class="text-center">
                                    {{ date_format($create_date, 'd-m-Y')}}
                                  </td>

                                  @if($row->Date_Status == Null)
                                    <td class="text-center"> - </td>
                                  @else
                                    <td class="text-center">{{ date_format($date_status, 'd-m-Y')}}</td>
                                  @endif
                                @endif

                                @if($type == 5)
                                  <td class="text-center">{{number_format($row->Net_Price, 2)}}</td>
                                @endif
                                @if($type == 6)
                                  <td class="text-center">{{ date_format($Date_Soldout_plus, 'd-m-Y')}}</td>
                                @endif
                                <td class="text-center">{{$row->Number_Regist}}</td>
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
                                <td class="text-center">{{$row->Job_Number}}</td>
                                <td class="text-center">
                                  @if($row->Car_type == 1)
                                    นำเข้าใหม่ @if($row->BorrowStatus == 1) <font color="red">(ยืม)</font> @endif
                                  @elseif ($row->Car_type  == 2)
                                    ระหว่างทำสี @if($row->BorrowStatus == 1) <font color="red">(ยืม)</font> @endif
                                  @elseif ($row->Car_type  == 3)
                                    รอซ่อม @if($row->BorrowStatus == 1) <font color="red">(ยืม)</font> @endif
                                  @elseif ($row->Car_type  == 4)
                                    ระหว่างซ่อม @if($row->BorrowStatus == 1) <font color="red">(ยืม)</font> @endif
                                  @elseif ($row->Car_type  == 5)
                                    พร้อมขาย @if($row->BorrowStatus == 1) <font color="red">(ยืม)</font> @endif
                                  @elseif ($row->Car_type  == 6)
                                    ขายแล้ว
                                  @endif
                                </td>

                                <td class="text-left">
                                  @if($row->BorrowStatus == 1)
                                  {{ $row->Check_Note }}
                                  <br>
                                  <font color="red">({{$row->Note_Borrow}})</font>
                                  @else
                                  {{ $row->Check_Note }}
                                  @endif
                                </td>

                                <td class="text-center">
                                  <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-default"
                                    data-link="{{ action('DatacarController@viewsee',[$row->Datacar_id,$row->Car_type]) }}">
                                    <i class="far fa-eye"></i> ดู
                                  </button>
                                  @if($type != 6)
                                    <a href="{{ action('DatacarController@edit',[$row->Datacar_id,$row->Car_type]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                    <i class="far fa-edit"></i> แก้ไข
                                    </a>
                                  @elseif ($type == 6)
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-buyinfo"
                                      data-link="{{ action('DatacarController@edit',[$row->Datacar_id,$row->Car_type]) }}">
                                      <i class="fas fa-file-invoice-dollar"></i> ข้อมูลขาย
                                    </button>
                                    {{-- <a href="{{ action('DatacarController@edit',[$row->Datacar_id,$row->Car_type]) }}" class="btn btn-warning btn-sm" title="ข้อมูลซื้อ" data-toggle="modal" data-target="#modal-buyinfo" data-backdrop="static" data-keyboard="false">
                                      <i class="fas fa-file-invoice-dollar"></i> ข้อมูลขาย
                                    </a> --}}
                                  @endif

                                  @if($type == 1)
                                    @if($type == 1)
                                    <form method="post" class="delete_form" action="{{ action('DatacarController@destroy',$row->Datacar_id) }}" style="display:inline;">
                                      {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" class="delete-modal btn btn-danger btn-sm" title="ลบรายการ" onclick="return confirm('คุณต้องการลบข้อมูลนี้หรือไม่?')">
                                          <i class="far fa-trash-alt"></i> ลบ
                                        </button>
                                      </form>
                                    @endif
                                  @endif
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    @endif
                    </div>
                <!-- /.card-body -->
              </div>

              <a id="button"></a>
            </div>
          </div>
        </div>
      </section>
    </div>
  </section>

    <!-- Pop up รายละเอียดค่าใช้จ่าย -->
    <div class="modal fade" id="modal-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-body">
            <p>One fine body…</p>
          </div>
          <div class="modal-footer justify-content-between">
          </div>
        </div>
      </div>
    </div>

  <!-- Pop up รายละเอียดค่าใช้จ่าย -->
  <div class="modal fade" id="modal-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body">
          <p>One fine body…</p>
        </div>
        <div class="modal-footer justify-content-between">
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-xl">
      <div class="modal-content bg-default">
        <div class="modal-body">
          <p>One fine body…</p>
        </div>
        <div class="modal-footer justify-content-between">
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal-buyinfo">
    <div class="modal-dialog modal-xl">
      <div class="modal-content bg-default">
        <div class="modal-body">
          <p>One fine body…</p>
        </div>
        <!-- <div class="modal-footer justify-content-between">
        </div> -->
      </div>
    </div>
  </div>

  {{-- Popup --}}
  <script>
    $(function () {
      $("#modal-1").on("show.bs.modal", function (e) {
        var link = $(e.relatedTarget).data("link");
        $("#modal-1 .modal-body").load(link, function(){
        });
      });
    });
  </script>

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
    $(".alert").fadeTo(3000, 500).slideUp(500, function(){
    $(".alert").alert('close');
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

  {{-- Popup --}}
  <script>
    $(function () {
      $("#modal-default").on("show.bs.modal", function (e) {
        var link = $(e.relatedTarget).data("link");
        $("#modal-default .modal-body").load(link, function(){
        });
      });

      $("#modal-buyinfo").on("show.bs.modal", function (e) {
        var link = $(e.relatedTarget).data("link");
        $("#modal-buyinfo .modal-body").load(link, function(){
        });
      });
    });
  </script>

@endsection
