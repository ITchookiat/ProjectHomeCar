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
                      <option value="เตี๊ยก" {{ ($Sale == 'เตี๊ยก') ? 'selected' : '' }}>เตี๊ยก</option>
                      <option value="สา" {{ ($Sale == 'สา') ? 'selected' : '' }}>สา</option>
                      <option value="กวาง" {{ ($Sale == 'กวาง') ? 'selected' : '' }}>กวาง</option>
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
                    <h5>รวม :</h5>
                    <input type="text" name="SumCom" style="text-align:right;" class="form-control" value="{{ number_format($SumCom,2) }}"/>
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
                      No.4 เตี๊ยก (Sale)
                      <span class="float-right"><b>250</b>/500</span>
                      <div class="progress">
                        <div class="progress-bar progress-bar-striped bg-warning" style="width: 50%"></div>
                      </div>
                    </div>

                    <div class="progress-group">
                      No.5 สา (Sale)
                      <span class="float-right"><b>250</b>/500</span>
                      <div class="progress">
                        <div class="progress-bar progress-bar-striped bg-pink" style="width: 50%"></div>
                      </div>
                    </div>

                    <div class="progress-group">
                      No.6 กวาง (Sale)
                      <span class="float-right"><b>250</b>/500</span>
                      <div class="progress">
                        <div class="progress-bar progress-bar-striped bg-orage" style="width: 50%"></div>
                      </div>
                    </div>

                  </div>
                </div> --}}
                <div class="card card-warning">
                  <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-book-reader"></i> Goal Completion</h3>
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
      </div>
    </section>
  
  <script>
    new Chart(document.getElementById("horizontalBar"), {
        "type": "horizontalBar",
        "data": {
          "labels": ["แบมะ", "ลี", "มัรวัน", "เตี๊ยก", "สา", "กวาง"],
          "datasets": [{
          "label": "รวมยอดขาย",
          "data": [{{$Num1}}, {{$Num2}}, {{$Num3}}, {{$Num4}}, {{$Num5}}, {{$Num6}}],
          "fill": false,
          "backgroundColor": [
            "rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)",
            "rgb(75, 192, 192)", "rgb(54, 162, 235)", "rgb(153, 102, 255)", "rgb(201, 203, 207)"
          ],
          "borderColor": [
            "rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)",
            "rgb(75, 192, 192)", "rgb(54, 162, 235)", "rgb(153, 102, 255)", "rgb(201, 203, 207)"
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
