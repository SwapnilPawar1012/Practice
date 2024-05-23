<?php
session_start();

$message = "";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
</head>

<body>
    <div class="home">
        <h1>Home</h1>
        <button onclick="logout()">Logout</button>
        <div>
            <p><?php echo $message; ?></p>
        </div>
        <div class="container">
            <p><span>Id</span><span><?php echo $_SESSION["id"] ?></span></p>
            <p><span>Name</span><span><?php echo $_SESSION["name"] ?></span></p>
            <p><span>Email</span><span><?php echo $_SESSION["email"] ?></span></p>
        </div>
    </div>
    <script>
        function logout() {
            window.location.href = "logout.php";
        }
    </script>
</body>

</html>