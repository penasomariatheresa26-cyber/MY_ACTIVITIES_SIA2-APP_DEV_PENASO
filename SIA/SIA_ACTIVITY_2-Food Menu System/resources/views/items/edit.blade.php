<!DOCTYPE html>
<html>
<head>
<title>Edit Food Menu</title>

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
}

h2{
text-align:center;
color:#ff4d6d;
margin-bottom:20px;
}

input,select,textarea{
width:100%;
padding:10px;
border-radius:8px;
border:1px solid #ddd;
margin-top:5px;
margin-bottom:15px;
}

button{
background:#ff4d6d;
color:white;
border:none;
padding:12px;
width:100%;
font-size:16px;
border-radius:8px;
cursor:pointer;
}

button:hover{
background:#e63e5c;
}

</style>

</head>

<body>

<div class="container">

<h2>Edit Food Menu</h2>

<form method="POST" action="{{ route('items.update',$item->id) }}" enctype="multipart/form-data">

@csrf
@method('PUT')

Name
<input type="text" name="name" value="{{ $item->name }}">

Category
<select name="category">
<option {{ $item->category=='Meals'?'selected':'' }}>Meals</option>
<option {{ $item->category=='Drinks'?'selected':'' }}>Drinks</option>
<option {{ $item->category=='Dessert'?'selected':'' }}>Dessert</option>
<option {{ $item->category=='Fast Food'?'selected':'' }}>Fast Food</option>
<option {{ $item->category=='Street Food'?'selected':'' }}>Street Food</option>
<option {{ $item->category=='Seafood'?'selected':'' }}>Seafood</option>
<option {{ $item->category=='Salads'?'selected':'' }}>Salads</option>
<option {{ $item->category=='Soups'?'selected':'' }}>Soups</option>
<option {{ $item->category=='Snacks'?'selected':'' }}>Snacks</option>
<option {{ $item->category=='Special Menu'?'selected':'' }}>Special Menu</option>
</select>

Price
<input type="number" name="price" value="{{ $item->price }}">

Quantity
<input type="number" name="quantity" value="{{ $item->quantity }}">

Description
<textarea name="description">{{ $item->description }}</textarea>

Image
<input type="file" name="image">

<br>

<button>Update Menu</button>

</form>

</div>

</body>
</html>