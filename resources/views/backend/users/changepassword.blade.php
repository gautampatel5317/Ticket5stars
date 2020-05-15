@extends('backend.layouts.admin')
@section('content')
@include('flash::message')
<div class="card">
    <div class="card-header">
        {{ trans('global.change_password') }}
    </div>
    <div class="card-body">
        <form action="{{ route("admin.users.changepassword") }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                <label for="new-password" class="col-md-4 control-label">{{ trans('global.current_password') }}*</label>

                <div class="col-md-6">
                    <input id="current-password" type="password" class="form-control" name="current-password" >

                    @if ($errors->has('current-password'))
                        <p class="help-block">
                        {{ $errors->first('current-password') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                <label for="new-password" class="col-md-4 control-label">{{ trans('global.new_password') }}*</label>

                <div class="col-md-6">
                    <input id="new-password" type="password" class="form-control" name="new-password" >

                    @if ($errors->has('new-password'))
                        <p class="help-block">
                            {{ $errors->first('new-password') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="form-group {{ $errors->has('new-password_confirmation') ? ' has-error' : '' }}">
                <label for="new-password-confirm" class="col-md-4 control-label">{{ trans('global.confirm_password') }}</label>

                <div class="col-md-6">
                    <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" >
                    @if ($errors->has('new-password_confirmation'))
                        <p class="help-block">
                            {{ $errors->first('new-password_confirmation') }}
                        </p>
                    @endif
                </div>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection
