<!DOCTYPE html>
<html>
<head>
    <title>Food Menu  SYSTEM</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <h1 class="mb-4">Food Menu</h1>

    <div class="row">

        @foreach($menuItems as $item)

        <div class="col-md-4">

            <div class="card p-3 mb-4">

                <h3>{{ $item->name }}</h3>

                <p>{{ $item->description }}</p>

                <h5>₱{{ $item->price }}</h5>

            </div>

        </div>

        @endforeach

    </div>

</div>

</body>
</html>