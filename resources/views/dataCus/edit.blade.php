@extends('layouts.master')
@section('title','Resrearch Cus')
@section('content')

  <style>
    #todo-list{
    width:100%;
    margin:0 auto 50px auto;
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
          border-radius:5px;
    }
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
    height:3px;
    position:relative;
    }
    .todo:before{
    content:'';
    display:block;
    position:absolute;
    top:calc(50% + 2px);
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

      <section class="content">
        <div class="row">
          <div class="col-12">
          <form name="form1" method="post" action="{{ route('MasterResearchCus.update',[$id]) }}?type={{1}}" enctype="multipart/form-data">
              @csrf
              @method('put')
              <div class="card">
                <div class="card-header">   
                  <div class="container-fluid">   
                    <div class="row mb-0">
                      <div class="col-sm-6">
                        <h4 class=""><b>Research Customer</b></h4>
                      </div>
                      <div class="col-sm-6">
                        <div class="card-tools d-inline float-right">
                          <a class="delete-modal btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-1" data-backdrop="static" data-link="{{ route('MasterResearchCus.edit',[$id]) }}?type={{2}}">
                            <i class="fas fa-plus"></i> Tracking
                          </a>
                          <button type="submit" class="delete-modal btn btn-success btn-sm">
                            <i class="fas fa-save"></i> Update
                          </button>
                          <a class="delete-modal btn btn-danger btn-sm" href="{{ route('ResearchCus',1) }}">
                            <i class="far fa-window-close"></i> Close
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body text-sm">
                  <h5 class="text-center "><b>แบบฟอร์มข้อมูลลูกค้า</b></h5>
                  <script>
                    function addCommas(nStr){
                        nStr += '';
                        x = nStr.split('.');
                        x1 = x[0];
                        x2 = x.length > 1 ? '.' + x[1] : '';
                        var rgx = /(\d+)(\d{3})/;
                        while (rgx.test(x1)) {
                          x1 = x1.replace(rgx, '$1' + ',' + '$2');
                        }
                      return x1 + x2;
                    }
                    function Comma(){
                      var num11 = document.getElementById('CashStatusCus').value;
                      var num1 = num11.replace(",","");
          
                      document.form1.CashStatusCus.value = addCommas(num1);
                    }
                  </script>

                  <div>
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group row mb-0">
                          <label class="col-sm-3 col-form-label text-right">ชื่อ - นามสกุล : </label>
                          <div class="col-sm-8">
                            <input type="text" name="NameCus" class="form-control form-control-sm" value="{{ $data->Name_Cus }}"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group row mb-0">
                          <label class="col-sm-3 col-form-label text-right">เบอร์ติดต่อ : </label>
                          <div class="col-sm-8">
                            <input type="text" name="PhoneCus" class="form-control form-control-sm" value="{{ $data->Phone_Cus }}" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask=""/>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-6">
                        <div class="form-group row mb-0">
                          <label class="col-sm-3 col-form-label text-right">เลขบัตร ปชช. :</label>
                          <div class="col-sm-8">
                            <input type="text" name="IDCardCus" class="form-control form-control-sm" value="{{ $data->IDCard_Cus }}" data-inputmask="&quot;mask&quot;:&quot;9-9999-99999-99-9&quot;" data-mask="" />
                          </div>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group row mb-0">
                          <label class="col-sm-3 col-form-label text-right">ที่อยู่ : </label>
                          <div class="col-sm-8">
                            <input type="text" name="AddressCus" class="form-control form-control-sm" value="{{ $data->Address_Cus }}"/>
                          </div>
                        </div>
                      </div>
                    </div>
          
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group row mb-0">
                          <label class="col-sm-3 col-form-label text-right">จังหวัด/ไปรษณีย์ : </label>
                          <div class="col-sm-4">
                            <input type="text" name="ProvinceCus" class="form-control form-control-sm" value="{{ $data->Province_Cus }}"/>
                          </div>
                          <div class="col-sm-4">
                            <input type="text" name="ZipCus" class="form-control form-control-sm"value="{{ $data->Zip_Cus }}" data-inputmask="&quot;mask&quot;:&quot;99999&quot;" data-mask=""/>
                          </div>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group row mb-0">
                          <label class="col-sm-3 col-form-label text-right">Email : </label>
                          <div class="col-sm-8">
                            <input type="text" name="EmailCus" class="form-control form-control-sm" value="{{ $data->Email_Cus }}"/>
                          </div>
                        </div>
                      </div>
                    </div>
          
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group row mb-0">
                          <label class="col-sm-3 col-form-label text-right">อาชีพ : </label>
                          <div class="col-sm-8">
                            <input type="text" name="CareerCus" class="form-control form-control-sm" value="{{ $data->Career_Cus }}" />
                          </div>
                        </div>
                      </div>
                    </div>
          
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group row mb-0">
                          <label class="col-sm-3 col-form-label text-right">แหล่งที่มาลูกค้า : </label>
                          <div class="col-sm-8">
                            <select name="OriginCus" class="form-control form-control-sm">
                              <option value="" selected>--- แหล่งที่มา ---</option>
                              <option value="ป้ายโฆษณา/รถแห่/วิทยุ/จดหมาย" {{ ($data->Origin_Cus === 'ป้ายโฆษณา/รถแห่/วิทยุ/จดหมาย') ? 'selected' : '' }}>ป้ายโฆษณา/รถแห่/วิทยุ/จดหมาย</option>
                              <option value="ลูกค้าไฟแนนซ์เก่า/ลูกค้าซื้อขายเก่า" {{ ($data->Origin_Cus === 'ลูกค้าไฟแนนซ์เก่า/ลูกค้าซื้อขายเก่า') ? 'selected' : '' }}>ลูกค้าไฟแนนซ์เก่า/ลูกค้าซื้อขายเก่า</option>
                              <option value="นายหน้า/ลูกค้าแนะนำ" {{ ($data->Origin_Cus === 'นายหน้า/ลูกค้าแนะนำ') ? 'selected' : '' }}>นายหน้า/ลูกค้าแนะนำ</option>
                              <option value="อื่นๆ..." {{ ($data->Origin_Cus === 'อื่นๆ...') ? 'selected' : '' }}>อื่นๆ...</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group row mb-0">
                          <label class="col-sm-3 col-form-label text-right">รูปแบบลูกค้า : </label>
                          <div class="col-sm-8">
                            <select name="modelCus" class="form-control form-control-sm">
                              <option value="" selected>--- เลือกรูปแบบ ---</option>
                              <option value="Walk In" {{ ($data->model_Cus === 'Walk In') ? 'selected' : '' }}>Walk In</option>
                              <option value="Call In" {{ ($data->model_Cus === 'Call In') ? 'selected' : '' }}>Call In</option>
                              <option value="Other" {{ ($data->model_Cus === 'Other') ? 'selected' : '' }}>Other</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
          
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group row mb-0">
                          <label class="col-sm-3 col-form-label text-right"><font color="red">ผู้เสนอราคา : </font></label>
                          <div class="col-sm-8">
                          <input type="text" name="SaleCus" value="{{ $data->Sale_Cus }}" class="form-control form-control-sm" readonly/>
                          </div>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group row mb-0">
                          <label class="col-sm-3 col-form-label text-right"><font color="red">วันที่รับลูกค้า : </font></label>
                          <div class="col-sm-8">
                            <input type="date" name="DateSaleCus" class="form-control form-control-sm" value="{{ $data->DateSale_Cus }}" readonly/>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-6">
                        <div class="form-group row mb-0">
                          <label class="col-sm-3 col-form-label text-right">เงินมัดจำ : </label>
                          <div class="col-sm-8">
                          <input type="text" name="CashStatusCus" id="CashStatusCus" class="form-control form-control-sm" value="{{ number_format($data->CashStatus_Cus, 0) }}" oninput="Comma();"/>
                          </div>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group row mb-0">
                          <label class="col-sm-3 col-form-label text-right">หมายเหตุ : </label>
                          <div class="col-sm-8">
                            <textarea name="CusNote" class="form-control form-control-sm form-control form-control-sm-sm" placeholder="ป้อนหมายเหตุ" rows="3">{{$data->Note_Cus}}</textarea>
                          </div>
                        </div>
                      </div>
                    </div>
            
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group row mb-0">
                          <label class="col-sm-3 col-form-label text-right"><font color="red">สถานะลูกค้า : </font></label>
                          <div class="col-sm-4">
                            <span class="todo-wrap">
                              @if($data->Status_Cus == "ติดตาม")
                                <input type="checkbox" id="1" name="StatusCus" value="{{ $data->Status_Cus }}" checked="checked"/>
                              @else
                                <input type="checkbox" id="1" name="StatusCus" value="ติดตาม"/>
                              @endif
                              <label for="1" class="todo">
                                <i class="fa fa-check"></i>
                                ติดตาม
                              </label>
                            </span>
                          </div>
                          <div class="col-sm-4">
                            <span class="todo-wrap">
                              @if($data->Status_Cus == "จอง")
                                <input type="checkbox" id="2" name="StatusCus" value="{{ $data->Status_Cus }}" checked="checked"/>
                              @else
                                <input type="checkbox" id="2" name="StatusCus" value="จอง"/>
                              @endif
                              <label for="2" class="todo">
                                <i class="fa fa-check"></i>
                                จองรถ
                              </label>
                            </span>
                          </div>
                        </div>
                        <div class="form-group row mb-0">
                          <label class="col-sm-3 col-form-label text-right"></label>  
                          <div class="col-sm-4">
                            <span class="todo-wrap">
                              @if($data->Status_Cus == "ยกเลิกจอง")
                                <input type="checkbox" id="3" name="StatusCus" value="{{ $data->Status_Cus }}" checked="checked"/>
                              @else
                                <input type="checkbox" id="3" name="StatusCus" value="ยกเลิกจอง"/>
                              @endif
                              <label for="3" class="todo">
                                <i class="fa fa-check"></i>
                                ยกเลิกจอง
                              </label>
                            </span>
                          </div>
                          <div class="col-sm-4">
                            <span class="todo-wrap">
                              @if($data->Status_Cus == "ส่งมอบ")
                                <input type="checkbox" id="4" name="StatusCus" value="{{ $data->Status_Cus }}" checked="checked"/>
                              @else
                                <input type="checkbox" id="4" name="StatusCus" value="ส่งมอบ"/>
                              @endif
                              <label for="4" class="todo">
                                <i class="fa fa-check"></i>
                                ส่งมอบ
                              </label>
                            </span>
                          </div>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-group row mb-0">
                          <label class="col-sm-3 col-form-label text-right"><font color="red">ประเภทลูกค้า : </font></label>
                          <div class="col-sm-4">
                            <span class="todo-wrap">
                              @if($data->Type_Cus == "Very Hot")
                                <input type="checkbox" id="5" name="TypeCus" value="{{ $data->Type_Cus }}" checked="checked"/>
                              @else
                                <input type="checkbox" id="5" name="TypeCus" value="Very Hot"/>
                              @endif
                              <label for="5" class="todo">
                                <i class="fa fa-check"></i>
                                Very Hot
                              </label>
                            </span>
                          </div>
                          <div class="col-sm-4">
                            <span class="todo-wrap">
                              @if($data->Type_Cus == "Hot")
                                <input type="checkbox" id="6" name="TypeCus" value="{{ $data->Type_Cus }}" checked="checked"/>
                              @else
                                <input type="checkbox" id="6" name="TypeCus" value="Hot"/>
                              @endif
                              <label for="6" class="todo">
                                <i class="fa fa-check"></i>
                                Hot (1-5)
                              </label>
                            </span>
                          </div>
                        </div>
            
                        <div class="form-group row mb-0">
                          <label class="col-sm-3 col-form-label text-right"></label>
                          <div class="col-sm-4">
                            <span class="todo-wrap">
                              @if($data->Type_Cus == "Warm")
                                <input type="checkbox" id="7" name="TypeCus" value="{{ $data->Type_Cus }}" checked="checked"/>
                              @else
                                <input type="checkbox" id="7" name="TypeCus" value="Warm"/>
                              @endif
                              <label for="7" class="todo">
                                <i class="fa fa-check"></i>
                                Warm (6-15)
                              </label>
                            </span>
                          </div>
                          <div class="col-sm-4">
                            <span class="todo-wrap">
                              @if($data->Type_Cus == "Cold")
                                <input type="checkbox" id="8" name="TypeCus" value="{{ $data->Type_Cus }}" checked="checked"/>
                              @else
                                <input type="checkbox" id="8" name="TypeCus" value="Cold"/>
                              @endif
                              <label for="8" class="todo">
                                <i class="fa fa-check"></i>
                                Cold (มากกว่า 15)
                              </label>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
          
                  <div class="card card-warning card-tabs">
                    <div class="card-header p-0 pt-1">
                      <ul class="nav nav-tabs" id="custom-tabs-five-tab" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="Sub-custom-tab1" data-toggle="pill" href="#Sub-tab1" role="tab" aria-controls="Sub-tab1" aria-selected="false">ความต้องการลูกค้า</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="Sub-custom-tab2" data-toggle="pill" href="#Sub-tab2" role="tab" aria-controls="Sub-tab2" aria-selected="false">บันทึกการติดตาม</a>
                        </li>
                      </ul>
                    </div>
          
                    <div class="tab-content">
                      <div class="tab-pane fade show active" id="Sub-tab1" role="tabpanel" aria-labelledby="Sub-custom-tab1">
                        <div>
                          <p></p>
                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-0">
                                <label class="col-sm-3 col-form-label text-right">เลขทะเบียน : </label>
                                <div class="col-sm-8">
                                  <select name="RegisterCar" id="RegisterCar" class="form-control form-control-sm RegisterCar select2 select2-hidden-accessible">
                                      <option value="" style="color:red">{{ $data->RegistCar_Cus }}</option>
                                      <option disabled>------------------------------</option>
                                      @foreach ($dataRegis as $key => $value)
                                        <option value="{{$value->id}}">{{ $value->Number_Regist }}</option>
                                      @endforeach
                                  </select>
                                  <span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" data-select2-id="10"></span>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div id="ShowData"></div>
                          <script>
                            $('#RegisterCar').change(function(){
                                var value = document.getElementById('RegisterCar').value;
                                if(value == ''){
                                  $('#ShowCom').show();
                                }
                                else{
                                  $('#ShowCom').hide();
                                }
                            });
                          </script>
                          
                          @if($data->RegistCar_Cus != NULL)
                            <div id="ShowCom">
                          @else
                            <div id="ShowCom" style="display: none">
                          @endif
                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ยี่ห้อ : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="Brand_Car" class="form-control form-control-sm" value="{{ $data->BrandCar_Cus }}" readonly/>
                                    <input type="hidden" name="Regist_Car" value="{{ $data->RegistCar_Cus }}">
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">รุ่น/สี : </label>
                                  <div class="col-sm-4">
                                    <input type="text" name="Version_Car" class="form-control form-control-sm" value="{{ $data->VersionCar_Cus }}" readonly/>
                                  </div>
                                  <div class="col-sm-4">
                                    <input type="text" name="Color_Car" class="form-control form-control-sm" value="{{ $data->ColorCar_Cus }}" readonly/>
                                  </div>
                                </div>
                              </div>
                            </div>
            
                            <div class="row">
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">เกียร์/ปี : </label>
                                  <div class="col-sm-4">
                                    <input type="text" name="Gear_Car" class="form-control form-control-sm" value="{{ $data->GearCar_Cus }}" readonly/>
                                  </div>
                                  <div class="col-sm-4">
                                    <input type="text" name="Year_Car" class="form-control form-control-sm" value="{{ $data->YearCar_Cus }}" readonly/>
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group row mb-0">
                                  <label class="col-sm-3 col-form-label text-right">ราคา : </label>
                                  <div class="col-sm-8">
                                    <input type="text" name="Price_Car" class="form-control form-control-sm" value="{{ number_format($data->PriceCar_Cus, 0) }}" oninput="Comma();" readonly/>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
              <input type="hidden" name="_method" value="PATCH"/>
            </form>
                      <div class="tab-pane fade show" id="Sub-tab2" role="tabpanel" aria-labelledby="Sub-custom-tab2">
                        <div class="table-responsive text-sm">
                          <table class="table table-striped table-valign-middle" id="table1">
                            <thead>
                              <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">วันที่</th>
                                <th class="text-center">สถานะ</th>
                                <th class="text-center">บันทึกการติดตาม</th>
                                <th class="text-center">หมายเหตุ</th>
                                <th class="text-center">ผู้ติดตาม</th>
                                <th class="text-center"></th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($tracking as $key => $row)
                                  <tr>
                                    <td class="text-center">{{ $key+1 }}</td>
                                    <td class="text-center">{{ date('d-m-Y', strtotime($row->Date_Tracking)) }}</td>
                                    <td class="text-left">{{ $row->Status_Tracking }}</td>
                                    <td class="text-center">{{ $row->Follow_Tracking }}</td>
                                    <td class="text-center">{{ $row->Note_tracking }}</td>
                                    <td class="text-center">{{ $row->User_Tracking }}</td>
                                    <td class="text-center">
                                      <a class="btn btn-warning btn-sm" title="แก้ไขรายการ" data-toggle="modal" data-target="#modal-2" data-backdrop="static" data-link="{{ route('MasterResearchCus.edit',[$row->Tracking_id]) }}?type={{3}}">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <form method="post" class="delete_form" action="{{ route('MasterResearchCus.destroy',[$row->Tracking_id]) }}?type={{2}}" style="display:inline;">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit"  class="delete-modal btn btn-danger btn-sm AlertForm" title="ลบรายการ">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </form>
                                    </td>
                                  </tr>
                                @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <a id="button"></a>
                </div>
              </div>
          </div>
        </div>
      </section>
    </div>
  </section>

  <script>
    $(function () {
      $("#table1").DataTable({
        "searching" : false,
        "lengthChange" : false,
        "info" : false,
        "pageLength": 5,
        "responsive": true,
        "autoWidth": false,
      });
    });
  </script>

  <script type="text/javascript">
    $('.RegisterCar').change(function() {
      if ($(this).val() != '') {
        
        var select = $(this).val();
        // console.log(select);
        var _token = $('input[name="_token"]').val();
  
        $.ajax({
          url:"{{ route('ResearchCus.SearchData', 1) }}",
          method:"POST",
          data:{select:select,_token:_token},
  
          success:function(result){ //เสร็จแล้วทำอะไรต่อ
            $('#ShowData').html(result);
          }
        })
      }
    });
  </script>

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

  <script>
    $(function () {
      $("#modal-2").on("show.bs.modal", function (e) {
        var link = $(e.relatedTarget).data("link");
        $("#modal-2 .modal-body").load(link, function(){
        });
      });
    });
  </script>
  {{-- Popup --}}

  <script>
    $(function () {
      $('[data-mask]').inputmask()
    })
  </script>

  {{-- Modal create tracking --}}
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

  {{-- Modal edit tracking --}}
  <div class="modal fade" id="modal-2">
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
@endsection
