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
        <script type="text/javascript">
          toastr.success('{{ session()->get('success') }}')
        </script>
      @endif
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4><b>รายการ{{$title}}</b></h4>
            </div>
            <div class="card-body text-sm">
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
                          <li><a target="_blank" class="dropdown-item" href="{{ action('DatacarController@ReportPDFIndex') }}?id={{$type}}&Fromdate={{$fdate}}&Todate={{$tdate}}&carType={{$carType}}">รายงาน สำหรับพนักงาน</a></li>
                          <li class="divider"></li>
                          <li><a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-report" data-backdrop="static" data-keyboard="false">รายงาน สำหรับผู้บริหาร</a></li>
                        </ul>
                      </div>
                    @elseif($type == 6)
                      <a target="_blank"  class="btn bg-primary btn-app" href="{{ action('DatacarController@ReportPDFIndex') }}?id={{$type}}&Fromdate={{$fdate}}&Todate={{$tdate}}&carType={{$carType}}">
                        <span class="fas fa-print"></span> ปริ้นรายการ
                      </a>
                    @endif
                    <button type="submit" class="btn bg-warning btn-app">
                      <span class="fas fa-search"></span> Search
                    </button>
                    <br>
                  </div>

                  <div class="row mb-1">
                    <div class="col-md-12">
                      <div class="float-right form-inline">
                       @if($type != 6)
                          <label for="text" class="mr-sm-0">ประเภท :</label>
                          <select name="carType" class="form-control">
                            <option selected value="">---เลือกประเภทรถ---</option>
                            <option value="1" {{ ($carType == '1') ? 'selected' : '' }}>รถนำเข้าใหม่</option>
                            <option value="2" {{ ($carType == '2') ? 'selected' : '' }}>รถระหว่างทำสี</option>
                            <option value="3" {{ ($carType == '3') ? 'selected' : '' }}>รถรอซ่อม</option>
                            <option value="4" {{ ($carType == '4') ? 'selected' : '' }}>รถระหว่างซ่อม</option>
                            <option value="7" {{ ($carType == '7') ? 'selected' : '' }}>รถส่งประมูล</option>
                          </select>
                        @endif
                        <label>จากวันที่ : </label>
                        <input type="date" name="Fromdate" value="{{ ($fdate != '') ?$fdate: date('Y-m-d') }}" class="form-control" />
                        <label>ถึงวันที่ : </label>
                        <input type="date" name="Todate" value="{{ ($tdate != '') ?$tdate: date('Y-m-d') }}" class="form-control" />
                      </div>
                    </div>
                  </div>
                </form>
              @elseif ($type == 5)
                <div class="float-right form-inline">
                  <a target="_blank" href="{{ action('DatacarController@ReportPDF') }}?id={{$type}}" class="btn bg-primary btn-app">
                    <span class="fas fa-print"></span> ปริ้นรายการ
                  </a>
                </div>
              @elseif($type == 14)
                <div class="row">
                  <div class="col-md-12">
                    <form method="get" action="{{ route('datacar',$type) }}">
                      <div class="float-right form-inline">
                        <button type="submit" class="btn bg-warning btn-app">
                          <span class="fas fa-search"></span> Search
                        </button>
                      </div>
                      <div class="float-right form-inline"> 
                        <label>จากวันที่ : </label>
                        <input type="date" name="Fromdate" value="{{ ($fdate != '') ?$fdate: date('Y-m-d') }}" class="form-control" />
                        <label>ถึงวันที่ : </label>
                        <input type="date" name="Todate" value="{{ ($tdate != '') ?$tdate: date('Y-m-d') }}" class="form-control" />
                      </div>
                    </form>
                  </div>
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
                                <span class="glyphicon glyphicon-lock"></span> Check In Stock
                              </a>
                                @php
                                $Flag = "Y";
                                @endphp
                              @endif
                            @endforeach
                            @if($Flag == 'N')
                              <a href="{{ route('datacar.Savestore', [$SetStr1,$SetStr2, 1]) }}" id="edit" class="btn btn-info btn-sm" title="จัดเตรียมเอกสาร">
                                <span class="glyphicon glyphicon-edit"></span> Inport Stock
                              </a>
                            @endif
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              @elseif($type == 14)
                <div class="info-box bg-info">
                  <span class="info-box-icon bg-warning"><i class="fas fa-car fa-lg"></i></span>
                  <div class="info-box-content">
                    <h5>รถยนต์ส่งประมูล</h5>
                    @php
                      $Setfdate = date_create($fdate);
                      $Settdate = date_create($tdate);
                    @endphp
                    <span class="info-box-number">ประจำวันที่ {{ date_format($Setfdate, 'd-m-Y') }} &nbsp;&nbsp; ถึงวันที่ {{ date_format($Settdate, 'd-m-Y') }}</span>
                  </div>
                  <div class="info-box-content ">
                    <h5>รวม :</h5>
                    <input type="text" name="SumCom" style="text-align:right;" class="form-control" value="{{ number_format($SumAmount,2) }}"/>
                  </div>
                </div>
                <div class="table-responsive">
                  <table id="table1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class="text-center" style="width: 40px">วันที่รับ</th>
                        <th class="text-center" style="width: 40px">วันที่เปลี่ยนสถานะ</th>
                        <th class="text-center" style="width: 60px">เลขทะเบียน</th>
                        <th class="text-center" style="width: 40px">ที่มา</th>
                        <th class="text-center" style="width: 40px">ราคาต้นทุน</th>
                        <th class="text-center" style="width: 40px">ราคาเปิดประมูล</th>
                        <th class="text-center" style="width: 40px">ราคาปิดประมูล</th>
                        <th class="text-center" style="width: 40px">ผลรวม</th>
                        <th style="width: 10px"></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($data as $row)
                        <tr>
                          @php
                            $Sum = 0;
                            $SumAll = 0;
                            $create_date = date_create($row->create_date);
                            $date_status = date_create($row->Date_Status);
                            $Date_Soldout_plus = date_create($row->Date_Soldout_plus);
                          @endphp
                          <td class="text-center">
                            {{ date_format($create_date, 'd-m-Y')}}
                          </td>
                          @if($row->Date_Status == Null)
                            <td class="text-center"> - </td>
                          @else
                            <td class="text-center">{{ date_format($date_status, 'd-m-Y')}}</td>
                          @endif

                          <td class="text-left">{{$row->Number_Regist}}</td>
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
                          <td class="text-right">
                            @php
                              $Sum = $row->Fisrt_Price+$row->Repair_Price+$row->Offer_Price+$row->Color_Price+$row->Add_Price;
                            @endphp
                            {{number_format($Sum, 2)}}
                          </td>
                          <td class="text-right">{{number_format($row->Open_auction,2)}}</td>
                          <td class="text-right">{{number_format($row->Close_auction,2)}}</td>
                          <td class="text-right">
                            @php
                              $SumAll = $row->Close_auction - $Sum;
                            @endphp
                            {{number_format($SumAll, 2)}}
                          </td>
                          <td class="text-right">
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-default" title="ดูรายการ"
                              data-link="{{ action('DatacarController@viewsee',[$row->Datacar_id,$row->Car_type]) }}">
                              <i class="far fa-eye"></i>
                            </button>
                            <a href="{{ action('DatacarController@edit',[$row->Datacar_id,$row->Car_type]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                              <i class="far fa-edit"></i>
                            </a>
                            @if($type == 1)
                              <form method="post" class="delete_form" action="{{ action('DatacarController@destroy',$row->Datacar_id) }}" style="display:inline;">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="DELETE" />
                                <button type="submit" class="delete-modal btn btn-danger btn-sm" title="ลบรายการ" onclick="return confirm('คุณต้องการลบข้อมูลนี้หรือไม่?')">
                                  <i class="far fa-trash-alt"></i>
                                </button>
                              </form>
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
                        @if($type == 6)
                          <th class="text-center" style="width: 100px">วันที่ขาย</th>
                        @endif
                        <th class="text-center" style="width: 100px">เลขทะเบียน</th>
                        @if($type == 5)
                          <th class="text-center" style="width: 100px">ราคาขาย</th>
                          <th class="text-center" style="width: 70px">ลักษณะ</th>
                        @endif
                        <th class="text-center" style="width: 80px">ที่มา</th>
                        <th class="text-center" style="width: 60px">Job No.</th>
                        <th class="text-center" style="width: 100px">ประเภท</th>
                        <th class="text-center" style="width: 150px">หมายเหตุ</th>

                        <th style="width: 120px"></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($data as $row)
                        <tr>
                          @php
                            $create_date = date_create($row->create_date);
                            $date_status = date_create($row->Date_Status);
                            $Date_Soldout_plus = date_create($row->Date_Soldout_plus);
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

                          @if($type == 6)
                            <td class="text-center">{{ date_format($Date_Soldout_plus, 'd-m-Y')}}</td>
                          @endif
                          <td class="text-left">{{$row->Number_Regist}}</td>
                          @if($type == 5)
                            <td class="text-center">{{number_format($row->Net_Price, 2)}}</td>
                            <td class="text-center">{{$row->Model_Car}}</td>
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
                          <td class="text-center">{{$row->Job_Number}}</td>
                          <td class="text-left">
                            @if($row->Car_type == 1)
                              รถยนต์นำเข้าใหม่ @if($row->BorrowStatus == 1) <font color="red">(ยืม)</font> @endif
                            @elseif ($row->Car_type  == 2)
                              รถยนต์ระหว่างทำสี @if($row->BorrowStatus == 1) <font color="red">(ยืม)</font> @endif
                            @elseif ($row->Car_type  == 3)
                              รถยนต์รอซ่อม @if($row->BorrowStatus == 1) <font color="red">(ยืม)</font> @endif
                            @elseif ($row->Car_type  == 4)
                              รถยนต์ระหว่างซ่อม @if($row->BorrowStatus == 1) <font color="red">(ยืม)</font> @endif
                            @elseif ($row->Car_type  == 5)
                              รถยนต์พร้อมขาย @if($row->BorrowStatus == 1) <font color="red">(ยืม)</font> @endif
                            @elseif ($row->Car_type  == 6)
                              รถยนต์ขายแล้ว
                            @elseif ($row->Car_type  == 7)
                              รถยนต์ส่งประมูล
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

                          <td class="text-right">
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-default" title="ดูรายการ"
                              data-link="{{ action('DatacarController@viewsee',[$row->Datacar_id,$row->Car_type]) }}">
                              <i class="far fa-eye"></i>
                            </button>
                            @if($type != 6)
                              <a href="{{ action('DatacarController@edit',[$row->Datacar_id,$row->Car_type]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                              <i class="far fa-edit"></i> 
                              </a>
                            @elseif ($type == 6)
                              <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-buyinfo"
                                data-link="{{ action('DatacarController@edit',[$row->Datacar_id,$row->Car_type]) }}">
                                <i class="fas fa-file-invoice-dollar"></i> ข้อมูลขาย
                              </button>
                            @endif

                            @if($type == 1)
                              <form method="post" class="delete_form" action="{{ action('DatacarController@destroy',$row->Datacar_id) }}" style="display:inline;">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="DELETE" />
                                <button type="submit" class="delete-modal btn btn-danger btn-sm" title="ลบรายการ" onclick="return confirm('คุณต้องการลบข้อมูลนี้หรือไม่?')">
                                  <i class="far fa-trash-alt"></i>
                                </button>
                              </form>
                            @endif
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              @endif
            </div>
          </div>

          <a id="button"></a>
        </div>
      </div>
    </div>
  </section>

  @if($type != 12 and $type != 14)
    <form target="_blank" action="{{ route('datacar.report') }}" method="post">
      @csrf
      <div class="modal fade" id="modal-report" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">รายงานสต็อกรถยนต์</h5>
              <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body text-sm">
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
                  <div class="form-group clearfix">
                    <div class="icheck-primary d-inline">
                      <input type="checkbox" name="originType[]" id="checkboxPrimary1" value="1">
                      <label for="checkboxPrimary1">
                        รถ CKL
                      </label>
                    </div>
                    &nbsp;
                    <div class="icheck-primary d-inline">
                      <input type="checkbox" name="originType[]" id="checkboxPrimary2" value="2">
                      <label for="checkboxPrimary2">
                        รถประมูล
                      </label>
                    </div>
                    &nbsp;
                    <div class="icheck-primary d-inline">
                      <input type="checkbox" name="originType[]" id="checkboxPrimary3" value="3">
                      <label for="checkboxPrimary3">
                        รถยึด
                      </label>
                    </div>
                    &nbsp;
                    <div class="icheck-primary d-inline">
                      <input type="checkbox" name="originType[]" id="checkboxPrimary4" value="4">
                      <label for="checkboxPrimary4">
                        รถฝากขาย
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            <hr>
            </div>
            <input type="hidden" name="id" value="1">
            <div class="text-center">
              <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
              <button type="submit" class="btn btn-primary">ปริ้นรายงาน</button>
            </div>
            <br>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    </form>
  @endif

  <!-- Pop up รายละเอียดค่าใช้จ่าย -->
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

<script type="text/javascript">
    $("#close").click(function () {
      $("#modal-report").modal('hide');
      var Datepay = ''
      $('#Fromdate').val(Datepay);
      $('#Todate').val(Datepay);
    });
</script>

<script>
  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    $('.filter-container').filterizr({gutterPixels: 3});
    $('.btn[data-filter]').on('click', function() {
      $('.btn[data-filter]').removeClass('active');
      $(this).addClass('active');
    });
  })
</script>

@endsection
