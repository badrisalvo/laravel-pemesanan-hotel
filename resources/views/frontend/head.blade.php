<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Persamaan Hotel & Resort menawarkan pengalaman penginapan yang nyaman dengan fasilitas terbaik untuk liburan Anda. Pesan sekarang!">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="hotel, resort, penginapan, liburan, Persamaan Hotel, wisata, akomodasi">
    <meta name="robots" content="index, follow">
    <title>Persamaan - Hotel & Resort</title>
    <link rel="icon" href="https://images2.imgbox.com/ab/88/KcPFU7Qi_o.png">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_green.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
</head>

<body>
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <header class="header-area">
        <div class="search-form d-flex align-items-center">
            <div class="container">
                <form action="index.html" method="get">
                    <input type="search" name="search-form-input" id="searchFormInput" placeholder="Type your keyword ...">
                    <button type="submit"><i class="icon_search"></i></button>
                </form>
            </div>
        </div>
        <div class="top-header-area">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <div class="top-header-content">
                            <a href="#"><i class="icon_phone"></i> <span>(123) 456-789-1230</span></a>
                            <a href="#"><i class="icon_mail"></i> <span>persamaan_hotel@gmail.com</span></a>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="top-header-content">
                            <div class="top-social-area ml-auto">
                                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-tripadvisor" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-header-area">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <nav class="classy-navbar justify-content-between" id="robertoNav">
                        <a class="nav-brand" href="/"><img src="{{ asset('img/core-img/persamaan.png') }}" alt="" style=" height: 70px; width: auto;"></a>
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>
                        <div class="classy-menu">
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>
                            <div class="classynav">
                                <ul id="nav">
                                    <li class="active"><a href="/">Home</a></li>
                                    <li><a href="/room">Rooms</a></li>
                                    @auth
                                    <li><a href="/bookings">My Bookings</a></li>
                                    <li><a href="#">Profile</a>
                                        <ul class="dropdown">
                                            <li><a href="#">{{ Auth::user()->name }}</a></li>
                                            @if(Auth::user()->role === 'admin')
                                                <li><a href="/admin">Admin Page</a></li>
                                            @endif
                                            <li><a href="{{ route('user.profile') }}">Edit Profil</a></li>
                                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form'). submit();">Logout</a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                    </li>
                                    @endauth
                                    @guest
                                    <li><a href="#" id="loginBtn">Login</a></li>
                                    @endguest
                                </ul>
                                <div class="book-now-btn ml-3 ml-lg-5">
                                    <a href="{{ route('checkAvailability') }}">Booking Sekarang <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close" id="loginClose">&times;</span>
            <div id="login-alert" class="alert d-none"></div>
            <form id="loginForm" class="modal-form">
                @csrf
                <h4 class="text-white">Login Page</h4>
                <div class="form-group">
                    <label for="login-email">Email address</label>
                    <input type="email" class="form-control" id="login-email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="login-password">Password</label>
                    <input type="password" class="form-control" id="login-password" name="password" required>
                </div>
                <button type="button" class="btn btn-primary" id="loginSubmit">Login</button>
                <button type="button" class="btn btn-secondary" id="openRegisterModal">Register</button>
                <p style="color: red;">Forgot Password ?<a href="/forgot-password"> Click Here</a></p>
            </form>
        </div>
    </div>
    <div id="registerModal" class="modal">
        <div class="modal-content">
            <span class="close" id="registerClose">&times;</span>
            <div id="register-alert" class="alert d-none"></div>
            <form id="registerForm" class="modal-form">
                @csrf
                <h4 class="text-white">Register Page</h4>
                <div class="form-group">
                    <label for="register-name">Name</label>
                    <input type="text" class="form-control" id="register-name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="register-email">Email Address</label>
                    <input type="email" class="form-control" id="register-email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="register-phone">Phone Number</label>
                    <input type="text" class="form-control" id="register-phone" name="phone" title="Phone number must be in international format (e.g., +1234567890)">
                </div>
                <div class="form-group">
                    <label for="register-password">Password</label>
                    <input type="password" class="form-control" id="register-password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="register-password-confirmation">Confirm Password</label>
                    <input type="password" class="form-control" id="register-password-confirmation" name="password_confirmation" required>
                </div>
                <button type="button" class="btn btn-primary" id="registerSubmit">Register</button>
                <button type="button" class="btn btn-secondary" id="openLoginModal">Login</button>
                <p style="color: red;">Forgot Password ?<a href="/forgot-password"> Click Here</a></p>
            </form>
        </div>
    </div>
    <script>
        const routes = {
            login: "{{ route('login') }}",
            register: "{{ route('register') }}"
        };
    </script>
    <script src="{{ asset('js/loreg.js') }}"></script>
</body>
</html>