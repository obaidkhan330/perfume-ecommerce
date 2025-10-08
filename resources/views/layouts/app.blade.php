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
<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,900" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Spectral:wght@200;300;400;500;700;800&display=swap" rel="stylesheet">

<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome 6 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<!-- Owl Carousel CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

  <!-- Custom CSS -->
<style>.top-bar{background:#0c0c0c;color:#fff;font-size:13px;margin:0;padding:12px}.top-bar .social-icons{padding-top:0;position:relative;top:-18px}.top-bar .social-icons i{margin-left:12px;color:#fff;cursor:pointer;transition:.3s;margin-top:0}.top-bar .social-icons i:hover{color:#d4af37}.main-header{background:#0c0c0c;padding:10px 0;box-shadow:0 2px 5px rgba(69,65,65,.1);position:sticky;top:0;z-index:1000}.header-icons i{font-size:22px;color:#fff;margin:0 8px;cursor:pointer}.header-icons span{margin-right:15px;font-size:14px;color:#fff}.search-box{position:relative}.search-box input{width:250px;padding-left:40px}.search-box i{position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#555}.search-box .navbar-toggler{font-size:20px;color:#fff;position:relative;left:-50px;top:20px}.search-box .navbar-toggler i{color:#fff}.mobile-search{display:none;position:fixed;top:0;left:0;width:100%;padding:15px;box-shadow:0 4px 10px rgba(0,0,0,.1);z-index:3000;align-items:center;gap:10px;animation:slideDown .3s ease}.mobile-search input{flex:1;border-radius:30px;border:1px solid #ccc;padding:15px}.mobile-search .close-btn{font-size:22px;color:#fff;cursor:pointer}@keyframes slideDown{from{transform:translateY(-100%);opacity:0}to{transform:translateY(0);opacity:1}}@media(max-width:991px){.search-box{display:none!important}.navbar-brand{margin-right:auto!important}.header-icons{margin-left:auto}.header-icons .search-trigger{display:inline-block!important}}.search-trigger{display:none}.nav-small{background-color:#515151;width:100%;z-index:1200;transition:all .4s ease}.nav-small.hidden{transform:translateY(-105%);opacity:0}.nav-small .container>ul{list-style:none;display:flex;justify-content:center;flex-wrap:wrap;margin:0;padding:0}.nav-small .container>ul>li{position:relative;padding:15px 20px}.nav-small .container>ul>li>a{text-decoration:none;color:antiquewhite;font-weight:500;display:flex;align-items:center;gap:6px}.nav-small .container>ul>li:hover>a{border-bottom:2px solid aliceblue}.nav-small .container>ul>li.dropdown .dropdown-menu{display:none;position:absolute;top:100%;left:0;background-color:#fff;min-width:150px;border-radius:6px;box-shadow:0 4px 10px rgba(0,0,0,.1);overflow:hidden;z-index:99}.nav-small .container>ul>li.dropdown:hover .dropdown-menu{display:block}.nav-small .container>ul>li.dropdown .dropdown-menu li{padding:10px 15px;white-space:nowrap}.nav-small .container>ul>li.dropdown .dropdown-menu li a{color:#333;text-decoration:none;display:block}.nav-small .container>ul>li.dropdown .dropdown-menu li:hover{background-color:#f2f2f2}.nav-small .container>ul>li.dropdown .dropdown-menu li>a:hover{text-decoration:underline rgb(20,19,19) solid}#showNavBtn{position:fixed;left:20px;top:20px;background:#0c0c0c;color:#fff;border:none;border-radius:50%;width:40px;height:40px;display:none;justify-content:center;align-items:center;font-size:18px;cursor:pointer;z-index:1000;transition:all .3s ease}#showNavBtn:hover{background:#444;transform:scale(1.1)}.scroll-toggler{position:fixed;top:25px;left:25px;background:#0c0c0c;border:none;border-radius:4px;font-size:20px;cursor:pointer;padding:8px 12px;display:none;z-index:9999}.scroll-toggler>i{color:#fff}#mainNav.drown{position:sticky;top:60px;transition:all .3s ease}.nav-sml{display:none}.mobile-sml{display:none}.mobile-small{position:fixed;top:70px;left:50%;transform:translate(-50%,-20px);width:100%;background-color:#fafafa;display:flex;flex-direction:column;gap:10px;padding:50px 10px;border-radius:10px;box-shadow:0 4px 10px rgba(0,0,0,.1);z-index:999;opacity:0;animation:slideDown .5s ease-out forwards}@keyframes slideDown{from{transform:translate(-50%,-30px);opacity:0}to{transform:translate(-50%,0);opacity:1}}.menu-item{display:flex;align-items:center;justify-content:space-between;width:100%;padding:10px 15px;border-bottom:1px solid #ddd}.menu-item i{color:#333;font-size:24px;margin-right:10px}.menu-item a{flex:1;display:flex;justify-content:space-between;align-items:center;color:#000;text-decoration:none;font-size:18px}.menu-item a:hover{color:#555}.menu-item span{color:#131212;font-weight:bolder}</style>

<style>

    .cart-badge {
    position: absolute;
    top: -10px;
    right: -22px;
    background: #0c0c0c;   /* red color */
    color: #fff;
    font-size: 5px;
    font-weight: bold;
    border-radius: 50%;
    padding: 2px 6px;
    border: 1px solid #fff; /* white circle effect */
    line-height: 1;
}

    /* Mobile screen par icons ke darmiyan space hatao */
@media (max-width: 767px) {
  .header-icons i,
  .header-icons a,
  .header-icons button {
    margin-left: 7px !important;
    margin-right: 0px !important;
  }

  .header-icons {
    gap: 7px !important; /* agar gap property use hui ho to remove karega */
  }
}

</style>


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



</head>

<body>

  <!-- ===== TOP BAR ===== -->
  <div class="top-bar">
    <div class="container  ">
      <div class="calls d-none d-lg-block float-start">
        <i class="fas fa-phone"></i>
        <span>03179452521</span>
      </div>
      <div class="text-center "><span class="text-center">Free Delivery on orders above Rs. 3500!</span></div>
      <div class="social-icons d-none d-lg-block float-end">
        <i class="fab fa-facebook-f"></i>
        <i class="fab fa-instagram"></i>
        <i class="fab fa-tiktok"></i>
      </div>
    </div>
  </div>
  <hr class=" bg-light p-0 m-0">
  <!-- ===== MAIN HEADER ===== -->
  <div class="main-header">
    <div class="container d-flex justify-content-between align-items-center flex-wrap">
      <!-- Desktop Search -->
      <div class="search-box d-none d-lg-block order-md-2 order-lg-1 ">
        <button id="scrollToggler" class="scroll-toggler">
          <i class="fa fa-bars"></i>
        </button>
        <input type="text" class="form-control" placeholder="Search products..." style="border-radius: 30px;">
        <i class="fa fa-search"></i>
      </div>
      <a href="#" class="navbar-brand order-md-1 order-lg-2 mx-auto mx-lg-0">
        <img src="https://nexham.pk/naxham/assets/images/logo.png" alt="Logo" height="50">
      </a>

      <!-- Icons -->
    <div class="header-icons d-flex align-items-center justify-content-end order-md-3">
    <!-- Search (Mobile Only) -->
    <i class="fa fa-search search-trigger d-lg-none me-2"></i>

    @guest
        <!-- Guest: Normal account link (Desktop only) -->
        <a href="{{ route('login') }}" class="d-none d-lg-flex align-items-center text-decoration-none text-dark ms-3">
            <i class="fa fa-user"></i>
            <span class="ms-1">Account</span>
        </a>
    @endguest

    @auth
        <!-- Authenticated User: Dropdown (Desktop only) -->
        <div class="dropdown d-none d-lg-block ms-3">
            <a class="d-flex align-items-center text-decoration-none text-dark dropdown-toggle" href="#" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-user-circle"></i>
                <span class="ms-1">Account</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow">
                <li><span class="dropdown-item disabled">{{ Auth::user()->name }}</span></li>
                <li><a class="dropdown-item" href="#">My Profile</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="{{ route('logout') }}">Logout</a></li>
            </ul>
        </div>
    @endauth

    <!-- Cart (Desktop + Mobile) -->
    @php
        $cart = session()->get('cart', []);
        $cartCount = array_sum(array_column($cart, 'quantity'));
    @endphp

<a href="{{ route('cart.view') }}" class="d-flex align-items-center text-decoration-none text-dark ms-3">
    <div class="position-relative">
        <i class="fa fa-shopping-bag"></i>
        @if($cartCount > 0)
            <span class="cart-badge">{{ $cartCount }}</span>
        @endif
    </div>
    <span class="d-none d-lg-inline ms-1">Cart</span>
</a>



    <!-- Small screen toggler -->
    <button class="navbar-toggler ms-2 d-lg-none" id="smallToggler" type="button">
        <i class="fa fa-bars"></i>
    </button>
</div>





    </div>
  </div>

  <!-- ===== MOBILE SEARCH OVERLAY ===== -->
  <div class="mobile-search" id="mobileSearch">
    <input type="text" placeholder="Search products...">
    <i class="fa fa-times close-btn" id="closeSearch"></i>
  </div>







  <!-- <link rel="stylesheet" href="style.css"> -->
  <!-- ===== NAVBAR ===== -->
  <hr class=" bg-light p-0 m-0">
  <!-- Row 3: Main navigation -->


  <nav id="mainNav" class=" mobile-nav">
    <div class="container">
      <ul>
        <li><a href="{{url('/')}}">Home</a></li>
        <li class="dropdown">
          <a href="{{ url('shop') }}">Shop &nbsp;<i class="fa-solid fa-chevron-down"></i></a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('male', ['gender' => 'male']) }}">Male</a></li>
            <li><a href="{{ route('male', ['gender' => 'female']) }}">Female</a></li>
            <li><a href="{{ route('male', ['gender' => 'unisex']) }}">Unisex</a></li>
          </ul>
        <li><a href="{{ route('summer-deals.index') }}">Summer Deal</a></li>
        <li><a href="{{ route('male', ['gender' => 'male']) }}">Male Perfume</a></li>
        <li><a href="{{ route('male', ['gender' => 'female']) }}">Female Perfume</a></li>

        </li>
        <li><a href="{{ url('about') }}">About US</a></li>
        <li><a href="{{ url('contact') }}">Contact</a></li>
        <li><a href="{{ route('orders.my') }}">My Orders</a></li>
      </ul>
    </div>
  </nav>

  <!-- small screen navigation starts-->
  <div id="mobileSml" class="mobile-sml">
    <div class="menu-item">
      <a href="{{url('/')}}">Home </a>
    </div>
    <div class="menu-item">
      <i class="fa fa-gift"></i><a href="{{ route('summer-deals.index') }}">Summer Deal <span>></span></a>
    </div>
     <!-- <div class="menu-item">
      <i class="fa fa-gift"></i><a href="{{ route('summer-deals.index') }}">Gift Pack <span>></span></a>
    </div> -->
    <div class="menu-item">
      <a href="{{ url('shop') }}">Shop </a>
    </div>
    <div class="menu-item">
      <i class="fa fa-male"></i><a href="{{ route('male', ['gender' => 'male']) }}">Male perfume <span>></span></a>
    </div>
    <div class="menu-item">
      <i class="fa fa-female"></i><a href="{{ route('male', ['gender' => 'female']) }}">Female Perfume <span>></span></a>
    </div>
     <div class="menu-item">
      <i class="fa fa-users"></i><a href="{{ route('male', ['gender' => 'unisex']) }}">Unisex Perfume <span>></span></a>
    </div>

    <div class="menu-item">
      <i class="fa fa-info-circle"></i><a href="{{ url('about') }}">About <span>></span></a>
    </div>
    <div class="menu-item">
      <i class="fa fa-phone"></i><a href="{{ url('contact') }}">Contact <span>></span></a>
    </div>
    <div class="menu-item">
      <i class="fa fa-box"></i><a href="{{ route('orders.my') }}">My Orders <span>></span></a>
    </div>
  </div>
  <!-- small screen navigation ends-->










    <!-- END nav -->
    <!-- Header section end -->


    @yield('content')




<style>
    .social-icons a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    /* margin-right: 0.75rem; */
    color: white;
    transition: all 0.3s ease;
}

.social-icons a:hover {
    background-color: #5b21b6;
    transform: translateY(-3px);
}
</style>



    <footer class="ftco-footer">
        <div class="container">
            <div class="row mb-5">
                <div class="col-sm-12 col-md">
                    <div class="ftco-footer-widget mb-4">
                        <a class="navbar-brand " href="/">
<img src="{{ asset('naxham/assets/images/logo.png') }}" alt="Logo" class="img-fluid" style="max-height:60px; margin-bottom: 20px;">                        </a>
                        <p>Far far away, behind the word mountains, far from the countries.</p>
                        <div class="social-icons">
                        <ul class="ftco-footer-social list-unstyled mt-2 ">
                            <li class="ftco-animate"><a href="#"><i class="fa-brands fa-twitter ml-3 mt-3"></i></a></li>
                            <li class="ftco-animate"><a href="#"><i class="fa-brands fa-facebook ml-3 mt-3"></i></a></li>
                            <li class="ftco-animate"><a href="#"><i class="fa-brands fa-instagram ml-3 mt-3"></i></a></li>
                        </ul>
                        </div>

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
                                <li><span class="icon fa fa-map marker"></span><span class="text">Rohtas Road Rasheed Abad, Jhelum Near Mughal Plaza.</span></li>
                                <li><a href="#"><span class="icon fa fa-phone"></span><span class="text">+923179452521</span></a></li>
                                <li><a href="#"><span class="icon fa fa-paper-plane pr-4"></span><span class="text">khawar555kashmir@gmail.com</span></a></li>
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





</body>


<script>const searchTrigger=document.querySelector(".search-trigger"),mobileSearch=document.getElementById("mobileSearch"),closeSearch=document.getElementById("closeSearch"),scrollToTopBtn=document.getElementById("scrollToTopBtn");let lastScrollY=window.scrollY;searchTrigger.addEventListener("click",()=>{mobileSearch.style.display="flex"});closeSearch.addEventListener("click",()=>{mobileSearch.style.display="none"});document.addEventListener("click",e=>{if(mobileSearch.style.display==="flex"&&!mobileSearch.contains(e.target)&&!searchTrigger.contains(e.target))mobileSearch.style.display="none"});window.addEventListener("scroll",function(){if(window.innerWidth>=992){window.scrollY>100&&window.scrollY>lastScrollY?(scrollToTopBtn.style.display="block",setTimeout(()=>{scrollToTopBtn.classList.add("show")},10)):(scrollToTopBtn.classList.remove("show"),setTimeout(()=>{scrollToTopBtn.style.display="none"},400)),lastScrollY=window.scrollY}else scrollToTopBtn.classList.remove("show"),scrollToTopBtn.style.display="none"});scrollToTopBtn.addEventListener("click",function(){window.scrollTo({top:0,behavior:"smooth"})});</script>



{{-- mobile nav js  --}}

  <script>const scrollToggler = document.getElementById("scrollToggler"), smallToggler = document.getElementById("smallToggler"), nav = document.getElementById("mainNav"), navLink = document.getElementById("mobileSml"), icon = scrollToggler.querySelector("i"), linkicon = smallToggler.querySelector("i"); window.addEventListener("scroll", function () { window.scrollY > 100 ? (scrollToggler.style.display = "block") : (scrollToggler.style.display = "none", nav.classList.remove("drown"), icon.classList.remove("fa-xmark"), icon.classList.add("fa-bars")) }); scrollToggler.addEventListener("click", function () { nav.classList.toggle("drown"), icon.classList.toggle("fa-bars"), icon.classList.toggle("fa-xmark") }); smallToggler.addEventListener("click", function () { if (!navLink.classList.contains("mobile-small")) navLink.classList.add("mobile-small"), navLink.style.animation = "slideDown .4s ease forwards"; else { navLink.style.animation = "slideUp .4s ease forwards"; navLink.addEventListener("animationend", function e() { navLink.classList.remove("mobile-small"), navLink.style.animation = "", navLink.removeEventListener("animationend", e) }) } linkicon.classList.toggle("fa-bars"), linkicon.classList.toggle("fa-xmark") }); const style = document.createElement("style"); style.innerHTML = "@keyframes slideDown{from{transform:translate(-50%,-30px);opacity:0}to{transform:translate(-50%,0);opacity:1}}@keyframes slideUp{from{transform:translate(-50%,0);opacity:1}to{transform:translate(-50%,-30px);opacity:0}}", document.head.appendChild(style); function checkNavSize() { nav.className = "", window.innerWidth < 992 ? nav.classList.add("nav-sml") : nav.classList.add("nav-small") } checkNavSize(), window.addEventListener("resize", checkNavSize);</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Owl Carousel JS -->
<!-- jQuery (local version) -->
<script src="{{ asset('naxham/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('naxham/assets/js/jquery-migrate-3.0.1.min.js') }}"></script>

<!-- Bootstrap Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Owl Carousel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<!-- Extra Plugins -->
<script src="{{ asset('naxham/assets/js/jquery.easing.1.3.js') }}"></script>
<script src="{{ asset('naxham/assets/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('naxham/assets/js/jquery.stellar.min.js') }}"></script>
<script src="{{ asset('naxham/assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('naxham/assets/js/jquery.animateNumber.min.js') }}"></script>
<script src="{{ asset('naxham/assets/js/scrollax.min.js') }}"></script>

<!-- Google Maps -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="{{ asset('naxham/assets/js/google-map.js') }}"></script>

<!-- Main Script -->
<script src="{{ asset('naxham/assets/js/main.js') }}"></script>




</html>
