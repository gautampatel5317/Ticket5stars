<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
    <label for="title" class="required">{{ trans('global.title') }}</label>
    <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($pos) ? $pos->title : '') }}">
    @if($errors->has('title'))
    <p class="help-block">
        {{ $errors->first('title') }}
    </p>
    @endif
</div>

<div class="form-group">
    <label for="status">{{ trans('global.status') }}</label>
    @php
    $selected_status = ( old('status') != "" ? old('status') : (isset($pos) ? $pos->status : '1' ) );
    @endphp
    <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="status1" name="status" class="custom-control-input" value="1" {{ ($selected_status == "1" ? "checked" : "") }}>
        <label class="custom-control-label" for="status1">{{ trans('global.active')}}</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="status2" name="status" class="custom-control-input" value="0" {{ ($selected_status == "0" ? "checked" : "") }}>
        <label class="custom-control-label" for="status2">{{ trans('global.inactive')}}</label>
    </div>
</div>

<div class="card-footer text-center">
    <a href="{{ route('admin.pos.index') }}" class="btn btn-danger ml-2">{{trans('global.cancel')}}</a>
    <input class="btn btn-primary" type="submit" value="{{ isset($pos)  ?  trans('global.update') :trans('global.save') }}">
</div>

<!-- JAvascript Included-->
@section('after-scripts')
<script type="text/javascript">
    $(document).ready(function() {
        Backend.Validate.Pos();
    });
</script>
@endsection