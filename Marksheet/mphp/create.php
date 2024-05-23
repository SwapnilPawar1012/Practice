<!-- add student data into database -->
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

$errorMessage = "";
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] = "POST") {
    if (isset($_POST["e_sdam"])) {
        $name = $_POST["name"];
        $rollNo = $_POST["rollNo"];
        $m_cc = $_POST["m_cc"];
        $m_wt = $_POST["m_wt"];
        $m_daa = $_POST["m_daa"];
        $m_sdam = $_POST["m_sdam"];
        $e_cc = $_POST["e_cc"];
        $e_wt = $_POST["e_wt"];
        $e_daa = $_POST["e_daa"];
        $e_sdam = $_POST["e_sdam"];

        $mse_total = $m_cc + $m_wt + $m_daa + $m_sdam;
        $ese_total = $e_cc + $e_wt + $e_daa + $e_sdam;

        $percentage = ($mse_total * 0.3 + $ese_total * 0.7) / 4;

        do {
            if (empty($name) || empty($rollNo) || empty($m_cc) || empty($m_wt) || empty($m_daa) || empty($m_sdam) || empty($e_cc) || empty($e_wt) || empty($e_daa) || empty($e_sdam) || empty($percentage)) {
                $errorMessage = "All the fiels are required.";
                break;
            }

            $sqlId = "Select * FROM student WHERE rollNo = ?";
            $stmt = $connection->prepare($sqlId);
            $stmt->bind_param("i", $rollNo);
            $stmt->execute();

            $resId = $stmt->get_result();
            if ($resId->num_rows > 0) {
                $errorMessage = "A record with id $rollNo already exits.";
            } else {
                $sql = "INSERT INTO student (name, rollNo, m_cc, m_wt, m_daa, m_sdam, e_cc, e_wt, e_daa, e_sdam, percentage) VALUES ('$name', '$rollNo', '$m_cc', '$m_wt', '$m_daa', '$m_sdam', '$e_cc', '$e_wt', '$e_daa', '$e_sdam', '$percentage')";

                $result = $connection->query($sql);

                if (!$result) {
                    $errorMessage = "Invalid Query: " . $connection->error;
                    break;
                }

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

                $successMessage = "Data Added Successfully.";

                header("location: /MarksheetPHP/index.php");
                exit;
            }
        } while (false);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Add Student Details</title>
    <style>
        .create-container {
            display: flex;
            justify-content: center;
            margin: 20px;
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
            margin: 20px 0;
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
    </style>
</head>

<body>
    <div class="create-container">
        <div class="form-container">
            <?php
            if ($errorMessage) {
                echo "
            <div class='error-container'>
                <p>
                    $errorMessage; 
                </p>
            </div>";
            }
            ;
            ?>
            <h2>Fill Details</h2>
            <form method="POST">
                <div class="details">
                    <p>
                        <label for="name">Name</label>
                        <input type="text" name="name" required />
                    </p>
                    <p>
                        <label for="rollNo">Roll Number</label>
                        <input type="number" min="0" name="rollNo" value="rollNo" required />
                    </p>
                </div>
                <hr />
                <div>
                    <div class="heads">
                        <p>Subjects</p>
                        <p>MSE Marks</p>
                        <p>ESE Marks</p>
                    </div>
                    <div class="inputs">
                        <div>
                            <p>CC</p>
                            <p><input type="number" min="0" max="100" name="m_cc" value="m_cc" required /></p>
                            <p><input type="number" min="0" max="100" name="e_cc" value="e_cc" required /></p>
                        </div>
                        <div>
                            <p>WT</p>
                            <p><input type="number" min="0" max="100" name="m_wt" value="m_wt" required /></p>
                            <p><input type="number" min="0" max="100" name="e_wt" value="e_wt" required /></p>
                        </div>
                        <div>
                            <p>DAA</p>
                            <p><input type="number" min="0" max="100" name="m_daa" value="m_daa" required /></p>
                            <p><input type="number" min="0" max="100" name="e_daa" value="e_daa" required /></p>
                        </div>
                        <div>
                            <p>SDAM</p>
                            <p><input type="number" min="0" max="100" name="m_sdam" value="m_sdam" required /></p>
                            <p><input type="number" min="0" max="100" name="e_sdam" value="e_sdam" required /></p>
                        </div>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <hr />
            <div class="btns">
                <a class="btn btn-primary" href="/MarksheetPHP/index.php">List of Students</a>
                <a class="btn btn-primary" href="/MarksheetPHP/marksheet.php">Search Marksheet</a>
            </div>
        </div>
    </div>
</body>

</html>