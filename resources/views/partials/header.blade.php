<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link rel="icon" href="img/favicon.png" type="image/png"/>
    <title>CTAoI - Connecting Students and Teachers - Find Home Tutors, Home Tuitions, Tution At Home, Tutoring Jobs for
        Math, Science, English and more &amp; Do part time Tutor Jobs and earn money!</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/flaticon.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/themify-icons.css')}}"/>
    <link rel="stylesheet" href="{{asset('vendors/owl-carousel/owl.carousel.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('vendors/nice-select/css/nice-select.css')}}"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>
    <!-- main css -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}" />
</head>

<body>
    <header class="header_area">
        <div class="main_menu">
      <!-- <div class="search_input" id="search_input_box">
        <div class="container">
          <form class="d-flex justify-content-between" action="/search" method="POST" role="search">
          {{ csrf_field() }}
            <input type="text" class="form-control" id="search_input" name="q" placeholder="Search Here" />
            <button type="submit" class="btn"></button>
            <span class="ti-close" id="close_search" title="Close Search"></span>
          </form>
        </div>
      </div> -->
            <nav class="navbar navbar-expand-lg bg-white">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="{{url('/')}}"><img src="{{asset('img/logo.png')}}" height="40px" alt="" /></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span> <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item {{ (request()->is('/')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{url('/')}}">Home</a>
                            </li>
                            <li class="nav-item @if(Request::is('coachings')) active @endif ">
                                <a class="nav-link" href="{{url('/coachings')}}">Coaching Centers</a>
                            </li>
                            <li class="nav-item {{ (request()->is('teachers')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{url('/teachers')}}">Tutors</a>
                            </li>
                            <li class="nav-item {{ (request()->is('about')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{url('/about')}}">About</a>
                            </li>
                            <li class="nav-item {{ (request()->is('contact')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{url('/contact')}}">Contact Us</a>
                            </li>
                            <li class="nav-item {{ (request()->is('login')) ? 'active' : '' }}">
                                @if(Auth::check())
                                <a class="nav-link" href="{{url('/home')}}">{{ Auth::user()->name }} Dashboard</a>
                                @else
                                <a class="nav-link" href="{{url('/login')}}">Login</a>
                            @endif
                        </li>
                        @if(!Auth::check())
                            <li class="nav-item {{ (request()->is('register')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{url('/register')}}">Register</a>
                            </li>
                         @endif
                    <!-- <li class="nav-item {{ (request()->is('search')) ? 'active' : '' }}">
                                <a href="{{url('/search')}}" class="nav-link search">
                                    <i class="ti-search"></i>
                                </a>
                            </li> -->
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
