@extends('layouts.backend')
@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        @php
            $worker = App\Worker::find($worker_id);
        @endphp
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title">@lang('show Booking unavliable for ')  {{ @$worker->name }} </h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('Home')</a>
                        </li>
                        <li class="breadcrumb-item active">@lang('show Booking unavliable for ')  {{ @$worker->name }} 
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
                            <h4 class="card-title">@lang('show Booking unavliable for ')  {{ @$worker->name }} </h4>
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
                                            <th>@lang('Phone')</th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($users as $key => $company)
                                        <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $company->phone }}</td>
                                       
                                        </tr>
                                        @endforeach
                                    </tbody>
                           
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          
        </section>

    </div>
@endsection
