@extends('layouts.app')
@section('content')

<style>
    .product-card {
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

   .product-card {
    min-height: 100%; /* same height maintain */
}

.product-img {
    object-fit: cover;
    height: 180px;  /* cart ki fixed height maintain karna */
}



.banner-container {
    width: 100%;
    height: 400px; /* desktop ki height fix */
    overflow: hidden;
    position: relative;
    border-radius: 12px; /* optional rounded look */
    margin-top: 1px;
}

.banner-img {
    width: 100%;
    height: 100%;
    object-fit: cover;   /* crop karega lekin distort nahi karega */
    object-position: center; /* image ko center rakhega */
}

/* Mobile ke liye responsive height */
@media (max-width: 768px) {
    .banner-container {
        height: 250px; /* mobile me thoda chota */
    }
}


</style>
<section class="banner-section mb-4">
    <div class="banner-container">
        <img src="{{ asset('naxham/assets/images/slider1.jpg') }}" alt="Banner" class="banner-img">
    </div>
</section>


<section class="container py-5">
    <div class="row g-3">
        @forelse($maleProducts as $product)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card shadow-sm h-100 product-card">
                    <img src="{{ asset('storage/' . $product->image) }}"
                        class="card-img-top product-img"
                        alt="{{ $product->name }}">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <h6 class="card-text">{{ $product->fragrance_family }} | {{ $product->brand->name ?? 'N/A' }}</h6>

                        @if($product->smallestVariation)
                            <p class="mb-0">
                                <span class="text-muted" style="text-decoration: line-through;">
                                    {{ number_format($product->smallestVariation->price,0) }}
                                </span>
                                <span class="text-danger fw-bold">
                                    {{ number_format($product->smallestVariation->discount_price,0) }}
                                </span>
                                PKR
                            </p>
                        @endif

                        <a href="{{ url('details/' . $product->slug) }}" class="btn btn-sm btn-outline-primary mt-2">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">Male products not available.</p>
        @endforelse
    </div>
</section>

@endsection
