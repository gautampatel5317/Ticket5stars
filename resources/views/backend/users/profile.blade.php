@extends('backend.layouts.admin')
@section('content')
@include('flash::message')
<div class="card">
    <div class="card-header">
        {{ trans('global.change_password') }}
    </div>
    <div class="card-body">
        <form action="{{ route("admin.users.changeProfile") }}" method="POST" enctype="multipart/form-data" name="profileform" id="profileform">
        @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">{{ trans('global.user.fields.name') }}*</label>
                <div class="col-md-6">
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($user) ? $user->name : '') }}">
                @if($errors->has('name'))
                <p class="help-block">
                    {{ $errors->first('name') }}
                </p>
                @endif
                <p class="helper-block">
                    {{ trans('global.user.fields.name_helper') }}
                </p>
                </div>
            </div>
            <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                <label for="new-password" class="col-md-4 control-label">{{ trans('global.current_password') }}*</label>

                <div class="col-md-6">
                    <input id="current_password" type="password" class="form-control" name="current_password" >

                    @if ($errors->has('current_password'))
                        <p class="help-block">
                        {{ $errors->first('current_password') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                <label for="new_password" class="col-md-4 control-label">{{ trans('global.new_password') }}*</label>

                <div class="col-md-6">
                    <input id="new_password" type="password" class="form-control" name="new_password" >

                    @if ($errors->has('new_password'))
                        <p class="help-block">
                            {{ $errors->first('new_password') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="new_password-confirm" class="col-md-4 control-label">{{ trans('global.confirm_password') }}</label>

                <div class="col-md-6">
                    <input id="new_password-confirm" type="password" class="form-control" name="new_password_confirmation" >
                </div>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
<script>
jQuery(function($) {
  
  $("#profileform").validate({
    rules: {
        name: {
            required: true
      },
        current_password: {
            required: true
      },
      new_password: {
            required: true,
            minlength:6,
      }
    }
  });
  
});
</script>
@endsection
