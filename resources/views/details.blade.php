@extends('layouts.app')

@section('content')


<style>
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
</style>
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

    @if($product->smallestVariation)
        <p class="fs-4 text-danger">
            Rs. <span id="price">{{ $product->smallestVariation->discount_price }}</span>
        </p>

        <select id="variationSelect" class="form-select mb-3" onchange="updateVariation()">
            @foreach($product->variations as $variation)
                <option value="{{ $variation->id }}"
                        data-price="{{ $variation->discount_price }}"
                        data-volume="{{ $variation->type }}">
                    {{ $variation->type }}ml - Rs. {{ $variation->discount_price }}
                </option>
            @endforeach
        </select>

        <p class="text-muted">Size: <span id="ml">{{ $product->variations->first()->type }}</span></p>
    @endif

    <p class="text-muted">{{ $product->fragrance_family }} | {{ $product->brand->name }}</p>
    <p>{{ $product->description }}</p>

    <div class="mt-3 d-flex align-items-center">
        <label for="quantity" class="me-2">Qty:</label>
        <div class="input-group" style="width: 120px;">
            <button class="btn btn-outline-secondary" type="button" onclick="decreaseQty()">−</button>
            <input type="number" id="quantity" class="form-control text-center" value="1" min="1" onchange="updateVariation()">
            <button class="btn btn-outline-secondary" type="button" onclick="increaseQty()">+</button>
        </div>
    </div>

    <div class="mt-4 d-flex gap-3">
        <form method="POST" action="{{ route('cart.add', $product->slug) }}">
            @csrf
            <input type="hidden" name="variation_id" id="variationId">
            <input type="hidden" name="price" id="variationPrice">
            <input type="hidden" name="volume" id="variationVolume">
            <input type="hidden" name="quantity" id="variationQty">

            <button type="submit" class="btn btn-primary">Add to Cart</button>
        </form>
        <button class="btn btn-outline-dark">Buy Now</button>
    </div>
</div>

    <h5 class="mt-4">You might also like these</h5>

{{-- <form method="POST" action="{{ route('cart') }}"> --}}
    @csrf
    <div class="d-flex gap-3 flex-wrap">
        @foreach($similarItems as $item)
            <div class="card text-center p-2 shadow-sm position-relative" style="width: 120px; height: 220px;">

                <!-- Checkbox Overlay -->
                <input type="checkbox" name="selected_products[]" value="{{ $item->slug }}"
                       class="form-check-input position-absolute"
                       style="top: 8px; left: 8px; z-index: 2; background-color: white;">

                <!-- Product Image -->
                <img src="{{ asset('storage/' . $item->image) }}"
                     class="card-img-top mb-2"
                     alt="{{ $item->name }}"
                     style="height: 100px; object-fit: cover; border-radius: 6px;">

                <!-- Product Info -->
                <div class="card-body p-1">
                    <small class="fw-bold">{{ $item->name }}</small>
                    {{-- <p class="mb-1" style="font-size: 0.75rem;">Size: 100ml</p> --}}
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
                     {{-- <p class="text-muted" style="font-size: 0.2rem;">{{ $item->fragrance_family }}</p> --}}
                </div>
            </div>
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
            <a href="#"><i class="fas fa-plus"></i></a>
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
            <a href="#"><i class="fas fa-plus"></i></a>
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
function changeImage(src) {
  document.getElementById('mainProductImage').src = src;
}

function updateVariation() {
  const select = document.getElementById('variationSelect');
  const selected = select.options[select.selectedIndex];

  const price = parseFloat(selected.getAttribute('data-price'));
  const volume = selected.getAttribute('data-volume');
  const qty = parseInt(document.getElementById('quantity').value);

  // Update visible price and volume
  document.getElementById('price').textContent = (price * qty).toFixed(2);
  document.getElementById('ml').textContent = volume;

  // Update hidden form fields
  document.getElementById('variationId').value = selected.value;
  document.getElementById('variationPrice').value = price;
  document.getElementById('variationVolume').value = volume;
  document.getElementById('variationQty').value = qty;
}

function increaseQty() {
  const qtyInput = document.getElementById('quantity');
  qtyInput.value = parseInt(qtyInput.value) + 1;
  updateVariation();
}

function decreaseQty() {
  const qtyInput = document.getElementById('quantity');
  if (parseInt(qtyInput.value) > 1) {
    qtyInput.value = parseInt(qtyInput.value) - 1;
    updateVariation();
  }
}

// Update on manual input
document.getElementById('quantity').addEventListener('input', updateVariation);

// Initialize on page load
window.onload = updateVariation;
</script>
@endsection



