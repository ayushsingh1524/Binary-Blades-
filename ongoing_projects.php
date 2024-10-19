<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SyncWork";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get current date to compare with project deadlines
$current_date = date("Y-m-d");

// Fetch ongoing projects (those with a deadline in the future)
$sql = "SELECT project_name, description, technologies, budget, deadline 
        FROM projects 
        WHERE deadline > ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $current_date);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ongoing Projects</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
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
            color: #333;
        }
        td {
            color: #555;
        }
        .no-projects {
            text-align: center;
            font-size: 18px;
            color: #888;
            padding: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Ongoing Projects</h1>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Project Name</th>
                    <th>Description</th>
                    <th>Technologies</th>
                    <th>Budget</th>
                    <th>Deadline</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['project_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                        <td><?php echo htmlspecialchars($row['technologies']); ?></td>
                        <td>$<?php echo number_format($row['budget'], 2); ?></td>
                        <td><?php echo htmlspecialchars($row['deadline']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="no-projects">
            <p>No ongoing projects at the moment.</p>
        </div>
    <?php endif; ?>

</div>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
