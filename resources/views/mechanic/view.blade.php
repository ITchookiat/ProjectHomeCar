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
              <h4><b>{{$title}}</b></h4>
            </div>
            <div class="card-body text-sm">
              @if($type == 100)
                <form method="get" action="{{ route('datacar',$type) }}">
                  <div class="row mb-1">
                    <div class="col-md-12">
                      <div class="float-right form-inline">
                        <label for="text" class="mr-sm-0">สถานะ :</label>
                        <select name="carType" class="form-control">
                          <option selected value="">---เลือกสถานะ---</option>
                          <option value="1" {{ ($carType == '1') ? 'selected' : '' }}>รถนำเข้าใหม่</option>
                          <option value="2" {{ ($carType == '2') ? 'selected' : '' }}>รถระหว่างทำสี</option>
                          <option value="3" {{ ($carType == '3') ? 'selected' : '' }}>รถรอซ่อม</option>
                          <option value="4" {{ ($carType == '4') ? 'selected' : '' }}>รถระหว่างซ่อม</option>
                          <!-- <option value="7" {{ ($carType == '7') ? 'selected' : '' }}>รถส่งประมูล</option> -->
                        </select>
                        <label>จากวันที่ : </label>
                        <input type="date" name="Fromdate" value="{{ ($fdate != '') ?$fdate: '' }}" class="form-control" />
                        <label>ถึงวันที่ : </label>
                        <input type="date" name="Todate" value="{{ ($tdate != '') ?$tdate: '' }}" class="form-control" />
                    <!-- <a href="#" class="btn bg-success btn-app" data-toggle="modal" data-target="#modal-add" title="เพิ่มรายการรถ">
                          <span class="fas fa-plus"></span> เพิ่มข้อมูล
                        </a> -->
                        <button type="submit" class="btn bg-warning btn-app">
                          <span class="fas fa-search"></span> Search
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
              @endif

                <div class="table-responsive">
                  <table id="table1" class="table table-hover">
                    <thead>
                      <tr>
                        <th class="text-center" style="width: 5px"></th>
                        <!-- <th class="text-center" style="width: 30px">ที่</th> -->
                        <th class="text-center" style="width: 100px">วันที่รับ</th>
                        <th class="text-center" style="width: 100px">เลขทะเบียน</th>
                        <th class="text-center" style="width: 70px">ลักษณะ</th>
                        <th class="text-center" style="width: 70px">รุ่น</th>
                        <th class="text-center" style="width: 70px">สี</th>
                        <th class="text-center" style="width: 80px">ที่มา</th>
                        <th class="text-center" style="width: 60px">Job No.</th>
                        <th class="text-center" style="width: 100px">ประเภท</th>
                        <th class="text-center" style="width: 150px">หมายเหตุ</th>
                        <th style="width: 100px"></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($data as $key => $row)
                        <tr>
                          @php
                            $create_date = date_create($row->create_date);
                            $date_status = date_create($row->Date_Status);
                            $Date_Soldout_plus = date_create($row->Date_Soldout_plus);
                          @endphp
                          <td class="text-center">
                            @if($row->PartStatus_Car == 'Y')
                              <i class="fas fa-gears" title="มีการเพิ่มอะไหล่ซ่อม"></i>
                            @endif
                          </td>
                          <!-- <td class="text-center">
                              {{$key+1}}
                          </td> -->
                          <td class="text-center">
                            {{ date_format($create_date, 'd-m-Y')}}
                          </td>

                          <td class="text-left">{{$row->Number_Regist}}</td>
                          <td class="text-center">{{$row->Model_Car}}</td>
                          <td class="text-center">{{$row->Version_Car}}</td>
                          <td class="text-center">{{$row->Color_Car}}</td>
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
                            <!-- <a href="{{ action('DatacarController@edit',[$row->Datacar_id,$row->Car_type]) }}?extra={{1}}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                              <i class="far fa-edit"></i> แก้ไข
                            </a> -->
                            <a href="{{ action('DatacarController@edit',[$row->Datacar_id,100]) }}" class="btn btn-primary btn-sm" title="เพิ่มรายการซ่อม">
                              <i class="far fa-edit"></i> การซ่อม
                            </a>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>

            </div>
          </div>

          <a id="button"></a>
        </div>
      </div>
    </div>
  </section>

  <form name="form2" action="{{ route('MasterDatacar.store') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="type" value="3">
    <div class="modal fade" id="modal-add">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-success">
            <div class="col text-center">
              <h5 class="modal-title"> เพิ่มข้อมูลรถ </h5>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row mb-2">
              <div class="col-md-6">
                <font color="red">* เลขทะเบียน</font>
                <input type="text" name="Number_Regist" class="form-control form-control-sm" placeholder="ป้อนเลขทะเบียน" required/>
              </div>
              <div class="col-md-6">
                <font color="red">* ยี่ห้อรถ</font>
                <select name="BrandCar" class="form-control form-control-sm" required>
                  <option value="" selected>--- เลือกยี่ห้อรถ ---</option>
                  <option value="TOYOTA">TOYOTA</option>
                  <option value="MAZDA">MAZDA</option>
                  <option value="NISSAN">NISSAN</option>
                  <option value="FORD">FORD</option>
                  <option value="MITSUBISHI">MITSUBISHI</option>
                  <option value="ISUZU">ISUZU</option>
                  <option value="HONDA">HONDA</option>
                  <option value="CHEVROLET">CHEVROLET</option>
                  <option value="SUZUKI">SUZUKI</option>
                  <option value="MG">MG</option>
                </select>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-md-6">
                ลักษณะรถ
                <select name="ModelCar" class="form-control form-control-sm">
                  <option value="" selected>--- เลือกลักษณะรถ ---</option>
                  <option value="เก๋ง">เก๋ง</option>
                  <option value="cab">cab</option>
                  <option value="Hi 4Dr">Hi 4Dr</option>
                  <option value="Hi Cab">Hi Cab</option>
                  <option value="Hi 4WD">Hi 4WD</option>
                  <option value="Hi 4Dr 4WD">Hi 4Dr 4WD</option>
                  <option value="STD">STD</option>
                  <option value="4DR">4DR</option>
                  <option value="Van">Van</option>
                  <option value="Van 4WD">Van 4WD</option>
                </select>
              </div>
              <div class="col-md-6">
                รุ่นรถ
                <input type="text" name="VersionCar" class="form-control form-control-sm" placeholder="ป้อนรุ่นรถ" />
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                ราคาประเมิณซ่อม
                <input type="number" name="ExpectRepairPrice" class="form-control form-control-sm" placeholder="ป้อนราคาประเมิณ" />
              </div>
              <div class="col-md-6">
                ราคาประเมิณทำสี
                <input type="number" name="ExpectColorPrice" class="form-control form-control-sm" placeholder="ป้อนราคาประเมิณ" />
              </div>
            </div>
          </div>
          <input type="hidden" name="Nameuser" value="{{auth::user()->name}}"/>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success text-center"><i class="fas fa-save"></i> บันทึก</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-window-close"></i> ยกเลิก</button>
          </div>
        </div>
      </div>
    </div>
  </form>


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

@endsection
