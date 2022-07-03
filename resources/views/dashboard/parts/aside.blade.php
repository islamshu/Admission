<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
  <div class="main-menu-content ps-container ps-theme-dark" data-ps-id="5732bf2c-0291-dc37-113e-7d95b914e882" style="height: 676px;">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
      <li class="nav-item"><a href="{{ route('home') }}"><i class="la la-tachometer"></i><span class="menu-title" data-i18n="nav.dash.main">@lang('Dashboard') </span></a>  
      </li>
      @if(auth()->user()->hasRole('Admin'))
    
      {{-- <li class="nav-item has-sub "><a href="#">
        <i class="la la-user"></i>
        <span class="menu-title" >Users</span></a>
        <ul class="menu-content" style="">
          <li class="is-shown"><a class="menu-item" href="{{ route('users.index') }}" >Show all</a>
          </li>
          <li class="is-shown"><a class="menu-item" href="{{ route('users.create') }}" >Create User</a>
          </li>
        </ul>
      </li> --}}
      {{-- <li class="nav-item has-sub "><a href="#">
        <i class="fa fa-user-secret"></i>
        <span class="menu-title" >Roles</span></a>
        <ul class="menu-content" style="">
          <li class="is-shown"><a class="menu-item" href="{{ route('roles.index') }}" >Show All</a>
          </li>
          <li class="is-shown"><a class="menu-item" href="{{ route('roles.create') }}" >Create Role</a>
          </li>
        </ul>
      </li> --}}
    
      <li class="nav-item has-sub "><a href="#">
        <i class="fa fa-building"></i>
        <span class="menu-title" >@lang('Companies')</span></a>
        <ul class="menu-content" style="">
          <li class="is-shown"><a class="menu-item" href="{{ route('companies.index') }}" >@lang('Show All')</a>
          </li>
          <li class="is-shown"><a class="menu-item" href="{{ route('companies.create') }}" >@lang('Create Company')</a>
          </li>
          
        </ul>
      </li>
      <li class="nav-item has-sub "><a href="#">
        <i class="la la-globe"></i>
        <span class="menu-title" >@lang('Nationalities')</span></a>
        <ul class="menu-content" style="">
          <li class="is-shown"><a class="menu-item" href="{{ route('nationalities.index') }}" >@lang('Show All')</a>
          </li>
          {{-- <li class="is-shown"><a class="menu-item" href="{{ route('nationalities.create') }}" >Create Nationality</a>
          </li> --}}
          
        </ul>
      </li>
      <li class="nav-item has-sub "><a href="#">
        <i class="fa fa-user-circle"></i>
        <span class="menu-title" >@lang('workers')</span></a>
        <ul class="menu-content" style="">
          <li class="is-shown"><a class="menu-item" href="{{ route('worker.index') }}" >@lang('Show All')</a>
          </li>
          <li class="is-shown"><a class="menu-item" href="{{ route('worker.create') }}" >@lang('Create Worker')</a>
          </li>
          
        </ul>
      </li>
      <li class="nav-item has-sub "><a href="#">
        <i class="fa fa-bookmark"></i>
        <span class="menu-title" >@lang('Booking')</span></a>
        <ul class="menu-content" style="">
          <li class="is-shown"><a class="menu-item" href="{{ route('booking.get_all_booking') }}" >@lang('Show All Booking')</a>
          </li>
          <li class="is-shown"><a class="menu-item" href="{{ route('booking.get') }}" >@lang('Company with Booking')</a>
          </li>
          <li class="is-shown"><a class="menu-item" href="{{ route('booking.unavilable') }}" >@lang('Unavailable Booking')</a>
          </li>
          
        </ul>
      </li>
      {{-- <li class="nav-item has-sub "><a href="#">
        <i class="fa fa-bookmark"></i>
        <span class="menu-title" >@lang('Unavailable Booking')</span></a>
        <ul class="menu-content" style="">
          <li class="is-shown"><a class="menu-item" href="{{ route('booking.unavilable') }}" >@lang('Show All')</a>
          </li>
          
        </ul>
      </li> --}}
      {{-- <li class="nav-item has-sub "><a href="#">
        <i class="la la-adjust"></i>
        <span class="menu-title" >@lang('Countries')</span></a>
        <ul class="menu-content" style="">
          <li class="is-shown"><a class="menu-item" href="{{ route('country.index') }}" >@lang('Show All')</a>
          </li>
          <li class="is-shown"><a class="menu-item" href="{{ route('country.create') }}" >@lang('Create country')</a>
          </li>
          
        </ul>
      </li> --}}
      <li class="nav-item has-sub "><a href="#">
        <i class="la la-globe"></i>
        <span class="menu-title" >@lang('Nationalities')</span></a>
        <ul class="menu-content" style="">
          <li class="is-shown"><a class="menu-item" href="{{ route('nationalities.index') }}" >@lang('Show All')</a>
          </li>
          {{-- <li class="is-shown"><a class="menu-item" href="{{ route('nationalities.create') }}" >Create Nationality</a>
          </li> --}}
          
        </ul>
      </li>
      {{-- <li class="nav-item  "><a href="{{ route('social_info') }}">@lang('Social media')
        <i class="fa fa-bookmark"></i>
        </a>
      </li>
      <li class="nav-item  "><a href="{{ route('privacy.index') }}">@lang('Privacy policy Page')
        <i class="fa fa-bookmark"></i>
        </a>
      </li>
      <li class="nav-item  "><a href="{{ route('faqs.index') }}">@lang('FAQs page')
        <i class="fa fa-bookmark"></i>
        </a>
      </li>
      <li class="nav-item  "><a href="{{ route('about.index') }}">@lang('About us page')
        <i class="fa fa-bookmark"></i>
        </a>
      </li> --}}
      <li class="nav-item ">
        <a class="menu-item" href="#" data-i18n="nav.menu_levels.second_level_child.main">
            <i class="la la-thumb-tack"></i>
            <span class="menu-title" data-i18n="nav.page_layouts.main">@lang('translation')</span>
        </a>

    <ul class="menu-content" style="">
        <li class="is-shown"><a class="menu-item" href="{{ route('show_translate','ar') }}" data-i18n="nav.menu_levels.second_level_child.third_level">@lang('Arabic translation') </a>
        </li>
        <li class="is-shown"><a class="menu-item" href="{{ route('show_translate','en') }}" data-i18n="nav.menu_levels.second_level_child.third_level">@lang('English translation') </a>
        </li>
      </ul>
    </li>
    <li class="nav-item">
      <a class="menu-item" href="#" data-i18n="nav.menu_levels.second_level_child.main">
        <i class="la la-cog"></i>
        <span class="menu-title" data-i18n="nav.page_layouts.main">@lang('general info')</span>
    </a>

    <ul class="menu-content" style="">
      <li class="is-shown"><a class="menu-item" href="{{ route('generalinfo.index') }}" data-i18n="nav.menu_levels.second_level_child.third_level">@lang('general info') </a>
      </li>
      <li class="is-shown"><a class="menu-item" href="{{ route('social_info') }}" data-i18n="nav.menu_levels.second_level_child.third_level">@lang('Social media') </a>
      </li>
      <li class="is-shown"><a class="menu-item" href="{{ route('privacy.index') }}" data-i18n="nav.menu_levels.second_level_child.third_level">@lang('Privacy policy Page') </a>
      </li>
      <li class="is-shown"><a class="menu-item" href="{{ route('faqs.index') }}" data-i18n="nav.menu_levels.second_level_child.third_level">@lang('FAQs page') </a>
      </li>
      <li class="is-shown"><a class="menu-item" href="{{ route('about.index') }}" data-i18n="nav.menu_levels.second_level_child.third_level">@lang('About us page') </a>
      </li>
    </ul>
    </li>
    <li class="nav-item ">
      <a class="menu-item" href="#" data-i18n="nav.menu_levels.second_level_child.main">
          <i class="la la-thumb-tack"></i>
          <span class="menu-title" data-i18n="nav.page_layouts.main">@lang('translation')</span>
      </a>

  <ul class="menu-content" style="">
      <li class="is-shown"><a class="menu-item" href="{{ route('show_translate','ar') }}" data-i18n="nav.menu_levels.second_level_child.third_level">@lang('Arabic translation') </a>
      </li>
      <li class="is-shown"><a class="menu-item" href="{{ route('show_translate','en') }}" data-i18n="nav.menu_levels.second_level_child.third_level">@lang('English translation') </a>
      </li>
    </ul>
  </li>
        {{-- <span class="menu-title" >Pages</span></a> --}}
        {{-- <ul class="menu-content" style="">
          <li class="is-shown"><a class="menu-item" href="{{ route('social_info') }}" >Social Media</a>
          </li>
          <li class="is-shown"><a class="menu-item" href="{{ route('privacy.index') }}" >Privacy</a>
          </li>
          <li class="is-shown"><a class="menu-item" href="{{ route('faqs.index') }}" >FAQs</a>
          </li>
          <li class="is-shown"><a class="menu-item" href="{{ route('about.index') }}" >About</a>
          </li>
          
        </ul>
      </li> --}}
      @endif
      @if(auth()->user()->hasRole('Company'))
      <li class="nav-item has-sub "><a href="#">
        <i class="fa fa-user-circle"></i>
        <span class="menu-title" >@lang('workers')</span></a>
        <ul class="menu-content" style="">
          <li class="is-shown"><a class="menu-item" href="{{ route('worker.index') }}" >@lang('Show All')</a>
          </li>
          <li class="is-shown"><a class="menu-item" href="{{ route('worker.create') }}" >@lang('Create Worker')</a>
          </li>
          
        </ul>
      </li>
      <li class="nav-item has-sub "><a href="#">
        <i class="fa fa-bookmark"></i>
        <span class="menu-title" >@lang('Booking')</span></a>
        <ul class="menu-content" style="">
          <li class="is-shown"><a class="menu-item" href="{{ route('booking.get') }}" >@lang('Show All')</a>
          </li>
          
        </ul>
      </li>
      @endif
    </ul>
  <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 251px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
</div>