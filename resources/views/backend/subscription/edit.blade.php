@extends('backend.layouts.admin')
@section('page-header')
{{ trans('global.edit') }} {{ trans('global.subscription.title_singular') }}
@endsection
@section('content')
<div class="container-fluid">
    @include('flash::message')
    <div class="card card-primary card-outline">
        <div class="card-body">
            {!! Form::model($subscription, ['url' => route('admin.subscription.update',$subscription->id),'enctype'=> 'multipart/form-data','method'=>'PUT','class'=>'form-validate-jquery']) !!}
            @csrf
            @method('PUT')
            <input type="hidden" name = "id" value = "{{$subscription->id}}">
            @include('backend.subscription.form')
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection