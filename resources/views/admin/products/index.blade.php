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
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <!-- Filters Button -->

        <select name="brand" id="brandFilter" class="form-select w-25">
            <option value="">Select Brand</option>
            @foreach($brands as $brand)
            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
            @endforeach
        </select>
        <select name="fragrance_family" id="fragranceFamilyFilter" class="form-select w-25">
            <option value="">Select Fragrance Family</option>

        </select>

        <!-- Search Bar -->
        <form action="" method="GET" class="d-flex flex-grow-1 mx-2" style="max-width: 300px;">
            <div class="input-group input-group-sm shadow-sm rounded">
                <input type="text" name="q" class="form-control border-0" placeholder="Search products...">
                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
        <div class="button-group">
            <!-- Add Product Button (trigger modal) -->
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addProductModal">
                <i class="bi bi-plus-circle"></i> Add Products
            </button>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addBrandModal">
                <i class="bi bi-plus-circle"></i> Add Brand
            </button>
            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#seeBrandModal">
                <i class="bi bi-eye"></i> See Brands
            </button>
        </div>
    </div>
    <hr class="border border-2 border-primary opacity-75">


    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Add Product Form -->
    <div class="container shadow-sm border-0 rounded">
        <div class=" w-100 d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Manage Products</h2>
        </div>


        <style>
            .product-card {
                position: relative;
                width: 240px;
                display: inline-block;
                overflow: hidden;
            }

            .hover-icons {
                position: absolute;
                top: 10px;
                right: 10px;
                display: flex;
                flex-direction: column;
                gap: 8px;
                opacity: 0;
                transition: opacity 0.3s ease;
                z-index: 2;
            }

            .product-card:hover .hover-icons {
                opacity: 1;
            }

            .hover-icons a {
                background-color: white;
                border-radius: 50%;
                padding: 6px;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
                color: black;
                font-size: 14px;
                text-align: center;
                width: 30px;
                height: 30px;
                line-height: 18px;
            }
        </style>


        <div class="container">
            <div class="row">
                @forelse ($products as $product)
                <div class="col-md-3">
                    <div class="card p-2 shadow-sm product-card">
                        <div class="hover-icons">
                            <!-- Edit Button triggers modal -->
                            <a href="#" data-bs-toggle="modal" data-bs-target="#editProductModal-{{ $product->id }}">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">
                                    <i class="fas fa-trash me-1"></i>
                                </button>
                            </form>

                        </div>

                        <img src="{{ asset('storage/'.$product->image ?? 'naxham/assets/images/perfume1.jpg') }}"
                            class="card-img-top mb-2"
                            alt="{{ $product->name }}"
                            style="height: 180px; object-fit: cover;">
                        <div class="card-body p-2 text-center">
                            <small class="fw-bold" style="font-size: 1rem;">{{ $product->name }}</small>
                            <p class="mb-1" style="font-size: 0.9rem;">{{ $product->fragrance_family }} | {{ $product->brand->name }}</p>
                        </div>
                    </div>
                </div>

                <!-- Edit Product Modal -->
                <div class="modal fade" id="editProductModal-{{ $product->id }}" tabindex="-1" aria-labelledby="editProductModalLabel-{{ $product->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content shadow-lg border-0 rounded-3">

                            <!-- Header -->
                            <div class="modal-header bg-warning text-dark">
                                <h5 class="modal-title" id="editProductModalLabel-{{ $product->id }}">
                                    <i class="bi bi-pencil-square me-2"></i> Edit {{ $product->name }}
                                </h5>
                                <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Form -->
                            <div class="modal-body">
                                <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row g-3">
                                        <!-- Name -->
                                        <div class="col-md-6">
                                            <label class="form-label">Product Name <span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                                        </div>

                                        <!-- Brand -->
                                        <div class="col-md-6">
                                            <label class="form-label">Brand <span class="text-danger">*</span></label>
                                            <select name="brand_id" class="form-select" required>
                                                @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}" {{ $brand->id == $product->brand_id ? 'selected' : '' }}>
                                                    {{ $brand->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Fragrance Family -->
                                        <div class="col-md-6">
                                            <label class="form-label">Fragrance Family</label>
                                            <input type="text" name="fragrance_family" class="form-control" value="{{ $product->fragrance_family }}">
                                        </div>

                                        <!-- Gender -->
                                        <div class="col-md-6">
                                            <label class="form-label">Gender</label>
                                            <select name="gender" class="form-select">
                                                <option value="">Select</option>
                                                <option value="Male" {{ $product->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                                <option value="Female" {{ $product->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                                <option value="Unisex" {{ $product->gender == 'Unisex' ? 'selected' : '' }}>Unisex</option>
                                            </select>
                                        </div>

                                        <!-- Description -->
                                        <div class="col-12">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" rows="3" class="form-control">{{ $product->description }}</textarea>
                                        </div>

                                        <!-- Image -->
                                        <div class="col-md-6">
                                            <label class="form-label">Main Product Image</label>
                                            <input type="file" name="image" class="form-control">
                                            @if($product->image)
                                            <img src="{{ asset($product->image) }}" class="img-fluid mt-2" style="max-height: 100px;">
                                            @endif
                                        </div>

                                        <!-- Gallery -->
                                        <div class="col-md-6">
                                            <label class="form-label">Gallery (Multiple Images)</label>
                                            <input type="file" name="gallery[]" class="form-control" multiple>
                                        </div>

                                        <!-- Notes -->
                                        <div class="col-md-4">
                                            <label class="form-label">Top Notes</label>
                                            <input type="text" name="notes_top" class="form-control" value="{{ $product->notes_top }}">
                                            <input type="file" name="notes_top_image" class="form-control mt-2">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Middle Notes</label>
                                            <input type="text" name="notes_middle" class="form-control" value="{{ $product->notes_middle }}">
                                            <input type="file" name="notes_middle_image" class="form-control mt-2">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Base Notes</label>
                                            <input type="text" name="notes_base" class="form-control" value="{{ $product->notes_base }}">
                                            <input type="file" name="notes_base_image" class="form-control mt-2">
                                        </div>

                                        <!-- SEO -->
                                        <div class="col-md-6">
                                            <label class="form-label">Meta Title</label>
                                            <input type="text" name="meta_title" class="form-control" value="{{ $product->meta_title }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Meta Keywords</label>
                                            <input type="text" name="meta_keywords" class="form-control" value="{{ $product->meta_keywords }}">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Meta Description</label>
                                            <textarea name="meta_description" rows="2" class="form-control">{{ $product->meta_description }}</textarea>
                                        </div>

                                        <!-- Status -->
                                        <div class="col-12 mt-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="status" {{ $product->status ? 'checked' : '' }}>
                                                <label class="form-check-label">Active</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4 text-end">
                                        <button type="submit" class="btn btn-success">
                                            <i class="bi bi-save me-1"></i> Save Changes
                                        </button>
                                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                                            <i class="bi bi-x-circle me-1"></i> Cancel
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p>No products available.</p>
                    @endforelse
                </div>


            </div>

        </div>



        <!-- Add Product Modal -->

        <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content shadow-lg border-0 rounded-3">

                    <!-- Header -->
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="addProductModalLabel">
                            <i class="bi bi-building me-2"></i> Add New Product
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Form -->

                    <div class="card-body p-2">
                        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row g-3">
                                <!-- Name -->
                                <div class="col-md-6">
                                    <label class="form-label">Product Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>

                                <!-- Brand -->
                                <div class="col-md-6">
                                    <label class="form-label">Brand <span class="text-danger">*</span></label>
                                    <select name="brand_id" class="form-select" required>
                                        <option value="" disabled selected>Select Brand</option>
                                        @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Fragrance Family -->
                                <div class="col-md-6">
                                    <label class="form-label">Fragrance Family</label>
                                    <input type="text" name="fragrance_family" class="form-control">
                                </div>

                                <!-- Gender -->
                                <div class="col-md-6">
                                    <label class="form-label">Gender</label>
                                    <select name="gender" class="form-select">
                                        <option value="">Select</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Unisex">Unisex</option>
                                    </select>
                                </div>

                                <!-- Description -->
                                <div class="col-12">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" rows="3" class="form-control"></textarea>
                                </div>

                                <!-- Image -->
                                <div class="col-md-6">
                                    <label class="form-label">Main Product Image</label>
                                    <input type="file" name="image" class="form-control">
                                </div>

                                <!-- Gallery -->
                                <div class="col-md-6">
                                    <label class="form-label">Gallery (Multiple Images)</label>
                                    <input type="file" name="gallery[]" class="form-control" multiple>
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Notes Section -->
                            <h5 class="mb-3">Fragrance Notes</h5>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Top Notes</label>
                                    <input type="text" name="notes_top" class="form-control">
                                    <input type="file" name="notes_top_image" class="form-control mt-2">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Middle Notes</label>
                                    <input type="text" name="notes_middle" class="form-control">
                                    <input type="file" name="notes_middle_image" class="form-control mt-2">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Base Notes</label>
                                    <input type="text" name="notes_base" class="form-control">
                                    <input type="file" name="notes_base_image" class="form-control mt-2">
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- SEO Section -->
                            <h5 class="mb-3">SEO Meta Info</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Meta Title</label>
                                    <input type="text" name="meta_title" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Meta Keywords</label>
                                    <input type="text" name="meta_keywords" class="form-control" placeholder="comma separated">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Meta Description</label>
                                    <textarea name="meta_description" rows="2" class="form-control"></textarea>
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Status -->
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="status" checked>
                                <label class="form-check-label">Active</label>
                            </div>

                            <!-- Buttons -->


                    </div>

                    <!-- Footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save me-1"></i> Save Brand
                        </button>
                        <button type="reset" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                        </button>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle me-1"></i> Cancel
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content shadow-lg border-0 rounded-3">

                    <!-- Header -->
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="addProductModalLabel">
                            <i class="bi bi-building me-2"></i> Add New Product
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Form -->

                    <div class="card-body p-2">
                        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row g-3">
                                <!-- Name -->
                                <div class="col-md-6">
                                    <label class="form-label">Product Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>

                                <!-- Brand -->
                                <div class="col-md-6">
                                    <label class="form-label">Brand <span class="text-danger">*</span></label>
                                    <select name="brand_id" class="form-select" required>
                                        <option value="" disabled selected>Select Brand</option>
                                        @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Fragrance Family -->
                                <div class="col-md-6">
                                    <label class="form-label">Fragrance Family</label>
                                    <input type="text" name="fragrance_family" class="form-control">
                                </div>

                                <!-- Gender -->
                                <div class="col-md-6">
                                    <label class="form-label">Gender</label>
                                    <select name="gender" class="form-select">
                                        <option value="">Select</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Unisex">Unisex</option>
                                    </select>
                                </div>

                                <!-- Description -->
                                <div class="col-12">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" rows="3" class="form-control"></textarea>
                                </div>

                                <!-- Image -->
                                <div class="col-md-6">
                                    <label class="form-label">Main Product Image</label>
                                    <input type="file" name="image" class="form-control">
                                </div>

                                <!-- Gallery -->
                                <div class="col-md-6">
                                    <label class="form-label">Gallery (Multiple Images)</label>
                                    <input type="file" name="gallery[]" class="form-control" multiple>
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Notes Section -->
                            <h5 class="mb-3">Fragrance Notes</h5>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Top Notes</label>
                                    <input type="text" name="notes_top" class="form-control">
                                    <input type="file" name="notes_top_image" class="form-control mt-2">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Middle Notes</label>
                                    <input type="text" name="notes_middle" class="form-control">
                                    <input type="file" name="notes_middle_image" class="form-control mt-2">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Base Notes</label>
                                    <input type="text" name="notes_base" class="form-control">
                                    <input type="file" name="notes_base_image" class="form-control mt-2">
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- SEO Section -->
                            <h5 class="mb-3">SEO Meta Info</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Meta Title</label>
                                    <input type="text" name="meta_title" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Meta Keywords</label>
                                    <input type="text" name="meta_keywords" class="form-control" placeholder="comma separated">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Meta Description</label>
                                    <textarea name="meta_description" rows="2" class="form-control"></textarea>
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Status -->
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="status" checked>
                                <label class="form-check-label">Active</label>
                            </div>

                            <!-- Buttons -->


                    </div>

                    <!-- Footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save me-1"></i> Save Brand
                        </button>
                        <button type="reset" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                        </button>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle me-1"></i> Cancel
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="addBrandModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content shadow-lg border-0 rounded-3">

                    <!-- Header -->
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="addBrandModalLabel">
                            <i class="bi bi-building me-2"></i> Add New Brand
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Form -->
                    <form action="{{route('admin.brands.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">

                            <div class="row g-3">
                                <!-- Brand Name -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-type me-1"></i> Brand Name
                                    </label>
                                    <input type="text" name="name" class="form-control" placeholder="e.g. Dior" required>
                                </div>

                                <!-- Slug -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-link-45deg me-1"></i> Slug
                                    </label>
                                    <input type="text" name="slug" class="form-control" placeholder="auto-generated or enter custom">
                                </div>

                                <!-- Description -->
                                <div class="col-12">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-card-text me-1"></i> Description
                                    </label>
                                    <textarea name="description" class="form-control" rows="2" placeholder="Write a short description..."></textarea>
                                </div>

                                <!-- Origin Country -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-geo-alt me-1"></i> Origin Country
                                    </label>
                                    <input type="text" name="origin_country" class="form-control" placeholder="e.g. France, Italy">
                                </div>

                                <!-- Website -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-globe me-1"></i> Website
                                    </label>
                                    <input type="url" name="website" class="form-control" placeholder="https://brand.com">
                                </div>

                                <!-- Logo -->
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-image me-1"></i> Brand Logo
                                    </label>
                                    <input type="file" name="logo" class="form-control">
                                </div>

                                <!-- Status -->
                                <div class="col-md-6 d-flex align-items-center">
                                    <div class="form-check mt-4">
                                        <input class="form-check-input" type="checkbox" name="status" checked>
                                        <label class="form-check-label fw-semibold"> Active</label>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Footer -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save me-1"></i> Save Brand
                            </button>
                            <button type="reset" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                            </button>
                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle me-1"></i> Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- See Brands Modal -->
        <!-- See All Brands Modal -->
        <div class="modal fade" id="seeBrandModal" tabindex="-1" aria-labelledby="seeBrandModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content shadow-lg border-0 rounded-3">
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title">
                            <i class="bi bi-building me-2"></i> All Brands
                        </h5>
                        <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Description</th>
                                        <th>Origin Country</th>
                                        <th>Website</th>
                                        <th>Logo</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($brands as $brand)
                                    <tr>
                                        <td>{{ $brand->name }}</td>
                                        <td>{{ $brand->slug }}</td>
                                        <td>{{ $brand->description ?? '—' }}</td>
                                        <td>{{ $brand->origin_country ?? '—' }}</td>
                                        <td>
                                            @if ($brand->website)
                                            <a href="{{ $brand->website }}" target="_blank">{{ $brand->website }}</a>
                                            @else
                                            <span class="text-muted">—</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($brand->logo)
                                            <img src="{{ asset('storage/'.$brand->logo) }}" alt="{{ $brand->name }}" class="img-fluid rounded" style="max-width: 50px;">
                                            @else
                                            <span class="text-muted">No Logo</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editBrandModal-{{ $brand->id }}">
                                                <i class="bi bi-pencil me-1"></i> Edit
                                            </button>

                                            <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                    <i class="bi bi-trash me-1"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">No brands available</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle me-1"></i> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <!-- EDIT BRAND MODALS (outside main modal loop) -->
        @foreach ($brands as $brand)
        <div class="modal fade" id="editBrandModal-{{ $brand->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content shadow-lg border-0 rounded-3">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title"><i class="bi bi-pencil-square me-2"></i> Edit Brand</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <form action="{{ route('admin.brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Brand Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $brand->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Brand Slug</label>
                                <input type="text" name="slug" class="form-control" value="{{ $brand->slug }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="2">{{ $brand->description }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Origin Country</label>
                                <input type="text" name="origin_country" class="form-control" value="{{ $brand->origin_country }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Website</label>
                                <input type="url" name="website" class="form-control" value="{{ $brand->website }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Logo</label>
                                <input type="file" name="logo" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Save Changes</button>
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach




        @endsection