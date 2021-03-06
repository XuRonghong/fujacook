
<!-- ============================================================== -->
<!-- Topbar header - style you can find in pages.scss -->
<!-- ============================================================== -->
<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                <i class="ti-menu ti-close"></i>
            </a>
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <a class="navbar-brand" href="{{url('admin')}}">
                <!-- Logo icon -->
                <b class="logo-icon">
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <img src="{{data_get($data,'dark_logo')}}" alt="homepage" class="dark-logo" />
                    <!-- Light Logo icon -->
                    <img src="{{data_get($data,'light_logo')}}" alt="homepage" class="light-logo" />
                </b>
                <!--End Logo icon -->
                <!-- Logo text -->
                <span class="logo-text">
                    <!-- dark Logo text -->
                    <img src="{{data_get($data,'dark_logo_text')}}" alt="homepage" class="dark-logo" style="margin-left: -5px" />
{{--                    <div class="dark-logo" style="color: black; font-family: '微軟正黑體'; font-size: 18px;">Fujacook</div>--}}
                    <!-- Light Logo text -->
                    <img src="{{data_get($data,'light_logo_text')}}" alt="homepage" class="light-logo" style="margin-left: -5px" />
{{--                    <div class="light-logo" style="color: white; font-family: '微軟正黑體'; font-size: 18px;">Fujacook</div>--}}
                </span>
            </a>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-left mr-auto">
                <li class="nav-item d-none d-md-block">
                    <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar">
                        <i class="mdi mdi-menu font-24"></i>
                    </a>
                </li>
                <!-- ============================================================== -->
                <!-- Search -->
                <!-- ============================================================== -->
                <li class="nav-item search-box">
                    <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                    <form class="app-search position-absolute" action="{{url('admin')}}">
                        <input type="text" name="k" class="form-control" placeholder="Search &amp; enter">
                        <a class="srh-btn"><i class="ti-close"></i></a>
                    </form>
                </li>
            </ul>
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-right">
                <!-- ============================================================== -->
                <!-- create new -->
                <!-- ============================================================== -->
{{--                <li class="nav-item dropdown">--}}
{{--                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                        <i class="flag-icon {{session('lstyle', 'flag-icon-tw')}}"></i>--}}
{{--                    </a>--}}
{{--                    <div class="dropdown-menu dropdown-menu-right  animated bounceInDown" aria-labelledby="navbarDropdown2">--}}
{{--                        <a class="dropdown-item" href="{{route('admin.setlang', ['lang'=>'en','style'=>'flag-icon-us'])}}"><i class="flag-icon flag-icon-us"></i> English</a>--}}
{{--                        <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-fr"></i> French</a>--}}
{{--                        <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-es"></i> Spanish</a>--}}
{{--                        <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-de"></i> German</a>--}}
{{--                        <a class="dropdown-item" href="{{route('admin.setlang', ['lang'=>'zh-TW','style'=>'flag-icon-tw'])}}"><i class="flag-icon flag-icon-tw"></i> Taiwan</a>--}}
{{--                        <a class="dropdown-item" href="{{route('admin.setlang', ['lang'=>'zh-CN','style'=>'flag-icon-cn'])}}"><i class="flag-icon flag-icon-cn"></i> China</a>--}}
{{--                    </div>--}}
{{--                </li>--}}
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href=""
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{data_get($data, 'admin_logo')}}" alt="user" class="rounded-circle" width="31">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                        <form action="{{ route('admin.logout') }}" method="post" id="admin-layouts-nav-form">
                            <span class="with-arrow">
                                <span class="bg-primary"></span>
                            </span>
                            <div class="d-flex no-block align-items-center p-15 bg-primary text-white m-b-10">
                                <div class="">
                                    <img src="{{data_get($data, 'admin_logo')}}" alt="user" class="img-circle" width="60">
                                </div>
                                <div class="m-l-10">
                                    <h4 class="m-b-0">{{data_get($data, 'admin_name')}}</h4>
                                    <p class=" m-b-0">{{data_get($data, 'admin_email')}}</p>
                                </div>
                            </div>
                            <a class="dropdown-item" href="{{data_get($data, 'admin_profile')}}">
                                <i class="ti-user m-r-5 m-l-5"></i> My Profile
                            </a>
                            @if(data_get($data, 'my_balance_url'))
                                <a class="dropdown-item" href="{{data_get($data, 'my_balance_url')}}">
                                    <i class="ti-wallet m-r-5 m-l-5"></i> My Balance
                                </a>
                            @endif
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{data_get($data, 'account_setting_url')}}">
                                <i class="ti-settings m-r-5 m-l-5"></i> Account Setting
                            </a>
                            <div class="dropdown-divider"></div>
                            {{ csrf_field() }}
                            @if(Route::has('login'))
                                @if(Auth::guard('admin')->check())
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="document.getElementById('admin-layouts-nav-form').submit();">
                                        <i class="fa fa-power-off m-r-5 m-l-5"></i> Logout
                                    </a>
                                @endif
                            @endif
                            <div class="dropdown-divider"></div>
                        </form>
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>
<!-- ============================================================== -->
<!-- End Topbar header -->
<!-- ============================================================== -->
