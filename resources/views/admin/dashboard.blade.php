@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Admin Dashboard</h2>
        <p class="text-muted mb-0">Welcome back! Here's what's happening with your store.</p>
    </div>
    <a href="{{ route('admin.foods.create') }}" class="btn btn-danger">
        <i class="bi bi-plus"></i> Add New Food
    </a>
</div>

<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted small mb-1">Total Revenue</p>
                        <h3 class="fw-bold mb-0">₱{{ number_format($totalRevenue, 2) }}</h3>
                        <small class="text-success">+12.5%</small>
                    </div>
                    <div class="bg-success-subtle rounded-circle p-3">
                        <i class="bi bi-currency-dollar text-success fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted small mb-1">Total Orders</p>
                        <h3 class="fw-bold mb-0">{{ $totalOrders }}</h3>
                        <small class="text-primary">+8.2%</small>
                    </div>
                    <div class="bg-primary-subtle rounded-circle p-3">
                        <i class="bi bi-bag text-primary fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted small mb-1">Menu Items</p>
                        <h3 class="fw-bold mb-0">{{ $totalFoods }}</h3>
                        <small class="text-warning">{{ $categories->count() }} categories</small>
                    </div>
                    <div class="bg-warning-subtle rounded-circle p-3">
                        <i class="bi bi-grid text-warning fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p class="text-muted small mb-1">Pending Orders</p>
                        <h3 class="fw-bold mb-0">{{ $pendingOrders }}</h3>
                        <small class="text-danger">Needs attention</small>
                    </div>
                    <div class="bg-danger-subtle rounded-circle p-3">
                        <i class="bi bi-clock text-danger fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Recent Orders -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">Recent Orders</h5>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-danger">View All</a>
            </div>
            <div class="card-body p-0">
                @if($recentOrders->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0 py-3">Order ID</th>
                                <th class="border-0 py-3">Customer</th>
                                <th class="border-0 py-3">Amount</th>
                                <th class="border-0 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentOrders as $order)
                            <tr>
                                <td class="py-3">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</td>
                                <td class="py-3">{{ $order->customer_name }}</td>
                                <td class="py-3 fw-bold text-danger">₱{{ number_format($order->total_amount, 2) }}</td>
                                <td class="py-3">
                                    <span class="badge bg-{{ $order->status_badge }}">{{ $order->order_status }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-5">
                    <i class="bi bi-bag fs-1 text-muted"></i>
                    <p class="text-muted mt-3">No orders yet</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold">Order Statistics</h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span><i class="bi bi-clock text-warning me-2"></i>Pending</span>
                    <span class="badge bg-warning text-dark">{{ $pendingOrders }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span><i class="bi bi-check-circle text-success me-2"></i>Completed</span>
                    <span class="badge bg-success">{{ $completedOrders }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-x-circle text-danger me-2"></i>Cancelled</span>
                    <span class="badge bg-danger">{{ $cancelledOrders }}</span>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold">Quick Actions</h5>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.foods.create') }}" class="btn btn-outline-danger w-100 mb-2">
                    <i class="bi bi-plus"></i> Add New Food
                </a>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-primary w-100 mb-2">
                    <i class="bi bi-bag"></i> View Orders
                </a>
                <a href="{{ route('home') }}" class="btn btn-outline-success w-100">
                    <i class="bi bi-shop"></i> View Store
                </a>
            </div>
        </div>
    </div>
</div>
@endsection