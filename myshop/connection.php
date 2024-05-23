<?php
$servername = "localhost";
$username = "root";
$password = "!Swapnil1012";
$database = "myshop";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection Failde: " . $connection->connect_error);
}
?>