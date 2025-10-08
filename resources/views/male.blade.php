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


<section class="container-fluid py-5">
    <div class=" row">
        @forelse($maleProducts as $product)
            <div class="col-lg-3 col-md-4 col-6 mb-4 ">
                <div class="card p-2 shadow-sm product-card">
                    <img src="{{ asset('storage/' . $product->image) }}"
                        class="card-img-top mb-2 product-img"
                        alt="{{ $product->name }}">
                        {{-- style="height:180px; object-fit:cover;"> --}}
                    <div class="card-body p-2 text-center">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <h5 class="card-text">{{ $product->fragrance_family }} | {{ $product->brand->name ?? 'N/A' }}</h5>

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

                        <a href="{{ url('details/' . $product->slug) }}" class="btn btn-sm btn-outline-primary ">
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


{{-- <div class="d-flex overflow-auto" style="gap: 1rem; -webkit-overflow-scrolling: touch; white-space: nowrap;">
        @forelse($maleProducts as $product)
        <div class="card shadow-sm h-30 d-inline-block product-card">
            <img src="{{ asset('storage/' . $product->image) }}"
                class="card-img-top product-img"
                alt="{{ $product->name }}">
            <div class="card-body text-center">

                <h5 class="card-title">{{ $product->name }}</h5>
                <h5 class="card-text">{{ $product->fragrance_family }} | {{ $product->brand->name ?? 'N/A' }}</h5>

                @if($product->smallestVariation)
                <p class="mb-0">
                    <span class="price text-muted" style="text-decoration: line-through;">
                        {{ number_format( $product->smallestVariation->price,0) }}-
                    </span>
                    <span class="price text-danger fw-bold">
                        {{ number_format($product->smallestVariation->discount_price,0) }}
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
    </div> --}}

@endsection

