<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Receipt - Order #{{ $order->id }}</title>
    <!-- Include Bootstrap CSS to keep your styles intact -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none; }
            body { padding: 0; background: #fff; }
        }
    </style>
</head>
<body class="bg-light py-5" onload="window.print();">

<div class="container bg-white p-5 shadow-sm style="max-width: 600px;">
    <div class="text-center mb-4">
        <h2 class="fw-bold">Your Restaurant Name</h2>
        <p class="text-muted">Order Receipt</p>
    </div>
    
    <hr>
    
    <p><strong>Order #:</strong> {{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
    <p><strong>Date:</strong> {{ $order->created_at->format('M d, Y h:i A') }}</p>
    
    <hr>
    
    <table class="table table-borderless">
        <thead>
            <tr class="border-bottom">
                <th>Item</th>
                <th class="text-end">Qty</th>
                <th class="text-end">Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->food->name ?? 'Delicious Item' }}</td>
                <td class="text-end">{{ $item->quantity }}</td>
                <td class="text-end">₱{{ number_format($item->price * $item->quantity, 2) }}</td>
            </tr>
            @endforeach
            <tr class="border-top fw-bold fs-5">
                <td>Total</td>
                <td></td>
                <td class="text-end text-danger">₱{{ number_format($order->total_amount, 2) }}</td>
            </tr>
        </tbody>
    </table>
    
    <div class="text-center mt-5 no-print">
        <button onclick="window.print()" class="btn btn-danger btn-sm">Print Again</button>
        <button onclick="window.close()" class="btn btn-secondary btn-sm">Close Window</button>
    </div>
</div>

</body>
</html>