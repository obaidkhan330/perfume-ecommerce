@extends('admin.dashboard')
{{ route('admin.products.index') }}
@section('content')
<div class="container mt-4">
    <h2>Product List</h2>

    {{-- Search Bar --}}
    <form method="GET" action="{{ route('admin.products.index') }}" class="mb-3">
        <input type="text" name="search" class="form-control" placeholder="Search products...">
    </form>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Product Table --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>ML</th>
                <th>Price</th>
                <th>Image</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->ml }}</td>
                <td>{{ $product->price }}</td>
                <td>
                    @if($product->image)
                        <img src="{{ asset('uploads/products/' . $product->image) }}" width="50">
                    @endif
                </td>
                <td>
                    {{ $product->status ? 'Active' : 'Inactive' }}
                </td>
                <td>
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this product?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">No products found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    {{ $products->links() }}
</div>
@endsection
