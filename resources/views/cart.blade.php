@extends('layouts.app')

@section('content')

<style>
.table-cart th {
  color: #000 !important;
  font-weight: bold;
}

.cart-thumb img {
  border-radius: 6px;
  object-fit: cover;
  width: 80px;
  height: auto;
}

#cart-subtotal, #cart-total {
  transition: all 0.2s ease;
}

@media (max-width: 768px) {
  .table-cart thead {
    display: none;
  }

  .table-cart tr {
    display: flex;
    flex-direction: column;
    border-bottom: 1px solid #ddd;
    padding: 10px 0;
  }

  .table-cart td {
    display: block;
    width: 100%;
    padding: 5px 0;
    text-align: left !important;
  }

  .cart-thumb {
    display: inline-block;
    margin-right: 10px;
  }

  .cart-product-info {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
  }

  .cart-product-details {
    flex: 1;
  }

  .cart-qty-price {
    margin-top: 10px;
  }

  .qty-controls {
  display: flex;
  align-items: center;
  gap: 6px;
  flex-wrap: nowrap;
}

.qty-controls input[type="number"] {
  width: 50px;
  padding: 4px;
  font-size: 14px;
}

.qty-controls .btn {
  padding: 4px 8px;
  font-size: 14px;
}

.qty-controls .price {
  font-weight: bold;
  font-size: 14px;
  margin-left: 10px;
  white-space: nowrap;
}
}

@media (min-width: 769px) {
  .table-cart tr {
    display: table-row;
  }

  .table-cart td {
    display: table-cell;
    vertical-align: middle;
    padding: 12px;
  }

  .cart-qty-price {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .qty-controls {
    display: flex;
    gap: 8px;
    align-items: center;
  }

  .qty-controls .price {
    margin-left: 12px;
    font-weight: bold;
  }
}
</style>

@php
    $cart = session('cart', []);
    $total = 0;
@endphp

<section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('naxham/assets/images/bg_2.jpg') }}');" data-stellar-background-ratio="0.6">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text align-items-end justify-content-center">
      <div class="col-md-9 ftco-animate mb-5 text-center">
        <p class="breadcrumbs mb-0">
          <span class="mr-2"><a href="{{ url('/') }}">Home <i class="fa fa-chevron-right"></i></a></span>
          <span>Cart <i class="fa fa-chevron-right"></i></span>
        </p>
        <h2 class="mb-0 bread">Your Cart</h2>
      </div>
    </div>
  </div>
</section>

<section class="py-3">
  <div class="container">
    <div class="row g-4">
      <!-- Cart Table -->
      <div class="col-lg-8">
        <div class="card box">
          <div class="card-body p-4 mt-4">
            @if(session('cart') && count(session('cart')) > 0)
            <div class="table-responsive">
              <table class="table table-cart align-middle">
                <thead>
                  <tr>
                    <th style="width:56px"></th>
                    <th>Product</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-end">Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                  @php $total = 0; @endphp
                 @foreach(session('cart') as $slug => $item)
@php
  $subtotal = $item['price'] * $item['quantity'];
  $total += $subtotal;
@endphp
<tr class="cart-row">
  <td class="cart-remove">
    <a href="{{ route('cart.remove', $slug) }}" class="text-danger" title="Remove">
      <i class="bi bi-x-lg"></i>
    </a>
  </td>
  <td class="cart-product">
    <div class="cart-thumb">
      <img src="{{ asset('storage/' . $item['image']) }}" alt="">
    </div>
    <div class="cart-details">
      <a class="text-dark fw-bold text-decoration-none" href="{{ url('product/' . $slug) }}">{{ $item['name'] }}</a>
      <div class="small text-muted">{{ $item['description'] ?? '100ml • EDP' }}</div>
    </div>
  </td>
  <td class="cart-price text-center fw-bold">
    PKR {{ number_format($item['price']) }}
  </td>
  <td class="cart-qty text-center">
    <div class="qty-controls">
      <button class="btn btn-sm btn-outline-dark" onclick="changeQty('{{ $slug }}', -1)">−</button>
      <input type="number" id="qty-{{ $slug }}" value="{{ $item['quantity'] }}" min="1"
             class="form-control text-center" onchange="updateCart('{{ $slug }}')">
      <button class="btn btn-sm btn-outline-dark" onclick="changeQty('{{ $slug }}', 1)">+</button>
    </div>
  </td>
  <td class="cart-subtotal text-end fw-bold">
    <span id="subtotal-{{ $slug }}">PKR {{ number_format($item['price'] * $item['quantity']) }}</span>
  </td>
</tr>
@endforeach
                </tbody>
              </table>
            </div>

            <div class="row g-3 align-items-center mt-3">
              {{-- <div class="col-md-6">
                <form class="coupon d-flex gap-2">
                  <input class="form-control" placeholder="Coupon code (try AROMA10)">
                  <button class="btn btn-dark" type="submit">Apply Coupon</button>
                </form>
              </div> --}}
              <div class="col-md-6 text-md-end">
                <a href="{{ route('shop') }}" class="btn btn-outline-secondary">Continue Shopping</a>
              </div>
            </div>
            @else
            <p>Your cart is empty.</p>
            <a href="{{ route('shop') }}" class="btn btn-outline-primary">Go to Shop</a>
            @endif
          </div>
        </div>
      </div>

      <!-- Totals + Checkout Form -->
      <div class="col-lg-4">
        <div class="card box">
          <div class="card-body p-4">
            <h6 class="box-title">Cart Totals</h6>
   <ul class="list-unstyled totals mb-3">
  <li><span>Subtotal</span> <strong id="cart-subtotal">PKR {{ number_format($total) }}</strong></li>
  <li><span>Shipping</span> <span>PKR 0</span></li>
  <li class="total"><span>Total</span> <span id="cart-total">PKR {{ number_format($total) }}</span></li>
</ul>





       <form action="{{ route('checkout.process') }}" method="post">
    @csrf
    <input type="hidden" name="total" value="{{ $total }}">
<a href="{{ route('checkout') }}" class="btn btn-dark w-100">
    Proceed to Checkout
</a></form>
            <p class="small text-muted mt-2 mb-0">Taxes and shipping calculated at checkout.</p>
          </div>
        </div>
      </div>
      @if(count($cart) > 0)
    <!-- Show cart table and totals -->
@else
    <p>Your cart is empty.</p>
    <a href="{{ route('shop') }}" class="btn btn-outline-primary">Go to Shop</a>
@endif

    </div>
  </div>
</section>
<script>
function changeQty(slug, delta) {
  const input = document.getElementById('qty-' + slug);
  let qty = parseInt(input.value);
  qty = Math.max(1, qty + delta);
  input.value = qty;
  updateCart(slug);
}

function updateCart(slug) {
  const qty = parseInt(document.getElementById('qty-' + slug).value);
  fetch("{{ route('cart.update') }}", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": "{{ csrf_token() }}"
    },
    body: JSON.stringify({ slug: slug, quantity: qty })
  })
  .then(res => res.json())
.then(data => {
  document.getElementById('subtotal-' + slug).textContent = 'PKR ' + data.subtotal;
  document.getElementById('cart-subtotal').textContent = 'PKR ' + data.total;
  document.getElementById('cart-total').textContent = 'PKR ' + data.total;
});
}
</script>

@endsection


