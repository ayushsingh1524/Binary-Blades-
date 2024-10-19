<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'freelancer') {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SyncWork";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_GET['project_id']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $project_id = $_GET['project_id'];
    $freelancer_id = $_SESSION['user_id'];
    $cover_letter = $_POST['cover_letter'];

    $stmt = $conn->prepare("INSERT INTO applications (project_id, freelancer_id, cover_letter) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $project_id, $freelancer_id, $cover_letter);
    $stmt->execute();
    $stmt->close();

    echo "Application submitted!";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Apply for Project</title>
</head>
<body>
    <h2>Apply for Project</h2>
    <form method="POST">
        <label>Cover Letter:</label>
        <textarea name="cover_letter" required></textarea><br>
        <button type="submit">Submit Application</button>
    </form>
</body>
</html>
