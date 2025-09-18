@extends('layouts.app')
@section('content')

<section class="container py-5">
    <h2 class="mb-4 text-center"> Male</h2>

    <div class="d-flex overflow-auto" style="gap: 1rem; -webkit-overflow-scrolling: touch; white-space: nowrap;">
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
    </div>
</section>

@endsection
