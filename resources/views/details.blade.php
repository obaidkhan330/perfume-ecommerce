@extends('layouts.app')

@section('content')




<div class="container py-5">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('naxham/assets/images/product1.jpg') }}" alt="Mahir Perfume" class="img-fluid rounded">
        </div>
        <div class="col-md-6">
            <h2 class="fw-bold">Dioran 100ML</h2>
            <p class="fs-4 text-danger">Rs. 2950 <del class="text-muted">Rs. 5,000</del></p>




            <h5 class="mt-4">You might also like these</h5>
            <div class="d-flex gap-3 flex-wrap">
             <div class="card text-center p-2 shadow-sm" style="width: 130px;">
    <img src="{{ asset('naxham/assets/images/perfume3.jpg') }}" class="card-img-top mb-2" alt="Mystara" style="height: 130px; object-fit: cover;">
                        <div class="card-body p-1">
        <small class="fw-bold">Mystara</small>
        <p class="mb-1" style="font-size: 0.85rem;">Size: 100ml</p>
        <p class="text-danger fw-semibold mb-1" style="font-size: 0.9rem;">Rs. 1,199</p>
        <p class="text-muted" style="font-size: 0.75rem;">Unisex | Long-lasting</p>
        <button class="btn btn-sm btn-dark w-100 mt-1">Add</button>
                      </div>
            </div>
                    <div class="card text-center p-2 shadow-sm" style="width: 130px;">
    <img src="{{ asset('naxham/assets/images/perfume3.jpg') }}" class="card-img-top mb-2" alt="Mystara" style="height: 130px; object-fit: cover;">
    <div class="card-body p-1">
        <small class="fw-bold">Mystara</small>
        <p class="mb-1" style="font-size: 0.85rem;">Size: 100ml</p>
        <p class="text-danger fw-semibold mb-1" style="font-size: 0.9rem;">Rs. 1,199</p>
        <p class="text-muted" style="font-size: 0.75rem;">Unisex | Long-lasting</p>
        <button class="btn btn-sm btn-dark w-100 mt-1">Add</button>
              </div>
               </div>


             <div class="card text-center p-2 shadow-sm" style="width: 130px;">
           <img src="{{ asset('naxham/assets/images/perfume3.jpg') }}" class="card-img-top mb-2" alt="Mystara" style="height: 130px; object-fit: cover;">
           <div class="card-body p-1">
               <small class="fw-bold">Mystara</small>
               <p class="mb-1" style="font-size: 0.85rem;">Size: 100ml</p>
               <p class="text-danger fw-semibold mb-1" style="font-size: 0.9rem;">Rs. 1,199</p>
               <p class="text-muted" style="font-size: 0.75rem;">Unisex | Long-lasting</p>
               <button class="btn btn-sm btn-dark w-100 mt-1">Add</button>
           </div>
              </div>

            </div>

            <div class="mt-4">
                <strong>Size:</strong> 100ml
            </div>




            <div class="mt-3 d-flex align-items-center">
                <label for="quantity" class="me-2">Qty:</label>
                <div class="input-group" style="width: 120px;">
                    <button class="btn btn-outline-secondary" type="button" onclick="decreaseQty()">−</button>
                    <input type="number" id="quantity" class="form-control text-center" value="1" min="1">
                    <button class="btn btn-outline-secondary" type="button" onclick="increaseQty()">+</button>
                </div>
            </div>



            <div class="mt-4 d-flex gap-3">
                <button class="btn btn-primary">Add to Cart</button>
                <button class="btn btn-outline-dark">Buy Now</button>
            </div>
        </div>
    </div>
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
                    <li><strong>Top Note:</strong> Black Pepper, Pink Pepper, Saffron</li>
                    <li><strong>Middle Note:</strong> Cade Oil, Labdanum, Gurjan Balsam, Rhubarb</li>
                    <li><strong>Base Note:</strong> Leather, Cedar, Guaiac Wood, Patchouli, Moss</li>
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
        <div class="card p-2 shadow-sm product-card">
            <div class="hover-icons">
                <a href="#"><i class="fas fa-search"></i></a>
                <a href="#"><i class="fas fa-plus"></i></a>
            </div>

            <img src="{{ asset('naxham/assets/images/perfume1.jpg') }}" class="card-img-top mb-2" alt="Perfume 1" style="height: 180px; object-fit: cover;">
            <div class="card-body p-2 text-center">
                <small class="fw-bold" style="font-size: 1rem;">Fynora 100ml</small>
                <p class="mb-1" style="font-size: 0.9rem;">Inspired by Mahir</p>
                <p class="mb-1 text-danger fw-semibold" style="font-size: 1rem;">Rs. 1,399 <span class="text-muted text-decoration-line-through">Rs. 4,500</span></p>
                <p class="text-danger fw-bold" style="font-size: 0.85rem;">Save 69%</p>
            </div>
        </div>






                <div class="card p-2 shadow-sm product-card">
            <div class="hover-icons">
                <a href="#"><i class="fas fa-search"></i></a>
                <a href="#"><i class="fas fa-plus"></i></a>
            </div>

            <img src="{{ asset('naxham/assets/images/perfume1.jpg') }}" class="card-img-top mb-2" alt="Perfume 1" style="height: 180px; object-fit: cover;">
            <div class="card-body p-2 text-center">
                <small class="fw-bold" style="font-size: 1rem;">florenza 100ml</small>
                <p class="mb-1" style="font-size: 0.9rem;">Inspired by Mahir</p>
                <p class="mb-1 text-danger fw-semibold" style="font-size: 1rem;">Rs. 1,399 <span class="text-muted text-decoration-line-through">Rs. 4,500</span></p>
                <p class="text-danger fw-bold" style="font-size: 0.85rem;">Save 69%</p>
            </div>
        </div>





                <div class="card p-2 shadow-sm product-card">
            <div class="hover-icons">
                <a href="#"><i class="fas fa-search"></i></a>
                <a href="#"><i class="fas fa-plus"></i></a>
            </div>

            <img src="{{ asset('naxham/assets/images/perfume1.jpg') }}" class="card-img-top mb-2" alt="Perfume 1" style="height: 180px; object-fit: cover;">
            <div class="card-body p-2 text-center">
                <small class="fw-bold" style="font-size: 1rem;">Dioran 100ml</small>
                <p class="mb-1" style="font-size: 0.9rem;">Inspired by Mahir</p>
                <p class="mb-1 text-danger fw-semibold" style="font-size: 1rem;">Rs. 1,399 <span class="text-muted text-decoration-line-through">Rs. 4,500</span></p>
                <p class="text-danger fw-bold" style="font-size: 0.85rem;">Save 69%</p>
            </div>
        </div>






                <div class="card p-2 shadow-sm product-card">
            <div class="hover-icons">
                <a href="#"><i class="fas fa-search"></i></a>
                <a href="#"><i class="fas fa-plus"></i></a>
            </div>

            <img src="{{ asset('naxham/assets/images/perfume1.jpg') }}" class="card-img-top mb-2" alt="Perfume 1" style="height: 180px; object-fit: cover;">
            <div class="card-body p-2 text-center">
                <small class="fw-bold" style="font-size: 1rem;">Fynora 100ml</small>
                <p class="mb-1" style="font-size: 0.9rem;">Inspired by Mahir</p>
                <p class="mb-1 text-danger fw-semibold" style="font-size: 1rem;">Rs. 1,399 <span class="text-muted text-decoration-line-through">Rs. 4,500</span></p>
                <p class="text-danger fw-bold" style="font-size: 0.85rem;">Save 69%</p>
            </div>
        </div>

    </div>
</div>

    </div>
</div>




 {{-- top perfume  --}}


<div class="container my-5">
    <h3 class="fw-bold mb-4">TOP PERFUMES</h3>
    <div class="d-flex flex-wrap gap-4 justify-content-start">

        {{-- Product Card --}}
        <div class="card p-2 shadow-sm product-card">
            <div class="hover-icons">
                <a href="#"><i class="fas fa-search"></i></a>
                <a href="#"><i class="fas fa-plus"></i></a>
            </div>

            <img src="{{ asset('naxham/assets/images/perfume1.jpg') }}" class="card-img-top mb-2" alt="Perfume 1" style="height: 180px; object-fit: cover;">
            <div class="card-body p-2 text-center">
                <small class="fw-bold" style="font-size: 1rem;">Fynora 100ml</small>
                <p class="mb-1" style="font-size: 0.9rem;">Inspired by Mahir</p>
                <p class="mb-1 text-danger fw-semibold" style="font-size: 1rem;">Rs. 1,399 <span class="text-muted text-decoration-line-through">Rs. 4,500</span></p>
                <p class="text-danger fw-bold" style="font-size: 0.85rem;">Save 69%</p>
            </div>
        </div>




                <div class="card p-2 shadow-sm product-card">
            <div class="hover-icons">
                <a href="#"><i class="fas fa-search"></i></a>
                <a href="#"><i class="fas fa-plus"></i></a>
            </div>

            <img src="{{ asset('naxham/assets/images/perfume1.jpg') }}" class="card-img-top mb-2" alt="Perfume 1" style="height: 180px; object-fit: cover;">
            <div class="card-body p-2 text-center">
                <small class="fw-bold" style="font-size: 1rem;">Fynora 100ml</small>
                <p class="mb-1" style="font-size: 0.9rem;">Inspired by Mahir</p>
                <p class="mb-1 text-danger fw-semibold" style="font-size: 1rem;">Rs. 1,399 <span class="text-muted text-decoration-line-through">Rs. 4,500</span></p>
                <p class="text-danger fw-bold" style="font-size: 0.85rem;">Save 69%</p>
            </div>
        </div>





                <div class="card p-2 shadow-sm product-card">

            <div class="hover-icons">
                <a href="#"><i class="fas fa-search"></i></a>
                <a href="#"><i class="fas fa-plus"></i></a>
            </div>

            <img src="{{ asset('naxham/assets/images/perfume1.jpg') }}" class="card-img-top mb-2" alt="Perfume 1" style="height: 180px; object-fit: cover;">
            <div class="card-body p-2 text-center">
                <small class="fw-bold" style="font-size: 1rem;">Fynora 100ml</small>
                <p class="mb-1" style="font-size: 0.9rem;">Inspired by Mahir</p>
                <p class="mb-1 text-danger fw-semibold" style="font-size: 1rem;">Rs. 1,399 <span class="text-muted text-decoration-line-through">Rs. 4,500</span></p>
                <p class="text-danger fw-bold" style="font-size: 0.85rem;">Save 69%</p>
            </div>
        </div>





                <div class="card p-2 shadow-sm product-card">

            <div class="hover-icons">
                <a href="#"><i class="fas fa-search"></i></a>
                <a href="#"><i class="fas fa-plus"></i></a>
            </div>

            <img src="{{ asset('naxham/assets/images/perfume1.jpg') }}" class="card-img-top mb-2" alt="Perfume 1" style="height: 180px; object-fit: cover;">
            <div class="card-body p-2 text-center">
                <small class="fw-bold" style="font-size: 1rem;">Fynora 100ml</small>
                <p class="mb-1" style="font-size: 0.9rem;">Inspired by Mahir</p>
                <p class="mb-1 text-danger fw-semibold" style="font-size: 1rem;">Rs. 1,399 <span class="text-muted text-decoration-line-through">Rs. 4,500</span></p>
                <p class="text-danger fw-bold" style="font-size: 0.85rem;">Save 69%</p>
            </div>
        </div>



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
    function decreaseQty() {
        let qty = document.getElementById('quantity');
        if (qty.value > 1) qty.value--;
    }
    function increaseQty() {
        let qty = document.getElementById('quantity');
        qty.value++;
    }
</script>


@endsection
