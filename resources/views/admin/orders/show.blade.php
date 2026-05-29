@extends('layouts.admin')
@section('content')
<div class="d-flex align-items-center mb-4">
    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary me-3">
        <i class="bi bi-arrow-left"></i>
    </a>
    <div>
        <h2 class="fw-bold mb-0">Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</h2>
        <p class="text-muted mb-0">Order details and management</p>
    </div>
</div>
<div class="row g-4">
    <div class="col-lg-8">
        <!-- Order Info -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h5 class="fw-bold mb-4">Customer Information</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <strong>Name:</strong> {{ $order->customer_name }}
                    </div>
                    <div class="col-md-6">
                        <strong>Phone:</strong> {{ $order->customer_phone }}
                    </div>
                    <div class="col-12">
                        <strong>Address:</strong> {{ $order->customer_address }}
                    </div>
                    <div class="col-md-6">
                        <strong>Payment Method:</strong> {{ strtoupper($order->payment_method) }}
                    </div>
                    <div class="col-md-6">
                        <strong>Order Date:</strong> {{ $order->created_at->format('M d, Y h:i A') }}
                    </div>
                </div>
            </div>
        </div>
        <!-- Order Items -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="fw-bold mb-4">Order Items</h5>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="bg-light">
                            <tr>
                                <th>Item</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Qty</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td>{{ $item->food_name }}</td>
                                <td class="text-center">₱{{ number_format($item->food_price, 2) }}</td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-end fw-bold">₱{{ number_format($item->subtotal, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end fw-bold">Total:</td>
                                <td class="text-end fw-bold text-danger fs-5">₱{{ number_format($order->total_amount, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <!-- Update Status -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h5 class="fw-bold mb-4">Update Status</h5>
                
                <form action="{{ route('admin.orders.status', $order) }}" method="POST" class="mb-3">
                    @csrf
                    @method('PATCH')
                    <label class="form-label fw-semibold">Order Status</label>
                    <select name="order_status" class="form-select" onchange="this.form.submit()">
                        <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $order->order_status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="preparing" {{ $order->order_status == 'preparing' ? 'selected' : '' }}>Preparing</option>
                        <option value="ready" {{ $order->order_status == 'ready' ? 'selected' : '' }}>Ready</option>
                        <option value="delivered" {{ $order->order_status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </form>
                <form action="{{ route('admin.orders.payment', $order) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <label class="form-label fw-semibold">Payment Status</label>
                    <select name="payment_status" class="form-select" onchange="this.form.submit()">
                        <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
                    </select>
                </form>
            </div>
        </div>
        <!-- Current Status -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="fw-bold mb-4">Current Status</h5>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span>Order Status:</span>
                    <span class="badge bg-{{ $order->status_badge }} px-3 py-2">{{ ucfirst($order->order_status) }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span>Payment Status:</span>
                    <span class="badge {{ $order->payment_status == 'paid' ? 'bg-success' : 'bg-warning text-dark' }} px-3 py-2">
                        {{ ucfirst($order->payment_status) }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection