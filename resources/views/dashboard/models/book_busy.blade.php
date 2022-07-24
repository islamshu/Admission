<div class="modal fase " id="all_booking_busy" data-backdrop="static" data-keyboard="false" tabindex="-1"
aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">

            <h5 class="modal-title" id="staticBackdropLabel">
                {{ __('Booking') }}</h5>



            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
        <div id="company_edit">
            <div class=" text-center ">

                <table class="table table-striped table-bordered zero-configuration">
                    <thead>
                        <tr>
                            <th>@lang('Order ID')</th>
                            <th>@lang('Customer name')</th>
                            {{-- <th>@lang('Customer number id')</th> --}}
                            <th>@lang('worker name')</th>
                            <th>@lang('Created at')</th>
                            <th>@lang('Status')</th>



                        </tr>
                    </thead>
                    <tbody>
                      @if(auth()->user()->hasRole('Admin'))

                        @php
                            $companies = App\Booking::where('status',0)->orderBy('id', 'DESC')->take(10)->get();
                        @endphp
                        @else
                        @php
                            $companies = App\Booking::where('status',0)->where('company_id',auth()->user()->company->id)->orderBy('id', 'DESC')->take(10)->get();
                        @endphp
                        @endif


                        @foreach ($companies as $key => $worker)
                            <tr>
                                <td>{{ $book->order_id }}</td>
                                <td>{{ $book->name }}</td>
                                {{-- <td>{{ $book->id_number }}</td> --}}
                                <td> <a >{{ @$book->worker->name }}</a></td>
                                <td>{{ $book->created_at->format('Y-m-d') }}</td>
                                <td>
                                  <label style="width: 68px"
                                      class="badge badge-{{ color($worker->status) }}">{{ booking_status($worker->status) }}</label>
                                </td>
                                  {{-- <label for="" class="btn btn-success"> --}}





                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
        <div class="modal-footer">
            <a href="{{ route('booking.get_all_booking',['status'=>0]) }}" class="btn btn-info">
                @lang('Show All')
            </a>
        </div>

    </div>
</div>
</div>