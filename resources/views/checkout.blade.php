@extends('layouts.app')

@section('content')


<section class="py-5">
  <div class="container">
    <div class="row g-4">
      <!-- Billing -->
      <div class="col-lg-7">
        <div class="card box mb-4 mt-4 ">
          <div class="card-body p-4">
            <h6 class="box-title">Billing Details</h6>
            <form class="row g-3">
              <div class="col-md-6">
                <label class="form-label">First name</label>
                <input class="form-control" placeholder="Ahsan">
              </div>
              <div class="col-md-6">
                <label class="form-label">Last name</label>
                <input class="form-control" placeholder="Khan">
              </div>
              <div class="col-12">
                <label class="form-label">Address</label>
                <input class="form-control" placeholder="Street address">
              </div>
              <div class="col-md-6">
                <label class="form-label">City</label>
                <input class="form-control" placeholder="Karachi">
              </div>
              <div class="col-md-3">
                <label class="form-label">Postal</label>
                <input class="form-control" placeholder="74000">
              </div>
              <div class="col-md-3">
                <label class="form-label">Phone</label>
                <input class="form-control" placeholder="+92 3xx xxxxxxx">
              </div>
              <div class="col-12">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" placeholder="you@email.com">
              </div>
              <div class="col-12">
                <label class="form-label">Order notes (optional)</label>
                <textarea class="form-control" rows="3" placeholder="Notes about your order"></textarea>
              </div>
            </form>
          </div>
        </div>

        <!-- Shipping (optional separate) -->
        <div class="card box">
          <div class="card-body p-4">
            <h6 class="box-title">Shipping</h6>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="shipDiff">
              <label class="form-check-label" for="shipDiff">Ship to a different address?</label>
            </div>
            <div id="shipForm" class="row g-3 mt-2 d-none">
              <div class="col-md-6"><label class="form-label">First name</label><input class="form-control"></div>
              <div class="col-md-6"><label class="form-label">Last name</label><input class="form-control"></div>
              <div class="col-12"><label class="form-label">Address</label><input class="form-control"></div>
              <div class="col-md-6"><label class="form-label">City</label><input class="form-control"></div>
              <div class="col-md-3"><label class="form-label">Postal</label><input class="form-control"></div>
              <div class="col-md-3"><label class="form-label">Phone</label><input class="form-control"></div>
            </div>
          </div>
        </div>
      </div>

      <!-- Order summary -->
      <div class="col-lg-5">
        <div class="card box mb-4 mt-4">
          <div class="card-body p-4">
            <h6 class="box-title">Your Order</h6>
            <ul class="list-group mb-3">
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Paco Rabanne Pure XS <span>PKR 19,000</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Chanel Coco Mademoiselle <span>PKR 44,000</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Subtotal <span>PKR 63,000</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Shipping <span>PKR 250</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <strong>Total</strong> <strong>PKR 63,250</strong>
              </li>
            </ul>

            <h6 class="box-title">Payment</h6>
            <div class="form-check mb-2">
              <input class="form-check-input" type="radio" name="pay" id="cod" checked>
              <label class="form-check-label" for="cod">Cash on Delivery</label>
            </div>
            <div class="form-check mb-2">
              <input class="form-check-input" type="radio" name="pay" id="card">
              <label class="form-check-label" for="card">Credit / Debit Card</label>
            </div>
            <div class="form-check mb-3">
              <input class="form-check-input" type="radio" name="pay" id="bank">
              <label class="form-check-label" for="bank">Bank Transfer</label>
            </div>

            @if(Auth::check())
            <button class="btn btn-dark w-100" id="orderBtn">Place Order</button>
            @else
            <button class="btn btn-dark w-100" id="loginPromptBtn">Place Order</button>
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

    </div>
  </div>
</section>
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
