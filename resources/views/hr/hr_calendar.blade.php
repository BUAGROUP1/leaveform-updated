@extends('hr.layouts.hr_master')

@section('header')
    <!-- FullCalendar -->
    <link href='/vendor/fullcalendar-3.10.0/fullcalendar.css' rel='stylesheet' media="all" />


@endsection

@section('title')
HR Calendar
@endsection

@section('content')
    <div class="row">
        <div class="col">
        <div class="au-card">
            <div id="calendar"></div>
        </div>
        </div><!-- .col -->
    </div>
@endsection

@section('scripts')

    <!-- full calendar requires moment along jquery -->
    <script src="/vendor/fullcalendar-3.10.0/lib/moment.min.js"></script>
    <script src="/vendor/fullcalendar-3.10.0/fullcalendar.js"></script>

    <script>
         // setup a few events
  $('#calendar').fullCalendar({
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,agendaWeek,agendaDay,listWeek'
    }
  });
    </script>
@endsection