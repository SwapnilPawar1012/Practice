<?php
require "connection.php";
session_start();

$email = "";
$password = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["login"])) {
        if (isset($_POST["email"]) && isset($_POST["password"])) {
            $email = trim($_POST["email"]);
            $password = trim($_POST["password"]);

            if (empty($email) || empty($password)) {
                die("All field must required.");
            }

            try {
                $stmt = $pdo->prepare("SELECT * FROM student WHERE email = ? AND password = ?");
                $stmt->execute([$email, $password]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                    $message = "Successfully Logged In!";
                    $_SESSION["id"] = $user["id"];
                    $_SESSION["name"] = $user["name"];
                    $_SESSION["email"] = $user["email"];

                    $cookie_name = "login_status";
                    $cookie_value = "logged in";
                    setcookie($cookie_name, $cookie_value, time() + 86400 * 2, "/");
                    header("location: home.php?message=" . urlencode($message));
                } else {
                    $message = "Login Failed!";
                }
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
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="login">
        <h1>Login</h1>
        <div>
            <p><?php if ($message) {
                echo $message;
            } ?></p>
        </div>
        <form action="login.php" method="post">
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" required />
            </div>
            <div><label for="password">Password</label>
                <input type="password" name="password" required />
            </div>
            <button type="submit" name="login">Submit</button>
        </form>
        <p>Donn't have an account,
            <a href="register.php">Register</a>
        </p>
    </div>
</body>

</html>