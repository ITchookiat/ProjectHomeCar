@extends('layouts.master')
@section('title','ข้อมูลรถยนต์มือ 2')
@section('content')

@php
  date_default_timezone_set('Asia/Bangkok');
  $Y = date('Y') + 543;
  $m = date('m');
  $d = date('d');
  $date1 = date('Y-m-d');
  $time = date('H:i');
  $date = $Y.'-'.$m.'-'.$d;
@endphp

    <!-- Main content -->
    <section class="content">
      <div class="content-header">
        @if(session()->has('success'))
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <strong>สำเร็จ!</strong> {{ session()->get('success') }}
          </div>
        @endif

        @if($type == 1)
        <div class="card">
          <div class="card-header">
            <h4 class=""><b>รายการค่าคอมฯ (Commision Sale)</b></h4>
          </div>

          <div class="card-body text-sm">
            <div class="row">
              <div class="col-md-12">
                <form method="get" action="#">
                  <div class="float-right form-inline">
                    <button type="submit" class="btn bg-warning btn-app">
                      <span class="fas fa-search"></span> Search
                    </button>
                  </div>
                  <div class="float-right form-inline"> 
                    <label>จากวันที่ : </label>
                    <input type="date" name="Fromdate" value="{{ ($fdate != '') ?$fdate: date('Y-m-d') }}" class="form-control" />
                    <label>ถึงวันที่ : </label>
                    <input type="date" name="Todate" value="{{ ($tdate != '') ?$tdate: date('Y-m-d') }}" class="form-control" />
                    <label>Sale : </label>
                    <select name="Sale" class="form-control">
                      <option selected value="">---เลือกเซลล์---</option>
                      <option value="แบมะ" {{ ($Sale == 'แบมะ') ? 'selected' : '' }}>แบมะ</option>
                      <option value="ลี" {{ ($Sale == 'ลี') ? 'selected' : '' }}>ลี</option>
                      <option value="วัน" {{ ($Sale == 'วัน') ? 'selected' : '' }}>วัน</option>
                      <option value="วรรณ" {{ ($Sale == 'วรรณ') ? 'selected' : '' }}>วรรณ</option>
                      <!-- <option value="เตี๊ยก" {{ ($Sale == 'เตี๊ยก') ? 'selected' : '' }}>เตี๊ยก</option>
                      <option value="สา" {{ ($Sale == 'สา') ? 'selected' : '' }}>สา</option>
                      <option value="กวาง" {{ ($Sale == 'กวาง') ? 'selected' : '' }}>กวาง</option> -->
                    </select>
                  </div>
                </form>
                <br>
                <br>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="info-box bg-orange">
                  <span class="info-box-icon bg-warning"><i class="fas fa-user-check"></i></span>
                  <div class="info-box-content">
                    <h5>เซลล์  {{ $Sale }}</h5>
                    @php
                      $Setfdate = date_create($fdate);
                      $Settdate = date_create($tdate);
                    @endphp
                    <span class="info-box-number">วันที่ {{ date_format($Setfdate, 'd-m-Y') }} &nbsp; ถึงวันที่ {{ date_format($Settdate, 'd-m-Y') }}</span>
                  </div>
                  <div class="info-box-content">
                    <h5>รวมยอด / ค่าเป้า :</h5>
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group row mb-0">
                        <div class="col-sm-6">
                          <input type="text" name="SumCom" style="text-align:right;" class="form-control" value="{{ number_format($SumCom,2) }}"/>
                        </div>
                        <div class="col-sm-6">
                          <input type="text" name="SumCom" style="text-align:right;" class="form-control" value="{{ number_format($SumBlow,2) }}"/>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-striped table-valign-middle" id="table1">
                    @if($type == 1)
                      <thead>
                        <tr>
                          <th class="text-center">วันที่ขาย</th>
                          <th class="text-left">เลขทะเบียน</th>
                          <th class="text-right">ราคาขาย</th>
                          <th class="text-right">ค่าคอม</th>
                          <th class="text-center">ที่มา</th>
                          <th class="text-center">Sale</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($data as $row)
                          <tr>
                            <td class="text-center">
                              @php
                                $Date_Soldout_plus = date_create($row->Date_Soldout_plus);
                              @endphp
                              {{ date_format($Date_Soldout_plus, 'd-m-Y')}}
                            </td>
                            <td class="text-left">{{$row->Number_Regist}}</td>
                            <td class="text-right">{{number_format($row->Net_Priceplus, 2) }}</td>
                            <td class="text-right">3,000.00</td>
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
                            <td class="text-center">{{$row->Name_Saleplus}}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    @endif
                  </table>
                </div>
              </div>
              <div class="col-md-6">
                {{-- <div class="card card-warning">
                  <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-book-reader"></i> Goal Completion</h3>
                  </div>
                  <div class="card-body">
                    <div class="progress-group">
                      No.1 แบมะ (Manager)
                      <span class="float-right"><b>160</b>/200</span>
                      <div class="progress">
                        <div class="progress-bar progress-bar-striped bg-primary" style="width: 80%"></div>
                      </div>
                    </div>
    
                    <div class="progress-group">
                      No.2 ลี (Sale)
                      <span class="float-right"><b>310</b>/400</span>
                      <div class="progress">
                        <div class="progress-bar progress-bar-striped bg-danger" style="width: 75%"></div>
                      </div>
                    </div>
    
                    <div class="progress-group">
                      No.3 มัรวัน (Sale)
                      <span class="float-right"><b>480</b>/800</span>
                      <div class="progress">
                        <div class="progress-bar progress-bar-striped bg-success" style="width: 60%"></div>
                      </div>
                    </div>

                    <div class="progress-group">
                      No.4 วรรณ (Sale)
                      <span class="float-right"><b>250</b>/500</span>
                      <div class="progress">
                        <div class="progress-bar progress-bar-striped bg-warning" style="width: 50%"></div>
                      </div>
                    </div>

                  </div>
                </div> --}}
                <div class="card card-warning">
                  <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-book-reader"></i> Goal Completion ({{$Num1 + $Num2 + $Num3 + $Num4}})</h3>
                  </div>
                  <div class="card-body">
                    <canvas id="horizontalBar"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <a id="button"></a>
        </div>
        @elseif($type == 2)
        <div class="card">
          <div class="card-header">
            <h4 class=""><b>รายการรถขาย (Cars Sale)</b></h4>
          </div>

          <div class="card-body text-sm">
            <div class="row">
              <div class="col-md-12">
                <form method="get" action="#">
                  <div class="float-right form-inline">
                    <button type="submit" class="btn bg-warning btn-app">
                      <span class="fas fa-search"></span> Search
                    </button>
                  </div>
                  <div class="float-right form-inline"> 
                    <label>จากวันที่ : </label>
                    <input type="date" name="Fromdate" value="{{ ($fdate != '') ?$fdate: date('Y-m-01') }}" class="form-control" />
                    <label>ถึงวันที่ : </label>
                    <input type="date" name="Todate" value="{{ ($tdate != '') ?$tdate: date('Y-m-d') }}" class="form-control" />
                    <label>ยี่ห้อ : </label>
                    <select name="BrandCar" class="form-control form-control-sm">
                      <option value="" selected>--- เลือกยี่ห้อรถ ---</option>
                      <option value="TOYOTA" {{ ($BrandCar == 'TOYOTA') ? 'selected' : '' }}>TOYOTA</option>
                      <option value="MAZDA" {{ ($BrandCar == 'MAZDA') ? 'selected' : '' }}>MAZDA</option>
                      <option value="NISSAN" {{ ($BrandCar == 'NISSAN') ? 'selected' : '' }}>NISSAN</option>
                      <option value="FORD" {{ ($BrandCar == 'FORD') ? 'selected' : '' }}>FORD</option>
                      <option value="MITSUBISHI" {{ ($BrandCar == 'MITSUBISHI') ? 'selected' : '' }}>MITSUBISHI</option>
                      <option value="ISUZU" {{ ($BrandCar == 'ISUZU') ? 'selected' : '' }}>ISUZU</option>
                      <option value="HONDA" {{ ($BrandCar == 'HONDA') ? 'selected' : '' }}>HONDA</option>
                      <option value="CHEVROLET" {{ ($BrandCar == 'CHEVROLET') ? 'selected' : '' }}>CHEVROLET</option>
                      <option value="SUZUKI" {{ ($BrandCar == 'SUZUKI') ? 'selected' : '' }}>SUZUKI</option>
                      <option value="MG" {{ ($BrandCar == 'MG') ? 'selected' : '' }}>MG</option>
                    </select>
                  </div>
                </form>
                <br>
                <br>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="info-box bg-orange">
                  <span class="info-box-icon bg-warning"><i class="fas fa-car"></i></span>
                  <div class="info-box-content">
                    <h5>รายการรถที่ขายแล้ว</h5>
                    @php
                      $Setfdate = date_create($fdate);
                      $Settdate = date_create($tdate);
                    @endphp
                    <span class="info-box-number">วันที่ {{ date_format($Setfdate, 'd-m-Y') }} &nbsp; ถึงวันที่ {{ date_format($Settdate, 'd-m-Y') }}</span>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-striped table-valign-middle" id="table1">
                    @if($type == 2)
                      <thead>
                        <tr>
                          <th class="text-center">วันที่ขาย</th>
                          <th class="text-center">เลขทะเบียน</th>
                          <th class="text-center">ยี่ห้อ</th>
                          <th class="text-center">รุ่น</th>
                          <th class="text-center">ปี</th>
                          <th class="text-center">ที่มา</th>
                          <!-- <th class="text-center">Sale</th> -->
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($data as $row)
                          <tr>
                            <td class="text-center">
                              @php
                                $Date_Soldout_plus = date_create($row->Date_Soldout_plus);
                              @endphp
                              {{ date_format($Date_Soldout_plus, 'd-m-Y')}}
                            </td>
                            <td class="text-left">{{$row->Number_Regist}}</td>
                            <td class="text-left">{{$row->Brand_Car}}</td>
                            <td class="text-left">{{$row->Version_Car}}</td>
                            <td class="text-left">{{$row->Year_Product}}</td>
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
                            <!-- <td class="text-center">{{$row->Name_Saleplus}}</td> -->
                          </tr>
                        @endforeach
                      </tbody>
                    @endif
                  </table>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card card-warning">
                  <!-- <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-chart-bar"></i> Top Brand sale ({{$countData}})</h3>
                  </div> -->
                  <div class="info-box bg-orange">
                    <span class="info-box-icon bg-warning"><i class="fas fa-chart-bar"></i></span>
                    <div class="info-box-content">
                      <h5>{{ ($BrandCar != '') ?$BrandCar: 'Top Brand Sale' }}</h5>
                      <span class="info-box-number">ยอดขายรวม {{$countData}} คัน</span>
                    </div>
                  </div>
                  <div class="card-body">
                  @if($dataVersion != '')
                    @foreach($dataVersion as $value)
                     @php 
                      $percent = $value->Version_count * 10;
                      $color = $value->Version_count * 888;
                     @endphp
                      {{$value->Version_Car}} ( {{$value->Version_count}} คัน )
                      <div class="progress-group mb-3">
                        <div class="progress">
                          <div class="progress-bar" style="width: {{$percent}}%;background-color:#{{$color}}"></div>
                        </div>
                      </div>
                    @endforeach
                  @else 
                    <canvas id="horizontalBar"></canvas>
                  @endif
                  </div>
                </div>
              </div>
            </div>
          </div>

          <a id="button"></a>
        </div>
        @endif
      </div>
    </section>
  
  @if($type == 1)
    <script>
      new Chart(document.getElementById("horizontalBar"), {
          "type": "horizontalBar",
          "data": {
            "labels": ["แบมะ", "ลี", "มัรวัน", "วรรณ"],
            "datasets": [{
            "label": "ยอดขาย",
            "data": [{{$Num1}}, {{$Num2}}, {{$Num3}}, {{$Num4}}],
            "fill": false,
            "backgroundColor": [
              "rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)",
              "rgb(75, 192, 192)", "rgb(54, 162, 235)",
            ],
            "borderColor": [
              "rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)",
              "rgb(75, 192, 192)", "rgb(54, 162, 235)",
            ],
            "borderWidth": 1
            }]
          },
          "options": {
            "scales": {
            "xAxes": [{
              "ticks": {
                "beginAtZero": true
              }
            }]
            }
          }
      });
    </script>
  @endif
  @if($type == 2)
  {{--<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
      google.charts.load("current", {packages:['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ["ยี่ห้อ", "คัน", { role: "style" } ],
            ['TOYOTA',{{$Brand1}},"#922B21"],
            ['MAZDA',{{$Brand2}}, "#76448A"],
            ['NISSAN',{{$Brand3}}, "#2471A3"],
            ['FORD', {{$Brand4}}, "#17A589"],
            ['MITSUBISHI',{{$Brand5}}, "#F1C40F"],
            ['ISUZU',{{$Brand6}}, "#b87388"],
            ['HONDA',{{$Brand7}}, "#EB984E"],
            ['CHEVROLET',{{$Brand8}}, "#707B7C"],
            ['SUZUKI',{{$Brand9}}, "#196F3D"],
            ['MG',{{$Brand10}}, "#F2D7D5"],
          ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
                        { calc: "stringify",
                          sourceColumn: 1,
                          type: "string",
                          role: "annotation" },
                        2]);

        var options = {
          // title: "Density of Precious Metals, in g/cm^3",
          bar: {groupWidth: "90%"},
          legend: { position: "none" },
          is3D : true,
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("piechart_3d_Brand"));
        chart.draw(view, options);
    }
  </script>--}}
    <script>
      new Chart(document.getElementById("horizontalBar"), {
          "type": "horizontalBar",
          "data": {
            "labels": ["TOYOTA", "MAZDA", "NISSAN", "FORD","MITSUBISHI","ISUZU","HONDA","CHEVROLET","SUZUKI","MG"],
            "datasets": [{
            "label": "ยอดขาย",
            "data": [{{$Brand1}}, {{$Brand2}}, {{$Brand3}}, {{$Brand4}}, {{$Brand5}}, {{$Brand6}}, {{$Brand7}}, {{$Brand8}}, {{$Brand9}}, {{$Brand10}}],
            "fill": false,
            "backgroundColor": [
              "rgb(255, 99, 132)", "rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)", "rgb(75, 192, 192)", "rgb(54, 162, 235)",
              "rgb(135, 54, 0)", "rgb(125, 60, 152)", "rgb(230, 126, 346)", "rgb(93, 173, 226)", "rgb(75, 182, 180)"
            ],
            "borderColor": [
              "rgb(255, 99, 132)", "rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)", "rgb(75, 192, 192)", "rgb(54, 162, 235)",
              "rgb(135, 54, 0)", "rgb(125, 60, 152)", "rgb(230, 126, 34)","rgb(93, 173, 226)", "rgb(75, 182, 180)"
            ],
            "borderWidth": 1
            }]
          },
          "options": {
            "scales": {
            "xAxes": [{
              "ticks": {
                "beginAtZero": true
              }
            }]
            }
          }
      });
    </script>
  @endif

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
        "pageLength": 5,
      });
    });
  </script>

@endsection
