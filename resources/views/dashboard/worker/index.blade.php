@extends('layouts.backend')
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

                            <div class="table-responsive">
                                @include('dashboard.parts._error')
                                @include('dashboard.parts._success')
                                <form action="" class="card-body">
                        
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="userinput2">@lang('Nationalities')</label>
                                                <select name="nationality_id" id="" class="form-control">

                                                    <option value="">@lang('Choose Natonality')</option>
                                                    @foreach ($all_nat as $item)
                                                    <option value="{{ $item->id }}" @if($request->nationality_id == $item->id  ) selected @endif>{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                          
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="userinput2">@lang('Status')</label>
                                                <select class="form-control" name="status" class="worker_status"  >
                                                    <option value="" class="btn  "   @if ($request->status == null) selected @endif
                                                       >
                                                        @lang('Choose')</option>
                                                        <option value="1" class="btn  btn-success"
                                                        @if ($request->status == 1) selected @endif>
                                                        @lang('available')</option>
                                                    <option value="0" class="btn btn-danger"
                                                        @if ($request->status == 0 &&  $request->status != null) selected @endif>@lang('busy')
                                                    </option>
                                                    <option value="2" class="btn btn-warning "
                                                        @if ($request->status == 2) selected @endif>@lang('in progress')</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-1 pt-1">
                                        <input type="submit" value="@lang('filter')" class="btn btn-info">
                                        </div>
            
                                    </div>
                                </form>
                                <table class="table">
                                    @if ($natonality->count() > 0)
                                        @foreach ($natonality as $item)
                                            <thead class="thead-light">
                                                <tr>
                                                    @if(get_lang() == 'en')
                                                    <th scope="col"> {{ $item->name }} : {{ __('Nationalitiy') }} </th>
                                                    @else
                                                    <th scope="col">  {{ __('Nationalitiy') }} : {{ $item->name }}  </th>

                                                    @endif
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    @if(auth()->user()->hasRole('Admin'))
                                                    <th></th>
                                                    @endif
                                                    <th></th>
                                                </tr>

                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <th>@lang('Image')</th>
                                                    <th>@lang('worker name')</th>
                                                    <th>@lang('number of visits')</th>
                                                    @if(auth()->user()->hasRole('Admin'))
                                                    <th>@lang('Company Name')</th>
                                                    @endif
                                                    <th>@lang('Status')</th>
                                                    <th>@lang('Action')</th>

                                                </tr>
                                                @if($request->status != null)

                                                @foreach ($item->worker->where('status',$request->status) as $worker)
                                                

                                                    <tr>
                                                        <td><img src="{{ asset('uploads/' . $worker->image) }}"
                                                                width="70" height="50" alt=""></td>
                                                        <td>{{ $worker->name }}</td>
                                                        <td>{{ $worker->visitor_count->count() }}</td>
                                                        @if(auth()->user()->hasRole('Admin'))
                                                        <td><a href="{{ route('companies.edit',@$worker->company->id) }}">{{ @$worker->company->name }}</a></td>
                                                        @endif
                                                        <td>
                                                            {{-- <label class="badge badge-{{ color($worker->status) }}">{{ worker_status($worker->status) }}</label> --}}
                                                            {{-- <label for="" class="btn btn-success"> --}}
                                                            <select class="target btn" id="worker_status_{{ $worker->id }}"
                                                                style="background:{{ get_color_new($worker->status) }} "
                                                                onchange="myFunction('{{ $worker->id }}')">
                                                                <option value="1" class="btn  btn-success"
                                                                    @if ($worker->status == 1) selected @endif>
                                                                    @lang('available')</option>
                                                                <option value="0" class="btn btn-danger"
                                                                    @if ($worker->status == 0) selected @endif>@lang('busy')
                                                                </option>
                                                                <option value="2" class="btn btn-warning "
                                                                    @if ($worker->status == 2) selected @endif>@lang('in progress')</option>
                                                            </select>


                                                            {{-- </label> --}}
                                                        </td>
                                                        <td>
                                                            <a href="{{ $worker->url_sand }}" target="_blank"
                                                                class=""><i class="btn btn-info fa fa-eye"></i></a>
                                                            <a href="{{ route('worker.edit', $worker->id) }}"
                                                                class=""><i
                                                                    class="btn btn-success fa fa-edit"></i></a>
                                                            <form action="{{ route('worker.destroy', $worker->id) }}"
                                                                method="post" style="display: inline">
                                                                @csrf @method('delete')
                                                                <button style="border: 0" type="submit" class=""><i
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
                                                        @if(auth()->user()->hasRole('Admin'))
                                                        <td><a href="{{ route('companies.edit',@$worker->company->id) }}">{{ @$worker->company->name }}</a></td>
                                                        @endif
                                                        <td>
                                                            {{-- <label class="badge badge-{{ color($worker->status) }}">{{ worker_status($worker->status) }}</label> --}}
                                                            {{-- <label for="" class="btn btn-success"> --}}
                                                            <select class="target btn" id="worker_status_{{ $worker->id }}"
                                                                style="background:{{ get_color_new($worker->status) }} "
                                                                onchange="myFunction('{{ $worker->id }}')">
                                                                <option value="1" class="btn  btn-success"
                                                                    @if ($worker->status == 1) selected @endif>
                                                                    @lang('available')</option>
                                                                <option value="0" class="btn btn-danger"
                                                                    @if ($worker->status == 0) selected @endif>@lang('busy')
                                                                </option>
                                                                <option value="2" class="btn btn-warning "
                                                                    @if ($worker->status == 2) selected @endif>@lang('in progress')</option>
                                                            </select>


                                                            {{-- </label> --}}
                                                        </td>
                                                        <td>
                                                            <a href="{{ $worker->url_sand }}" target="_blank"
                                                                class=""><i class="btn btn-info fa fa-eye"></i></a>
                                                            <a href="{{ route('worker.edit', $worker->id) }}"
                                                                class=""><i
                                                                    class="btn btn-success fa fa-edit"></i></a>
                                                            <form action="{{ route('worker.destroy', $worker->id) }}"
                                                                method="post" style="display: inline">
                                                                @csrf @method('delete')
                                                                <button style="border: 0" type="submit" class=""><i
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
@endsection

@section('script')
    <script>
            function myFunction(id){
                let status = $('#worker_status_'+id).val();
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
                            $('#worker_status_'+id).css("backgroundColor", "#5fc69e")
                        } else if (status == 0) {
                            $('#worker_status_'+id).css("backgroundColor", "#FF4961")
                        } else if (status == 2) {
                            $('#worker_status_'+id).css("backgroundColor", "#FF9149")
                        }
                        toastr.options.closeButton = true;
                        toastr.options.closeMethod = 'fadeOut';
                        toastr.options.closeDuration = 100;
                        toastr.success('{{ __('Updated successfully') }}');

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
@endsection
