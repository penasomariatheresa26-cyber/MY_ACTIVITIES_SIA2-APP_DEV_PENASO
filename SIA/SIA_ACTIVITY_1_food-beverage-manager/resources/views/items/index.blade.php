@extends('layouts.app')

@section('title', 'All Items')

@section('content')
    <h2>Theresse Food & Beverages</h2>

    <!-- Tabs -->
    <div style="margin-bottom: 20px;">
        @foreach($categories as $cat)
            <a href="{{ url('/items?category='.$cat) }}"
               style="margin-right:10px;
                      padding:5px 12px;
                      border-radius:5px;
                      background-color: {{ $cat === $category ? '#2d862d' : '#b2d8b2' }};
                      color: #fff;
                      text-decoration:none;">
               {{ $cat }}
            </a>
        @endforeach
    </div>

    <!-- Items -->
    @forelse($items as $item)
        <div class="item-card">
            <h3><a href="{{ url('/items/'.$item['id']) }}">{{ $item['name'] }}</a></h3>
            <p>{{ $item['description'] }}</p>
            <p><strong>Category:</strong> {{ $item['category'] }}</p>
            <p><strong>Price:</strong> ₱{{ $item['price'] }}</p>
        </div>
    @empty
        <p>No items found in this category.</p>
    @endforelse
@endsection