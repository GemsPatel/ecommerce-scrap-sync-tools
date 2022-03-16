<!-- Modal -->
<div class="modal animated pulse text-left" id="EditProfileModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#16181d">
                <h3 class="modal-title" style="color:#dbdbdb">Edit Profile</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:#dbdbdb">&times;</span>
                </button>
            </div>
            <form role="form" id="edit_profile">
                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="profile_id" id="profile_id">
                <div class="modal-body">
                    <label>Name <span class="text-danger">*</span> : </label>
                    <div class="form-group position-relative has-icon-left">
                        <input type="text" class="form-control" id="edit_profile_name" name="profile_name"
                            placeholder="Name">
                        <div class="form-control-position">
                            <i class="la la-user font-medium-5 line-height-1 text-muted icon-align"></i>
                        </div>
                        <small class="text-danger animated edit_profile_name fadeInUp edit_profile"></small>
                    </div>

                    <label>Email <span class="text-danger">*</span> : </label>
                    <div class="form-group position-relative has-icon-left">
                        <input type="text" class="form-control" id="edit_profile_email" name="profile_email"
                            placeholder="Email" readonly>
                        <div class="form-control-position">
                            <i class="la la-envelope font-medium-5 line-height-1 text-muted icon-align"></i>
                        </div>
                        <small class="text-danger animated edit_profile_email fadeInUp edit_profile"></small>
                    </div>


                </div>
                <div class="modal-footer">
                    <input type="reset" class="btn btn-danger" data-dismiss="modal" value="Close">
                    <input type="submit" class="btn btn-success EditProfileButton" value="Submit">
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal animated pulse text-left" id="ChangePasswordModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#16181d">
                <h3 class="modal-title" style="color:#dbdbdb">Change Password</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:#dbdbdb">&times;</span>
                </button>
            </div>
            <form role="form" id="edit_password">
                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

                <div class="modal-body">
                    <label>New Password <span class="text-danger">*</span> : </label>
                    <div class="form-group position-relative has-icon-left">
                        <input type="password" class="form-control" id="p_password" name="p_password"
                            placeholder="New Password">
                        <div class="form-control-position">
                            <i class="la la-user font-medium-5 line-height-1 text-muted icon-align"></i>
                        </div>
                        <small class="text-danger animated p_password fadeInUp edit_password"></small>
                    </div>

                    <label>Confirm Password <span class="text-danger">*</span> : </label>
                    <div class="form-group position-relative has-icon-left">
                        <input type="password" class="form-control" id="c_password" name="c_password"
                            placeholder="Confirm Password">
                        <div class="form-control-position">
                            <i class="la la-envelope font-medium-5 line-height-1 text-muted icon-align"></i>
                        </div>
                        <small class="text-danger animated c_password fadeInUp edit_password"></small>
                    </div>


                </div>
                <div class="modal-footer">
                    <input type="reset" class="btn btn-danger" data-dismiss="modal" value="Close">
                    <input type="submit" class="btn btn-success PasswordButton" value="Submit">
                </div>
            </form>
        </div>
    </div>
</div>




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

            <div class="navbar-brand">
                <a href="{{ route('home') }}" class="logo">
                    <!-- Logo icon -->

                    <b class="logo-icon">
                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                        <!-- Dark Logo icon -->
                        <img src="{{asset('public/images/bcon_dark.png')}}" alt="homepage" class="dark-logo"
                            style="width:85%" />
                        <!-- Light Logo icon -->
                        <img src="{{asset('public/images/bcon.png')}}" alt="homepage" class="light-logo"
                            style="width:85%" />
                    </b>
                    <!--End Logo icon -->
                    <?php /*
                            <!-- Logo text -->
                            <span class="logo-text">
                                <!-- dark Logo text -->
                                <img src="{{asset('public/assets/images/APIWORX_Logo_Dark-small.png')}}" alt="homepage" class="dark-logo" />
                                <!-- Light Logo text -->
                                <img src="{{asset('public/assets/images/APIWORX_Logo_Dark-small.png')}}" class="light-logo" alt="homepage" />
                            </span>
							*/?>
                </a>
                <a class="sidebartoggler d-none d-md-block" href="javascript:void(0)" data-sidebartype="mini-sidebar">
                    <i class="mdi mdi-toggle-switch mdi-toggle-switch-off font-20"></i>
                </a>
            </div>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <i class="ti-more"></i>
            </a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-left mr-auto">
                <!-- <li class="nav-item d-none d-md-block">
                            <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar">
                                <i class="mdi mdi-menu font-24"></i>
                            </a>
                        </li> -->
                <!-- ============================================================== -->
                <!-- Search -->
                <!-- ============================================================== -->
                <!--<li class="nav-item search-box">
                            <a class="nav-link waves-effect waves-dark" href="javascript:void(0)">
                                <div class="d-flex align-items-center">
                                    <i class="mdi mdi-magnify font-20 mr-1"></i>
                                    <div class="ml-1 d-none d-sm-block">
                                        <span>Search</span>
                                    </div>
                                </div>
                            </a>
                            <form class="app-search position-absolute">
                                <input type="text" class="form-control" placeholder="Search &amp; enter">
                                <a class="srh-btn">
                                    <i class="ti-close"></i>
                                </a>
                            </form>
                        </li>-->
            </ul>
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-right">


                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark pro-pic" href="" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <img src="{{asset('public/assets/images/user.png')}}" alt="user" class="rounded-circle"
                            width="40">
                        <span class="m-l-5 font-medium d-none d-sm-inline-block">{{ Auth::user()->name }} <i
                                class="mdi mdi-chevron-down"></i></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                        <span class="with-arrow">
                            <span class="bg-primary"></span>
                        </span>
                        <div class="d-flex no-block align-items-center p-15 bg-primary text-white m-b-10">
                            <div class="">
                                <img src="{{asset('public/assets/images/user.png')}}" alt="user" class="rounded-circle"
                                    width="60">
                            </div>
                            <div class="m-l-10">
                                <h4 class="m-b-0">{{ Auth::user()->name }}</h4>
                                <p class=" m-b-0">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                        <div class="profile-dis scrollable">
                            <a class="dropdown-item editProfile" href="javascript:void(0)">
                                <i class="ti-user m-r-5 m-l-5"></i> Edit Profile</a>
                            <a class="dropdown-item editPassword" href="javascript:void(0)">
                                <i class="ti-lock m-r-5 m-l-5"></i> Change Password</a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                        </div>
                        <!--<div class="p-l-30 p-10">
                                    <a href="javascript:void(0)" class="btn btn-sm btn-success btn-rounded">View Profile</a>
                                </div>-->
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
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">

                @if(Auth::user()->category=='Admin' || Auth::user()->category=='User')
                <li class="sidebar-item @if($ActiveMenu=='Dashboard') selected @endif">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link @if($ActiveMenu=='Dashboard') active @endif"
                        href="{{ route('home') }}" aria-expanded="false">
                        <i class="mdi mdi-av-timer"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                @endif

                @if(Auth::user()->category=='Admin')

                <li class="sidebar-item @if($ActiveMenu=='Product Logs') selected @endif">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link @if($ActiveMenu=='Product Logs') active @endif"
                        href="{{ route('product-logs') }}" aria-expanded="false">
                        <i class="mdi mdi-cart-outline"></i>
                        <span class="hide-menu">Product Logs</span>
                    </a>
                </li>

                <li class="sidebar-item @if($ActiveMenu=='Sync Configuration') selected @endif">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link @if($ActiveMenu=='Sync Configuration') active @endif"
                        href="{{ route('configuration') }}" aria-expanded="false">
                        <i class="mdi mdi-settings-box"></i>
                        <span class="hide-menu">Sync Configuration</span>
                    </a>
                </li>

                <li class="sidebar-item @if($ActiveMenu=='Settings') selected @endif">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link @if($ActiveMenu=='Settings') active @endif"
                        href="{{ route('settings') }}" aria-expanded="false">
                        <i class="mdi mdi-settings-box"></i>
                        <span class="hide-menu">Settings</span>
                    </a>
                </li>

                @endif

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->

<div class="loaderAjax" style="display:none">Loading&#8230;</div>



