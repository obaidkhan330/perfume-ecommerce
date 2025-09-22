@extends('layouts.app')

@section('content')

<style>
.scroll-row {
    display: flex;
    gap: 10px;
    overflow-x: auto;
    padding-bottom: 10px;
    scroll-snap-type: x mandatory;
}

.scroll-card {
    flex: 0 0 calc(33.33% - 10px); /* 3 per row */
    background: #fff;
    border: 1px solid #eee;
    border-radius: 8px;
    padding: 8px;
    text-align: center;
    scroll-snap-align: start;
}

.scroll-card img {
    width: 100%;
    height: 120px;
    object-fit: cover;
    border-radius: 6px;
}
</style>
<div class="container py-5">
    <h2 class="fw-bold mb-2">{{ $tester->name }}</h2>
    <p class="text-muted">{{ $tester->brand->name ?? 'No Brand' }}</p>
    <p>{{ $tester->description }}</p>

    <!-- Desktop View (normal grid) -->
    <div class="row d-none d-md-flex">
        @foreach($tester->variations as $variation)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <!-- image -->
                    <img src="{{ asset('storage/' . $tester->image) }}"
                         class="card-img-top"
                         alt="{{ $tester->name }}"
                         style="height: 200px; object-fit: cover;">

                    <!-- variation info -->
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $variation->pack_size }}</h5>
                        <p class="mb-2">
                            @if($variation->discount_price)
                                <span class="text-muted text-decoration-line-through">
                                    Rs. {{ $variation->price }}
                                </span>
                                <span class="text-danger fw-bold">
                                    Rs. {{ $variation->discount_price }}
                                </span>
                            @else
                                <span class="text-dark fw-bold">
                                    Rs. {{ $variation->price }}
                                </span>
                            @endif
                        </p>

                        <!-- Add to cart + Buy now -->
                        <form method="POST" action="{{ route('cart.addTester', $tester->id) }}">
                            @csrf
                            <input type="hidden" name="variation_id" value="{{ $variation->id }}">
                            <input type="number" name="quantity" value="1" min="1" class="form-control mb-2 text-center">
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary w-50">Add to Cart</button>
                                {{-- <button type="submit" formaction="{{ route('cart.buyNowTester', $tester->id) }}" class="btn btn-success w-50">Buy Now</button> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Mobile View (scrollable row) -->
    <div class="d-md-none">
        <div class="scroll-row">
            @foreach($tester->variations as $variation)
                <div class="scroll-card">
                    <img src="{{ asset('storage/' . $tester->image) }}"
                         alt="{{ $tester->name }}">
                    <h6 class="mt-2">{{ $variation->pack_size }}</h6>
                    <p class="mb-1">
                        @if($variation->discount_price)
                            <small class="text-muted text-decoration-line-through">
                                Rs. {{ $variation->price }}
                            </small><br>
                            <span class="text-danger fw-bold">
                                Rs. {{ $variation->discount_price }}
                            </span>
                        @else
                            <span class="text-dark fw-bold">
                                Rs. {{ $variation->price }}
                            </span>
                        @endif
                    </p>
                    <form method="POST" action="{{ route('cart.addTester', $tester->id) }}">
                        @csrf
                        <input type="hidden" name="variation_id" value="{{ $variation->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <div class="d-flex gap-1">
                            <button type="submit" class="btn btn-sm btn-primary">Cart</button>
                            {{-- <button type="submit" formaction="{{ route('cart.buyNowTester', $tester->id) }}" class="btn btn-sm btn-success">Buy</button> --}}
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
