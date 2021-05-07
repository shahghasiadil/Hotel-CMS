<!-- Header -->
    <div class="header">
        
        <!-- Logo -->
        <div class="header-left">
            <a href="index.html" class="logo">
                <img src="{{asset('assets/img/logo.png')}}"  style="width: 40px;" alt="">
            </a>
        </div>
        <!-- /Logo -->
        
        <!-- <a id="toggle_btn" href="javascript:void(0);">
            <span class="bar-icon">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </a> -->
    
        <!-- Header Title -->
        <div class="page-title-box">
            <h3 style="font-size: 25px;">Hotel Management System</h3>
        </div>
        <!-- /Header Title -->
        
        <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>
        <!-- Flag -->
     
        <!-- Header Menu -->
        <ul class="nav user-menu">
        <li class="nav-item dropdown has-arrow flag-nav">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                @if(app()->isLocale('fa'))
                <img src="{{asset('assets/img/flags/af.png')}}" alt="" height="20"> <span>دری</span>
                @else
                <img src="{{asset('assets/img/flags/en.png')}}" alt="" height="20"> <span>English</span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="" class="dropdown-item">
                    <img src="{{asset('assets/img/flags/en.png')}}" alt="" height="16"> English
                </a>
                <a href="" class="dropdown-item">
                    <img src="{{asset('assets/img/flags/af.png')}}" alt="" height="16"> دری
                </a>
            </div>
        </li>
        <!-- /Flag -->
            <li class="nav-item dropdown has-arrow main-drop">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                    <span class="user-img"><img src="{{asset('assets/img/profiles/avatar-21.jpg')}}" alt="">
                    <span class="status online"></span></span>
                    {{-- <span>{{Auth::user()->user_name}}</span> --}}
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item"
					    href="{{ route('logout', app()->getLocale()) }}"
                        onclick="event.preventDefault();
						document.getElementById('logout-form').submit();">
					    Logout
					    </a>
                </div>
                <form id="logout-form" action="{{ route('logout', app()->getLocale()) }}" method="POST" style="display: none;">
                    @csrf
                </form> 
            </li>
        </ul>
        <!-- /Header Menu -->
        
        <!-- Mobile Menu -->
        <div class="dropdown mobile-user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="profiles.html">My Profile</a>
                <a class="dropdown-item" href="settings.html">Settings</a>
                <a class="dropdown-item"
                    href="{{ route('logout', app()->getLocale()) }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    Logout
                </a>
            </div>
        </div>
        <!-- /Mobile Menu -->
    </div>
    <!-- /Header -->