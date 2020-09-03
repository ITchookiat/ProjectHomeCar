  <style>
    #todo-list{
    width:100%;
    margin:0 auto 140px auto;
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
    $create_date = date_create($datacar->create_date);
    $Date_NumberUser = date_create($datacar->Date_NumberUser);
    $Date_Expire = date_create($datacar->Date_Expire);

    $Date_soldoutplus = date_create($datacar->Date_Soldout_plus);
    $Date_Withdraw = date_create($datacar->Date_Withdraw);
  @endphp

  @php
    date_default_timezone_set('Asia/Bangkok');
    $Y = date('Y') + 543;
    $m = date('m');
    $d = date('d');
    $ifdate = $Y.'-'.$m.'-'.$d;
  @endphp

  @if($datacar->Date_Soldout_plus == Null)
    @php
      $Date_soldoutplus = 'วว/ดด/ปปปป';
    @endphp
  @else
    @php
      $Date_soldoutplus = date_create($datacar->Date_Soldout_plus);
      $Date_soldoutplus = date_format($Date_soldoutplus, 'd-m-Y');

    @endphp
  @endif

  @if($datacar->Date_Withdraw == Null)
    @php
      $Date_Withdraw = 'วว/ดด/ปปปป';
    @endphp
  @else
    @php
      $Date_Withdraw = date_create($datacar->Date_Withdraw);
      $Date_Withdraw = date_format($Date_Withdraw, 'd-m-Y');

    @endphp
  @endif

  <section class="content">
    <div class="modal-header" >
      <h5 class="modal-title">ป้ายทะเบียน <b><font color="red">{{$datacar->Number_Regist}}</font></b></h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
    <div class="panel panel-default">
      <div class="panel-body text-sm">

        <div class="row">
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">วันที่ซื้อ - ปัจจุบัน (หรือปิดการขาย)</span>
                <span class="info-box-number">
                  @if($ifdate > $datacar->create_date && $datacar->Date_Soldout == Null)
                    @php
                      $Cldate = date_create($datacar->create_date);
                      $nowCldate = date_create($ifdate);
                      $ClDateDiff = date_diff($Cldate,$nowCldate);
                    @endphp

                    <font color="red">{{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน</font>
                  @elseif($datacar->Date_Soldout != Null)
                    @php
                      $Cldate = date_create($datacar->create_date);
                      $nowCldate = date_create($datacar->Date_Soldout);
                      $ClDateDiff = date_diff($Cldate,$nowCldate);
                    @endphp

                    <font color="blue">{{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน</font>
                  @elseif($datacar->create_date == $ifdate)
                    <font color="red">0 ปี 0 เดือน 0 วัน</font>
                  @endif
                </span>
              </div>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-palette"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">นำเข้า - รอทำสี</span>
                <span class="info-box-number">
                  @if($datacar->Date_Color == Null && $datacar->Date_Wait == Null && $datacar->Date_Repair == Null && $datacar->Date_Sale == Null && $datacar->Date_Soldout == Null)
                    @php
                      $Cldate = date_create($datacar->create_date);
                      $nowCldate = date_create($ifdate);
                      $ClDateDiff = date_diff($Cldate,$nowCldate);
                    @endphp

                    <font color="red">{{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน</font>
                  @elseif($datacar->Date_Color != Null)
                    @php
                      $Cldate = date_create($datacar->Date_Color);
                      $nowCldate = date_create($datacar->create_date);
                      $ClDateDiff = date_diff($Cldate,$nowCldate);
                    @endphp

                    <font color="blue">{{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน</font>
                  @elseif($datacar->Date_Color == Null)
                    @if($datacar->Date_Color == Null && $datacar->Date_Wait != Null)
                      0 ปี 0 เดือน 0 วัน
                    @elseif($datacar->Date_Color == Null && $datacar->Date_Repair != Null)
                      0 ปี 0 เดือน 0 วัน
                    @elseif($datacar->Date_Color == Null && $datacar->Date_Sale != Null)
                      0 ปี 0 เดือน 0 วัน
                    @elseif($datacar->Date_Color == Null && $datacar->Date_Soldout != Null)
                      0 ปี 0 เดือน 0 วัน
                    @endif
                  @endif
                </span>
              </div>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-paint-roller"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">ระหว่างทำสี</span>
                <span class="info-box-number">
                  @if($datacar->Date_Color != Null)
                    @if($datacar->Date_Wait == Null)
                        <!-- ช่องรอซ่อมไม่มีค่า/ระหว่างซ่อมมีค่า -->
                        @if($datacar->Date_Wait == Null && $datacar->Date_Repair != Null)
                          @php
                            $Cldate = date_create($datacar->Date_Color);
                            $nowCldate = date_create($datacar->Date_Repair);
                            $ClDateDiff = date_diff($Cldate,$nowCldate);
                          @endphp

                          <font color="blue">{{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน</font>
                        <!-- ช่องรอซ่อมไม่มีค่า/ตั้งขายมีค่า -->
                        @elseif($datacar->Date_Wait == Null && $datacar->Date_Sale != Null)
                          @php
                            $Cldate = date_create($datacar->Date_Color);
                            $nowCldate = date_create($datacar->Date_Sale);
                            $ClDateDiff = date_diff($Cldate,$nowCldate);
                          @endphp

                          <font color="blue">{{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน</font>
                        <!-- ช่องรอซ่อมไม่มีค่า/ขายแล้วมีค่า -->
                        @elseif($datacar->Date_Wait == Null && $datacar->Date_Soldout != Null)
                          @php
                            $Cldate = date_create($datacar->Date_Color);
                            $nowCldate = date_create($datacar->Date_Soldout);
                            $ClDateDiff = date_diff($Cldate,$nowCldate);
                          @endphp

                          <font color="blue">{{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน</font>
                        <!-- ช่องรอซ่อมไม่มีค่า -->
                        @elseif($datacar->Date_Wait == Null)
                          @php
                            $Cldate = date_create($datacar->Date_Color);
                            $nowCldate = date_create($ifdate);
                            $ClDateDiff = date_diff($Cldate,$nowCldate);
                          @endphp

                          <font color="red">{{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน</font>
                        @endif
                    <!-- ช่องรอซ่อมค่า -->
                    @elseif($datacar->Date_Wait != Null)
                      @php
                        $Cldate = date_create($datacar->Date_Color);
                        $nowCldate = date_create($datacar->Date_Wait);
                        $ClDateDiff = date_diff($Cldate,$nowCldate);
                      @endphp

                      <font color="blue">{{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน</font>
                    @endif
                  @else($datacar->Date_Color == Null)
                    0 ปี 0 เดือน 0 วัน
                  @endif
                </span>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-clock"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">รอซ่อม</span>
                <span class="info-box-number">
                  @if($datacar->Date_Wait != Null)
                    @if($datacar->Date_Repair == Null)
                        @if($datacar->Date_Repair == Null && $datacar->Date_Sale != Null)
                          @php
                            $Cldate = date_create($datacar->Date_Wait);
                            $nowCldate = date_create($datacar->Date_Sale);
                            $ClDateDiff = date_diff($Cldate,$nowCldate);
                          @endphp

                          <font color="blue">{{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน</font>
                        @elseif($datacar->Date_Repair == Null && $datacar->Date_Soldout != Null)
                          @php
                            $Cldate = date_create($datacar->Date_Wait);
                            $nowCldate = date_create($datacar->Date_Soldout);
                            $ClDateDiff = date_diff($Cldate,$nowCldate);
                          @endphp

                          <font color="blue">{{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน</font>
                        @elseif($datacar->Date_Repair == Null)
                          @php
                            $Cldate = date_create($datacar->Date_Wait);
                            $nowCldate = date_create($ifdate);
                            $ClDateDiff = date_diff($Cldate,$nowCldate);
                          @endphp

                          <font color="red">{{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน</font>
                        @endif
                    @elseif($datacar->Date_Repair != Null)
                      @php
                        $Cldate = date_create($datacar->Date_Wait);
                        $nowCldate = date_create($datacar->Date_Repair);
                        $ClDateDiff = date_diff($Cldate,$nowCldate);
                      @endphp
                      <font color="blue">{{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน</font>
                    @endif
                  @else($datacar->Date_Wait == Null)
                    0 ปี 0 เดือน 0 วัน
                  @endif
                </span>
              </div>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">ระหว่างซ่อม</span>
                <span class="info-box-number">
                  @if($datacar->Date_Repair != Null)
                    @if($datacar->Date_Sale == Null)
                      @if($datacar->Date_Sale == Null && $datacar->Date_Soldout != Null)
                        @php
                          $Cldate = date_create($datacar->Date_Repair);
                          $nowCldate = date_create($datacar->Date_Soldout);
                          $ClDateDiff = date_diff($Cldate,$nowCldate);
                        @endphp

                        <font color="blue">{{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน</font>
                      @elseif($datacar->Date_Sale == Null)
                        @php
                          $Cldate = date_create($datacar->Date_Repair);
                          $nowCldate = date_create($ifdate);
                          $ClDateDiff = date_diff($Cldate,$nowCldate);
                        @endphp

                        <font color="red">{{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน</font>
                      @endif
                    @elseif($datacar->Date_Sale != Null)
                      @php
                        $Cldate = date_create($datacar->Date_Repair);
                        $nowCldate = date_create($datacar->Date_Sale);
                        $ClDateDiff = date_diff($Cldate,$nowCldate);
                      @endphp
                      <font color="blue">{{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน</font>
                    @endif
                  @else($datacar->Date_Repair == Null)
                    0 ปี 0 เดือน 0 วัน
                  @endif
                </span>
              </div>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-car"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">พร้อมขาย - ขายได้</span>
                <span class="info-box-number">
                  @if($datacar->Date_Sale != Null)
                    @if($datacar->Date_Soldout == Null)
                      @php
                        $Cldate = date_create($datacar->Date_Sale);
                        $nowCldate = date_create($ifdate);
                        $ClDateDiff = date_diff($Cldate,$nowCldate);
                      @endphp

                      <font color="red">{{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน</font>
                    @elseif($datacar->Date_Soldout != Null)
                      @php
                        $Cldate = date_create($datacar->Date_Soldout);
                        $nowCldate = date_create($datacar->Date_Sale);
                        $ClDateDiff = date_diff($Cldate,$nowCldate);
                      @endphp

                      <font color="blue">{{$ClDateDiff->y}} ปี {{$ClDateDiff->m}} เดือน {{$ClDateDiff->d}} วัน</font>
                    @endif
                  @else($datacar->Date_Sale == Null)
                      0 ปี 0 เดือน 0 วัน
                  @endif
                </span>
              </div>
            </div>
          </div>
        </div>


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
                    <div class="form-group row mb-0">
                      <label class="col-sm-3 col-form-label text-right">วันที่ซื้อ :</label>
                      <div class="col-sm-8">
                        <input type="text" name="DateCar" class="form-control form-control-sm" placeholder="ยังไม่มีการป้อน" value="{{date_format($create_date, 'd-m-Y')}}" readonly />
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row mb-0">
                      <label class="col-sm-4 col-form-label text-right"><font color="red">สถานะ</font> :</label>
                      <div class="col-sm-8">
                        <select name="Cartype" class="form-control form-control-sm" disabled>
                          @foreach ($arrayCarType as $key => $value)
                            <option disabled value="{{$key}}" {{ ($key == $datacar->Car_type) ? 'selected' : '' }}>{{$value}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                </div>

                @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER" or auth::user()->position == "AUDIT")
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row mb-0">
                        <label class="col-sm-3 col-form-label text-right"><font color="red">ราคาซื้อ</font> :</label>
                        <div class="col-sm-8">
                          @if($datacar->Fisrt_Price == '' OR $datacar->Fisrt_Price == Null )
                            <input type="text" name="PriceCar" class="form-control form-control-sm" placeholder="ยังไม่มีการป้อน" value="" readonly />
                          @else
                            <input type="text" name="PriceCar" class="form-control form-control-sm" placeholder="ยังไม่มีการป้อน" value="{{number_format($datacar->Fisrt_Price, 2)}}" readonly />
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-0">
                        <label class="col-sm-4 col-form-label text-right"><font color="red">ราคาต้นทุน</font> :</label>
                        <div class="col-sm-8">
                          <input type="text" name="TotalPrice" class="form-control form-control-sm" placeholder="ยังไม่มีการป้อน" value="{{number_format($datacar->Fisrt_Price+$datacar->Repair_Price+$datacar->Offer_Price+$datacar->Color_Price+$datacar->Add_Price, 2)}}" readonly />
                        </div>
                      </div>
                    </div>
                  </div>
                @endif

                @if($datacar->Car_type == '7')
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row mb-0">
                        <label class="col-sm-3 col-form-label text-right"><font color="red">ราคาเปิดประมูล</font> :</label>
                        <div class="col-sm-8">
                            <input type="text" name="Open_auction" class="form-control form-control-sm" placeholder="ยังไม่มีการป้อน" value="{{number_format($datacar->Open_auction, 2)}}" readonly />
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group row mb-0">
                        <label class="col-sm-4 col-form-label text-right"><font color="red">ราคาปิดประมูล</font> :</label>
                        <div class="col-sm-8">
                          <input type="text" name="Close_auction" class="form-control form-control-sm" placeholder="ยังไม่มีการป้อน" value="{{number_format($datacar->Close_auction, 2)}}" readonly />
                        </div>
                      </div>
                    </div>
                  </div>
                @endif

                <div class="row">
                  <div class="col-6">
                    <div class="form-group row mb-0">
                      <label class="col-sm-3 col-form-label text-right"><font color="red">ราคาคาดว่าจะขาย</font> :</label>
                      <div class="col-sm-8">
                        <input type="text" name="Expected_Sell" class="form-control form-control-sm" placeholder="ยังไม่มีการป้อน" value="{{ ($datacar->Expected_Sell !== NULL) ? $datacar->Expected_Sell : number_format($datacar->Expected_Sell, 2) }}" readonly />
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row mb-1">
                      <label class="col-sm-4 col-form-label text-right"><font color="red">ราคาขาย</font> :</label>
                      <div class="col-sm-8">
                        <input type="text" id="NetCar" name="NetCar" class="form-control form-control-sm" value="{{number_format($datacar->Net_Price, 2)}}" oninput="sum();" readonly/>
                      </div>
                    </div>
                  </div>
                </div>

                @if(auth::user()->type == "Admin" or auth::user()->position == "MANAGER" or auth::user()->position == "AUDIT")
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group row mb-0">
                        <label class="col-sm-3 col-form-label text-right">ต้นทุนบัญชี :</label>
                        <div class="col-sm-8">
                          @if($datacar->Accounting_Cost == '' OR $datacar->Accounting_Cost == Null )
                            <input type="text" name="AccountingCost" class="form-control form-control-sm" placeholder="ต้นทุนบัญชี" value="" readonly />
                          @else
                            <input type="text" name="AccountingCost" class="form-control form-control-sm" placeholder="ต้นทุนบัญชี" value="{{number_format($datacar->Accounting_Cost, 2)}}" readonly />
                          @endif
                        </div>
                      </div>
                    </div>    
                  </div>  
                @endif  

                <div class="row">
                  <div class="col-6">
                    <div class="form-group row mb-0">
                      <label class="col-sm-3 col-form-label text-right">ราคาแนะนำ :</label>
                      <div class="col-sm-8">
                        @if($datacar->Offer_Price == '' OR $datacar->Offer_Price == Null )
                          <input type="text" name="OfferPrice" class="form-control form-control-sm" placeholder="ยังไม่มีการป้อน" value="" readonly />
                        @else
                          <input type="text" name="OfferPrice" class="form-control form-control-sm" placeholder="ยังไม่มีการป้อน" value="{{number_format($datacar->Offer_Price, 2)}}" readonly />
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row mb-0">
                      <label class="col-sm-4 col-form-label text-right">ราคาเพิ่มเติม :</label>
                      <div class="col-sm-8">
                        @if($datacar->Add_Price == '' OR $datacar->Add_Price == Null )
                          <input type="text" name="AddPrice" class="form-control form-control-sm" placeholder="ยังไม่มีการป้อน" value="" readonly />
                        @else
                          <input type="text" name="AddPrice" class="form-control form-control-sm" placeholder="ยังไม่มีการป้อน" value="{{number_format($datacar->Add_Price, 2)}}" readonly />
                        @endif
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-6">
                    <div class="form-group row mb-0">
                      <label class="col-sm-3 col-form-label text-right">ราคาซ่อม :</label>
                      <div class="col-sm-8">
                        @if($datacar->Repair_Price == '' OR $datacar->Repair_Price == Null )
                          <input type="text" name="RepairCar" class="form-control form-control-sm" placeholder="ยังไม่มีการป้อน" value="" readonly />
                        @else
                          <input type="text" name="RepairCar" class="form-control form-control-sm" placeholder="ยังไม่มีการป้อน" value="{{number_format($datacar->Repair_Price, 2)}}" readonly />
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row mb-0">
                      <label class="col-sm-4 col-form-label text-right">ราคาทำสี :</label>
                      <div class="col-sm-8">
                        @if($datacar->Color_Price == '' OR $datacar->Color_Price == Null )
                         <input type="text" name="ColorCar" class="form-control form-control-sm" placeholder="ยังไม่มีการป้อน" value="" readonly />
                        @else
                          <input type="text" name="ColorCar" class="form-control form-control-sm" placeholder="ยังไม่มีการป้อน" value="{{number_format($datacar->Color_Price, 2)}}" readonly />
                        @endif
                      </div>
                    </div>
                  </div>
                </div>

                <hr>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group row mb-0">
                      <label class="col-sm-3 col-form-label text-right">ยี่ห้อรถ :</label>
                      <div class="col-sm-8">
                        <select name="BrandCar" class="form-control form-control-sm" disabled>
                          @foreach ($arrayBrand as $key => $value)
                            <option value="{{$key}}" {{ ($key == $datacar->Brand_Car) ? 'selected' : '' }}>{{$value}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row mb-0">
                      <label class="col-sm-4 col-form-label text-right">เลขทะเบียน :</label>
                      <div class="col-sm-8">
                        <input type="text" name="RegistCar" class="form-control form-control-sm" placeholder="ยังไม่มีการป้อน" value="{{$datacar->Number_Regist}}" readonly />
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-6">
                    <div class="form-group row mb-0">
                      <label class="col-sm-3 col-form-label text-right">ที่มาของรถ :</label>
                      <div class="col-sm-8">
                        <select name="OriginCar" class="form-control form-control-sm" disabled>
                          @foreach ($arrayOriginType as $key => $value)
                            <option disabled value="{{$key}}" {{ ($key == $datacar->Origin_Car) ? 'selected' : '' }}>{{$value}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row mb-0">
                      <label class="col-sm-4 col-form-label text-right">Sale :</label>
                      <div class="col-sm-8">
                        <input type="text" name="SaleCar" class="form-control form-control-sm" placeholder="ยังไม่มีการป้อน" value="{{$datacar->Name_Sale}}" readonly />
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-6">
                    <div class="form-group row mb-0">
                      <label class="col-sm-3 col-form-label text-right">ลักษณะรถ :</label>
                      <div class="col-sm-8">
                        <input type="text" name="ModelCar" class="form-control form-control-sm" placeholder="ยังไม่มีการป้อน" value="{{$datacar->Model_Car}}" readonly />
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row mb-0">
                      <label class="col-sm-4 col-form-label text-right">เลขไมล์ :</label>
                      <div class="col-sm-8">
                        <input type="text" name="MilesCar" class="form-control form-control-sm" placeholder="ยังไม่มีการป้อน"  value="{{number_format($datacar->Number_Miles)}}" readonly />
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-6">
                    <div class="form-group row mb-0">
                      <label class="col-sm-3 col-form-label text-right">รุ่นรถ :</label>
                      <div class="col-sm-8">
                        <input type="text" name="VersionCar" class="form-control form-control-sm" placeholder="ยังไม่มีการป้อน" value="{{$datacar->Version_Car}}" readonly />
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row mb-0">
                      <label class="col-sm-4 col-form-label text-right">เกียร์รถ/ปีที่ผลิต :</label>
                      <div class="col-sm-4">
                        <input type="text" name="Gearcar" class="form-control form-control-sm" placeholder="ยังไม่มีการป้อน" value="{{$datacar->Gearcar}}" readonly />
                      </div>
                      <div class="col-sm-4">
                        <input type="text" name="YearCar" class="form-control form-control-sm" placeholder="ยังไม่ป้อน" value="{{$datacar->Year_Product}}" readonly />
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-6">
                    <div class="form-group row mb-0">
                      <label class="col-sm-3 col-form-label text-right">ขนาด :</label>
                      <div class="col-sm-8">
                        <input type="text" name="SizeCar" class="form-control form-control-sm" placeholder="ยังไม่มีการป้อน" value="{{$datacar->Size_Car}}" readonly />
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row mb-0">
                      <label class="col-sm-4 col-form-label text-right">สีรถ :</label>
                      <div class="col-sm-8">
                        <input type="text" name="ColorCar" class="form-control form-control-sm" placeholder="ยังไม่มีการป้อน" value="{{$datacar->Color_Car}}" readonly />
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-6">
                    <div class="form-group row mb-0">
                      <label class="col-sm-3 col-form-label text-right">Job Number :</label>
                      <div class="col-sm-8">
                        <input type="text" name="JobCar" class="form-control form-control-sm" placeholder="ยังไม่มีการป้อน" value="{{$datacar->Job_Number}}" readonly />
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
                          <input type="checkbox" id="1" name="ContractsCar" value="complete" {{ ($datacar->Contracts_Car == "complete") ? 'checked' : '' }} disabled/>
                          <label for="1" class="todo">
                            <i class="fa fa-check"></i>
                            สัญญาซื้อขาย
                          </label>
                        </span>
                        <span class="todo-wrap">
                          <input type="checkbox" id="2" name="ManualCar" value="complete" {{ ($datacar->Manual_Car == "complete") ? 'checked' : '' }} disabled/>
                          <label for="2" class="todo">
                            <i class="fa fa-check"></i>
                            คู่มือ
                          </label>
                        </span>
                        <span class="todo-wrap">
                          <input type="checkbox" id="3" name="KeyReserve" value="complete" {{ ($datacar->Key_Reserve == "complete") ? 'checked' : '' }} disabled/>
                          <label for="3" class="todo">
                            <i class="fa fa-check"></i>
                            กุญแจ
                          </label>
                        </span>
                        <span class="todo-wrap">
                          <input type="checkbox" id="4" name="ExpireTax" value="complete" {{ ($datacar->Expire_Tax == "complete") ? 'checked' : '' }} disabled/>
                          <label for="4" class="todo">
                            <i class="fa fa-check"></i>
                            ป้ายภาษี
                          </label>
                        </span>
                        <span class="todo-wrap">
                          <input type="checkbox" id="5" name="ActCar" value="complete" {{ ($datacar->Act_Car == "complete") ? 'checked' : '' }} disabled/>
                          <label for="5" class="todo">
                            <i class="fa fa-check"></i>
                            พ.ร.บ.
                          </label>
                        </span>
                        <span class="todo-wrap">
                          <input type="checkbox" id="6" name="InsuranceCar" value="complete" {{ ($datacar->Insurance_Car == "complete") ? 'checked' : '' }} disabled/>
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
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-wallet"></i> ข้อมูลการขาย</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-4">
                    <div class="form-group row mb-0">
                      <label class="col-sm-4 col-form-label text-right">วันที่ขาย :</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" name="DateSoldoutplus"  value="{{ $Date_soldoutplus }}" readonly/>
                      </div>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group row mb-0">
                      <label class="col-sm-4 col-form-label text-right">วันที่เบิก :</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" name="DateWithdraw" value="{{ $Date_Withdraw }}" readonly  />
                      </div>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group row mb-0">
                      <label class="col-sm-4 col-form-label text-right">เงินดาวน์ :</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" name="DateSoldoutplus" value="{{number_format($datacar->Down_Price,2) }}" readonly/>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-4">
                    <div class="form-group row mb-0">
                      <label class="col-sm-4 col-form-label text-right">ราคาขาย</label>
                      <div class="col-sm-8">
                        @if ($datacar->Net_Priceplus == '')
                          <input type="text" name="NetPriceplus" class="form-control form-control-sm" placeholder="ป้อนราคาขาย" value="{{$datacar->Net_Priceplus}}" readonly />
                        @else
                          <input type="text" name="NetPriceplus" class="form-control form-control-sm" placeholder="ป้อนราคาขาย" value="{{ number_format($datacar->Net_Priceplus, 2) }}" readonly />
                        @endif
                      </div>
                    </div>
                  </div>

                  <div class="col-4">
                    <div class="form-group row mb-0">
                      <label class="col-sm-4 col-form-label text-right">จำนวนเงิน :</label>
                      <div class="col-sm-8">
                        @if ($datacar->Amount_Price == '')
                          <input type="text" name="AmountPrice" class="form-control form-control-sm" placeholder="ป้อนจำนวนเงิน" value="{{ $datacar->Amount_Price }}" readonly />
                        @else
                          <input type="text" name="AmountPrice" class="form-control form-control-sm" placeholder="ป้อนจำนวนเงิน" value="{{ number_format($datacar->Amount_Price, 2) }}" readonly />
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group row mb-0">
                      <label class="col-sm-4 col-form-label text-right">ซับดาวน์ :</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" name="DateSoldoutplus" value="{{ number_format($datacar->Subdown_Price,2) }}" readonly/>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-4">
                    <div class="form-group row mb-0">
                      <label class="col-sm-4 col-form-label text-right">ประเภทขาย :</label>
                      <div class="col-sm-8">
                        <select name="TypeSale" class="form-control form-control-sm" disabled>
                          @foreach ($arrayTypeSale as $key => $value)
                            <option value="{{$key}}" {{ ($key == $datacar->Type_Sale) ? 'selected' : '' }}>{{$value}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group row mb-0">
                      <label class="col-sm-4 col-form-label text-right">Sale ขาย :</label>
                      <div class="col-sm-8">
                        <input type="text" name="NameSaleplus" class="form-control form-control-sm" placeholder="ป้อนชื่อ Sale ขาย" value="{{ $datacar->Name_Saleplus != '' ?$datacar->Name_Saleplus: 'ไม่มีข้อมูล'}}" readonly />
                      </div>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group row mb-0">
                      <label class="col-sm-4 col-form-label text-right">ค่าใช้จ่ายโอน :</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" name="DateWithdraw" value="{{ number_format($datacar->Transfer_Price,2) }}" readonly  />
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-4">
                    <div class="form-group row mb-0">
                      <label class="col-sm-4 col-form-label text-right">ผู้ซื้อ :</label>
                      <div class="col-sm-8">
                        <input type="text" name="NameBuyer" class="form-control form-control-sm" placeholder="ป้อนชื่อผู้ซื้อ" value="{{ $datacar->Name_Buyer !='' ?$datacar->Name_Buyer: 'ไม่มีข้อมูล'}}" readonly  />
                      </div>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group row mb-0">
                      <label class="col-sm-4 col-form-label text-right">นายหน้า :</label>
                      <div class="col-sm-8">
                        <input type="text" name="NameAgent" class="form-control form-control-sm" placeholder="ป้อนชื่อนายหน้า" value="{{ $datacar->Name_Agent != '' ?$datacar->Name_Agent: 'ไม่มีข้อมูล'}}" readonly/>
                      </div>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group row mb-0">
                      <label class="col-sm-4 col-form-label text-right">ค่าประกัน :</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" name="DateWithdraw" value="{{ number_format($datacar->Insurance_Price,2) }}" readonly  />
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-4"></div>
                  <div class="col-4"></div>
                  <div class="col-4">
                    <div class="form-group row mb-0">
                      <label class="col-sm-4 col-form-label text-right">ยอดจัด :</label>
                      <div class="col-sm-8">
                        <input type="text" id="TopcarPrice" name="TopcarPrice" class="form-control form-control-sm" placeholder="ป้อนยอดจัด" value="{{ number_format($datacar->Topcar_Price,2) }}" readonly/>
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
                    <div class="form-group row mb-0">
                      <label class="col-sm-4 col-form-label text-right">วันที่ยืม :</label>
                      <div class="col-sm-8">
                        <input type="date" id="DateBorrowcar" name="DateBorrowcar" class="form-control form-control-sm" value="{{$datacar->Date_Borrowcar}}" readonly/>
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row mb-0">
                      <label class="col-sm-4 col-form-label text-right">ชื่อผู้ยืม :</label>
                      <div class="col-sm-8">
                        <input type="text" name="NameBorrow" class="form-control form-control-sm" placeholder="ป้อนชื่อผู้ยืม" value="{{$datacar->Name_Borrow}}" readonly />
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-6">
                    <div class="form-group row mb-0">
                      <label class="col-sm-4 col-form-label text-right">วันที่คืน :</label>
                      <div class="col-sm-8">
                        <input type="date" id="DateReturncar" name="DateReturncar" class="form-control form-control-sm" value="{{$datacar->Date_Returncar}}" readonly />
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row mb-0">
                      <label class="col-sm-4 col-form-label text-right">สถานะ :</label>
                      <div class="col-sm-8">
                        <select name="BorrowStatus" class="form-control form-control-sm" disabled>
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
                    <div class="form-group row mb-0">
                      <label class="col-sm-4 col-form-label text-right">หมายเหตุ :</label>
                      <div class="col-sm-8">
                        <textarea type="text" name="NoteBorrow" class="form-control form-control-sm" rows="2" readonly placeholder="ป้อนหมายเหตุ">{{ $datacar->Note_Borrow }}</textarea>
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row mb-0">
                      <label class="col-sm-4 col-form-label text-right">ระยะเวลายืม :</label>
                      <div class="col-sm-8">
                        @if($datacar->BorrowStatus != Null)
                          @if($ifdate > $datacar->Date_Borrowcar && $datacar->Date_Returncar == Null)
                            @php
                              $Cldate = date_create($datacar->Date_Borrowcar);
                              $nowCldate = date_create($ifdate);
                              $ClDateDiff = date_diff($Cldate,$nowCldate);
                              $duration = $ClDateDiff->format("%a วัน")
                            @endphp
                          @elseif($datacar->Date_Returncar != Null)
                            @php
                              $Cldate = date_create($datacar->Date_Borrowcar);
                              $nowCldate = date_create($datacar->Date_Returncar);
                              $ClDateDiff = date_diff($Cldate,$nowCldate);
                              $duration = $ClDateDiff->format("%a วัน")
                            @endphp
                          @endif
                          <input type="text" class="form-control form-control-sm" style="color:red;" value="{{ $duration }}" readonly />
                        @else
                          <input type="text" class="form-control form-control-sm" readonly />
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card card-danger">
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
                    <div class="form-group row mb-0">
                      <label class="col-sm-4 col-form-label text-right">วันที่หมดอายุ ปชช :</label>
                      <div class="col-sm-8">
                        @if($datacar->Date_NumberUser == Null)
                          <input type="text" class="form-control form-control-sm" name="DateNumberUser" value="ป้อนวันที่หมดอายุ ปชช" readonly>
                        @else
                          <input type="text" class="form-control form-control-sm" name="DateNumberUser" value="{{date_format($Date_NumberUser, 'd-m-Y')}}" readonly>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row mb-0">
                      <label class="col-sm-4 col-form-label text-right">วันที่หมดอายุภาษี :</label>
                      <div class="col-sm-8">
                        @if($datacar->Date_Expire == Null)
                          <input type="text" class="form-control form-control-sm" name="DateNumberUser" value="ป้อนวันที่หมดอายุ ภาษี" readonly>
                        @else
                          <input type="text" class="form-control form-control-sm" name="DateExpire" value="{{date_format($Date_Expire, 'd-m-Y')}}" readonly>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group row mb-0">
                      <label class="col-sm-4 col-form-label text-right">หมายเหตุ :</label>
                      <div class="col-sm-8">
                        <textarea type="text" name="CheckNote" class="form-control form-control-sm" rows="3" readonly>{{ $datacar->Check_Note }}</textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <input type="hidden" name="_method" value="PATCH"/>
      </div>

        <!-- /.box-body -->
      <div class="box-footer"></div>
    </div>
  </section>
