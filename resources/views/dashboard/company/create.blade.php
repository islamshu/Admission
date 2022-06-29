@extends('layouts.backend')
@section('css')
    <style>
        span {
            margin: 5px
        }
    </style>
@endsection
@section('content')
    <button id="geogg" onclick="initGeolocation()" style="display: none">Try It</button>



    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">@lang('Companies')</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('Home')</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('companies.index') }}">@lang('Companies')</a>
                            </li>
                            <li class="breadcrumb-item active">@lang('Create Company')
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
                            <h4 class="card-title" id="basic-layout-colored-form-control">@lang('Create Company') </h4>
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
                            @include('dashboard.parts._error')
                            @include('dashboard.parts._success')

                            <form class="form" method="post" action="{{ route('companies.store_admin') }}"
                                enctype="multipart/form-data">
                                <div class="card-body">

                                    @csrf
                                    <div class="form-body">
                                        <h4 class="form-section"><i class="la la-add"></i>@lang('Company Info')</h4>

                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label>@lang('Image') </label> <span style="color: red">*</span>
                                                <input type="file" name="image" required class="form-control image">
                                            </div>

                                            <div class="form-group">
                                                <img src="{{ asset('uploads/product_images/default.png') }}"
                                                    style="width: 100px" class="img-thumbnail image-preview" alt="">
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>@lang('Company Name')</label><span style="color: red">*</span>
                                                <input type="text" id="form3" value="{{ old('name') }}" required
                                                    name="name" class="form-control validate">
                                            </div>
                                            <div class="col-md-6">
                                                <label>@lang('Email')</label><span style="color: red">*</span>
                                                <input type="email" id="form3" value="{{ old('email') }}" required
                                                    name="email" class="form-control validate">
                                            </div>


                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>@lang('Phone')</label><span style="color: red">*</span>
                                                <input type="text" id="form3" value="{{ old('phone') }}" required
                                                    name="phone" class="form-control validate">
                                            </div>
                                            <div class="col-md-6">
                                                <label>@lang('Commical Register')</label><span style="color: red">*</span>
                                                <input type="number" id="form3"
                                                    value="{{ old('commercial_register') }}" required
                                                    name="commercial_register" class="form-control validate">
                                            </div>


                                        </div>
                                        <br>
                                        <div class="row">
                                            {{-- <div class="col-md-6">
                                                <label>@lang('Longitude')</label>
                                                <input type="text" id="form3" value="{{ old('longitude') }}"
                                                    placeholder="Longitude" name="longitude" class="form-control validate">
                                            </div>
                                            <div class="col-md-6">
                                                <label>@lang('Latitude')</label>
                                                <input type="text" id="form3" value="{{ old('latitude') }}"
                                                    placeholder="Latitude" name="latitude" class="form-control validate">
                                            </div> --}}
                                            <div class="col-md-6">
                                                <label for="address_address">@lang('Address')</label>
                                                <input type="text" id="address-input" name="address_address"
                                                    value="{{ old('address_address') }}" required
                                                    class="form-control map-input">
                                                <input type="hidden" name="address_latitude" id="address-latitude"
                                                    value="{{ old('address_latitude') }}" />
                                                <input type="hidden" name="address_longitude" id="address-longitude"
                                                    value="{{ old('address_longitude') }}" />
                                            </div>
                                            <br>
                                            <div id="address-map-container" style="width:100%;height:400px; ">
                                                <br>
                                                <div style="width: 100%; height: 100%" id="address-map"></div>
                                            </div>


                                        </div>
                                        <br>

                                        <h4 class="form-section"><i class="la la-add"></i>@lang('Social media')</h4>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="userinput2">@lang('Facebook')</label>
                                                    <input type="url" name="facebook" value="{{ old('faceook') }}"
                                                        placeholder="@lang('Facebook')" id="userinput2"
                                                        class="form-control border-primary">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="userinput2">@lang('Twitter')</label>
                                                    <input type="url" name="twitter" value="{{ old('twitter') }}"
                                                        placeholder="@lang('Twitter')" id="userinput2"
                                                        class="form-control border-primary">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="facebook">@lang('Snapchat')</label>
                                                    <input type="url" name="snapchat"
                                                        value="{{ old('snapchat') }}" placeholder="@lang('Snapchat')"
                                                        id="userinput2" class="form-control border-primary">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="facebook">@lang('Instagram')</label>
                                                    <input type="url" name="instagram"
                                                        value="{{ old('instagram') }}" placeholder="@lang('Instagram')"
                                                        id="userinput25" class="form-control border-primary">
                                                </div>
                                            </div>
                                        </div>
                                    </div>





                                </div>



                                <div class="form-actions left">

                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> @lang('save')
                                    </button>
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
    </section>



    </div>
@endsection
@section('script')
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize"
        async defer></script>

    <script>
        $(document).ready(function() {

            $('#geogg').click();
            // setTimeout(function() {
             
            //         const latitudeField = document.getElementById("address-latitude");
            //         const longitudeField = document.getElementById("address-longitude");
            //         const address = document.getElementById("address-address");


            //     },
            //     100);

        });
    </script>

    <script type="text/javascript">
        function initGeolocation() {
            if (navigator.geolocation) {
                // Call getCurrentPosition with success and failure callbacks
                navigator.geolocation.getCurrentPosition(success, fail);
            } else {
                alert("Sorry, your browser does not support geolocation services.");
            }
        }

        function success(position) {
            
            document.getElementById('address-longitude').value = position.coords.longitude;
            document.getElementById('address-latitude').value = position.coords.latitude
        }

        function fail(position) {
            alert('f');
          alert(position.coords.longitude);
            // Could not obtain location
        }
    </script>
@endsection
