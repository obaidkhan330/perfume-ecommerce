@extends('layouts.app')

@section('content')

<section class="hero-section">
  <div class="owl-carousel owl-theme" id="hero-carousel">

    <!-- Slide 1 -->
    <div class="hero-wrap" style="background-image: url('naxham/assets/images/banner.jpg');">
      <div class="overlay"></div>
      <div class="slider-text text-center">
        <div class="text">
          <h1 class="mb-4 mt-5">A Touch <span>Of</span> Nature <span>Aroma</span>.</h1>
          <p>
            <a href="{{ url('shop') }}" class="btn btn-primary py-2 px-4">Shop Now</a>
            <a href="{{ url('about') }}" class="btn btn-white btn-outline-white py-2 px-4">Read more</a>
          </p>
        </div>
      </div>
    </div>

    <!-- Slide 2 -->
    <div class="hero-wrap" style="background-image: url('naxham/assets/images/slider1.jpg');">
      <div class="overlay"></div>
      <div class="slider-text text-center">
        <div class="text">
          <h1 class="mb-4">Discover <span>Pure</span> Fragrance.</h1>
          <p>
            <a href="{{ url('shop') }}" class="btn btn-primary py-2 px-4">Shop Now</a>
            <a href="{{ url('about') }}" class="btn btn-white btn-outline-white py-2 px-4">Read more</a>
          </p>
        </div>
      </div>
    </div>

    <!-- Slide 3 -->
    <div class="hero-wrap" style="background-image: url('naxham/assets/images/slider2.jpg');">
      <div class="overlay"></div>
      <div class="slider-text text-center">
        <div class="text">
          <h1 class="mb-4">Elegance <span>In</span> Every Drop.</h1>
          <p>
            <a href="{{ url('shop') }}" class="btn btn-primary py-2 px-4">Shop Now</a>
            <a href="{{ url('about') }}" class="btn btn-white btn-outline-white py-2 px-4">Read more</a>
          </p>
        </div>
      </div>
    </div>

  </div>
</section>

    {{-- brands  --}}


    <style>
        .scroll-row {
  gap: 20px;
  padding-bottom: 10px;
  scrollbar-width: thin;
  scrollbar-color: #ccc transparent;
}

.scroll-row::-webkit-scrollbar {
  height: 6px;
}

.scroll-row::-webkit-scrollbar-thumb {
  background: #ccc;
  border-radius: 10px;
}

.category-box {
  min-width: 150px;
  flex: 0 0 auto;
}

.category-box .img {
  width: 150px;
  height: 150px;
  background-size: cover;
  background-position: center;
  border-radius: 10px;
}

.category-box h3 {
  margin-top: 10px;
  font-size: 1rem;
  font-weight: 800;
  color: black;
}
.category-box a {
  text-decoration: none;
}


.poster-wrapper {
  margin-bottom: 2rem;
  position: relative;
  z-index: 1;
}

.poster-box {
  width: 100%;
  overflow: hidden;
  border-radius: 8px;

}

.poster-img {
  width: 100%;
  height: auto;
  display: block;
  object-fit: cover;
  max-height: 400px;
}

/* Mobile Optimization */
@media (max-width: 768px) {
  .poster-img {
    max-height: 250px;
    border-radius: 6px;
  }
}

</style>

<section class="ftco-section ftco-no-pb" id="abc">
  <div class="container">
    <h2 class="mb-4 text-center">POPULAR CATEGORIES</h2>

    <div class="scroll-row d-flex flex-nowrap overflow-auto">
      <div class="category-box text-center">
        <a href="#" class="d-block">
          <div class="img" style="background-image: url(naxham/assets/images/perfume1.jpg);"></div>
          <h3>MALE</h3>
        </a>
      </div>
      <div class="category-box text-center">
        <a href="#" class="d-block">
          <div class="img" style="background-image: url(naxham/assets/images/perfume2.jpg);"></div>
          <h3>FEMALE</h3>
        </a>
      </div>
      <div class="category-box text-center">
        <a href="#" class="d-block">
          <div class="img" style="background-image: url(naxham/assets/images/perfume3.jpg);"></div>
          <h3>UNISEX</h3>
        </a>
      </div>
      <div class="category-box text-center">
        <a href="#" class="d-block">
          <div class="img" style="background-image: url(naxham/assets/images/perfume4.jpg);"></div>
          <h3>DALIYWEAR</h3>
        </a>
      </div>
      <div class="category-box text-center">
        <a href="#" class="d-block">
          <div class="img" style="background-image: url(naxham/assets/images/perfume5.jpg);"></div>
          <h3>LEXARO</h3>
        </a>
      </div>
      <div class="category-box text-center">
        <a href="#" class="d-block">
          <div class="img" style="background-image: url(naxham/assets/images/perfume6.jpg);"></div>
          <h3>VELORAIN</h3>
        </a>
      </div>

    </div>
  </div>
</section>



{{-- all products fetch --}}

 {{-- male  --}}

<section class="container py-5">
    <h2 class="mb-4 text-center"> Male</h2>

    <div class="d-flex overflow-auto" style="gap: 1rem; -webkit-overflow-scrolling: touch; white-space: nowrap;">
        @forelse($maleProducts as $product)
        <div class="card shadow-sm h-100 d-inline-block"
            style="min-width: 300px; max-width: 300px; flex: 0 0 auto;">
            <img src="{{ asset('storage/' . $product->image) }}"
                class="card-img-top"
                alt="{{ $product->name }}"
                style="height: 300px; object-fit: cover;">
                <div class="card-body text-center">

                    <h5 class="card-title">{{ $product->name }}</h5>
                    <h4 class="card-text">{{ $product->fragrance_family }} |  {{ $product->brand->name ?? 'N/A' }}
                    </h4>
                   @if($product->smallestVariation)
                       <p class="mb-0">
                                <span class="price text-muted" style="text-decoration: line-through;">
                                   {{ $product->smallestVariation->price }}-
                                 </span>
                          <span class="price text-danger fw-bold">
                             {{ $product->smallestVariation->discount_price }}
                         </span>
                           PKR
                           </p>
                       @endif
            <a href="{{ url('details/' . $product->slug) }}" class="btn btn-sm btn-outline-primary">View Details</a>
                </div>
            </div>
        @empty
        <p class="text-center"> Male products Not available .</p>
        @endforelse
    </div>
</section>


<div class="poster-wrapper">
  <div class="container">
    <div class="poster-box">
      <img src="{{ asset('naxham/assets/images/slider2.jpg') }}" alt="Female Collection Poster" class="poster-img">
    </div>
  </div>
</div>



 {{-- female --}}
<section class="container py-5">
    <h2 class="mb-4 text-center"> Female</h2>

    <div class="d-flex overflow-auto" style="gap: 1rem; -webkit-overflow-scrolling: touch; white-space: nowrap;">
        @forelse($femaleProducts as $product)

        <div class="card shadow-sm h-100 d-inline-block"
            style="min-width: 300px; max-width: 300px; flex: 0 0 auto;">
            <img src="{{ asset('storage/' . $product->image) }}"
                class="card-img-top"
                alt="{{ $product->name }}"
                style="height: 300px; object-fit: cover;">
                <div class="card-body text-center">

                    <h5 class="card-title">{{ $product->name }}</h5>
                    <h4 class="card-text">{{ $product->fragrance_family }} |  {{ $product->brand->name ?? 'N/A' }}
                    </h4>
                   @if($product->smallestVariation)
                       <p class="mb-0">
                                <span class="price text-muted" style="text-decoration: line-through;">
                                   {{ $product->smallestVariation->price }}-
                                 </span>
                          <span class="price text-danger fw-bold">
                             {{ $product->smallestVariation->discount_price }}
                         </span>
                           PKR
                           </p>
                       @endif
            <a href="{{ url('details/' . $product->slug) }}" class="btn btn-sm btn-outline-primary">View Details</a>
                </div>
            </div>
        @empty
        <p class="text-center"> Female products Not Available.</p>
        @endforelse
    </div>
</section>


{{-- unisex  --}}


<section class="container py-5">
    <h2 class="mb-4 text-center"> Unisex</h2>

    <div class="d-flex overflow-auto" style="gap: 1rem; -webkit-overflow-scrolling: touch; white-space: nowrap;">
        @forelse($unisexProducts as $product)

        <div class="card shadow-sm h-100 d-inline-block"
            style="min-width: 300px; max-width: 300px; flex: 0 0 auto;">
            <img src="{{ asset('storage/' . $product->image) }}"
                class="card-img-top"
                alt="{{ $product->name }}"
                style="height: 300px; object-fit: cover;">
                <div class="card-body text-center">

                    <h5 class="card-title">{{ $product->name }}</h5>
                    <h4 class="card-text">{{ $product->fragrance_family }} |  {{ $product->brand->name ?? 'N/A' }}
                    </h4>
                   @if($product->smallestVariation)
                       <p class="mb-0">
                                <span class="price text-muted" style="text-decoration: line-through;">
                                   {{ $product->smallestVariation->price }}-
                                 </span>
                          <span class="price text-danger fw-bold">
                             {{ $product->smallestVariation->discount_price }}
                         </span>
                           PKR
                           </p>
                       @endif
            <a href="{{ url('details/' . $product->slug) }}" class="btn btn-sm btn-outline-primary">View Details</a>
                </div>
            </div>
        @empty
        <p class="text-center"> Unisex products Not Available.</p>
        @endforelse
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
