@extends('layouts.app')

@section('content')


<style>
   .product-card {
  position: relative;
  display: block;
  overflow: hidden;
}

    .hover-icons {
        position: absolute;
        top: 10px;
        right: 10px;
        display: flex;
        flex-direction: column;
        gap: 8px;
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 2;
    }

    .product-card:hover .hover-icons {
        opacity: 1;
    }

    .hover-icons a {
        background-color: white;
        border-radius: 50%;
        padding: 6px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        color: black;
        font-size: 14px;
        text-align: center;
        width: 30px;
        height: 30px;
        line-height: 18px;
    }
</style>

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
  <div class="row">
    <h2 class="mb-4 text-center">
    {{ ucfirst(request()->segment(2) ?? 'All') }} Products
</h2>
    @forelse($Products as $product)
      <div class="col-lg-3 col-md-4 col-6 mb-4">
        <div class="card p-2 shadow-sm product-card">
         <div class="hover-icons">
  <a href="{{ url('details/' . $product->slug) }}"><i class="fas fa-search"></i></a>

  @if($product->smallestVariation)
    <form action="{{ route('cart.add', $product->slug) }}" method="POST" style="display:inline;">
      @csrf
      <input type="hidden" name="variation_id" value="{{ $product->smallestVariation->id }}">
      <input type="hidden" name="price" value="{{ $product->smallestVariation->discount_price }}">
      <input type="hidden" name="volume" value="{{ $product->smallestVariation->type }}">
      <input type="hidden" name="quantity" value="1">

      <button type="submit" style="border:none; background:none;">
        <i class="fas fa-plus text-white"></i>
      </button>
    </form>
  @endif
</div>
          <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top mb-2" alt="{{ $product->name }}" style="height: 180px; object-fit: cover;">
          <div class="card-body p-2 text-center">
            <small class="fw-bold">{{ $product->name }}</small>
            <p class="mb-1">Inspired by {{ $product->brand->name }}</p>

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
          </div>
        </div>
      </div>
    @empty
      <p class="text-center">No products available.</p>
    @endforelse
  </div>
</section>





{{-- tester  --}}


  {{-- <section class="container py-5">
    <h2 class="mb-4 text-center"> Testers </h2>

    <div class="d-flex overflow-auto" style="gap: 1rem; -webkit-overflow-scrolling: touch; white-space: nowrap;">
        @forelse($testers as $tester)
        <div class="card shadow-sm h-100 d-inline-block"
            style="min-width: 300px; max-width: 300px; flex: 0 0 auto;">
            <img src="{{ asset('storage/' . $tester->image) }}"
                class="card-img-top"
                alt="{{ $tester->name }}"
                style="height: 300px; object-fit: cover;">

            <div class="card-body text-center">
                <h5 class="card-title">{{ $tester->name }}</h5>
                <h6 class="card-text">{{ $tester->brand->name ?? 'N/A' }}</h6>

                @if($tester->smallestVariation())
                    <p class="mb-0">
                        <span class="price text-muted" style="text-decoration: line-through;">
                            {{ $tester->smallestVariation()->price }}
                        </span>
                        <span class="price text-danger fw-bold">
                            {{ $tester->smallestVariation()->discount_price ?? $tester->smallestVariation()->price }}
                        </span>
                        PKR
                    </p>
                @endif

<a href="{{ route('testers.show', $tester->slug) }}" class="btn btn-sm btn-outline-primary">View Details</a>
            </div>
        </div>
        @empty
        <p class="text-center"> No testers available.</p>
        @endforelse
    </div>
</section> --}}
























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
