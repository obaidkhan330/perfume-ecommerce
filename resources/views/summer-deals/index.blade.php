@extends('layouts.app')

@section('content')
<div class="container-fluid py-5">
    <h2 class="mb-3 mb-md-0 text-center text-md-start fw-bold">
        🔥 Upto 70% Off
    </h2>

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

                        {{-- Price Section --}}
                        @if($deal->discount_price)
                            <p>
                                <span class="text-muted text-decoration-line-through">
                                    PKR {{ number_format($deal->real_price, 0) }}
                                </span>
                                <span class="text-danger fw-bold">
                                    PKR {{ number_format($deal->discount_price, 0) }}
                                </span>
                                <span class="badge bg-success">{{ $deal->discount_percentage }}% OFF</span>
                            </p>
                        @else
                            <p>
                                <span class="fw-bold">
                                    PKR {{ number_format($deal->real_price, 0) }}
                                </span>
                            </p>
                        @endif

                        {{-- Button --}}
                        <div class="mt-3">
                            <a href="{{ url('details/' . $deal->product->slug . '?deal=' . $deal->id) }}" class="btn btn-sm btn-primary">
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
            @forelse($giftPacks as $gift)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card shadow-sm h-100 border-0 rounded-3">

                        {{-- Gift Image --}}
                        <img src="{{ asset('storage/' . ($gift->gift_image ?? $gift->product->image)) }}"
                             class="card-img-top rounded-top"
                             alt="{{ $gift->product->name }}"
                             style="height: 220px; object-fit: cover;">

                        <div class="card-body text-center">
                            <h6 class="card-title fw-bold">{{ $gift->product->name }}</h6>

                            {{-- Price Section --}}
                            @if($gift->discount_price)
                                <p>
                                    <span class="text-muted text-decoration-line-through">
                                        PKR {{ number_format($gift->real_price, 0) }}
                                    </span>
                                    <span class="text-danger fw-bold">
                                        PKR {{ number_format($gift->discount_price, 0) }}
                                    </span>
                                    <span class="badge bg-success">{{ $gift->discount_percentage }}% OFF</span>
                                </p>
                            @else
                                <p>
                                    <span class="fw-bold">
                                        PKR {{ number_format($gift->real_price, 0) }}
                                    </span>
                                </p>
                            @endif

                            {{-- Buttons --}}
                            <div class="mt-3 d-flex justify-content-center gap-2">
                                <a href="{{ url('details/' . $gift->product->slug . '?deal=' . $gift->id) }}" class="btn btn-sm btn-primary">
                                    View Details
                                </a>

                                @if($gift->product->smallestVariation)
                                    <form action="{{ route('cart.add', $gift->product->slug) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="variation_id" value="{{ $gift->product->smallestVariation->id }}">
                                        <input type="hidden" name="price" value="{{ $gift->discount_price ?? $gift->real_price }}">
                                        <input type="hidden" name="volume" value="{{ $gift->product->smallestVariation->variation_type }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">No gift packs available.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
