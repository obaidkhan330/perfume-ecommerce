@extends('layouts.app')

@section('content')

<style>
    .banner-container {
    width: 100%;
    height: 400px; /* desktop ki height fix */
    overflow: hidden;
    position: relative;
    border-radius: 12px; /* optional rounded look */
    margin-top: 1px;
}

.banner-img {
    width: 100%;
    height: 100%;
    object-fit: cover;   /* crop karega lekin distort nahi karega */
    object-position: center; /* image ko center rakhega */
}

/* Mobile ke liye responsive height */
@media (max-width: 768px) {
    .banner-container {
        height: 250px; /* mobile me thoda chota */
    }
}


</style>

<section class="banner-section mb-4">
    <div class="banner-container">
        <img src="{{ asset('naxham/assets/images/slider1.jpg') }}" alt="Banner" class="banner-img">
    </div>
</section>




<div class="container py-5">
    <h2 class="mb-4">Your Wishlist</h2>

    <div class="row g-3">
        @forelse($wishlists as $item)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/' . $item->product->image) }}" class="card-img-top" alt="{{ $item->product->name }}">

                    <div class="card-body d-flex flex-column">
                        {{-- Product Name --}}
                       <h5 class="card-title">{{ $item->product->name }}</h5>

<p class="card-text mb-3">
    PKR
    @if($item->product->variations->count() > 0)
        {{ number_format($item->product->variations->sortBy('discount_price')->first()->discount_price) }}
    @else
        {{ number_format($item->product->price) }}
    @endif
</p>



                        {{-- Buttons --}}
                        <div class="mt-auto d-flex flex-column gap-2">
                            {{-- Remove Button --}}
                            <button class="btn btn-danger remove-wishlist-btn" data-product-id="{{ $item->product->id }}">
                                Remove
                            </button>

                            {{-- Wishlist Heart Button
                            <button type="button" class="btn btn-outline-danger wishlist-btn" data-product-id="{{ $item->product->id }}">
                                <i class="bi bi-heart{{ auth()->user()->wishlists->contains('product_id', $item->product->id) ? '-fill' : '' }}"></i>
                            </button> --}}

                            {{-- Detail Button --}}
                            <a href="{{ route('details', $item->product->slug) }}" class="btn btn-primary">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    No items in wishlist.
                </div>
            </div>
        @endforelse
    </div>
</div>

{{-- Toast container --}}
<div id="wishlist-toast" style="position: fixed; top: 20px; right: 20px; z-index: 9999; display: none;">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <span id="wishlist-toast-message"></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>

{{-- jQuery --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function(){

    function showToast(message) {
        $('#wishlist-toast-message').text(message);
        $('#wishlist-toast').fadeIn();
        setTimeout(function(){
            $('#wishlist-toast').fadeOut();
        }, 3000);
    }

    // Remove wishlist item
    $(document).on('click', '.remove-wishlist-btn', function(){
        var btn = $(this);
        var productId = btn.data('product-id');

        $.ajax({
            url: '/wishlist/' + productId,
            type: 'DELETE',
            data: {_token: '{{ csrf_token() }}'},
            success: function(res){
                btn.closest('.col-6').remove();
                $('#wishlist-count').text(res.count);
                showToast('Product removed from wishlist successfully!');
            }
        });
    });

    // Toggle wishlist heart
    $(document).on('click', '.wishlist-btn', function(e){
        e.preventDefault();
        var btn = $(this);
        var productId = btn.data('product-id');
        var icon = btn.find('i');

        if(icon.hasClass('bi-heart')) {
            // Add to wishlist
            $.post('/wishlist/' + productId, {_token: '{{ csrf_token() }}'}, function(res){
                icon.removeClass('bi-heart').addClass('bi-heart-fill');
                $('#wishlist-count').text(res.count);
                showToast('Product added to wishlist successfully!');
            });
        } else {
            // Remove from wishlist
            $.ajax({
                url: '/wishlist/' + productId,
                type: 'DELETE',
                data: {_token: '{{ csrf_token() }}'},
                success: function(res){
                    icon.removeClass('bi-heart-fill').addClass('bi-heart');
                    $('#wishlist-count').text(res.count);
                    showToast('Product removed from wishlist successfully!');
                }
            });
        }
    });

});
</script>
@endsection
