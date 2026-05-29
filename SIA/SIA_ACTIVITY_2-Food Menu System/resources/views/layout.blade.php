<!DOCTYPE html>
<html>
<head>
<title>Sweet Food Menu System</title>

<style>

body{
    font-family: Arial;
    background:#ffe6f0;
    margin:0;
}

header{
    background:#ff4da6;
    color:white;
    padding:25px;
    text-align:center;
}

footer{
    background:#ff4da6;
    color:white;
    text-align:center;
    padding:10px;
    margin-top:40px;
}

.container{
    padding:30px;
}

/* CARD DESIGN */

.card{
    background:white;
    padding:20px;
    margin:15px 0;
    border-radius:12px;
    box-shadow:0 4px 8px rgba(0,0,0,0.15);
}

/* LINKS */

a{
    text-decoration:none;
}

/* BUTTON */

button{
    padding:10px 18px;
    border:none;
    background:#ff4da6;
    color:white;
    border-radius:6px;
    cursor:pointer;
}

button:hover{
    background:#ff1a8c;
}

/* CATEGORY TABS */

.tabs{
    margin-bottom:25px;
}

.tabs a{
    padding:10px 15px;
    background:#ff99cc;
    color:white;
    border-radius:6px;
    margin-right:10px;
}

.tabs a:hover{
    background:#ff4da6;
}

.price{
    color:#ff1a8c;
    font-weight:bold;
}

</style>

</head>

<body>

<header>
<h1>🌸 Theresse Food Menu</h1>
<p> Mini Food System</p>
</header>

<div class="container">

@yield('content')

</div>

<footer>
<p>2026 Food Menu System</p>
</footer>

</body>
</html>