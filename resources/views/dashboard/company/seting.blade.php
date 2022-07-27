@extends('layouts.backend')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title">@lang('Profile')</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('Home')</a>
                        </li>
                     
                        <li class="breadcrumb-item active">@lang('setting')
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
                        <h4 class="card-title" id="basic-layout-colored-form-control">@lang('setting')</h4>
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
                            
                            <form class="form" method="post" action="{{ route('company.setting') }}" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="userinput1">@lang('same Visa')</label>
                                                <select class="form-control border-primary" id="is_same" name="is_same">
                                                    <option value="" disabled>@lang('Choose')</option>
                                                    <option value="1" @if(auth()->user()->company->is_same == 1) selected @endif>@lang('yes')</option>
                                                    <option value="0" @if(auth()->user()->company->is_same == 0) selected @endif>@lang('no')</option>

                                                </select>
                                             
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="in_all_comapny" @if(auth()->user()->company->is_same == 0) style="display:none" @else style="display:block" @endif >
                                            <div class="form-group">
                                                <label for="userinput1">@lang('all company or just my company')</label>
                                                <select class="form-control border-primary" name="in_all_comapny">
                                                    <option value="" disabled>@lang('Choose')</option>
                                                    <option value="1" @if(auth()->user()->company->in_all_comapny == 1) selected @endif>@lang('yes')</option>
                                                    <option value="0" @if(auth()->user()->company->in_all_comapny == 0) selected @endif>@lang('no')</option>

                                                </select>
                                             
                                            </div>
                                        </div>
                                     
                                      

                                    </div>
                                    <div class="form-actions left">

                                        <button type="submit" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i> @lang('save')
                                        </button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection
@section('script')
<script>
$('#is_same').change(function() {
    var option = $(this).find('option:selected');

    //Added with the EDIT
    var value = option.val(); //returns the value of the selected option.
    if(value == 0){
    $("#in_all_comapny").css("display", "block");
    }else{
        $("#in_all_comapny").css("display", "none");

    }

    

});
</script>
@endsection
