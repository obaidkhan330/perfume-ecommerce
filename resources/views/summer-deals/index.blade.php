@extends('layouts.app')

@section('content')

<div class="container-fluid py-5">
     <h2 class="mb-3 mb-md-0 text-center text-md-start fw-bold">
            🔥 Upto 70% Off
        </h2>
 <div>

    <!-- Summer Deals -->
    <div class="row g-4">
        @forelse($deals as $deal)
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card shadow-sm h-100 border-0 rounded-3">
                <img src="{{ asset('storage/' . $deal->product->image) }}"
                     class="card-img-top rounded-top"
                     alt="{{ $deal->product->name }}"
                     style="height: 220px; object-fit: cover;">
                <div class="card-body text-center">
                    <h6 class="card-title fw-bold">{{ $deal->product->name }}</h6>
                    <p class="small text-muted mb-1">
                        {{ $deal->product->fragrance_family }} | {{ $deal->product->brand->name ?? 'N/A' }}
                    </p>
                    <p class="mb-1">
                        <span class="text-muted text-decoration-line-through">
                            PKR {{ number_format($deal->real_price,0) }}
                        </span>
                        <span class="text-danger fw-bold">
                            PKR {{ number_format($deal->discount_price,0) }}
                        </span>
                    </p>
                    <span class="badge bg-success">{{ $deal->discount_percentage }}% OFF</span>
                    <div class="mt-3">
                        <a href="{{ url('details/' . $deal->product->slug) }}" class="btn btn-sm btn-primary">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
            <p class="text-center">No summer deals available.</p>
        @endforelse
    </div>

    <!-- Gift Pack Section -->
    <div class="mt-5">
        <h3 class="mb-4 text-center fw-bold">
            <i class="bi bi-gift-fill text-danger"></i> Gift Packs
        </h3>
        <div class="row g-4">
            @foreach($giftPacks as $gift)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card shadow-sm h-100 border-0 rounded-3">
                    <img src="{{ asset('storage/' . $gift->product->image) }}"
                         class="card-img-top rounded-top"
                         alt="{{ $gift->product->name }}"
                         style="height: 220px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h6 class="card-title fw-bold">{{ $gift->product->name }}</h6>
                        <p class="mb-1">
                            <span class="text-muted text-decoration-line-through">
                                PKR {{ number_format($gift->real_price,0) }}
                            </span>
                            <span class="text-danger fw-bold">
                                PKR {{ number_format($gift->discount_price,0) }}
                            </span>
                        </p>
                        <span class="badge bg-success">{{ $gift->discount_percentage }}% OFF</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</div>
</div>
@endsection
