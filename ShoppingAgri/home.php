<?php
session_start();
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Home</title>
</head>

<body>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION["name"]); ?>!</h2>
    <p>Your role: <?php echo htmlspecialchars($_SESSION["role"]); ?></p>
    <?php if ($_SESSION["role"] === "seller"): ?>
        <a href="add_product.php">Add Product</a>
    <?php elseif ($_SESSION["role"] === "buyer"): ?>
        <a href="shop.php">Shop Products</a>
    <?php endif; ?>
    <a href="logout.php">Logout</a>
</body>

</html>