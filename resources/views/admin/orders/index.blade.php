@extends('layouts.admin')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Order Management</h2>
        <p class="text-muted mb-0">View and manage customer orders</p>
    </div>
</div>
<!-- Filters -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body py-3">
        <form action="{{ route('admin.orders.index') }}" method="GET">
            <div class="row g-3 align-items-center">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" class="form-control" placeholder="Search orders..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="all">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="preparing" {{ request('status') == 'preparing' ? 'selected' : '' }}>Preparing</option>
                        <option value="ready" {{ request('status') == 'ready' ? 'selected' : '' }}>Ready</option>
                        <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-danger">Filter</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Orders Table -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="border-0 py-3 ps-4">Order ID</th>
                        <th class="border-0 py-3">Customer</th>
                        <th class="border-0 py-3">Items</th>
                        <th class="border-0 py-3">Total</th>
                        <th class="border-0 py-3">Payment</th>
                        <th class="border-0 py-3">Status</th>
                        <th class="border-0 py-3">Date</th>
                        <th class="border-0 py-3 pe-4 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td class="ps-4 py-3">
                            <span class="fw-semibold">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span>
                        </td>
                        <td class="py-3">
                            <p class="mb-0 fw-semibold">{{ $order->customer_name }}</p>
                            <small class="text-muted">{{ $order->customer_phone }}</small>
                        </td>
                        <td class="py-3">
                            <span class="badge bg-secondary">{{ $order->items->count() }} items</span>
                        </td>
                        <td class="py-3">
                            <span class="fw-bold text-danger">₱{{ number_format($order->total_amount, 2) }}</span>
                        </td>
                        <td class="py-3">
                            <form action="{{ route('admin.orders.payment', $order) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="payment_status" class="form-select form-select-sm" style="width: 100px;" onchange="this.form.submit()">
                                    <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                                    <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
                                </select>
                            </form>
                        </td>
                        <td class="py-3">
                            <form action="{{ route('admin.orders.status', $order) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="order_status" class="form-select form-select-sm" style="width: 120px;" onchange="this.form.submit()">
                                    <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="confirmed" {{ $order->order_status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="preparing" {{ $order->order_status == 'preparing' ? 'selected' : '' }}>Preparing</option>
                                    <option value="ready" {{ $order->order_status == 'ready' ? 'selected' : '' }}>Ready</option>
                                    <option value="delivered" {{ $order->order_status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </form>
                        </td>
                        <td class="py-3">
                            <small class="text-muted">{{ $order->created_at->format('M d, Y') }}</small>
                        </td>
                        <td class="pe-4 py-3 text-end">
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <i class="bi bi-bag fs-1 text-muted"></i>
                            <p class="text-muted mt-3">No orders found</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Pagination -->
<div class="mt-4">
    {{ $orders->links() }}
</div>
@endsection
```