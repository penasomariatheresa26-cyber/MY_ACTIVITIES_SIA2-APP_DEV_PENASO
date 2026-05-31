<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloomery: Online Floral Management System</title>

    <style>
        body{
            margin:0;
            padding:0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #ffdde1, #ee9ca7);
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        .container{
            text-align:center;
            background:white;
            padding:50px;
            border-radius:15px;
            box-shadow:0 4px 15px rgba(0,0,0,0.2);
        }

        h1{
            color:#d63384;
            font-size:40px;
            margin-bottom:10px;
        }

        p{
            color:#555;
            font-size:18px;
        }

        .btn{
            display:inline-block;
            margin-top:20px;
            padding:12px 25px;
            background:#d63384;
            color:white;
            text-decoration:none;
            border-radius:8px;
            transition:0.3s;
        }

        .btn:hover{
            background:#b0256b;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Bloomery</h1>
        <p>Online Floral Management System</p>

        <a href="{{ route('login') }}">Get Started</a>
    </div>

</body>
</html>