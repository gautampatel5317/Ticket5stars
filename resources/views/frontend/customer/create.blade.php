@extends('frontend.layouts.app')
@section('header')
@endsection
@section('conent')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                {{-- <div class="card-header">{{ __('Signup Customer') }}</div> --}}

                <div class="card-body">
                    <form method="POST" action="{{url('customer')}}" name = "customer_form" id = "customer_form">
                        @csrf

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" autofocus>
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="family_name" class="col-md-4 col-form-label text-md-right">{{ __('Family Name') }}</label>

                            <div class="col-md-6">
                                <input id="family_name" type="text" class="form-control @error('family_name') is-invalid @enderror" name="family_name" value="{{ old('family_name') }}">
                                @error('family_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="experience" class="col-md-4 col-form-label text-md-right">{{ __('Experience') }}</label>

                            <div class="col-md-6">
                                <select name = "experience" class="form-control @error('experience') is-invalid @enderror" name="experience">
                                    <option value = "">Select experience</option>
                                    <option value = "New" {{ old('experience') == 'New' ? 'selected' : '' }}>{{ __('New') }}</option>
                                    <option value = "Mid Expert" {{ old('experience') == 'Mid Expert' ? 'selected' : '' }}>{{ __('Mid Expert') }}</option>
                                    <option value = "Expert" {{ old('experience') == 'Expert' ? 'selected' : '' }}>{{ __('Expert') }}</option>
                                </select>
                                @error('experience')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="business" class="col-md-4 col-form-label text-md-right">{{ __('business') }}</label>

                            <div class="col-md-6">
                                <select name = "business" class="form-control @error('business') is-invalid @enderror" name="business">
                                    <option value = "">Select business</option>
                                    <option value = "1 to 3 months" {{ old('business') == '1 to 3 months' ? 'selected' : '' }}>{{ __('1 to 3 months') }}</option>
                                    <option value = "3 to 6 months" {{ old('business') == '3 to 6 months' ? 'selected' : '' }}>{{ __('3 to 6 months') }}</option>
                                    <option value = "6 to 12 months" {{ old('business') == '6 to 12 months' ? 'selected' : '' }}>{{ __('6 to 12 months') }}</option>
                                    <option value = "1 year +" {{ old('business') == '1 year +' ? 'selected' : '' }}>{{ __('1 year +') }}</option>
                                    <option value = "2 year +" {{ old('business') == '2 year +' ? 'selected' : '' }}>{{ __('2 year +') }}</option>
                                    <option value = "3 year +" {{ old('business') == '3 year +' ? 'selected' : '' }}>{{ __('3 year +') }}</option>
                                    <option value = "Over 3 years" {{ old('business') == 'Over 3 years' ? 'selected' : '' }}>{{ __('Over 3 years') }}</option>
                                </select>
                                @error('business')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-4 col-form-label"></div>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                                <a class = "btn btn-secondary" href = "{{ route('customer.index') }}">{{ __('Back') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
$(document).ready(function () {
    $('#customer_form').validate({ // initialize the plugin
        errorClass: 'is-invalid',
        highlight: function (element, errorClass, validClass) {
               var elem = $(element);
               if (elem.hasClass("select2-hidden-accessible")) {
                   $("#select2-" + elem.attr("id") + "-container").parent().addClass(errorClass);
               } else {
                   elem.addClass(errorClass);
               }
            },
        unhighlight: function (element, errorClass, validClass) {
                var elem = $(element);
                if (elem.hasClass("select2-hidden-accessible")) {
                    $("#select2-" + elem.attr("id") + "-container").parent().removeClass(errorClass);
                } else {
                    elem.removeClass(errorClass);
                }
            },
        errorPlacement: function (error, element) {
               error.addClass('invalid-feedback');
              element.closest('.form-group').append(error);
               var elem = $(element);
               if (elem.hasClass("select2-hidden-accessible")) {
                   element = $("#select2-" + elem.attr("id") + "-container").parent();
                   error.insertAfter(element);
               } else if(elem.hasClass("multiple_input")){
                   element = $("#" + elem.attr("id"));
                   error.insertAfter(element);
               }else if (element.hasClass("file")) {
                    //error.insertAfter(element.siblings(".note-editor"));
                    element.closest('.form-group').append(error);
               }else if (element.hasClass("summernote")) {
                    error.insertAfter(element.siblings(".note-editor"));
               }else {
                   error.insertAfter(element);
               }
            },
        rules: {
            first_name: {
                required: true
            },
            family_name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            experience: {
                required: true
            },
            business: {
                required: true
            },
        },
        messages: {
            first_name: 'The first name field is required.',
            family_name: 'The family name field is required.',
            email: 'The email field is required!',
            experience:'The experience field is required!',
            business: 'The business field is required!'
        }
    });
});
</script>
@endsection
