@extends('backend.layouts.admin')
@section('page-header')
{{ trans('Edit Settings') }}
@endsection
@section('content')
<div class="card card-primary card-outline">
	<div class="card-body">
		<section id="tabs">
			<div class="container">
				{{-- <h3 class="section-title h1">Tabs</h6> --}}
				<div class="row">
					<div class="col-xs-12 ">
						<nav>
							<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
								<a class="nav-item nav-link active" id="nav-seo-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-seo" aria-selected="true">SEO Settings</a>
								<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-contact" aria-selected="false">Company Contact Details</a>
								<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-mail" aria-selected="false">Mail Settings</a>
								<a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-controls="nav-footer" aria-selected="false">Footer Settings</a>
								<a class="nav-item nav-link" id="nav-terms-tab" data-toggle="tab" href="#nav-terms" role="tab" aria-controls="nav-terms" aria-selected="false">Terms and Condition Settings</a>
							</div>
						</nav>
						<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
							<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-seo-tab">
								<div class="form-group">
									{{ Form::label('logo', trans('Site Logo'), ['class' => 'col-lg-2 control-label']) }}
									<div class="col-lg-10">
										{!! Form::file('logo', array('class'=>'form-control inputfile inputfile-1' )) !!}
										<label for="logo">
											<i class="fa fa-upload"></i>
											<span>Choose a file</span>
										</label>
										<div class="img-remove-logo">
											@if($setting->logo)
											<img height="50" width="50" src="{{ Storage::disk('public')->url('img/logo/' . $setting->logo) }}">
											<i id="remove-logo-img" class="fa fa-times remove-logo" data-id="logo" aria-hidden="true"></i>
											@endif
										</div>
									</div>
								</div>
								<div class="form-group">
									{{ Form::label('favicon', trans('Favicon'), ['class' => 'col-lg-2 control-label']) }}
									<div class="col-lg-10">
										{!! Form::file('favicon', array('class'=>'form-control  inputfile inputfile-1' )) !!}
										<label for="favicon">
											<i class="fa fa-upload"></i>
											<span>Choose a file</span>
										</label>
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
			</div>
		</section>
	</div>
</div>
@endsection