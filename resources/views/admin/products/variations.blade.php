@extends('admin.layouts.main')

@section('content')
<style>
    .scroll-container {
        max-height: 90vh;
        overflow-y: auto;
        overflow-x: hidden;
        border: 1px solid #ddd;
        padding: 10px;
        background: #fff;
    }
</style>
<div class="container mt-4 scroll-container ">

    <h3 class="mb-4">Add Product Variation</h3>

    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Variation Form -->
    <form action="{{ route('admin.variations.store') }}" method="POST" class="card shadow-sm p-3 border-0 rounded-3">
        @csrf

        <h5 class="mb-3 fw-bold">Add Product Variation</h5>

        <div class="row g-3">
            <!-- Product Select -->
            <div class="col-md-6">
                <label for="product_id" class="form-label small text-muted">Product</label>
                <select name="product_id" id="product_id" class="form-select form-select-sm" required>
                    <option value="">-- Choose Product --</option>
                    @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Variation Type -->
            <div class="col-md-6">
                <label class="form-label small text-muted">Variation Type</label>
                <input type="text" name="variation_type" class="form-control form-control-sm" placeholder="e.g. 100ml, Large, Red" required>
            </div>

            <!-- Stock -->
            <div class="col-md-4">
                <label class="form-label small text-muted">Stock</label>
                <input type="number" name="stock" class="form-control form-control-sm" min="0" required>
            </div>

            <!-- Price -->
            <div class="col-md-4">
                <label class="form-label small text-muted">Price</label>
                <input type="number" name="price" class="form-control form-control-sm" step="0.01" min="0" required>
            </div>

            <!-- Discount Price -->
            <div class="col-md-4">
                <label class="form-label small text-muted">Discount Price</label>
                <input type="number" name="discount_price" class="form-control form-control-sm" step="0.01" min="0">
            </div>

            <!-- SKU -->
            <div class="col-md-6">
                <label class="form-label small text-muted">SKU</label>
                <input type="text" name="sku" class="form-control form-control-sm" placeholder="Unique SKU code" required>
            </div>
            <div class="col-md-6 d-flex align-items-end ">
                <button type="submit" class="btn btn-sm btn-primary px-4 w-100">Save</button>
            </div>
        </div>



    </form>


    <!-- Existing Variations Table -->
    <h4 class="mt-5">Existing Variations</h4>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Product</th>
                <th>Variation</th>
                <th>Stock</th>
                <th>Price</th>
                <th>Discount Price</th>
                <th>SKU</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($variations as $variation)
            <tr>
                <td>{{ $variation->product->name ?? 'N/A' }}</td>
                <td>{{ $variation->variation_type }}</td>
                <td>{{ $variation->stock }}</td>
                <td>{{ $variation->price }}</td>
                <td>{{ $variation->discount_price }}</td>
                <td>{{ $variation->sku }}</td>
                <td>
                    <!-- Delete Button -->
                    <form action="{{ route('admin.variations.destroy', $variation->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>

                    <!-- Edit Button -->
                    <button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#editVariationModal-{{ $variation->id }}">
                        Edit
                    </button>
                </td>

                <!-- Edit Modal -->
                <div class="modal fade" id="editVariationModal-{{ $variation->id }}" tabindex="-1" aria-labelledby="editVariationLabel-{{ $variation->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content border-0 shadow-lg rounded-3">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editVariationLabel-{{ $variation->id }}">Edit Variation ({{ $variation->variation_type }})</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <form action="{{ route('admin.variations.update', $variation->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="modal-body">
                                    <div class="row g-3">
                                        <!-- Product -->
                                        <div class="col-md-6">
                                            <label class="form-label small text-muted">Product</label>
                                            <select name="product_id" class="form-select form-select-sm" required>
                                                @foreach($products as $product)
                                                <option value="{{ $product->id }}" {{ $variation->product_id == $product->id ? 'selected' : '' }}>
                                                    {{ $product->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Variation Type -->
                                        <div class="col-md-6">
                                            <label class="form-label small text-muted">Variation Type</label>
                                            <input type="text" name="variation_type" value="{{ $variation->variation_type }}" class="form-control form-control-sm" required>
                                        </div>

                                        <!-- Stock -->
                                        <div class="col-md-4">
                                            <label class="form-label small text-muted">Stock</label>
                                            <input type="number" name="stock" value="{{ $variation->stock }}" class="form-control form-control-sm" min="0" required>
                                        </div>

                                        <!-- Price -->
                                        <div class="col-md-4">
                                            <label class="form-label small text-muted">Price</label>
                                            <input type="number" name="price" value="{{ $variation->price }}" class="form-control form-control-sm" step="0.01" min="0" required>
                                        </div>

                                        <!-- Discount Price -->
                                        <div class="col-md-4">
                                            <label class="form-label small text-muted">Discount Price</label>
                                            <input type="number" name="discount_price" value="{{ $variation->discount_price }}" class="form-control form-control-sm" step="0.01" min="0">
                                        </div>

                                        <!-- SKU -->
                                        <div class="col-md-6">
                                            <label class="form-label small text-muted">SKU</label>
                                            <input type="text" name="sku" value="{{ $variation->sku }}" class="form-control form-control-sm" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-sm btn-primary px-4">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
