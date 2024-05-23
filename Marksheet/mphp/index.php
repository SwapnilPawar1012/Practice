<!-- One semester result using react springboot Result using php and sql -->
<!DOCTYPE html>
<html class="en">

<head>
    <meta charset="utf-8">
    <title>Marksheet Usnig PHP and mysql</title>
    <style>
        .main-container {
            width: 80%;
            background: aliceblue;
            padding: 20px;
            display: grid;
            margin: 20px auto;
            gap: 25px;
        }

        .btns {
            display: flex;
            gap: 20px;
        }

        h2 {
            display: flex;
            justify-content: center;
        }

        .btn {
            background: #5899d1;
            padding: 10px;
            color: black;
            text-decoration: none;
            border-radius: 6px;
            text-align: center;
        }

        .head {
            list-style: none;
            display: grid;
            grid-template-columns: 1fr 1fr;
            font-size: 20px;
            font-weight: 600;
        }

        ul {
            list-style: none;
            display: grid;
            grid-template-columns: 1fr 1fr;
            font-size: 20px;
        }
    </style>
</head>

<body>
    <div class="main-container">
        <h2>List of Students</h2>
        <div class="btns">
            <a class="btn btn-primary" href="/MarksheetPHP/create.php">Add Student Details</a>
            <a class="btn btn-primary" href="/MarksheetPHP/marksheet.php">Search Marksheet</a>
        </div>

        <div>
            <ul class="head">
                <li>Roll Number</li>
                <li>Name</li>
            </ul>
            <hr />
            <?php
            require "connection.php";

            $sql = "SELECT * FROM student";

            $result = $connection->query($sql);

            if (!$result) {
                echo "No data found!";
                die("Error: " . $connection->error);
            }

            while ($row = $result->fetch_assoc()) {
                echo "
                <ul>
                    <li>$row[rollNo]</li>
                    <li>$row[name]</li>
                </ul>
                ";
            }
            ?>
        </div>
    </div>
</body>

</html>