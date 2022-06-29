@extends('layouts.backend')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/css/forms/selects/select2.min.css') }}">
    <style>

    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">@lang('Workers')</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('Home')</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('worker.index') }}">@lang('Workers')</a>
                            </li>
                            <li class="breadcrumb-item active">@lang('Create Worker')
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <div class="content-body">
        <section id="configuration">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="basic-layout-colored-form-control">@lang('Create Worker') </h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                @include('dashboard.parts._error')
                                @include('dashboard.parts._success')

                                <form class="form" method="post" action="{{ route('worker.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label>@lang('Image') </label><span> (200 * 150)</span>
                                                <input type="file" name="image" required class="form-control image">
                                            </div>

                                            <div class="form-group">
                                                <img src="{{ asset('uploads/product_images/default.png') }}"
                                                    style="width: 100px" class="img-thumbnail image-preview" alt="">
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label>@lang('Video') </label>
                                                <input type="file" name="video" class="form-control video">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>@lang('Name')</label>
                                                <input type="text" name="name" value="{{ old('name') }}"
                                                    class="form-control" required placeholder="@lang('Name')">
                                            </div>
                                            @if (auth()->user()->hasRole('Admin'))
                                                <div class="col-md-6">
                                                    <label>@lang('Company Name')</label>
                                                    <select name="company_id" required class="form-control">
                                                        <option value=""> @lang('Choose Compnay') </option>
                                                        @foreach ($comapnys as $item)
                                                            <option value="{{ $item->id }}"
                                                                @if (old('company_id ') == $item->id) selected @endif>
                                                                {{ $item->name }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            @endif
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>@lang('Nationalitiy')</label>
                                                <select name="nationality_id" id="select_new" required
                                                    class="form-control select2">
                                                    <option value=""> @lang('Choose Natonality') </option>
                                                    @foreach ($natonality as $item)
                                                        <option value="{{ $item->id }}"
                                                            @if (old('nationality_id') == $item->id) selected @endif>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                            <div class="col-md-2 mt-2 ">
                                                <button type="button" class="btn btn-info" data-toggle="modal"
                                                    data-target="#myModal"> @lang('Create nationalitiy')</button>

                                            </div>
                                            <div class="col-md-6">
                                                <label>@lang('Age')</label>
                                                <input type="number" name="age" value="{{ old('age') }}"
                                                    class="form-control" placeholder="@lang('Age')">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>@lang('Experince')</label>
                                                <input type="number" name="experience" value="{{ old('experience') }}"
                                                    class="form-control" placeholder="@lang('Experince')">

                                            </div>
                                            <div class="col-md-6">
                                                <label>@lang('Is the experience inside Saudi Arabia or not')?</label>
                                                <select name="in_sa" required class="form-control">
                                                    <option value="1"
                                                        @if (old('in_sa') == 1) selected @endif>
                                                        @lang('yes') </option>
                                                    <option value="0"
                                                        @if (old('in_sa') == 0) selected @endif>
                                                        @lang('no') </option>

                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>@lang('Language')</label>
                                                {{-- <select name="language[]" multiple required class="form-control">
                                                    <option value=""> @lang('Choose Language') </option>
                                                    @foreach (get_language() as $item)
                                                        <option value="{{ $item }}"
                                                            @if (old('language') == $item) selected @endif>
                                                            {{ $item }}</option>
                                                    @endforeach
                                                </select> --}}
                                                <select required class="select2-rtl form-control" name="language[]"
                                                    id="select2-rtl-multi" multiple="multiple">
                                                    <option value=""> @lang('Choose Language') </option>

                                                    @foreach (get_language() as $item)
                                                        <option value="{{ $item }}"
                                                            @if (old('language') == $item) selected @endif>
                                                            {{ $item }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                            <div class="col-md-6">
                                                <label>@lang('Religion')</label>
                                                <select class="form-control" required name="religion">
                                                    <option value="" selected disabled>@lang('choose Religion') </option>
                                                    <option value="islam"
                                                        @if (old('religion') == 'islam') selected @endif>@lang('Islam')
                                                    </option>
                                                    <option value="christian"
                                                        @if (old('religion') == 'christian') selected @endif>@lang('Christian')
                                                    </option>
                                                    {{-- <option value="jewish" @if (old('religion') == 'jewish') selected @endif >Jewish</option>
                                                    <option value="buddhism" @if (old('religion') == 'buddhism')) selected @endif >Buddhism</option>
                                                    <option value="hindu" @if (old('religion') == 'hindu')) selected @endif >Hindu</option> --}}
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <label>@lang('Do you accept children')?</label>
                                                <select name="approve_chiled" required class="form-control">
                                                    <option value="1"
                                                        @if (old('approve_chiled') == 1) selected @endif>
                                                        @lang('yes') </option>
                                                    <option value="0"
                                                        @if (old('approve_chiled') == 0) selected @endif>
                                                        @lang('no') </option>

                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <label>@lang('Do she know cook') ?</label>
                                                <select name="is_coocked" required class="form-control">
                                                    <option value="1"
                                                        @if (old('is_coocked') == 1) selected @endif>
                                                        @lang('yes') </option>
                                                    <option value="0"
                                                        @if (old('is_coocked') == 0) selected @endif>
                                                        @lang('no') </option>

                                                </select>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <label>@lang('Recruitment period')</label>
                                                <select name="is_quick" required class=" form-control" id="time_q">
                                                    <option value="" selected> @lang('Choose')</option>
                                                    <option value="1"
                                                        @if (old('is_quick') == 1) selected @endif>
                                                        @lang('immediately')
                                                    </option>
                                                    <option value="0"
                                                        @if (old('is_quick') == 0 && old('is_quick') != null) selected @endif>
                                                        @lang('needs time')
                                                    </option>

                                                </select>
                                            </div>

                                            <div class="col-md-6" id="duration" style="display: none">
                                                <label>@lang('Duration')</label>
                                                <input type="number" name="time" value="{{ old('time') }}"
                                                    class="form-control" placeholder="@lang('Duration')">
                                            </div>
                                            <div class="col-md-6" id="cityd" style="display: block">
                                                <label>@lang('city')</label>
                                                <select  class="select2 form-control" name="city"
                                                    id="select2">
                                                    <option value=""> @lang('choose city') </option>
                                                    @php
                                                        if (get_lang() == 'ar') {
                                                            $city = get_city_ar();
                                                        } else {
                                                            $city = get_city_en();
                                                        }
                                                        
                                                    @endphp
                                                    @foreach ($city as $item)
                                                        <option value="{{ $item }}"
                                                            @if (old('city') == $item) selected @endif>
                                                            {{ $item }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <label>@lang('Saned Url')</label>
                                                <input type="url" name="url_sand" value="{{ old('url_sand') }}"
                                                    class="form-control" required placeholder="@lang('Saned Url')">
                                            </div>



                                        </div>
                                        <br>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <label>@lang('additional description in arabic')</label>

                                                <textarea name="description_ar" class="form-control" id="" cols="30" rows="10"></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label>@lang('additional description in english')</label>

                                                <textarea name="description_en" class="form-control" id="" cols="30" rows="10"></textarea>
                                            </div>


                                        </div>





                                    </div>



                                    <div class="form-actions left">

                                        <button type="submit" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i> {{ __('save') }}
                                        </button>
                                    </div>


                                </form>
                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header text-center">
                                                <h4 class="modal-title w-100 font-weight-bold">
                                                    {{ __('Add Nationalitiy') }}</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div id="form-errors" class="text-center"></div>

                                            <div id="natonality">
                                                <form method="post" id="form_model" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body mx-3">
                                                        <div class="md-form mb-2">
                                                            <label data-error="wrong" data-success="right"
                                                                for="form3">@lang('Flag')</label>
                                                            <input type="file" id="form3" name="flag"
                                                                class="form-control image">
                                                        </div>
                                                        <div class="form-group">
                                                            <img src="{{ asset('uploads/product_images/default.png') }}"
                                                                style="width: 100px" class="img-thumbnail image-preview"
                                                                alt="">
                                                        </div>



                                                    </div>
                                                    <div class="modal-body mx-3">
                                                        <div class="md-form mb-2">
                                                            <label data-error="wrong" data-success="right"
                                                                for="form3">@lang('Arabic Name')</label>
                                                            <input type="text" id="form3" name="name_ar"
                                                                class="form-control validate">
                                                        </div>

                                                        <div class="md-form mb-2">
                                                            <label data-error="wrong" data-success="right"
                                                                for="form2">@lang('English Name')</label>
                                                            <input type="text" id="form2" name="name_en"
                                                                class="form-control validate">
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer d-flex justify-content-center">
                                                        <button class="btn btn-info" type="submit">@lang('save')
                                                            </i></button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
    </div>
    </section>

    </div>
@endsection
@section('script')
    <script src="{{ asset('backend/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/js/scripts/forms/select/form-select2.js') }}" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#time_q").change(function() {
                if ($(this).val() == 0) {
                    $("#duration").show();
                    $('#cityd').hide();
                } else {
                    $("#duration").hide();
                    $('#cityd').show();

                }
            });
        });
    </script>
    <script>
        $('#form_model').on('submit', function(e) {
            e.preventDefault();

            // var data = $(this).serialize();
            var frm = $('#form_model');
            var formData = new FormData(frm[0]);
            formData.append('file', $('#form3')[0].files[0]);
            $.ajax({
                url: "{{ route('nationalities.store_ajax') }}",
                type: "post",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {


                    $('#select_new').append('<option value="' + data.id +
                        '">' + data.name + '</option>');
                    $(".close").click();
                    toastr.options.closeButton = true;
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.options.closeDuration = 100;
                    toastr.success('{{ __('Added Successfully') }}');

                },
                error: function(data) {
                    var errors = data.responseJSON;
                    var errors = data.responseJSON;
                    errorsHtml = '<div class="alert alert-danger"><ul>';
                    $.each(errors.errors, function(k, v) {
                        errorsHtml += '<li>' + v + '</li>';
                    });
                    errorsHtml += '</ul></di>';
                    $('#form-errors').html(errorsHtml);
                },
            });
        });
    </script>
@endsection
