@extends('layouts.app')

@section('content')

<section class="hero-wrap hero-wrap-2" style="background-image: url('naxham/assets/images/perfume4.jpg');" data-stellar-background-ratio="0.2">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
          <div class="col-md-9 ftco-animate mb-7 text-center">
          	{{-- <p class="breadcrumbs mb-0"><span class="mr-2"><a href="{{ url('/') }}">Home <i class="fa fa-chevron-right"></i></a></span> <span>Products <i class="fa fa-chevron-right"></i></span></p> --}}
            {{-- <h2 class="mb-0 bread">Products</h2> --}}
          </div>
        </div>
      </div>
    </section>


  <!-- Main content -->
  <section class="py-5">
    <div class="container">
      <div class="row g-4">
        <!-- Sidebar -->
        <aside class="col-lg-3">
          <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
              <h5 class="card-title h6 text-uppercase">Categories</h5>
              <ul class="list-unstyled small mb-0 shop-cats">
                <li><a href="#">Women (24)</a></li>
                <li><a href="#">Men (18)</a></li>
                <li><a href="#">Unisex (12)</a></li>
                <li><a href="#">Gift Sets (9)</a></li>
                <li><a href="#">Attar / Oils (7)</a></li>
              </ul>
            </div>
          </div>

          <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
              <h5 class="card-title h6 text-uppercase">Filter by Price</h5>
              <input type="range" class="form-range" min="1000" max="50000" value="15000" id="priceRange">
              <div class="d-flex justify-content-between small">
                <span>PKR 1,000</span>
                <span id="priceValue">PKR 15,000</span>
              </div>
              <button class="btn btn-dark btn-sm w-100 mt-3">Apply</button>
            </div>
          </div>

          <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
              <h5 class="card-title h6 text-uppercase">Brands</h5>
              <div class="small d-flex flex-column gap-2">
                <label class="form-check">
                  <input class="form-check-input" type="checkbox"> <span class="form-check-label">Dior</span>
                </label>
                <label class="form-check">
                  <input class="form-check-input" type="checkbox"> <span class="form-check-label">Chanel</span>
                </label>
                <label class="form-check">
                  <input class="form-check-input" type="checkbox"> <span class="form-check-label">Lancome</span>
                </label>
                <label class="form-check">
                  <input class="form-check-input" type="checkbox"> <span class="form-check-label">Versace</span>
                </label>
                <label class="form-check">
                  <input class="form-check-input" type="checkbox"> <span class="form-check-label">Paco Rabanne</span>
                </label>
              </div>
              <button class="btn btn-outline-dark btn-sm w-100 mt-3">Filter</button>
            </div>
          </div>

          <!-- Top rated products -->
          <div class="card border-0 shadow-sm">
            <div class="card-body">
              <h5 class="card-title h6 text-uppercase">Top Rated Products</h5>

              <div class="mini-product d-flex gap-3">
                <a href="{{ url('product') }}" class="mini-thumb flex-shrink-0">
                  <img src="{{ asset('naxham/assets/images/perfume1.jpg') }}" alt="Top 1" class="rounded">
                </a>
                <div class="flex-grow-1">
                  <a href="{{ url('product') }}" class="mini-title">Christian Dior Sauvage EDP</a>
                  <div class="stars text-warning small">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-half"></i>
                  </div>
                  <div class="price small">PKR 27,000</div>
                </div>
              </div>

              <div class="mini-product d-flex gap-3">
                <a href="{{ url('product') }}" class="mini-thumb flex-shrink-0">
                  <img src="{{ asset('naxham/assets/images/perfume2.jpg') }}" alt="Top 2" class="rounded">
                </a>
                <div class="flex-grow-1">
                  <a href="{{ url('product') }}" class="mini-title">La Vie Est Belle</a>
                  <div class="stars text-warning small">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    <i class="bi bi-star"></i>
                  </div>
                  <div class="price small">PKR 39,000</div>
                </div>
              </div>

              <div class="mini-product d-flex gap-3">
                <a href="{{ url('product') }}" class="mini-thumb flex-shrink-0">
                  <img src="{{ asset('naxham/assets/images/perfume3.jpg') }}" alt="Top 3" class="rounded">
                </a>
                <div class="flex-grow-1">
                  <a href="{{ url('product') }}" class="mini-title">Police To Be Rebel</a>
                  <div class="stars text-warning small">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i><i class="bi bi-star"></i>
                    <i class="bi bi-star"></i>
                  </div>
                  <div class="price small">PKR 49,000</div>
                </div>
              </div>

            </div>
          </div>
        </aside>

        <!-- Products -->
        <main class="col-lg-9">
          <!-- Toolbar -->
          <div class="d-flex flex-wrap align-items-center justify-content-between mb-3 gap-2">
            <div class="small text-muted">Showing <strong>1–12</strong> of <strong>48</strong> results</div>
            <div class="d-flex align-items-center gap-2">
              <select class="form-select form-select-sm" aria-label="Sort">
                <option selected>Sort by: Default</option>
                <option value="1">Popularity</option>
                <option value="2">Latest</option>
                <option value="3">Price: Low to High</option>
                <option value="4">Price: High to Low</option>
              </select>
              <div class="btn-group" role="group" aria-label="View">
                <button class="btn btn-outline-dark btn-sm active"><i class="bi bi-grid"></i></button>
                <button class="btn btn-outline-dark btn-sm"><i class="bi bi-view-stacked"></i></button>
              </div>
            </div>
          </div>

          <!-- Grid -->
          <div class="row g-4">
            <!-- product card -->
           <div class="row">
    @foreach($products as $product)
        <div class="col-6 col-md-4">
            <div class="product-card card border-0 shadow-sm h-100">
                <div class="position-relative">
                    <a href="{{ route('product.show', $product->id) }}" class="ratio ratio-1x1 d-block">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="card-img-top object-fit-cover rounded-top">
                    </a>
                    <div class="product-actions">
                        <a href="{{ route('product.show', $product->id) }}" class="btn btn-sm btn-light"><i class="bi bi-eye"></i> Quick View</a>
                        <a href="#" class="btn btn-sm btn-dark"><i class="bi bi-bag"></i> Add to Cart</a>
                        <a href="#" class="btn btn-sm btn-light"><i class="bi bi-heart"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <a href="{{ route('product.show', $product->id) }}" class="text-decoration-none text-dark d-block mb-1">{{ $product->name }}</a>
                    <div class="d-flex align-items-center gap-2">
                        <div class="stars text-warning small">
                            @for($i = 0; $i < 5; $i++)
                                <i class="bi bi-star-fill"></i>
                            @endfor
                        </div>
                        <small class="text-muted">(31)</small>
                    </div>
                    <div class="price mt-2">
                        <span class="fw-bold">PKR {{ number_format($product->discount_price ?? $product->real_price) }}</span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

            <!-- Duplicate products (change images/titles as you like) -->
            <div class="col-6 col-md-4">
              <div class="product-card card border-0 shadow-sm h-100">
                <div class="position-relative">
                  <span class="badge text-bg-dark position-absolute m-2">New</span>
                  <a href="{{ url('product') }}" class="ratio ratio-1x1 d-block">
                    <img src="{{ asset('naxham/assets/images/perfume5.jpg') }}" alt="Perfume" class="card-img-top object-fit-cover rounded-top">
                  </a>
                  <div class="product-actions">
                    <a href="{{ url('product') }}" class="btn btn-sm btn-light"><i class="bi bi-eye"></i> Quick View</a>
                    <a href="{{ url('cart') }}" class="btn btn-sm btn-dark"><i class="bi bi-bag"></i> Add to Cart</a>
                    <a href="#" class="btn btn-sm btn-light"><i class="bi bi-heart"></i></a>
                  </div>
                </div>
                <div class="card-body">
                  <a href="{{ url('product') }}" class="text-decoration-none text-dark d-block mb-1">Skinn Escapade Mediterranean</a>
                  <div class="d-flex align-items-center gap-2">
                    <div class="stars text-warning small">
                      <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i>
                      <i class="bi bi-star"></i>
                    </div>
                    <small class="text-muted">(13)</small>
                  </div>
                  <div class="price mt-2">
                    <span class="fw-bold">PKR 20,000</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-6 col-md-4">
              <div class="product-card card border-0 shadow-sm h-100">
                <div class="position-relative">
                  <a href="{{ url('product') }}" class="ratio ratio-1x1 d-block">
                    <img src="{{ asset('naxham/assets/images/perfume6.jpg') }}" alt="Perfume" class="card-img-top object-fit-cover rounded-top">
                  </a>
                  <div class="product-actions">
                    <a href="{{ url('product') }}" class="btn btn-sm btn-light"><i class="bi bi-eye"></i> Quick View</a>
                    <a href="{{ url('cart') }}" class="btn btn-sm btn-dark"><i class="bi bi-bag"></i> Add to Cart</a>
                    <a href="#" class="btn btn-sm btn-light"><i class="bi bi-heart"></i></a>
                  </div>
                </div>
                <div class="card-body">
                  <a href="{{ url('product') }}" class="text-decoration-none text-dark d-block mb-1">Lancôme La Vie Est Belle</a>
                  <div class="d-flex align-items-center gap-2">
                    <div class="stars text-warning small">
                      <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i>
                    </div>
                    <small class="text-muted">(31)</small>
                  </div>
                  <div class="price mt-2">
                    <span class="fw-bold">PKR 39,000</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Add 9 more cards for 12 items (copy/paste & tweak) -->
            <!-- For brevity, add a few more quickly -->
            <div class="col-6 col-md-4">
              <div class="product-card card border-0 shadow-sm h-100">
                <div class="position-relative">
                  <a href="{{ url('product') }}" class="ratio ratio-1x1 d-block">
                    <img src="{{ asset('naxham/assets/images/perfume7.jpg') }}" alt="Perfume" class="card-img-top object-fit-cover rounded-top">
                  </a>
                  <div class="product-actions">
                    <a href="{{ url('product') }}" class="btn btn-sm btn-light"><i class="bi bi-eye"></i> Quick View</a>
                    <a href="{{ url('cart') }}" class="btn btn-sm btn-dark"><i class="bi bi-bag"></i> Add to Cart</a>
                    <a href="#" class="btn btn-sm btn-light"><i class="bi bi-heart"></i></a>
                  </div>
                </div>
                <div class="card-body">
                  <a href="{{ url('product') }}" class="text-decoration-none text-dark d-block mb-1">Versace Eros Flame</a>
                  <div class="d-flex align-items-center gap-2">
                    <div class="stars text-warning small">
                      <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i><i class="bi bi-star"></i>
                      <i class="bi bi-star"></i>
                    </div>
                    <small class="text-muted">(9)</small>
                  </div>
                  <div class="price mt-2">
                    <span class="fw-bold">PKR 28,000</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-6 col-md-4">
              <div class="product-card card border-0 shadow-sm h-100">
                <div class="position-relative">
                  <span class="badge text-bg-warning position-absolute m-2">Hot</span>
                  <a href="{{ url('product') }}" class="ratio ratio-1x1 d-block">
                    <img src="{{ asset('naxham/assets/images/perfume6.jpg') }}" alt="Perfume" class="card-img-top object-fit-cover rounded-top">
                  </a>
                  <div class="product-actions">
                    <a href="{{ url('product') }}" class="btn btn-sm btn-light"><i class="bi bi-eye"></i> Quick View</a>
                    <a href="{{ url('cart') }}" class="btn btn-sm btn-dark"><i class="bi bi-bag"></i> Add to Cart</a>
                    <a href="#" class="btn btn-sm btn-light"><i class="bi bi-heart"></i></a>
                  </div>
                </div>
                <div class="card-body">
                  <a href="{{ url('product') }}" class="text-decoration-none text-dark d-block mb-1">Chanel Coco Mademoiselle</a>
                  <div class="d-flex align-items-center gap-2">
                    <div class="stars text-warning small">
                      <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-half"></i>
                    </div>
                    <small class="text-muted">(18)</small>
                  </div>
                  <div class="price mt-2">
                    <span class="fw-bold">PKR 44,000</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-6 col-md-4">
              <div class="product-card card border-0 shadow-sm h-100">
                <div class="position-relative">
                  <a href="{{ url('product') }}" class="ratio ratio-1x1 d-block">
                    <img src="{{ asset('naxham/assets/images/perfume1.jpg') }}" alt="Perfume" class="card-img-top object-fit-cover rounded-top">
                  </a>
                  <div class="product-actions">
                    <a href="{{ url('product') }}" class="btn btn-sm btn-light"><i class="bi bi-eye"></i> Quick View</a>
                    <a href="{{ url('cart') }}" class="btn btn-sm btn-dark"><i class="bi bi-bag"></i> Add to Cart</a>
                    <a href="#" class="btn btn-sm btn-light"><i class="bi bi-heart"></i></a>
                  </div>
                </div>
                <div class="card-body">
                  <a href="{{ url('product') }}" class="text-decoration-none text-dark d-block mb-1">Mugler Alien</a>
                  <div class="d-flex align-items-center gap-2">
                    <div class="stars text-warning small">
                      <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                      <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                      <i class="bi bi-star"></i>
                    </div>
                    <small class="text-muted">(21)</small>
                  </div>
                  <div class="price mt-2">
                    <span class="fw-bold">PKR 56,999</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- ...add more cards as needed ... -->

          </div>

          <!-- Promo banner -->
          <div class="mt-5">
            <div class="ratio ratio-21x9 rounded-3 overflow-hidden shadow-sm">
              <img src="{{ asset('naxham/assets/images/banner.jpg') }}" class="w-100 h-100 object-fit-cover" alt="Mid-season sale">
            </div>
          </div>

          <!-- Pagination -->
          <nav class="mt-4" aria-label="Page navigation">
            <ul class="pagination justify-content-center">
              <li class="page-item disabled"><a class="page-link">Prev</a></li>
              <li class="page-item active"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
          </nav>
        </main>
      </div>
    </div>
  </section>
@endsection
