@extends('layouts.app')

@section('content')

    <section class="hero-wrap hero-wrap-2" style="background-image: url('naxham/assets/images/bg_2.jpg');" data-stellar-background-ratio="0.6">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
          <div class="col-md-9 ftco-animate mb-5 text-center">
          	<p class="breadcrumbs mb-0"><span class="mr-2"><a href="{{ url('/') }}">Home <i class="fa fa-chevron-right"></i></a></span> <span>Products <i class="fa fa-chevron-right"></i></span></p>
            <h2 class="mb-0 bread">Products</h2>
          </div>
        </div>
      </div>
    </section>


<!-- Content -->
<section class="py-3">
  <div class="container ">
    <div class="row g-4">
      <!-- Cart table -->
      <div class="col-lg-8">
        <div class="card box ">
          <div class="card-body p-4 mt-4">
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
                  <!-- Row 1 -->
                  <tr data-cart-row data-price="19000">
                    <td>
                      <a href="#" class="remove-link" title="Remove" data-remove-row>
                        <i class="bi bi-x-lg"></i>
                      </a>
                    </td>
                    <td>
                      <div class="d-flex align-items-center gap-3">
                        <div class="cart-thumb">
                          <img src="naxham/assets/images/perfume1.jpg" alt="">
                        </div>
                        <div>
                          <a class="text-dark text-decoration-none" href="{{ url('product') }}">Paco Rabanne Pure XS</a>
                          <div class="small text-muted">100ml • EDP</div>
                        </div>
                      </div>
                    </td>
                    <td class="text-center">PKR 19,000</td>
                    <td class="text-center">
                      <div class="qty">
                        <button class="px-2" data-qty-btn="minus">−</button>
                        <input type="number" value="1" min="1">
                        <button class="px-2" data-qty-btn="plus">+</button>
                      </div>
                    </td>
                    <td class="text-end" data-sub>PKR 19,000</td>
                  </tr>

                  <!-- Row 2 -->
                  <tr data-cart-row data-price="44000">
                    <td>
                      <a href="#" class="remove-link" title="Remove" data-remove-row>
                        <i class="bi bi-x-lg"></i>
                      </a>
                    </td>
                    <td>
                      <div class="d-flex align-items-center gap-3">
                        <div class="cart-thumb">
                          <img src="naxham/assets/images/perfume2.jpg" alt="">
                        </div>
                        <div>
                          <a class="text-dark text-decoration-none" href="{{ url('product') }}">Chanel Coco Mademoiselle</a>
                          <div class="small text-muted">100ml • EDP</div>
                        </div>
                      </div>
                    </td>
                    <td class="text-center">PKR 44,000</td>
                    <td class="text-center">
                      <div class="qty">
                        <button class="px-2" data-qty-btn="minus">−</button>
                        <input type="number" value="1" min="1">
                        <button class="px-2" data-qty-btn="plus">+</button>
                      </div>
                    </td>
                    <td class="text-end" data-sub>PKR 44,000</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="row g-3 align-items-center mt-3">
              <div class="col-md-6">
                <form class="coupon d-flex gap-2" data-coupon-form>
                  <input class="form-control" placeholder="Coupon code (try AROMA10)">
                  <button class="btn btn-dark" type="submit">Apply Coupon</button>
                </form>
                <div data-coupon-msg></div>
              </div>
              <div class="col-md-6 text-md-end">
                <a href="{{ url('shop') }}" class="btn btn-outline-secondary">Continue Shopping</a>
                <button class="btn btn-outline-dark" type="button" onclick="recomputeTotals()">Update Cart</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Totals -->
      <div class="col-lg-4">
        <div class="card box">
          <div class="card-body p-4">
            <h6 class="box-title">Cart Totals</h6>
            <ul class="list-unstyled totals mb-3">
              <li><span>Subtotal</span> <strong data-subtotal>PKR 0</strong></li>
              <li><span>Shipping</span> <span data-shipping>PKR 0</span></li>
              <li class="total"><span>Total</span> <span data-total>PKR 0</span></li>
            </ul>
            <a href="{{ url('checkout') }}" class="btn btn-dark w-100">Proceed to Checkout</a>
            <p class="small text-muted mt-2 mb-0">Taxes and shipping calculated at checkout.</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
 @endsection
