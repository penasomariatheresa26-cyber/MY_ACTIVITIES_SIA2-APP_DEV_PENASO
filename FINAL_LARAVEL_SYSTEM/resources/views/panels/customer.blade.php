<x-app-layout>
    <x-slot name="header">
        <h2 class="bloomery-header-title">
            Bloomery Customer Shop
        </h2>
    </x-slot>

    <style>
        .bloomery-page {
            min-height: 100vh;
            background: linear-gradient(180deg, #fff1f7 0%, #ffffff 45%, #fff1f7 100%);
            padding: 28px 20px 60px;
        }

        .bloomery-container {
            max-width: 1220px;
            margin: 0 auto;
        }

        .bloomery-header-title {
            font-size: 22px;
            font-weight: 800;
            color: #be185d;
            margin: 0;
        }

        .bloomery-hero {
            background: linear-gradient(135deg, #db2777, #fb7185);
            color: white;
            border-radius: 28px;
            padding: 34px;
            box-shadow: 0 18px 45px rgba(219, 39, 119, .22);
            margin-bottom: 26px;
            overflow: hidden;
            position: relative;
        }

        .bloomery-hero::after {
            content: "";
            position: absolute;
            right: -80px;
            top: -90px;
            width: 260px;
            height: 260px;
            border-radius: 999px;
            background: rgba(255,255,255,.18);
        }

        .bloomery-hero-small {
            font-size: 13px;
            letter-spacing: .18em;
            text-transform: uppercase;
            color: #ffe4ef;
            margin: 0 0 8px;
            font-weight: 800;
        }

        .bloomery-hero h1 {
            margin: 0;
            font-size: clamp(30px, 5vw, 56px);
            line-height: 1;
            font-weight: 900;
        }

        .bloomery-hero p {
            max-width: 680px;
            margin: 14px 0 0;
            color: #ffe4ef;
            font-size: 16px;
            line-height: 1.7;
        }

        .bloomery-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 380px;
            gap: 24px;
            align-items: start;
        }

        .section-heading {
            display: flex;
            justify-content: space-between;
            align-items: end;
            margin: 0 0 16px;
        }

        .section-heading h3 {
            margin: 0;
            color: #111827;
            font-size: 26px;
            font-weight: 900;
        }

        .section-heading p {
            margin: 5px 0 0;
            color: #6b7280;
            font-size: 14px;
        }

        .flower-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .flower-card {
            background: white;
            border: 1px solid #fbcfe8;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(17, 24, 39, .06);
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .flower-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 38px rgba(219, 39, 119, .13);
        }

        .flower-image-wrap {
            height: 210px;
            width: 100%;
            background: #fce7f3;
            overflow: hidden;
        }

        .flower-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .flower-body {
            padding: 18px;
        }

        .flower-name {
            margin: 0;
            color: #be185d;
            font-size: 18px;
            font-weight: 900;
        }

        .flower-description {
            min-height: 48px;
            margin: 8px 0 0;
            color: #4b5563;
            font-size: 14px;
            line-height: 1.55;
        }

        .flower-price {
            margin: 14px 0 0;
            color: #db2777;
            font-size: 24px;
            font-weight: 900;
        }

        .add-form {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .qty-input {
            width: 74px;
            border: 1px solid #f9a8d4;
            border-radius: 12px;
            padding: 10px 12px;
            font-size: 14px;
            outline: none;
        }

        .qty-input:focus {
            border-color: #db2777;
            box-shadow: 0 0 0 3px rgba(219, 39, 119, .12);
        }

        .btn {
            border: 0;
            border-radius: 12px;
            padding: 10px 14px;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            transition: background .2s ease, transform .2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-pink {
            background: #db2777;
            color: white;
            flex: 1;
        }

        .btn-pink:hover {
            background: #be185d;
        }

        .btn-amber {
            background: #f59e0b;
            color: white;
        }

        .btn-red {
            background: #ef4444;
            color: white;
        }

        .cart-panel {
            position: sticky;
            top: 22px;
            background: white;
            border: 1px solid #fbcfe8;
            border-radius: 26px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(17, 24, 39, .07);
        }

        .cart-title {
            margin: 0;
            color: #be185d;
            font-size: 22px;
            font-weight: 900;
        }

        .cart-count {
            margin: 4px 0 0;
            color: #6b7280;
            font-size: 13px;
        }

        .empty-cart {
            margin-top: 18px;
            background: #fdf2f8;
            border-radius: 18px;
            padding: 20px;
            text-align: center;
            color: #6b7280;
            font-size: 14px;
        }

        .cart-items {
            margin-top: 18px;
            display: grid;
            gap: 14px;
        }

        .cart-item {
            border: 1px solid #fbcfe8;
            border-radius: 18px;
            padding: 12px;
        }

        .cart-item-top {
            display: flex;
            gap: 12px;
        }

        .cart-image {
            width: 70px;
            height: 70px;
            border-radius: 14px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .cart-item-name {
            margin: 0;
            font-size: 14px;
            font-weight: 900;
            color: #111827;
        }

        .cart-item-price {
            margin: 4px 0 0;
            color: #6b7280;
            font-size: 12px;
        }

        .cart-item-total {
            margin: 5px 0 0;
            color: #db2777;
            font-weight: 900;
            font-size: 15px;
        }

        .cart-actions {
            display: flex;
            justify-content: space-between;
            gap: 8px;
            margin-top: 12px;
        }

        .cart-actions form {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .summary {
            border-top: 1px solid #fbcfe8;
            margin-top: 18px;
            padding-top: 16px;
            display: grid;
            gap: 9px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            color: #4b5563;
            font-size: 14px;
        }

        .summary-total {
            color: #be185d;
            font-size: 18px;
            font-weight: 900;
        }

        .checkout-form {
            margin-top: 18px;
            display: grid;
            gap: 11px;
        }

        .select-input {
            width: 100%;
            border: 1px solid #f9a8d4;
            border-radius: 12px;
            padding: 11px 12px;
            outline: none;
            font-size: 14px;
        }

        .alert {
            border-radius: 14px;
            padding: 12px 15px;
            margin-bottom: 16px;
            font-size: 14px;
            font-weight: 700;
        }

        .alert-success {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #047857;
        }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
        }

        .orders-panel {
            margin-top: 28px;
            background: white;
            border: 1px solid #fbcfe8;
            border-radius: 26px;
            padding: 22px;
            box-shadow: 0 10px 30px rgba(17, 24, 39, .06);
        }

        .orders-title {
            margin: 0;
            color: #be185d;
            font-size: 22px;
            font-weight: 900;
        }

        .order-card {
            margin-top: 12px;
            border: 1px solid #fbcfe8;
            border-radius: 18px;
            padding: 14px;
            display: flex;
            justify-content: space-between;
            gap: 16px;
        }

        .order-number {
            margin: 0;
            font-weight: 900;
            color: #111827;
        }

        .order-meta {
            margin: 4px 0 0;
            color: #6b7280;
            font-size: 13px;
        }

        .order-total {
            margin: 0;
            color: #db2777;
            font-size: 18px;
            font-weight: 900;
            text-align: right;
        }

        .order-status {
            margin: 4px 0 0;
            color: #d97706;
            font-size: 13px;
            font-weight: 800;
            text-align: right;
        }

        @media (max-width: 1100px) {
            .bloomery-layout {
                grid-template-columns: 1fr;
            }

            .cart-panel {
                position: static;
            }
        }

        @media (max-width: 760px) {
            .flower-grid {
                grid-template-columns: 1fr;
            }

            .bloomery-page {
                padding: 18px 12px 40px;
            }

            .bloomery-hero {
                padding: 24px;
                border-radius: 22px;
            }

            .flower-image-wrap {
                height: 190px;
            }

            .cart-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .cart-actions form {
                width: 100%;
            }

            .cart-actions .btn,
            .cart-actions .qty-input {
                width: 100%;
            }
        }
    </style>

    <div class="bloomery-page">
        <div class="bloomery-container">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <section class="bloomery-hero">
                <p class="bloomery-hero-small">Bloomery Flower Shop</p>
                <h1>Fresh flowers for every moment.</h1>
                <p>
                    Welcome, {{ auth()->user()->name }}. Choose your favorite bouquets, add them to cart, update quantities, and place your order using GCash, Cash, or Cash on Delivery.
                </p>
            </section>

            <div class="bloomery-layout">
                <main>
                    <div class="section-heading">
                        <div>
                            <h3>Flower Collection</h3>
                            <p>Beautiful flowers with prices in Philippine Peso.</p>
                        </div>
                    </div>

                    <div class="flower-grid">
                        @foreach ($products as $product)
                            <article class="flower-card">
                                <div class="flower-image-wrap">
                                    <img
                                        src="{{ $product['image'] }}"
                                        alt="{{ $product['name'] }}"
                                        class="flower-image"
                                    >
                                </div>

                                <div class="flower-body">
                                    <h4 class="flower-name">
                                        {{ $product['name'] }}
                                    </h4>

                                    <p class="flower-description">
                                        {{ $product['description'] }}
                                    </p>

                                    <p class="flower-price">
                                        ₱{{ number_format($product['price'], 2) }}
                                    </p>

                                    <form method="POST" action="{{ route('customer.cart.add') }}" class="add-form">
                                        @csrf

                                        <input type="hidden" name="product_id" value="{{ $product['id'] }}">

                                        <input
                                            type="number"
                                            name="qty"
                                            min="1"
                                            value="1"
                                            class="qty-input"
                                        >

                                        <button type="submit" class="btn btn-pink">
                                            Add to Cart
                                        </button>
                                    </form>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </main>

                <aside class="cart-panel">
                    <h3 class="cart-title">Your Cart</h3>
                    <p class="cart-count">{{ count($cart) }} item(s) selected</p>

                    @if (count($cart) === 0)
                        <div class="empty-cart">
                            Your cart is empty. Add flowers from the collection.
                        </div>
                    @else
                        <div class="cart-items">
                            @foreach ($cart as $item)
                                <div class="cart-item">
                                    <div class="cart-item-top">
                                        <img
                                            src="{{ $item['image'] }}"
                                            alt="{{ $item['name'] }}"
                                            class="cart-image"
                                        >

                                        <div>
                                            <p class="cart-item-name">{{ $item['name'] }}</p>
                                            <p class="cart-item-price">₱{{ number_format($item['price'], 2) }} each</p>
                                            <p class="cart-item-total">₱{{ number_format($item['price'] * $item['qty'], 2) }}</p>
                                        </div>
                                    </div>

                                    <div class="cart-actions">
                                        <form method="POST" action="{{ route('customer.cart.update', $item['id']) }}">
                                            @csrf
                                            @method('PATCH')

                                            <input
                                                type="number"
                                                name="qty"
                                                min="1"
                                                value="{{ $item['qty'] }}"
                                                class="qty-input"
                                            >

                                            <button type="submit" class="btn btn-amber">
                                                Edit
                                            </button>
                                        </form>

                                        <form method="POST" action="{{ route('customer.cart.remove', $item['id']) }}">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-red">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="summary">
                            <div class="summary-row">
                                <span>Subtotal</span>
                                <span>₱{{ number_format($subtotal, 2) }}</span>
                            </div>

                            <div class="summary-row">
                                <span>Delivery Fee</span>
                                <span>₱{{ number_format($deliveryFee, 2) }}</span>
                            </div>

                            <div class="summary-row summary-total">
                                <span>Total</span>
                                <span>₱{{ number_format($total, 2) }}</span>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('customer.checkout') }}" class="checkout-form">
                            @csrf

                            <label for="payment_method">Payment Method</label>

                            <select id="payment_method" name="payment_method" class="select-input" required>
                                <option value="gcash">GCash</option>
                                <option value="cod">Cash on Delivery</option>
                                <option value="cash">Cash</option>
                            </select>

                            <button type="submit" class="btn btn-pink">
                                Place Order
                            </button>
                        </form>
                    @endif
                </aside>
            </div>

            <section class="orders-panel">
                <h3 class="orders-title">Order History</h3>

                @if (count($orders) === 0)
                    <p class="cart-count">No orders yet.</p>
                @else
                    @foreach ($orders as $order)
                        <div class="order-card">
                            <div>
                                <p class="order-number">{{ $order['order_no'] }}</p>
                                <p class="order-meta">{{ $order['created_at'] }}</p>
                                <p class="order-meta">Payment: {{ $order['payment_method'] }}</p>
                            </div>

                            <div>
                                <p class="order-total">₱{{ number_format($order['total'], 2) }}</p>
                                <p class="order-status">{{ $order['status'] }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </section>

        </div>
    </div>
</x-app-layout>