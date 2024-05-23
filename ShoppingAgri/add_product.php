<?php
require 'connection.php';  // Database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $user_id = $_POST['user_id'];
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    // Prepare SQL query
    $stmt = $pdo->prepare("INSERT INTO products (user_id, category_id, name, description, price, quantity) VALUES (?, ?, ?, ?, ?, ?)");
    try {
        $stmt->execute([$user_id, $category_id, $name, $description, $price, $quantity]);
        echo "New product added successfully!";
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    echo "Invalid request method.";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
</head>
<body>
    <h1>Add New Product</h1>
    <form action="add_product.php" method="post" enctype="multipart/form-data">
        <label for="user_id">User ID:</label>
        <input type="number" id="user_id" name="user_id" required><br><br>

        <label for="category_id">Category ID:</label>
        <input type="number" id="category_id" name="category_id" required><br><br>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br><br>

        <label for="price">Price:</label>
        <input type="text" id="price" name="price" required pattern="^\d+(\.\d{1,2})?$"><br><br>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required><br><br>

        <button type="submit" name="submit">Add Product</button>
    </form>
</body>
</html>
