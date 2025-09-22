<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>@yield('title', 'Nexhem')</title>
    <title>@yield('description', 'Nexham')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Nexham-Perfumes</title>
    <meta charset="UTF-8">
    <meta name="description" content="nexham">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,700;0,800;1,200;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome 6 (latest icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-utbXrsoPp+UQvZ9X2ZkYwFZ1gGZz7ZKXvZ+gkZzZzZzZzZzZzZzZzZzZzZzZzZzZzZzZzZz==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-3fKZzZzZzZzZzZzZzZzZzZzZzZzZzZzZzZzZzZzZzZzZzZzZzZzZzZzZzZzZz==" crossorigin="anonymous" referrerpolicy="no-referrer" />




    <link rel="stylesheet" href="{{asset('naxham/assets/css/animate.css')}}">

    <link rel="stylesheet" href="{{ asset('naxham/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('naxham/assets/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('naxham/assets/css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('naxham/assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('naxham/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('naxham/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('naxham/assets/css/flaticon.css') }}">



</head>


{{-- resources/views/layouts/app.blade.php ya jis layout ko use kar rahe ho --}}
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show mt-2 mx-3" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show mt-2 mx-3" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show mt-2 mx-3" role="alert">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif


<body>

    <div id="preloder">
        <div class="loader"></div>
    </div>


    <!-- Row 1: Top strip -->
    <div class="top-strip bg-dark text-light py-1 p-0 m-0">
        <div class="container-fluid">
            <div class="row d-flex align-items-center">
                <div class=" col-md-3 order-1 text-start d-none d-md-block">
                    <a href="tel:+923233810638 " class="text-light"><i class="bi bi-whatsapp  me-1"></i> +92 323 3810638</a>
                </div>
                <div class=" col-md-6 order-2 text-center ">
                    Free Delivery on orders above Rs. 2000
                </div>

                <div class=" col-md-3 order-3  text-end social d-none d-md-block">
                    <a href="#" class="text-light"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-light"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-light"><i class="bi bi-tiktok"></i></a>
                </div>
            </div>
        </div>
    </div>
    <hr class=" bg-light p-0 m-0">

    <!-- Row 2: Left sidebar button / Center logo / Right account+cart -->
    <div class="bg-dark py-2">
        <div class="container-fluid">
            <div class="row align-items-center g-2">

                {{-- Logo: left on lg, left half on small --}}
                <div class="col-6 col-lg-3 order-1 order-lg-1 d-flex align-items-center">
                    <a href="#" class="d-inline-block">
                        <img src="{{ asset('naxham/assets/images/logo.png') }}" alt="Logo" class="img-fluid" style="max-height:60px;">
                    </a>
                </div>

                {{-- Icons: right on lg, right half on small (same first row as logo) --}}
                <div class="col-6 col-lg-3 order-2 order-lg-3 d-flex justify-content-end align-items-center">
                    <ul class="navbar-nav flex-row align-items-center gap-2 mb-0">

                        @guest
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('signup') }}" class="btn btn-warning btn-sm">Signup</a>
                        </li>
                        @endguest

                        @auth
                        <li class="nav-item me-2">
                            <a href="{{ route('wishlist.index') }}" class="position-relative text-white text-decoration-none">
                                <i class="bi bi-heart fs-5"></i>
                                <span id="wishlist-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-light text-dark">
                                    {{ auth()->user()->wishlists()->count() ?? 0 }}
                                </span>
                            </a>
                        </li>

                        {{-- <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="userNotifDropdown" role="button"
       data-bs-toggle="dropdown" aria-expanded="false">
        🔔 <span id="user-notif-count" class="badge bg-danger">0</span>
    </a>
    <ul class="dropdown-menu dropdown-menu-end" id="user-notif-list" aria-labelledby="userNotifDropdown">
        <li><span class="dropdown-item">Loading...</span></li>
    </ul>
</li>
<div id="user-notif-popup" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999;"></div>
 --}}


                        </li>
                        @php
                        $cart = session()->get('cart', []);
                        $cartCount = array_sum(array_column($cart, 'quantity'));
                        @endphp

                        <li class="nav-item me-2">
                            <a href="{{ route('cart.view') }}" class="position-relative text-white text-decoration-none">
                                <i class="bi bi-bag fs-5"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-light text-dark">{{ $cartCount }}</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle me-2 fs-5"></i>

                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow bg-dark " aria-labelledby="userMenu">
                                <li><a class="dropdown-item text-light" href="#">{{ Auth::user()->name }}</a></li>
                                <hr class="dropdown-divider bg-dark">
                                <li><a class="dropdown-item text-light" href="#">My Profile</a></li>
                                <li><a class="dropdown-item text-light" href="#">Settings</a></li>
                                <li>
                                    <hr class="dropdown-divider bg-dark">
                                </li>
                                <li><a class="dropdown-item text-danger" href="{{ route('logout') }}">Logout</a></li>
                            </ul>
                        </li>
                        @endauth

                    </ul>
                </div>

                {{-- Search: centered on lg (middle column); second row centered on small --}}
                <div class="col-12 col-lg-6 order-3 order-lg-2">
                    <div class="d-flex justify-content-center mt-2 mt-lg-0">
                        <form action="" method="GET" class="w-100" style="max-width: 600px;">
                            <style>
                                .custom-search {
                                    border: 1px solid #ccc;
                                    border-radius: 8px;
                                    overflow: hidden;
                                    background: #f9f9f9;
                                }

                                .custom-search input {
                                    border: none;
                                    box-shadow: none;
                                    background: transparent;
                                    /* parent ka background inherit kare */
                                    color: #000;
                                    padding: 6px 10px;
                                    font-size: 14px;
                                }

                                .custom-search input:focus {
                                    outline: none;
                                    box-shadow: none;
                                }

                                .custom-search button {
                                    border: none;
                                    background: transparent;
                                    /* same background as parent */
                                    color: #000;
                                    padding: 6px 12px;
                                    font-size: 14px;
                                }

                                .custom-search button:hover {
                                    background: #e6e6e6;
                                    /* hover effect */
                                }
                            </style>

                            <div class="custom-search d-flex align-items-center">
                                <input type="text" name="q" placeholder="Search..." class="flex-grow-1">
                                <button type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    </div>
    <hr class=" bg-light p-0 m-0">
    <!-- Row 3: Main navigation -->
    <style>
        /* White toggler icon */
        .navbar-dark .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.5);
        }

        .navbar-dark .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba%28255,255,255,1%29' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }
    </style>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <!-- Left Side Toggler -->
            <button class="navbar-toggler me-auto" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Collapse Menu -->
            <div class="collapse navbar-collapse justify-content-end" id="mainNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="{{url('/')}}">Home</a></li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="shopDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="shopDropdown">
                            <a href="{{ url('shop') }}" class="btn py-2 px-4">Shop</a>
                            <li>
                                <a class="dropdown-item" href="{{ route('male', ['gender' => 'male']) }}">
                                    Male
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('male', ['gender' => 'female']) }}">
                                    Female
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('male', ['gender' => 'unisex']) }}">
                                    Unisex
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item"><a class="nav-link" href="#">Summer Deal</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('male', ['gender' => 'male']) }}">Male Perfume</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('male', ['gender' => 'female']) }}">Female Perfume</a></li>


                    <li class="nav-item dropdown">
                        {{-- <a class="nav-link dropdown-toggle" href="#" id="perfumeDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Perfume</a> --}}
                        {{-- <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="perfumeDropdown">
                            <li><a class="dropdown-item" href="#">All Perfumes</a></li>
                            <li><a class="dropdown-item" href="#">EDP</a></li>
                            <li><a class="dropdown-item" href="#">Attar</a></li>


                        </ul> --}}
                    <li class="nav-item"><a class="nav-link" href="{{ url('about') }}">About US</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('contact') }}">Contact US</a></li>

                    @if(Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('orders.my') }}">My Orders</a>
                    </li>
                    @endif


                    <!-- Add more nav-items as needed -->
                </ul>
            </div>
        </div>
    </nav>



    <!-- END nav -->
    <!-- Header section end -->


    @yield('content')



    <footer class="ftco-footer">
        <div class="container">
            <div class="row mb-5">
                <div class="col-sm-12 col-md">
                    <div class="ftco-footer-widget mb-4">
                        <a class="navbar-brand " href="#">
                            <img src="naxham/assets/images/logo.png" alt="logo" class="navbar-logo  ">
                        </a>
                        <p>Far far away, behind the word mountains, far from the countries.</p>
                        <ul class="ftco-footer-social list-unstyled mt-2">
                            <li class="ftco-animate"><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                            <li class="ftco-animate"><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                            <li class="ftco-animate"><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                        </ul>

                    </div>
                </div>
                <div class="col-sm-12 col-md">
                    <div class="ftco-footer-widget mb-4 ml-md-4">
                        <h2 class="ftco-heading-2">My Accounts</h2>
                        <ul class="list-unstyled">
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>My Account</a></li>
                            <li><a href="{{ url('register') }}"><span class="fa fa-chevron-right mr-2"></span>Register</a></li>
                            <li><a href="{{ url('login') }}"><span class="fa fa-chevron-right mr-2"></span>Log In</a></li>
                            <li><a href="{{ url('my-orders') }}"><span class="fa fa-chevron-right mr-2"></span>My Order</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md">
                    <div class="ftco-footer-widget mb-4 ml-md-4">
                        <h2 class="ftco-heading-2">Information</h2>
                        <ul class="list-unstyled">
                            <li><a href="{{ url('about') }}"><span class="fa fa-chevron-right mr-2"></span>About us</a></li>
                            {{-- <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Catalog</a></li> --}}
                            <li><a href="{{ url('contact') }}"><span class="fa fa-chevron-right mr-2"></span>Contact us</a></li>
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Term &amp; Conditions</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Quick Link</h2>
                        <ul class="list-unstyled">
                            {{-- <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>New User</a></li> --}}
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Help Center</a></li>
                            {{-- <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Report Spam</a></li> --}}
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Faq's</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Have a Questions?</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon fa fa-map marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
                                <li><a href="#"><span class="icon fa fa-phone"></span><span class="text">+2 392 3929 210</span></a></li>
                                <li><a href="#"><span class="icon fa fa-paper-plane pr-4"></span><span class="text">info@yourdomain.com</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid px-0 py-5 bg-black">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        <p class="mb-0" style="color: rgba(255,255,255,.5);">
                            Copyright &copy;<script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | This template is made with <i class="fa fa-heart color-danger" aria-hidden="true"></i> by <a href="https://ts-developers.com/" target="_blank">TS-Developers</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
        </svg></div>







    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function loadUserNotifications() {
    $.ajax({
        url: "{{ route('notifications.fetch') }}",
    method: 'GET',
    success: function(data) {
    let notifications = data.notifications;
    let list = $("#user-notif-list");
    let count = $("#user-notif-count");
    let popup = $("#user-notif-popup");

    list.empty();

    if(notifications.length > 0){
    count.text(notifications.length);

    notifications.forEach(function(notif){
    // Dropdown
    list.append(`
    <li class="d-flex justify-content-between align-items-center px-2">
        <a class="dropdown-item" href="#">
            ${notif.data.message}
        </a>
        <button class="btn btn-sm btn-link text-danger" onclick="deleteUserNotif('${notif.id}')">
            ❌
        </button>
    </li>
    `);

    // Popup
    popup.append(`
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        ${notif.data.message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    `);
    });
    } else {
    count.text(0);
    list.append('<li><span class="dropdown-item">No new notifications</span></li>');
    }
    }
    });
    }

    function deleteUserNotif(id){
    $.ajax({
    url: "/notifications/delete/" + id,
    method: 'DELETE',
    data: {_token: "{{ csrf_token() }}"},
    success: function(){
    loadUserNotifications();
    }
    });
    }

    // Page load pe call
    loadUserNotifications();

    // Har 10 second baad refresh
    setInterval(loadUserNotifications, 10000);
    </script>


    --}}


</body>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Owl Carousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<!-- Carousel Initialization -->
<script>
    $(document).ready(function() {
        $('#hero-carousel').owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            autoplayTimeout: 8000,
            smartSpeed: 900,
            nav: false,
            dots: true
        });
    });
</script>


<script src="{{ asset('naxham/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('naxham/assets/js/jquery-migrate-3.0.1.min.js') }}"></script>
<script src="{{ asset('naxham/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('naxham/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('naxham/assets/js/jquery.easing.1.3.js') }}"></script>
<script src="{{ asset('naxham/assets/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('naxham/assets/js/jquery.stellar.min.js') }}"></script>
<script src="{{ asset('naxham/assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('naxham/assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('naxham/assets/js/jquery.animateNumber.min.js') }}"></script>
<script src="{{ asset('naxham/assets/js/scrollax.min.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



<script src="{{ asset('naxham/assets/js/google-map.js') }}"></script>
<script src="{{ asset('naxham/assets/js/main.js') }}"></script>




</html>
