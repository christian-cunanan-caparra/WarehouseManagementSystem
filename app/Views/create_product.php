<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Product</title>
</head>
<body>
    <h1>Create New Product</h1>
    <form action="/employee_dashboard/store" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        <br>
        <label for="description">Description:</label>
        <textarea name="description" id="description"></textarea>
        <br>
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" required>
        <br>
        <label for="price">Price:</label>
        <input type="text" name="price" id="price" required>
        <br>
        <button type="submit">Save</button>
    </form>
</body>
</html>