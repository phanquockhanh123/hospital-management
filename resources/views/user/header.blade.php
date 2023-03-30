<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <meta name="copyright" content="MACode ID, https://macodeid.com/">

  <title>Phòng Khám Đa Khoa Quốc Tế HÀ NỘI</title>

  <link rel="stylesheet" href="{{ asset('../assets/css/maicons.css') }}">

  <link rel="stylesheet" href="{{ asset('../assets/css/bootstrap.css') }}">

  <link rel="stylesheet" href="{{ asset('../assets/vendor/owl-carousel/css/owl.carousel.css') }}">

  <link rel="stylesheet" href="{{ asset('../assets/vendor/animate/animate.css') }}">

  <link rel="stylesheet" href="{{ asset('../assets/css/theme.css') }}">
  <style>
    .imageBackground {
        background: url(https://www.columbiaasia.com/malaysia/sites/default/files/packages/general-package-setapak-banner.jpg)  top center no-repeat;
        background-size: cover;
        position: relative;
      }

      
  </style>

</head>

<body>

  <!-- Back to top button -->
  <div class="back-to-top"></div>

  <header>
    <div class="topbar">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 text-sm">
            <div class="site-info">
              <a href="#"><span class="mai-call text-primary"></span> 0327018337</a>
              <span class="divider">|</span>
              <a href="#"><span class="mai-mail text-primary"></span> khanhphanquoc68@gmail.com</a>
            </div>
          </div>
          <div class="col-sm-4 text-right text-sm">
            <div class="social-mini-button">
              <a href="#"><span class="mai-logo-facebook-f"></span></a>
              <a href="#"><span class="mai-logo-twitter"></span></a>
              <a href="#"><span class="mai-logo-dribbble"></span></a>
              <a href="#"><span class="mai-logo-instagram"></span></a>
            </div>
          </div>
        </div> <!-- .row -->
      </div> <!-- .container -->
    </div> <!-- .topbar -->

    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="#"><span class="text-primary">One</span>-Health</a>

        {{-- <form action="#">
          <div class="input-group input-navbar">
            <div class="input-group-prepend">
              <span class="input-group-text" id="icon-addon1"><span class="mai-search"></span></span>
            </div>
            <input type="text" class="form-control" placeholder="Enter keyword.." aria-label="Username"
              aria-describedby="icon-addon1">
          </div>
        </form> --}}

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport"
          aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupport">
          <ul class="navbar-nav ml-auto" name="navEle" id="navEle">
            <li class="nav-item  @if(Request::route()->getName() == 'home.index') active @endif">
              <a class="nav-link" href="{{ route('home.index')}}">Trang chủ</a>
            </li>
            <li class="nav-item @if(Request::route()->getName() == 'home.about') active @endif">
              <a class="nav-link" href="{{route('home.about')}}">Giới thiệu</a>
            </li>
            <li class="nav-item @if(Request::route()->getName() == 'home.get-doctor-list-for-user-site') active @endif">
              <a class="nav-link" href="{{route('home.get-doctor-list-for-user-site')}}">Bác sĩ</a>
            </li>
            <li class="nav-item @if(Request::route()->getName() == 'home.blog') active @endif">
              <a class="nav-link" href=" {{ route('home.blog') }}">Blog</a>
            </li>
            <li class="nav-item @if(Request::route()->getName() == 'home.contact') active @endif">
              <a class="nav-link" href="contact.html">Liên hệ</a>
            </li>
            <li class="nav-item">
              <a href="{{route('home.book-appointment-user')}}"><button class="btn btn-primary" type="submit" style="padding: 10px 40px;font-size: 16px;">Đặt lịch</button></a>
            </li>
            @if(!Auth::user()->id) 
            <li class="nav-item">
              <a href="{{ route('home.login-with-google') }}"><button class="btn btn-primary" type="submit" style="margin-left: 10px;font-size: 16px;padding: 10px 40px;">Đăng nhập</button></a>
            </li>
            @else
              <li class="nav-item">
                <a href="#"><button class="btn btn-primary" type="submit" style="margin-left: 10px;font-size: 16px;padding: 10px 40px;">{{ Auth::user()->name }}</button></a>
              </li>
            @endif
          </ul>
        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>
  </header>