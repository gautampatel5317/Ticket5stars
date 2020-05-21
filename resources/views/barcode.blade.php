@extends('backend.layouts.admin')
@section('content')
<div class="content">
   <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body">
        	<div class="visible-print text-center">
        			{!! $qrCode !!}
        	</div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection