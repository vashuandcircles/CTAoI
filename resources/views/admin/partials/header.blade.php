<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>CTAoI Admin Panel</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                <div class="sidebar-brand-text mx-3">CTAoI Admin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ (request()->is('home')) ? 'active' : '' }}">
                <a class="nav-link" href="/home">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->

            <li class="nav-item {{ (request()->is('teacher-page')) ? 'active' : '' }}">
                <a class="nav-link" href="{{url('/teacher-page')}}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Teachers</span></a>
            </li>
            <li class="nav-item {{ (request()->is('coaching-page')) ? 'active' : '' }}">
                <a class="nav-link" href="{{url('/coaching-page')}}">
                    <i class="fas fa-fw fa-chalkboard-teacher"></i>
                    <span>Coaching</span></a>
            </li>
 
            <li class="nav-item {{ (request()->is('coaching-request')) ? 'active' : '' }} {{ (request()->is('teacher-request')) ? 'active' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Registration Requests</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{url('/coaching-request')}}">Coaching Requests</a>
                        <a class="collapse-item" href="{{url('/teacher-request')}}">Teacher Requests</a>
                    </div>
                </div>
            </li>
            <li class="nav-item {{ (request()->is('featured-coaching-page')) ? 'active' : '' }} {{ (request()->is('featured-teacher-page')) ? 'active' : '' }}">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                    <i class="fas fa-fw fa-star"></i>
                    <span>Featured Listing</span>
                </a>
                <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ url('/featured-coaching-page')}}">Featured Coachings</a>
                        <a class="collapse-item" href="{{ url('/featured-teacher-page')}}">Featured Teachers</a>
                    </div>
                </div>
            </li>
            <li class="nav-item {{ (request()->is('subscription')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/subscription') }}">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Subscriptions</span></a>
            </li>
            <li class="nav-item {{ (request()->is('enquiry')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/enquiry') }}">
                    <i class="fas fa-fw fa-list"></i>
                    <span>Enquiry</span></a>
            </li>
            </li>
            <li class="nav-item {{ (request()->is('event')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/event') }}">
                    <i class="fas fa-fw fa-calendar"></i>
                    <span>Event</span></a>
            </li>
            <li class="nav-item {{ (request()->is('level')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/level') }}">
                    <i class="fas fa-fw fa-tasks"></i>
                    <span>Levels</span></a>
            </li>
            <!-- Divider -->
            <!-- <hr class="sidebar-divider"> -->

            <!-- Heading -->
            <!-- <div class="sidebar-heading">
                Addons
            </div> -->

            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>State & City</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li> -->
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="modal" data-target="#logoutModal" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ Auth::user()->name }} Logout</span>
                            </a>
                        </li>

                    </ul>

                </nav>