<?php
session_start();
include 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_email'])) {
    header('Location: login.php');
    exit;
}

$user_email = $_SESSION['user_email'];

// Fetch the complaints by the logged-in user
$sql = "SELECT * FROM complaints WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Panel</title>
</head>

<body>
    <h1>Welcome to Your Panel</h1>

    <h2>Your Complaints</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["description"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No complaints submitted yet</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Optionally, include a link to submit a new complaint -->
    <p><a href="submit_complaint.php">Submit a New Complaint</a></p>

    <!-- Log out link -->
    <p><a href="logout.php">Log Out</a></p>
</body>

</html>