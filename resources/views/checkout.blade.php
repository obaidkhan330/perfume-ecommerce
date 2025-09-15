@extends('layouts.app')

@section('content')


<section class="py-5">
  <div class="container">
    <div class="row g-4">
      <!-- Billing + Shipping + Order Summary -->
      <div class="col-lg-7">
        <div class="card box mb-4 mt-4">
          <div class="card-body p-4">
            <h6 class="box-title">Billing Details</h6>

            <!-- ✅ Single Form Start -->
            <form action="{{ route('checkout.process') }}" method="POST">
              @csrf
              <input type="hidden" name="total" value="{{ $total }}">

              <!-- Billing -->
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">First name</label>
                  <input type="text" name="first_name" class="form-control" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Last name</label>
                  <input type="text" name="last_name" class="form-control" required>
                </div>
                <div class="col-12">
                  <label class="form-label">Address</label>
                  <input type="text" name="address" class="form-control" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">City</label>
                  <input type="text" name="city" class="form-control" required>
                </div>
                <div class="col-md-3">
                  <label class="form-label">Postal</label>
                  <input type="text" name="postal" class="form-control" required>
                </div>
                <div class="col-md-3">
                  <label class="form-label">Phone</label>
                  <input type="text" name="phone" class="form-control" required>
                </div>
                <div class="col-12">
                  <label class="form-label">Email</label>
                  <input type="email" name="email" class="form-control" required>
                </div>
                <div class="col-12">
                  <label class="form-label">Order notes (optional)</label>
                  <textarea class="form-control" name="notes" rows="3"></textarea>
                </div>
              </div>

              <!-- Shipping -->
              <div class="card box mt-4">
                <div class="card-body p-4">
                  <h6 class="box-title">Shipping</h6>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="shipDiff" name="ship_different">
                    <label class="form-check-label" for="shipDiff">Ship to a different address?</label>
                  </div>
                  <div id="shipForm" class="row g-3 mt-2 d-none">
                    <div class="col-md-6">
                      <label class="form-label">First name</label>
                      <input type="text" name="shipping_first_name" class="form-control">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Last name</label>
                      <input type="text" name="shipping_last_name" class="form-control">
                    </div>
                    <div class="col-12">
                      <label class="form-label">Address</label>
                      <input type="text" name="shipping_address" class="form-control">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">City</label>
                      <input type="text" name="shipping_city" class="form-control">
                    </div>
                    <div class="col-md-3">
                      <label class="form-label">Postal</label>
                      <input type="text" name="shipping_postal" class="form-control">
                    </div>
                    <div class="col-md-3">
                      <label class="form-label">Phone</label>
                      <input type="text" name="shipping_phone" class="form-control">
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>

      <!-- Order summary -->
      <div class="col-lg-5">
        <div class="card box mb-4 mt-4">
          <div class="card-body p-4">
            <h6 class="box-title">Your Order</h6>

            @php
              $total = 0;
              $shipping = 0; // static shipping charge
            @endphp

            <ul class="list-group mb-3">
              @if(session('cart') && count(session('cart')) > 0)
                @foreach(session('cart') as $slug => $item)
                  @php
                    $subtotal = $item['price'] * $item['quantity'];
                    $total += $subtotal;
                  @endphp
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                      <a href="{{ url('product/' . $slug) }}" class="fw-bold text-dark text-decoration-none">
                        {{ $item['name'] }}
                      </a>
                      <small class="d-block text-muted">x{{ $item['quantity'] }}</small>
                    </div>
                    <span>PKR {{ number_format($subtotal) }}</span>
                  </li>
                @endforeach

                <li class="list-group-item d-flex justify-content-between align-items-center">
                  Subtotal
                  <span>PKR {{ number_format($total) }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  Shipping
                  <span>PKR {{ number_format($shipping) }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <strong>Total</strong>
                  <strong>PKR {{ number_format($total + $shipping) }}</strong>
                </li>
              @else
                <li class="list-group-item">Your cart is empty.</li>
              @endif
            </ul>

            <!-- Payment -->
            <h6 class="box-title">Payment</h6>
            <div class="form-check mb-2">
              <input class="form-check-input" type="radio" name="payment_method" value="cod" checked>
              <label class="form-check-label">Cash on Delivery</label>
            </div>
            <div class="form-check mb-2">
              <input class="form-check-input" type="radio" name="payment_method" value="card">
              <label class="form-check-label">Credit / Debit Card</label>
            </div>
            <div class="form-check mb-3">
              <input class="form-check-input" type="radio" name="payment_method" value="bank">
              <label class="form-check-label">Bank Transfer</label>
            </div>

            <!-- ✅ Single Button -->
            @if(Auth::check())
              <button type="submit" class="btn btn-success w-100">Place Order</button>
            @else
              <a href="{{ route('login') }}" class="btn btn-dark w-100">Login to Place Order</a>
            @endif

            <p class="small text-muted mt-2 mb-0">By placing your order, you agree to our terms.</p>
          </div>
        </div>

        <div class="card box">
          <div class="card-body p-4">
            <h6 class="box-title">Have a coupon?</h6>
            <form class="coupon d-flex gap-2" data-coupon-form>
              <input class="form-control" placeholder="Enter coupon">
              <button class="btn btn-outline-dark" type="submit">Apply</button>
            </form>
            <div data-coupon-msg></div>
          </div>
        </div>
      </div>
      <!-- ✅ Close Form -->
      </form>
    </div>
  </div>
</section>

<script>
  // toggle shipping form
  document.getElementById('shipDiff').addEventListener('change', function() {
    document.getElementById('shipForm').classList.toggle('d-none', !this.checked);
  });
</script>
<script>
  document.getElementById('shipDiff')?.addEventListener('change', e=>{
    document.getElementById('shipForm')?.classList.toggle('d-none', !e.target.checked);
  });
</script>

<script>
document.getElementById('loginPromptBtn')?.addEventListener('click', function() {
    alert('Please login to place your order.');
    window.location.href = "{{ route('login') }}";
});
</script>
@endsection
