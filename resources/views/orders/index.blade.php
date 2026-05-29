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
                            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                <p class="fs-4 fw-bold text-danger mb-2">
                                    ₱{{ number_format($order->total_amount, 2) }}
                                </p>
                                <!-- Action Buttons -->
                                <div class="d-flex justify-content-md-end gap-2">
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-outline-danger btn-sm px-3">
                                        <i class="bi bi-eye-fill me-1"></i> View Details
                                    </a>
                                    <a href="{{ route('orders.receipt', $order->id) }}" target="_blank" class="btn btn-outline-success btn-sm px-3">
                                        <i class="bi bi-printer-fill me-1"></i> Print Receipt
                                    </a>
                                </div>
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