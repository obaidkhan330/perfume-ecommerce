@extends('layouts.app')

@section('content')

<style>
.thumbnail-bar {
    display: flex;
    gap: 10px;
    margin-top: 10px;
    margin-left: 10px;
    margin-bottom: -20px;
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
}

</style>



<div class="thumbnail-bar">
    @foreach(json_decode($product->gallery) as $img)
        <img src="{{ asset('storage/' . $img) }}"
             onclick="changeImage('{{ asset('storage/' . $img) }}')"
             alt="Thumb">
    @endforeach
</div>
<div class="container py-5">
    <div class="row">
        <!-- Left: Main Image -->
        <div class="col-md-6">
            <img id="mainProductImage"
                 src="{{ asset('storage/' . $product->image) }}"
                 alt="{{ $product->name }}"
                 class="img-fluid rounded mb-3"
                 style="max-height: 400px; object-fit: cover;">
        </div>

       <!-- Right: Product Info + Suggestions -->
<div class="col-md-6">
    <h2 class="fw-bold">{{ $product->name }}</h2>

    @if($product->variations->count() > 0)
        <p class="fs-4 text-danger">
            Rs. <span id="price">{{ $product->smallestVariation->discount_price }}</span>
        </p>

        {{-- Buttons for Variations --}}
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
                    class="btn btn-outline-primary variation-btn btn-sm btn-md"
                    data-id="{{ $variation->id }}"
                    data-price="{{ $variation->discount_price }}"
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




        <p class="text-muted">Size: <span id="ml">{{ $product->variations->first()->type }}</span></p>
    @else
        <p class="text-danger">No variations available for this product.</p>
    @endif

    <p class="text-muted">{{ $product->fragrance_family }} | {{ $product->brand->name }}</p>
    <p>{{ $product->description }}</p>

    <div class="mt-3 d-flex align-items-center">
        <label for="quantity" class="me-2">Qty:</label>
        <div class="input-group" style="width: 120px;">
            <button class="btn btn-outline-secondary" type="button" onclick="decreaseQty()">−</button>
            <input type="number" id="quantity" class="form-control text-center" value="1" min="1">
            <button class="btn btn-outline-secondary" type="button" onclick="increaseQty()">+</button>
        </div>
    </div>

<div class="mt-4 d-flex gap-3">
 {{-- Add to Cart --}}
<form method="POST" action="{{ route('cart.add', $product->slug) }}">
    @csrf
    <input type="hidden" name="variation_id" id="variationIdAdd">
    <input type="hidden" name="price" id="variationPriceAdd">
    <input type="hidden" name="volume" id="variationVolumeAdd">
    <input type="hidden" name="quantity" id="variationQtyAdd">

    <button type="submit" class="btn btn-primary">Add to Cart</button>
</form>

{{-- Buy Now --}}
<form method="POST" action="{{ route('cart.buyNow', $product->slug) }}">
    @csrf
    <input type="hidden" name="variation_id" id="variationIdBuy">
    <input type="hidden" name="price" id="variationPriceBuy">
    <input type="hidden" name="volume" id="variationVolumeBuy">
    <input type="hidden" name="quantity" id="variationQtyBuy">

    <button type="submit" class="btn btn-outline-dark">Buy Now</button>
</form>

</div>

</div>


<form method="POST" action="{{ route('cart.bulk') }}">
  @csrf
  <h5 class="mt-4">You might also like these</h5>

  <div class="d-flex gap-3 flex-wrap">
    @foreach($similarItems as $item)
      @if($item->smallestVariation)
       <div class="card text-center p-2 shadow-sm position-relative" style="width: 120px; height: 220px;">

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
              <span class="price text-muted" style="text-decoration: line-through;">
                {{ $item->smallestVariation->price }}-
              </span>
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
  <div class="mt-3 d-flex gap-2">
    <button type="submit" name="action" value="add" class="btn btn-sm btn-primary">Add Selected to Cart</button>
    <button type="submit" name="action" value="buy" class="btn btn-sm btn-outline-dark">Buy Selected</button>
  </div>
</form>


</div>




  {{-- descripction  --}}


<div class="container my-5">
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

<div class="container my-5">
    <h3 class="fw-bold mb-4">Similar Items</h3>
    <div class="d-flex flex-wrap gap-4 justify-content-start">

        {{-- Product Card --}}
       @foreach($similarItems as $item)
    <div class="card p-2 shadow-sm product-card">
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
        <i class="fas fa-plus text-white "></i>
      </button>
    </form>
  @endif
</div>
        <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top mb-2" alt="{{ $item->name }}" style="height: 180px; object-fit: cover;">
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
</div>




 {{-- top perfume  --}}


<div class="container my-5">
    <h3 class="fw-bold mb-4">TOP PERFUMES</h3>
    <div class="d-flex flex-wrap gap-4 justify-content-start">

        {{-- Product Card --}}
       @foreach($topPerfumes as $top)
    <div class="card p-2 shadow-sm product-card">
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
        <img src="{{ asset('storage/' . $top->image) }}" class="card-img-top mb-2" alt="{{ $top->name }}" style="height: 180px; object-fit: cover;">
        <div class="card-body p-2 text-center">
            <small class="fw-bold">{{ $top->name }}</small>
            <p class="mb-1">Inspired by {{ $top->brand->name }}</p>
            {{-- <p class="mb-1 text-danger fw-semibold">Rs. {{ $top->price }}</p> --}}

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




{{-- Button Scripts --}}
<script>
document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".variation-btn");
    const priceElement = document.getElementById("price");
    const mlElement = document.getElementById("ml");
    const qtyInput = document.getElementById("quantity");

    const variationIdInput = document.getElementById("variationId");
    const variationPriceInput = document.getElementById("variationPrice");
    const variationVolumeInput = document.getElementById("variationVolume");
    const variationQtyInput = document.getElementById("variationQty");

    let currentPrice = parseFloat(priceElement.innerText) || 0;

    // Function to update price
    function updatePrice() {
        const qty = parseInt(qtyInput.value) || 1;
        priceElement.innerText = (currentPrice * qty).toFixed(0); // .00 hata diya
        variationQtyInput.value = qty;
    }

// Variation button click
buttons.forEach(btn => {
    btn.addEventListener("click", function () {
        const price = parseFloat(this.getAttribute("data-price"));
        const volume = this.getAttribute("data-volume");
        const id = this.getAttribute("data-id");

        currentPrice = price;
        mlElement.innerText = volume;

        const qtyInput = document.getElementById("quantity");

        // Add to Cart hidden inputs
        document.getElementById("variationIdAdd").value = id;
        document.getElementById("variationPriceAdd").value = price;
        document.getElementById("variationVolumeAdd").value = volume;
        document.getElementById("variationQtyAdd").value = qtyInput.value;

        // Buy Now hidden inputs
        document.getElementById("variationIdBuy").value = id;
        document.getElementById("variationPriceBuy").value = price;
        document.getElementById("variationVolumeBuy").value = volume;
        document.getElementById("variationQtyBuy").value = qtyInput.value;

        // Active button highlight
        buttons.forEach(b => {
            b.classList.remove("btn-primary");
            b.classList.add("btn-outline-primary");
        });
        this.classList.remove("btn-outline-primary");
        this.classList.add("btn-primary");

        updatePrice();
    });
});

// Sync quantity to both forms
document.getElementById("quantity").addEventListener("input", function () {
    document.getElementById("variationQtyAdd").value = this.value;
    document.getElementById("variationQtyBuy").value = this.value;
});

// Qty input change event (extra safe)
// document.getElementById("quantity").addEventListener("input", function () {
//     variationQtyInput.value = this.value;
// });

    // + / - functions
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

    // Image change function
    window.changeImage = function (src) {
        document.getElementById('mainProductImage').src = src;
    };

    // Init
    updatePrice();
});
</script>

@endsection



