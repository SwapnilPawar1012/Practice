<!-- One semester result using react springboot Result using php and sql -->
<?php
include "connection.php";

$name = "";
$rollNo = "";
$m_cc = "";
$m_wt = "";
$m_daa = "";
$m_sdam = "";
$e_cc = "";
$e_wt = "";
$e_daa = "";
$e_sdam = "";
$percentage = "";

if ($_SERVER["REQUEST_METHOD"] = "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];

    $sql = "SELECT * FROM student WHERE rollNo = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();

    if (!$result) {
        echo "No Data Found";
        die("Error: " . $connection->error);
    }

    while ($row = $result->fetch_assoc()) {
        $name = $row["name"];
        $rollNo = $row["rollNo"];
        $m_cc = $row["m_cc"];
        $m_wt = $row["m_wt"];
        $m_daa = $row["m_daa"];
        $m_sdam = $row["m_sdam"];
        $e_cc = $row["e_cc"];
        $e_wt = $row["e_wt"];
        $e_daa = $row["e_daa"];
        $e_sdam = $row["e_sdam"];
        $percentage = $row["percentage"];
    }
}
?>

<!DOCTYPE html>
<html class="en">

<head>
    <meta charset="utf-8">
    <title>Merksheet Usnig PHP and mysql</title>
    <style>
        .search-marksheet-container {
            display: flex;
            flex-direction: column;
            width: 50%;
            gap: 50px;
            margin: 20px auto;
        }

        .error-container p {
            background: red;
            padding: 10px;
        }

        .form-container {
            background: aliceblue;
            padding: 20px;
            border-radius: 10px;
            font-size: large;
        }

        .search-marksheet {
            width: 50%;
            display: flex;
            flex-direction: column;
            margin: auto;
            gap: 20px;
            border: 1px solid #999;
            padding: 20px;
            border-radius: 6px;
            font-size: larger;
        }

        .heads {
            display: grid;
            grid-template-columns: 1fr 2fr 2fr;
            font-weight: 600;
            gap: 50px;
        }

        .inputs div {
            display: grid;
            grid-template-columns: 1fr 2fr 2fr;
            gap: 50px;
            align-items: baseline;
        }

        .details p {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
        }

        input {
            width: 65%;
            font-size: 18px;
            padding: 8px;
            border: 1px solid #999;
            border-radius: 6px;
        }

        .btns {
            display: flex;
            gap: 30px;
        }

        .btn {
            color: black;
            text-decoration: none;
            width: 100%;
            font-size: 18px;
            padding: 10px;
            border: 1px solid #999;
            border-radius: 6px;
            background: #5899d1;
            margin: 10px 0;
            text-align: center;
        }

        h2 {
            display: grid;
            justify-content: center;
            margin: auto auto 35px auto;
        }

        .result {
            font-size: x-large;
            display: flex;
            justify-content: space-evenly;
        }
    </style>
</head>

<body>
    <div class="search-marksheet-container">
        <div class="btns">
            <a class="btn btn-primary" href="/MarksheetPHP/index.php">List of Students</a>
            <a class="btn btn-primary" href="/MarksheetPHP/create.php">Add Student Details</a>
        </div>

        <div class="search-marksheet">
            <form method="POST">
                <div>
                    <label>Roll Number</label>
                    <input type="number" min="0" name="id" value="id" required />
                </div>
                <button type="submit" class="btn btn-primary">Search Marksheet</button>
            </form>
        </div>
        <div class="marksheet">
            <div class="form-container">
                <h2>Marksheet</h2>
                <div class="details">
                    <p>
                        <label for="name">Name</label>
                        <input type="text" name="name" value="<?php echo $name ?>" disabled />
                    </p>
                    <p>
                        <label for="rollNo">Roll Number</label>
                        <input type="number" min="0" name="rollNo" value="<?php echo $rollNo ?>" disabled />
                    </p>
                </div>
                <div>
                    <div class="heads">
                        <p>Subjects</p>
                        <p>MSE Marks</p>
                        <p>ESE Marks</p>
                    </div>
                    <div class="inputs">
                        <div>
                            <p>CC</p>
                            <p><input type="number" min="0" name="m_cc" value="<?php echo $m_cc ?>" disabled /></p>
                            <p><input type="number" min="0" name="e_cc" value="<?php echo $e_cc ?>" disabled /></p>
                        </div>
                        <div>
                            <p>WT</p>
                            <p><input type="number" min="0" name="m_wt" value="<?php echo $m_wt ?>" disabled /></p>
                            <p><input type="number" min="0" name="e_wt" value="<?php echo $e_wt ?>" disabled /></p>
                        </div>
                        <div>
                            <p>DAA</p>
                            <p><input type="number" min="0" name="m_daa" value="<?php echo $m_daa ?>" disabled /></p>
                            <p><input type="number" min="0" name="e_daa" value="<?php echo $e_daa ?>" disabled /></p>
                        </div>
                        <div>
                            <p>SDAM</p>
                            <p><input type="number" min="0" name="m_sdam" value="<?php echo $m_sdam ?>" disabled /></p>
                            <p><input type="number" min="0" name="e_sdam" value="<?php echo $e_sdam ?>" disabled /></p>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="result">
                    <p>Percentage</p>
                    <p><?php echo $percentage; ?></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>