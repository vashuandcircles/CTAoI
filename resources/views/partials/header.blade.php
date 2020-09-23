<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" href="img/favicon.png" type="image/png" />
    <title>CTAoI - Connecting Students and Teachers - Find Home Tutors, Home Tuitions, Tution At Home, Tutoring Jobs for Math, Science, English and more &amp; Do part time Tutor Jobs and earn money!</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/flaticon.css" />
    <link rel="stylesheet" href="css/themify-icons.css" />
    <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- main css -->
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <header class="header_area">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg bg-white">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="{{url('/')}}"><img src="img/logo.png" height="40px" alt="" /></a>
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
                            <li class="nav-item {{ (request()->is('team')) ? 'active' : '' }}">
                                <a class="nav-link" href="#">Our Team</a>
                            </li>
                            <li class="nav-item {{ (request()->is('contact')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{url('/contact')}}">Contact Us</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a href="#" class="nav-link search" id="search">
                                    <i class="ti-search"></i>
                                </a>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>