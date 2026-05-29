<!DOCTYPE html>
<html>
<head>
    <title>Food Menu System</title>

    <style>

        body{
            font-family: Arial;
            background: #ffe6f2;
            text-align:center;
            margin:0;
        }

        header{
            background:#ff66b2;
            color:white;
            padding:25px;
            font-size:32px;
            font-weight:bold;
        }

        nav{
            background:#ffb3d9;
            padding:15px;
        }

        nav a{
            text-decoration:none;
            color:white;
            font-size:20px;
            margin:15px;
            font-weight:bold;
        }

        nav a:hover{
            color:#800040;
        }

        .container{
            width:80%;
            margin:auto;
            margin-top:40px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            background:white;
            font-size:20px;
        }

        th{
            background:#ff66b2;
            color:white;
            padding:15px;
        }

        td{
            padding:15px;
            border-bottom:1px solid #ddd;
        }

        tr:hover{
            background:#ffe6f2;
        }

    </style>

</head>

<body>

<header>
🍓 Food Menu System
</header>

<nav>
    <a href="/items">All Menu</a>
    <a href="/items?category=Meals">Meals</a>
    <a href="/items?category=Desserts">Desserts</a>
    <a href="/items?category=Drinks">Drinks</a>
</nav>

<div class="container">

    @yield('content')

</div>

</body>
</html>