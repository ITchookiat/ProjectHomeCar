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
              <div class="col-md-12">
                  <div class="info-box bg-orange">
                    <span class="info-box-icon bg-warning"><i class="fas fa-user-check"></i></span>
                    <div class="info-box-content">
                      <h5>เซลล์  {{ $Sale }}</h5>
                      @php
                        $Setfdate = date_create($fdate);
                        $Settdate = date_create($tdate);
                      @endphp
                      <span class="info-box-number">ประจำวันที่ {{ date_format($Setfdate, 'd-m-Y') }} &nbsp;&nbsp; ถึงวันที่ {{ date_format($Settdate, 'd-m-Y') }}</span>
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
            </div>
          </div>

          <a id="button"></a>
        </div>
      </div>
    </section>

  <form target="_blank" action="{{ route('report.holdcar') }}" method="post">
    @csrf
    <div class="modal fade" id="modal-report" aria-hidden="true" style="display: none;">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            @if($type == 3)
            <h4 class="modal-title">รายงาน สต๊อกบัญชี</h4>
            @elseif($type == 4)
            <h4 class="modal-title">รายงาน วันหมดอายุบัตร</h4>
            @elseif($type == 5)
            <h4 class="modal-title">รายงาน รถยึด / CKL</h4>
            @elseif($type == 6)
            <h4 class="modal-title">รายงาน ยอดต้นทุนรถต่อคัน</h4>
            @endif
            <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <div class="form-group row mb-1">
                  <label class="col-sm-4 col-form-label text-right">จากวันที่ : </label>
                  <div class="col-sm-7">
                  <input type="date" id="Fromdate" name="Fromdate" value="{{ ($fdate != '') ?$fdate: '' }}" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group row mb-1">
                <label class="col-sm-4 col-form-label text-right">ถึงวันที่ : </label>
                  <div class="col-sm-7">
                    <input type="date" id="Todate" name="Todate" value="{{ ($tdate != '') ?$tdate: '' }}" class="form-control" />
                  </div>
                </div>
              </div>
            </div>
              <br>
              <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-11">
                  <!-- checkbox -->
                  <div class="form-group clearfix">
                    <div class="icheck-primary d-inline">
                      <input type="checkbox" name="originType[]" id="checkboxPrimary1" value="1">
                      <label for="checkboxPrimary1">
                        รถ CKL
                      </label>
                    </div>
                    &nbsp;
                    <div class="icheck-primary d-inline">
                      <input type="checkbox" name="originType[]" id="checkboxPrimary2" value="2">
                      <label for="checkboxPrimary2">
                        รถประมูล
                      </label>
                    </div>
                    &nbsp;
                    @if($type == 4 or $type == 6)
                      <div class="icheck-primary d-inline">
                        <input type="checkbox" name="originType[]" id="checkboxPrimary3" value="3">
                        <label for="checkboxPrimary3">
                          รถยึด
                        </label>
                      </div>
                      &nbsp;
                      <div class="icheck-primary d-inline">
                        <input type="checkbox" name="originType[]" id="checkboxPrimary4" value="4">
                        <label for="checkboxPrimary4">
                          รถฝากขาย
                        </label>
                      </div>
                    @else
                      <div class="icheck-primary d-inline">
                        <input type="checkbox" name="originType[]" id="checkboxPrimary3" value="3" disabled>
                        <label for="checkboxPrimary3" style="color:#CCC">
                          รถยึด
                        </label>
                      </div>
                      &nbsp;
                      <div class="icheck-primary d-inline">
                        <input type="checkbox" name="originType[]" id="checkboxPrimary4" value="4" disabled>
                        <label for="checkboxPrimary4" style="color:#CCC">
                          รถฝากขาย
                        </label>
                      </div>
                    @endif
                  </div>
                </div>
              </div>
          <hr>
          </div>
          <input type="hidden" name="id" value="{{$type}}">
          <div class="text-center">
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            <button type="submit" class="btn btn-primary">ปริ้นรายงาน</button>
          </div>
          <br>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
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
  
  <script>
    $(function () {
      $('#table1').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
      });
    });
  </script>

  <script type="text/javascript">
    $(document).ready(function(){
      $('.delete_form').on('submit',function(){
        if (confirm("คุณต้องการลบข้อมูลหรือไม่")) {
          return true;
        }
        else {
          return false;
        }
        });
      });
  </script>

  <script>
      $(".alert").fadeTo(3000, 500).slideUp(500, function(){
      $(".alert").alert('close');
      });;
  </script>

  <script>
    function blinker() {
      $('.prem').fadeOut(1000);
      $('.prem').fadeIn(1000);
    }
    setInterval(blinker, 1000);
  </script>

<script type="text/javascript">
    $("#close").click(function () {
      $("#modal-report").modal('hide');
      var Datepay = ''
      $('#Fromdate').val(Datepay);
      $('#Todate').val(Datepay);
    });
</script>

@endsection
