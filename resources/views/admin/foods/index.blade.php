@extends('layouts.admin')

@section('content')

@php
    use Illuminate\Support\Str;
@endphp

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Food Management</h2>
        <p class="text-muted mb-0">Manage your menu items</p>
    </div>

    <a href="{{ route('admin.foods.create') }}" class="btn btn-danger">
        <i class="bi bi-plus"></i> Add New Food
    </a>
</div>

<!-- Search -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body py-3">
        <form action="{{ route('admin.foods.index') }}" method="GET">
            <div class="input-group">
                <span class="input-group-text bg-white">
                    <i class="bi bi-search"></i>
                </span>

                <input type="text"
                       name="search"
                       class="form-control"
                       placeholder="Search food items..."
                       value="{{ request('search') }}">

                <button type="submit" class="btn btn-danger">
                    Search
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Table -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">

            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Food Item</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($foods as $food)

                    <tr>
                        <td class="ps-4 py-3">
                            <div class="d-flex align-items-center">

                                <img src="{{ $food->image ? asset('storage/'.$food->image) : 'https://via.placeholder.com/60' }}"
                                     class="rounded"
                                     style="width:60px;height:60px;object-fit:cover;">

                                <div class="ms-3">
                                    <h6 class="mb-0 fw-semibold">{{ $food->name }}</h6>
                                    <small class="text-muted">
                                        {{ Str::limit($food->description ?? '', 50) }}
                                    </small>
                                </div>

                            </div>
                        </td>

                        <td>
                            <span class="badge bg-secondary">
                                {{ $food->category }}
                            </span>
                        </td>

                        <td>
                            <span class="fw-bold text-success">
                                ₱{{ number_format($food->price, 2) }}
                            </span>
                        </td>

                        <td>
                            <span class="badge {{ $food->is_available ? 'bg-success' : 'bg-dark' }}">
                                {{ $food->is_available ? 'Available' : 'Unavailable' }}
                            </span>
                        </td>

                        <td class="text-end pe-4">

                            <a href="{{ route('admin.foods.edit', $food) }}"
                               class="btn btn-sm btn-outline-primary">
                                Edit
                            </a>

                            <form action="{{ route('admin.foods.destroy', $food) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Delete this food item?')">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-outline-danger">
                                    Delete
                                </button>

                            </form>

                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            No food items found
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

        </div>
    </div>
</div>

<!-- Pagination -->
<div class="mt-3">
    {{ $foods->links() }}
</div>

@endsection