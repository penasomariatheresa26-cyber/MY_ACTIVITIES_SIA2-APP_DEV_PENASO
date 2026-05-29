<!DOCTYPE html>
<html>
<head>
<title>Add Food Menu</title>

<style>

body{
    font-family: Arial;
    background: linear-gradient(120deg,#ff9a9e,#fad0c4);
    margin:0;
}

/* container card */
.container{
    width:420px;
    margin:80px auto;
    background:white;
    padding:35px;
    border-radius:12px;
    box-shadow:0 8px 20px rgba(0,0,0,0.2);
}

/* title */
h2{
    text-align:center;
    color:#ff4d6d;
    margin-bottom:25px;
}

/* labels */
label{
    font-weight:bold;
    color:#555;
}

/* inputs */
input,select,textarea{
    width:100%;
    padding:10px;
    margin-top:5px;
    margin-bottom:15px;
    border-radius:6px;
    border:1px solid #ddd;
    font-size:14px;
}

/* focus effect */
input:focus,select:focus,textarea:focus{
    border-color:#ff4d6d;
    outline:none;
    box-shadow:0 0 5px rgba(255,77,109,0.5);
}

/* button */
button{
    width:100%;
    padding:12px;
    border:none;
    background:#ff4d6d;
    color:white;
    font-size:16px;
    border-radius:8px;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    background:#e63950;
}

/* back button */
.back{
    display:block;
    text-align:center;
    margin-top:15px;
    text-decoration:none;
    color:#777;
}

.back:hover{
    color:#ff4d6d;
}

</style>

</head>
<body>

<div class="container">

<h2>🍔 Add Food Menu</h2>

<form method="POST" action="/items" enctype="multipart/form-data">

@csrf

<label>Name</label>
<input type="text" name="name" required>

<label>Category</label>
<select name="category">

<option>Meals</option>
<option>Drinks</option>
<option>Dessert</option>
<option>Fast Food</option>
<option>Street Food</option>
<option>Seafood</option>
<option>Salads</option>
<option>Soups</option>
<option>Snacks</option>
<option>Special Menu</option>

</select>

<label>Price</label>
<input type="number" name="price" required>

<label>Quantity</label>
<input type="number" name="quantity" required>

<label>Description</label>
<textarea name="description" rows="3"></textarea>

<label>Image</label>
<input type="file" name="image">

<button type="submit">➕ Add Menu</button>

</form>

<a href="/items" class="back">⬅ Back to Menu</a>

</div>

</body>
</html>