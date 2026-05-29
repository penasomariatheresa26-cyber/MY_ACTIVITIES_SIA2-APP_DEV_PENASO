@extends('layouts.admin')
@section('content')
<div class="d-flex align-items-center mb-4">
    <a href="{{ route('admin.foods.index') }}" class="btn btn-outline-secondary me-3">
        <i class="bi bi-arrow-left"></i>
    </a>
    <div>
        <h2 class="fw-bold mb-0">Edit Food Item</h2>
        <p class="text-muted mb-0">Update menu item details</p>
    </div>
</div>
<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('admin.foods.update', $food) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Food Name *</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name', $food->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Category *</label>
                            <input type="text" name="category" class="form-control @error('category') is-invalid @enderror" 
                                   list="categories" value="{{ old('category', $food->category) }}" required>
                            <datalist id="categories">
                                @foreach($categories as $category)
                                <option value="{{ $category }}">
                                @endforeach
                            </datalist>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Description *</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                                      rows="3" required>{{ old('description', $food->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Price (₱) *</label>
                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" 
                                   value="{{ old('price', $food->price) }}" step="0.01" min="0" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Food Image</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" 
                                   accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        @if($food->image)
                        <div class="col-12">
                            <label class="form-label fw-semibold">Current Image</label>
                            <div>
                                <img src="{{ asset('storage/' . $food->image) }}" class="rounded" 
                                     style="width: 150px; height: 100px; object-fit: cover;">
                            </div>
                        </div>
                        @endif
                        <div class="col-12">
                            <div class="form-check form-switch">
                                <input type="checkbox" name="is_available" class="form-check-input" id="is_available" 
                                       {{ old('is_available', $food->is_available) ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="is_available">
                                    Available for ordering
                                </label>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-danger px-4">
                                <i class="bi bi-check"></i> Update Food Item
                            </button>
                            <a href="{{ route('admin.foods.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
