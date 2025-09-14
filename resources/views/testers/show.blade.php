@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4">{{ $tester->name }}</h2>
    <p class="text-muted">{{ $tester->brand->name ?? 'No Brand' }}</p>
    <p>{{ $tester->description }}</p>

    <div class="row">
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

                        <!-- Add to cart -->
                        <form method="POST" action="{{ route('cart.addTester', $tester->id) }}">
                            @csrf
                            <input type="hidden" name="variation_id" value="{{ $variation->id }}">
                            <input type="number" name="quantity" value="1" min="1" class="form-control mb-2 text-center">
                            <button type="submit" class="btn btn-primary w-100">
                                Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
