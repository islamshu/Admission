<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
  <div class="main-menu-content ps-container ps-theme-dark" data-ps-id="5732bf2c-0291-dc37-113e-7d95b914e882" style="height: 676px;">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
      @if(auth()->user()->hasRole('Admin'))
      <li class="nav-item has-sub "><a href="#">
        <i class="la la-user"></i>
        <span class="menu-title" >Users</span></a>
        <ul class="menu-content" style="">
          <li class="is-shown"><a class="menu-item" href="{{ route('users.index') }}" >Show all</a>
          </li>
          <li class="is-shown"><a class="menu-item" href="{{ route('users.create') }}" >Create User</a>
          </li>
        </ul>
      </li>
      <li class="nav-item has-sub "><a href="#">
        <i class="fa fa-user-secret"></i>
        <span class="menu-title" >Roles</span></a>
        <ul class="menu-content" style="">
          <li class="is-shown"><a class="menu-item" href="{{ route('roles.index') }}" >Show All</a>
          </li>
          <li class="is-shown"><a class="menu-item" href="{{ route('roles.create') }}" >Create Role</a>
          </li>
        </ul>
      </li>
      <li class="nav-item has-sub "><a href="#">
        <i class="fa fa-building"></i>
        <span class="menu-title" >Companies</span></a>
        <ul class="menu-content" style="">
          <li class="is-shown"><a class="menu-item" href="{{ route('companies.index') }}" >Show All</a>
          </li>
          
        </ul>
      </li>
     
      <li class="nav-item has-sub "><a href="#">
        <i class="fa fa-user-circle"></i>
        <span class="menu-title" >Worker</span></a>
        <ul class="menu-content" style="">
          <li class="is-shown"><a class="menu-item" href="{{ route('worker.index') }}" >Show All</a>
          </li>
          <li class="is-shown"><a class="menu-item" href="{{ route('worker.create') }}" >Create Worker</a>
          </li>
          
        </ul>
      </li>
      <li class="nav-item has-sub "><a href="#">
        <i class="fa fa-bookmark"></i>
        <span class="menu-title" >Booking</span></a>
        <ul class="menu-content" style="">
          <li class="is-shown"><a class="menu-item" href="{{ route('booking.get') }}" >Show All</a>
          </li>
          
        </ul>
      </li>
      <li class="nav-item has-sub "><a href="#">
        <i class="la la-globe"></i>
        <span class="menu-title" >Countries</span></a>
        <ul class="menu-content" style="">
          <li class="is-shown"><a class="menu-item" href="{{ route('country.index') }}" >Show All</a>
          </li>
          <li class="is-shown"><a class="menu-item" href="{{ route('country.create') }}" >Create country</a>
          </li>
          
        </ul>
      </li>
      <li class="nav-item has-sub "><a href="#">
        <i class="la la-globe"></i>
        <span class="menu-title" >Nationalities</span></a>
        <ul class="menu-content" style="">
          <li class="is-shown"><a class="menu-item" href="{{ route('nationalities.index') }}" >Show All</a>
          </li>
          <li class="is-shown"><a class="menu-item" href="{{ route('nationalities.create') }}" >Create Nationality</a>
          </li>
          
        </ul>
      </li>
      @endif
      @if(auth()->user()->hasRole('Company'))
      <li class="nav-item has-sub "><a href="#">
        <i class="fa fa-user-circle"></i>
        <span class="menu-title" >Worker</span></a>
        <ul class="menu-content" style="">
          <li class="is-shown"><a class="menu-item" href="{{ route('worker.index') }}" >Show All</a>
          </li>
          <li class="is-shown"><a class="menu-item" href="{{ route('worker.create') }}" >Create Worker</a>
          </li>
          
        </ul>
      </li>
      <li class="nav-item has-sub "><a href="#">
        <i class="fa fa-bookmark"></i>
        <span class="menu-title" >Booking</span></a>
        <ul class="menu-content" style="">
          <li class="is-shown"><a class="menu-item" href="{{ route('booking.get') }}" >Show All</a>
          </li>
          
        </ul>
      </li>
      @endif
    </ul>
  <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 251px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
</div>