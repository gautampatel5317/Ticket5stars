@extends('backend.layouts.admin')
@section('page-header')
{{ trans('global.add') }} {{ trans('global.ingredient.title_singular') }}
@endsection
@section('content')
<div class="container-fluid">
    @include('flash::message')
    <div class="card card-primary card-outline">
        <div class="card-body">
            {!! Form::model(null, ['id' => 'create-from','url' => route('admin.ingredient.store'),'enctype'=> 'multipart/form-data','class'=>'form-validate-jquery']) !!}
            @csrf
            @include('backend.ingredient.form')
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
