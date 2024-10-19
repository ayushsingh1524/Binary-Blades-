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

// Fetch available projects
$query = "SELECT * FROM projects";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Freelancer Dashboard</title>
    <style>
        .btn { padding: 8px 12px; background-color: #28a745; color: white; text-decoration: none; }
    </style>
</head>
<body>
    <h1>Freelancer Dashboard</h1>
    <h2>Available Projects</h2>

    <table border="1">
        <tr>
            <th>Project Name</th>
            <th>Description</th>
            <th>Technologies</th>
            <th>Budget</th>
            <th>Deadline</th>
            <th>Action</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . $row['project_name'] . "</td>
                    <td>" . $row['description'] . "</td>
                    <td>" . $row['technologies'] . "</td>
                    <td>$" . $row['budget'] . "</td>
                    <td>" . $row['deadline'] . "</td>
                    <td><a href='apply.php?project_id=" . $row['project_id'] . "' class='btn'>Apply</a></td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No projects available at the moment.</td></tr>";
        }
        ?>
    </table>

    <a href="logout.php">Logout</a>
</body>
</html>

<?php $conn->close(); ?>
