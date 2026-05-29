@extends('layouts.app')
@section('content')
<!-- Hero Section -->
<section class="bg-danger text-white py-5" style="min-height: 70vh; display: flex; align-items: center;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <span class="badge bg-warning text-dark px-3 py-2 mb-3">🔥 Hot Deals Available</span>
                <h1 class="display-4 fw-bold mb-4">
                    Authentic Filipino
                    <span class="text-warning d-block">Flavors</span>
                </h1>
                <p class="lead mb-4">
                    Experience the taste of home with our carefully crafted dishes. 
                    From savory adobo to sweet halo-halo, we bring you the best of Filipino cuisine.
                </p>
                <a href="{{ route('menu') }}" class="btn btn-warning btn-lg px-4 py-3 fw-semibold">
                    Order Now <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="col-lg-6 d-none d-lg-block text-center">
           a     <img src="https://images.pexels.com/photos/37322908/pexels-photo-37322908.jpeg?auto=compress&cs=tinysrgb&fit=crop&h=500&w=600" 
                     alt="Delicious Food" 
                     class="img-fluid rounded-4 shadow-lg">
            </div>
        </div>
    </div>
</section>
<!-- Features Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card border-0 text-center p-4 shadow-sm h-100">
                    <i class="bi bi-truck fs-1 text-danger mb-3"></i>
                    <h5 class="fw-bold">Fast Delivery</h5>
                    <p class="text-muted small mb-0">Get your food delivered within 30-45 minutes</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 text-center p-4 shadow-sm h-100">
                    <i class="bi bi-clock fs-1 text-danger mb-3"></i>
                    <h5 class="fw-bold">Fresh & Hot</h5>
                    <p class="text-muted small mb-0">Prepared fresh daily with quality ingredients</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 text-center p-4 shadow-sm h-100">
                    <i class="bi bi-award fs-1 text-danger mb-3"></i>
                    <h5 class="fw-bold">Best Quality</h5>
                    <p class="text-muted small mb-0">Premium ingredients for authentic taste</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 text-center p-4 shadow-sm h-100">
                    <i class="bi bi-heart fs-1 text-danger mb-3"></i>
                    <h5 class="fw-bold">Made with Love</h5>
                    <p class="text-muted small mb-0">Every dish prepared with care and passion</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Categories Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="fw-bold">Explore Our Menu</h2>
        </div>
        <div class="d-flex flex-wrap justify-content-center gap-2">
            @foreach($categories as $category)
            <a href="{{ route('menu', ['category' => $category]) }}" class="btn btn-outline-danger rounded-pill px-4">
                {{ $category }}
            </a>
            @endforeach
        </div>
    </div>
</section>
<!-- Featured Foods -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <span class="badge bg-danger px-3 py-2 mb-2">Featured</span>
                <h2 class="fw-bold mb-0">Popular Dishes</h2>
            </div>
            <a href="{{ route('menu') }}" class="btn btn-outline-danger">View All</a>
        </div>
        <div class="row g-4">
            @foreach($featuredFoods as $food)
            <div class="col-md-6 col-lg-4">
                <div class="card food-card border-0 shadow-sm h-100">
                    <div class="position-relative">
                        @if($food->image)
                            <img src="{{ asset('storage/' . $food->image) }}" class="card-img-top" alt="{{ $food->name }}">
                        @else
                            <img src="https://images.pexels.com/photos/1640777/pexels-photo-1640777.jpeg?auto=compress&cs=tinysrgb&fit=crop&h=200&w=300" class="card-img-top" alt="{{ $food->name }}">
                        @endif
                        <span class="badge bg-danger position-absolute top-0 end-0 m-2">{{ $food->category }}</span>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">{{ $food->name }}</h5>
                        <p class="card-text text-muted small flex-grow-1">{{ Str::limit($food->description, 80) }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <span class="fs-5 fw-bold text-danger">₱{{ number_format($food->price, 2) }}</span>
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="food_id" value="{{ $food->id }}">
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-cart-plus"></i> Add
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Call to Action -->
<section class="py-5 bg-danger text-white">
    <div class="container text-center">
        <h2 class="fw-bold mb-3">Hungry? Order Now!</h2>
        <p class="lead mb-4">Get 10% off on your first order. Use code: THERESSE10</p>
        <a href="{{ route('menu') }}" class="btn btn-warning btn-lg px-5 py-3 fw-semibold">
            Start Ordering
        </a>
    </div>
</section>
@endsection