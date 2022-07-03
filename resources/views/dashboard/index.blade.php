@extends('layouts.backend')

@section('content')
<div class="row">

  @if(auth()->user()->hasRole('Admin'))
    <div class="col-xl-3 col-lg-6 col-12">
      <div class="card pull-up">
        <div class="card-content">
          <div class="card-body">
            <div class="media d-flex">
              <div class="media-body text-left">
                <h3 class="success">{{ App\Company::count() }}</h3>
                <h6>{{ __('Company Count') }}</h6>
              </div>
              <div>
                <i class="icon-user-follow success font-large-2 float-right"></i>
              </div>
            </div>
            <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
              <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 80%"
              aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- <div class="col-xl-3 col-lg-6 col-12">
      <div class="card pull-up">
        <div class="card-content">
          <div class="card-body">
            <div class="media d-flex">
              <div class="media-body text-left">
                <h3 class="warning">{{ App\User::count() }}</h3>
                <h6>{{ __('User Count') }}</h6>
              </div>
              <div>
                <i class="icon-user-following warning font-large-2 float-right"></i>
              </div>
            </div>
            <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
              <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 65%"
              aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </div>
      </div>
    </div> --}}
    <div class="col-xl-3 col-lg-6 col-12">
      <div class="card pull-up">
        <div class="card-content">
          <div class="card-body">
            <div class="media d-flex">
              <div class="media-body text-left">
                <h3 class="info">{{ App\Worker::count() }}</h3>
                <h6>{{ __('Worker Count') }}</h6>
              </div>
              <div>
                <i class="icon-loop  info font-large-2 float-right"></i>
              </div>
            </div>
            <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
              <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 75%"
              aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
      <div class="card pull-up">
        <div class="card-content">
          <div class="card-body">
            <div class="media d-flex">
              <div class="media-body text-left">
                <h3 class="success">{{ App\Worker::where('status',1)->count() }}</h3>
                <h6>{{ __('available Worker Count') }}</h6>
              </div>
              <div>
                <i class="icon-loop  success font-large-2 float-right"></i>
              </div>
            </div>
            <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
              <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 75%"
              aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
      <div class="card pull-up">
        <div class="card-content">
          <div class="card-body">
            <div class="media d-flex">
              <div class="media-body text-left">
                <h3 class="danger">{{ App\Worker::where('status',0)->count() }}</h3>
                <h6>{{ __('Busy Worker Count') }}</h6>
              </div>
              <div>
                <i class="icon-loop  danger font-large-2 float-right"></i>
              </div>
            </div>
            <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
              <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 75%"
              aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
      <div class="card pull-up">
        <div class="card-content">
          <div class="card-body">
            <div class="media d-flex">
              <div class="media-body text-left">
                <h3 class="dark">{{ App\Worker::where('status',2)->count() }}</h3>
                <h6>{{ __('In Progress Worker Count') }}</h6>
              </div>
              <div>
                <i class="icon-loop  dark font-large-2 float-right"></i>
              </div>
            </div>
            <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
              <div class="progress-bar bg-gradient-x-dark" role="progressbar" style="width: 75%"
              aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-12">
        <div class="card pull-up">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="media-body text-left">
                  <h3 class="warning">{{ App\Booking::count() }}</h3>
                  <h6>{{ __('Number Of order') }}</h6>
                </div>
                <div>
                  <i class="icon-user-following warning font-large-2 float-right"></i>
                </div>
              </div>
              <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 65%"
                aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-6 col-12">
        <div class="card pull-up">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="media-body text-left">
                  <h3 class="success">{{ App\Booking::where('status',1)->count() }}</h3>
                  <h6>{{ __('Done Order') }} </h6>
                </div>
                <div>
                  <i class="icon-user-following success font-large-2 float-right"></i>
                </div>
              </div>
              <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 65%"
                aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-6 col-12">
        <div class="card pull-up">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="media-body text-left">
                  <h3 class="danger">{{ App\Booking::where('status',0)->count() }}</h3>
                  <h6>{{ __('Reject Order') }} </h6>
                </div>
                <div>
                  <i class="icon-user-following danger font-large-2 float-right"></i>
                </div>
              </div>
              <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 65%"
                aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-6 col-12">
        <div class="card pull-up">
          <div class="card-content">
            <div class="card-body">
              <div class="media d-flex">
                <div class="media-body text-left">
                  <h3 class="warning">{{ App\Booking::where('status',2)->count() }}</h3>
                  <h6>{{ __('in progress order Order') }} </h6>
                </div>
                <div>
                  <i class="icon-user-following warning font-large-2 float-right"></i>
                </div>
              </div>
              <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 65%"
                aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    
  </div>
 
  
  @elseif(auth()->user()->hasRole('Company'))
 
 
  <div class="col-xl-3 col-lg-6 col-12">
    <div class="card pull-up">
      <div class="card-content">
        <div class="card-body">
          <div class="media d-flex">
            <div class="media-body text-left">
              <h3 class="info">{{ App\Worker::where('company_id',auth()->user()->company->id)->count() }}</h3>
              <h6>{{ __('Worker Count') }}</h6>
            </div>
            <div>
              <i class="icon-loop  info font-large-2 float-right"></i>
            </div>
          </div>
          <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
            <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 75%"
            aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-6 col-12">
    <div class="card pull-up">
      <div class="card-content">
        <div class="card-body">
          <div class="media d-flex">
            <div class="media-body text-left">
              <h3 class="success">{{ App\Worker::where('company_id',auth()->user()->company->id)->where('status',1)->count() }}</h3>
              <h6>{{ __('available Worker Count') }}</h6>
            </div>
            <div>
              <i class="icon-loop  success font-large-2 float-right"></i>
            </div>
          </div>
          <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
            <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 75%"
            aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-6 col-12">
    <div class="card pull-up">
      <div class="card-content">
        <div class="card-body">
          <div class="media d-flex">
            <div class="media-body text-left">
              <h3 class="danger">{{ App\Worker::where('company_id',auth()->user()->company->id)->where('status',0)->count() }}</h3>
              <h6>{{ __('Busy Worker Count') }}</h6>
            </div>
            <div>
              <i class="icon-loop  danger font-large-2 float-right"></i>
            </div>
          </div>
          <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
            <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 75%"
            aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <div class="col-xl-3 col-lg-6 col-12">
    <div class="card pull-up">
      <div class="card-content">
        <div class="card-body">
          <div class="media d-flex">
            <div class="media-body text-left">
              <h3 class="warning">{{ App\Worker::where('company_id',auth()->user()->company->id)->where('status',2)->count() }}</h3>
              <h6>{{ __('In Progress Worker Count') }}</h6>
            </div>
            <div>
              <i class="icon-loop  warning font-large-2 float-right"></i>
            </div>
          </div>
          <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
            <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 75%"
            aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-6 col-12">
      <div class="card pull-up">
        <div class="card-content">
          <div class="card-body">
            <div class="media d-flex">
              <div class="media-body text-left">
                <h3 class="dark">{{ App\Booking::where('company_id',auth()->user()->company->id)->count() }}</h3>
                <h6>{{ __('Order Count') }}</h6>
              </div>
              <div>
                <i class="icon-user-following dark font-large-2 float-right"></i>
              </div>
            </div>
            <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
              <div class="progress-bar bg-gradient-x-dark" role="progressbar" style="width: 65%"
              aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
   
 
    

    
 
</div>
@endif
<div class="row">
  <div id="recent-transactions" class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">@lang('Recent Booking')</h4>
        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
        <div class="heading-elements">
          <ul class="list-inline mb-0">
            <li><a class="btn btn-sm btn-danger box-shadow-2 round btn-min-width pull-right"
              href="invoice-summary.html" target="_blank">@lang('Show All')</a></li>
          </ul>
        </div>
      </div>
      <div class="card-content">
        <div class="table-responsive">
          <table id="recent-orders" class="table table-hover table-xl mb-0">
            <thead>
              <tr>
              
                 <th class="border-top-0">@lang('Order ID')</th>
                 <th class="border-top-0">@lang('Customer name')</th>
                 <th class="border-top-0">@lang('Customer number id')</th>
                 <th class="border-top-0">@lang('worker name')</th>
                 <th class="border-top-0">@lang('Created at')</th>
                 <th class="border-top-0">@lang('Status')</th>
                 <th class="border-top-0">@lang('Action')</th>
              </tr>
            </thead>
            <tbody>
              @if(auth()->user()->hasRole('Admin'))
              @php
                $booking = App\Booking::orderBy('id', 'DESC')->take(10)->get();
              @endphp
              @else
              @php
                    $booking = App\Booking::where('company_id',auth()->user()->company->id)->orderBy('id', 'DESC')->take(10)->get();
              @endphp
              
              @endif
              @foreach ($booking as $key => $book)
              <tr>
              <td>{{ ++$key }}</td>
              <td>{{ $book->order_id }}</td>
              <td>{{ $book->name }}</td>
              <td>{{ $book->id_number }}</td>
              <td> <a target="_blank" href="{{ $book->worker->url_sand }}">{{ $book->worker->name }}</a></td>
              <td>{{ $book->created_at->format('Y M d') }}</td>
              <td>
                  {{-- <label class="badge badge-{{ color($worker->status) }}">{{ worker_status($worker->status) }}</label> --}}
                  {{-- <label for="" class="btn btn-success"> --}}
                  <select class="target btn" book_id="{{ $book->id }}" class="worker_status" id="worker_status_{{ $book->id }}" onchange="myFunction('{{ $book->id }}')"
                      style="background:{{ get_color_new($book->status) }} "
                      data-id="{{ $book->id }}">
                      <option value="1" class="btn  btn-success"
                          @if ($book->status == 1) selected @endif>
                          @lang('Done')</option>
                      <option value="0" class="btn btn-danger"
                          @if ($book->status == 0) selected @endif>@lang('Reject')
                      </option>
                      <option value="2" class="btn btn-warning "
                          @if ($book->status == 2) selected @endif>@lang('in progress order')</option>
                  </select>


                  {{-- </label> --}}
              </td>
           


              <td>
               <a href="{{ route('booking.show',$book->id) }}"><i class="fa fa-eye"></i></a>
              </td>
              </tr>
              @endforeach
          </tbody>
           
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
