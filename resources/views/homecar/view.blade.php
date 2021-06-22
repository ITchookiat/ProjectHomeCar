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

      <section class="content">
        <div class="row  justify-content-center">
          <div class="col-12 table-responsive">
            <div class="card">
              <div class="card-header">
                <h5><b>รายการ{{$title}}</b></h5>
              </div>
              <div class="card-body text-sm">
                {{-- ส่วนหัว --}}
                @if($type == 1 or $type == 6)
                  <div class="row">
                    <div class="col-md-12">
                      <form method="get" action="{{ route('datacar',$type) }}">
                        <div class="float-right form-inline">
                          @if($type == 1)
                            <a href="{{ route('datacar.create',1) }}" class="btn bg-success btn-app">
                              <span class="fas fa-plus"></span> เพิ่มข้อมูล
                            </a>
                            <div class="btn-group">
                              <button type="button" class="btn bg-primary btn-app" data-toggle="dropdown">
                                <span class="fas fa-print"></span> ปริ้นรายการ
                              </button>
                              <ul class="dropdown-menu" role="menu">
                                <li><a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-4" data-backdrop="static" data-keyboard="false">รายงาน สำหรับพนักงาน</a></li>
                                @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER" or auth::user()->position == "AUDIT")
                                  <li class="divider"></li>
                                  <li><a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-5" data-backdrop="static" data-keyboard="false">รายงาน สำหรับผู้บริหาร</a></li>
                                @endif
                              </ul>
                            </div>
                          @endif
                          <button type="submit" class="btn bg-warning btn-app">
                            <span class="fas fa-search"></span> Search
                          </button>
                        </div>

                        <div class="float-right form-inline">
                          @if($type != 6)
                            <label for="text" class="mr-sm-0">ประเภท :</label>
                            <select name="carType" class="form-control form-control-sm">
                              <option selected value="">---เลือกประเภทรถ---</option>
                              <option value="1" {{ ($carType == '1') ? 'selected' : '' }}>รถนำเข้าใหม่</option>
                              <option value="2" {{ ($carType == '2') ? 'selected' : '' }}>รถระหว่างทำสี</option>
                              <option value="3" {{ ($carType == '3') ? 'selected' : '' }}>รถรอซ่อม</option>
                              <option value="4" {{ ($carType == '4') ? 'selected' : '' }}>รถระหว่างซ่อม</option>
                              <option value="5" {{ ($carType == '5') ? 'selected' : '' }}>รถพร้อมขาย</option>
                              <option value="6" {{ ($carType == '6') ? 'selected' : '' }}>รถขายแล้ว</option>
                              <option value="7" {{ ($carType == '7') ? 'selected' : '' }}>รถส่งประมูล</option>
                            </select>
                          @endif
                          <label>จากวันที่ : </label>
                          <input type="date" name="Fromdate" value="{{ ($fdate != '') ?$fdate: date('Y-m-d') }}" class="form-control form-control-sm" />
                          <label>ถึงวันที่ : </label>
                          <input type="date" name="Todate" value="{{ ($tdate != '') ?$tdate: date('Y-m-d') }}" class="form-control form-control-sm" />
                        </div>
                      </form>
                    </div>
                  </div>
                @elseif($type == 14)
                  <div class="row">
                    <div class="col-md-12">
                      <form method="get" action="{{ route('datacar',$type) }}">
                        <div class="float-right form-inline">
                          <button type="button" class="btn bg-primary btn-app" data-toggle="dropdown">
                            <span class="fas fa-print"></span> ปริ้นรายการ
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal-6" data-backdrop="static" data-keyboard="false">รายงานรถส่งประมูล</a></li>
                          </ul>
                          <button type="submit" class="btn bg-warning btn-app">
                            <span class="fas fa-search"></span> Search
                          </button>
                        </div>
                        <div class="float-right form-inline"> 
                          <label>จากวันที่ : </label>
                          <input type="date" name="Fromdate" value="{{ ($fdate != '') ?$fdate: date('Y-m-d') }}" class="form-control form-control-sm" />
                          <label>ถึงวันที่ : </label>
                          <input type="date" name="Todate" value="{{ ($tdate != '') ?$tdate: date('Y-m-d') }}" class="form-control form-control-sm" />
                        </div>
                      </form>
                    </div>
                  </div>
                @endif

                {{-- เนื้อหา --}}
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
                                @if($row->StatPark_Homecar != null)
                                  <a id="edit" class="btn btn-success btn-sm" title="ส่งแล้ว">
                                    <span class="glyphicon glyphicon-lock"></span> Check In Stock
                                  </a>
                                @else 
                                  <a href="{{ route('datacar.Savestore', [$SetStr1,$SetStr2, 1]) }}" id="edit" class="btn btn-info btn-sm" title="จัดเตรียมเอกสาร">
                                    <span class="glyphicon glyphicon-edit"></span> Import Stock
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
                            <td class="text-center">{{ date_format($date_status, 'd-m-Y')}}</td>
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
                    <table id="table1" class="table table-hover">
                      <thead>
                        <tr>
                          <th class="text-center" style="width: 5px"></th>
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
                              <td class="text-center">
                                @if($row->PartStatus_Car == 'Y')
                                  <i class="fas fa-gears" title="ช่างมีการเพิ่มอะไหล่ซ่อม"></i>
                                @endif
                              </td>

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
                              @if($type != 44)
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-default" title="ดูรายการ"
                                  data-link="{{ action('DatacarController@viewsee',[$row->Datacar_id,$row->Car_type]) }}">
                                  <i class="far fa-eye"></i>
                                </button>
                              @endif
                              @if($type != 6 and $type != 44)
                                @if($row->Car_type != '6')
                                  <a href="{{ action('DatacarController@edit',[$row->Datacar_id,$row->Car_type]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                  <i class="far fa-edit"></i> 
                                  </a>
                                @endif
                              @endif
                              @if ($type == 6)
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-buyinfo"
                                  data-link="{{ action('DatacarController@edit',[$row->Datacar_id,$row->Car_type]) }}">
                                  <i class="fas fa-file-invoice-dollar"></i> ข้อมูลขาย
                                </button>
                              @endif

                              @if ($type == 44)
                                <a href="{{ action('DatacarController@edit',[$row->Datacar_id,44]) }}" class="btn btn-primary btn-sm" title="เพิ่มรายการซ่อม">
                                  <i class="far fa-edit"></i> การซ่อม
                                </a>
                              @endif

                              @if($type == 1)
                                @if(auth::user()->position != "STAFF")
                                  <form method="post" class="delete_form" action="{{ action('DatacarController@destroy',$row->Datacar_id) }}" style="display:inline;">
                                    {{csrf_field()}}
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <input type="hidden" name="type" value="1" />
                                    <button type="submit" data-name="{{ $row->Number_Regist }}" class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                      <i class="far fa-trash-alt"></i>
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
            </div>

            <a id="button"></a>
          </div>
        </div>
      </section>
    </div>
  </section>

  <div class="modal fade" id="modal-4">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body">
          <div class="card card-warning">
            <div class="card-header">
              <h4 class="card-title">รายงานสต็อกรถยนต์</h4>
              <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
          </div>
      </div>
        <div class="modal-body text-sm">
          <form target="_blank" action="{{ action('DatacarController@ReportPDFIndex') }}" method="post">
            @csrf
            <input type="hidden" name="type" value="1">
            <div class="row">
              <div class="col-6">
                <div class="form-group row mb-1">
                  <label class="col-sm-3 col-form-label text-right">จากวันที่ : </label>
                  <div class="col-sm-8">
                  <input type="date" id="Fromdate" name="Fromdate" value="{{ date('Y-m-d') }}" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row mb-1">
                <label class="col-sm-3 col-form-label text-right">ถึงวันที่ : </label>
                  <div class="col-sm-8">
                    <input type="date" id="Todate" name="Todate" value="{{ date('Y-m-d') }}" class="form-control" />
                  </div>
                </div>
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-sm-2 text-center">
                <label>สถานะ : </label>
              </div>
              <div class="col-sm-3">
                <div class="form-group text-left">
                  <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="customRadio1" name="typeCar" value="1">
                    <label for="customRadio1" class="custom-control-label">รถนำเข้าใหม่</label>
                  </div>
                  <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="customRadio2" name="typeCar" value="2">
                    <label for="customRadio2" class="custom-control-label">รถระหว่างทำสี</label>
                  </div>
                  <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="customRadio3" name="typeCar" value="3">
                    <label for="customRadio3" class="custom-control-label">รถรอซ่อม</label>
                  </div>
                </div>
              </div> 
              
              <div class="col-sm-3">
                <div class="form-group">
                  <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="customRadio4" name="typeCar" value="4">
                    <label for="customRadio4" class="custom-control-label">รถระหว่างซ่อม</label>
                  </div>
                  <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="customRadio5" name="typeCar" value="5">
                    <label for="customRadio5" class="custom-control-label">รถพร้อมขาย</label>
                  </div>
                  <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="customRadio6" name="typeCar" value="6">
                    <label for="customRadio6" class="custom-control-label">รถขายแล้ว</label>
                  </div>
                </div>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="customRadio8" name="typeCar" value="7">
                    <label for="customRadio8" class="custom-control-label">รถส่งประมูล</label>
                  </div>
                </div>
              </div>
            </div>
  
            <div class="row">
              <div class="col-sm-2 text-center">
                <label>ที่มาของรถ : </label>
              </div>
              <div class="col-sm-3">
                <div class="form-group text-left">
                  <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="customRadio9" name="originType" value="1">
                    <label for="customRadio9" class="custom-control-label">CKL</label>
                  </div>
                  <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="customRadio10" name="originType" value="2">
                    <label for="customRadio10" class="custom-control-label">รถประมูล</label>
                  </div>
                </div>
              </div> 
              
              <div class="col-sm-3">
                <div class="form-group">
                  <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="customRadio11" name="originType" value="3">
                    <label for="customRadio11" class="custom-control-label">รถยึด</label>
                  </div>
                  <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="customRadio12" name="originType" value="4">
                    <label for="customRadio12" class="custom-control-label">รถฝากขาย</label>
                  </div>
                </div>
              </div>

            </div>
            <div class="card-footer text-center">
              <button type="submit" class="btn bg-warning btn-app">
                <i class="fas fa-search"></i> print
              </button>
              <a class="btn btn-app bg-danger" href="{{ route('datacar',1) }}">
                <i class="fas fa-times"></i> ยกเลิก
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal-5">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body">
          <div class="card card-danger">
            <div class="card-header">
              <h4 class="card-title">รายงานสต็อกรถยนต์</h4>
              <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
          </div>
      </div>
        <div class="modal-body text-sm">
          <form target="_blank" action="{{ action('DatacarController@ReportPDFIndex') }}" method="post">
            @csrf
            <input type="hidden" name="type" value="2">
            <div class="row">
              <div class="col-6">
                <div class="form-group row mb-1">
                  <label class="col-sm-3 col-form-label text-right">จากวันที่ : </label>
                  <div class="col-sm-8">
                  <input type="date" id="Fromdate" name="Fromdate" value="{{ date('Y-m-d') }}" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row mb-1">
                <label class="col-sm-3 col-form-label text-right">ถึงวันที่ : </label>
                  <div class="col-sm-8">
                    <input type="date" id="Todate" name="Todate" value="{{ date('Y-m-d') }}" class="form-control" />
                  </div>
                </div>
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-sm-2 text-center">
                <label>สถานะ : </label>
              </div>
              <div class="col-sm-3">
                <div class="form-group text-left">
                  <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="customRadio11" name="typeCar" value="1">
                    <label for="customRadio11" class="custom-control-label">รถนำเข้าใหม่</label>
                  </div>
                  <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="customRadio22" name="typeCar" value="2">
                    <label for="customRadio22" class="custom-control-label">รถระหว่างทำสี</label>
                  </div>
                  <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="customRadio33" name="typeCar" value="3">
                    <label for="customRadio33" class="custom-control-label">รถรอซ่อม</label>
                  </div>
                </div>
              </div> 
              
              <div class="col-sm-3">
                <div class="form-group">
                  <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="customRadio44" name="typeCar" value="4">
                    <label for="customRadio44" class="custom-control-label">รถระหว่างซ่อม</label>
                  </div>
                  <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="customRadio55" name="typeCar" value="5">
                    <label for="customRadio55" class="custom-control-label">รถพร้อมขาย</label>
                  </div>
                  <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="customRadio66" name="typeCar" value="6">
                    <label for="customRadio66" class="custom-control-label">รถขายแล้ว</label>
                  </div>
                </div>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="customRadio88" name="typeCar" value="7">
                    <label for="customRadio88" class="custom-control-label">รถส่งประมูล</label>
                  </div>
                </div>
              </div>
            </div>
  
            <div class="row">
              <div class="col-sm-2 text-center">
                <label>ที่มาของรถ : </label>
              </div>
              <div class="col-sm-3">
                <div class="form-group text-left">
                  <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="customRadio99" name="originType" value="1">
                    <label for="customRadio99" class="custom-control-label">CKL</label>
                  </div>
                  <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="customRadio101" name="originType" value="2">
                    <label for="customRadio101" class="custom-control-label">รถประมูล</label>
                  </div>
                </div>
              </div> 
              
              <div class="col-sm-3">
                <div class="form-group">
                  <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="customRadio111" name="originType" value="3">
                    <label for="customRadio111" class="custom-control-label">รถยึด</label>
                  </div>
                  <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="customRadio121" name="originType" value="4">
                    <label for="customRadio121" class="custom-control-label">รถฝากขาย</label>
                  </div>
                </div>
              </div>

            </div>
            <div class="card-footer text-center">
              <button type="submit" class="btn bg-warning btn-app">
                <i class="fas fa-search"></i> print
              </button>
              <a class="btn btn-app bg-danger" href="{{ route('datacar',1) }}" >
                <i class="fas fa-times"></i> ยกเลิก
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal-6">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body">
          <div class="card card-warning">
            <div class="card-header">
              <h4 class="card-title">รายงานรถส่งประมูล</h4>
              <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
          </div>
      </div>
        <div class="modal-body text-sm">
          <form target="_blank" action="{{ action('DatacarController@ReportPDFIndex') }}" method="post">
            @csrf
            <input type="hidden" name="type" value="3">
            <div class="row">
              <div class="col-6">
                <div class="form-group row mb-1">
                  <label class="col-sm-3 col-form-label text-right">จากวันที่ : </label>
                  <div class="col-sm-8">
                  <input type="date" id="Fromdate" name="Fromdate" value="{{ date('Y-m-d') }}" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group row mb-1">
                <label class="col-sm-3 col-form-label text-right">ถึงวันที่ : </label>
                  <div class="col-sm-8">
                    <input type="date" id="Todate" name="Todate" value="{{ date('Y-m-d') }}" class="form-control" />
                  </div>
                </div>
              </div>
            </div>
            <br>

            <div class="card-footer text-center">
              <button type="submit" class="btn bg-warning btn-app">
                <i class="fas fa-search"></i> print
              </button>
              <a class="btn btn-app bg-danger" href="{{ route('datacar',1) }}" >
                <i class="fas fa-times"></i> ยกเลิก
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

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
@endsection
