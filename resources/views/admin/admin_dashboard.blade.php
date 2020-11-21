@extends('admin.layouts.admin_master')

@section('content')

<!-- MAIN CONTENT-->

<!-- BREADCRUMB-->
<section class="au-breadcrumb2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="au-breadcrumb-content">
                    <div class="au-breadcrumb-left">
                        <span class="au-breadcrumb-span">ADMIN:</span>
                        <ul class="list-unstyled list-inline au-breadcrumb__list">
                            <li class="list-inline-item active">
                                <a href="#">Home</a>
                            </li>
                            <li class="list-inline-item seprate">
                                <span>/</span>
                            </li>
                            <li class="list-inline-item">Dashboard</li>
                        </ul>
                    </div>
                    <form class="au-form-icon--sm" >
                        <input class="au-input--w300 au-input--style2" type="text" placeholder="Search for datas &amp; reports...">
                        <span class="au-btn--submit2">
                            <i class="zmdi zmdi-search"></i>
                        </span> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END BREADCRUMB-->

<!-- WELCOME-->
<section class="welcome p-t-10">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="title-4">Welcome back
                    <span>{{ auth()->user()->name }}!</span>
                </h1>
                <hr class="line-seprate">
            </div>
        </div>
    </div>
</section>
<!-- END WELCOME-->

<!-- STATISTIC-->
<section class="statistic statistic2">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="statistic__item statistic__item--green">
                <h2 class="number">{{ $theleaveform }}</h2>
                    <span class="desc">Total Forms</span>
                    <div class="icon">
                        <i class="zmdi zmdi-calendar-note"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="statistic__item statistic__item--blue">
                    <h2 class="number">{{ $theleaveform2 }}</h2>
                    <span class="desc">Approved Forms</span>
                    <div class="icon">
                        <i class="zmdi zmdi-calendar-note"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="statistic__item statistic__item--orange">
                    <h2 class="number">{{ $theleaveform3 }}</h2>
                    <span class="desc">Pending Forms</span>
                    <div class="icon">
                        <i class="zmdi zmdi-calendar-note"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="statistic__item statistic__item--red">
                    <h2 class="number">{{ $theleaveform4 }}</h2>
                    <span class="desc">Users</span>
                    <div class="icon">
                        <i class="zmdi zmdi-account-o"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END STATISTIC-->



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