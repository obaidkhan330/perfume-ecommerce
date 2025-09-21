@extends('layouts.app')

@section('content')
<style>
.tester-card {
    position: relative;
    overflow: hidden;
}

.tester-card .hover-icons {
    position: absolute;
    top: 10px;
    right: 10px;
    display: flex;
    flex-direction: column;
    gap: 5px;
    z-index: 10;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s ease;
}

.tester-card:hover .hover-icons {
    opacity: 1;
    pointer-events: auto;
}

.hover-icons .hover-btn,
.hover-icons .hover-btn-heart,
.hover-icons a.hover-btn {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: white;
    color: black;
    border: none;
    cursor: pointer;
    font-size: 16px;
    transition: all 0.2s;
}

.hover-icons .hover-btn:hover,
.hover-icons .hover-btn-heart:hover,
.hover-icons a.hover-btn:hover {
    background: black;
    color: white;
    transform: scale(1.1);
}

/* Responsive Grid adjustments (Bootstrap handles most of it) */
@media (max-width: 576px) {
    .tester-card img {
        height: 180px;
    }
}
</style>
<div class="container py-5">
    <h2 class="mb-4 fw-bold text-center">All Testers</h2>

    <div class="row">
        @foreach($testers as $tester)
            <div class="col-lg-3 col-md-4 col-6 mb-4">
                <div class="card shadow-sm tester-card position-relative">

                    {{-- Hover Icons --}}
                    <div class="hover-icons d-flex flex-column gap-2">
                        {{-- View Details --}}
                        <a href="{{ route('testers.show', $tester->slug) }}" class="hover-btn">
                            <i class="fas fa-search"></i>
                        </a>

                        {{-- Add to Cart --}}
                        @if($tester->variations->first())
                        <form action="{{ route('cart.add', $tester->slug) }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="hidden" name="variation_id" value="{{ $tester->variations->first()->id }}">
                            <input type="hidden" name="price" value="{{ $tester->variations->first()->discount_price }}">
                            <input type="hidden" name="volume" value="{{ $tester->variations->first()->type }}">
                            <input type="hidden" name="quantity" value="1">

                            <button type="submit" class="hover-btn">
                                <i class="fas fa-plus"></i>
                            </button>
                        </form>
                        @endif

                        {{-- Wishlist --}}
                        <button type="button" class="wishlist-btn hover-btn-heart" data-product-id="{{ $tester->id }}">
                            <i class="bi bi-heart{{ auth()->user()->wishlists->contains('product_id', $tester->id) ? '-fill' : '' }}"></i>
                        </button>
                    </div>

                    {{-- Tester Image --}}
                    <img src="{{ asset('storage/' . $tester->image) }}"
                         class="card-img-top"
                         alt="{{ $tester->name }}"
                         style="height: 220px; object-fit: cover;">

                    {{-- Card Body --}}
                    <div class="card-body text-center p-2">
                        <h5 class="card-title mb-1">{{ $tester->name }}</h5>
                        <p class="text-danger fw-bold mb-2">
                            Rs. {{ $tester->variations->first()->discount_price ?? $tester->variations->first()->price }}
                        </p>
                        <a href="{{ route('testers.show', $tester->slug) }}" class="btn btn-primary btn-sm w-100">
                            View Details
                        </a>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
