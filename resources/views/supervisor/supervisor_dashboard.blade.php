@extends('supervisor.layouts.supervisor_master')

@section('title')
Supervisor Dashboard
@endsection

@section('content')
<!-- BREADCRUMB-->
<section class="au-breadcrumb2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="au-breadcrumb-content">
                    <div class="au-breadcrumb-left">
                        <span class="au-breadcrumb-span">SUPERVISOR:</span>
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
            <div class="col-md-6 col-lg-4">
                <div class="statistic__item statistic__item--green">
                <h2 class="number">{{ $theleaveform }}</h2>
                    <span class="desc">Total Forms</span>
                    <div class="icon">
                        <i class="zmdi zmdi-calendar-note"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="statistic__item statistic__item--blue">
                    <h2 class="number">{{ $theleaveform2 }}</h2>
                    <span class="desc">Approved Forms</span>
                    <div class="icon">
                        <i class="zmdi zmdi-calendar-note"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="statistic__item statistic__item--orange">
                    <h2 class="number">{{ $theleaveform3 }}</h2>
                    <span class="desc">Pending Forms</span>
                    <div class="icon">
                        <i class="zmdi zmdi-calendar-note"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END STATISTIC-->
@endsection

@section('scripts')

@endsection
