@extends('layouts.backend')
@section('content')
    <div class="content-body">
        <section id="configuration">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="basic-layout-colored-form-control">Edit user  </h4>
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
                            <div class="card-body">
                                @include('dashboard.parts._error')
                                @include('dashboard.parts._success')
    
                                <form class="form" method="post"
                                    action="{{ route('users.update',$user->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Name</label>
                                                <input type="text" name="name" class="form-control" required value="{{ $user->name }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Email </label>
                                                <input type="email" name="email" class="form-control" required value="{{ $user->email }}">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Phone</label>
                                                <input type="tel" name="phone" class="form-control" required value="{{ $user->phone }}">
                                            </div>
                                          
                                        </div>
                                        <br>
                                      
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Password</label>
                                                <input type="password" name="password" class="form-control"  value="">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Confirm Password</label>
                                                <input type="password" name="confirm-password" class="form-control"  value="">
                                            </div>
                                          
                                        </div>
                                        <br>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Roles</label>
                                                    {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','')) !!}

                                            </div>
                                            
                                          
                                        </div>
                                        
                                    </div>
                                   
    
    
                                    <div class="form-actions left">

                                        <button type="submit" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i> {{ __('حفظ') }}
                                        </button>
                                    </div>
    
    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
    </div>
    </section>

    </div>
@endsection
