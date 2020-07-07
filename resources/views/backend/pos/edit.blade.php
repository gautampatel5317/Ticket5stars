@extends('backend.layouts.admin')
@section('page-header')
{{ trans('global.edit') }} {{ trans('global.pos.title_singular') }}
@endsection
@section('content')
<div class="container-fluid">
    @include('flash::message')
    <div class="card card-primary card-outline">
        <div class="card-body">
            {!! Form::model($pos, ['url' => route('admin.pos.update',$pos->id),'enctype'=> 'multipart/form-data','method'=>'PUT','class'=>'form-validate-jquery']) !!}
            @csrf
            @method('PUT')
            <input type="hidden" name = "id" value = "{{$pos->id}}">
            @include('backend.pos.form')
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection