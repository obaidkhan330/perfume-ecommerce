
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




    <link rel="stylesheet" href="{{asset('naxham/assets/css/animate.css')}}">

    <link rel="stylesheet" href="{{ asset('naxham/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('naxham/assets/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('naxham/assets/css/magnific-popup.css') }}"    >

    <link rel="stylesheet" href="{{ asset('naxham/assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('naxham/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('naxham/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('naxham/assets/css/flaticon.css') }}">



    </head>

    <body>

    	<div id="preloder">
		<div class="loader"></div>
	</div>
{{-- <div class="wrap">
			<div class="container">
				<div class="row">
					<div class="col-md-6 d-flex align-items-center">
						<p class="mb-0 phone pl-md-2">
							<a href="#" class="mr-2"><span class="fa fa-phone mr-1"></span> +00 1234 567</a>
							<a href="#"><span class="fa fa-paper-plane mr-1"></span> youremail@email.com</a>
						</p>
					</div>
					<div class="col-md-6 d-flex justify-content-md-end">
						<div class="social-media mr-4">
			    		<p class="mb-0 d-flex">
			    			<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-facebook"><i class="sr-only">Facebook</i></span></a>
			    			<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-twitter"><i class="sr-only">Twitter</i></span></a>
			    			<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a>
			    			<a href="#" class="d-flex align-items-center justify-content-center"><span class="fa fa-dribbble"><i class="sr-only">Dribbble</i></span></a>
			    		</p>
		        </div>
		        <div class="reg">
		        	<p class="mb-0"><a href="#" class="mr-2">Sign Up</a> <a href="#">Log In</a></p>
		        </div>
					</div>
				</div>
			</div>
		</div> --}}

{{--
	  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light " id="ftco-navbar">
	    <div class="container ">
	      <!-- <a class="navbar-brand" href="index.html">Liquor <span>store</span></a> -->
		   <a class="navbar-brand " href="#">
                <img src="naxham/assets/images/logo.png" alt="logo" class="navbar-logo  ">
            </a> --}}
		   {{-- <div class="order-lg-last btn-group">
          <a href="#" class="btn-cart dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          	<span class="flaticon-shopping-bag"></span>
          	<div class="d-flex justify-content-center align-items-center"><small>3</small></div>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
				    <div class="dropdown-item d-flex align-items-start" href="#">
				    	<div class="img" style="background-image: url(images/prod-1.jpg);"></div>
				    	<div class="text pl-3">
				    		<h4>Bacardi 151</h4>
				    		<p class="mb-0"><a href="#" class="price">$25.99</a><span class="quantity ml-3">Quantity: 01</span></p>
				    	</div>
				    </div>
				    <div class="dropdown-item d-flex align-items-start" href="#">
				    	<div class="img" style="background-image: url(images/prod-2.jpg);"></div>
				    	<div class="text pl-3">
				    		<h4>Jim Beam Kentucky Straight</h4>
				    		<p class="mb-0"><a href="#" class="price">$30.89</a><span class="quantity ml-3">Quantity: 02</span></p>
				    	</div>
				    </div>
				    <div class="dropdown-item d-flex align-items-start" href="#">
				    	<div class="img" style="background-image: url(images/prod-3.jpg);"></div>
				    	<div class="text pl-3">
				    		<h4>Citadelle</h4>
				    		<p class="mb-0"><a href="#" class="price">$22.50</a><span class="quantity ml-3">Quantity: 01</span></p>
				    	</div>
				    </div>
				    <a class="dropdown-item text-center btn-link d-block w-100" href="cart.html">
				    	View All
				    	<span class="ion-ios-arrow-round-forward"></span>
				    </a>
				  </div>
        </div> --}}

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
       <a class="navbar-brand " href="#">
                <img src="naxham/assets/images/logo.png" alt="logo" class="navbar-logo  ">
            </a>

       <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#ftco-navbar" aria-controls="ftco-navbar" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span> Menu
</button>

<div class="collapse navbar-collapse ftco_navbar justify-content-between" id="ftco-navbar">
    <ul class="navbar-nav">

                <li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="{{ url('about') }}" class="nav-link">About</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-bs-toggle="dropdown" aria-expanded="false">Products</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown04">
                        <li><a class="dropdown-item" href="{{ url('product') }}">Products</a></li>
                        <li><a class="dropdown-item" href="{{ url('cart') }}">Cart</a></li>
                        <li><a class="dropdown-item" href="{{ url('checkout') }}">Checkout</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a href="{{ url('shop') }}" class="nav-link">Shop</a></li>
                <li class="nav-item"><a href="{{ url('contact') }}" class="nav-link">Contact</a></li>
            </ul>

            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item me-2">
                    <a href="{{ route('wishlist.index') }}" class="btn btn-outline-light position-relative">
                        ❤️ Wishlist
                          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ \App\Models\Wishlist::where('user_id', Auth::id())->count() }}
                        </span>
                    </a>
                </li>

                @guest
                    <li class="nav-item me-2"><a href="{{ route('login') }}" class="btn btn-outline-light">Login</a></li>
                    <li class="nav-item"><a href="{{ route('signup') }}" class="btn btn-warning">Signup</a></li>
                @endguest

                @auth
                    <li class="nav-item dropdown">
                        <a class="btn btn-warning dropdown-toggle" href="#" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            Welcome, {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @endauth
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
            </a>              <p>Far far away, behind the word mountains, far from the countries.</p>
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
	  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart color-danger" aria-hidden="true"></i> by <a href="" target="_blank">Obaidullah Faisal</a>
	  </p>
	          </div>
	        </div>
      	</div>
      </div>
    </footer>

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


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
