@extends('layouts.app')

@section('content')
<section class="bg-danger text-white text-center py-5 mb-5">
    <div class="container">
        <h1 class="display-4 fw-bold">Our Complete Filipino Menu</h1>
        <p class="lead">Savor the authentic taste of home-cooked heritage dishes.</p>
    </div>
</section>

<div class="container mb-5">
    <div class="d-flex flex-wrap justify-content-center gap-2 mb-5">
        <a href="{{ route('menu') }}" class="btn {{ !request('category') ? 'btn-danger' : 'btn-outline-danger' }} rounded-pill px-4">
            🍽️ All Dishes
        </a>
        @foreach($categories as $category)
            <a href="{{ route('menu', ['category' => $category]) }}" 
               class="btn {{ request('category') == $category ? 'btn-danger' : 'btn-outline-danger' }} rounded-pill px-4">
                {{ $category }}
            </a>
        @endforeach
    </div>

    <div class="row g-4">
        @forelse($allFoods as $food)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden transition-hover">
                    
                    <div class="position-relative" style="height: 200px; background-color: #f8f9fa;">
                        @if($food->image)
                            <img src="{{ \Illuminate\Support\Str::startsWith($food->image, ['http://', 'https://']) ? $food->image : asset('storage/' . $food->image) }}" 
                                 class="w-100 h-100 object-fit-cover" 
                                 alt="{{ $food->name }}">
                        @else
                            <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center text-muted border-bottom">
                                <span style="font-size: 2.5rem;">🍲</span>
                                <small class="text-uppercase fw-bold text-secondary mt-1" style="font-size: 0.7rem;">Delicious Food</small>
                            </div>
                        @endif
                        
                        <span class="position-absolute top-0 end-0 bg-warning text-dark font-monospace fw-bold m-2 px-2 py-1 rounded-2 shadow-sm" style="font-size: 0.75rem;">
                            {{ $food->category }}
                        </span>
                    </div>

                    <div class="card-body d-flex flex-column p-3">
                        <h5 class="card-title fw-bold text-dark mb-1" style="font-size: 1.1rem;">{{ $food->name }}</h5>
                        <p class="card-text text-muted small flex-grow-1 mb-3">{{ \Illuminate\Support\Str::limit($food->description, 75) }}</p>
                        
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <span class="fs-5 fw-bold text-danger">₱{{ number_format($food->price, 2) }}</span>
                            
                            <form action="{{ route('cart.add') }}" method="POST" class="m-0">
                                @csrf
                                <input type="hidden" name="food_id" value="{{ $food->id }}">
                                <button type="submit" class="btn btn-danger btn-sm rounded-2 d-flex align-items-center gap-1">
                                    <i class="bi bi-cart-plus"></i> Add
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="text-muted fs-4">No menu items found for this selection.</div>
                <a href="{{ route('menu') }}" class="btn btn-link text-danger mt-2">Clear filters and view all menu items</a>
            </div>
        @endforelse
    </div>
</div>

<style>
    .transition-hover {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    .transition-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
</style>
@endsection