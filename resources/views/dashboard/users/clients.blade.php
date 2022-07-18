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
                        <form action="" class="card-body">
                        
                            <div class="row">
                               
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="userinput2">@lang('Filter by orders')</label>
                                        <select class="form-control" name="order" class=""  >
                                            <option value="" class="  "   @if ($request->order == null) selected @endif
                                               >
                                                @lang('Choose')</option>
                                            <option value="yes" 
                                                @if ($request->order == 'yes') selected @endif>
                                                @lang('Has Order')</option>
                                                <option value="no" 
                                                @if ($request->order == 'no') selected @endif>
                                                @lang('No Order')</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-1 pt-1">
                                    <button type="submit" class="btn btn-info" ><i class="fa fa-filter" aria-hidden="true"></i></button>
                               
                                </div>
    
                            </div>
                        </form>
                        <div class="card-content collapse show">
                            @include('dashboard.parts._error')
                            @include('dashboard.parts._success')
                            <div class="card-body card-dashboard">
                              
                                <br>
                                <table class="table table-striped table-bordered zero-configuration">
                                    <a href="{{ route('client_create.create') }}" class="btn btn-info mb-2 ">
                                        @lang('Create Client')
                                    </a>
                                    <br>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>@lang('Phone')</th>
                                            <th>@lang('Name')</th>
                                            <th>@lang('Number Of order')</th>
                                            <th>@lang('Action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($clients as $key => $client)
                                        <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $client->phone }}</td>
                                        <td>{{ $client->name }}</td>
                                        @php
                                            $count = App\Booking::where('user_id',$client->id)->count() ;
                                        @endphp
                                        @if($count == 0)
                                        <td>{{ $count }}</td>
                                        @else
                                        <td> <a href="{{ route('booking_clinet',$client->id) }}">{{ $count }}</a></td>
                                       

                                        @endif
                                        <td><a href="{{ route('client_create.edit_client', $client->id) }}"
                                            class=""><i
                                                class="btn btn-success fa fa-edit"></i></a>
                                                <form action="{{ route('client_create.delete_client', $client->id) }}"
                                                    method="post" style="display: inline">
                                                    @csrf @method('delete')
                                                    <button style="border: 0" type="submit" class=""><i
                                                            class="btn btn-danger  fa fa-trash"></i></button></td>

                                                </form>
                                    
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
