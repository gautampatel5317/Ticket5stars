<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name">{{ trans('global.user.fields.name') }}*</label>
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
<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
    <label for="email">{{ trans('global.user.fields.email') }}*</label>
    <input type="email" autocomplete="off" id="email" name="email" class="form-control" value="{{ old('email', isset($user) ? $user->email : '') }}">
    @if($errors->has('email'))
    <p class="help-block">
        {{ $errors->first('email') }}
    </p>
    @endif
    <p class="helper-block">
        {{ trans('global.user.fields.email_helper') }}
    </p>
</div>
<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
    <label for="password">{{ trans('global.user.fields.password') }}</label>
    <input type="password" autocomplete="off" id="password" name="password" class="form-control">
    @if($errors->has('password'))
    <p class="help-block">
        {{ $errors->first('password') }}
    </p>
    @endif
    <p class="helper-block">
        {{ trans('global.user.fields.password_helper') }}
    </p>
</div>
<div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
    <label for="roles">{{ trans('global.user.fields.roles') }}*
        <span class="btn btn-info btn-xs select-all">Select all</span>
        <span class="btn btn-info btn-xs deselect-all">Deselect all</span></label>
        <select name="roles[]" id="roles" class="form-control select2" multiple="multiple">
            @foreach($roles as $id => $roles)
            <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || isset($user) && $user->roles->contains($id)) ? 'selected' : '' }}>
                {{ $roles }}
            </option>
            @endforeach
        </select>
        @if($errors->has('roles'))
        <p class="help-block">
            {{ $errors->first('roles') }}
        </p>
        @endif
        <p class="helper-block">
            {{ trans('global.user.fields.roles_helper') }}
        </p>
    </div>
    <div class="card-footer text-center">
        <a href="{{ route('admin.users.index') }}" class="btn btn-danger ml-2">Cancel</a>
          <input class="btn btn-primary" type="submit" value="{{ isset($user)  ?  trans('global.update') :trans('global.save') }}">

    </div>
<!-- JAvascript Included-->
@section('after-scripts')
<script type="text/javascript">
    $(document).ready(function(){
        Backend.Validate.Users();
    });
</script>
@endsection