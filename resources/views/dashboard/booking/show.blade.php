@extends('layouts.backend')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">@lang('Booking Info')</h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('Home')</a>
            </li>
           
            <li class="breadcrumb-item active">@lang('Booking Info')
            </li>
          </ol>
        </div>
      </div>
    </div>

  </div>
<section id="basic-form-layouts">
    <div class="row match-height">

      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title" id="basic-layout-colored-form-control">@lang('Booking Info')</h4>
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

              <form class="form"  enctype="multipart/form-data">
                @csrf

                <div class="form-body">
                    <h4 class="form-section"><i class="la la-add"></i>@lang('Customer Info') </h4>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="userinput1">@lang('Name')</label>
                                <input type="text" value="{{ $booking->name}}" readonly id="userinput1" class="form-control border-primary" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="userinput1">@lang('Date Of Birth')</label>
                                <input type="text" value="{{ $booking->DOB}}" readonly id="userinput1" class="form-control border-primary" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="userinput1">@lang('ID Number')</label>
                                <input type="text" value="{{ $booking->id_number}}" readonly id="userinput1" class="form-control border-primary" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="userinput1">@lang('Phone Number')</label>
                                <input type="text" value="{{ $booking->phone}}" readonly id="userinput1" class="form-control border-primary" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="userinput1">@lang('Visa Image')</label>

                                <img src="{{ asset('uploads/'.$booking->visa_image) }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                            </div>
                        </div>
                        
                     
                    </div>
                    <h4 class="form-section"><i class="la la-add"></i>@lang('Worker Info') </h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="bio">@lang('Name')</label>
                                <input type="text" value="{{ $booking->worker->name}}" readonly id="userinput1" class="form-control border-primary" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="bio">@lang('Company Name')</label>
                                <input type="text" value="{{ $booking->comapny->name}}" readonly id="userinput1" class="form-control border-primary" >
                            </div>
                        </div>
                     

                        

                    </div>

                   

                    


                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>

@endsection
