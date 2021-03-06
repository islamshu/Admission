@extends('layouts.backend')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/css/forms/selects/select2.min.css') }}">
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
                        <li class="breadcrumb-item active">@lang('Edit') {{ $worker->name }}
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
                            <h4 class="card-title" id="basic-layout-colored-form-control">@lang('Edit Worker') </h4>
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

                                <form class="form" method="post" action="{{ route('worker.update', $worker->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label>@lang('Image') </label><span> (200 * 150)</span>
                                                <input type="file" name="image" class="form-control image">
                                            </div>

                                            <div class="form-group">
                                                <img src="{{ asset('uploads/' . $worker->image) }}" style="width: 100px"
                                                    class="img-thumbnail image-preview" alt="">
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
                                                <input type="text" name="name" value="{{ $worker->name }}"
                                                    class="form-control" required placeholder="type name">
                                            </div>
                                            @if (auth()->user()->hasRole('Admin'))
                                                <div class="col-md-6">
                                                    <label>@lang('Company')</label>
                                                    <select name="company_id" required class="form-control">
                                                        <option value=""> @lang('Choose Compnay')</option>
                                                        @foreach ($comapnys as $item)
                                                            <option value="{{ $item->id }}"
                                                                @if ($worker->company_id == $item->id) selected @endif>
                                                                {{ $item->name }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            @endif
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>@lang('Natonality')</label>
                                                <select name="nationality_id" id="select_new" required class="form-control">
                                                    <option value=""> @lang('Choose Natonality') </option>
                                                    @foreach ($natonality as $item)
                                                        <option value="{{ $item->id }}"
                                                            @if ($worker->nationality_id == $item->id) selected @endif>
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
                                                <input type="number" name="age" value="{{ $worker->age }}"
                                                    class="form-control" placeholder="type age">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>@lang('Experince')</label>
                                                <input type="number" id="experience" name="experience" value="{{ $worker->experience }}"
                                                    class="form-control" placeholder="type experience">

                                            </div>
                                            <div class="col-md-6" id="in_sa" @if( $worker->experience == 0) style="dispaly:none" @else style="dispaly:block"  @endif>
                                                <label>@lang('Is the experience inside Saudi Arabia or not')?</label>
                                                <select name="in_sa" required class="form-control">
                                                    <option value="1"
                                                        @if ($worker->in_sa == 1) selected @endif> @lang('yes') </option>
                                                    <option value="0"
                                                        @if ($worker->in_sa == 0) selected @endif> @lang('no') </option>

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
                                                    @if($worker->language != null)
                                                        <option value="{{ $item }}"
                                                        @if (in_array( $item, json_decode($worker->language)))
                                                          selected @endif>
                                                            {{ $item }}</option>
                                                            @else
                                                            <option value="{{ $item }}"
                                                       
                                                          >
                                                            {{ $item }}</option>
                                                            @endif

                                                    @endforeach
                                                </select> --}}
                                                <select required class="select2-rtl form-control" name="language[]" id="select2-rtl-multi" multiple="multiple">
                                                    <option value=""> @lang('Choose Language') </option>

                                                    @foreach (get_language() as $item)
                                                    @if($worker->language != null)
                                                    <option value="{{ $item }}"
                                                    @if (in_array( $item, json_decode($worker->language)))
                                                      selected @endif>
                                                        {{ $item }}</option>
                                                        @else
                                                        <option value="{{ $item }}"
                                                   
                                                      >
                                                        {{ $item }}</option>
                                                        @endif
                                                @endforeach
                                                  </select>

                                            </div>
                                            <div class="col-md-6">
                                                <label>@lang('Religion')</label>
                                                <select class="form-control" required name="religion">
                                                    <option value="" selected disabled>@lang('choose Religion') </option>
                                                    <option value="islam"
                                                        @if ($worker->religion == 'islam') selected @endif>@lang('Islam')</option>
                                                    <option value="christian"
                                                        @if ($worker->religion == 'christian') selected @endif>@lang('Christian')</option>
                                                    {{-- <option value="jewish" @if ($worker->religion == 'jewish') selected @endif >Jewish</option>
                                                    <option value="buddhism" @if ($worker->religion == 'buddhism')) selected @endif >Buddhism</option>
                                                    <option value="hindu" @if ($worker->religion == 'hindu')) selected @endif >Hindu</option> --}}
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <label>@lang('Do you accept children')?</label>
                                                <select name="approve_chiled" required class="form-control">
                                                    <option value="1"
                                                        @if ($worker->approve_chiled == 1) selected @endif> @lang('yes') </option>
                                                    <option value="0"
                                                        @if ($worker->approve_chiled == 0) selected @endif> @lang('no') </option>

                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <label>@lang('Do she know cook') ?</label>
                                                <select name="is_coocked" required class="form-control">
                                                    <option value="1"
                                                        @if ($worker->approve_chiled == 1) selected @endif> @lang('yes') </option>
                                                    <option value="0"
                                                        @if ($worker->approve_chiled == 0) selected @endif> @lang('no') </option>

                                                </select>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <label>@lang('Recruitment period')</label>
                                                <select name="is_quick" required class="form-control" id="time_q">
                                                    <option value=""> @lang('Choose')</option>
                                                    <option value="1"
                                                        @if ($worker->is_quick == 1) selected @endif> @lang('immediately')
                                                    </option>
                                                    <option value="0"
                                                        @if ($worker->is_quick == 0) selected @endif> @lang('needs time')
                                                    </option>

                                                </select>
                                            </div>

                                            <div class="col-md-6"
                                                id="duration"@if ($worker->is_quick == 1) style="display: none" @else  style="display: inline" @endif>
                                                <label>@lang('Duration')</label>
                                                <select name="time" id="" class="form-control">
                                                    <option value="">@lang('Choose')</option>
                                                    <option value="1" @if($worker->time == 1 ) selected @endif>1 @lang('months')</option>
                                                    <option value="2" @if($worker->time == 2 ) selected @endif>2 @lang('months')</option>
                                                    <option value="3" @if($worker->time == 3 ) selected @endif>3 @lang('months')</option>

                                                </select>
                                            </div>
                                            <div class="col-md-6" id="cityd" @if ($worker->is_quick == 1) style="display: block" @else  style="display: none" @endif>
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
                                                            @if ( $worker->city== $item) selected @endif>
                                                            {{ $item }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                        <br>
                                        <div class="row">

                                            {{-- <div class="col-md-6">
                                                <label>@lang('Saned Url')</label>
                                                <input type="url" name="url_sand" value="{{ $worker->url_sand }}"
                                                    class="form-control" required placeholder="type Saned Url">
                                            </div> --}}
                                            <div class="col-md-6">
                                                <label>@lang('Visa Number')</label>
                                                <input type="test"  name="visa_number" value="{{ $worker->visa_number }}"
                                                    class="form-control" required placeholder="@lang('Visa Number')">
                                            </div>


                                        </div>
                                        
                                        <br>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <label>@lang('company name external')</label>
                                                <input type="text" name="company_name_external" class="form-control" value="{{$worker->company_name_external}}" id="">
                                            </div>
                                            <div class="col-md-6">
                                                <label>@lang('company commercial register external')</label>

                                                <input type="text" name="company_co_register_external" class="form-control" value="{{$worker->company_co_register_external}}" id="">
                                            </div>


                                        </div>
                                        <br>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <label>@lang('additional description in arabic')</label>

                                                <textarea name="description_ar" class="form-control" id="" cols="30" rows="10">{{ $worker->description_ar }}</textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label>@lang('additional description in english')</label>

                                                <textarea name="description_en" class="form-control" id="" cols="30" rows="10">{{ $worker->description_en }}</textarea>
                                            </div>


                                        </div>





                                    </div>



                                    <div class="form-actions left">

                                        <button type="submit" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i> {{ __('save') }}
                                        </button>
                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h4 class="modal-title w-100 font-weight-bold">{{ __('Add Nationalitiy') }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div id="form-errors" class="text-center"></div>

                        <div id="natonality">
                            <form method="post" id="form_model" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body mx-3">
                                    <div class="md-form mb-2">
                                        <label data-error="wrong" data-success="right" for="form3">@lang('Flag')</label>
                                        <input type="file" id="form3" name="flag" class="form-control image">
                                    </div>
                                    <div class="form-group">
                                        <img src="{{ asset('uploads/product_images/default.png') }}"
                                            style="width: 100px" class="img-thumbnail image-preview" alt="">
                                    </div>



                                </div>
                                <div class="modal-body mx-3">
                                    <div class="md-form mb-2">
                                        <label data-error="wrong" data-success="right" for="form3">@lang('Arabic Name')</label>
                                        <input type="text" id="form3" name="name_ar"
                                            class="form-control validate">
                                    </div>

                                    <div class="md-form mb-2">
                                        <label data-error="wrong" data-success="right" for="form2">@lang('English Name')
                                            </label>
                                        <input type="text" id="form2" name="name_en"
                                            class="form-control validate">
                                    </div>

                                </div>
                                <div class="modal-footer d-flex justify-content-center">
                                    <button class="btn btn-info" type="submit">@lang('save') </i></button>
                                </div>
                            </form>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{ asset('backend/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend/js/scripts/forms/select/form-select2.js') }}" type="text/javascript"></script>
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
        $('#experience').change(function() {
            if($(this).val() == 0){
                $('#in_sa').hide();
            }else{
                $('#in_sa').show();
            }
        });
    </script>
@endsection
