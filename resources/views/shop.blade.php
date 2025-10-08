@extends('layouts.app')

@section('content')

<style>
.product-card { position: relative; overflow: hidden; }
.product-card .hover-icons {
    position: absolute; top: 10px; right: 10px;
    display: flex; flex-direction: column; gap: 5px;
    opacity: 0; transition: opacity 0.3s ease;
}
.product-card:hover .hover-icons { opacity: 1; }
.hover-btn {
    width: 32px; height: 32px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    background: white; color: black; border: none;
    transition: all 0.2s; font-size: 16px;
}
.hover-btn:hover { background: black; color: white; transform: scale(1.1); }
.banner-container { width:100%; height:400px; overflow:hidden; border-radius:12px; margin-top:1px; }
.banner-img { width:100%; height:100%; object-fit:cover; object-position:center; }
@media (max-width:768px){ .banner-container{ height:250px; } }
</style>

{{-- Banner --}}
<section class="banner-section mb-4">
  <div class="banner-container">
    <img src="{{ asset('naxham/assets/images/poster1.PNG') }}" alt="Banner" class="banner-img">
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="row g-4">

      {{-- Sidebar --}}
      <aside class="col-lg-3">
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-body">
            <h5 class="card-title h6 text-uppercase">Categories</h5>
            <ul class="list-unstyled small mb-0 shop-cats">
              <li><a href="{{ route('shop') }}"><strong>ALL</strong> ({{ $counts['male'] + $counts['female'] + $counts['unisex'] }})</a></li>
              <li><a href="{{ route('shop','female') }}"><strong>Female</strong> ({{ $counts['female'] }})</a></li>
              <li><a href="{{ route('shop','male') }}"><strong>Male</strong> ({{ $counts['male'] }})</a></li>
              <li><a href="{{ route('shop','unisex') }}"><strong>Unisex</strong> ({{ $counts['unisex'] }})</a></li>
            </ul>
          </div>
        </div>
      </aside>

      {{-- Products --}}
      <div class="col-lg-9">
        <h2 class="mb-4 text-center">
          {{ ucfirst(request()->segment(2) ?? 'All') }} Products
        </h2>

        <div class="row">
          @forelse($Products as $Product)
            <div class="col-lg-3 col-md-4 col-6 mb-4">
              <div class="card p-2 shadow-sm product-card">

                {{-- Hover Icons --}}
                <div class="hover-icons">
                  <a href="{{ url('details/' . $Product->slug) }}" class="hover-btn">
                    <i class="fas fa-search"></i>
                  </a>
                  @if($Product->smallestVariation)
                    <form action="{{ route('cart.add', $Product->slug) }}" method="POST">
                      @csrf
                      <input type="hidden" name="variation_id" value="{{ $Product->smallestVariation->id }}">
                      <input type="hidden" name="price" value="{{ $Product->smallestVariation->discount_price }}">
                      <input type="hidden" name="volume" value="{{ $Product->smallestVariation->type }}">
                      <input type="hidden" name="quantity" value="1">
                      <button type="submit" class="hover-btn">
                        <i class="fas fa-shopping-cart text-dark"></i>
                      </button>
                    </form>
                  @endif
                </div>

                {{-- Image --}}
                <img src="{{ asset('storage/' . $Product->image) }}"
                     class="card-img-top mb-2 product-img"
                     alt="{{ $Product->name }}"
                     style="height:180px; object-fit:cover;">

                {{-- Body --}}
                <div class="card-body p-2 text-center">
                  <small class="fw-bold">{{ $Product->name }}</small>
                  <p class="mb-1">Inspired by {{ $Product->brand->name }}</p>
                  @if($Product->smallestVariation)
                    <p class="mb-0">
                      <span class="text-muted" style="text-decoration: line-through;">
                        {{ $Product->smallestVariation->price }}
                      </span>
                      <span class="text-danger fw-bold">
                        {{ $Product->smallestVariation->discount_price }}
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
      </div>

    </div>
  </div>
</section>
@endsection
