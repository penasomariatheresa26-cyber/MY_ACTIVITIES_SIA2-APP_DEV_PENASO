<!DOCTYPE html>
<html>
<head>
    <title>FOOD MENU SYSTEM</title>
    <style>
        body{
            font-family: Arial;
            background: linear-gradient(120deg,#ff9a9e,#fad0c4);
            margin:0;
            padding:20px 0;
        }

        header{
            background:#ff4d6d;
            color:white;
            padding:25px;
            text-align:center;
            font-size:30px;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        .container{
            width:90%;
            margin:auto;
            display:flex;
            flex-wrap: wrap;
            gap:20px;
            margin-top:30px;
            justify-content: center;
        }

        .card{
            background:white;
            border-radius:12px;
            width:250px;
            padding:20px;
            box-shadow:0 8px 20px rgba(0,0,0,0.2);
            display:flex;
            flex-direction: column;
            align-items: center;
            transition: transform 0.2s;
        }

        .card:hover{
            transform: translateY(-5px);
        }

        .card img{
            width:150px;
            height:150px;
            border-radius:12px;
            object-fit:cover;
            margin-bottom:15px;
        }

        .card h3{
            margin:5px 0;
            color:#ff4d6d;
        }

        .card p{
            margin:5px 0;
            font-size:14px;
            color:#555;
        }

        .card .price{
            font-weight:bold;
            color:#ff4d6d;
            margin:10px 0;
        }

        .card .actions{
            display:flex;
            gap:10px;
            margin-top:10px;
        }

        .card .actions a, .card .actions button{
            padding:8px 12px;
            border:none;
            border-radius:8px;
            text-decoration:none;
            cursor:pointer;
            font-size:14px;
        }

        .card .actions a{
            background:#ff4d6d;
            color:white;
        }

        .card .actions a:hover{
            background:#e63e5c;
        }

        .card .actions button{
            background:#333;
            color:white;
        }

        .card .actions button:hover{
            background:#555;
        }

        .top{
            display:flex;
            justify-content: space-between;
            align-items:center;
            width:90%;
            margin:20px auto;
            flex-wrap: wrap;
            gap:10px;
        }

        .top a, .top button{
            background:#ff4d6d;
            color:white;
            padding:10px 15px;
            border:none;
            border-radius:8px;
            text-decoration:none;
            cursor:pointer;
        }

        .top a:hover, .top button:hover{
            background:#e63e5c;
        }

        .top form input[type="text"]{
            padding:8px;
            border-radius:8px;
            border:1px solid #ddd;
            width:200px;
        }

        .top form button{
            padding:8px 12px;
        }

        .success{
            text-align:center;
            color:green;
            margin-top:10px;
            font-weight:bold;
        }

    </style>
</head>
<body>

<header>
    🍽 FOOD MENU SYSTEM
</header>

<div class="top">
    <a href="/items/create">+ Add Menu</a>

    <form method="GET" action="/items">
        <input type="text" name="search" placeholder="Search Menu">
        <button type="submit">Search</button>
    </form>
</div>

@if(session('success'))
    <p class="success">{{ session('success') }}</p>
@endif

<div class="container">
    @foreach($items as $item)
        <div class="card">
            @if($item->image)
                <img src="/images/{{ $item->image }}" alt="{{ $item->name }}">
            @else
                <img src="https://via.placeholder.com/150" alt="No Image">
            @endif

            <h3>{{ $item->name }}</h3>
            <p>Category: {{ $item->category }}</p>
            <p class="price">₱{{ $item->price }}</p>
            <p>Qty: {{ $item->quantity }}</p>
            <p>{{ $item->description }}</p>

            <div class="actions">
                <a href="/items/{{ $item->id }}">View</a>
                <a href="/items/{{ $item->id }}/edit">Edit</a>
                <form action="/items/{{ $item->id }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </div>
        </div>
    @endforeach
</div>

</body>
</html>