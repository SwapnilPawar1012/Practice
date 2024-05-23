<?php
require 'connection.php';  // Ensure you have a connection script
session_start();

try {
    $stmt = $pdo->query("SELECT * FROM products WHERE available = 1");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Product Catalog</title>
</head>

<body>
    <h1>Product Catalog</h1>
    <?php foreach ($products as $product): ?>
        <div>
            <h2><?= htmlspecialchars($product['name']) ?></h2>
            <p><?= htmlspecialchars($product['description']) ?></p>
            <p>$<?= number_format($product['price'], 2) ?></p>
            <form action="cart.php" method="post">
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                <input type="number" name="quantity" value="1" min="1">
                <button type="submit" name="buy">Add to Cart</button>
            </form>
        </div>
    <?php endforeach; ?>
</body>

</html>