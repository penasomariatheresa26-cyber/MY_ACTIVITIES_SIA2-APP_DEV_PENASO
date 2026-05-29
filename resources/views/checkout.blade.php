@extends('layouts.app')
@section('content')
<div class="py-5 bg-light min-vh-100">
    <div class="container">
        <!-- Page Header -->
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('cart') }}" class="btn btn-outline-secondary me-3">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <h2 class="fw-bold mb-0">Checkout</h2>
                <p class="text-muted mb-0">Complete your order</p>
            </div>
        </div>
        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <div class="row g-4">
                <!-- Checkout Form -->
                <div class="col-lg-8">
                    <!-- Delivery Information -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">📍 Delivery Information</h5>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Full Name *</label>
                                    <input type="text" name="customer_name" class="form-control @error('customer_name') is-invalid @enderror" 
                                           value="{{ old('customer_name', $user->name) }}" required>
                                    @error('customer_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Phone Number *</label>
                                    <input type="tel" name="customer_phone" class="form-control @error('customer_phone') is-invalid @enderror" 
                                           value="{{ old('customer_phone', $user->phone) }}" required>
                                    @error('customer_phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Delivery Address *</label>
                                    <textarea name="customer_address" class="form-control @error('customer_address') is-invalid @enderror" 
                                              rows="3" required placeholder="House/Unit No., Street, Barangay, City">{{ old('customer_address', $user->address) }}</textarea>
                                    @error('customer_address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Order Notes (Optional)</label>
                                    <textarea name="notes" class="form-control" rows="2" 
                                              placeholder="Special instructions for delivery...">{{ old('notes') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Payment Method -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">💳 Payment Method</h5>
                            
                            <div class="row g-3">
                                <!-- GCash -->
                                <div class="col-12">
                                    <div class="form-check card p-3">
                                        <input class="form-check-input" type="radio" name="payment_method" id="gcash" value="gcash" 
                                               {{ old('payment_method', 'gcash') == 'gcash' ? 'checked' : '' }}>
                                        <label class="form-check-label d-flex align-items-center" for="gcash">
                                            <span class="fs-3 me-3">💳</span>
                                            <div>
                                                <h6 class="mb-0 text-primary fw-bold">GCash</h6>
                                                <small class="text-muted">Pay via GCash e-wallet</small>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <!-- Maya -->
                                <div class="col-12">
                                    <div class="form-check card p-3">
                                        <input class="form-check-input" type="radio" name="payment_method" id="maya" value="maya"
                                               {{ old('payment_method') == 'maya' ? 'checked' : '' }}>
                                        <label class="form-check-label d-flex align-items-center" for="maya">
                                            <span class="fs-3 me-3">💵</span>
                                            <div>
                                                <h6 class="mb-0 text-success fw-bold">Maya</h6>
                                                <small class="text-muted">Pay via Maya e-wallet</small>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <!-- COD -->
                                <div class="col-12">
                                    <div class="form-check card p-3">
                                        <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod"
                                               {{ old('payment_method') == 'cod' ? 'checked' : '' }}>
                                        <label class="form-check-label d-flex align-items-center" for="cod">
                                            <span class="fs-3 me-3">💰</span>
                                            <div>
                                                <h6 class="mb-0 text-warning fw-bold">Cash on Delivery</h6>
                                                <small class="text-muted">Pay when you receive your order</small>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Order Summary -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm sticky-top" style="top: 100px;">
                        <div class="card-body">
                            <h5 class="fw-bold mb-4">Order Summary</h5>
                            
                            @foreach($cartItems as $item)
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">{{ $item->food->name }} x{{ $item->quantity }}</span>
                                <span>₱{{ number_format($item->subtotal, 2) }}</span>
                            </div>
                            @endforeach
                            <hr>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Subtotal</span>
                                <span>₱{{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Delivery Fee</span>
                                <span>₱{{ number_format($deliveryFee, 2) }}</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-4">
                                <span class="fw-bold fs-5">Total</span>
                                <span class="fw-bold fs-5 text-danger">₱{{ number_format($total, 2) }}</span>
                            </div>
                            <button type="submit" class="btn btn-danger w-100 py-3 fw-semibold">
                                Place Order - ₱{{ number_format($total, 2) }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection