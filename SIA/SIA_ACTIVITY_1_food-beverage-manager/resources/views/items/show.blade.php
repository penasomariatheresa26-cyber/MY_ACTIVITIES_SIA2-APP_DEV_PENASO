@extends('layouts.app')

@section('title', $item['name'])

@section('content')
    <h2>{{ $item['name'] }}</h2>
    <p><strong>Description:</strong> {{ $item['description'] }}</p>
    <p><strong>Category:</strong> {{ $item['category'] }}</p>
    <p><strong>Price:</strong> ₱{{ $item['price'] }}</p>
    <a href="{{ url('/items') }}">&#8592; Back to List</a>
@endsection