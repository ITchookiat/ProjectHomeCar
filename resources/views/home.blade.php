@extends('layouts.master')
@section('title','Home')
@section('content')

    <div class="content-header">
        <div class="row justify-content-center">
            <div class="col-md-12 table-responsive">
                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div align="center">
                            <img class="img-responsive" src="{{ asset('dist/img/homecar.png') }}" alt="User Image" style = "width: 40%">
                        </div>

                        <div class="row">
                            <div class="col-lg-1 col-md-6"></div>
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{$data1-$data6}}</h3>
                                    <p>รถยนต์ทั้งหมด</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-car fa-5x"></i>
                                </div>
                                    <a href="{{ route('datacar', 1) }}" class="small-box-footer">ดูเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <div class="small-box bg-purple">
                                <div class="inner">
                                    <h3>{{$data2}}</h3>
                                    <p>รถยนต์ระหว่างทำสี</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-paint-brush fa-5x"></i>
                                </div>
                                    <a href="{{ route('datacar', 2) }}" class="small-box-footer">ดูเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-navy">
                                <div class="inner">
                                    <h3>{{$data3}}</h3>
                                    <p>รถยนต์รอซ่อม</p>
                                </div>
                                <div class="icon">
                                <i class="fas fa-car-crash"></i>
                                    <!-- <i class="fa fa-exclamation-circle fa-5x"></i> -->
                                </div>
                                    <a href="{{ route('datacar', 3) }}" class="small-box-footer">ดูเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-6"></div>
                        </div>


                        <div class="row">
                            <div class="col-lg-4 col-6">
                                <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3><font color="white">{{$data4}}</font></h3>
                                    <p><font color="white">รถยนต์ระหว่างซ่อม</font></p<font>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-wrench fa-5x"></i>
                                </div>
                                    <a href="{{ route('datacar', 4) }}" class="small-box-footer"><font color="white">ดูเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></font></a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>{{$data5}}</h3>
                                    <p>รถยนต์พร้อมขาย</p>
                                </div>
                                <div class="icon">
                                    <i class="fab fa-bitcoin"></i>
                                </div>
                                    <a href="{{ route('datacar', 5) }}" class="small-box-footer">ดูเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-6">
                                <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>{{$data6}}</h3>
                                    <p>รถยนต์พร้อมขาย</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-cart-arrow-down"></i>
                                </div>
                                    <a href="{{ route('datacar', 6) }}" class="small-box-footer">ดูเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
