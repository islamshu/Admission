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
@endsection
