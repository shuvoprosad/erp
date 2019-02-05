<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Advert </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description" />
        <meta content="Advert erp" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

        <!-- third party css -->
        @yield('css')
        <!-- third party css end -->

        <!-- Animation css -->
        <link href="{{ asset('assets/libs/animate/animate.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- App css -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    </head>

<body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            <div class="navbar-custom">
                <ul class="list-unstyled topnav-menu float-right mb-0">

                    <li class="d-none d-sm-block">
                        <form class="app-search">
                            <div class="app-search-box">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <div class="input-group-append">
                                        <button class="btn" type="submit">
                                            <i class="fe-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </li>

                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="pro-user-name ml-1">
                                {{ Auth::user()->name }} <i class="mdi mdi-chevron-down"></i> 
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                            
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-user"></i>
                                <span>My Account</span>
                            </a>
                            <div class="dropdown-divider"></div>

                            <!-- item-->
                            <a class="dropdown-item notify-item" href="{{ route('logout') }}"
                            	onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="fe-log-out"></i>
                                <span>Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                        </div>
                    </li>
                </ul>

                <!-- LOGO -->
                <div class="logo-box">
                    <a href="index.html" class="logo text-center">
                        <span class="logo-lg">
                            {{-- <img src="assets/images/logo-light.png" alt="" height="18"> --}}
                            <!-- <span class="logo-lg-text-light">UBold</span> -->
                        </span>
                        <span class="logo-sm">
                            <!-- <span class="logo-sm-text-dark">U</span> -->
                            {{-- <img src="assets/images/logo-sm.png" alt="" height="24"> --}}
                        </span>
                    </a>
                </div>

                <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                    <li>
                        <button class="button-menu-mobile waves-effect waves-light">
                            <i class="fe-menu"></i>
                        </button>
                    </li>
        
                    <li class="dropdown d-none d-lg-block">
                        <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            Create New
                            <i class="mdi mdi-chevron-down"></i> 
                        </a>
                        <div class="dropdown-menu">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class="fe-briefcase mr-1"></i>
                                <span>New Projects</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class="fe-user mr-1"></i>
                                <span>Create Users</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class="fe-bar-chart-line- mr-1"></i>
                                <span>Revenue Report</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class="fe-settings mr-1"></i>
                                <span>Settings</span>
                            </a>

                            <div class="dropdown-divider"></div>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class="fe-headphones mr-1"></i>
                                <span>Help & Support</span>
                            </a>

                        </div>
                    </li>

                </ul>
            </div>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu">

                <div class="slimscroll-menu">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul class="metismenu" id="side-menu">

                            <li class="menu-title">Navigation</li>

                            <li>
                                <a href="javascript: void(0);">
                                    <i class="fe-airplay"></i>
                                    <span class="badge badge-success badge-pill float-right">4</span>
                                    <span> Dashboards </span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href="index.html">Dashboard 1</a>
                                    </li>
                                    <li>
                                        <a href="dashboard-2.html">Dashboard 2</a>
                                    </li>
                                    <li>
                                        <a href="dashboard-3.html">Dashboard 3</a>
                                    </li>
                                    <li>
                                        <a href="dashboard-4.html">Dashboard 4</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="menu-title mt-2">Pages</li>

                            <li>
                                <a href="javascript: void(0);">
                                    <i class="fe-folder-plus"></i>
                                    <span> HR </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level nav" aria-expanded="false">
                                    <li>
                                        <a href="{{ route('users.index') }}">User</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('roles.index') }}">Role</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('salaries.index') }}">Salary</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('customers.index') }}">Customers</a>
                                    </li>

                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);">
                                    <i class="fe-folder-plus"></i>
                                    <span> Products </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level nav" aria-expanded="false">
                                    <li>
                                        <a href="{{ route('products.index') }}">Inventory</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('productleads.index') }}">Leads</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('productorders.index') }}">Orders</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);">
                                    <i class="fe-folder-plus"></i>
                                    <span> Drop downs </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level nav" aria-expanded="false">
                                    <li>
                                        <a href="{{ route('address.index')}}">Address</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('status0.index')}}">Status 0</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('status1.index')}}">Status 1</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('status2.index')}}">Status 2</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('note2.index')}}">Note 2</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('paymentmethod.index') }}">Payment methods</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('paymentnumber.index') }}">Payment number</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('usertype.index') }}">User Type</a>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                        
                    </div>
                    <!-- End Sidebar -->
                    
                    <div class="clearfix"></div>
                    
                </div>
                <!-- Sidebar -left -->
                
            </div>
            <!-- Left Sidebar End -->
            
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        @yield('content')
                    </div> <!-- container -->
                    
                </div>
            </div>
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item ">
                                <a class="nav-link " >
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                
                                    <a class="" href="{{ route('logout') }}"
                                    	onclick="event.preventDefault();
                                        document.getElementById('logout-form1').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form1" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                            </li>
                        @endguest
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->


        <!-- Vendor js -->
        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

        <!-- third party js -->
        @yield('javascript')
        <!-- third party js ends -->
        
        <!-- App js -->
        @yield('javascript_end')
        <script src="{{ asset('assets/js/app.min.js') }}"></script>
        
    </body>
</html>
