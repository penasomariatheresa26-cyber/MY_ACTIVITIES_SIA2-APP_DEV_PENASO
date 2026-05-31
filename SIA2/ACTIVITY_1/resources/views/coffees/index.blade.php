<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Global Coffee System</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f3e5d8;
        margin: 0;
        padding: 0;
    }

    header {
        background-color: #4b2e2b;
        color: white;
        padding: 40px 20px;
        text-align: center;
        box-shadow: 0px 4px 10px rgba(0,0,0,0.2);
    }

    header h1 {
        margin: 0;
        font-size: 3rem;
        letter-spacing: 2px;
    }

    .container {
        width: 90%;
        max-width: 1200px;
        margin: 50px auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0px 6px 15px rgba(0,0,0,0.2);
    }

    th, td {
        padding: 18px 12px;
        text-align: center;
        cursor: pointer;
    }

    th {
        background-color: #6f4e37;
        color: #fff;
        font-size: 1.2rem;
    }

    td {
        font-size: 1rem;
        border-bottom: 1px solid #ddd;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    /* Hidden expandable row */
    .expandable {
        display: none;
        background-color: #f9f9f9;
        font-size: 0.95rem;
        color: #333;
    }

    /* Button style inside table */
    .btn {
        padding: 6px 12px;
        background-color: #8b5e3c;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        font-weight: bold;
        transition: background 0.3s;
    }

    .btn:hover {
        background-color: #6f4e37;
    }

    @media (max-width: 768px) {
        header h1 {
            font-size: 2rem;
        }
        th, td {
            padding: 12px 8px;
            font-size: 0.9rem;
        }
    }
</style>
</head>
<body>

<header>
    <h1>☕ Global Coffee System</h1>
</header>

<div class="container">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Coffee Name</th>
                <th>Country</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($coffees as $coffee)
            <tr class="clickable-row" data-id="{{ $coffee['id'] }}">
                <td>{{ $coffee['id'] }}</td>
                <td>{{ $coffee['name'] }}</td>
                <td>{{ $coffee['country'] }}</td>
                <td><span class="btn">View Details</span></td>
            </tr>
            <tr class="expandable" id="expand-{{ $coffee['id'] }}">
                <td colspan="4">{{ $coffee['description'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    // JS to toggle expandable rows
    const rows = document.querySelectorAll('.clickable-row');
    rows.forEach(row => {
        row.addEventListener('click', () => {
            const id = row.dataset.id;
            const expandable = document.getElementById('expand-' + id);
            if (expandable.style.display === 'table-row') {
                expandable.style.display = 'none';
            } else {
                expandable.style.display = 'table-row';
            }
        });
    });
</script>

</body>
</html>