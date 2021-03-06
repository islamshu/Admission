@extends('layouts.backend')
@section('css')
    <style>
        .no_style {
            background: white !important;
            color: black !important
        }

        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
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
                            {{-- <li class="breadcrumb-item"><a href="{{ route('worker.create') }}">Workers</a>
                        </li> --}}
                            <li class="breadcrumb-item active">@lang('Workers')
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
                            <h4 class="card-title">@lang('Workers')</h4>
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
                            <a href="{{ route('worker.create') }}" class="btn btn-info mb-2 ">
                                @lang('Create Worker')
                            </a>
                            <div class="">
                                @include('dashboard.parts._error')
                                @include('dashboard.parts._success')
                                <form style="display: inline" action="" class="card-body">

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="userinput2">@lang('Nationalities')</label>
                                                <select name="nationality_id" id="" class="form-control">

                                                    <option value="">@lang('Choose Natonality')</option>
                                                    @foreach ($all_nat as $item)
                                                        <option value="{{ $item->id }}"
                                                            @if ($request->nationality_id == $item->id) selected @endif>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="userinput2">@lang('Status')</label>
                                                <select class="form-control" name="status" class="worker_status">
                                                    <option value="" class="btn  "
                                                        @if ($request->status == null) selected @endif>
                                                        @lang('Choose')</option>
                                                    <option value="1" class="btn  btn-success"
                                                        @if ($request->status == 1) selected @endif>
                                                        @lang('available')</option>
                                                    <option value="0" class="btn btn-danger"
                                                        @if ($request->status == 0 && $request->status != null) selected @endif>@lang('busy')
                                                    </option>
                                                    <option value="2" class="btn btn-warning "
                                                        @if ($request->status == 2) selected @endif>@lang('in progress')
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-1 pt-1">
                                            <button type="submit" class="btn btn-info"><i class="fa fa-filter"
                                                    aria-hidden="true"></i></button>
                                            <a style="margin-right: 30%;" class="btn btn-info" target="_blank"
                                                href="{{ route('export', ['status' => $request->status, 'nationality_id' => $request->nationality_id]) }}"><i
                                                    class="fa fa-print"></i></a>
                                            <a style="margin-ri%;" class="btn btn-info" target="_blank"
                                                href="{{ route('pdf', ['status' => $request->status, 'nationality_id' => $request->nationality_id]) }}"><i
                                                    class="fa fa-file"></i></a>
                                        </div>

                                    </div>
                                </form>

                                <table class="table">
                                    @if ($natonality->count() > 0)
                                        @foreach ($natonality as $item)
                                            <thead class="thead-light">
                                                <tr>
                                                    @if (get_lang() == 'en')
                                                        <th scope="col"> {{ $item->name }} : {{ __('Nationalitiy') }}
                                                        </th>
                                                    @else
                                                        <th scope="col"> {{ __('Nationalitiy') }} : {{ $item->name }}
                                                        </th>
                                                    @endif
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    @if (auth()->user()->hasRole('Admin'))
                                                        <th></th>
                                                        <th></th>
                                                    @endif
                                                    <th></th>
                                                </tr>

                                            </thead>

                                            <thead>
                                                <tr>
                                                    <th>@lang('Image')</th>
                                                    <th>@lang('worker name')</th>
                                                    <th>@lang('number of visits')</th>
                                                    @if (auth()->user()->hasRole('Admin'))
                                                        <th>@lang('Company Name')</th>
                                                    @endif
                                                    <th>@lang('is show')</th>
                                                    <th>@lang('Status')</th>
                                                    <th>@lang('Action')</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @if ($request->status != null)
                                                    @foreach ($item->worker->where('status', $request->status) as $worker)
                                                        <tr>
                                                            <td><img src="{{ asset('uploads/' . $worker->image) }}"
                                                                    width="70" height="50" alt=""></td>
                                                            <td>{{ $worker->name }}</td>
                                                            <td>{{ $worker->visitor_count->count() }}</td>
                                                            @if (auth()->user()->hasRole('Admin'))
                                                                <td><a
                                                                        href="{{ route('companies.edit', @$worker->company->id) }}">{{ @$worker->company->name }}</a>
                                                                </td>
                                                            @endif
                                                            <td>
                                                                <input type="checkbox" data-id="{{ $worker->id }}"
                                                                    name="status" class="js-switch"
                                                                    {{ $worker->is_show == 1 ? 'checked' : '' }}>
                                                            </td>
                                                            <td>
                                                                {{-- <label class="badge badge-{{ color($worker->status) }}">{{ worker_status($worker) }}</label> --}}
                                                                {{-- <label for="" class="btn btn-success"> --}}
                                                                <select class="target btn"
                                                                    id="worker_status_{{ $worker->id }}"
                                                                    style="background:{{ get_color_new($worker->status) }} "
                                                                    onchange="myFunction('{{ $worker->id }}')">
                                                                    <option value="1" class="btn  btn-success"
                                                                        @if ($worker->status == 1) selected @endif>
                                                                        @lang('available')</option>
                                                                    <option value="0" class="btn btn-danger"
                                                                        @if ($worker->status == 0) selected @endif>
                                                                        @lang('busy')
                                                                    </option>
                                                                    <option value="2" class="btn btn-warning "
                                                                        @if ($worker->status == 2) selected @endif>
                                                                        @lang('in progress')</option>
                                                                </select>


                                                                {{-- </label> --}}
                                                            </td>
                                                            <td>

                                                                <a href="{{ route('worker.edit', $worker->id) }}"
                                                                    class=""><i
                                                                        class="btn btn-success fa fa-edit"></i></a>

                                                                <form action="{{ route('worker.destroy', $worker->id) }}"
                                                                    method="post" style="display: inline">
                                                                    @csrf @method('delete')
                                                                    <button style="border: 0" type="submit"
                                                                        class=""><i
                                                                            class="btn btn-danger  fa fa-trash"></i></button>

                                                                </form>

                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                @else
                                                    @foreach ($item->worker as $worker)
                                                        <tr>
                                                            <td><img src="{{ asset('uploads/' . $worker->image) }}"
                                                                    width="70" height="50" alt=""></td>
                                                            <td>{{ $worker->name }}</td>
                                                            <td>{{ $worker->visitor_count->count() }}</td>
                                                            @if (auth()->user()->hasRole('Admin'))
                                                                <td><a
                                                                        href="{{ route('companies.edit', @$worker->company->id) }}">{{ @$worker->company->name }}</a>
                                                                </td>
                                                            @endif
                                                            <td>
                                                                <input type="checkbox" data-id="{{ $worker->id }}"
                                                                    name="status" class="js-switch"
                                                                    {{ $worker->is_show == 1 ? 'checked' : '' }}>
                                                            </td>
                                                            <td>
                                                                {{-- <label class="badge badge-{{ color($worker->status) }}">{{ worker_status($worker) }}</label> --}}
                                                                {{-- <label for="" class="btn btn-success"> --}}
                                                                <select
                                                                    class="target btn
                                                            @if (worker_status_id_new($worker) == 2) btn-warning
                                                            @elseif(worker_status_id_new($worker) == 1) 
                                                            btn-success
                                                            
                                                            @elseif(worker_status_id_new($worker) == 0)
                                                            btn-danger @endif

                                                            
                                                            
                                                            "
                                                                    id="worker_status_{{ $worker->id }}"
                                                                    onchange="myFunction('{{ $worker->id }}')">
                                                                    <option value="1" class="no_style"
                                                                        @if (worker_status_id_new($worker) == 1) selected @endif>
                                                                        @lang('?????????? ??????????')</option>
                                                                    <option value="0" class="no_style"
                                                                        @if (worker_status_id_new($worker) == 0) selected @endif>
                                                                        @lang('?????? ??????????')
                                                                    </option>
                                                                    <option value="2" class="no_style"
                                                                        @if (worker_status_id_new($worker) == 2) selected @endif>
                                                                        @lang('?????? ?????????????? ??????????')</option>
                                                                </select>


                                                                {{-- </label> --}}
                                                            </td>
                                                            <td>

                                                                <a href="{{ route('worker.edit', $worker->id) }}"
                                                                    class=""><i
                                                                        class="btn btn-success fa fa-edit"></i></a>
                                                                <a href="{{ route('get_one_pdf', $worker->id) }}"
                                                                    class=""><i
                                                                        class="btn btn-info fa fa-file"></i></a>
                                                                <form action="{{ route('worker.destroy', $worker->id) }}"
                                                                    method="post" style="display: inline">
                                                                    @csrf @method('delete')
                                                                    <button style="border: 0" type="submit"
                                                                        class=""><i
                                                                            class="btn btn-danger  fa fa-trash"></i></button>

                                                                </form>

                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                @endif


                                            </tbody>
                                        @endforeach
                                    @else
                                        <th>
                                            <h3>@lang('no data here')</h3>
                                        </th>
                                    @endif
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
        </section>

    </div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#theModal">Open Modal</button>
    </div>
    <div class="modal fade" role="dialog" id="theModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">?????? ???????????? ?????????????? ???????????????? ??????????????</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('update_month_worker') }}" method="get" id="myForm">
                        <input name="worker_id" type="number" hidden value="" id="worker_id_modal">
                        <label>@lang('Duration')</label>
                        <select required="time" id="time_month" class="form-control">
                            <option value="">@lang('Choose')</option>
                            <option value="1" @if (old('time') == 1) selected @endif>1 @lang('months')
                            </option>
                            <option value="2" @if (old('time') == 2) selected @endif>2 @lang('months')
                            </option>
                            <option value="3" @if (old('time') == 3) selected @endif>3 @lang('months')
                            </option>

                        </select>

                </div>

                <div class="modal-footer">
                    <button type="button" id="submitBtn" class="btn btn-info">{{ __('send') }}</button>
                </div>
                </form>

            </div>
        </div>
    @endsection

    @section('script')
        <script>
            $(document).ready(function() {
                $("#submitBtn").click(function() {
                    let worker_id = $('#worker_id_modal').val();
                    let time = $('#time_month').val();
                    $.ajax({
                    type: 'post',
                    url: "{{ route('update_month_worker') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'worker_id': worker_id,
                        'time': time,
                    },
                    beforeSend: function() {},
                    success: function(data) {
                        $('#worker_id_modal').val('');
                        $('#time_month').val('');
                        $("#theModal").modal("hide");

                    }
                });

                });
            });

            function myFunction(id) {
                let status = $('#worker_status_' + id).val();
                $('#worker_id_modal').val(id);

                let worker_id = id;
                $.ajax({
                    type: 'post',
                    url: "{{ route('update_status_worker') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'status': status,
                        'worker_id': worker_id,
                    },
                    beforeSend: function() {},
                    success: function(data) {
                        if (data['status'] == true) {
                            if (status == 1) {
                                $('#worker_status_' + id).attr('style', 'background: #28D094 !important');


                            } else if (status == 0) {
                                $('#worker_status_' + id).attr('style', 'background: #FF394F !important');

                            } else if (status == 2) {
                                $('#worker_status_' + id).attr('style', 'background: #FF7216 !important');

                            }

                            toastr.options.closeButton = true;
                            toastr.options.closeMethod = 'fadeOut';
                            toastr.options.closeDuration = 100;
                            toastr.success('{{ __('Updated successfully') }}');
                            if (status == 2) {
                                $("#theModal").modal("show");
                            }

                        } else {
                            alert('Whoops Something went wrong!!');
                        }
                    }
                });
            }

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
            $(document).ready(function() {
                $('.js-switch').change(function() {
                    let status = $(this).prop('checked') === true ? 1 : 0;
                    let workerid = $(this).data('id');
                    $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: '{{ route('worker.update.status') }}',
                        data: {
                            'status': status,
                            'worker_id': workerid
                        },
                        success: function(data) {
                            toastr.options.closeButton = true;
                            toastr.options.closeMethod = 'fadeOut';
                            toastr.options.closeDuration = 100;
                            toastr.success(data.message);
                        }
                    });
                });
            });
        </script>
    @endsection
