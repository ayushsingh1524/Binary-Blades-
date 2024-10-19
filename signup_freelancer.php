<?php
// Database connection settings
$servername = "localhost"; // replace with your server name
$username = "root"; // replace with your database username
$password = ""; // replace with your database password
$dbname = "SyncWork"; // replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables for error handling
$errorMsg = '';
$successMsg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Ideally, you should hash the password
    $username = $_POST['username'];
    $phone_no = $_POST['phone_no'];
    $skills = $_POST['skills'];
    $role = "Freelancer"; // Set default role as Freelancer

    // Validation: Check for empty fields
    if (empty($full_name) || empty($email) || empty($password) || empty($username)) {
        $errorMsg = "Please fill out all required fields.";
    } else {
        // Insert data into the database
        $sql = "INSERT INTO users (full_name, email, password, username, phone_no, role, skills)
                VALUES ('$full_name', '$email', '$password', '$username', '$phone_no', '$role', '$skills')";
        
        if ($conn->query($sql) === TRUE) {
            $successMsg = "Registration successful!";
        } else {
            $errorMsg = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freelancer Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 50px;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .container input[type="text"],
        .container input[type="email"],
        .container input[type="password"],
        .container input[type="tel"],
        .container input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        .container input[type="submit"] {
            background-color: #28a745;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .container input[type="submit"]:hover {
            background-color: #218838;
        }
        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
        .success {
            color: green;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Register as Freelancer</h2>

    <!-- Display Error or Success Message -->
    <?php if ($errorMsg != ''): ?>
        <div class="error"><?php echo $errorMsg; ?></div>
    <?php endif; ?>

    <?php if ($successMsg != ''): ?>
        <div class="success"><?php echo $successMsg; ?></div>
    <?php endif; ?>

    <form action="register.php" method="POST">
        <label for="full_name">Full Name</label>
        <input type="text" id="full_name" name="full_name" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>

        <label for="phone_no">Phone Number</label>
        <input type="tel" id="phone_no" name="phone_no">

        <label for="skills">Skills (comma-separated)</label>
        <input type="text" id="skills" name="skills" placeholder="Enter your skills">

        <!-- Hidden input for role set as "Freelancer" -->
        <input type="hidden" name="role" value="Freelancer">

        <input type="submit" value="Register">
    </form>
</div>

</body>
</html>
