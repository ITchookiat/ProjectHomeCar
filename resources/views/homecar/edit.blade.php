@extends('layouts.master')
@section('title','ร้อมูลรถยนต์มือ 2')
@section('content')

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


    <!-- Main content -->
    <section class="content">
      <div class="content-header">
        <div class="card">
          <div class="card-header">
            <h1 class="" style="text-align:center;"><b>แก้ไขข้อมูลรถยนต์</b></h1>
          </div>

            <div class="card-body">
              @if (count($errors) > 0)
                <div class="alert alert-danger">
                  <ul>
                    @foreach($errors->all() as $error)
                    <li>กรุณากรอกข้อมูลอีกครั้ง {{$error}}</li>
                    @endforeach
                  </ul>
                </div>
              @endif

              <div class="row">
                <div class="col-md-12"> <br />
                  <form name="form1" method="post" action="{{ action('DatacarController@update',$id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="row">
                      @if(auth::user()->type == 1)
                        <div class="col-5">
                          <div class="float-right form-inline">
                            <label><font color="red">* </font> วันที่ซื้อ :</label>
                            <input type="date" class="form-control" name="DateCar" style="width: 250px;" value="{{$datacar->create_date}}" />
                          </div>
                        </div>
                      @else 
                           <input type="hidden" class="form-control" name="DateCar" style="width: 250px;" value="{{$datacar->create_date}}" /> 
                      @endif

                    </div> <!-- endrow -->

                    <div class="row">
                      <div class="col-5">
                        <div class="float-right form-inline">
                          <label><font color="red">*</font>ยี่ห้อรถ :</label>
                          <select name="BrandCar" class="form-control" style="width: 250px;">
                            @foreach ($arrayBrand as $key => $value)
                              <option value="{{$key}}" {{ ($key == $datacar->Brand_Car) ? 'selected' : '' }}>{{$value}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-5">
                        <div class="float-right form-inline">
                            <label><font color="red">*</font>เลขทะเบียน :</label>
                            <input type="text" name="RegistCar" class="form-control" style="width: 250px;" placeholder="ป้อนเลขทะเบียน" value="{{$datacar->Number_Regist}}" />
                        </div>
                      </div>
                    </div> <!-- endrow -->

                    <div class="row">
                      <div class="col-5">
                        <div class="float-right form-inline">
                          <label><font color="red">*</font>ที่มาของรถ :</label>
                          <select name="OriginCar" class="form-control" style="width: 250px;">
                            @foreach ($arrayOriginType as $key => $value)
                              <option value="{{$key}}" {{ ($key == $datacar->Origin_Car) ? 'selected' : '' }}>{{$value}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-5">
                        <div class="float-right form-inline">
                          <label><font color="red">*</font>Sale :</label>
                          <input type="text" name="SaleCar" class="form-control" style="width: 250px;" placeholder="ป้อน Sale" value="{{$datacar->Name_Sale}}" />
                        </div>
                      </div>
                    </div> <!-- endrow -->

                    <div class="row">
                      <div class="col-5">
                        <div class="float-right form-inline">
                          <label>ลักษณะรถ :</label>
                          <select name="ModelCar" class="form-control" style="width: 250px;">
                            @foreach ($arrayModel as $key => $value)
                              <option value="{{$key}}" {{ ($key == $datacar->Model_Car) ? 'selected' : '' }}>{{$value}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-5">
                        <div class="float-right form-inline">
                          <label>เลขไมล์ :</label>
                          <input type="text" id="MilesCar" name="MilesCar" class="form-control" style="width: 250px;" placeholder="ป้อนเลขไมล์" value="{{$datacar->Number_Miles}}" oninput="mile();" maxlength="10"/>
                        </div>
                      </div>
                    </div> <!-- endrow -->

                    <div class="row">
                      <div class="col-5">
                        <div class="float-right form-inline">
                          <label>รุ่นรถ :</label>
                          <input type="text" name="VersionCar" class="form-control" style="width: 250px;" placeholder="ป้อนรุ่นรถ" value="{{$datacar->Version_Car}}" />
                        </div>
                      </div>
                      <div class="col-5">
                        <div class="float-right form-inline">
                        <label>เกียร์รถ :</label>
                          <select name="Gearcar" class="form-control" style="width: 90px;">
                            @foreach ($arrayGearcar as $key => $value)
                              <option value="{{$key}}" {{ ($key == $datacar->Gearcar) ? 'selected' : '' }}>{{$value}}</option>
                            @endforeach
                          </select>
                          &nbsp;&nbsp;
                          <label>ปีที่ผลิต :</label>
                          <input type="text" name="YearCar" class="form-control" style="width: 85px;" value="{{$datacar->Year_Product}}"  />
                        </div>
                      </div>
                    </div> <!-- endrow -->

                    <div class="row">
                      <div class="col-5">
                        <div class="float-right form-inline">
                          <label>ขนาด :</label>
                          <input type="text" name="SizeCar" class="form-control" style="width: 225px;" placeholder="ป้อนขนาด" value="{{$datacar->Size_Car}}" />
                          <label>ซีซี</label>
                        </div>
                      </div>
                      <div class="col-5">
                        <div class="float-right form-inline">
                          <label>สีรถ :</label>
                          <input type="text" name="ColorCar" class="form-control" style="width: 250px;" placeholder="ป้อนสีรถ" value="{{$datacar->Color_Car}}" />
                        </div>
                      </div>
                    </div> <!-- endrow -->

                    <div class="row">
                      <div class="col-5">
                        <div class="float-right form-inline">
                          <label>Job Number :</label>
                          <input type="text" name="JobCar" class="form-control" style="width: 250px;" placeholder="ป้อน JobNumber" value="{{$datacar->Job_Number}}" />
                        </div>
                      </div>
                      <div class="col-5">
                        <div class="float-right form-inline">
                          <label><font color="red">สถานะ</font> :</label>
                          <select name="Cartype" class="form-control" style="width: 250px;">
                            @foreach ($arrayCarType as $key => $value)
                              <option value="{{$key}}" {{ ($key == $datacar->Car_type) ? 'selected' : '' }}>{{$value}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div> <!-- endrow -->

                    <div class="row">
                      <div class="col-5">
                        <div class="float-right form-inline">
                          @if(auth::user()->type == 1 or auth::user()->type == 3)
                            <label><font color="red">*</font>ราคาซื้อ :</label>
                            <input type="text" id="PriceCar" name="PriceCar" class="form-control" style="width: 250px;" placeholder="ป้อนราคาซื้อ" value="{{number_format($datacar->Fisrt_Price,2)}}" oninput="sum();" maxlength="10"/>
                          @endif
                        </div>
                      </div>
                      <div class="col-5">
                        <div class="float-right form-inline">
                          <label>ต้นทุนยอดจัด :</label>
                          @if($datacar->Accounting_Cost == null)
                            <input type="text" id="AccountingCost" name="AccountingCost" class="form-control" style="width: 250px;" placeholder="ต้นทุนยอดจัด" value="" oninput="sum();" maxlength="10"/>
                          @else
                            <input type="text" id="AccountingCost" name="AccountingCost" class="form-control" style="width: 250px;" placeholder="ต้นทุนยอดจัด" value="{{$datacar->Accounting_Cost}}" oninput="sum();" maxlength="10"/>
                          @endif
                        </div>
                      </div>
                    </div> <!-- endrow -->

                    <hr>
                    <div class="row">
                      <div class="col-5">
                        <div class="float-right form-inline">
                          <label>ราคาแนะนำ :</label>
                          <input type="text" id="OfferPrice" name="OfferPrice" class="form-control" style="width: 250px;" placeholder="ป้อนราคาแนะนำ" value="{{number_format($datacar->Offer_Price, 2)}}" oninput="sum();"  maxlength="10"/>
                        </div>
                      </div>

                      <div class="col-5">
                        <div class="float-right form-inline">
                          <label>ราคาต้นทุน :</label>
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
                                var result = parseFloat(num11)+parseFloat(num22)+parseFloat(num33)+parseFloat(num44)+parseFloat(num55);
                                
                                document.form1.PriceCar.value = addCommas(num11);
                                document.form1.OfferPrice.value = addCommas(num22);
                                document.form1.RepairCar.value = addCommas(num33);
                                document.form1.ColorPrice.value = addCommas(num44);
                                document.form1.AddPrice.value = addCommas(num55);
                                document.form1.NetCar.value = addCommas(num66);
                                document.form1.AccountingCost.value = addCommas(num77);
                                if(!isNaN(result)){
                                  var final_result = parseFloat(result);
                                  final = addCommas(final_result.toFixed(2));
                                  document.form1.CapitalPrice.value = final;
                                }
                            }
                          </script>
                          <input type="text" id="CapitalPrice" name="CapitalPrice" class="form-control" style="width: 250px;" value="{{number_format($datacar->Fisrt_Price+$datacar->Repair_Price+$datacar->Offer_Price+$datacar->Color_Price+$datacar->Add_Price,2)}}" placeholder="ราคาต้นทุน"  readonly />
                        </div>
                      </div>
                    </div> <!-- endrow -->

                    <div class="row">
                      <div class="col-5">
                        <div class="float-right form-inline">
                          <label>ราคาซ่อม :</label>
                          <input type="text" id="RepairCar" name="RepairCar" class="form-control" style="width: 250px;" placeholder="ป้อนราคาซ่อม" value="{{number_format($datacar->Repair_Price, 2)}}" oninput="sum();" maxlength="10"/>
                        </div>
                      </div>

                      <div class="col-5">
                        <div class="float-right form-inline">
                          <label>ราคาเพิ่มเติม :</label>
                          <input type="text" id="AddPrice" name="AddPrice" class="form-control" style="width: 250px;" placeholder="ป้อนราคาเพิ่มเติม" value="{{number_format($datacar->Add_Price, 2)}}" oninput="sum();"  maxlength="10"/>
                        </div>
                      </div>
                    </div> <!-- endrow -->

                    <div class="row">
                      <div class="col-5">
                        <div class="float-right form-inline">
                          <label>ราคาทำสี :</label>
                          <input type="text" id="ColorPrice" name="ColorPrice" class="form-control" style="width: 250px;" placeholder="ป้อนราคาทำสี" value="{{number_format($datacar->Color_Price, 2)}}" oninput="sum();"  maxlength="10"/>
                        </div>
                      </div>

                      <div class="col-5">
                        <div class="float-right form-inline">
                          <label>ราคาตั้งขาย :</label>
                          <input type="text" id="NetCar" name="NetCar" class="form-control" style="width: 250px;" placeholder="ป้อนราคาขาย" value="{{number_format($datacar->Net_Price, 2)}}" oninput="sum();"  maxlength="10"/>
                        </div>
                      </div>
                    </div> <!-- endrow -->

                    <hr>
                    <h3 align="center"><b>ข้อมูลการยืม</b></h3>
                    <div class="row">
                      <div class="col-5">
                        <div class="float-right form-inline">
                          <label>วันที่ยืมรถ :</label>
                          <input type="date" id="DateBorrowcar" name="DateBorrowcar" class="form-control" style="width: 250px;" value="{{$datacar->Date_Borrowcar}}" />
                        </div>
                      </div>

                      <div class="col-5">
                        <div class="float-right form-inline">
                          <label>ชื่อผู้ยืม :</label>
                          <input type="text" name="NameBorrow" class="form-control" style="width: 250px;" placeholder="ป้อนชื่อผู้ยืม" value="{{$datacar->Name_Borrow}}"/>
                        </div>
                      </div>
                    </div> <!-- endrow -->

                    <div class="row">
                        <div class="col-5">
                          <div class="float-right form-inline">
                            <label>วันที่คืนรถ :</label>
                            <input type="date" id="DateReturncar" name="DateReturncar" class="form-control" style="width: 250px;" value="{{$datacar->Date_Returncar}}" min="{{ $date3 }}" />
                          </div>
                      </div>

                      <div class="col-5">
                        <div class="float-right form-inline">
                          <label>สถานะการยืม :</label>
                          <select name="BorrowStatus" class="form-control" style="width: 250px;">
                            @foreach ($arrayBorrowStatus as $key => $value)
                              <option value="{{$key}}" {{ ($key == $datacar->BorrowStatus) ? 'selected' : '' }}>{{$value}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div> <!-- endrow -->

                    <div class="row">
                      <div class="col-5">
                        <div class="float-right form-inline">
                          <label style="vertical-align: top;">เหตุผลการยืม :</label>
                          <textarea type="text" name="NoteBorrow" class="form-control" rows="3" style="width: 250px;"  placeholder="ป้อนหมายเหตุ">{{ $datacar->Note_Borrow }}</textarea>
                        </div>
                      </div>

                      <div class="col-5">
                        <div class="float-right form-inline">
                        </div>
                      </div>
                    </div> <!-- endrow -->

                    <hr>
                    <h3 align="center"><b>เช็คเอกสารรถยนต์</b></h3>
                    <div class="table-responsive">
                    <table class="table table-bordered" id="table" style="width: 65%;" align="center">
                      <thead class="thead-dark">
                        <tr>
                          <th class="text-center" width="20%">สัญญาซื้อขาย</th>
                          <th class="text-center">คู่มือ</th>
                          <th class="text-center">กุญแจ</th>
                          <th class="text-center">ป้ายภาษี</th>
                          <th class="text-center">พ.ร.บ.</th>
                          <th class="text-center">ประกัน</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th class="text-center">
                            <div class="custom-control custom-checkbox">
                              <input class="custom-control-input" id="customCheckbox1" type="checkbox" name="ContractsCar" value="complete" {{ ($datacar->Contracts_Car == "complete") ? 'checked' : '' }}>
                              <label class="custom-control-label" for="customCheckbox1"></label>
                            </div>
                          </th>
                          <th class="text-center">
                            <div class="custom-control custom-checkbox">
                              <input class="custom-control-input" id="customCheckbox2" type="checkbox" name="ManualCar" value="complete" {{ ($datacar->Manual_Car == "complete") ? 'checked' : '' }}>
                              <label class="custom-control-label" for="customCheckbox2"></label>
                            </div>
                          </th>
                          <th class="text-center">
                            <div class="custom-control custom-checkbox">
                              <input class="custom-control-input" id="customCheckbox3" type="checkbox" name="KeyReserve" value="complete" {{ ($datacar->Key_Reserve == "complete") ? 'checked' : '' }}>
                              <label class="custom-control-label" for="customCheckbox3"></label>
                            </div>
                          </th>
                          <th class="text-center">
                            <div class="custom-control custom-checkbox">
                              <input class="custom-control-input" id="customCheckbox4" type="checkbox" name="ExpireTax" value="complete" {{ ($datacar->Expire_Tax == "complete") ? 'checked' : '' }}>
                              <label class="custom-control-label" for="customCheckbox4"></label>
                            </div>
                          </th>
                          <th class="text-center">
                            <div class="custom-control custom-checkbox">
                              <input class="custom-control-input" id="customCheckbox5" type="checkbox" name="ActCar" value="complete" {{ ($datacar->Act_Car == "complete") ? 'checked' : '' }}>
                              <label class="custom-control-label" for="customCheckbox5"></label>
                            </div>
                          </th>
                          <th class="text-center">
                            <div class="custom-control custom-checkbox">
                              <input class="custom-control-input" id="customCheckbox6" type="checkbox" name="InsuranceCar" value="complete" {{ ($datacar->Insurance_Car == "complete") ? 'checked' : '' }}>
                              <label class="custom-control-label" for="customCheckbox6"></label>
                            </div>
                          </th>
                        </tr>
                      </tbody>
                    </table>
                    </div>

                    <br>
                    <div class="row">
                      <div class="col-5">
                        <div class="float-right form-inline">
                          <label style="vertical-align: top;">หมายเหตุ :</label>
                          <textarea type="text" name="CheckNote" class="form-control" rows="4" style="width: 250px;"  placeholder="ป้อนหมายเหตุ">{{ $datacar->Check_Note }}</textarea>
                        </div>
                      </div>

                      <div class="col-5">
                        <div class="float-right form-inline">
                          <label>วันที่หมดอายุ ปชช :</label>
                          <input type="date" id="DateNumberUser" class="form-control" name="DateNumberUser" style="width: 250px;" min="{{ $date2 }}" value="{{ ($datacar->Date_NumberUser != '') ?$datacar->Date_NumberUser: 'วว/ดด/ปปปป' }}" onchange="myFunctionDateUser()">
                        </div>

                        <div class="float-right form-inline">
                          <label>วันที่หมดอายุภาษี :</label>
                          <input type="date" id="DateExpire" class="form-control" name="DateExpire" style="width: 250px;" min="{{ $date2 }}" value="{{ ($datacar->Date_Expire != '') ?$datacar->Date_Expire: 'วว/ดด/ปปปป' }}" onchange="myFunctionDateExpire()">
                        </div>

                        <input type="hidden" id="mySelect1" class="form-control" name="DateNumberUserHidden" >
                        <input type="hidden" id="mySelect2" class="form-control" name="DateExpireHidden" >
                      </div>
                    </div>

                    <hr/>
                    <div class="form-group" align="center">
                      <button type="submit" class="delete-modal btn btn-success">
                        <span class="glyphicon glyphicon-floppy-save"></span> อัพเดท
                      </button>
                      <a class="delete-modal btn btn-danger" href="{{ URL::previous() }}">
                        <span class="glyphicon glyphicon-remove"></span> ยกเลิก
                      </a>
                    </div>
                    <input type="hidden" name="_method" value="PATCH"/>
                  </form>

                </div>
              </div>
            </div>

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

@endsection
