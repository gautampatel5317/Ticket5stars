@extends('backend.layouts.admin')
@section('page-header')
{{ trans('global.edit') }} {{ trans('global.settings') }}
@endsection
@section('content')
<div class="card card-primary card-outline">
    <div class="card-body">
        <section id="tabs">
            {!! Form::model($setting, ['url' => route('admin.settings.update',$setting->id),'enctype'=> 'multipart/form-data','method'=>'PUT','class'=>'form-validate-jquery']) !!}
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{$setting->id}}">

            <div class="container">
                <div class="row">
                    <div class="col-xs-12 ">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-seo-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-seo" aria-selected="true">{{ trans('global.setting.seo_settings') }}</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-contact" aria-selected="false">{{ trans('global.setting.company_contact_details') }}</a>
                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-mail" aria-selected="false">{{ trans('global.setting.mail_settings') }}</a>
                                <a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-controls="nav-footer" aria-selected="false">{{ trans('global.setting.footer_settings') }}</a>
                                <a class="nav-item nav-link" id="nav-terms-tab" data-toggle="tab" href="#nav-terms" role="tab" aria-controls="nav-terms" aria-selected="false">{{ trans('global.setting.terms_condition_settings') }}</a>
                            </div>
                        </nav>
                        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-seo-tab">
                                <div class="form-group">
                                    {{ Form::label('logo', trans('global.setting.site_logo'), ['class' => 'col-lg-2 control-label']) }}
                                    <div class="col-lg-10">
                                        {!! Form::file('logo', array('class'=>'form-control inputfile inputfile-1' )) !!}
                                        <label for="logo">
                                            <i class="fa fa-upload"></i>
                                            <span>{{ trans('global.setting.choose_file') }}</span>
                                        </label>
                                        <div class="img-remove-logo">
                                            @if($setting->logo)
                                                <img height="50" width="50" src="{{ Storage::disk('public')->url('images/settings/' . $setting->logo) }}">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('favicon', trans('global.setting.favicon'), ['class' => 'col-lg-2 control-label']) }}
                                    <div class="col-lg-10">
                                        {!! Form::file('favicon', array('class'=>'form-control inputfile inputfile-1' )) !!}
                                        <label for="favicon">
                                            <i class="fa fa-upload"></i>
                                            <span>{{ trans('global.setting.choose_file') }}</span>
                                        </label>
                                        <div class="img-remove-favicon">
                                            @if($setting->logo)
                                                <img height="50" width="50" src="{{ Storage::disk('public')->url('images/settings/' . $setting->favicon) }}">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('seo_title', trans('Metatitle'), ['class' => 'col-lg-2 control-label']) }}
                                    <div class="col-lg-10">
                                        {{ Form::text('seo_title', null, ['class' => 'form-control', 'placeholder' => trans('Metatitle')])
										}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('seo_keyword', trans('Seo Keyword'), ['class' => 'col-lg-2 control-label']) }}
                                    <div class="col-lg-10">
                                        {{ Form::textarea('seo_keyword', null,['class' => 'form-control', 'placeholder' => trans('Seo Keyword'),
										'rows' => 2]) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('seo_description', trans('Seo Description'), ['class' => 'col-lg-2
									control-label']) }}
                                    <div class="col-lg-10">
                                        {{ Form::textarea('seo_description', null,['class' => 'form-control', 'placeholder' => trans('Seo Description'),'rows' => 2]) }}
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <a href="{{ route('admin.home') }}" class="btn btn-danger ml-2">Cancel</a>
                                    <input type="submit" name="submit" value="Update" class="btn btn-primary">
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <div class="form-group">
                                    {{ Form::label('company_address', trans('Company Address'), ['class' => 'col-lg-2 control-label']) }}
                                    <div class="col-lg-10">
                                        {{ Form::textarea('company_address', null,['class' => 'form-control', 'placeholder' => trans('Company Address'),
										'rows' => 2]) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('company_contact', trans('Company Contact'), ['class'
									=> 'col-lg-2 control-label']) }}
                                    <div class="col-lg-10">
                                        {{ Form::text('company_contact', null,['class' => 'form-control', 'placeholder' => trans('Company Contact'),
										'rows' => 2]) }}
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <a href="{{ route('admin.home') }}" class="btn btn-danger ml-2">Cancel</a>
                                    <input type="submit" name="submit" value="Update" class="btn btn-primary">
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <div class="form-group">
                                    {{ Form::label('from_name', trans('From Name'), ['class' => 'col-lg-2 control-label']) }}
                                    <div class="col-lg-10">
                                        {{ Form::text('from_name', null,['class' => 'form-control', 'placeholder' => trans('From Name'),
										'rows' => 2]) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('from_email', trans('From Email'), ['class' => 'col-lg-2 control-label']) }}
                                    <div class="col-lg-10">
                                        {{ Form::text('from_email', null,['class' => 'form-control', 'placeholder' => trans('From Email'),
										'rows' => 2]) }}
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <a href="{{ route('admin.home') }}" class="btn btn-danger ml-2">Cancel</a>
                                    <input type="submit" name="submit" value="Update" class="btn btn-primary">
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                <div class="form-group">
                                    {{ Form::label('footer_text', trans('Footer Text'), ['class' => 'col-lg-2 control-label']) }}
                                    <div class="col-lg-10">
                                        {{ Form::text('footer_text', null,['class' => 'form-control', 'placeholder' => trans('Footer Text'),'rows' => 2]) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('copyright_text', trans('Copyright Text'), ['class' => 'col-lg-2
									control-label']) }}
                                    <div class="col-lg-10">
                                        {{ Form::text('copyright_text', null,['class' => 'form-control', 'placeholder' => trans('Copyright Textt'),'rows' => 2]) }}
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <a href="{{ route('admin.home') }}" class="btn btn-danger ml-2">Cancel</a>
                                    <input type="submit" name="submit" value="Update" class="btn btn-primary">
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-terms" role="tabpanel" aria-labelledby="nav-terms-tab">
                                <div class="form-group">
                                    {{ Form::label('terms', trans('Terms'), ['class' => 'col-lg-2 control-label']) }}
                                    <div class="col-lg-10">
                                        {{ Form::textarea('terms', null,['class' => 'form-control', 'placeholder' => trans('Terms')])
										}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('disclaimer', trans('Disclaimer'), ['class' => 'col-lg-2 control-label']) }}
                                    <div class="col-lg-10">
                                        {{ Form::textarea('disclaimer', null,['class' => 'form-control', 'placeholder' => trans('Disclaimer')]) }}
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <a href="{{ route('admin.home') }}" class="btn btn-danger ml-2">Cancel</a>
                                    <input type="submit" name="submit" value="Update" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}

            </div>
        </section>
    </div>
</div>
@endsection