@extends('layouts.app')

@section('title')
{{ __('main.profile title') }}
@endsection

@section('css')
<link href='https://unpkg.com/@fullcalendar/core@4.3.1/main.min.css' rel='stylesheet' />
<link href='https://unpkg.com/@fullcalendar/daygrid@4.3.0/main.min.css' rel='stylesheet' />
<link href='https://unpkg.com/@fullcalendar/timegrid@4.3.0/main.min.css' rel='stylesheet' />
<link href='https://unpkg.com/@fullcalendar/list@4.3.0/main.min.css' rel='stylesheet' />
@endsection

@section('javascript')
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src='https://unpkg.com/@fullcalendar/core@4.3.1/main.min.js'></script>
<script src='https://unpkg.com/@fullcalendar/interaction@4.3.0/main.min.js'></script>
<script src='https://unpkg.com/@fullcalendar/daygrid@4.3.0/main.min.js'></script>
<script src='https://unpkg.com/@fullcalendar/timegrid@4.3.0/main.min.js'></script>
<script src='https://unpkg.com/@fullcalendar/list@4.3.0/main.min.js'></script>
{{-- <script src="https://unpkg.com/@fullcalendar/core/locales/{{ str_replace('_', '-', app()->getLocale()) }}"></script> --}}

<script src="{{ asset('js/fullcalendar.js') }}" ></script>
<script>
    let btn_today = "{{ __('main.calendar today') }}";
    let btn_month = "{{ __('main.calendar month') }}";
    let btn_week = "{{ __('main.calendar week') }}";
    let btn_day = "{{ __('main.calendar day') }}";
    let btn_list = "{{ __('main.calendar list') }}";

    let success_msg = "{{ __('main.calendar edit success') }}";
    let error_msg = "{{ __('main.calendar edit error') }}";
    let delete_success_msg = "{{ __('main.calendar delete success') }}";
    let delete_error_msg = "{{ __('main.calendar delete error') }}";
</script>

@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">

      <div class="col-md-10">
          <div class="card">
              <div class="card-header"><i class="fas fa-id-card"></i>{{ __('main.calendar title') }}</div>
              <div class="card-body">
                  <div id='calendar-container'>
                     <div id='calendar'></div>
                     @include('mypage.fullcalendar.update_modal', [
                        'users' => $users,
                        'hours' => $hours,
                        'minutes' => $minutes,
                        'colors' => $colors,
                    ])
                 </div>
             </div><!-- end card-body -->
         </div><!-- end card -->
      </div>
  </div>
</div>
@endsection
