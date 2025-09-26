@extends('admin.layouts.main')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Summer Deals Management</h2>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Add Form --}}
    <div class="card mb-4">
        <div class="card-header">Add New Deal</div>
        <div class="card-body">
            <form action="{{ route('admin.summer-deals.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Select Product</label>
                        <select name="product_id" class="form-select" required>
                            <option value="">-- Select Product --</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Real Price</label>
                        <input type="number" name="real_price" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Discount Price</label>
                        <input type="number" name="discount_price" class="form-control" required>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_gift_pack" value="1">
                            <label class="form-check-label">Gift Pack</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Gift Image (if gift pack)</label>
                        <input type="file" name="gift_image" class="form-control">
                    </div>
                    <div class="col-md-4">
    <label class="form-label">Gallery Image (optional)</label>
    <input type="file" name="gallery_image" class="form-control">
</div>

                    <div class="col-md-12 mt-3">
                        <button type="submit" class="btn btn-success">Add Deal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Deals Table --}}
    <div class="card">
        <div class="card-header">Existing Summer Deals</div>
        <div class="card-body">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product</th>
                        <th>Real Price</th>
                        <th>Discount Price</th>
                        <th>Discount %</th>
                        <th>Gift Image</th>
                        <th>Gift Pack</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($deals as $deal)
                    <tr>
                        <td>{{ $deal->id }}</td>
                        <td>{{ $deal->product->name }}</td>
                        <td>PKR {{ number_format($deal->real_price,0) }}</td>
                        <td>PKR {{ number_format($deal->discount_price,0) }}</td>
                        <td><span class="badge bg-success">{{ $deal->discount_percentage }}%</span></td>
                        <td>
                            @if($deal->gift_image)
                                <img src="{{ asset('storage/'.$deal->gift_image) }}" width="60">
                            @endif
                        </td>
                        <td>{{ $deal->is_gift_pack ? 'Yes' : 'No' }}</td>
                        <td>
                          {{-- Update Form --}}
<form action="{{ route('admin.summer-deals.update', $deal->id) }}" method="POST" enctype="multipart/form-data" class="d-inline-block">
    @csrf
    @method('PUT') {{-- Must be here for update --}}

    <input type="number" name="real_price" value="{{ $deal->real_price }}" class="form-control mb-1" style="width:120px;">
    <input type="number" name="discount_price" value="{{ $deal->discount_price }}" class="form-control mb-1" style="width:120px;">

    <input type="file" name="gift_image" class="form-control mb-1" style="width:150px;">

    <div class="form-check mb-1">
        <input class="form-check-input" type="checkbox" name="is_gift_pack" value="1" {{ $deal->is_gift_pack ? 'checked' : '' }}>
        <label class="form-check-label">Gift</label>
    </div>

    <button type="submit" class="btn btn-sm btn-primary">Update</button>
</form>



                          <form action="{{ route('admin.summer-deals.destroy',$deal->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this deal?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger mt-1">Delete</button>
</form>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
