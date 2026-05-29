public function updatePayment($order)
{
    $order = \App\Models\Order::findOrFail($order);

    $order->payment_status = 'paid';

    $order->save();

    return back()->with('success', 'Payment status updated successfully.');
}

@foreach($orders as $order)
    <div>
        <h3>Order #{{ $order->id }}</h3>
        <p>User: {{ $order->user->name }}</p>
        <p>Status: {{ $order->status }}</p>
        <p>Total: ₱{{ $order->total_price }}</p>

        <ul>
            @foreach($order->items as $item)
                <li>
                    {{ $item->food->name }} x {{ $item->quantity }}
                </li>
            @endforeach
        </ul>
    </div>
@endforeach