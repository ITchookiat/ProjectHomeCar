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

<section class="content">
  <div class="card card-warning">
    <div class="card-header">
      <h4 class="card-title">
        <i class="fas fa-car"></i>&nbsp;
        ข้อมูลลูกค้า
      </h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>

    <form name="form1" action="{{ route('ResearchCus.store', 1) }}" method="post" id="formimage" enctype="multipart/form-data">
      @csrf
      <div class="card-body text-sm">
        <h5 class="text-center"><b>แบบฟอร์มข้อมูลลูกค้า</b></h5>
        <div>
          <div class="row">
            <div class="col-6">
              <div class="form-group row mb-0">
                <label class="col-sm-3 col-form-label text-right">ชื่อ - นามสกุล : </label>
                <div class="col-sm-8">
                  <input type="text" name="NameCus" class="form-control" style="height:30px;" placeholder="ป้อนชื่อ-นามสกุล" />
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group row mb-0">
                <label class="col-sm-3 col-form-label text-right">เบอร์ติดต่อ : </label>
                <div class="col-sm-8">
                  <input type="text" name="PhoneCus" class="form-control" style="height:30px;" placeholder="ป้อนเบอร์ติดต่อ" data-inputmask="&quot;mask&quot;:&quot;999-9999999,999-9999999&quot;" data-mask=""/>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-6">
              <div class="form-group row mb-0">
                <label class="col-sm-3 col-form-label text-right">ที่อยู่ : </label>
                <div class="col-sm-8">
                  <input type="text" name="AddressCus" class="form-control" style="height:30px;" placeholder="ป้อนที่อยู่" />
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group row mb-0">
                <label class="col-sm-3 col-form-label text-right">จังหวัด/ไปรษณีย์ : </label>
                <div class="col-sm-4">
                  <input type="text" name="ProvinceCus" class="form-control" style="height:30px;" placeholder="ป้อนจังหวัด" />
                </div>
                <div class="col-sm-4">
                  <input type="text" name="ZipCus" class="form-control" style="height:30px;" placeholder="ป้อนรหัสไปรษณีย์" data-inputmask="&quot;mask&quot;:&quot;99999&quot;" data-mask=""/>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-6">
              <div class="form-group row mb-0">
                <label class="col-sm-3 col-form-label text-right">อาชีพ : </label>
                <div class="col-sm-8">
                  <input type="text" name="CareerCus" class="form-control" style="height:30px;" placeholder="ป้อนอาชีพ" />
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group row mb-0">
                <label class="col-sm-3 col-form-label text-right">Email : </label>
                <div class="col-sm-8">
                  <input type="text" name="EmailCus" class="form-control" style="height:30px;" placeholder="ป้อนอีเมลล์" />
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-6">
              <div class="form-group row mb-1">
                <label class="col-sm-3 col-form-label text-right">แหล่งที่มาลูกค้า : </label>
                <div class="col-sm-8">
                  <select name="OriginCus" class="form-control">
                    <option value="" selected>--- แหล่งที่มา ---</option>
                    <option value="ป้ายโฆษณา/รถแห่/วิทยุ/จดหมาย">ป้ายโฆษณา/รถแห่/วิทยุ/จดหมาย</option>
                    <option value="ลูกค้าไฟแนนซ์เก่า/ลูกค้าซื้อขายเก่า">ลูกค้าไฟแนนซ์เก่า/ลูกค้าซื้อขายเก่า</option>
                    <option value="นายหน้า/ลูกค้าแนะนำ">นายหน้า/ลูกค้าแนะนำ</option>
                    <option value="อื่นๆ...">อื่นๆ...</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group row mb-1">
                <label class="col-sm-3 col-form-label text-right">รูปแบบลูกค้า : </label>
                <div class="col-sm-8">
                  <select name="modelCus" class="form-control">
                    <option value="" selected>--- เลือกรูปแบบ ---</option>
                    <option value="Walk In">Walk In</option>
                    <option value="Call In">Call In</option>
                    <option value="Other">Other</option>
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
                <input type="text" name="SaleCus" value="{{ auth::user()->name }}" class="form-control" style="height:30px;" placeholder="ผู้เสนอราคา" readonly/>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group row mb-0">
                <label class="col-sm-3 col-form-label text-right"><font color="red">วันที่รับลูกค้า : </font></label>
                <div class="col-sm-8">
                  <input type="date" name="DateSaleCus" class="form-control" value="{{ date('Y-m-d') }}" style="height:30px;" placeholder="ลงวันที่" required/>
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
                    <input type="checkbox" id="1" name="StatusCus" value="ติดตาม"/>
                    <label for="1" class="todo">
                      <i class="fa fa-check"></i>
                      ติดตาม
                    </label>
                  </span>
                </div>
                <div class="col-sm-4">
                  <span class="todo-wrap">
                    <input type="checkbox" id="2" name="StatusCus" value="จองรถ"/>
                    <label for="2" class="todo">
                      <i class="fa fa-check"></i>
                      จองรถ
                    </label>
                  </span>
                </div>
              </div>
  
              <div class="form-group row mb-1">
                <label class="col-sm-3 col-form-label text-right"></label>
                <div class="col-sm-4">
                  <span class="todo-wrap">
                    <input type="checkbox" id="3" name="StatusCus" value="ส่งมอบ"/>
                    <label for="3" class="todo">
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
                    <input type="checkbox" id="5" name="TypeCus" value="Very Hot"/>
                    <label for="5" class="todo">
                      <i class="fa fa-check"></i>
                      Very Hot
                    </label>
                  </span>
                </div>
                <div class="col-sm-4">
                  <span class="todo-wrap">
                    <input type="checkbox" id="6" name="TypeCus" value="Hot"/>
                    <label for="6" class="todo">
                      <i class="fa fa-check"></i>
                      Hot (1-5)
                    </label>
                  </span>
                </div>
              </div>
  
              <div class="form-group row mb-1">
                <label class="col-sm-3 col-form-label text-right"></label>
                <div class="col-sm-4">
                  <span class="todo-wrap">
                    <input type="checkbox" id="7" name="TypeCus" value="Warm"/>
                    <label for="7" class="todo">
                      <i class="fa fa-check"></i>
                      Warm (6-15)
                    </label>
                  </span>
                </div>
                <div class="col-sm-4">
                  <span class="todo-wrap">
                    <input type="checkbox" id="8" name="TypeCus" value="Cold"/>
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
            </ul>
          </div>

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
              var num11 = document.getElementById('CashCar').value;
              var num1 = num11.replace(",","");
              var num22 = document.getElementById('CashdownCar').value;
              var num2 = num22.replace(",","");
              var num33 = document.getElementById('PaymentCar').value;
              var num3 = num33.replace(",","");
              var num44 = document.getElementById('Turn_WantPriceCar').value;
              var num4 = num44.replace(",","");
              var num55 = document.getElementById('Turn_ComPriceCar').value;
              var num5 = num55.replace(",","");
              var num66 = document.getElementById('By_CashDown').value;
              var num6 = num66.replace(",","");
              var num77 = document.getElementById('By_Transfer').value;
              var num7 = num77.replace(",","");
              var num88 = document.getElementById('By_Register').value;
              var num8 = num88.replace(",","");
              var num99 = document.getElementById('By_Act').value;
              var num9 = num99.replace(",","");
              var num112 = document.getElementById('SumPrice').value;
              var num12 = num112.replace(",","");

              document.form1.CashCar.value = addCommas(num1);
              document.form1.CashdownCar.value = addCommas(num2);
              document.form1.PaymentCar.value = addCommas(num3);
              document.form1.Turn_WantPriceCar.value = addCommas(num4);
              document.form1.Turn_ComPriceCar.value = addCommas(num5);
              document.form1.By_CashDown.value = addCommas(num6);
              document.form1.By_Transfer.value = addCommas(num7);
              document.form1.By_Register.value = addCommas(num8);
              document.form1.By_Act.value = addCommas(num9);
              document.form1.SumPrice.value = addCommas(num12);
            }
          </script>

          <div class="tab-content">
            <div class="tab-pane fade show active" id="Sub-tab1" role="tabpanel" aria-labelledby="Sub-custom-tab1">
              <div>
                <p></p>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group row mb-1">
                      <label class="col-sm-3 col-form-label text-right">เลขทะเบียน : </label>
                      <div class="col-sm-8">
                        <select name="RegisterCar" id="RegisterCar" class="form-control RegisterCar  select2 select2-hidden-accessible">
                          <option value="" selected>--- เลขทะเบียน ---</option>
                          @foreach ($data as $key => $value)
                            <option value="{{$value->id}}">{{$value->Number_Regist}}</option>
                          @endforeach
                        </select>
                        <span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" data-select2-id="10"></span>
                      </div>
                    </div>
                  </div>
                </div>

                <div id="ShowData"></div>
              </div>
              <p></p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="card-tools d-inline float-right">
              <button type="submit" class="delete-modal btn btn-success">
                <i class="fas fa-save"></i> บันทึก
              </button>
              <a class="delete-modal btn btn-danger" href="{{ URL::previous() }}">
                <i class="far fa-window-close"></i> ยกเลิก
              </a>
            </div>
          </div>
        </div>

        <input type="hidden" name="_token" value="{{csrf_token()}}" />
      </div>
    </form>
  </div>
</section>

<script>
  $(function () {
    $('[data-mask]').inputmask()
  })
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


