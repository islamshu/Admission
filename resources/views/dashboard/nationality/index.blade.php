@extends('layouts.backend')
@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title">@lang('Nationalities')</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('Home')</a>
                        </li>
                        {{-- <li class="breadcrumb-item"><a href="{{ route('worker.index') }}">Workers</a>
                        </li> --}}
                        <li class="breadcrumb-item active">@lang('Nationalities')
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
                            <h4 class="card-title">@lang('Nationalities')</h4>
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
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                    @lang('Create nationalitiy')
                                  </button>
                                
                                <br>
                                <br>
                                @include('dashboard.parts._error')
                                @include('dashboard.parts._success')
                                <table class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>@lang('flag')</th>
                                            <th>@lang('Name')</th>
                                            <th>@lang('Action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($natis as $key => $na)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td><img src="{{ asset('uploads/'.$na->flag) }}" width="80" height="50" alt=""></td>
                                                <td>{{ $na->name }}</td>
                                                <td>
                                                    <button class="btn btn-info" data-toggle="modal" data-target="#myModal"
                                                        onclick="make('{{ $na->id }}')"><i
                                                            class="fa fa-edit"></i></button>
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['nationalities.destroy', $na->id], 'style' => 'display:inline']) !!}
                                                    {!! Form::submit(trans('delete'), ['class' => 'btn btn-danger']) !!}
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    {{-- <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Flag</th>

                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot> --}}
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="modal fase" id="myModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 class="modal-title" id="staticBackdropLabel">
                            {{ __('Edit Nationalitiy') }}</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="natonality">
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
        </div> --}}
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h4 class="modal-title w-100 font-weight-bold">{{ __('Edit Nationalitiy') }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div id="natonality">
                            <div class="c-preloader text-center p-3">
                                <i class="las la-spinner la-spin la-3x"></i>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100 font-weight-bold">{{ __('Create nationalitiy') }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="natonality">
                        <form action="{{ route('nationalities.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                          
                            <div class="modal-body mx-3">
                              <div class="md-form mb-2">
                               <label data-error="wrong" data-success="right" for="form3">@lang('Flag')</label>
                               <input type="file" id="form3" name="flag"  class="form-control image">
                              </div>
                              <div class="form-group">
                                <img src="{{ asset('uploads/product_images/default.png') }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                            </div>
                        
                              
                        
                            </div>
                            <div class="modal-body mx-3">
                                <div class="md-form mb-2">
                                 <label data-error="wrong" data-success="right" for="form3">@lang('Arabic Name')</label>
                                 <input type="text" id="form3" name="name_ar"  class="form-control validate">
                                </div>
                        
                                <div class="md-form mb-2">
                                 <label data-error="wrong" data-success="right" for="form2">@lang('English Name')</label>
                                 <input type="text" id="form2" name="name_en"  class="form-control validate">
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


        </section>

    </div>
@endsection

@section('script')
    <script>
        function make(id) {
            $("#myModal").show();

            // $('#staticBackdrop').modal();
            $('.c-preloader').show();

            $.ajax({
                type: 'post',
                url: "{{ route('get_natonlity_edit') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': id
                },
                beforeSend: function() {},
                success: function(data) {
                    $('#natonality').html(data);


                }
            });

        }
        
    </script>
    <script>
                        
        $(".image").change(function () {
                
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
            
                    reader.onload = function (e) {
                        $('.image-preview').attr('src', e.target.result);
                    }
            
                    reader.readAsDataURL(this.files[0]);
                }
            
            });
        </script>
@endsection
