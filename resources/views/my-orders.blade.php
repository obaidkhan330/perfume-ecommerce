@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">My Orders</h2>

    @if($orders->count() > 0)
        @foreach($orders as $order)
        <div class="card mb-4 shadow-sm" id="order-{{ $order->id }}">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><strong>Order </strong> - {{ $order->created_at->format('d M, Y h:i A') }}</span>
                <span class="badge bg-dark">Total: PKR {{ number_format($order->total, 0) }}</span>
            </div>
            <div class="card-body">
                <!-- Items -->
                <h6 class="fw-bold mb-2">Items</h6>
                <ul class="list-group mb-3">
                    @foreach($order->items as $item)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{ $item->product_name }} (x{{ $item->quantity }})</span>
                            <span>PKR {{ number_format($item->price * $item->quantity, 0) }}</span>
                        </li>
                    @endforeach
                </ul>

                <!-- Address -->
                <h6 class="fw-bold mb-2">Shipping Details</h6>
                <p class="mb-1">
                    {{ $order->address }}, {{ $order->city }}, {{ $order->postal }} <br>
                    <strong>Phone:</strong> {{ $order->phone }}
                </p>
                @if($order->shipping_address)
                    <p class="text-muted small">
                        <strong>Ship To:</strong> {{ $order->shipping_address }}, {{ $order->shipping_city }}, {{ $order->shipping_postal }}
                    </p>
                @endif

                <h6 class="fw-bold mb-2">Payment Method</h6>
                <p>{{ ucfirst($order->payment_method) }}</p>

                <!-- Order Tracking -->
                <h6 class="fw-bold mb-2">Order Status</h6>
                <div class="progress mb-3" style="height: 25px;">
                    <div class="progress-bar status-bar"
                        data-order-id="{{ $order->id }}"
                        role="progressbar"
                        style="width:
                            @if($order->status == 'pending') 25%
                            @elseif($order->status == 'processing') 50%
                            @elseif($order->status == 'shipped') 75%
                            @elseif($order->status == 'delivered') 100%
                            @endif;
                            @if($order->status == 'pending') background-color: #6c757d;
                            @elseif($order->status == 'processing') background-color: #0dcaf0;
                            @elseif($order->status == 'shipped') background-color: #ffc107;
                            @elseif($order->status == 'delivered') background-color: #198754;
                            @endif">
                        {{ ucfirst($order->status ?? 'Pending') }}
                    </div>
                </div>

                <div class="d-flex justify-content-between small text-muted">
                    <span>Pending</span>
                    <span>Processing</span>
                    <span>Shipped</span>
                    <span>Delivered</span>
                </div>
            </div>
        </div>
        @endforeach
    @else
        <div class="alert alert-info text-center">
            <i class="bi bi-box-seam"></i> You have not placed any orders yet.
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){

    function fetchOrderStatuses(){
        $('.status-bar').each(function(){
            var orderId = $(this).data('order-id');
            var bar = $(this);

            $.ajax({
                url: '/user/order-status/' + orderId,
                method: 'GET',
                success: function(response){
                    // Update width and color based on status
                    var status = response.status;
                    var width = '25%';
                    var color = '#6c757d'; // default pending

                    if(status == 'processing'){ width='50%'; color='#0dcaf0'; }
                    else if(status == 'shipped'){ width='75%'; color='#ffc107'; }
                    else if(status == 'delivered'){ width='100%'; color='#198754'; }

                    bar.css('width', width);
                    bar.css('background-color', color);
                    bar.text(status.charAt(0).toUpperCase() + status.slice(1));
                }
            });
        });
    }

    // Check every 5 seconds
    setInterval(fetchOrderStatuses, 5000);
});
</script>
@endsection
