@extends('backend.layouts.admin')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/1.6.0/fullcalendar.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/daygrid/main.min.js">
@section('content')


{!! $calendar->calendar() !!}
{{-- {!! $calendar->script() !!} --}}
@endsection
@section('scripts')
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/1.6.0/fullcalendar.min.js'></script>
{!! $calendar->script() !!}
@endsection