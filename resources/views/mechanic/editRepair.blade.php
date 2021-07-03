@extends('layouts.master')
@section('title','แก้ไขข้อมูลรถยนต์')
@section('content')

  <link type="text/css" rel="stylesheet" href="{{ asset('css/magiczoomplus.css') }}"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>

  <script type="text/javascript" src="{{ asset('js/magiczoomplus.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  @php
    function DateThai($strDate)
      {
      $strYear = date("Y",strtotime($strDate))+543;
      $strMonth= date("n",strtotime($strDate));
      $strDay= date("d",strtotime($strDate));
      $strMonthCut = Array("" , "01","02","03","04","05","06","07","08","09","10","11","12");
      //$strMonthCut = Array("" , "ม.ค","ก.พ","มี.ค","เม.ย","พ.ค","มิ.ย","ก.ค","ส.ค","ก.ย","ต.ค","พ.ย","ธ.ค");
      $strMonthThai=$strMonthCut[$strMonth];
      //return "$strDay $strMonthThai $strYear";
      return "$strDay/$strMonthThai/$strYear";
      }
  @endphp
  @php
    date_default_timezone_set('Asia/Bangkok');
    $Y = date('Y') + 543;
    $Y2 = date('Y') + 531;
    $m = date('m');
    $d = date('d');
    //$date = date('Y-m-d');
    $time = date('H:i');
    $date = $Y.'-'.$m.'-'.$d;
    $date2 = $Y2.'-'.'01'.'-'.'01';
    $date3 = $Y.'-'.'01'.'-'.'01';
  @endphp

<style>
  #todo-list{
  width:100%;
  margin:0 auto 190px auto;
  padding:5px;
  background:white;
  position:relative;
  /*box-shadow*/
  -webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);
  -moz-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);
        box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);
  /*border-radius*/
  -webkit-border-radius:5px;
  -moz-border-radius:5px;
        border-radius:5px;}
  #todo-list:before{
  content:"";
  position:absolute;
  z-index:-1;
  /*box-shadow*/
  -webkit-box-shadow:0 0 20px rgba(0,0,0,0.4);
  -moz-box-shadow:0 0 20px rgba(0,0,0,0.4);
        box-shadow:0 0 20px rgba(0,0,0,0.4);
  top:50%;
  bottom:0;
  left:10px;
  right:10px;
  /*border-radius*/
  -webkit-border-radius:100px / 10px;
  -moz-border-radius:100px / 10px;
        border-radius:100px / 10px;
  }
  .todo-wrap{
  display:block;
  position:relative;
  padding-left:35px;
  /*box-shadow*/
  -webkit-box-shadow:0 2px 0 -1px #ebebeb;
  -moz-box-shadow:0 2px 0 -1px #ebebeb;
        box-shadow:0 2px 0 -1px #ebebeb;
  }
  .todo-wrap:last-of-type{
  /*box-shadow*/
  -webkit-box-shadow:none;
  -moz-box-shadow:none;
        box-shadow:none;
  }
  input[type="checkbox"]{
  position:absolute;
  height:0;
  width:0;
  opacity:0;
  /* top:-600px; */
  }
  .todo{
  display:inline-block;
  font-weight:200;
  padding:10px 5px;
  height:37px;
  position:relative;
  }
  .todo:before{
  content:'';
  display:block;
  position:absolute;
  top:calc(50% + 10px);
  left:0;
  width:0%;
  height:1px;
  background:#cd4400;
  /*transition*/
  -webkit-transition:.25s ease-in-out;
  -moz-transition:.25s ease-in-out;
    -o-transition:.25s ease-in-out;
        transition:.25s ease-in-out;
  }
  .todo:after{
  content:'';
  display:block;
  position:absolute;
  z-index:0;
  height:18px;
  width:18px;
  top:9px;
  left:-25px;
  /*box-shadow*/
  -webkit-box-shadow:inset 0 0 0 2px #d8d8d8;
  -moz-box-shadow:inset 0 0 0 2px #d8d8d8;
        box-shadow:inset 0 0 0 2px #d8d8d8;
  /*transition*/
  -webkit-transition:.25s ease-in-out;
  -moz-transition:.25s ease-in-out;
    -o-transition:.25s ease-in-out;
        transition:.25s ease-in-out;
  /*border-radius*/
  -webkit-border-radius:4px;
  -moz-border-radius:4px;
        border-radius:4px;
  }
  .todo:hover:after{
  /*box-shadow*/
  -webkit-box-shadow:inset 0 0 0 2px #949494;
  -moz-box-shadow:inset 0 0 0 2px #949494;
        box-shadow:inset 0 0 0 2px #949494;
  }
  .todo .fa-check{
  position:absolute;
  z-index:1;
  left:-31px;
  top:0;
  font-size:1px;
  line-height:36px;
  width:36px;
  height:36px;
  text-align:center;
  color:transparent;
  text-shadow:1px 1px 0 white, -1px -1px 0 white;
  }
  :checked + .todo{
  color:#717171;
  }
  :checked + .todo:before{
  width:100%;
  }
  :checked + .todo:after{
  /*box-shadow*/
  -webkit-box-shadow:inset 0 0 0 2px #0eb0b7;
  -moz-box-shadow:inset 0 0 0 2px #0eb0b7;
        box-shadow:inset 0 0 0 2px #0eb0b7;
  }
  :checked + .todo .fa-check{
  font-size:20px;
  line-height:35px;
  color:#0eb0b7;
  }

</style>

    <!-- Main content -->
    <section class="content">
      <div class="content-header">
        @if(session()->has('success'))
          <script type="text/javascript">
            toastr.success('{{ session()->get('success') }}')
          </script>
        @endif
        <div class="card">
          
            <div class="card-header">
              {{-- <a href="#" class="btn btn-default btn-sm float-right" title="เพิ่มรูปรถ" data-toggle="modal" data-target="#modal-default">
                <i class="far fa-image"></i> 
              </a> --}}
              <div class="row">
                <div class="col-4">
                  <div class="form-inline">
                      <h5>รายการซ่อมรถ</h5>
                  </div>
                </div>
                <div class="col-8">
                  <div class="card-tools d-inline float-right">
                    <button type="button" class="delete-modal btn btn-primary" data-toggle="modal" data-target="#modal-default">
                      <i class="fas fa-gear"></i> เพิ่มรายการ
                    </button>
                    <!-- <button type="button" class="delete-modal btn btn-warning" data-toggle="modal" data-target="#modal-adds">
                      <i class="fas fa-gear"></i> เพิ่มรายการ2
                    </button> -->
                    <!-- <button type="submit" class="delete-modal btn btn-success">
                      <i class="fas fa-save"></i> อัพเดท
                    </button> -->
                    <a class="delete-modal btn btn-danger" href="{{ route('datacar',100) }}">
                      <i class="far fa-window-close"></i> ยกเลิก
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-4 text-sm">
                  <form name="form1" method="post" action="{{ action('DatacarController@updateMechanic',$id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card card-warning">
                      <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-info-circle"></i> ข้อมูลทั่วไป 
                            @if($datacar->BookStatus_Car == 'จอง')
                              ( <font color="blue">รถยนต์ติดจอง</font> )                            
                            @endif
                        </h3>
    
                        <div class="card-tools">
                          <button type="submit" class="delete-modal btn-tool btn-xs btn btn-success">
                            <i class="fas fa-save"></i> อัพเดท
                          </button>
                          <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                          </button>
                          <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                          </button> -->
                        </div>
                      </div>
                      <div class="card-body">

                        <div class="card card-default">
                          <div class="card-header">
                            <h5 class="card-title">ข้อมูลอัพเดท</h5>
                            <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                              </button>
                              <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                              </button> -->
                            </div>
                          </div>
                          <div class="card-body" style="display: block;">
                            <div class="row">
                              <div class="col-12">
                                <div class="form-group row mb-1">
                                  <label class="col-sm-4 col-form-label text-right">สถานะ:</label>
                                  <div class="col-sm-7">
                                    <select id="Cartype" name="Cartype" class="form-control form-control-sm" {{ ($datacar->Car_type == 6) ? 'readonly' : '' }}>
                                        <option value="1" {{ ($datacar->Car_type == 1) ? 'selected' : '' }}>รถยนต์นำเข้าใหม่</option>
                                        <option value="2" {{ ($datacar->Car_type == 2) ? 'selected' : '' }}>รถยนต์ระหว่างทำสี</option>
                                        <option value="3" {{ ($datacar->Car_type == 3) ? 'selected' : '' }}>รถยนต์รอซ่อม</option>
                                        <option value="4" {{ ($datacar->Car_type == 4) ? 'selected' : '' }}>รถยนต์ระหว่างซ่อม</option>
                                        <option value="5" {{ ($datacar->Car_type == 5) ? 'selected' : '' }}>รถยนต์พร้อมขาย</option>
                                        <option value="6" {{ ($datacar->Car_type == 6) ? 'selected' : '' }}>รถยนต์ที่ขายแล้ว</option>
                                        <option value="7" {{ ($datacar->Car_type == 7) ? 'selected' : '' }}>รถยนต์ส่งประมูล</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="form-group row mb-1">
                                  <label class="col-sm-4 col-form-label text-right">ราคาซ่อม :</label>
                                  <div class="col-sm-7">
                                    <input type="text" name="RepairCar" class="form-control form-control-sm" value="{{number_format($datacar->Repair_Price, 0)}}"/>
                                  </div>
                                </div>
                              </div><div class="col-12">
                                <div class="form-group row mb-1">
                                  <label class="col-sm-4 col-form-label text-right">ราคาทำสี :</label>
                                  <div class="col-sm-7">
                                    <input type="text" name="ColorPrice" class="form-control form-control-sm" value="{{number_format($datacar->Color_Price, 0)}}"/>
                                  </div>
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="form-group row mb-1">
                                  <label class="col-sm-4 col-form-label text-right">วันที่เริ่มทำสี :</label>
                                  <div class="col-sm-7">
                                    <input type="date" name="StartColor" class="form-control form-control-sm" value="{{$datacar->Startcolor_Car}}" />
                                  </div>
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="form-group row mb-1">
                                  <label class="col-sm-4 col-form-label text-right">วันที่เสร็จทำสี :</label>
                                  <div class="col-sm-7">
                                    <input type="date" name="EndColor" class="form-control form-control-sm" value="{{$datacar->Endcolor_Car}}" />
                                  </div>
                                </div>
                              </div>
                              @foreach($dataRepair as $key => $value)
                                @php 
                                  @$TotalRepairPrice += $value->Repair_amount * $value->Repair_price;
                                @endphp
                              @endforeach
                              <input type="hidden" name="TotalRepairPrice" value="{{@$TotalRepairPrice}}"/>
                            </div>
                          </div>
                        </div>

                        <div class="card card-default collapsed-card">
                          <div class="card-header">
                            <h5 class="card-title">ข้อมูลรถยนต์</h5>
                            <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                              </button>
                            </div>
                          </div>
                          <div class="card-body" style="display: none;">
                            <div class="row">
                              <div class="col-12">
                                <div class="form-group row mb-1">
                                  <label class="col-sm-4 col-form-label text-right"> วันที่ซื้อ :</label>
                                  <div class="col-sm-7">
                                    <input type="date" class="form-control form-control-sm" value="{{$datacar->create_date}}" readonly>
                                  </div>
                                </div>
                              </div>

                              <div class="col-12">
                                <div class="form-group row mb-1">
                                  <label class="col-sm-4 col-form-label text-right">เลขทะเบียน :</label>
                                  <div class="col-sm-7">
                                    <input type="text" class="form-control form-control-sm" value="{{$datacar->Number_Regist}}" readonly/>
                                  </div>
                                </div>
                              </div>
                              
                              <div class="col-12">
                                <div class="form-group row mb-1">
                                  <label class="col-sm-4 col-form-label text-right"> ยี่ห้อรถ :</label>
                                  <div class="col-sm-7">
                                    <select class="form-control form-control-sm" readonly>
                                      @foreach ($arrayBrand as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $datacar->Brand_Car) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                              </div>
                              
                              {{--<div class="col-12">
                                <div class="form-group row mb-1">
                                  <label class="col-sm-4 col-form-label text-right">ที่มาของรถ :</label>
                                  <div class="col-sm-7">
                                    <select class="form-control form-control-sm" readonly>
                                      @foreach ($arrayOriginType as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $datacar->Origin_Car) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                              </div>--}}

                              <div class="col-12">
                                <div class="form-group row mb-1">
                                  <label class="col-sm-4 col-form-label text-right">Sale :</label>
                                  <div class="col-sm-7">
                                    <input type="text" class="form-control form-control-sm" value="{{$datacar->Name_Sale}}" readonly/>
                                  </div>
                                </div>
                              </div>

                              <div class="col-12">
                                <div class="form-group row mb-1">
                                  <label class="col-sm-4 col-form-label text-right">ลักษณะรถ :</label>
                                  <div class="col-sm-7">
                                    <select class="form-control form-control-sm" readonly>
                                      @foreach ($arrayModel as $key => $value)
                                        <option value="{{$key}}" {{ ($key == $datacar->Model_Car) ? 'selected' : '' }}>{{$value}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                              </div>

                              <div class="col-12">
                                <div class="form-group row mb-1">
                                  <label class="col-sm-4 col-form-label text-right">รุ่นรถ :</label>
                                  <div class="col-sm-7">
                                    <input type="text" class="form-control form-control-sm" value="{{$datacar->Version_Car}}" readonly/>
                                  </div>
                                </div>
                              </div>

                              <div class="col-12">
                                <div class="form-group row mb-1">
                                  <label class="col-sm-4 col-form-label text-right">ขนาด :</label>
                                  <div class="col-sm-7">
                                    <input type="text" class="form-control form-control-sm" value="{{$datacar->Size_Car}}" readonly/>
                                </div>
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="form-group row mb-1">
                                  <label class="col-sm-4 col-form-label text-right">สีรถ :</label>
                                  <div class="col-sm-7">
                                    <input type="text" class="form-control form-control-sm" value="{{$datacar->Color_Car}}" readonly/>
                                  </div>
                                </div>
                              </div>

                              <div class="col-12">
                                <div class="form-group row mb-1">
                                  <label class="col-sm-4 col-form-label text-right">Job Number :</label>
                                  <div class="col-sm-7">
                                    <input type="text" class="form-control form-control-sm" value="{{$datacar->Job_Number}}" readonly/>
                                  </div>
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="form-group row mb-1">
                                  <label class="col-sm-4 col-form-label text-right">เลขตัวถัง :</label>
                                  <div class="col-sm-7">
                                    <input type="text" name="ChassisCar" class="form-control form-control-sm" value="{{$datacar->Chassis_car}}" />
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
 
                      
                      </div>
                      <input type="hidden" name="_method" value="PATCH"/>
                      <input type="hidden" name="type" value="1">
                    </div>
                  </form>
                </div>

                <div class="col-md-8 text-sm">
                  <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title"><i class="fas fa-tasks"></i> รายการที่ซ่อม</h3>
                      <div class="card-tools">
                        <!-- <button type="button" class="btn btn-lg btn-tool text-white" data-toggle="modal" data-target="#modal-default" title="เพิ่มรายการซ่อม">
                          <i class="fas fa-plus-circle"></i>
                        </button> -->
                        <button type="button" class="btn btn-tool btn-xs btn-warning" data-toggle="modal" data-target="#modal-adds">
                          <i class="fas fa-plus-circle"></i> เพิ่ม
                        </button>
                        @if($countdataRepair != 0)
                          <a target="_blank" class="btn btn-tool btn-xs btn btn-success" href="{{ route('MasterDatacar.show',[$datacar->Main_id]) }}?type={{1}}" title="พิมพ์รายการซ่อม"> 
                            <i class="fas fas fa-print"></i> ปริ้น
                          </a>
                        @endif
                      </div>
                    </div>
                    <div class="card-body">
                      <table class="table table-bordered text-xs">
                        <thead>                  
                          <tr>
                          @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER" or auth::user()->position == "AUDIT" or auth::user()->position == "STAFF")
                            <th class="text-center" style="width: 75px">#</th>
                          @endif
                            <th style="width: 10px">ที่</th>
                            <th class="text-center" style="width: 90px">วันที่</th>
                            <th>รายการอะไหล่ / รายละเอียด</th>
                            <th class="text-center" style="width: 50px">จำนวน</th>
                            <th class="text-right" style="width: 50px">หน่วย</th>
                            <th class="text-right" style="width: 90px">ราคา</th>
                            <th class="text-right" style="width: 90px">รวมเป็นเงิน</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($dataRepair as $key => $value)
                            @php 
                              @$Totalprice += $value->Repair_amount * $value->Repair_price;
                            @endphp
                            <tr>
                              @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER" or auth::user()->position == "AUDIT" or auth::user()->position == "STAFF")
                              <td class="text-right">
                                <div class="form-inline">
                                  <form method="post" class="delete_form" action="{{ action('DatacarController@destroy',$value->Repair_id) }}?Datacar_id={{$value->Datacar_id}}" style="display:inline;">
                                  {{csrf_field()}}
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <input type="hidden" name="type" value="2" />
                                    <button type="submit" data-name="รายการ {{$value->Repair_list}}" class="delete-modal btn btn-xs AlertForm text-red" title="ลบรายการ">
                                      <i class="far fa-trash-alt"></i>
                                    </button>
                                  </form>
                                  <button class="btn btn-xs text-warning" title="แก้ไขรายการ" data-toggle="modal" data-target="#modal-editlist"
                                    data-link="{{ route('MasterDatacar.show',[$value->Repair_id]) }}?type={{2}}">
                                    <i class="far fa-edit"></i> 
                                  </button>
                                </div>
                              </td>
                              @endif
                              <td>{{$key+1}}</td>
                              <td>
                              <span title="ผู้เพิ่ม : {{$value->Repair_useradd}}">{{DateThai($value->Repair_date)}}</span>
                              </td>
                              <td>
                                {{$value->Repair_list}}
                                @if($value->Repair_detail != null)
                                  @if($value->Repair_list != null)<br>@endif
                                <i class="fa fa-minus text-xs"></i>
                                {{$value->Repair_detail}}
                                @endif
                              </td>
                              <td class="text-center">{{$value->Repair_amount}}</td>
                              <td class="text-left">{{$value->Repair_unit}}</td>
                              <td class="text-right">
                                @if($value->Repair_list != null)
                                  {{number_format($value->Repair_price,2)}}
                                @endif
                              </td>
                              <td class="text-right">
                                @if($value->Repair_list != null)
                                  {{number_format($value->Repair_amount * $value->Repair_price,2)}}
                                @endif
                              </td>
                            </tr>
                          @endforeach
                          @if($countdataRepair != 0)
                            <tr>
                            @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER" or auth::user()->position == "AUDIT" or auth::user()->position == "STAFF")
                              <td colspan="6"></td>
                            @else
                              <td colspan="5"></td>
                            @endif
                              <td class="text-right"><b>รวมทั้งสิ้น</b></td>
                              <td class="text-right"><b>{{number_format(@$Totalprice,2)}}</b></td>
                            </tr>
                          @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <input type="hidden" id="mySelect1" class="form-control" name="DateNumberUserHidden" >
              <input type="hidden" id="mySelect2" class="form-control" name="DateExpireHidden" >

            </div>

          <a id="button"></a>
        </div>
      </div>
    </section>

  <form name="form2" action="{{ route('MasterDatacar.store') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="type" value="2">
    <div class="modal fade" id="modal-default">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <div class="col text-center">
              <h5 class="modal-title"><i class="fas fa-gears"></i> เพิ่มรายการซ่อม</h5>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row mb-2">
              <div class="col-md-2"></div>
              <div class="col-md-6">
                วันที่
                <input type="date" name="DateList" class="form-control" required/>
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-md-2"></div>
              <div class="col-md-9">
                รายการอะไหล่
                <input type="text" name="RepairList" class="form-control" />
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-md-2"></div>
              <div class="col-md-3">
                จำนวน
                <input type="number" name="RepairAmount" class="form-control" />
              </div>
              <div class="col-md-3">
                หน่วย
                <input type="text" id="RepairUnit" name="RepairUnit" class="form-control"/>
              </div>
              <div class="col-md-3">
                ราคา
                <input type="number" id="RepairPrice" name="RepairPrice" class="form-control"/>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-2"></div>
              <div class="col-md-9">
                รายละเอียดการซ่อม
                <textarea type="text" name="RepairDetail" class="form-control" rows="3"></textarea>
              </div>
            </div>
          <hr>
          </div>
          <input type="hidden" name="Nameuser" value="{{auth::user()->name}}"/>
          <input type="hidden" name="Datacarid" value="{{$datacar->Main_id}}"/>
          <div align="center">
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> บันทึก</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-window-close"></i> ยกเลิก</button>
          </div>
          <br>
        </div>
      </div>
    </div>
  </form>

  <form name="form2" action="{{ route('MasterDatacar.store') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="type" value="4">
    <div class="modal fade" id="modal-adds">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <div class="col text-center">
              <h5 class="modal-title"><i class="fas fa-gears"></i> เพิ่มรายการซ่อม</h5>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body text-sm">
            <form name="product_name" id="product_name">  
                <div class="table-responsive">  
                    <table class="table table-bordered" id="dynamic_field">  
                      <thead>
                          <tr>
                            <th class="text-center" style="width: 5px">ที่</th>
                            <th class="text-center" style="width: 10px">วันที่</th>
                            <th class="text-center" style="width: 200px">รายการอะไหล่</th>
                            <th class="text-center" style="width: 40px">จำนวน</th>
                            <th class="text-center" style="width: 40px">หน่วย</th>
                            <th class="text-center" style="width: 100px">ราคา</th>
                            <th class="text-center" style="width: 200px">รายละเอียด</th>
                            <th class="text-center" style="width: 5px">#</th>
                          </tr>
                      </thead>
                        <tr>  
                            <td>1</td>  
                            <td><input type="date" name="Repair_date[]" class="form-control list" required /></td>  
                            <td><input type="text" name="Repair_list[]" class="form-control list" /></td>  
                            <td><input type="number" name="Repair_amount[]" class="form-control list" /></td>  
                            <td><input type="text" name="Repair_unit[]" class="form-control list" /></td>  
                            <td><input type="number" name="Repair_price[]" class="form-control list" /></td>  
                            <td><input type="text" name="Repair_detail[]" class="form-control list" /></td>  
                            <td><button type="button" name="add" id="add" class="btn btn-success" title="เพิ่มบรรทัด">+</button></td>  
                        </tr>  
                    </table>  
                </div>
            </form>  
          <hr>
          </div>
          <input type="hidden" name="Nameuser" value="{{auth::user()->name}}"/>
          <input type="hidden" name="Datacarid" value="{{$datacar->Main_id}}"/>
          <div align="center">
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> บันทึก</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-window-close"></i> ยกเลิก</button>
          </div>
          <br>
        </div>
      </div>
    </div>
  </form>

  {{-- popup แก้ไขรายการซ่อม --}}
  <div class="modal fade" id="modal-editlist">
    <div class="modal-dialog modal-lg">
        
    </div>
  </div>

  <script>
    $(function () {
      $("#modal-editlist").on("show.bs.modal", function (e) {
        var link = $(e.relatedTarget).data("link");
        $("#modal-editlist .modal-dialog").load(link, function(){
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

<script type="text/javascript">
    $(document).ready(function(){      
      var postURL = "<?php echo url('addProduct'); ?>";
      var i=1;  
      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added">'+
           '<td>'+i+'</td>'+
           '<td><input type="date" name="Repair_date[]" class="form-control list" required/></td>'+
           '<td><input type="text" name="Repair_list[]" class="form-control list" /></td>'+
           '<td><input type="number" name="Repair_amount[]" class="form-control list" /></td>'+
           '<td><input type="text" name="Repair_unit[]" class="form-control list" /></td>'+
           '<td><input type="number" name="Repair_price[]" class="form-control list" /></td>'+
           '<td><input type="text" name="Repair_detail[]" class="form-control list" /></td>'+
           '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td>'+
           '</tr>');  
      });  
      $(document).on('click', '.btn_remove', function(){  
            i--; 
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  
      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $('#submit').click(function(){            
           $.ajax({  
                url:postURL,  
                method:"POST",  
                data:$('#product_name').serialize(),
                type:'json',
                success:function(data)  
                {
                    if(data.error){
                        previewMessage(data.error);
                    }else{
                        i=1;
                        $('.dynamic-added').remove();
                        $('#product_name')[0].reset();
                        $(".print-success-msg").find("ul").html('');
                        $(".print-success-msg").css('display','block');
                        $(".error-message-display").css('display','none');
                        $(".print-success-msg").find("ul").append('<li>Record Inserted Successfully.</li>');
                    }
                }  
           });  
      });  
      function previewMessage (msg) {
         $(".error-message-display").find("ul").html('');
         $(".error-message-display").css('display','block');
         $(".print-success-msg").css('display','none');
         $.each( msg, function( key, value ) {
            $(".error-message-display").find("ul").append('<li>'+value+'</li>');
         });
      }
    });  
</script>

@endsection
