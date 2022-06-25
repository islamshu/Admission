@extends('layouts.backend')
@section('content')
    <div class="content-body">
        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Companies</h4>
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
                                {{-- <a href="{{ route('companies.create') }}" class="btn btn-info mb-2 ">
                                    Create Company
                                </a> --}}
                                <br>
                                @include('dashboard.parts._error')
                                @include('dashboard.parts._success')
                                
                                <table class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>is verify</th>
                                            <th>Status</th>
                                            <th>Action</th>
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
                                            @if(@$company->user->verify == 1)
                                            <label class="badge badge-success">Verify</label>
                                            @else
                                            <label class="badge badge-danger">Not Verify </label>
                                            @endif

                                           </td>
                                        <td>
                                            <input type="checkbox" data-id="{{ $company->id }}" name="status" class="js-switch" {{ $company->status == 1 ? 'checked' : '' }}>
                                        </td>



                                        <td>
                                            <button class="btn btn-info" data-toggle="modal" data-target="#myModal"
                                            
                                            onclick="make('{{ $company->id }}')"><i class="fa fa-edit"></i></button>
                                       
                                        {!! Form::open(['method' => 'DELETE','route' => ['companies.destroy', $company->id],'style'=>'display:inline']) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                        </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>is verify</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
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
        </section>

    </div>
@endsection
@section('script')
<script>
$(document).ready(function(){
    $('.js-switch').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let CompanyId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('comapny.update.status') }}',
            data: {'status': status, 'company_id': CompanyId},
            success: function (data) {
                console.log(data.message);
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