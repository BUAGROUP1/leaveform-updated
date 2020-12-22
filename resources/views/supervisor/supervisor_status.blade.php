@extends('supervisor.layouts.supervisor_master')

@section('content')
<section class="statistic">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="statistic__item">
                    <h2 class="number">{{ $theleaveform }}</h2>
                        <span class="desc" style="color: black">Total</span>
                        <div class="icon">
                            <i class="zmdi zmdi-calendar-note" style="color: green"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a style="display: inherit" href="/supervisor_status_approved">
                    <div class="statistic__item">
                    <h2 class="number">{{ $theleaveform2 }}</h2>
                        <span class="desc" style="color: black">Approved</span>
                        <div class="icon">
                            <i class="zmdi zmdi-calendar-note" style="color: royalblue"></i>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a style="display: inherit" href="/supervisor_status_pending">
                    <div class="statistic__item">
                        <h2 class="number">{{ $theleaveform3 }}</h2>
                        <span class="desc" style="color: black">Pending</span>
                        <div class="icon">
                            <i class="zmdi zmdi-calendar-note" style="color: red"></i>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
