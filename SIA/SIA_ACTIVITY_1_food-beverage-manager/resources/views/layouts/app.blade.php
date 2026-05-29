<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Food & Beverage Manager')</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e6f5e6; /* light green */
            color: #333;
            margin: 0;
            padding: 0;
        }
        header, footer {
            background-color: #b2d8b2; /* darker green */
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }
        .container {
            width: 90%;
            max-width: 800px;
            margin: 20px auto;
            background-color: #f5fff5;
            padding: 20px;
            border-radius: 10px;
        }
        a {
            color: #2d862d;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .item-card {
            background-color: #d9f2d9;
            margin-bottom: 15px;
            padding: 15px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Food & Beverage Manager</h1>
    </header>
    <div class="container">
        @yield('content')
    </div>
    <footer>
        &copy; 2026 My Mini System
    </footer>
</body>
</html>