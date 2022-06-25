@extends('layouts.backend')
@section('content')
    <div class="content-body">
        <section id="configuration">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="basic-layout-colored-form-control">Edit Worker </h4>
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

                                <form class="form" method="post" action="{{ route('worker.update',$worker->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label>Image </label><span> (300 * 300)</span>
                                                <input type="file" name="image" class="form-control image">
                                            </div>
                    
                                            <div class="form-group">
                                                <img src="{{ asset('uploads/'.$worker->image) }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                                            </div>
                                        
                                        </div>
                                        <div class="row">
                                        <div class="col-md-6">
                                            <label>Name</label>
                                            <input type="text" name="name" value="{{$worker->name }}"
                                                class="form-control" required placeholder="type name">
                                        </div>
                                        @if(auth()->user()->hasRole('Admin'))
                                        <div class="col-md-6">
                                            <label>Company</label>
                                            <select name="company_id" required class="form-control"  >
                                                <option value=""> Choose Compnay </option>
                                                @foreach ($comapnys as $item)
                                                <option value="{{ $item->id }}" @if($worker->company_id == $item->id) selected @endif>{{ $item->name }}</option>
                                            
                                                @endforeach
                                            </select>
                                           
                                        </div>
                                        @endif
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label>Natonality</label>
                                                <select name="nationality_id" id="select_new" required class="form-control"  >
                                                    <option value=""> Choose Natonality </option>
                                                    @foreach ($natonality as $item)
                                                    <option value="{{ $item->id }}" @if($worker->nationality_id == $item->id) selected @endif>{{ $item->name }}</option>
                                                
                                                    @endforeach
                                                </select>
                                               
                                            </div>
                                            <div class="col-md-1 mt-2 mr-0">
                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"> add new</button>
                                               
                                            </div>
                                            <div class="col-md-6">
                                                <label>Age</label>
                                                <input type="number" name="age" value="{{ $worker->age }}"
                                                    class="form-control" placeholder="type age">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Experince</label>
                                                <input type="number" name="experience" value="{{ $worker->experience }}"
                                                class="form-control" placeholder="type experience">
                                               
                                            </div>
                                            <div class="col-md-6">
                                                <label>Is the experience inside Saudi Arabia or not?</label>
                                                <select name="in_sa" required class="form-control"  >
                                                    <option value="1"  @if($worker->in_sa == 1) selected @endif  > Yes </option>
                                                    <option value="0"  @if($worker->in_sa == 0) selected @endif > No </option>

                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Language</label>
                                                <select name="language" required class="form-control"  >
                                                    <option value=""> Choose Language </option>
                                                    @foreach (get_language() as $item)
                                                        <option value="{{ $item }}" @if($worker->language == $item) selected @endif> {{ $item }}</option>
                                                    @endforeach
                                                </select>
                                               
                                            </div>
                                            <div class="col-md-6">
                                                <label>Religion</label>
                                                <select class="form-control" required name="religion" >
                                                    <option  value="" selected disabled>choose Religion </option>
                                                    <option  value="islam" @if($worker->religion == 'islam') selected @endif >Islam</option>
                                                    <option  value="christian" @if($worker->religion == 'christian') selected @endif >Christian</option>
                                                    {{-- <option value="jewish" @if($worker->religion == 'jewish') selected @endif >Jewish</option>
                                                    <option value="buddhism" @if($worker->religion == 'buddhism')) selected @endif >Buddhism</option>
                                                    <option value="hindu" @if($worker->religion == 'hindu')) selected @endif >Hindu</option> --}}
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                         
                                            <div class="col-md-6">
                                                <label>Do you accept children?</label>
                                                <select name="approve_chiled" required class="form-control"  >
                                                    <option value="1" @if($worker->approve_chiled == 1) selected @endif > Yes </option>
                                                    <option value="0" @if($worker->approve_chiled == 0) selected @endif> No </option>

                                                </select>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <label>Do she know  cook ?</label>
                                                <select name="is_coocked" required class="form-control"  >
                                                    <option value="1" @if($worker->approve_chiled == 1) selected @endif> Yes </option>
                                                    <option value="0" @if($worker->approve_chiled == 0) selected @endif> No </option>

                                                </select>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row">
                                         
                                            <div class="col-md-6">
                                                <label>Recruitment period</label>
                                                <select name="is_quick" required class="form-control" id="time_q" >
                                                    <option value="" > Choose</option>
                                                    <option value="1" @if($worker->is_quick== 1) selected @endif> immediately </option>
                                                    <option value="0" @if($worker->is_quick == 0  ) selected @endif> needs time </option>

                                                </select>
                                            </div>
                                            
                                            <div class="col-md-6" id="duration"@if($worker->is_quick == 1) style="display: none" @else  style="display: inline" @endif >
                                                <label>Duration</label>
                                                <input type="number" name="time" value="{{ $worker->time }}"
                                                    class="form-control"  placeholder="type Duration">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            
                                            <div class="col-md-6">
                                                <label>Saned Url</label>
                                                <input type="url" name="url_sand" value="{{ $worker->url_sand }}"
                                                    class="form-control" required placeholder="type Saned Url">
                                            </div>
                                            
                                          
                                        </div>
                                        




                                    </div>



                                    <div class="form-actions left">

                                        <button type="submit" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i> {{ __('save') }}
                                        </button>
                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h4 class="modal-title w-100 font-weight-bold">{{ __('Add Nationalitiy') }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div id="form-errors" class="text-center" ></div>

                        <div id="natonality">
                            <form  method="post" id="form_model" enctype="multipart/form-data">
                                @csrf
                                {{-- <div class="modal-body mx-3">
                                    <div class="md-form mb-2">
                                     <label data-error="wrong" data-success="right" for="form3">Flag</label>
                                     <input type="file" id="form3" name="flag"  class="form-control image">
                                    </div>
                                    <div class="form-group">
                                      <img src="{{ asset('uploads/product_images/default.png') }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                                  </div>
                              
                                    
                              
                                  </div> --}}
                                <div class="modal-body mx-3">
                                    <div class="md-form mb-2">
                                     <label data-error="wrong" data-success="right" for="form3">Arabic Name</label>
                                     <input type="text" id="form3" name="name_ar"  class="form-control validate">
                                    </div>
                            
                                    <div class="md-form mb-2">
                                     <label data-error="wrong" data-success="right" for="form2">English Name</label>
                                     <input type="text" id="form2" name="name_en" class="form-control validate">
                                    </div>
                            
                                  </div>
                                  <div class="modal-footer d-flex justify-content-center">
                                    <button class="btn btn-info" type="submit">Send </i></button>
                                  </div>
                            </form>
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
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
$(document).ready(function(){
  $("#time_q").change(function(){
    if($(this).val() == 0){
        $("#duration").show();
    }else{
        $("#duration").hide();
 
    }
  });
});
</script>
<script>
    $('#form_model').on('submit', function(e) {
            e.preventDefault();
      
            var data = $(this).serialize();
    
            $.ajax({
                url: "{{ route('nationalities.store_ajax') }}",
                type: "post",
                data : data,
                success: function(data) {
              
                  
                        $('#select_new').append('<option value="' + data.id +
                            '">' +  data.name + '</option>');
                   $(".close").click();
                
                },
                error: function(data) {
                    var errors = data.responseJSON;
                        var errors = data.responseJSON;
                       errorsHtml = '<div class="alert alert-danger"><ul>';
                      $.each(errors.errors,function (k,v) {
                             errorsHtml += '<li>'+ v + '</li>';
                      });
                      errorsHtml += '</ul></di>';
                      $( '#form-errors' ).html( errorsHtml );
                },
            });
        });
    </script>
@endsection
