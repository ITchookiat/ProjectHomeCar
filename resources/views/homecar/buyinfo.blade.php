  @php
    date_default_timezone_set('Asia/Bangkok');
    $Y = date('Y') + 543;
    $Y2 = date('Y') + 542;
    $m = date('m');
    $d = date('d');
    //$date = date('Y-m-d');
    $time = date('H:i');
    $date = $Y.'-'.$m.'-'.$d;
    $date2 = $Y2.'-'.'01'.'-'.'01';
  @endphp

    <section class="content">
      <div class="card card-success">
        <div class="card-header">
          <h4 class="card-title"><b>เพิ่มข้อมูลขาย...</b></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form name="form1" method="post" action="{{ action('DatacarController@updateinfo',$id) }}" enctype="multipart/form-data">
          @csrf
          @method('put')
          <div class="card-body text-sm">
            <div class="row">
              <div class="col-md-12">
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

                  function comma(){
                    var num11 = document.getElementById('NetPriceplus').value;
                    var num1 = num11.replace(",","");
                    var num22 = document.getElementById('AmountPrice').value;
                    var num2 = num22.replace(",","");
                    var num33 = document.getElementById('DownPrice').value;
                    var num3 = num33.replace(",","");
                    var num44 = document.getElementById('TransferPrice').value;
                    var num4 = num44.replace(",","");
                    var num55 = document.getElementById('SubdownPrice').value;
                    var num5 = num55.replace(",","");
                    var num66 = document.getElementById('InsurancePrice').value;
                    var num6 = num66.replace(",","");

                    var expense = parseFloat(num6) + parseFloat(num4);
                    var topcar = parseFloat(num1) - (parseFloat(num3) + parseFloat(expense));

                    document.form1.NetPriceplus.value = addCommas(num1);
                    document.form1.AmountPrice.value = addCommas(num2);
                    document.form1.DownPrice.value = addCommas(num3);
                    document.form1.TransferPrice.value = addCommas(num4);
                    document.form1.SubdownPrice.value = addCommas(num5);
                    document.form1.InsurancePrice.value = addCommas(num6);
                    if(!isNaN(topcar)){
                    document.form1.TopcarPrice.value = addCommas(topcar);
                    }
                  }
                </script>

                <div class="row">
                  <div class="col-6">
                    <div class="form-group row mb-1">
                      <label class="col-sm-3 col-form-label text-right">วันที่ขาย :</label>
                      <div class="col-sm-8">
                        <input type="date" class="form-control form-control-sm" name="DateSoldoutplus" min="{{ $date2 }}" value="{{ $datacar->Date_Soldout_plus }}" />
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row mb-1">
                      <label class="col-sm-3 col-form-label text-right">วันที่เบิก :</label>
                      <div class="col-sm-8">
                        <input type="date" class="form-control form-control-sm" name="DateWithdraw" min="{{ $date2 }}" value="{{ $datacar->Date_Withdraw }}"  />
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-6">
                    <div class="form-group row mb-1">
                      <label class="col-sm-3 col-form-label text-right">ราคาขาย :</label>
                      <div class="col-sm-8">
                        <input type="text" id="NetPriceplus" name="NetPriceplus" class="form-control form-control-sm" placeholder="ป้อนราคาขาย" value="{{ number_format($datacar->Net_Priceplus, 2) }}" oninput="comma();" />
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row mb-1">
                      <label class="col-sm-3 col-form-label text-right">จำนวนเงิน :</label>
                      <div class="col-sm-8">
                        <input type="text" id="AmountPrice" name="AmountPrice" class="form-control form-control-sm" placeholder="ป้อนจำนวนเงิน" value="{{ number_format($datacar->Amount_Price, 2) }}" oninput="comma();" />
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-6">
                    <div class="form-group row mb-1">
                      <label class="col-sm-3 col-form-label text-right">ประเภทการขาย :</label>
                      <div class="col-sm-8">
                        <select name="TypeSale" class="form-control form-control-sm">
                          <option value="" selected>---เลือกประเภท---</option>
                        @foreach ($arrayTypeSale as $key => $value)
                          <option value="{{$key}}" {{ ($key == $datacar->Type_Sale) ? 'selected' : '' }}>{{$value}}</option>
                        @endforeach
                      </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row mb-1">
                      <label class="col-sm-3 col-form-label text-right">นายหน้า :</label>
                      <div class="col-sm-8">
                        <input type="text" name="NameAgent" class="form-control form-control-sm" placeholder="ป้อนชื่อนายหน้า" value="{{ $datacar->Name_Agent }}"/>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-6">
                    <div class="form-group row mb-1">
                      <label class="col-sm-3 col-form-label text-right">ผู้ซื้อ :</label>
                      <div class="col-sm-8">
                        <input type="text" name="NameBuyer" class="form-control form-control-sm" placeholder="ป้อนชื่อผู้ซื้อ" value="{{ $datacar->Name_Buyer }}"  />
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row mb-1">
                      <label class="col-sm-3 col-form-label text-right">Sale ขาย :</label>
                      <div class="col-sm-8">
                        <input type="text" name="NameSaleplus" class="form-control form-control-sm" placeholder="ป้อนชื่อ Sale ขาย" value="{{ $datacar->Name_Saleplus }}" />
                      </div>
                    </div>
                  </div>
                </div>

                <hr>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group row mb-1">
                      <label class="col-sm-3 col-form-label text-right">เงินดาวน์ :</label>
                      <div class="col-sm-8">
                        <input type="text" id="DownPrice" name="DownPrice" class="form-control form-control-sm" placeholder="ป้อนเงินดาวน์" value="{{number_format($datacar->Down_Price,2) }}" oninput="comma();"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row mb-1">
                      <label class="col-sm-3 col-form-label text-right">ค่าใช้จ่ายโอน :</label>
                      <div class="col-sm-8">
                        <input type="text" id="TransferPrice" name="TransferPrice" class="form-control form-control-sm" placeholder="ป้อนค่าใช้จ่ายโอน" value="{{ number_format($datacar->Transfer_Price,2) }}" oninput="comma();"/>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-6">
                    <div class="form-group row mb-1">
                      <label class="col-sm-3 col-form-label text-right">ซับดาวน์ :</label>
                      <div class="col-sm-8">
                        <input type="text" id="SubdownPrice" name="SubdownPrice" class="form-control form-control-sm" placeholder="ป้อนซับดาวน์" value="{{ number_format($datacar->Subdown_Price,2) }}" oninput="comma();"/>
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row mb-1">
                      <label class="col-sm-3 col-form-label text-right">ค่าประกัน :</label>
                      <div class="col-sm-8">
                        <input type="text" id="InsurancePrice" name="InsurancePrice" class="form-control form-control-sm" placeholder="ป้อนค่าประกัน" value="{{ number_format($datacar->Insurance_Price,2) }}" oninput="comma();"/>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-6">
                    <div class="form-group row mb-1">
                      <label class="col-sm-3 col-form-label text-right">ยอดจัด :</label>
                      <div class="col-sm-8">
                        <input type="text" id="TopcarPrice" name="TopcarPrice" class="form-control form-control-sm" placeholder="ป้อนยอดจัด" value="{{ number_format($datacar->Topcar_Price,2) }}" oninput="comma();"/>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <div class="form-group" align="center">
              <button type="submit" class="delete-modal btn btn-success">
                <span class="glyphicon glyphicon-floppy-save"></span> บันทึก
              </button>
              <a class="delete-modal btn btn-danger" href="{{ URL::previous() }}">
                <span class="glyphicon glyphicon-remove"></span> ยกเลิก
              </a>
            </div>
          </div>
          <input type="hidden" name="_method" value="PATCH"/>
        </form>
      </div>
    </section>
