@extends('layouts.backend')
@section('content')
    <div class="content-body">
        <section id="configuration">
            <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h4 class="card-title">العاملات</h4>
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

                        <table class="table">
                            @if($natonality->count() > 0)
                            @foreach ($natonality as $item)

                          <thead class="thead-light">
                            <tr>
                                <th scope="col">  {{ $item->name }} : nationality </th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>  
                          
                          </thead>

                          <tbody>
                            <tr>
                                <th>image</th>
                                <th>name</th>
                                <th>number of visits</th>
                                <th>status</th>
                                <th>action</th>

                            </tr>
                            @foreach ($item->worker as $worker)

                            <tr>
                                <td><img src="{{ asset('uploads/'.$worker->image) }}" width="70" height="50" alt=""></td>
                                <td>{{ $worker->name }}</td>
                                <td>{{ $worker->visitor }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Action
                                        </button>
                                        <div class="dropdown-menu">
                                          <a class="dropdown-item" href="#">Action</a>
                                          <a class="dropdown-item" href="#">Another action</a>
                                          <a class="dropdown-item" href="#">Something else here</a>
                                          <div class="dropdown-divider"></div>
                                          <a class="dropdown-item" href="#">Separated link</a>
                                        </div>
                                      </div>
                                      
                                </td>
                                <td>
                                    <a href="{{ $worker->url_sand }}" target="_blank" class=""><i class="btn btn-info fa fa-eye"></i></a>
                                    <a href="{{ route('worker.edit',$worker->id) }}" class=""><i class="btn btn-success fa fa-edit"></i></a>
                                    <form action="{{ route('worker.destroy',$worker->id) }}" method="post" style="display: inline">
                                        @csrf @method('delete')
                                        <button style="border: 0" type="submit" class=""><i class="btn btn-danger  fa fa-trash"></i></button>

                                    </form>

                                </td>

                            </tr>
                           
                                
                            @endforeach
                          </tbody>

                          @endforeach 
                          @else
                          <th>
                          <h3>no data here</h3>
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
