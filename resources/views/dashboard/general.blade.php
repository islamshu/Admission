@extends('layouts.backend')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">@lang('general info')</h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('Home')</a>
            </li>
           
            <li class="breadcrumb-item active">@lang('general info')
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
            <h4 class="card-title" id="basic-layout-colored-form-control">@lang('general info')</h4>
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
              <form class="form" method="POST" action="{{ route('generalinfo.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-body">
                    <h4 class="form-section"><i class="la la-add"></i>@lang('general info')</h4>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="userinput1">@lang('system name in arabic')  </label>
                                <input type="text" value="{{ get_general_value('title_ar') }}" id="userinput1" class="form-control border-primary" placeholder="@lang('system name in arabic') " name="general[title_ar]">
                            </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label for="userinput1">@lang('system name in english')   </label>
                              <input type="text" value="{{ get_general_value('title_en') }}" id="userinput1" class="form-control border-primary" placeholder="@lang('system name in arabic') " name="general[title_en]">
                          </div>
                      </div>
                  
                      
                      
                        
                       
                        
                     
                    </div>
                    <h4 class="form-section"><i class="la la-add"></i>@lang('system image') </h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="bio"> @lang('logo') </label>
                                <input type="file"    id="userinput11"  class="form-control border-primary" placeholder="العنوان - انجليزي" name="general_file[header_logo]">

                            </div>
                        </div>
                       

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="main_image">@lang('banner')  </label>
                                <input type="file" id="main_image" class="form-control border-primary" name="general_file[icon]">
                            </div>
                        </div>

                        

                    </div>

                  

                    

                    <div class="form-actions left">
                        <button type="submit" class="btn btn-primary">
                          <i class="la la-check-square-o"></i> @lang('save')
                        </button>
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
