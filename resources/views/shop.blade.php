@extends('layouts.app')

@section('content')

<section class="hero-wrap hero-wrap-2" style="background-image: url('naxham/assets/images/perfume4.jpg');" data-stellar-background-ratio="0.2">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
          <div class="col-md-9 ftco-animate mb-7 text-center">
          	{{-- <p class="breadcrumbs mb-0"><span class="mr-2"><a href="{{ url('/') }}">Home <i class="fa fa-chevron-right"></i></a></span> <span>Products <i class="fa fa-chevron-right"></i></span></p> --}}
            {{-- <h2 class="mb-0 bread">Products</h2> --}}
          </div>
        </div>
      </div>
    </section>


  <!-- Main content -->
  <section class="py-5">
    <div class="container">
      <div class="row g-4">
        <!-- Sidebar -->
        <aside class="col-lg-3">
          <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
              <h5 class="card-title h6 text-uppercase">Categories</h5>
              <ul class="list-unstyled small mb-0 shop-cats">
                <li><a href="#">Women (24)</a></li>
                <li><a href="#">Men (18)</a></li>
                <li><a href="#">Unisex (12)</a></li>
                <li><a href="#">Gift Sets (9)</a></li>
                <li><a href="#">Attar / Oils (7)</a></li>
              </ul>
            </div>
          </div>
        </div>
    </div>

    <section class="container py-5">
    <h2 class="mb-4 text-center"> Male</h2>

    <div class="d-flex overflow-auto" style="gap: 1rem; -webkit-overflow-scrolling: touch; white-space: nowrap;">
        @forelse($Products as $product)
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























          <!-- Promo banner -->
          {{-- <div class="mt-5">
            <div class="ratio ratio-21x9 rounded-3 overflow-hidden shadow-sm">
              <img src="{{ asset('naxham/assets/images/banner.jpg') }}" class="w-100 h-100 object-fit-cover" alt="Mid-season sale">
            </div>
          </div>

          <!-- Pagination -->
          <nav class="mt-4" aria-label="Page navigation">
            <ul class="pagination justify-content-center">
              <li class="page-item disabled"><a class="page-link">Prev</a></li>
              <li class="page-item active"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
          </nav>
        </main> --}}
      </div>
    </div>
  </section>
@endsection
