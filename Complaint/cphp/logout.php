<?php
session_start();
require "db.php";
session_destroy();
$conn->close();
header("location: login.php");
exit;
?>