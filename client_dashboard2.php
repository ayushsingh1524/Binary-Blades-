<?php
// Start session and check if user is a client
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'client') {
    header("Location: login.php"); // Redirect to login page if not a client
    exit();
}

// Database connection
$servername = "localhost"; // Replace with your server details
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "SyncWork"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch projects created by the client
$client_id = $_SESSION['user_id']; // Assuming client's user ID is stored in session
$query = "SELECT projects.project_id, projects.project_name, users.full_name, applications.application_id, applications.status, applications.message 
          FROM applications
          INNER JOIN projects ON applications.project_id = projects.project_id
          INNER JOIN users ON applications.freelancer_id = users.user_id
          WHERE projects.client_id = '$client_id' AND applications.status = 'pending'";
$result = $conn->query($query);

// Handle accept or reject actions
if (isset($_POST['action']) && isset($_POST['application_id'])) {
    $application_id = $_POST['application_id'];
    $action = $_POST['action'];

    if ($action == 'accept') {
        $update_query = "UPDATE applications SET status = 'accepted' WHERE application_id = '$application_id'";
        $conn->query($update_query);
    } elseif ($action == 'reject') {
        $update_query = "UPDATE applications SET status = 'rejected' WHERE application_id = '$application_id'";
        $conn->query($update_query);
    }

    // Reload the page after the action
    header("Location: client_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard - Review Applications</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .btn {
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 4px;
            color: white;
            cursor: pointer;
        }
        .accept-btn {
            background-color: #28a745;
        }
        .reject-btn {
            background-color: #dc3545;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Review Applications</h1>
    
    <table>
        <thead>
            <tr>
                <th>Project Name</th>
                <th>Freelancer Name</th>
                <th>Message</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . $row['project_name'] . "</td>
                        <td>" . $row['full_name'] . "</td>
                        <td>" . $row['message'] . "</td>
                        <td>" . ucfirst($row['status']) . "</td>
                        <td>
                            <form action='client_dashboard.php' method='POST' style='display:inline;'>
                                <input type='hidden' name='application_id' value='" . $row['application_id'] . "'>
                                <button type='submit' name='action' value='accept' class='btn accept-btn'>Accept</button>
                                <button type='submit' name='action' value='reject' class='btn reject-btn'>Reject</button>
                            </form>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No applications to review at the moment.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php
$conn->close();
?>
