@extends('layouts.app')
@section('content')
<div class="py-5">
    <div class="container">
        <!-- Page Header -->
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('menu') }}" class="btn btn-outline-secondary me-3">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <h2 class="fw-bold mb-0">Shopping Cart</h2>
                <p class="text-muted mb-0">{{ $cartItems->count() }} item(s) in your cart</p>
            </div>
        </div>
        @if($cartItems->count() > 0)
        <div class="row g-4">
            <!-- Cart Items -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0 py-3 ps-4">Product</th>
                                        <th class="border-0 py-3 text-center">Price</th>
                                        <th class="border-0 py-3 text-center">Quantity</th>
                                        <th class="border-0 py-3 text-center">Total</th>
                                        <th class="border-0 py-3 pe-4"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cartItems as $item)
                                    <tr>
                                        <td class="ps-4 py-3">
                                            <div class="d-flex align-items-center">
                                                @if($item->food->image)
                                                    <img src="{{ asset('storage/' . $item->food->image) }}" class="rounded" style="width: 60px; height: 60px; object-fit: cover;">
                                                @else
                                                    <img src="https://via.placeholder.com/60" class="rounded" style="width: 60px; height: 60px; object-fit: cover;">
                                                @endif
                                                <div class="ms-3">
                                                    <h6 class="mb-0 fw-semibold">{{ $item->food->name }}</h6>
                                                    <small class="text-muted">{{ $item->food->category }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center align-middle">
                                            ₱{{ number_format($item->food->price, 2) }}
                                        </td>
                                        <td class="text-center align-middle">
                                            <form action="{{ route('cart.update', $item) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <div class="input-group input-group-sm" style="width: 120px; margin: 0 auto;">
                                                    <button type="submit" name="quantity" value="{{ $item->quantity - 1 }}" class="btn btn-outline-secondary">-</button>
                                                    <input type="text" class="form-control text-center" value="{{ $item->quantity }}" readonly>
                                                    <button type="submit" name="quantity" value="{{ $item->quantity + 1 }}" class="btn btn-outline-secondary">+</button>
                                                </div>
                                            </form>
                                        </td>
                                        <td class="text-center align-middle">
                                            <span class="fw-bold text-danger">₱{{ number_format($item->subtotal, 2) }}</span>
                                        </td>
                                        <td class="pe-4 align-middle">
                                            <form action="{{ route('cart.remove', $item) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Cart Actions -->
                <div class="d-flex justify-content-between mt-3">
                    <a href="{{ route('menu') }}" class="btn btn-outline-danger">
                        <i class="bi bi-arrow-left"></i> Continue Shopping
                    </a>
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-secondary">
                            <i class="bi bi-trash"></i> Clear Cart
                        </button>
                    </form>
                </div>
            </div>
            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold mb-4">Order Summary</h5>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Subtotal</span>
                            <span class="fw-semibold">₱{{ number_format($subtotal, 2) }}</span>
                        </div>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Delivery Fee</span>
                            <span class="fw-semibold">₱{{ number_format($deliveryFee, 2) }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold fs-5">Total</span>
                            <span class="fw-bold fs-5 text-danger">₱{{ number_format($total, 2) }}</span>
                        </div>
                        <a href="{{ route('checkout') }}" class="btn btn-danger w-100 py-3 fw-semibold">
                            Proceed to Checkout
                        </a>
                        <div class="mt-4">
                            <p class="small text-muted mb-2">We Accept:</p>
                            <div class="d-flex gap-2">
                                <span class="badge bg-primary">💳 GCash</span>
                                <span class="badge bg-success">💵 Maya</span>
                                <span class="badge bg-warning text-dark">💰 COD</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <!-- Empty Cart -->
        <div class="text-center py-5">
            <i class="bi bi-cart-x fs-1 text-muted"></i>
            <h3 class="mt-3">Your Cart is Empty</h3>
            <p class="text-muted">Looks like you haven't added any items to your cart yet.</p>
            <a href="{{ route('menu') }}" class="btn btn-danger btn-lg mt-3">
                <i class="bi bi-arrow-left"></i> Browse Menu
            </a>
        </div>
        @endif
    </div>
</div>
@endsection