<?php
require "connection.php";
session_start();

$name = "";
$email = "";
$password = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["register"])) {
        if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"])) {
            $name = trim($_POST["name"]);
            $email = trim($_POST["email"]);
            $password = trim($_POST["password"]);

            if (empty($name) || empty($email) || empty($password)) {
                die("All field must required.");
            }

            try {
                $stmt = $pdo->prepare("INSERT INTO student (name, email, password) VALUES (?, ?, ?)");
                $stmt->execute([$name, $email, $password]);
                if ($stmt) {
                    echo "Registration Successfull.";
                    $message = "Registration Successfull!";
                } else {
                    echo "Registration failed.";
                    $message = "Registration Failed!";
                }
                // Redirect to the login page with a message
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
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css">
    <title>Register</title>
</head>

<body>
    <div class="register">
        <h1>Register</h1>
        <div>
            <p><?php echo $message; ?></p>
        </div>
        <form action="register.php" method="post">
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" required />
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" required />
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" required />
            </div>
            <button type="submit" name="register">Submit</button>
            <p>Already have an account,
                <a href="login.php">Login</a>
            </p>
        </form>
    </div>
</body>

</html>