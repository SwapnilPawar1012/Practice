<?php
$servername = "localhost";
$username = "root";
$password = "!Swapnil1012";
$database = "crud";

$ID = "";
$name = "";
$email = "";

do {
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (!isset($_GET["ID"])) {
            header("location: /crud/index.php");
            exit;
        }

        $ID = $_GET["ID"];


        /* Using mysqli
        $connection = new mysqli($servername, $username, $password, $database);

        if ($connection->connect_error) {
            die("Connection Failed: " . $connection->connect_error);
        }

        $sql = "SELECT * FROM student WHERE ID=$ID";
        $result = $connection->query($sql); 
        $row = $result->fetch_assoc(); */


        /* Using mysqli procedural 
        $connection = mysqli_connect($servername, $username, $password, $database);

        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM student WHERE ID=$ID";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_assoc($result); */


        /* Using PDO */
        $connection = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $connection->prepare("SELECT * FROM student WHERE ID=$ID");
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        $row = $result;


        $name = $row["Name"];
        $email = $row["Email"];


    } else {
        $ID = $_POST["ID"];
        $name = $_POST["name"];
        $email = $_POST["email"];


        /* Using mysqli 
        $connection = new mysqli($servername, $username, $password, $database);

        if ($connection->connect_error) {
            die("Connection Failed: " . $connection->connect_error);
        }

        $sql = "UPDATE student SET Name='$name', Email='$email' WHERE ID=$ID";
        $result = $connection->query($sql); */


        /* Using mysqli procedural 
        $connection = mysqli_connect($servername, $username, $password, $database);

        if (!$connection) {
            die("Connection Failed: " . mysqli_connect_error());
        }

        $sql = "UPDATE student SET Name='$name', Email='$email' WHERE ID=$ID";
        $result = mysqli_query($connection, $sql); */


        /* Using PDO */
        $connection = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE student SET Name='$name', Email='$email' WHERE ID=$ID";
        $result = $connection->exec($sql);

        if (!$result) {
            die("Invalid Inputs.");
        }

        header("location: /crud/index.php");
        exit;
    }
} while (false);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <title>Update Page</title>
</head>

<body>
    <div class="container my-5">
        <h2>Update Student Data</h2>
        <br />
        <form method="POST">
            <input type="hidden" name="ID" value="<?php echo $ID; ?>" />
            <div class="row mb-3">
                <lable class="col-sm-3">Name</lable>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" />
                </div>
            </div>
            <div class="row mb-3">
                <lable class="col-sm-3">Email</lable>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" />
                </div>
            </div>
            <div class="row">
                <button class="btn btn-primary col-sm-3 mx-2" type="submit">Submit</button>
                <a class="btn btn-secondary col-sm-3" href="/crud/index.php">Cancel</a>
            </div>
        </form>
    </div>
</body>

</html>