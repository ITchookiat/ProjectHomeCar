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
        <div class="card">
          <form name="form1" method="post" action="{{ route('MasterDatacar.update',$id) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card-header">
              {{-- <a href="#" class="btn btn-default btn-sm float-right" title="เพิ่มรูปรถ" data-toggle="modal" data-target="#modal-default">
                <i class="far fa-image"></i> 
              </a> --}}
              <div class="row">
                <div class="col-4">
                  <div class="form-inline">
                      <h4>แก้ไขข้อมูลรถยนต์</h4>
                  </div>
                </div>
                <div class="col-8">
                  <div class="card-tools d-inline float-right">
                    <button type="submit" class="delete-modal btn btn-success">
                      <i class="fas fa-save"></i> อัพเดท
                    </button>
                    <a class="delete-modal btn btn-danger" href="{{ URL::previous() }}">
                      <i class="far fa-window-close"></i> ยกเลิก
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body text-sm">
              <div class="row">
                <div class="col-md-9">
                  <div class="card card-warning">
                    <div class="card-header">
                      <h3 class="card-title"><i class="fas fa-car"></i> ข้อมูลรถยนต์</h3>
  
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
                            <label class="col-sm-3 col-form-label text-right"><font color="red">* วันที่ซื้อ</font> :</label>
                            <div class="col-sm-8">
                              <input type="date" class="form-control form-control-sm" name="DateCar" value="{{$datacar->create_date}}">
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right"><font color="red">สถานะ</font> :</label>
                            <div class="col-sm-8">
                              <select name="Cartype" id="Cartype" class="form-control form-control-sm">
                                @foreach ($arrayCarType as $key => $value)
                                  <option value="{{$key}}" {{ ($key == $datacar->Car_type) ? 'selected' : '' }}>{{$value}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right"></label>
                            <div class="col-sm-8">
                              <span class="todo-wrap">
                                @if($datacar->BookStatus_Car == 'จอง')
                                  <input type="checkbox" id="7" name="BookStatus" value="{{$datacar->BookStatus_Car}}" checked="checked"/>
                                @else
                                  <input type="checkbox" id="7" name="BookStatus" value="จอง" />
                                @endif
                                <label for="7" class="todo">
                                  <i class="fa fa-check"></i>
                                  <font color="blue">รถยนต์ติดจอง</font>
                                </label>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
  
                        <div class="row">
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-3 col-form-label text-right"><font color="red">* ยี่ห้อรถ</font> :</label>
                              <div class="col-sm-8">
                                <select name="BrandCar" class="form-control form-control-sm" required>
                                  @foreach ($arrayBrand as $key => $value)
                                    <option value="{{$key}}" {{ ($key == $datacar->Brand_Car) ? 'selected' : '' }}>{{$value}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-3 col-form-label text-right"><font color="red">* เลขทะเบียน</font> :</label>
                              <div class="col-sm-8">
                                <input type="text" name="Number_Regist" class="form-control form-control-sm" value="{{$datacar->Number_Regist}}" required/>
                              </div>
                            </div>
                          </div>
                        </div>
  
                        <div class="row">
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-3 col-form-label text-right"><font color="red">* ที่มาของรถ</font> :</label>
                              <div class="col-sm-8">
                                <select name="OriginCar" class="form-control form-control-sm" required>
                                  @foreach ($arrayOriginType as $key => $value)
                                    <option value="{{$key}}" {{ ($key == $datacar->Origin_Car) ? 'selected' : '' }}>{{$value}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-3 col-form-label text-right">Sale :</label>
                              <div class="col-sm-8">
                                <input type="text" name="SaleCar" class="form-control form-control-sm" value="{{$datacar->Name_Sale}}"/>
                              </div>
                            </div>
                          </div>
                        </div>
  
                        <div class="row">
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-3 col-form-label text-right">ลักษณะรถ :</label>
                              <div class="col-sm-8">
                                <select name="ModelCar" class="form-control form-control-sm">
                                  @foreach ($arrayModel as $key => $value)
                                    <option value="{{$key}}" {{ ($key == $datacar->Model_Car) ? 'selected' : '' }}>{{$value}}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-3 col-form-label text-right">เลขไมล์ :</label>
                              <div class="col-sm-8">
                                <input type="text" id="MilesCar" name="MilesCar" class="form-control form-control-sm" value="{{$datacar->Number_Miles}}" oninput="mile();" maxlength="10"/>
                              </div>
                            </div>
                          </div>
                        </div>
  
                        <div class="row">
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-3 col-form-label text-right">รุ่นรถ :</label>
                              <div class="col-sm-8">
                                <input type="text" name="VersionCar" class="form-control form-control-sm" value="{{$datacar->Version_Car}}" />
                              </div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-3 col-form-label text-right">เกียร์รถ / ปีรถ :</label>
                              <div class="col-sm-4">
                                <select name="Gearcar" class="form-control form-control-sm">
                                  @foreach ($arrayGearcar as $key => $value)
                                    <option value="{{$key}}" {{ ($key == $datacar->Gearcar) ? 'selected' : '' }}>{{$value}}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="col-sm-4">
                                <input type="text" name="YearCar" class="form-control form-control-sm" value="{{$datacar->Year_Product}}"/>
                              </div>
                            </div>
                          </div>
                        </div>
  
                        <div class="row">
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-3 col-form-label text-right">ขนาด :</label>
                              <div class="col-sm-8">
                                <input type="text" name="SizeCar" class="form-control form-control-sm" value="{{$datacar->Size_Car}}"/>
                            </div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-3 col-form-label text-right">สีรถ :</label>
                              <div class="col-sm-8">
                                <input type="text" name="ColorCar" class="form-control form-control-sm" value="{{$datacar->Color_Car}}" />
                              </div>
                            </div>
                          </div>
                        </div>
  
                        <div class="row">
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-3 col-form-label text-right">Job Number :</label>
                              <div class="col-sm-8">
                                <input type="text" name="JobCar" class="form-control form-control-sm" value="{{$datacar->Job_Number}}" />
                              </div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-3 col-form-label text-right">เลขตัวถัง :</label>
                              <div class="col-sm-8">
                                <input type="text" name="ChassisCar" class="form-control form-control-sm" value="{{$datacar->Chassis_car}}" />
                              </div>
                            </div>
                          </div>
                        </div>

                        <hr>
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
  
                          function mile(){
                            var num11 = document.getElementById('MilesCar').value;
                            var num1 = num11.replace(",","");
                            document.form1.MilesCar.value = addCommas(num1);
                          }
  
                          function sum() {
                              
                              var num1 = document.getElementById('PriceCar').value;
                              var num11 = num1.replace(",","");
                              var num2 = document.getElementById('OfferPrice').value;
                              var num22 = num2.replace(",","");
                              var num3 = document.getElementById('RepairCar').value;
                              var num33 = num3.replace(",","");
                              var num4 = document.getElementById('ColorPrice').value;
                              var num44 = num4.replace(",","");
                              var num5 = document.getElementById('AddPrice').value;
                              var num55 = num5.replace(",","");
                              var num6 = document.getElementById('NetCar').value;
                              var num66 = num6.replace(",","");
                              var num7 = document.getElementById('AccountingCost').value;
                              var num77 = num7.replace(",","");
                              var num88 = document.getElementById('Open_auction').value;
                              var num8 = num88.replace(",","");
                              var num99 = document.getElementById('Close_auction').value;
                              var num9 = num99.replace(",","");
                              var num10 = document.getElementById('Expected_Sell').value;
                              var num10 = num10.replace(",","");
                              var result = parseFloat(num11)+parseFloat(num22)+parseFloat(num33)+parseFloat(num44)+parseFloat(num55);
                              
                              document.form1.PriceCar.value = addCommas(num11);
                              document.form1.OfferPrice.value = addCommas(num22);
                              document.form1.RepairCar.value = addCommas(num33);
                              document.form1.ColorPrice.value = addCommas(num44);
                              document.form1.AddPrice.value = addCommas(num55);
                              document.form1.NetCar.value = addCommas(num66);
                              document.form1.AccountingCost.value = addCommas(num77);
                              document.form1.Open_auction.value = addCommas(num8);
                              document.form1.Close_auction.value = addCommas(num9);
                              document.form1.Expected_Sell.value = addCommas(num10);

                              if(!isNaN(result)){
                                var final_result = parseFloat(result);
                                final = addCommas(final_result.toFixed(2));
                                document.form1.CapitalPrice.value = final;
                              }
                          }
                        </script>

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

                          function mile(){
                            var num11 = document.getElementById('MilesCar').value;
                            var num1 = num11.replace(",","");
                            document.form1.MilesCar.value = addCommas(num1);

                            var num22 = document.getElementById('AccountingCost').value;
                            var num2 = num22.replace(",","");
                            document.form1.AccountingCost.value = addCommas(num2);

                            var num44 = document.getElementById('OfferPrice').value;
                            var num4 = num44.replace(",","");
                            document.form1.OfferPrice.value = addCommas(num4);

                            var num33 = document.getElementById('PriceCar').value;
                            var num3 = num33.replace(",","");
                            document.form1.PriceCar.value = addCommas(num3);
                          }
                        </script>

                        <script>
                          $('#Cartype').change(function(){
                            var value = document.getElementById('Cartype').value;
                            if(value == '7'){
                              $('#show1').show();
                              $('#show2').show();
                            }else{
                              $('#show1').hide();
                              $('#show2').hide();
                            }
                          });
                        </script>

                        @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER" or auth::user()->position == "AUDIT")
                          <div class="row">
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right"><font color="red">ราคาซื้อ</font> :</label>
                                <div class="col-sm-8">
                                  <input type="text" id="PriceCar" name="PriceCar" class="form-control form-control-sm" value="{{number_format($datacar->Fisrt_Price,2)}}" oninput="sum();" maxlength="10" required/>
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group row mb-1">
                                <label class="col-sm-3 col-form-label text-right">ราคาต้นทุน :</label>
                                <div class="col-sm-8">
                                  <input type="text" id="CapitalPrice" name="CapitalPrice" class="form-control form-control-sm" value="{{number_format($datacar->Fisrt_Price+$datacar->Repair_Price+$datacar->Offer_Price+$datacar->Color_Price+$datacar->Add_Price,2)}}" placeholder="ราคาต้นทุน"  readonly />
                                </div>
                              </div>
                            </div>
                          </div>
                        @endif

                        <div class="row">
                          @if($datacar->Car_type == "7")
                            <div div class="col-6" id="show1">
                          @else
                            <div div class="col-6" id="show1" style="display:none;">
                          @endif
                            <div class="form-group row mb-1">
                              <label class="col-sm-3 col-form-label text-right"><font color="red">ราคาเปิดประมูล</font> :</label>
                              <div class="col-sm-8">
                                <input type="text" id="Open_auction" name="Open_auction" class="form-control form-control-sm" value="{{number_format($datacar->Open_auction,2)}}" oninput="sum();" required/>
                              </div>
                            </div>
                          </div>

                          @if($datacar->Car_type == "7")
                            <div div class="col-6" id="show2">
                          @else
                            <div div class="col-6" id="show2" style="display:none;">
                          @endif
                            <div class="form-group row mb-1">
                              <label class="col-sm-3 col-form-label text-right"><font color="red">ราคาปิดประมูล</font> :</label>
                              <div class="col-sm-8">
                                <input type="text" id="Close_auction" name="Close_auction" class="form-control form-control-sm" value="{{number_format($datacar->Close_auction,2)}}" oninput="sum();" required/>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-3 col-form-label text-right"><font color="red">ราคาคาดว่าจะขาย</font> :</label>
                              <div class="col-sm-8">
                                <input type="text" id="Expected_Sell" name="Expected_Sell" class="form-control form-control-sm" value="{{number_format($datacar->Expected_Sell, 2)}}" oninput="sum();" required/>
                              </div>
                            </div>
                          </div>           
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-3 col-form-label text-right"><font color="red">ราคาขาย</font> :</label>
                              <div class="col-sm-8">
                                <input type="text" id="NetCar" name="NetCar" class="form-control form-control-sm" value="{{number_format($datacar->Net_Price, 2)}}" oninput="sum();" required/>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-3 col-form-label text-right">ราคาแนะนำ :</label>
                              <div class="col-sm-8">
                                <input type="text" id="OfferPrice" name="OfferPrice" class="form-control form-control-sm" value="{{number_format($datacar->Offer_Price, 2)}}" oninput="sum();"  maxlength="10"/>
                              </div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-3 col-form-label text-right">ต้นทุนยอดจัด :</label>
                              <div class="col-sm-8">
                                @if($datacar->Accounting_Cost == null)
                                  <input type="text" id="AccountingCost" name="AccountingCost" class="form-control form-control-sm" placeholder="ต้นทุนยอดจัด" value="" oninput="sum();" maxlength="10"/>
                                @else
                                  <input type="text" id="AccountingCost" name="AccountingCost" class="form-control form-control-sm" placeholder="ต้นทุนยอดจัด" value="{{$datacar->Accounting_Cost}}" oninput="sum();" maxlength="10"/>
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-3 col-form-label text-right">ราคาซ่อม :</label>
                              <div class="col-sm-8">
                                <input type="text" id="RepairCar" name="RepairCar" class="form-control form-control-sm" value="{{number_format($datacar->Repair_Price, 2)}}" oninput="sum();" maxlength="10"/>
                              </div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-3 col-form-label text-right">ราคาเพิ่มเติม :</label>
                              <div class="col-sm-8">
                                <input type="text" id="AddPrice" name="AddPrice" class="form-control form-control-sm" value="{{number_format($datacar->Add_Price, 2)}}" oninput="sum();"  maxlength="10"/>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-6">
                            <div class="form-group row mb-1">
                              <label class="col-sm-3 col-form-label text-right">ราคาทำสี :</label>
                              <div class="col-sm-8">
                                <input type="text" id="ColorPrice" name="ColorPrice" class="form-control form-control-sm" value="{{number_format($datacar->Color_Price, 2)}}" oninput="sum();"  maxlength="10"/>
                              </div>
                            </div>
                          </div>
                        </div>
  
                    </div>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="card card-danger">
                    <div class="card-header">
                      <h3 class="card-title"><i class="fas fa-tasks"></i> เช็คเอกสารรถยนต์</h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="" id="todo-list">
                              <span class="todo-wrap">
                                <input type="checkbox" id="1" name="ContractsCar" value="complete" {{ ($datacar->Contracts_Car == "complete") ? 'checked' : '' }}/>
                                <label for="1" class="todo">
                                  <i class="fa fa-check"></i>
                                  สัญญาซื้อขาย
                                </label>
                              </span>
                              <span class="todo-wrap">
                                <input type="checkbox" id="2" name="ManualCar" value="complete" {{ ($datacar->Manual_Car == "complete") ? 'checked' : '' }}/>
                                <label for="2" class="todo">
                                  <i class="fa fa-check"></i>
                                  คู่มือ
                                </label>
                              </span>
                              <span class="todo-wrap">
                                <input type="checkbox" id="3" name="KeyReserve" value="complete" {{ ($datacar->Key_Reserve == "complete") ? 'checked' : '' }}/>
                                <label for="3" class="todo">
                                  <i class="fa fa-check"></i>
                                  กุญแจ
                                </label>
                              </span>
                              <span class="todo-wrap">
                                <input type="checkbox" id="4" name="ExpireTax" value="complete" {{ ($datacar->Expire_Tax == "complete") ? 'checked' : '' }}/>
                                <label for="4" class="todo">
                                  <i class="fa fa-check"></i>
                                  ป้ายภาษี
                                </label>
                              </span>
                              <span class="todo-wrap">
                                <input type="checkbox" id="5" name="ActCar" value="complete" {{ ($datacar->Act_Car == "complete") ? 'checked' : '' }}/>
                                <label for="5" class="todo">
                                  <i class="fa fa-check"></i>
                                  พ.ร.บ.
                                </label>
                              </span>
                              <span class="todo-wrap">
                                <input type="checkbox" id="6" name="InsuranceCar" value="complete" {{ ($datacar->Insurance_Car == "complete") ? 'checked' : '' }}/>
                                <label for="6" class="todo">
                                  <i class="fa fa-check"></i>
                                  ประกัน
                                </label>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="card card-warning">
                    <div class="card-header">
                      <h3 class="card-title"><i class="fas fa-book-reader"></i> ข้อมูลการยืมรถ</h3>
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
                            <label class="col-sm-3 col-form-label text-right">วันที่ยืม :</label>
                            <div class="col-sm-8">
                              <input type="date" id="DateBorrowcar" name="DateBorrowcar" class="form-control form-control-sm" value="{{$datacar->Date_Borrowcar}}" />
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">ชื่อผู้ยืม :</label>
                            <div class="col-sm-8">
                              <input type="text" name="NameBorrow" class="form-control form-control-sm" value="{{$datacar->Name_Borrow}}"/>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">วันที่คืน :</label>
                            <div class="col-sm-8">
                              <input type="date" id="DateReturncar" name="DateReturncar" class="form-control form-control-sm" value="{{$datacar->Date_Returncar}}" min="{{ $date3 }}" />
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">สถานะ :</label>
                            <div class="col-sm-8">
                              <select name="BorrowStatus" class="form-control form-control-sm">
                                @foreach ($arrayBorrowStatus as $key => $value)
                                  <option value="{{$key}}" {{ ($key == $datacar->BorrowStatus) ? 'selected' : '' }}>{{$value}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">หมายเหตุ :</label>
                            <div class="col-sm-8">
                              <textarea type="text" name="NoteBorrow" class="form-control" rows="3" placeholder="ป้อนหมายเหตุ">{{ $datacar->Note_Borrow }}</textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="card card-warning">
                    <div class="card-header">
                      <h3 class="card-title"><i class="fas fa-address-card"></i> ข้อมูลบัตร</h3>
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
                            <label class="col-sm-3 col-form-label text-right">วันที่หมดอายุ ปชช :</label>
                            <div class="col-sm-8">
                              <input type="date" id="DateNumberUser" class="form-control form-control-sm" name="DateNumberUser" min="{{ $date2 }}" value="{{ ($datacar->Date_NumberUser != '') ?$datacar->Date_NumberUser: 'วว/ดด/ปปปป' }}" onchange="myFunctionDateUser()">
                            </div>
                          </div>
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">วันที่หมดอายุภาษี :</label>
                            <div class="col-sm-8">
                              <input type="date" id="DateExpire" class="form-control form-control-sm" name="DateExpire" min="{{ $date2 }}" value="{{ ($datacar->Date_Expire != '') ?$datacar->Date_Expire: 'วว/ดด/ปปปป' }}" onchange="myFunctionDateExpire()">
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group row mb-1">
                            <label class="col-sm-3 col-form-label text-right">หมายเหตุ :</label>
                            <div class="col-sm-8">
                              <textarea type="text" name="CheckNote" class="form-control form-control-sm" rows="4" placeholder="ป้อนหมายเหตุ">{{ $datacar->Check_Note }}</textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <input type="hidden" id="mySelect1" class="form-control" name="DateNumberUserHidden" >
              <input type="hidden" id="mySelect2" class="form-control" name="DateExpireHidden" >

              <div class="modal fade" id="modal-default" aria-hidden="true" style="display: none;">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-body">
                        <div class="form-group">
                          <div class="file-loading">
                            <input id="image-file" type="file" name="file_image[]" accept="image/*" data-min-file-count="1" multiple>
                          </div>
                        </div>
                        <div class="row">
                          @foreach($dataImage as $key => $images)
                              <div class="col-sm-2">
                                <a href="{{ asset('upload-image/'.$images->Name_fileimage) }}" data-title="ภาพผู้เช่าซื้อ">
                                  <img src="{{ asset('upload-image/'.$images->Name_fileimage) }}" width="450px">
                                </a>
                              </div>
                          @endforeach
                        </div>
                      <hr>
                      </div>
                      <div class="text-center">
                        <button type="submit" class="btn btn-success">อัพโหลด</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                      </div>
                      <br>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
              </div>
            </div>

            <input type="hidden" name="_method" value="PATCH"/>
          </form>
          <a id="button"></a>
        </div>
      </div>
    </section>

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

  <!-- DateNumberUserHidden -->
  <script>
    function myFunctionDateUser() {
      var x = document.getElementById("DateNumberUser").value;
      document.form1.mySelect1.value = x;
    }
  </script>

  <!-- DateExpireHidden -->
  <script>
      function myFunctionDateExpire() {
        var x = document.getElementById("DateExpire").value;
        document.form1.mySelect2.value = x;
      }
  </script>

  <!-- เวลาแจ้งเตือน -->
  <script>
    $(".alert").fadeTo(3000, 500).slideUp(500, function(){
    $(".alert").alert('close');
    });;
  </script>

{{-- image --}}
  <script type="text/javascript">
    $("#image-file,#Account_image,#image_checker_1,#image_checker_2").fileinput({
      uploadUrl:"{{ route('MasterDatacar.store') }}",
      theme:'fa',
      uploadExtraData:function(){
        return{
          _token:"{{csrf_token()}}",
        }
      },
      allowedFileExtensions:['jpg','png','gif'],
      maxFileSize:10240
    })
  </script>

@endsection
