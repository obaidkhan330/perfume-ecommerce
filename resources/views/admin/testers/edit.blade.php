@extends('admin.layouts.main')
@section('content')
<div class="container mt-4">
    <h2>Edit Tester</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.testers.update', $tester->id) }}" method="POST" enctype="multipart/form-data" class="shadow p-4 rounded bg-light">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Tester Name</label>
            <input type="text" name="name" value="{{ $tester->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Brand ID</label>
            <input type="number" name="brand_id" value="{{ $tester->brand_id }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3">{{ $tester->description }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Current Image</label><br>
            @if($tester->image)
                <img src="{{ asset('storage/'.$tester->image) }}" width="100" class="rounded mb-2">
            @else
                <span class="text-muted">No Image</span>
            @endif
            <input type="file" name="image" class="form-control mt-2">
        </div>

        <h5 class="mt-4">Variations</h5>
        <div class="row g-3">
            @foreach($tester->variations as $variation)
                <div class="col-md-4">
                    <label>{{ $variation->pack_size }} Price</label>
                    <input type="number" name="variation_price[{{ $variation->id }}]" class="form-control" value="{{ $variation->price }}">
                    <label>Discount</label>
                    <input type="number" name="variation_discount[{{ $variation->id }}]" class="form-control" value="{{ $variation->discount_price }}">
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            <button class="btn btn-success">Update Tester</button>
            <a href="{{ route('admin.testers.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
