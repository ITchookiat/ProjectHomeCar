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
@endphp


      <!-- Main content -->
      <section class="content">
        <div class="content-header">
          <div class="card">
            <div class="card-header">
              <h1 class="" style="text-align:center;"><b>เพิ่มข้อมูลรถยนต์</b></h1>
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
                    <form name="form1" action="{{ route('datacar.store') }}" method="post" id="formimage" enctype="multipart/form-data">
                      @csrf

                      <div class="row">
                        <div class="col-md-5">
                          <div class="float-right form-inline">
                            <label><font color="red">*</font> วันที่ซื้อ : &nbsp;</label>
                            <input type="date" class="form-control" name="DateCar" style="width: 250px;" value="{{ $date }}" min="{{ $date2 }}" required>
                          </div>
                        </div>
                      </div> <!-- endrow -->

                      <div class="row">
                        <div class="col-md-5">
                          <div class="float-right form-inline">
                            <label><font color="red">*</font> ยี่ห้อรถ :</label>
                            <select name="BrandCar" class="form-control" style="width: 250px;" required>
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

                        <div class="col-md-5">
                          <div class="float-right form-inline">
                            <label><font color="red">*</font>เลขทะเบียน :</label>
                            <input type="text" name="Number_Regist" class="form-control" style="width: 250px;" placeholder="ป้อนเลขทะเบียน" required/>
                          </div>
                        </div>
                      </div> <!-- endrow -->

                      <div class="row">
                        <div class="col-md-5">
                          <div class="float-right form-inline">
                            <label><font color="red">*</font>ที่มาของรถ :</label>
                            <select name="OriginCar" class="form-control" style="width: 250px;" required>
                              <option value="" selected>--- เลือกที่มาของรถ ---</option>
                              <option value="1">CKL</option>
                              <option value="2">รถประมูล</option>
                              <option value="3">รถยึด</option>
                              <option value="4">ฝากขาย</option>
                            </select>
                          </div>
                        </div>

                        <div class="col-md-5">
                          <div class="float-right form-inline">
                            <label> Sale :</label>
                            <input type="text" name="SaleCar" class="form-control" style="width: 250px;" placeholder="ป้อน Sale" />
                          </div>
                        </div>
                      </div> <!-- endrow -->

                      <div class="row">
                        <div class="col-md-5">
                          <div class="float-right form-inline">
                            <label>ลักษณะรถ :</label>
                            <select name="ModelCar" class="form-control" style="width: 250px;">
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
                        </div>

                        <div class="col-md-5">
                          <div class="float-right form-inline">
                            <label>เลขไมล์ :</label>
                            <input type="text" id="MilesCar" name="MilesCar" class="form-control" style="width: 250px;" placeholder="ป้อนเลขไมล์" oninput="mile();" maxlength="9"/>
                          </div>
                        </div>
                      </div> <!-- endrow -->

                      <div class="row">
                        <div class="col-md-5">
                          <div class="float-right form-inline">
                            <label>รุ่นรถ :</label>
                            <input type="text" name="VersionCar" class="form-control" style="width: 250px;" placeholder="ป้อนรุ่นรถ" />
                          </div>
                        </div>

                        <div class="col-md-5">
                          <div class="float-right form-inline">
                            <label>เกียร์รถ :</label>
                            <select name="Gearcar" class="form-control" style="width: 88px;">
                              <option value="">-เลือก-</option>
                              <option value="MT">MT</option>
                              <option value="AT">AT</option>
                            </select>
                            &nbsp;&nbsp;&nbsp;
                            <label>ปีที่ผลิต :</label>
                            <input type="text" name="YearCar" class="form-control" style="width: 88px;" />
                          </div>
                        </div>
                      </div> <!-- endrow -->

                      <div class="row">
                        <div class="col-md-5">
                          <div class="float-right form-inline">
                            <label>ขนาด :</label>
                            <input type="text" name="SizeCar" class="form-control" style="width: 225px;" placeholder="ป้อนขนาด" />
                            <label>ซีซี</label>
                          </div>
                        </div>

                        <div class="col-md-5">
                          <div class="float-right form-inline">
                            <label>สีรถ :</label>
                            <input type="text" name="ColorCar" class="form-control" style="width: 250px;" placeholder="ป้อนสีรถ" />
                          </div>
                        </div>
                      </div> <!-- endrow -->

                      <div class="row">
                        <div class="col-md-5">
                          <div class="float-right form-inline">
                            <label>Job Number :</label>
                            <input type="text" name="JobCar" class="form-control" style="width: 250px;" placeholder="ป้อน JobNumber" />
                          </div>
                        </div>

                        <div class="col-md-5">
                          <div class="float-right form-inline">
                            <label>ราคาแนะนำ :</label>
                            <input type="text" id="OfferPrice" name="OfferPrice" class="form-control" style="width: 250px;" placeholder="ป้อนราคาแนะนำ" oninput="mile();" maxlength="9"/>
                          </div>
                        </div>
                      </div> <!-- endrow -->

                      <div class="row">
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
                        @if(auth::user()->type == 1 or auth::user()->type == 3)
                          <div class="col-md-5">
                            <div class="float-right form-inline">
                              <label><font color="red">*</font> ราคาซื้อ :</label>
                              <input type="text" id="PriceCar" name="PriceCar" class="form-control" placeholder="ป้อนราคาซื้อ" style="width: 250px;" oninput="mile();" maxlength="9"/>
                            </div>
                          </div>
                        @endif

                        <div class="col-md-5">
                          <div class="float-right form-inline">
                            <label>ต้นทุนทางบัญชี :</label>
                            <input type="text" id="AccountingCost" name="AccountingCost" class="form-control" style="width: 250px;" placeholder="ต้นทุนทางบัญชี" oninput="mile();" maxlength="9"/>
                          </div>
                        </div>
                      </div> <!-- endrow -->

                      <P></p>
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
                                <label class="con3">
                                <input type="checkbox" class="checkbox" name="ContractsCar" id="" value="complete"> <!-- checked="checked"  -->
                                <span class="checkmark3"></span>
                                </label>
                              </th>
                              <th class="text-center">
                                <label class="con3">
                                <input type="checkbox" name="ManualCar" id="" value="complete">
                                <span class="checkmark3"></span>
                                </label>
                              </th>
                              <th class="text-center">
                                <label class="con3">
                                <input type="checkbox" name="KeyReserve" id="" value="complete">
                                <span class="checkmark3"></span>
                                </label>
                              </th>
                              <th class="text-center">
                                <label class="con3">
                                <input type="checkbox" name="ExpireTax" id="" value="complete">
                                <span class="checkmark3"></span>
                                </label>
                              </th>
                              <th class="text-center">
                                <label class="con3">
                                <input type="checkbox" name="ActCar" id="" value="complete">
                                <span class="checkmark3"></span>
                                </label>
                              </th>
                              <th class="text-center">
                                <label class="con3">
                                <input type="checkbox" name="InsuranceCar" id="" value="complete">
                                <span class="checkmark3"></span>
                                </label>
                              </th>
                            </tr>
                          </tbody>
                        </table>
                      </div>

                      <br>
                      <div class="row">
                        <div class="col-md-5">
                          <div class="float-right form-inline">
                            <label style="vertical-align: top;">หมายเหตุ :</label>
                            <textarea name="CheckNote" class="form-control" placeholder="ป้อนหมายเหตุ" rows="4" style="width: 250px;"></textarea>
                          </div>
                        </div>

                        <div class="col-md-5">
                          <div class="float-right form-inline">
                            <label>วันที่หมดอายุ ปชช :</label>
                            <input type="date" id="DateNumberUser" class="form-control" name="DateNumberUser" style="width: 250px;" min="{{ $date2 }}" placeholder="ป้อนวันที่หมดอายุ ปชช">
                          </div>

                          <div class="float-right form-inline">
                            <label>วันที่หมดอายุภาษี :</label>
                            <input type="date" id="DateExpire" class="form-control" name="DateExpire" style="width: 250px;" min="{{ $date2 }}" placeholder="ป้อนวันที่หมดอายุภาษี">
                          </div>

                          <input type="hidden" id="mySelect1" class="form-control" name="DateNumberUserHidden" >
                          <input type="hidden" id="mySelect2" class="form-control" name="DateExpireHidden" >
                        </div>
                      </div>

                      <input type="hidden" name="_token" value="{{csrf_token()}}" />
                      <hr>
                      <div class="form-group">
                        <input type="hidden" readonly name="Cartype" value="{{ $type }}" class="form-control" />
                      </div>
                      <div class="form-group" align="center">
                        <button type="submit" class="delete-modal btn btn-success">
                          <span class="glyphicon glyphicon-floppy-save"></span> บันทึก
                        </button>
                        <a class="delete-modal btn btn-danger" href="{{ route('datacar',1) }}">
                          <span class="glyphicon glyphicon-remove"></span> ยกเลิก
                        </a>
                      </div>
                    </form>

                  </div>
                </div>
              </div>
          </div>
        </div>
      </section>

  <!-- DateNumberUserHidden -->
  <script>
    function myFunctionDateUser() {
      var x = document.getElementById("DateNumberUser").value;
      document.form1.mySelect1.value = x;
    }
  </script>

  <!-- DateExpireHidden       -->
  <script>
    function myFunctionDateExpire() {
      var x = document.getElementById("DateExpire").value;
      document.form1.mySelect2.value = x;
    }
  </script>

  <script type="text/javascript">
    $(".alert").fadeTo(3000, 1000).slideUp(1000, function(){
    $(".alert").alert('close');
    });
  </script>

@endsection
