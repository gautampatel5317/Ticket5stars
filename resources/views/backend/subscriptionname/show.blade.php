@extends('backend.layouts.admin')
@section('page-header')
{{ trans('global.show') }} {{ trans('global.subscriptionname.title_singular') }}
@endsection
@section('content')
<div class="container-fluid">
    @include('flash::message')
    <div class="card card-primary card-outline">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('global.subscriptionname.fields.name') }}
                        </th>
                        <td>
                            {{ $subscriptionname->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('global.status') }}
                        </th>
                        <td>
                        @if($subscriptionname->status == "1")
                            <i class='fas fa-check fa-2x text-success'></i>
                        @else
                            <i class="fas fa-times fa-2x text-danger"></i>
                        @endif
                        </td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
        <div class="card-footer text-center">
            <a href="{{ route('admin.subscriptionname.index') }}" class="btn btn-danger ml-2">{{ trans('global.back') }}</a>
        </div>
    </div>
</div>
@endsection