@extends('layouts.backend')
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">@lang('Companies')</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('Home')</a>
                            </li>
                            <li class="breadcrumb-item active">@lang('Companies')
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">@lang('Companies')</h4>
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

                            <div class="card-body card-dashboard">
                                <a href="{{ route('companies.create') }}" class="btn btn-info mb-2 ">
                                    @lang('Create Company')
                                </a>
                                {{-- <button class="btn btn-info" data-toggle="modal" data-target="#myModalcreate"
                                            
                                           ><i class="fa fa-edit"></i></button> --}}

                                <br>
                                @include('dashboard.parts._error')
                                @include('dashboard.parts._success')

                                <table class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>@lang('Company Name')</th>
                                            <th>@lang('Email')</th>
                                            <th>@lang('Phone')</th>
                                            <th>@lang('Is verify')</th>
                                            <th>@lang('Status')</th>
                                            <th>@lang('Action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($companies as $key => $company)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $company->name }}</td>
                                                <td>{{ $company->email }}</td>
                                                <td>{{ $company->phone }}</td>
                                                <td>
                                                    @if (@$company->user->verify == 1)
                                                        <label class="badge badge-success">@lang('Verify')</label>
                                                    @else
                                                        <label class="badge badge-danger">@lang('Not Verify') </label>
                                                    @endif

                                                </td>
                                                <td>
                                                    <input type="checkbox" data-id="{{ $company->id }}" name="status"
                                                        class="js-switch" {{ $company->status == 1 ? 'checked' : '' }}>
                                                </td>



                                                <td>
                                                    <button class="btn btn-info" data-toggle="modal" data-target="#myModal"
                                                        onclick="make('{{ $company->id }}')"><i
                                                            class="fa fa-edit"></i></button>

                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['companies.destroy', $company->id], 'style' => 'display:inline']) !!}
                                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                  
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fase " id="myModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">

                            <h5 class="modal-title" id="staticBackdropLabel">
                                {{ __('Edit Company') }}</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div id="company_edit">
                            <div class="c-preloader text-center p-3">
                                <i class="las la-spinner la-spin la-3x"></i>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                            <button type="button" class="btn ok">Ok</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="modal fase " id="myModalcreate" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 class="modal-title" id="staticBackdropLabel">
                            {{ __('Create Company') }}</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="company_edit">
                        <form class="form" method="post" action="{{ route('companies.store_admin') }}"
                        enctype="multipart/form-data">
                        <div class="card-body">

                            @csrf
                            <div class="form-body">
                                <h4 class="form-section"><i class="la la-add"></i>Company Info</h4>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Image </label> <span style="color: red">*</span>
                                        <input type="file" name="image" required class="form-control image">
                                    </div>

                                    <div class="form-group">
                                        <img src="{{ asset('uploads/product_images/default.png') }}"
                                            style="width: 100px" class="img-thumbnail image-preview" alt="">
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Name</label><span style="color: red">*</span>
                                        <input type="text" id="form3" value="{{ old('name') }}" required
                                            name="name" class="form-control validate">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Email</label><span style="color: red">*</span>
                                        <input type="email" id="form3" value="{{ old('email') }}" required
                                            name="email" class="form-control validate">
                                    </div>


                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Phone</label><span style="color: red">*</span>
                                        <input type="text" id="form3" value="{{ old('phone') }}" required
                                            name="phone" class="form-control validate">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Commical Register</label><span style="color: red">*</span>
                                        <input type="number" id="form3"
                                            value="{{ old('commercial_register') }}" required
                                            name="commercial_register" class="form-control validate">
                                    </div>


                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Longitude</label>
                                        <input type="text" id="form3" value="{{ old('longitude') }}"
                                            placeholder="Longitude" name="longitude" class="form-control validate">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Latitude</label>
                                        <input type="text" id="form3" value="{{ old('latitude') }}"
                                            placeholder="Latitude" name="latitude" class="form-control validate">
                                    </div>


                                </div>
                                <br>

                                <h4 class="form-section"><i class="la la-add"></i>Social media</h4>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="userinput2">Facebook</label>
                                            <input type="url" name="facebook" value="{{ old('faceook') }}"
                                                placeholder="Facebook" id="userinput2"
                                                class="form-control border-primary">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="userinput2">Twitter</label>
                                            <input type="url" name="twitter" value="{{ old('twitter') }}"
                                                placeholder="Twitter" id="userinput2"
                                                class="form-control border-primary">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="facebook">Snapchat</label>
                                            <input type="url" name="snapchat"
                                                value="{{ old('snapchat') }}" placeholder="Snapchat"
                                                id="userinput2" class="form-control border-primary">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="facebook">Instagram</label>
                                            <input type="url" name="instagram"
                                                value="{{ old('instagram') }}" placeholder="Instagram"
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
                            </button>
                        </div>


                    </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="button" class="btn ok">Ok</button>
                    </div>
                </div>
            </div>
        </div> --}}
        </section>

    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('.js-switch').change(function() {
                let status = $(this).prop('checked') === true ? 1 : 0;
                let CompanyId = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('comapny.update.status') }}',
                    data: {
                        'status': status,
                        'company_id': CompanyId
                    },
                    success: function(data) {
                    toastr.options.closeButton = true;
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.options.closeDuration = 100;
                    toastr.success('{{ __('Status updated Successfully') }}');
                    }
                });
            });
        });
    </script>
    <script>
        function make(id) {
            $("#myModal").show();

            // $('#staticBackdrop').modal();
            $('.c-preloader').show();

            $.ajax({
                type: 'post',
                url: "{{ route('get_compnay_edit') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': id
                },
                beforeSend: function() {},
                success: function(data) {
                    $('#company_edit').html(data);


                }
            });

        }
    </script>
@endsection
