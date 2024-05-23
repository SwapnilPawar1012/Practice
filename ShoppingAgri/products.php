<?php
require "connection.php";
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM products");
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Products</title>
</head>

<body>
    <div class="products">
        <h2>Products</h2>
        <?php foreach ($products as $product): ?>
            <div class="product">
                <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                <p><?php echo htmlspecialchars($product['description']); ?></p>
                <p>Price: $<?php echo htmlspecialchars($product['price']); ?></p>
                <p>Quantity: <?php echo htmlspecialchars($product['quantity']); ?></p>
                <a href="buy_product.php?id=<?php echo $product['id']; ?>">Buy</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>