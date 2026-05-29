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
@extends('layouts.app')

@block('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Order #{{ $order->id }}</h1>
            <p class="text-sm text-gray-500">Placed on {{ $order->created_at->format('M d, Y h:i A') }}</p>
        </div>
        <div class="space-x-2">
            <a href="{{ route('orders') }}" class="px-4 py-2 border rounded-md text-gray-700 hover:bg-gray-50">Back to Orders</a>
            <a href="{{ route('orders.receipt', $order->id) }}" target="_blank" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Print Receipt</a>
        </div>
    </div>

    <!-- Status Overview Card -->
    <div class="bg-white border rounded-lg p-6 mb-6 shadow-sm">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <span class="text-xs text-gray-400 block uppercase font-bold tracking-wider">Order Status</span>
                <span class="inline-block mt-1 px-3 py-1 rounded-full text-xs font-semibold bg-{{ $order->status_badge }}-100 text-{{ $order->status_badge }}-800 uppercase">
                    {{ $order->order_status }}
                </span>
            </div>
            <div>
                <span class="text-xs text-gray-400 block uppercase font-bold tracking-wider">Payment Method</span>
                <span class="text-gray-900 font-medium block mt-1 uppercase">{{ $order->payment_method }}</span>
            </div>
            <div>
                <span class="text-xs text-gray-400 block uppercase font-bold tracking-wider">Payment Status</span>
                <span class="text-gray-900 font-medium block mt-1 uppercase">{{ $order->payment_status }}</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Left: Items Summary -->
        <div class="md:col-span-2 bg-white border rounded-lg overflow-hidden shadow-sm">
            <div class="p-4 border-b bg-gray-50 font-semibold text-gray-700">Items Ordered</div>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b bg-gray-100 text-xs font-semibold text-gray-600 uppercase">
                        <th class="p-3">Item</th>
                        <th class="p-3 text-center">Qty</th>
                        <th class="p-3 text-right">Price</th>
                        <th class="p-3 text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y text-sm text-gray-700">
                    @foreach($order->items as $item)
                    <tr>
                        <td class="p-3 font-medium">{{ $item->food_name }}</td>
                        <td class="p-3 text-center">{{ $item->quantity }}</td>
                        <td class="p-3 text-right">₱{{ number_format($item->food_price, 2) }}</td>
                        <td class="p-3 text-right font-semibold">₱{{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-4 bg-gray-50 border-t space-y-2 text-sm text-gray-600">
                <div class="flex justify-between">
                    <span>Delivery Fee:</span>
                    <span>₱50.00</span>
                </div>
                <div class="flex justify-between text-base font-bold text-gray-900 pt-2 border-t">
                    <span>Total Amount:</span>
                    <span>₱{{ number_format($order->total_amount, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Right: Shipping Info -->
        <div class="bg-white border rounded-lg p-4 shadow-sm h-fit">
            <h3 class="font-semibold text-gray-700 mb-3 border-b pb-2">Delivery Details</h3>
            <div class="space-y-3 text-sm text-gray-600">
                <p><strong class="text-gray-800">Customer:</strong> <br>{{ $order->customer_name }}</p>
                <p><strong class="text-gray-800">Phone:</strong> <br>{{ $order->customer_phone }}</p>
                <p><strong class="text-gray-800">Address:</strong> <br>{{ $order->customer_address }}</p>
                @if($order->notes)
                    <p class="bg-yellow-50 p-2 border border-yellow-100 rounded text-xs text-yellow-800">
                        <strong>Notes:</strong> {{ $order->notes }}
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>
@endblock