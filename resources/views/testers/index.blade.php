@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold">All Testers</h2>
    <div class="row">
        @foreach($testers as $tester)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/' . $tester->image) }}"
                         class="card-img-top"
                         alt="{{ $tester->name }}"
                         style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $tester->name }}</h5>
                        <p class="text-danger fw-bold">
                            Rs. {{ $tester->variations->first()->discount_price ?? $tester->variations->first()->price }}
                        </p>
                        <a href="{{ route('testers.show', $tester->slug) }}" class="btn btn-primary">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
