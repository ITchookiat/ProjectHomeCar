@extends('layouts.master')
@section('title','Resrearch Cus')
@section('content')
    
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>

    <!-- Main content -->
    <section class="content">
        <div class="content-header">
        @if(session()->has('success'))
            <script type="text/javascript">
                toastr.success('{{ session()->get('success') }}')
            </script>
        @endif

            <!-- Main content -->
            <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="" style="text-align:center;"><b>Research Customer</b></h1>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body text-sm">
                            <div style="text-align:right;">
                                <a class="btn bg-success btn-app" data-toggle="modal" data-target="#modal-1" data-backdrop="static" data-link="{{ route('ResearchCus', 2) }}">
                                <i class="fas fa-plus"></i> เพิ่มข้อมูล
                                </a>
                            </div>
                            <div class="row">
                                <div class="col-lg-7 col-6">
                                    <div class="card card-danger">
                                        <div class="card-header">
                                        <h3 class="card-title">รายชื่อลูกค้า</h3>
                        
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                                <i class="fas fa-expand"></i>
                                            </button>
                                        </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-valign-middle" id="table1">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-left">No.</th>
                                                            <th class="text-center">วันที่</th>
                                                            <th class="text-center">ชื่อ-สกุล</th>
                                                            <th class="text-left">สถานะ</th>
                                                            <th class="text-center" style="width: 70px"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($data as $key => $row)
                                                        <tr>
                                                            <td class="text-left">{{$key+1}}</td>
                                                            <td class="text-center">{{ date('d-m-Y', strtotime($row->DateSale_Cus)) }}</td>
                                                            <td class="text-center">{{ $row->Name_Cus }}</td>
                                                            <td class="text-left">{{ $row->Status_Cus }}</td>
                                                            <td class="text-right">
                                                                <a href="{{ action('ResearchCusController@edit',[$row->DataCus_id, 1]) }}" class="btn btn-warning btn-sm" title="แก้ไขรายการ">
                                                                    <i class="far fa-edit"></i>
                                                                </a>
                                                                <form method="post" class="delete_form" action="#" style="display:inline;">
                                                                    {{csrf_field()}}
                                                                    <input type="hidden" name="_method" value="DELETE" />
                                                                    <button type="submit" class="delete-modal btn btn-danger btn-sm" title="ลบรายการ">
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
                                <div class="col-lg-5 col-6">
                                    <div class="card">
                                        <div class="card-header ui-sortable-handle" style="cursor: move;">
                                        <h3 class="card-title">
                                            <i class="fas fa-chart-pie mr-1"></i>
                                            Sales
                                        </h3>
                                        <div class="card-tools">
                                            <ul class="nav nav-pills ml-auto">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#revenue-chart" data-toggle="tab">Area</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link active" href="#sales-chart" data-toggle="tab">Donut</a>
                                                </li>
                                                <li class="nav-item">
                                                    <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                                        <i class="fas fa-expand"></i>
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                        </div><!-- /.card-header -->
                                        <div class="card-body">
                                            <div class="tab-content p-0">
                                                <div class="chart tab-pane" id="revenue-chart" style="position: relative; height: 300px;">
                                                    <div class="chartjs-size-monitor">
                                                        <div class="chartjs-size-monitor-expand">
                                                            <div class=""></div>
                                                        </div>
                                                        <div class="chartjs-size-monitor-shrink">
                                                            <div class=""></div>
                                                        </div>
                                                    </div>
                                                    <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 747px;" width="1494" height="500" class="chartjs-render-monitor"></canvas>
                                                </div>

                                                <div class="chart tab-pane active" id="sales-chart" style="position: relative; height: 300px;">
                                                    <div class="chartjs-size-monitor">
                                                        <div class="chartjs-size-monitor-expand">
                                                            <div class=""></div>
                                                        </div>
                                                        <div class="chartjs-size-monitor-shrink">
                                                            <div class=""></div>
                                                        </div>
                                                    </div>
                                                    <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 659px;" width="1318" height="500" class="chartjs-render-monitor"></canvas>
                                                </div>
                                                
                                            </div>
                                        </div><!-- /.card-body -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a id="button"></a>
                    </div>
                </div>
            </div>
        </section>
        </div>
    </section>

    <!-- Pop up รายละเอียดค่าใช้จ่าย -->
    <div class="modal fade" id="modal-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <p>One fine body…</p>
                </div>
                <div class="modal-footer justify-content-between">
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            //-------------
            //- DONUT CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
            var donutData        = {
                labels: [
                    'Chrome', 
                    'IE',
                    'FireFox', 
                    'Safari', 
                    'Opera', 
                    'Navigator', 
                ],
                datasets: [
                {
                    data: [700,500,400,600,300,100],
                    backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                }
                ]
            }
            var donutOptions     = {
                maintainAspectRatio : false,
                responsive : true,
            }
            var donutChart = new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions      
            })


            //-------------
            //- BAR CHART -
            //-------------
            var areaChartData = {
                labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [
                    {
                        label               : 'Digital Goods',
                        backgroundColor     : 'rgba(60,141,188,0.9)',
                        borderColor         : 'rgba(60,141,188,0.8)',
                        pointRadius          : false,
                        pointColor          : '#3b8bba',
                        pointStrokeColor    : 'rgba(60,141,188,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data                : [28, 48, 40, 19, 86, 27, 90]
                    },
                    {
                        label               : 'Electronics',
                        backgroundColor     : 'rgba(210, 214, 222, 1)',
                        borderColor         : 'rgba(210, 214, 222, 1)',
                        pointRadius         : false,
                        pointColor          : 'rgba(210, 214, 222, 1)',
                        pointStrokeColor    : '#c1c7d1',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data                : [65, 59, 80, 81, 56, 55, 40]
                    },
                    {
                        label               : 'tro',
                        backgroundColor     : 'rgba(210, 214, 222, 1)',
                        borderColor         : 'rgba(210, 214, 222, 1)',
                        pointRadius         : false,
                        pointColor          : 'rgba(210, 214, 222, 1)',
                        pointStrokeColor    : '#c1c7d1',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data                : [10, 20, 30, 40, 50, 60, 70]
                    },
                    ]
            }
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = jQuery.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            var temp1 = areaChartData.datasets[1]
            barChartData.datasets[0] = temp1
            barChartData.datasets[1] = temp0

            var barChartOptions = {
            responsive              : true,
            maintainAspectRatio     : false,
            datasetFill             : false
            }

            var barChart = new Chart(barChartCanvas, {
            type: 'bar', 
            data: barChartData,
            options: barChartOptions
            })
        })
    </script>

    <script>
        $(function () {
        $("#table1").DataTable({
            "responsive": true,
            "autoWidth": false,
            "ordering": false,
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "order": [[ 1, "asc" ]],
        });
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
      

@endsection
