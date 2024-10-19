<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SyncWork";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $phone_number = $_POST['phone_number'];
    $skills = $_POST['skills'];

    $stmt = $conn->prepare("INSERT INTO users (full_name, email, password, role, phone_number, skills) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $full_name, $email, $password, $role, $phone_number, $skills);
    $stmt->execute();
    $stmt->close();
    echo "Registration successful!";
}
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form method="POST">
        <label>Full Name:</label>
        <input type="text" name="full_name" required><br>
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <label>Role:</label>
        <select name="role" required>
            <option value="client">Client</option>
            <option value="freelancer">Freelancer</option>
        </select><br>
        <label>Phone Number:</label>
        <input type="text" name="phone_number"><br>
        <label>Skills (for freelancers):</label>
        <input type="text" name="skills"><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
