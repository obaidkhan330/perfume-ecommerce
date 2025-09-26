@extends('layouts.app')

@section('content')



<style>
    #quantity:focus {
    outline: none;
    box-shadow: none;
}

.thumbnail-bar {
  display: flex;
  gap: 10px;
  margin: 10px;
}
.thumbnail-bar img {
  width: 80px;
  height: 80px;
  object-fit: cover;
  border: 2px solid #ccc;
  border-radius: 6px;
  cursor: pointer;
  transition: border-color 0.3s;
}
.thumbnail-bar img:hover {
  border-color: #000;
}
.product-checkbox:checked {
  background-color: #0d6efd;
  border-color: #0d6efd;
}

/* Custom button size handling */
@media (min-width: 768px) {
    .btn-md {
        padding: 0.5rem 1rem;
        font-size: 1rem;
    }
     .thumbnail-bar {
    flex-direction: column;
    margin-right: 15px;
  }



}






    /* sirf mobile ke liye */
@media (max-width: 767.98px) {
    .whatsapp-mobile-btn {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        font-size: 14px;
        font-weight: 600;
        padding: 6px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.15);
        margin-bottom: 10px;
    }
    .whatsapp-mobile-btn i {
        font-size: 17px;
    }

     .thumbnail-bar {
    flex-direction: row;
    overflow-x: auto;
  }
}



</style>


<div class="container-fluid py-md-3">
  <div class="row">

      @php
    // Check if product has a summer deal / gift pack
    $deal = \App\Models\SummerDeal::where('product_id', $product->id)->first();
// Price logic
    if ($deal) {
        $realPrice = $deal->real_price;
        $discountPrice = $deal->discount_price;
        $discountPercentage = $deal->discount_percentage ?? ($deal->real_price ? round((($deal->real_price - $deal->discount_price)/$deal->real_price)*100) : 0);
        // Use deal gallery image if exists
        $displayGallery = $deal->gallery_image ? [$deal->gallery_image] : null;
        $mainImage = $deal->gallery_image ? asset('storage/' . $deal->gallery_image) : asset('storage/' . $product->image);
    } else {
        $realPrice = $product->price;
        $discountPrice = $product->discount_price ?? null;
        $discountPercentage = $product->discount_percentage ?? null;
        $displayGallery = json_decode($product->gallery);
        $mainImage = asset('storage/' . $product->image);
    }
@endphp

{{-- Left Side: Thumbnails + Main Image --}}
<div class="col-md-6 d-flex flex-column flex-md-row">
    @php
        $gallery = $product->gallery_override ?? json_decode($product->gallery);
        $mainImage = $gallery[0] ?? $product->image;
    @endphp

    <!-- Thumbnails -->
    <div class="thumbnail-bar">
        @if($gallery)
            @foreach($gallery as $img)
                <img src="{{ asset('storage/' . $img) }}"
                     onclick="changeImage('{{ asset('storage/' . $img) }}')"
                     alt="Thumb">
            @endforeach
        @endif
    </div>

    <!-- Main Image -->
    <div class="flex-grow-1 text-center">
        <img id="mainProductImage"
             src="{{ asset('storage/' . $mainImage) }}"
             alt="{{ $product->name }}"
             class="img-fluid rounded mb-3"
             style="max-height: 500px; object-fit: contain;">
    </div>
</div>
    <!-- Right Side: Product Info -->
    <div class="col-md-5 mt-3 mt-md-0">
      <h2 class="fw-bold">{{ $product->name }}</h2>
{{-- Price Section --}}
<p class="fs-4">
    @php
        $realPrice = $product->real_price ?? $product->price;
        $discountPrice = $product->discount_price ?? $product->variations->min('discount_price') ?? $product->variations->min('price') ?? $product->price;
        $discountPercentage = $product->discount_percentage ?? ($realPrice && $discountPrice < $realPrice ? round((($realPrice - $discountPrice)/$realPrice)*100) : 0);
    @endphp

    @if($discountPrice && $discountPrice < $realPrice)
        <span class="text-muted text-decoration-line-through">
            PKR {{ number_format($realPrice, 0) }}
        </span>
        <span id="price" class="text-danger fw-bold"
              data-real-price="{{ $realPrice }}"
              data-discount-price="{{ $discountPrice }}">
            PKR {{ number_format($discountPrice, 0) }}
        </span>
        <span class="badge bg-success">
            {{ $discountPercentage }}% OFF
        </span>
    @else
        <span id="price" class="text-danger fw-bold"
              data-real-price="{{ $realPrice }}"
              data-discount-price="{{ $discountPrice }}">
            PKR {{ number_format($realPrice, 0) }}
        </span>
    @endif
</p>


{{-- Variations Section --}}
@if($product->variations->count() > 0)
  <div class="d-flex flex-wrap gap-2 mb-3">
    @foreach([30, 50, 100] as $size)
      @php
        $variation = $product->variations
            ->filter(function($v) use ($size) {
                return (int) filter_var($v->variation_type, FILTER_SANITIZE_NUMBER_INT) === $size;
            })
            ->first();
      @endphp

      @if($variation)
        <button type="button"
        class="btn btn-outline-primary variation-btn btn-sm btn-md {{ $loop->first ? 'active' : '' }}"
        data-id="{{ $variation->id }}"
        data-real-price="{{ $variation->price }}"
        data-discount-price="{{ $variation->discount_price ?? $variation->price }}"
        data-volume="{{ $variation->variation_type }}">
  {{ $variation->variation_type }}
</button>

      @else
        <button type="button" class="btn btn-outline-secondary btn-sm btn-md" disabled>
          {{ $size }}ml (Not Available)
        </button>
      @endif
    @endforeach
  </div>

  <p class="text-muted">Size: <span id="ml">{{ $product->variations->first()->variation_type }}</span></p>
@else
  <p class="text-danger">No variations available for this product.</p>
@endif
      <p class="text-muted">{{ $product->fragrance_family }} | {{ $product->brand->name }}</p>
      <p>{{ $product->description }}</p>

      <!-- Qty -->
      <div class="mt-3 d-flex align-items-center">
        <label for="quantity" class="me-2">Qty:</label>
        <div class="d-flex align-items-center rounded-pill border" style="overflow: hidden; width: 150px;">
          <button type="button" onclick="decreaseQty()" class="btn border-0 flex-fill">−</button>
          <input type="number" id="quantity" class="form-control text-center border-0 flex-fill"
                 value="1" min="1" style="max-width: 50px; box-shadow: none;">
          <button type="button" onclick="increaseQty()" class="btn border-0 flex-fill">+</button>
        </div>
      </div>

    <!-- Desktop Actions -->
<div class="mt-4 d-none d-md-flex flex-column gap-2">

    <!-- Add to Cart (Desktop) -->
    <form method="POST" action="{{ route('cart.add', $product->slug) }}">
        @csrf
        <input type="hidden" id="variationIdAdd" name="variation_id" value="{{ $product->smallestVariation->id }}">
        <input type="hidden" id="variationPriceAdd" name="price" value="{{ $product->smallestVariation->discount_price ?? $product->smallestVariation->price }}">
        <input type="hidden" id="variationVolumeAdd" name="volume" value="{{ $product->smallestVariation->variation_type }}">
        <input type="hidden" id="variationQtyAdd" name="quantity" value="1">

        <button type="submit" class="btn btn-primary w-100 rounded-pill">
            <i class="bi bi-cart-plus me-2"></i> Add to Cart
        </button>
    </form>

    <!-- Buy Now (Desktop) -->
    <form method="POST" action="{{ route('cart.buyNow', $product->slug) }}">
        @csrf
        <input type="hidden" id="variationIdBuy" name="variation_id" value="{{ $product->smallestVariation->id }}">
        <input type="hidden" id="variationPriceBuy" name="price" value="{{ $product->smallestVariation->discount_price ?? $product->smallestVariation->price }}">
        <input type="hidden" id="variationVolumeBuy" name="volume" value="{{ $product->smallestVariation->variation_type }}">
        <input type="hidden" id="variationQtyBuy" name="quantity" value="1">

        <button type="submit" class="btn btn-dark w-100 rounded-pill">
            <i class="bi bi-lightning-charge me-2"></i> Buy Now
        </button>
    </form>

    <!-- WhatsApp (Desktop) -->
    @php
        $whatsappNumber = '923179452521';
        $productUrl = url('/details/' . $product->slug);
    @endphp
    <a id="whatsappBtnDesktop"
       href="#"
       target="_blank"
       class="btn btn-success w-100 rounded-pill">
        <i class="bi bi-whatsapp fs-5 me-2"></i> Order on WhatsApp
    </a>


{{-- <!-- Wishlist -->
@php
    $isInWishlist = false;
    if (auth()->check()) {
        $isInWishlist = auth()->user()->wishlists->contains('product_id', $product->id);
    }
@endphp --}}
{{-- <button type="button"
        class="btn btn-outline-danger wishlist-btn align-self-start mt-2"
        data-product-id="{{ $product->id }}">
    <i class="bi bi-heart{{ $isInWishlist ? '-fill' : '' }}"></i>
</button> --}}
</div>


{{-- Mobile Actions --}}
<div class="d-block d-md-none mt-3">

    {{-- Add to Cart (Mobile) --}}
    <form method="POST" action="{{ route('cart.add', $product->slug) }}">
        @csrf
        <input type="hidden" id="variationIdAddMobile" name="variation_id" value="{{ $product->smallestVariation->id }}">
        <input type="hidden" id="variationPriceAddMobile" name="price" value="{{ $product->smallestVariation->discount_price ?? $product->smallestVariation->price }}">
        <input type="hidden" id="variationVolumeAddMobile" name="volume" value="{{ $product->smallestVariation->variation_type }}">
        <input type="hidden" id="variationQtyAddMobile" name="quantity" value="1">

        <button type="submit" class="btn btn-primary whatsapp-mobile-btn mb-2">
            <i class="bi bi-cart-plus fs-5 me-2"></i>
            Add to Cart
        </button>
    </form>

    {{-- Buy Now (Mobile) --}}
    <form method="POST" action="{{ route('cart.buyNow', $product->slug) }}">
        @csrf
        <input type="hidden" id="variationIdBuyMobile" name="variation_id" value="{{ $product->smallestVariation->id }}">
        <input type="hidden" id="variationPriceBuyMobile" name="price" value="{{ $product->smallestVariation->discount_price ?? $product->smallestVariation->price }}">
        <input type="hidden" id="variationVolumeBuyMobile" name="volume" value="{{ $product->smallestVariation->variation_type }}">
        <input type="hidden" id="variationQtyBuyMobile" name="quantity" value="1">

        <button type="submit" class="btn btn-dark whatsapp-mobile-btn mb-2">
            <i class="bi bi-lightning-charge fs-5 me-2"></i>
            Buy Now
        </button>
    </form>

    {{-- WhatsApp Order (Mobile) --}}
    <a id="whatsappBtnMobile"
       href="#"
       target="_blank"
       class="btn btn-success whatsapp-mobile-btn">
        <i class="bi bi-whatsapp fs-4 me-2"></i>
        Order on WhatsApp
    </a>
</div>
</div>




</div>






  {{-- descripction  --}}


<div class="container-fluid my-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold">STOP AND SMELL THESE</h2>
        <h5 class="text-muted">FEATURED NOTES</h5>
        <div class="d-flex justify-content-center gap-3 mt-3">
            <span class="badge bg-dark px-3 py-2">Black Pepper</span>
            <span class="badge bg-dark px-3 py-2">Cade Oil</span>
            <span class="badge bg-dark px-3 py-2">Leather</span>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <p class="text-secondary" style="font-size: 0.95rem;">
                <strong>Dioran</strong> opens with a vibrant burst of citrus and crisp herbal notes, offering an energetic and confident start. As it settles, the heart reveals a refined blend of lavender and warm spices, bringing depth and charm to the composition. The base lingers with rich oud and smooth amber, leaving a trail that is bold, elegant, and unmistakably Mahir—a fragrance that speaks of strength, sophistication, and timeless appeal.
            </p>

            <div class="mt-4">
           <h6 class="fw-bold">Notes:</h6>
                   <ul class="list-unstyled">
                      <li><strong>Top Note:</strong> {{ $product->notes_top }}</li>
                     <li><strong>Middle Note:</strong> {{ $product->notes_middle }}</li>
                      <li><strong>Base Note:</strong> {{ $product->notes_base }}</li>
                   </ul>
            </div>
        </div>
    </div>
</div>

{{-- end descripctyoon     --}}



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
        box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        color: black;
        font-size: 14px;
        text-align: center;
        width: 30px;
        height: 30px;
        line-height: 18px;
    }
</style>






    </div>

    <div class="container-fluid my-5">
        <form method="POST" action="{{ route('cart.bulk') }}">
  @csrf
  <h5 class="mt-4">You might also like these</h5>

  <!-- Horizontal Scroll -->
  <div class="d-flex overflow-auto" style="gap: 1rem; -webkit-overflow-scrolling: touch; white-space: nowrap;">
    @foreach($similarItems as $item)
      @if($item->smallestVariation)
        <div class="card text-center p-2 shadow-sm position-relative d-inline-block"
             style="min-width: 120px; height: 220px;">

          <!-- Checkbox Overlay -->
          <label class="form-check-label position-absolute checkbox-overlay">
            <input type="checkbox" name="selected_products[]" value="{{ $item->slug }}" class="form-check-input">
          </label>

          <!-- Product Image -->
          <img src="{{ asset('storage/' . $item->image) }}"
               class="card-img-top mb-2"
               alt="{{ $item->name }}"
               style="height: 100px; object-fit: cover; border-radius: 6px;">

          <!-- Product Info -->
          <div class="card-body p-1">
            <small class="fw-bold">{{ $item->name }}</small>
            <input type="hidden" name="price[{{ $item->slug }}]" value="{{ $item->smallestVariation->discount_price }}">
            <input type="hidden" name="variation_id[{{ $item->slug }}]" value="{{ $item->smallestVariation->id }}">
            <input type="hidden" name="volume[{{ $item->slug }}]" value="{{ $item->smallestVariation->type }}">
            <input type="hidden" name="quantity[{{ $item->slug }}]" value="1">

            <p class="mb-0">
              <h5 class="price text-muted" style="text-decoration: line-through;">
                {{ $item->smallestVariation->price }}-
              </h5>
              <span class="price text-danger fw-bold">
                {{ $item->smallestVariation->discount_price }}
              </span>
              PKR
            </p>
          </div>
        </div>
      @endif
    @endforeach
  </div>

  <!-- Bulk Action Buttons -->
  <div class="mt-3 d-flex gap-2 mb-3">
    <button type="submit" name="action" value="add" class="btn btn-sm btn-primary">Add Selected to Cart</button>
    <button type="submit" name="action" value="buy" class="btn btn-sm btn-outline-dark">Buy Selected</button>
  </div>
</form>
    <h3 class="fw-bold mb-4">Similar Items</h3>

    <!-- Horizontal Scroll -->
    <div class="d-flex overflow-auto" style="gap: 1rem; -webkit-overflow-scrolling: touch; white-space: nowrap;">
        {{-- Product Card --}}
        @foreach($similarItems as $item)
            <div class="card p-2 shadow-sm product-card d-inline-block" style="min-width: 220px;">
                <div class="hover-icons">
                    <a href="{{ url('details/' . $item->slug) }}"><i class="fas fa-search"></i></a>

                    @if($item->smallestVariation)
                        <form action="{{ route('cart.add', $item->slug) }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="hidden" name="variation_id" value="{{ $item->smallestVariation->id }}">
                            <input type="hidden" name="price" value="{{ $item->smallestVariation->discount_price }}">
                            <input type="hidden" name="volume" value="{{ $item->smallestVariation->type }}">
                            <input type="hidden" name="quantity" value="1">

                            <button type="submit" style="border:none; background:none;">
                                <i class="fas fa-plus text-white"></i>
                            </button>
                        </form>
                    @endif
                </div>

                <img src="{{ asset('storage/' . $item->image) }}"
                     class="card-img-top mb-2"
                     alt="{{ $item->name }}"
                     style="height: 180px; object-fit: cover;">

                <div class="card-body p-2 text-center">
                    <small class="fw-bold">{{ $item->name }}</small>
                    <p class="mb-1">Inspired by {{ $item->brand->name }}</p>

                    @if($item->smallestVariation)
                        <p class="mb-0">
                            <span class="price text-muted" style="text-decoration: line-through;">
                                {{ $item->smallestVariation->price }}-
                            </span>
                            <span class="price text-danger fw-bold">
                                {{ $item->smallestVariation->discount_price }}
                            </span>
                            PKR
                        </p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
</div>




 {{-- top perfume  --}}

<div class="container-fluid my-5">
    <h3 class="fw-bold mb-2">TOP PERFUMES</h3>

    <!-- Horizontal Scroll -->
    <div class="d-flex overflow-auto" style="gap: 1rem; -webkit-overflow-scrolling: touch; white-space: nowrap;">
        {{-- Product Card --}}
        @foreach($topPerfumes as $top)
            <div class="card p-2 shadow-sm product-card d-inline-block" style="min-width: 220px;">
                <div class="hover-icons">
                    <a href="{{ url('details/' . $top->slug) }}"><i class="fas fa-search"></i></a>

                    @if($top->smallestVariation)
                        <form action="{{ route('cart.add', $top->slug) }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="hidden" name="variation_id" value="{{ $top->smallestVariation->id }}">
                            <input type="hidden" name="price" value="{{ $top->smallestVariation->discount_price }}">
                            <input type="hidden" name="volume" value="{{ $top->smallestVariation->type }}">
                            <input type="hidden" name="quantity" value="1">

                            <button type="submit" style="border:none; background:none;">
                                <i class="fas fa-plus text-white"></i>
                            </button>
                        </form>
                    @endif
                </div>

                <img src="{{ asset('storage/' . $top->image) }}"
                     class="card-img-top mb-2"
                     alt="{{ $top->name }}"
                     style="height: 180px; object-fit: cover;">

                <div class="card-body p-2 text-center">
                    <small class="fw-bold">{{ $top->name }}</small>
                    <p class="mb-1">Inspired by {{ $top->brand->name }}</p>

                    @if($top->smallestVariation)
                        <p class="mb-0">
                            <span class="price text-muted" style="text-decoration: line-through;">
                                {{ $top->smallestVariation->price }}-
                            </span>
                            <span class="price text-danger fw-bold">
                                {{ $top->smallestVariation->discount_price }}
                            </span>
                            PKR
                        </p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>





<style>
    .back-button {
        display: inline-block;
        background-color: #000;
        color: #fff;
        padding: 10px 24px;
        border-radius: 30px;
        font-weight: 600;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .back-button:hover {
        background-color: #444;
        color: #fff;
        list-style: none;
    }

    .center-wrapper {
        text-align: center;
        margin: 40px 0;
    }
</style>

<div class="center-wrapper">
    <a href="{{ url('/') }}" class="back-button">
        ← Back to Home
    </a>
</div>


{{-- Toast Container --}}
{{-- <div id="wishlist-toast" style="position: fixed; top: 20px; right: 20px; z-index: 9999; display: none;">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <span id="wishlist-toast-message"></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div> --}}





<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- <script>
$(document).ready(function(){

    function showToast(message) {
        $('#wishlist-toast-message').text(message);
        $('#wishlist-toast').fadeIn();

        // Auto hide after 3 seconds
        setTimeout(function(){
            $('#wishlist-toast').fadeOut();
        }, 3000);
    }

    $('.wishlist-btn').click(function(e){
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
                    showToast('Product removed from wishlist.');
                }
            });
        }
    });

});
</script> --}}

<script>

document.addEventListener("DOMContentLoaded", function() {
    const whatsappNumber = "{{ $whatsappNumber }}";
    const productName = "{{ $product->name }}";
    const productUrl = "{{ $productUrl }}";

    // 👉 variation button active update
    document.querySelectorAll(".variation-btn").forEach(btn => {
        btn.addEventListener("click", function() {
            document.querySelectorAll(".variation-btn").forEach(b => b.classList.remove("active"));
            this.classList.add("active");
        });
    });

    function getSelectedVariation() {
        let selectedBtn = document.querySelector(".variation-btn.active");
        if (selectedBtn) {
            return {
                id: selectedBtn.dataset.id,
                volume: selectedBtn.dataset.volume
            };
        }
        // fallback: smallestVariation
        return {
            id: "{{ $product->smallestVariation->id ?? '' }}",
            volume: "{{ $product->smallestVariation->variation_type ?? '' }}"
        };
    }

    function getQuantity() {
        let qtyInput = document.querySelector("#quantity");
        return qtyInput ? qtyInput.value : 1;
    }

    function buildMessage() {
        let variation = getSelectedVariation();
        let qty = getQuantity();
        return `Hello, I want to order this product:\n\n` +
               `Product: ${productName}\n` +
               `Link: ${productUrl}\n` +
               `Variation: ${variation.volume}\n` +
               `Quantity: ${qty}`;
    }

    function setWhatsappLink(btn) {
        btn.addEventListener("click", function(e) {
            e.preventDefault();
            let message = encodeURIComponent(buildMessage());
            let waUrl = `https://wa.me/${whatsappNumber}?text=${message}`;
            window.open(waUrl, "_blank");
        });
    }

    let desktopBtn = document.getElementById("whatsappBtnDesktop");
    let mobileBtn = document.getElementById("whatsappBtnMobile");

    if (desktopBtn) setWhatsappLink(desktopBtn);
    if (mobileBtn) setWhatsappLink(mobileBtn);
});
</script>



<script>
document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".variation-btn");
    const priceElement = document.getElementById("price");
    const mlElement = document.getElementById("ml");
    const qtyInput = document.getElementById("quantity");

    // Initial prices from blade (handles summer deal or default product)
    let selectedRealPrice = parseFloat(priceElement.dataset.realPrice) || 0;
    let selectedDiscountPrice = parseFloat(priceElement.dataset.discountPrice) || selectedRealPrice;
    let currentPrice = selectedDiscountPrice;

    // Function to update displayed price
    function updatePrice() {
        const qty = parseInt(qtyInput.value) || 1;
        priceElement.innerText = 'PKR ' + (currentPrice * qty).toLocaleString();

        // Update hidden inputs with new qty
        const hiddenIds = [
            "variationQtyAdd", "variationQtyBuy",
            "variationQtyAddMobile", "variationQtyBuyMobile"
        ];
        hiddenIds.forEach(id => {
            const el = document.getElementById(id);
            if (el) el.value = qty;
        });
    }

    // Variation button click
    buttons.forEach(btn => {
        btn.addEventListener("click", function () {
            const realPrice = parseFloat(this.dataset.realPrice);
            const discountPrice = parseFloat(this.dataset.discountPrice) || realPrice;
            const volume = this.dataset.volume;
            const id = this.dataset.id;

            selectedRealPrice = realPrice;
            selectedDiscountPrice = discountPrice;
            currentPrice = discountPrice;

            mlElement.innerText = volume;

            // Update hidden inputs for both mobile and desktop Add/Buy buttons
            const sets = [
                {id: "Add", prefix: ""}, {id: "Buy", prefix: ""},
                {id: "AddMobile", prefix: "Mobile"}, {id: "BuyMobile", prefix: "Mobile"}
            ];

            sets.forEach(set => {
                const suffix = set.prefix ? set.prefix : "";
                const ids = ["variationId" + set.id + suffix,
                             "variationPrice" + set.id + suffix,
                             "variationVolume" + set.id + suffix,
                             "variationQty" + set.id + suffix];
                const values = [id, discountPrice, volume, qtyInput.value];

                ids.forEach((hid, idx) => {
                    const el = document.getElementById(hid);
                    if (el) el.value = values[idx];
                });
            });

            // Active button style
            buttons.forEach(b => b.classList.remove("btn-primary"));
            buttons.forEach(b => b.classList.add("btn-outline-primary"));
            this.classList.remove("btn-outline-primary");
            this.classList.add("btn-primary");

            updatePrice();
        });
    });

    // Qty input change
    qtyInput.addEventListener("input", updatePrice);

    // + / - buttons
    window.increaseQty = function () {
        qtyInput.value = parseInt(qtyInput.value) + 1;
        updatePrice();
    };

    window.decreaseQty = function () {
        if (parseInt(qtyInput.value) > 1) {
            qtyInput.value = parseInt(qtyInput.value) - 1;
            updatePrice();
        }
    };

    // Initial price display
    updatePrice();
});
</script>

<script>
function changeImage(src) {
    document.getElementById("mainProductImage").src = src;
}
</script>

{{-- selected products  --}}
<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form[action='{{ route('cart.bulk') }}']");
    form.addEventListener("submit", function (e) {
        const checked = form.querySelectorAll("input[name='selected_products[]']:checked");
        if (checked.length === 0) {
            e.preventDefault();
            alert("Please select the product"); // Simple alert (ya bootstrap alert bhi laga sakte ho)
        }
    });
});
</script>





@endsection



