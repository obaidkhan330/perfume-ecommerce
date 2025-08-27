@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Your Wishlist</h2>
    <h1>hello</h1>
    <div class="row">
        @forelse($wishlists as $item)
            <div class="col-md-4">
                <div class="card mb-3">
                    <img src="{{ asset('storage/' . $item->product->image) }}" class="card-img-top">
                    <div class="card-body">
                        <h5>{{ $item->product->name }}</h5>
                        <p>{{ $item->product->price }} PKR</p>
                        <form method="POST" action="{{ route('wishlist.destroy', $item->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Remove</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p>No items in wishlist.</p>
        @endforelse
    </div>
</div>
@endsection
