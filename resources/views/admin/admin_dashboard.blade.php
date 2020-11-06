@extends('admin.layouts.admin_master')

@section('content')

<!-- MAIN CONTENT-->

<div class="row m-t-25">
    <div class="col-sm-6 col-lg-3">
        <div class="overview-item overview-item--c1">
            <div class="overview__inner">
                <div class="overview-box clearfix">
                    <div class="icon">
                        <i class="zmdi zmdi-calendar-note"></i>
                    </div>
                    <br>
                    <div class="text">
                        <h2>{{ $theleaveform }}</h2>
                        <span>Total forms</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="overview-item overview-item--c2">
            <div class="overview__inner">
                <div class="overview-box clearfix">
                    <div class="icon">
                        <i class="zmdi zmdi-calendar-note"></i>
                    </div>
                    <br>
                    <div class="text">
                        <h2>{{ $theleaveform2 }}</h2>
                        <span>Approved Forms</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="overview-item overview-item--c3">
            <div class="overview__inner">
                <div class="overview-box clearfix">
                    <div class="icon">
                        <i class="zmdi zmdi-calendar-note"></i>
                    </div>
                    <br>
                    <div class="text">
                        <h2>{{ $theleaveform3 }}</h2>
                        <span>Pending Forms</span>
                    </div>
                </div>       
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="overview-item overview-item--c4">
            <div class="overview__inner">
                <div class="overview-box clearfix">
                    <div class="icon">
                        <i class="zmdi zmdi-account-o"></i>
                    </div>
                    <br>
                    <div class="text">
                    <h2>{{ $theleaveform4 }}</h2>
                        <span>Users</span>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-lg-6">
        <div class="au-card recent-report">
            <div class="au-card-inner">
                <h3 class="title-2">Reports</h3>
                <div class="chart-info">
                    <div class="chart-info__left">
                        <div class="chart-note">
                            <span class="dot dot--blue"></span>
                            <span>Applied</span>
                        </div>
                        <div class="chart-note mr-0">
                            <span class="dot dot--green"></span>
                            <span>Apprpved</span>
                        </div>
                    </div>
                    <div class="chart-info__right">
                        <div class="chart-statis">
                            <span class="index incre">
                                <i class="zmdi zmdi-long-arrow-up"></i>25%</span>
                            <span class="label">Applied</span>
                        </div>
                        <div class="chart-statis mr-0">
                            <span class="index decre">
                                <i class="zmdi zmdi-long-arrow-down"></i>10%</span>
                            <span class="label">Approved</span>
                        </div>
                    </div>
                </div>
                <div class="recent-report__chart">
                    <canvas id="recent-rep-chart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="au-card chart-percent-card">
            <div class="au-card-inner">
                <h3 class="title-2 tm-b-5">char by %</h3>
                <div class="row no-gutters">
                    <div class="col-xl-6">
                        <div class="chart-note-wrap">
                            <div class="chart-note mr-0 d-block">
                                <span class="dot dot--blue"></span>
                                <span>Rejected</span>
                            </div>
                            <div class="chart-note mr-0 d-block">
                                <span class="dot dot--red"></span>
                                <span>Approved</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="percent-chart">
                            <canvas id="percent-chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="copyright">
            <p>Copyright © 2020 BUA. All rights reserved.
            </p>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->

@endsection