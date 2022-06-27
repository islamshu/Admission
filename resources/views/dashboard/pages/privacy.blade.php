@extends('layouts.backend')
@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title">Privacy policy</h3>
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Privacy policy
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
                            <h4 class="card-title">Privacy page</h4>
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
                        @include('dashboard.parts._error')
                        @include('dashboard.parts._success')
                        
                        <table class="table"
                        >
                        <thead>
                            <tr class="fw-bold fs-6 text-gray-800">
                                <th>{{ __('drop') }}</th>
                                <th>{{ __('title') }}</th>
                                <th>{{ __('content') }}</th>
                              
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="sort_menu">
                            @foreach ($privacy as $key=>$item)
                          
                           
                            <tr data-id="{{ $item->id }}">
                                 {{-- {{ dd($item) }} --}}
                                 
                                 <td> <i class="fa fa-bars handle" aria-hidden="true"></i></td>
                    
                                @if(get_lang() == 'ar')
                                <td>{{$item->title_ar}}</td>
                                <td>{!! $item->body_ar!!}</td>
                                @else
                                <td>{{$item->title_en}}</td>
                                <td>{!! $item->body_en !!}</td>
                                @endif
                               
                                <td>
                    
                                    <form method="post"  style="display: inline" action="{{ route('privacy.delete',$item->id) }}">
                                        @csrf @method('delete')
                                        <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                    
                                   </td>
                               
                           
                                @endforeach
                    
                    
                        </tbody>
                     
                    </table>
                    <form class="form" method="post" action="{{ route('privacy.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                {{-- <div class="form-group col-md-12">
                                    <select class="form-control select2 vendor" id="kt_select2_1" name="param">
                                        <option value='null'>{{ __('chose Vendor') }}</option>
                                        @foreach ($vendor as $item)
                                        <option value={{$item->id}}>{{$item->name_en}}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                <div class="form-group col-md-6">
                                    <label> {{ __('title ar') }} :</label>
                                    <input type="text" name="title_ar" id="name_ar" class="form-control form-control-solid"
                                        placeholder="Enter Title" required />
                                </div>
                                <div class="form-group col-md-6">
                                    <label>{{ __('title en') }} :</label>
                                    <input type="text" name="title_en" id="name_en" class="form-control form-control-solid"
                                        placeholder="Enter Title" required />
                                </div>
                                <div class="form-group col-md-6">
                                    <label>{{ __('Content ar') }} :</label>
                                    <textarea name="body_ar" class="form-control" required id="" cols="30" rows="5"></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>{{ __('Content en') }} :</label>
                                    <textarea name="body_en" class="form-control" required id="" cols="30" rows="5"></textarea>
                                </div>
                           
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2">{{ __('Submit') }}</button>
                            </div>
                    </form>
                    </div>
                 
                </div>
            </div>
          
        </section>

    </div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
    integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <script>
         function updateToDatabase(idString) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            $.ajax({
                url: '{{ route('update_sort_privacy', app()->getLocale()) }}',
                method: 'POST',
                data: {
                    ids: idString
                },
                success: function() {
                    alert('Successfully updated')
                    //do whatever after success
                }
            })
        }

        var target = $('.sort_menu');
        target.sortable({
            handle: '.handle',
            placeholder: 'highlight',
            axis: "y",
            update: function(e, ui) {
                var sortData = target.sortable('toArray', {
                    attribute: 'data-id'
                })
                updateToDatabase(sortData.join(','))
            }
        });
    </script>
@endsection