@extends('layouts.master')
@section('title','แก้ไขข้อมูลรถยนต์')
@section('content')

  <link type="text/css" rel="stylesheet" href="{{ asset('css/magiczoomplus.css') }}"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>

  <script type="text/javascript" src="{{ asset('js/magiczoomplus.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>

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
          <form name="form1" method="post" action="{{ action('DatacarController@updateMechanic',$id) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card-header">
              {{-- <a href="#" class="btn btn-default btn-sm float-right" title="เพิ่มรูปรถ" data-toggle="modal" data-target="#modal-default">
                <i class="far fa-image"></i> 
              </a> --}}
              <div class="row">
                <div class="col-4">
                  <div class="form-inline">
                      <h4>รายการซ่อมรถ</h4>
                  </div>
                </div>
                <div class="col-8">
                  <div class="card-tools d-inline float-right">
                    <button type="submit" class="delete-modal btn btn-success">
                      <i class="fas fa-save"></i> อัพเดท
                    </button>
                    <!-- <button type="button" class="delete-modal btn btn-primary" data-toggle="modal" data-target="#modal-default">
                      <i class="fas fa-gear"></i> เพิ่ม
                    </button> -->
                    <a class="delete-modal btn btn-danger" href="{{ route('datacar',100) }}">
                      <i class="far fa-window-close"></i> ยกเลิก
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body text-sm">
              <div class="row">
                <div class="col-md-5">
                  <div class="card card-warning">
                    <div class="card-header">
                      <h3 class="card-title"><i class="fas fa-car"></i> ข้อมูลรถยนต์ 
                          @if($datacar->BookStatus_Car == 'จอง')
                            ( <font color="blue">รถยนต์ติดจอง</font> )                            
                          @endif
                      </h3>
  
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-5 col-form-label text-right"> วันที่ซื้อ :</label>
                            <div class="col-sm-7">
                              <input type="date" class="form-control form-control-sm" value="{{$datacar->create_date}}" readonly>
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-5 col-form-label text-right">สถานะ:</label>
                            <div class="col-sm-7">
                              <select id="Cartype" name="Cartype" class="form-control form-control-sm">
                                @foreach ($arrayCarType as $key => $value)
                                  <option value="{{$key}}" {{ ($key == $datacar->Car_type) ? 'selected' : '' }}>{{$value}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
  
                        <div class="row">
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-5 col-form-label text-right"> ยี่ห้อรถ :</label>
                              <div class="col-sm-7">
                                <select class="form-control form-control-sm" readonly>
                                  @foreach ($arrayBrand as $key => $value)
                                    <option value="{{$key}}" {{ ($key == $datacar->Brand_Car) ? 'selected' : '' }}>{{$value}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-5 col-form-label text-right">เลขทะเบียน :</label>
                              <div class="col-sm-7">
                                <input type="text" class="form-control form-control-sm" value="{{$datacar->Number_Regist}}" readonly/>
                              </div>
                            </div>
                          </div>
                        </div>
  
                        <div class="row">
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-5 col-form-label text-right">ที่มาของรถ :</label>
                              <div class="col-sm-7">
                                <select class="form-control form-control-sm" readonly>
                                  @foreach ($arrayOriginType as $key => $value)
                                    <option value="{{$key}}" {{ ($key == $datacar->Origin_Car) ? 'selected' : '' }}>{{$value}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-5 col-form-label text-right">Sale :</label>
                              <div class="col-sm-7">
                                <input type="text" class="form-control form-control-sm" value="{{$datacar->Name_Sale}}" readonly/>
                              </div>
                            </div>
                          </div>
                        </div>
  
                        <div class="row">
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-5 col-form-label text-right">ลักษณะรถ :</label>
                              <div class="col-sm-7">
                                <select class="form-control form-control-sm" readonly>
                                  @foreach ($arrayModel as $key => $value)
                                    <option value="{{$key}}" {{ ($key == $datacar->Model_Car) ? 'selected' : '' }}>{{$value}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-5 col-form-label text-right">เลขไมล์ :</label>
                              <div class="col-sm-7">
                                <input type="text" class="form-control form-control-sm" value="{{$datacar->Number_Miles}}" oninput="mile();" maxlength="10" readonly/>
                              </div>
                            </div>
                          </div>
                        </div>
  
                        <div class="row">
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-5 col-form-label text-right">รุ่นรถ :</label>
                              <div class="col-sm-7">
                                <input type="text" class="form-control form-control-sm" value="{{$datacar->Version_Car}}" readonly/>
                              </div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-5 col-form-label text-right">เกียร์รถ / ปีรถ :</label>
                              <div class="col-sm-4">
                                <select class="form-control form-control-sm" readonly>
                                  @foreach ($arrayGearcar as $key => $value)
                                    <option value="{{$key}}" {{ ($key == $datacar->Gearcar) ? 'selected' : '' }}>{{$value}}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="col-sm-3">
                                <input type="text" class="form-control form-control-sm" value="{{$datacar->Year_Product}}" readonly/>
                              </div>
                            </div>
                          </div>
                        </div>
  
                        <div class="row">
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-5 col-form-label text-right">ขนาด :</label>
                              <div class="col-sm-7">
                                <input type="text" class="form-control form-control-sm" value="{{$datacar->Size_Car}}" readonly/>
                            </div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-5 col-form-label text-right">สีรถ :</label>
                              <div class="col-sm-7">
                                <input type="text" class="form-control form-control-sm" value="{{$datacar->Color_Car}}" readonly/>
                              </div>
                            </div>
                          </div>
                        </div>
  
                        <div class="row">
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-5 col-form-label text-right">Job Number :</label>
                              <div class="col-sm-7">
                                <input type="text" class="form-control form-control-sm" value="{{$datacar->Job_Number}}" readonly/>
                              </div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-5 col-form-label text-right">เลขตัวถัง :</label>
                              <div class="col-sm-7">
                                <input type="text" name="ChassisCar" class="form-control form-control-sm" value="{{$datacar->Chassis_car}}" />
                              </div>
                            </div>
                            <div class="form-group row mb-1">
                              <label class="col-sm-5 col-form-label text-right">ประเมิณซ่อม :</label>
                              <div class="col-sm-7">
                                <input type="number" name="Expected_Repair" class="form-control form-control-sm" value="{{$datacar->Expected_Repair}}" />
                              </div>
                            </div>
                            <div class="form-group row mb-1">
                              <label class="col-sm-5 col-form-label text-right">ประเมิณทำสี :</label>
                              <div class="col-sm-7">
                                <input type="number" name="Expected_Color" class="form-control form-control-sm" value="{{$datacar->Expected_Color}}" />
                              </div>
                            </div>
                          </div>
                        </div>  
                    
                    </div>
                  </div>
                </div>
            <input type="hidden" name="_method" value="PATCH"/>
            <input type="hidden" name="type" value="44">
            @foreach($dataRepair as $key => $value)
              @php 
                @$Totalprice1 += $value->Repair_amount * $value->Repair_price;
              @endphp
            @endforeach
            <input type="hidden" name="Totalprice" value="{{@$Totalprice1}}">
          </form>
                <div class="col-md-7">
                  <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title"><i class="fas fa-tasks"></i> รายการที่ซ่อม</h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool text-white" data-toggle="modal" data-target="#modal-default" title="เพิ่มรายการซ่อม">
                          <i class="fas fa-plus-circle"></i>
                        </button>
                        @if($countdataRepair != 0)
                          <a target="_blank" class="btn btn-tool" href="{{ route('MasterDatacar.show',[$datacar->Main_id]) }}?type={{1}}" title="พิมพ์รายการซ่อม"> 
                            <i class="fas fas fa-print"></i>
                          </a>
                        @endif
                        <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button> -->
                        <!-- <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                        </button> -->
                      </div>
                    </div>
                    <div class="card-body">
                      <table class="table table-bordered">
                        <thead>                  
                          <tr>
                          @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER" or auth::user()->position == "AUDIT")
                            <th style="width: 50px">#</th>
                          @endif
                            <th style="width: 10px">ที่</th>
                            <th>รายการอะไหล่ / รายละเอียดการซ่อม</th>
                            <th class="text-center" style="width: 30px">จำนวน</th>
                            <th class="text-right" style="width: 100px">ราคา/หน่วย</th>
                            <th class="text-right" style="width: 100px">รวมเป็นเงิน</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($dataRepair as $key => $value)
                            @php 
                              @$Totalprice += $value->Repair_amount * $value->Repair_price;
                            @endphp
                            <tr>
                              @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER" or auth::user()->position == "AUDIT")
                              <td class="text-right">
                                <form method="post" class="delete_form float-right" action="{{ action('DatacarController@destroy',$value->Repair_id) }}" style="display:inline;">
                                {{csrf_field()}}
                                  <input type="hidden" name="_method" value="DELETE" />
                                  <input type="hidden" name="type" value="2" />
                                  <button type="submit" data-name="รายการ {{$value->Repair_list}}" class="delete-modal btn btn-xs AlertForm text-red" title="ลบรายการ">
                                    <i class="far fa-trash-alt"></i>
                                  </button>
                                </form>
                              </td>
                              @endif
                              <td>{{$key+1}}</td>
                              <td>
                              {{$value->Repair_list}}
                                @if($value->Repair_detail != null)
                                <br>
                                <i class="fa fa-minus text-xs"></i>
                                {{$value->Repair_detail}}
                                @endif
                              </td>
                              <td class="text-center">{{$value->Repair_amount}}</td>
                              <td class="text-right">{{number_format($value->Repair_price,2)}}</td>
                              <td class="text-right">{{number_format($value->Repair_amount * $value->Repair_price,2)}}</td>
                            </tr>
                          @endforeach
                          @if($countdataRepair != 0)
                            <tr>
                            @if(auth::user()->type == "Admin")
                              <td colspan="4"></td>
                            @else
                              <td colspan="3"></td>
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
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <div class="col text-center">
              <h5 class="modal-title"><i class="fas fa-gear"></i> เพิ่มรายการซ่อม</h5>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row mb-2">
              <div class="col-md-2"></div>
              <div class="col-md-8">
                รายการอะไหล่
                <input type="text" name="RepairList" class="form-control" />
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-md-2"></div>
              <div class="col-md-4">
                จำนวน
                <input type="number" name="RepairAmount" class="form-control" />
              </div>
              <div class="col-md-4">
                ราคา/หน่วย
                <input type="number" id="RepairPrice" name="RepairPrice" class="form-control"/>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2"></div>
              <div class="col-md-8">
                รายละเอียดการซ่อม
                <textarea type="text" name="RepairDetail" class="form-control" rows="3"></textarea>
              </div>
            </div>
            <!-- <div class="row">
              <div class="col-md-2"></div>
              <div class="col-md-8">
                ราคา
                <input type="number" id="RepairPrice" name="RepairPrice" class="form-control"/>
              </div>
            </div> -->
          </div>
          <input type="hidden" name="Nameuser" value="{{auth::user()->name}}"/>
          <input type="hidden" name="Datacarid" value="{{$datacar->Main_id}}"/>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal"></button> -->
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> บันทึก</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-window-close"></i> ยกเลิก</button>
          </div>
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

@endsection
