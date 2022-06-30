<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light bg-info navbar-shadow">
    <div class="navbar-wrapper">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
          <li class="nav-item">
            <a class="navbar-brand" href="{{ route('home') }}">
              <img class="brand-logo" alt="modern admin logo" src="http://website.foryougo.net/uploads/general/qfQgKusSFarXpZr8ZbMQ25ZSKFohI6qyNAEO63Ih.png">
              <h3 class="brand-text">Foryou</h3>
            </a>
          </li>
          <li class="nav-item d-md-none">
            <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a>
          </li>
        </ul>
      </div>
      <div class="navbar-container content">
        <div class="collapse navbar-collapse" id="navbar-mobile">
          <ul class="nav navbar-nav mr-auto float-left">
            <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>
            <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>
        
           
          </ul>
          <ul class="nav navbar-nav float-right">
            <li class="dropdown dropdown-user nav-item">
              <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown" aria-expanded="false">
                
                  <span class="user-name text-bold-700">{{ auth()->user()->name }}</span>
                
                <span class="avatar avatar-online">
                  <img src="http://website.foryougo.net/backend/images/portrait/small/avatar-s-19.png" alt="avatar"><i></i></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ route('edit_profile') }}"><i class="ft-user"></i>@lang('Edit Profile')</a>
                
                <div class="dropdown-divider"></div><a class="dropdown-item" href="{{ route('logout') }}"><i class="ft-power"></i> @lang('Logout')</a>
              </div>
            </li>
            
            
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <!-- Full Screen Button -->
            <li class="fullscreen">
                <a href="javascript:;" class="fullscreen-btn">
                    <i class="fas fa-expand"></i>
                </a>
            </li>
            <li class="dropdown dropdown-notifications">
              @php
                  $notifications = auth()->user()->unreadNotifications;
                  $count = auth()->user()->unreadNotifications->count();

              @endphp
              <a  style="color: white" href="#" onClick="return false;" class="dropdown-toggle" data-bs-toggle="dropdown"data-toggle="dropdown"
                  role="button">
                  <i class="far fa-bell fa-2x"></i>
                  <span class="notif-count"  data-count="{{ $count }}">{{ $count }}</span>
              </a>
              <ul class="dropdown-menu pullDown" style="height: auto;" >
                  <li class="header">الاشعارات</li>
                  <li class="body" style="width: 100%">

                      <ul class="menu" >
                            
                   
                          <li class="scrollable-container">
                              @forelse  ($notifications as $item)
                              {{-- {{ route('show_notify',$item->id) }} --}}
                              <a href="" >
                                  <span class="table-img msg-user">
                                      <img src="{{ asset('uploads/user/deflut.png') }}" alt="">
                                  </span>
                                  <span class="menu-info">
                                      <span class="menu-title">{{$item->data['name'] }}</span>
                                      <span class="menu-desc">
                                          <i class="material-icons"></i> 
                                      </span>
                                  </span>
                              </a>
                              @empty
                              <a class="delll" style="color: rgb(163, 74, 74);text-align: center" href="#" onClick="return false;">لا يوجد اشعارات</a>
                              @endforelse
                          </li>
                    

                        
                      </ul>

                  </li>
                 
              </ul>
          </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>