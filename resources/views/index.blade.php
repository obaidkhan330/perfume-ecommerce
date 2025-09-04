@extends('layouts.app')

@section('content')

<div class="hero-wrap" style="background-image: url('naxham/assets/images/banner.jpg');" data-stellar-background-ratio="0.7">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-8 ftco-animate d-flex align-items-end">
                <div class="text w-100 text-center">
                    <h1 class="mb-4">A Touch <span>Of</span> Nature <span>Aroma</span>.</h1>
                    <p><a href="{{ url('shop') }}" class="btn btn-primary py-2 px-4">Shop Now</a> <a href="{{ url('about') }}" class="btn btn-white btn-outline-white py-2 px-4">Read more</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

    <section class="ftco-intro">
    	<div class="container">
    		<div class="row no-gutters">
    			<div class="col-md-4 d-flex ">
    				<div class="intro d-lg-flex w-100 ftco-animate">
                   <div class="icon">
                    <i class="fa-solid fa-headset"></i>
                       </div>
    					<div class="text">
    						<h2>Online Support 24/7</h2>
    						<p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
    					</div>
    				</div>
    			</div>
    			<div class="col-md-4 d-flex">
    				<div class="intro color-1 d-lg-flex w-100 ftco-animate">
    					<div class="icon">
                       <i class="fa-solid fa-hand-holding-dollar"></i>
                      </div>
    					<div class="text">
    						<h2>Money Back Guarantee</h2>
    						<p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
    					</div>
    				</div>
    			</div>
    			<div class="col-md-4 d-flex">
    				<div class="intro color-2 d-lg-flex w-100 ftco-animate">
                 <div class="icon">
                <i class="fa-solid fa-truck-fast"></i>
                 </div>
    					<div class="text">
    						<h2>Free Shipping &amp; Return</h2>
    						<p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </section>

{{-- all products fetch --}}

<section class="container py-5">
    <h2 class="mb-4 text-center"> Male</h2>

    <div class="d-flex overflow-auto" style="gap: 1rem; -webkit-overflow-scrolling: touch; white-space: nowrap;">
        @forelse($products as $product)
        <div class="card shadow-sm h-100 d-inline-block"
            style="min-width: 250px; max-width: 250px; flex: 0 0 auto;">
            <img src="{{ asset('storage/' . $product->image) }}"
                class="card-img-top"
                alt="{{ $product->name }}"
                style="height: 200px; object-fit: cover;">

                <div class="card-body text-center">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ $product->fragrance_family }} | {{ $product->brand->name }}</p>
                    <a href="{{ url('details/' . $product->id) }}" class="btn btn-sm btn-outline-primary">View Details</a>
                </div>
            </div>
        @empty
        <p class="text-center">No products available at the moment.</p>
        @endforelse
    </div>
</section>









		<section class="ftco-section ftco-no-pb">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 col-md-4 ">
						<div class="sort w-100 text-center ftco-animate">
							<div class="img" style="background-image: url(naxham/assets/images/perfume1.jpg);"></div>
							<h3>FYNORA</h3>
						</div>
					</div>
					<div class="col-lg-2 col-md-4 ">
						<div class="sort w-100 text-center ftco-animate">
							<div class="img" style="background-image: url(naxham/assets/images/perfume2.jpg);"></div>
							<h3>FLORENZA</h3>
						</div>
					</div>
					<div class="col-lg-2 col-md-4 ">
						<div class="sort w-100 text-center ftco-animate">
							<div class="img" style="background-image: url(naxham/assets/images/perfume3.jpg);"></div>
							<h3>MYSTARA</h3>
						</div>
					</div>
					<div class="col-lg-2 col-md-4 ">
						<div class="sort w-100 text-center ftco-animate">
							<div class="img" style="background-image: url(naxham/assets/images/perfume4.jpg);"></div>
							<h3>ROUZAN</h3>
						</div>
					</div>
					<div class="col-lg-2 col-md-4 ">
						<div class="sort w-100 text-center ftco-animate">
							<div class="img" style="background-image: url(naxham/assets/images/perfume5.jpg);"></div>
							<h3>LEXARO</h3>
						</div>
					</div>
					<div class="col-lg-2 col-md-4 ">
						<div class="sort w-100 text-center ftco-animate">
							<div class="img" style="background-image: url(naxham/assets/images/perfume6.jpg);"></div>
							<h3>VELORAIN</h3>
						</div>
					</div>

				</div>
			</div>
		</section>

<section class="ftco-section " id="abc">
    <div class="container">
        <div class="row justify-content-center pb-5">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <span class="subheading">Our Delightful offerings</span>
                <h2>Tastefully Yours</h2>
            </div>
        </div>
        <div class="row">
            @foreach($products as $product)
            <div class="col-md-3 d-flex">
                <div class="product ftco-animate">
                    <div class="img d-flex align-items-center justify-content-center" style="background-image: url({{asset('storage/'.$product->image)}});">
                        <div class="desc">
                            <p class="meta-prod d-flex">
                                <a href="{{ url('shop') }}" class="text-decoration-none border-none"><i class=" d-flex align-items-center justify-content-center fa fa-shopping-bag fs-1 text-light"></i></a>
                                <a href="{{ url('wishlist') }}" class="text-decoration-none border-none"><i class=" d-flex align-items-center justify-content-center fa fa-heart fs-1 text-light"></i></a>
                                <a href="{{ url('product') }}" class="text-decoration-none border-none"><i class=" d-flex align-items-center justify-content-center fa fa-eye fs-1 text-light"></i></a>

                            </p>
                        </div>
                    </div>
                    <div class="text text-center">
                        <span class="sale">Sale</span>
                        <span class="category">{{ $product->brand->name ?? 'N/A' }}</span>
                        <h2>{{ $product->name }}</h2>
                        @if($product->smallestVariation)
                        <p class="mb-0">
                           <span class="price price-sale">  {{ $product->smallestVariation->price }}-</span> <span class="price">{{ $product->smallestVariation->discount_price }}</span>
                             PKR
                        </p>
                        @endif

                    </div>
                </div>
            </div>
            @endforeach

        </div>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <a href="{{ url('product') }}" class="btn btn-primary d-block">View All Products <span class="fa fa-long-arrow-right"></span></a>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section testimony-section img" style="background-image: url(naxham/assets/images/banner.jpg);">
    <div class="overlay"></div>
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
                <span class="subheading">Testimonial</span>
                <h2 class="mb-3">Happy Clients</h2>
            </div>
        </div>
        <div class="row ftco-animate">
            <div class="col-md-12">
                <div class="carousel-testimony owl-carousel ftco-owl">
                    <div class="item">
                        <div class="testimony-wrap py-4">
                            <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></div>
                            <div class="text">
                                <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                <div class="d-flex align-items-center">
                                    <div class="user-img" style="background-image: url(naxham/assets/images/person_1.jpg)"></div>
                                    <div class="pl-3">
                                        <p class="name">Roger Scott</p>
                                        <span class="position">Marketing Manager</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimony-wrap py-4">
                            <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></div>
                            <div class="text">
                                <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                <div class="d-flex align-items-center">
                                    <div class="user-img" style="background-image: url(naxham/assets/images/person_2.jpg)"></div>
                                    <div class="pl-3">
                                        <p class="name">Roger Scott</p>
                                        <span class="position">Marketing Manager</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimony-wrap py-4">
                            <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></div>
                            <div class="text">
                                <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                <div class="d-flex align-items-center">
                                    <div class="user-img" style="background-image: url(naxham/assets/images/person_3.jpg)"></div>
                                    <div class="pl-3">
                                        <p class="name">Roger Scott</p>
                                        <span class="position">Marketing Manager</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimony-wrap py-4">
                            <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></div>
                            <div class="text">
                                <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                <div class="d-flex align-items-center">
                                    <div class="user-img" style="background-image: url(naxham/assets/images/person_1.jpg)"></div>
                                    <div class="pl-3">
                                        <p class="name">Roger Scott</p>
                                        <span class="position">Marketing Manager</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimony-wrap py-4">
                            <div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-quote-left"></div>
                            <div class="text">
                                <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                <div class="d-flex align-items-center">
                                    <div class="user-img" style="background-image: url(naxham/assets/images/person_2.jpg)"></div>
                                    <div class="pl-3">
                                        <p class="name">Roger Scott</p>
                                        <span class="position">Marketing Manager</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>








@endsection
