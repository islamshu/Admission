@extends('layouts.backend')
@section('css')
    <style>
        .dtHorizontalExampleWrapper {
  max-width: 600px;
  margin: 0 auto;
}
#dtHorizontalExample th, td {
  white-space: nowrap;
}

table.dataTable thead .sorting:after,
table.dataTable thead .sorting:before,
table.dataTable thead .sorting_asc:after,
table.dataTable thead .sorting_asc:before,
table.dataTable thead .sorting_asc_disabled:after,
table.dataTable thead .sorting_asc_disabled:before,
table.dataTable thead .sorting_desc:after,
table.dataTable thead .sorting_desc:before,
table.dataTable thead .sorting_desc_disabled:after,
table.dataTable thead .sorting_desc_disabled:before {
 bottom: .5em;
}
    </style>
@endsection
@section('content')
@if((request()->is('dashbaord/booking_company*')))

<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title">@lang('Booking for') {{ $company->name }}</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('Home')</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('booking.get') }}">@lang('Booking')</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $company->name }} @lang('Booking')
                        </li>
                    </ol>
                </div>
            </div>
        </div>

    </div>

</div>
@else
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title">@lang('Booking') </h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('Home')</a>
                        </li>
                        <li class="breadcrumb-item active">@lang('Booking')
                        </li>
                       
                    </ol>
                </div>
            </div>
        </div>

    </div>

</div>
@endif
    <div class="content-body">
        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">@lang('Booking')</h4>
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
                        <form action="" class="card-body">
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="userinput2">@lang('Created at')</label>
                                    <input type="date" value="{{ $request->date }}" name="date" class="form-control">
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
                                            @lang('Done')</option>
                                        <option value="0" class="btn btn-danger"
                                            @if ($request->status == 0 && $request->status != null) selected @endif>@lang('Reject')
                                        </option>
                                        <option value="2" class="btn btn-warning "
                                            @if ($request->status == 2) selected @endif>@lang('in progress order')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 mt-1 pt-1">
                                <button type="submit" class="btn btn-info" ><i class="fa fa-filter" aria-hidden="true"></i></button>
                                @if(!(request()->is('dashbaord/booking_clinet*')))

                                <a style="margin-right: 30%;" class="btn btn-info" target="_blank" href="{{ route('booking.export',['status'=>$request->status , 'nationality_id'=>$request->nationality_id]) }}"><i class="fa fa-print"></i></a>
                                <a style="margin-ri%;" class="btn btn-info" target="_blank" href="{{ route('pdf_booking',['status'=>$request->status , 'date'=>$request->date]) }}"><i class="fa fa-file"></i></a>
                                @endif
                            </div>

                        </div>
                    </form>
                        <div class="card-content collapse show">
                          
                            <div class="card-body card-dashboard">
                              
                                <br>
                                @include('dashboard.parts._error')
                                @include('dashboard.parts._success')
                                <div class="table-responsive">

                                
                                <table id="dtHorizontalExample" class="table table-striped table-bordered table-sm" cellspacing="0"
                                width="100%">  
                                    <thead>
                                        <tr>
                                            {{-- <th>#</th> --}}
                                            <th> @lang('Visa Number new')</th>
                                            <th>@lang('Order ID')</th>
                                            <th>@lang('Customer name')</th>
                                            <th>@lang('worker name')</th>
                                            <th>@lang('Phone')</th>
                                            <th>@lang('Date Of Birth')</th>
                                            <th>@lang('Created at')</th>
                                            <th>@lang('Status')</th>
                                            <th>@lang('Action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($booking as $key => $book)
                                        <tr>
                                        <td>{{ $book->visa_number}}</td>
                                        <td>{{ $book->order_id }}</td>
                                        <td>{{ @$book->user->name }}</td>

                                        <td> <a >{{ $book->worker->name }}</a></td>                  

                                        <td>{{ @$book->user->phone }}</td>
                                        <td>{{ $book->DOB }}</td>
                                        <td>{{ $book->created_at->format('Y-m-d') }}</td>

                                       <td>
                                            {{-- <label class="badge badge-{{ color($worker->status) }}">{{ worker_status($worker->status) }}</label> --}}
                                            {{-- <label for="" class="btn btn-success"> --}}
                                            <select class="target btn" book_id="{{ $book->id }}" class="worker_status" id="worker_status_{{ $book->id }}" onchange="myFunction('{{ $book->id }}')"
                                                style="background:{{ get_color_new($book->status) }} "
                                                data-id="{{ $book->id }}">
                                                <option value="1" class="btn  btn-success"
                                                    @if ($book->status == 1) selected @endif>
                                                    @lang('Done')</option>
                                                <option value="0" class="btn btn-danger"
                                                    @if ($book->status == 0) selected @endif>@lang('Reject')
                                                </option>
                                                <option value="2" class="btn btn-warning "
                                                    @if ($book->status == 2) selected @endif>@lang('in progress order')</option>
                                            </select>


                                            {{-- </label> --}}
                                        </td>
                                     


                                        <td>
                                         <a href="{{ route('booking.show',$book->id) }}" target="_blank" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                         <a href="{{ route('pdf_view',$book->id) }}" target="_blank" class="btn btn-info"><i class="fa fa-file"></i></a>

                                        </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    {{-- <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Customer name</th>
                                            <th>Customer numer id</th>
                                            <th>worker's name</th>
                                            <th>action</th>
                                        </tr>
                                    </tfoot> --}}
                                </table>
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
    <script>
//          table.destroy();

// $('#booking').DataTable({
//     scrollX: true,
// });


        function myFunction(id){
            // alert('worker_status_'+id);
            // alert($('#worker_status_'+id).val());
            
            let status = $('#worker_status_'+id).val();
            
            let booked_id =id;
            $.ajax({
                type: 'post',
                url: "{{ route('update_status_booked') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'status': status,
                    'booked_id': booked_id,
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
        // $(".worker_status").change(function() {
        //     let status = $(".worker_status option:selected").val();
        //     let booked_id = $(this).data('id');
        //     $.ajax({
        //         type: 'post',
        //         url: "{{ route('update_status_booked') }}",
        //         data: {
        //             "_token": "{{ csrf_token() }}",
        //             'status': status,
        //             'booked_id': booked_id,
        //         },
        //         beforeSend: function() {},
        //         success: function(data) {
        //             if (data['status'] == true) {
        //                 if (status == 1) {
        //                     $('.worker_status').css("backgroundColor", "#5fc69e")
        //                 } else if (status == 0) {
        //                     $('.worker_status').css("backgroundColor", "#FF4961")
        //                 } else if (status == 2) {
        //                     $('.worker_status').css("backgroundColor", "#FF9149")
        //                 }
        //                 toastr.options.closeButton = true;
        //                 toastr.options.closeMethod = 'fadeOut';
        //                 toastr.options.closeDuration = 100;
        //                 toastr.success('{{ __('Updated successfully') }}');

        //             } else {
        //                 alert('Whoops Something went wrong!!');
        //             }
        //         }
        //     });
        // });

     
    </script>
@endsection
