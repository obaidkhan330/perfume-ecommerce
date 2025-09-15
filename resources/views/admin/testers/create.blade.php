@extends('admin.layouts.main')

@section('content')
<div class="container mt-4">
    <h2>Add New Tester</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.testers.store') }}" method="POST" enctype="multipart/form-data" class="shadow p-4 rounded bg-light">
        @csrf

        <div class="mb-3">
            <label class="form-label">Tester Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter tester name" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Brand ID</label>
            <input type="number" name="brand_id" class="form-control" placeholder="Enter brand ID">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3" placeholder="Enter tester description"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <h5 class="mt-4">Variations</h5>
        <div class="row g-3">
            <div class="col-md-4">
                <label>1 Tester Price</label>
                <input type="number" name="price_1" class="form-control">
                <label>Discount</label>
                <input type="number" name="discount_1" class="form-control">
            </div>
            <div class="col-md-4">
                <label>3 Testers Price</label>
                <input type="number" name="price_3" class="form-control">
                <label>Discount</label>
                <input type="number" name="discount_3" class="form-control">
            </div>
            <div class="col-md-4">
                <label>5 Testers Price</label>
                <input type="number" name="price_5" class="form-control">
                <label>Discount</label>
                <input type="number" name="discount_5" class="form-control">
            </div>
        </div>

        <div class="mt-4">
            <button class="btn btn-success">Save Tester</button>
            <a href="{{ route('admin.testers.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
