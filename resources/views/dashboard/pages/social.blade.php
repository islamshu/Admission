@extends('layouts.backend')
@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title">Social media</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Social media
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="basic-layout-colored-form-control">Social media  </h4>
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
    
                                <form method="post" action="{{ route('social_info_post',app()->getLocale()) }}">
                                    @csrf
                                    @if ($errors->any())
                                    <div class="alert alert-danger" role="alert">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    @if (session()->has('message'))
                                    <div class="alert {{session()->get('status')}} alert-dismissible fade show" role="alert">
                                        <span> {{ session()->get('message') }}<span>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                    </div>
                                    @endif
                                    <div class="card-body">
                                        <div class="row">
                            
                                            <div class="form-group col-md-6">
                            
                                                <div class="form-group">
                                                    <label for="exampleSelectd">{{ __('Email') }}</label>
                                                    <input type="text" name="general[email]" value="{{ get_social('email') }}" class="form-control" id="name_ar">
                                                 
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleSelectd">{{ __('Phone') }}</label>
                                                    <input type="text" name="general[phone]" value="{{ get_social('phone') }}" class="form-control" id="name_en">
                                                 
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleSelectd">{{ __('facebook') }}</label>
                                                    <input  name="general[facebook]" value="{{ get_social('facebook') }}" class="form-control" id="order">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleSelectd">{{ __('twitter') }}</label>
                                                    <input  name="general[twitter]" value="{{ get_social('twitter') }}" class="form-control" id="order">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleSelectd">{{ __('Instagram') }}</label>
                                                    <input  name="general[Instagram]" value="{{ get_social('Instagram') }}" class="form-control" id="order">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleSelectd">{{ __('YouTube') }}</label>
                                                    <input  name="general[YouTube]" value="{{ get_social('YouTube') }}" class="form-control" id="order">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleSelectd">{{ __('WhatsApp') }}</label>
                                                    <input  name="general[WhatsApp]" value="{{ get_social('WhatsApp') }}" class="form-control" id="order">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleSelectd">{{ __('Website') }}</label>
                                                    <input  name="general[Website]" value="{{ get_social('Website') }}" class="form-control" id="order">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleSelectd">{{ __('Telegram') }}</label>
                                                    <input  name="general[Telegram]" value="{{ get_social('Telegram') }}" class="form-control" id="order">
                                                </div>
                                            
                                            </div>
                                            
                                        </div>
                            
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" onclick="performStore()" class="btn btn-primary mr-2">{{ __('Submit') }}</button>
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

