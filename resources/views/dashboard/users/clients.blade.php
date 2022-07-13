@extends('layouts.backend')
@section('content')
    <div class="content-body">
        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('clients') }}</h4>
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
                              
                                <br>
                                <table class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>@lang('Phone')</th>
                                            <th>@lang('Number Of order')</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($clients as $key => $client)
                                        <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $client->phone }}</td>
                                        @php
                                            $count = App\Booking::where('user_id',$client->id)->count() ;
                                        @endphp
                                        @if($count == 0)
                                        <td>{{ $count }}</td>
                                        @else
                                        <td> <a href="{{ route('booking_clinet',$client->id) }}">{{ $count }}</a></td>

                                        @endif

                                    
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                    {{-- <tfoot>
                                        <tr>
                                            <th>#</th>
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
        </section>

    </div>
@endsection
