<?php
if (isset($_GET["ID"])) {
    $servername = "localhost";
    $username = "root";
    $password = "!Swapnil1012";
    $database = "crud";

    $ID = $_GET["ID"];

    /* Using mysqli
    $connection = new mysqli($servername, $username, $password, $database);

    if ($connection->connect_error) {
        die("Connection Failed: " . $connection->connect_error);
    }

    $sql = "DELETE FROM student WHERE ID=$ID";
    $connection->query($sql); */


    /* Using mysqli procedure 
    $connection = mysqli_connect($servername, $username, $password, $database);

    if (!$connection) {
        die("Connection Failed: " . mysqli_connect_error());
    }

    $sql = "DELETE FROM student WHERE ID=$ID";
    mysqli_query($connection, $sql);

    mysqli_close($connection); */


    /* Using PDO */
    $connection = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "DELETE FROM student WHERE ID=$ID";
    $connection->exec($sql);

    $connection = null;
}

header("location: /crud/index.php");
exit;
?>