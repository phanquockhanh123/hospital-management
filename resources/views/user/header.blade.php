<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- <meta name="copyright" content="MACode ID, https://macodeid.com/"> --}}

    <title>PHÒNG KHÁM ĐA KHOA AN KHANG</title>

    <link rel="stylesheet" href="{{ asset('../assets/css/maicons.css') }}">

    <link rel="stylesheet" href="{{ asset('../assets/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('../assets/vendor/owl-carousel/css/owl.carousel.css') }}">

    <link rel="stylesheet" href="{{ asset('../assets/vendor/animate/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('../assets/css/theme.css') }}">
    <style>
        .imageBackground {
            background: url(https://www.columbiaasia.com/malaysia/sites/default/files/packages/general-package-setapak-banner.jpg) top center no-repeat;
            background-size: cover;
            position: relative;
        }

        .btnMessage {
            position: fixed;
            bottom: 20px;
            right: 100px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(221, 221, 221, 0.7);
            visibility: visible;
            cursor: pointer;
            transition: all .2s ease;
            z-index: 1100;
        }

        #chatModal {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 10px;
            width: 300px;
        }

        #chatBody {
            height: 200px;
            overflow-y: auto;
        }

        #chatForm {
            display: flex;
            margin-top: 10px;
        }

        #chatInput {
            flex-grow: 1;
            margin-right: 10px;
        }

        #chatBtn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 50%;
            cursor: pointer;
        }
    </style>

</head>

<body>

    <!-- Back to top button -->
    <div class="back-to-top"></div>

    @if (Auth::user()?->id)
        <a class="btnMessage" href="{{ route('chats.index') }}" style="text-decoration: none;">
            <div class="circle-shape bg-secondary text-white">
                <span class="mai-chatbubbles-outline"></span>
            </div>
        </a>
    @endif
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
                <a class="navbar-brand" href="{{ route('home.index') }}" style="font-size: 30px;">
                    <img src="https://th.bing.com/th/id/R.7341cd8295fecb9385f968b1f56715a7?rik=mSAa%2bJFXDvBT7Q&pid=ImgRaw&r=0"
                        height="150px" width="150px" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                        style="opacity: .8; ">
                    {{-- <span class="text-primary">An </span> Khang --}}
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport"
                    aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupport">
                    <ul class="navbar-nav ml-auto" name="navEle" id="navEle" style="font-size: 24px;">
                        <li class="nav-item  @if (Request::route()->getName() == 'home.index') active @endif">
                            <a class="nav-link" href="{{ route('home.index') }}">Trang chủ</a>
                        </li>
                        <li class="nav-item @if (Request::route()->getName() == 'home.about') active @endif">
                            <a class="nav-link" href="{{ route('home.about') }}">Giới thiệu</a>
                        </li>
                        <li class="nav-item @if (Request::route()->getName() == 'home.get-doctor-list-for-user-site') active @endif">
                            <a class="nav-link" href="{{ route('home.get-doctor-list-for-user-site') }}">Bác sĩ</a>
                        </li>
                        <li class="nav-item @if (Request::route()->getName() == 'home.blog') active @endif">
                            <a class="nav-link" href=" {{ route('home.blog') }}">Tin tức</a>
                        </li>
                        <li class="nav-item @if (Request::route()->getName() == 'home.contact') active @endif">
                            <a class="nav-link" href=" {{ route('home.contact') }}">Liên hệ</a>
                        </li>
                        <li class="nav-item @if (Request::route()->getName() == 'home.book-appointment-user') active @endif">
                            <a class="nav-link" href="{{ route('home.book-appointment-user') }}">Đặt lịch</a>
                        </li>

                        @if (isset(Auth::user()->id) && Auth::user()->role == 0)
                            <div class="dropdown show">
                                <a class="btn btn-secondary dropdown-toggle"
                                    style="background-color: white; border: 0px " href="#" role="button"
                                    id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <img src="@if (!empty($patient->filename)) ./imgPatient/{{ $patient->filename }}@else https://cdn.iconscout.com/icon/premium/png-256-thumb/patient-2460481-2128797.png @endif"
                                        style="background-color: #00D9A5;border-radius: 50%;vertical-align: middle;
                                                                    width: 50px;
                                                                    height: 50px;
                                                                    border-radius: 50%;">
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item">{{ Auth::user()->name }}</a>
                                    <a class="dropdown-item" href="{{ route('user.get-info-patient') }}">Thông tin
                                        bệnh
                                        nhân</a>
                                    <a class="dropdown-item" href="{{ route('home.logout-with-google') }}">Đăng
                                        xuất</a>
                                </div>
                            </div>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('home.login-with-google') }}"><button class="btn btn-primary"
                                        type="submit"
                                        style="margin-left: 10px;font-size: 16px;padding: 10px 40px;">Đăng
                                        nhập</button></a>
                            </li>
                        @endif


                    </ul>
                </div> <!-- .navbar-collapse -->
            </div> <!-- .container -->
        </nav>
    </header>
    <script>
        var chatBtn = document.getElementById('chatBtn');
        var chatModal = document.getElementById('chatModal');
        var chatForm = document.getElementById('chatForm');
        var chatInput = document.getElementById('chatInput');
        var chatBody = document.getElementById('chatBody');

        chatBtn.addEventListener('click', function() {
            chatModal.style.display = 'block';
            chatInput.focus();
        });

        chatForm.addEventListener('submit', function(e) {
            e.preventDefault();
            var message = chatInput.value.trim();
            if (message !== '') {
                var messageElement = document.createElement('div');
                messageElement.textContent = message;
                chatBody.appendChild(messageElement);
                chatInput.value = '';
                chatInput.focus();
            }
        });

        window.addEventListener('click', function(e) {
            if (e.target == chatModal) {
                chatModal.style.display = 'none';
            }

            chatBtn.addEventListener('click', () => {
                chatModal.style.display = 'none';
            });
        });
    </script>
