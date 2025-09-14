@extends('admin.layouts.main')

@section('content')
<div class="container mt-4">
    <h2>Tester Details</h2>

    <div class="card shadow-sm rounded">
        <div class="card-body">
            <h4>{{ $tester->name }}</h4>
            <p><strong>Brand ID:</strong> {{ $tester->brand_id }}</p>
            <p><strong>Description:</strong> {{ $tester->description ?? 'N/A' }}</p>

            @if($tester->image)
                <div class="mb-3">
                    <img src="{{ asset('storage/'.$tester->image) }}" width="150" class="rounded shadow">
                </div>
            @endif

            <h5>Variations</h5>
            <ul class="list-group mb-3">
                @foreach($tester->variations as $variation)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $variation->pack_size }} - {{ $variation->price }} Rs
                        @if($variation->discount_price)
                            <span class="text-muted"><del>{{ $variation->discount_price }} Rs</del></span>
                        @endif
                    </li>
                @endforeach
            </ul>

            <a href="{{ route('admin.testers.edit', $tester->id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('admin.testers.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
@endsection
