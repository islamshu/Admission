@extends('layouts.backend')
@section('content')
    <div class="content-body">
        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Booking</h4>
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
                                @include('dashboard.parts._error')
                                @include('dashboard.parts._success')
                                
                                <table class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Customer name</th>
                                            <th>Customer numer id</th>
                                            <th>worker</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($booking as $key => $book)
                                        <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $book->name }}</td>
                                        <td>{{ $book->id_number }}</td>
                                        <td> <a target="_blank" href="{{ $book->worker->url_sand }}">{{ $book->worker->name }}</a></td>
                                      
                                     


                                        <td>
                                         <a href="{{ route('booking.show',$book->id) }}"><i class="fa fa-eye"></i></a>
                                        </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Customer name</th>
                                            <th>Customer numer id</th>
                                            <th>worker</th>
                                            <th>action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
        </section>

    </div>
@endsection
