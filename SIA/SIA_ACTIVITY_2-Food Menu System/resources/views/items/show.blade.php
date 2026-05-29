<!DOCTYPE html>
<html>
<head>
<title>View Food Menu</title>

<style>

body{
    font-family:Arial;
    background:linear-gradient(120deg,#ff9a9e,#fad0c4);
    padding:40px;
}

.container{
    background:white;
    padding:30px;
    border-radius:12px;
    width:500px;
    margin:auto;
    box-shadow:0 8px 20px rgba(0,0,0,0.2);
    text-align:center;
}

h2{
    text-align:center;
    color:#ff4d6d;
    margin-bottom:20px;
}

img{
    width:200px;
    height:200px;
    border-radius:12px;
    object-fit:cover;
    margin-bottom:20px;
}

p{
    font-size:16px;
    margin:10px 0;
}

.button-group{
    display:flex;
    gap:10px;
    justify-content:center;
    margin-top:20px;
}

.button-group a{
    text-decoration:none;
    padding:12px 20px;
    border-radius:8px;
    color:white;
    background:#ff4d6d;
    font-weight:bold;
}

.button-group a:hover{
    background:#e63e5c;
}

</style>
</head>

<body>

<div class="container">

<h2>{{ $item->name }}</h2>

@if($item->image)
<img src="/images/{{ $item->image }}" alt="{{ $item->name }}">
@else
<img src="https://via.placeholder.com/200" alt="No Image">
@endif

<p><strong>Category:</strong> {{ $item->category }}</p>
<p><strong>Price:</strong> ₱{{ $item->price }}</p>
<p><strong>Quantity:</strong> {{ $item->quantity }}</p>
<p><strong>Description:</strong> {{ $item->description }}</p>

<div class="button-group">
    <a href="/items/{{ $item->id }}/edit">Edit</a>
    <a href="/items">Back to Menu</a>
</div>

</div>

</body>
</html>