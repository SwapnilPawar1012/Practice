<?php
session_start();
include 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_email'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION['user_email']; // Assume user's email is stored in session
    $description = $conn->real_escape_string($_POST['description']);

    $sql = "INSERT INTO complaints (email, description) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $description);

    if ($stmt->execute()) {
        echo "Complaint submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Submit Complaint</title>
</head>

<body>
    <h1>Submit Complaint</h1>
    <form method="post" action="submit_complaint.php">
        <label>Description of the complaint:</label><br>
        <textarea name="description" required></textarea><br>
        <input type="submit" value="Submit Complaint">
    </form>
</body>

</html>