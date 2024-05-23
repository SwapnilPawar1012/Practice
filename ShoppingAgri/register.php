<?php
require "connection.php";
session_start();

$name = $email = $password = $role = $message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["register"])) {
        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);
        $role = trim($_POST["role"]);

        if (empty($name) || empty($email) || empty($password) || empty($role)) {
            $message = "All fields are required.";
        } else {
            try {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
                $stmt->execute([$name, $email, $hashedPassword, $role]);
                $message = "Registration successful!";
                header("Location: login.php?message=" . urlencode($message));
                exit;
            } catch (PDOException $e) {
                die("Error: " . $e->getMessage());
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>

<body>
    <h2>Register</h2>
    <form action="register.php" method="post">
        <label for="name">Name</label>
        <input type="text" name="name" required>
        <label for="email">Email</label>
        <input type="email" name="email" required>
        <label for="password">Password</label>
        <input type="password" name="password" required>
        <label for="role">Role</label>
        <select name="role" required>
            <option value="buyer">Buyer</option>
            <option value="seller">Seller</option>
        </select>
        <button type="submit" name="register">Register</button>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </form>
    <p><?php echo htmlspecialchars($message); ?></p>
</body>

</html>