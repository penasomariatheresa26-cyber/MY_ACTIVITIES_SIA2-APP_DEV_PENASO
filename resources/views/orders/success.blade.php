@extends('layouts.app')
@section('content')
<div class="min-vh-100 py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Success Message -->
                <div class="text-center mb-5">
                    <div class="bg-success rounded-circle d-inline-flex align-items-center justify-content-center mb-4" 
                         style="width: 100px; height: 100px;">
                        <i class="bi bi-check-lg text-white fs-1"></i>
                    </div>
                    <h1 class="fw-bold text-success mb-2">Order Placed Successfully!</h1>
                    <p class="text-muted fs-5">Thank you for your order. We're preparing your delicious food!</p>
                </div>
                <!-- Order Details -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h5 class="fw-bold mb-1">Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</h5>
                                <small class="text-muted">Placed on {{ $order->created_at->format('M d, Y h:i A') }}</small>
                            </div>
                            <span class="badge bg-{{ $order->status_badge }} px-3 py-2">
                                {{ ucfirst($order->order_status) }}
                            </span>
                        </div>
                        <!-- Delivery Info -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-geo-alt text-danger me-2 mt-1"></i>
                                    <div>
                                        <small class="text-muted d-block">Delivery Address</small>
                                        <span class="fw-semibold">{{ $order->customer_address }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-phone text-danger me-2 mt-1"></i>
                                    <div>
                                        <small class="text-muted d-block">Contact Number</small>
                                        <span class="fw-semibold">{{ $order->customer_phone }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-clock text-danger me-2 mt-1"></i>
                                    <div>
                                        <small class="text-muted d-block">Estimated Delivery</small>
                                        <span class="fw-semibold">30-45 minutes</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <span class="me-2">💳</span>
                                    <div>
                                        <small class="text-muted d-block">Payment Method</small>
                                        <span class="fw-semibold">
                                            {{ strtoupper($order->payment_method) }}
                                            <span class="badge {{ $order->payment_status == 'paid' ? 'bg-success' : 'bg-warning text-dark' }} ms-2">
                                                {{ ucfirst($order->payment_status) }}
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!-- Order Items -->
                        <h6 class="fw-bold mb-3">Order Items</h6>
                        @foreach($order->items as $item)
                        <div class="d-flex align-items-center mb-3">
                            <div class="ms-3 flex-grow-1">
                                <h6 class="mb-0">{{ $item->food_name }}</h6>
                                <small class="text-muted">₱{{ number_format($item->food_price, 2) }} x {{ $item->quantity }}</small>
                            </div>
                            <span class="fw-bold">₱{{ number_format($item->subtotal, 2) }}</span>
                        </div>
                        @endforeach
                        <hr>
                        <!-- Total -->
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fs-5 fw-bold">Total Amount</span>
                            <span class="fs-4 fw-bold text-danger">₱{{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>
                </div>
                <!-- Action Buttons -->
                <div class="text-center">
                    <a href="{{ route('orders') }}" class="btn btn-danger me-3">
                        <i class="bi bi-bag"></i> View All Orders
                    </a>
                    <a href="{{ route('menu') }}" class="btn btn-outline-danger">
                        Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
```
4. **Save the file**
---
## Step 13.3: Create Orders List Page
1. Inside `resources/views/orders/` folder
2. Create a new file called: `index.blade.php`
3. **Paste** this code:
```html
@extends('layouts.app')
@section('content')
<div class="py-5">
    <div class="container">
        <!-- Page Header -->
        <div class="mb-4">
            <h2 class="fw-bold">My Orders</h2>
            <p class="text-muted">Track and manage your orders</p>
        </div>
        @if($orders->count() > 0)
        <div class="row g-4">
            @foreach($orders as $order)
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <div class="d-flex align-items-start mb-3 mb-md-0">
                                    <div class="bg-danger-subtle rounded p-3 me-3">
                                        <i class="bi bi-bag text-danger fs-4"></i>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold mb-1">
                                            Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                                        </h5>
                                        <p class="text-muted small mb-2">
                                            Placed on {{ $order->created_at->format('M d, Y h:i A') }}
                                        </p>
                                        <div class="d-flex flex-wrap gap-2 mb-2">
                                            <span class="badge bg-{{ $order->status_badge }}">
                                                {{ ucfirst($order->order_status) }}
                                            </span>
                                            <span class="badge {{ $order->payment_status == 'paid' ? 'bg-success' : 'bg-warning text-dark' }}">
                                                {{ $order->payment_status == 'paid' ? '✓ Paid' : 'Payment Pending' }}
                                            </span>
                                        </div>
                                        <small class="text-muted">
                                            {{ $order->items->count() }} item(s) • {{ strtoupper($order->payment_method) }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-md-end">
                                <p class="fs-4 fw-bold text-danger mb-2">
                                    ₱{{ number_format($order->total_amount, 2) }}
                                </p>
                                <a href="{{ route('orders.show', $order) }}" class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-eye"></i> View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <!-- No Orders -->
        <div class="text-center py-5">
            <i class="bi bi-bag-x fs-1 text-muted"></i>
            <h3 class="mt-3">No Orders Yet</h3>
            <p class="text-muted">You haven't placed any orders yet. Start ordering delicious food!</p>
            <a href="{{ route('menu') }}" class="btn btn-danger btn-lg mt-3">
                <i class="bi bi-bag"></i> Browse Menu
            </a>
        </div>
        @endif
    </div>
</div>
@endsection