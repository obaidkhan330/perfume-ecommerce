<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>@yield('title', 'Nexhem')</title>
    <title>@yield('description', 'Nexham')</title>
    <title>Nexham-Perfumes</title>
    <meta charset="UTF-8">
    <meta name="description" content="EndGam Gaming Magazine Template">
    <meta name="keywords" content="endGam,gGaming, magazine, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i,900,900i" rel="stylesheet">


    <link href="https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,700;0,800;1,200;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />


    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">





    <link rel="stylesheet" href="{{asset('naxham/assets/css/animate.css')}}">

    <link rel="stylesheet" href="{{ asset('naxham/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('naxham/assets/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('naxham/assets/css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('naxham/assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('naxham/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('naxham/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('naxham/assets/css/flaticon.css') }}">



</head>

<body>

    <div id="preloder">
        <div class="loader"></div>
    </div>


    <!-- Row 1: Top strip -->
    <div class="top-strip bg-dark text-light py-1">
        <div class="container-fluid">
            <div class="row d-flex align-items-center">
                <div class=" col-md-3 order-1 text-start ">
                    <a href="tel:+923233810638 " class="text-light"><i class="bi bi-whatsapp  me-1"></i> +92 323 3810638</a>
                </div>
                <div class=" col-md-6 order-2 text-center d-none d-md-block">
                    Free Delivery on orders above Rs. 2000
                </div>

                <div class=" col-md-3 order-3 text-end social">
                    <a href="#" class="text-light"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-light"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-light"><i class="bi bi-tiktok"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 2: Left sidebar button / Center logo / Right account+cart -->
    <div class="mid-row bg-dark">
        <div class="container-fluid ">
            <div class="row d-flex align-items-center ">
                <div class=" col-md-4 my-3">
                    <div class="row justify-content-center">
                        <div class="col-12" style="max-width: 300px;">
                            <div style="display: flex; align-items: center;">
                                <input type="text"
                                    placeholder="Search..."
                                    style="height:28px; font-size: 12px; padding: 2px 6px; border:1px solid #ccc; border-radius:4px 0 0 4px; flex:1;">
                                <button style="height:28px; background: #36383aff; color:#fff; border:1px solid #0d6efd; border-radius:0 4px 4px 0; padding:0 8px; display:flex; align-items:center; justify-content:center;">
                                    <i class="fa fa-search " style="font-size:12px;"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Center: Logo -->

                <div class="col-md-4  d-none d-md-block my-0">
                    <a href="#" class="brand-logo d-inline-block text-center">
                        <!-- replace src with your logo -->
                        <img src="{{ asset('naxham/assets/images/logo.png') }}" alt=" Logo" width="200px" height="100px">
                    </a>
                </div>

                <!-- Responsive Search Bar -->

                <div class="col-md-4 my-2">







                    <!-- Right: Account + Cart -->
                    <div class="header-icons d-flex justify-content-center align-items-center g-0">

                        <a href="#" class="ms-3 position-relative" title="Cart">
                            <i class="bi bi-bag" style="color: #fff; margin-left: 10px;"></i>
                            <span class="badge bg-dark rounded-pill">0</span>
                        </a>
                        <a href="#" class="ms-3 position-relative" title="Cart">
                            <i class="bi bi-heart" style="color: #fff; margin-left: 10px; margin-right: 15px;"></i>
                            <span class="badge bg-dark rounded-pill me-3">0</span>
                        </a>

                        <ul class="navbar-nav  d-flex flex-row align-items-center gap-2">
                            @guest
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Login</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('signup') }}" class="btn btn-warning btn-sm">Signup</a>
                            </li>
                            @endguest

                            @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userMenu"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-circle me-2" style="font-size: 1.3rem;"></i>
                                    <span>Welcome, {{ Auth::user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userMenu">
                                    <li><a class="dropdown-item text-dark" href="#">My Profile</a></li>
                                    <li><a class="dropdown-item text-dark" href="#">Settings</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item text-danger" href="{{ route('logout') }}">Logout</a></li>
                                </ul>
                            </li>
                            @endauth
                        </ul>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 3: Main navigation -->
    <nav class="navbar navbar-expand-lg bg-dark text-light  main-nav">
        <div class="container">
            <!-- Toggle Button -->
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#ftco-navbar" aria-controls="ftco-navbar" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span> Menu
</button> --}}

            <div class="collapse navbar-collapse justify-content-center" id="mainNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>

                    <!-- Shop (12 items) -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="shopDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                        <ul class="dropdown-menu" aria-labelledby="shopDropdown">
                            <li><a class="dropdown-item" href="#">Item 01</a></li>
                            <li><a class="dropdown-item" href="#">Item 02</a></li>
                            <li><a class="dropdown-item" href="#">Item 03</a></li>
                            <li><a class="dropdown-item" href="#">Item 04</a></li>
                            <li><a class="dropdown-item" href="#">Item 05</a></li>

                        </ul>
                    </li>

                    <li class="nav-item"><a class="nav-link" href="#">Summer Deal</a></li>

                    <!-- Perfume dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="perfumeDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Perfume</a>
                        <ul class="dropdown-menu" aria-labelledby="perfumeDropdown">
                            <li><a class="dropdown-item" href="#">All Perfumes</a></li>
                            <li><a class="dropdown-item" href="#">EDP</a></li>
                            <li><a class="dropdown-item" href="#">Attar</a></li>
                            <li><a class="dropdown-item" href="#">Body Spray</a></li>
                        </ul>
                    </li>

                    <!-- Female dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="femaleDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Female</a>
                        <ul class="dropdown-menu" aria-labelledby="femaleDropdown">
                            <li><a class="dropdown-item" href="#">Top Picks</a></li>
                            <li><a class="dropdown-item" href="#">Gift Sets</a></li>
                            <li><a class="dropdown-item" href="#">New Arrivals</a></li>
                        </ul>
                    </li>


                    {{-- male dropdown    --}}

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="femaleDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Male</a>
                        <ul class="dropdown-menu" aria-labelledby="femaleDropdown">
                            <li><a class="dropdown-item" href="#">Top Picks</a></li>
                            <li><a class="dropdown-item" href="#">Gift Sets</a></li>
                            <li><a class="dropdown-item" href="#">New Arrivals</a></li>
                        </ul>
                    </li>

                    <li class="nav-item"><a class="nav-link" href="#">Bundles</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Gold Edition</a></li>

                    <!-- Pages (extra) -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Pages</a>
                        <ul class="dropdown-menu" aria-labelledby="pagesDropdown">
                            <li><a class="dropdown-item" href="#">About Us</a></li>
                            <li><a class="dropdown-item" href="#">Contact Us</a></li>
                            <li><a class="dropdown-item" href="#">Track Order</a></li>
                            <li><a class="dropdown-item" href="#">Wishlist</a></li>
                            <li><a class="dropdown-item" href="#">Login</a></li>
                            <li><a class="dropdown-item" href="#">Signup</a></li>
                        </ul>
                    </li>
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
                            <li class="ftco-animate"><a href="#"><span class="fa fa-twitter"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="fa fa-facebook"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="fa fa-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md">
                    <div class="ftco-footer-widget mb-4 ml-md-4">
                        <h2 class="ftco-heading-2">My Accounts</h2>
                        <ul class="list-unstyled">
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>My Account</a></li>
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Register</a></li>
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Log In</a></li>
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>My Order</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md">
                    <div class="ftco-footer-widget mb-4 ml-md-4">
                        <h2 class="ftco-heading-2">Information</h2>
                        <ul class="list-unstyled">
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>About us</a></li>
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Catalog</a></li>
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Contact us</a></li>
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Term &amp; Conditions</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Quick Link</h2>
                        <ul class="list-unstyled">
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>New User</a></li>
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Help Center</a></li>
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Report Spam</a></li>
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
                            </script> All rights reserved | This template is made with <i class="fa fa-heart color-danger" aria-hidden="true"></i> by <a href="" target="_blank">Obaidullah Faisal</a>
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


</body>

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
