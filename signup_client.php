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
    $role = $_POST['role'];

    // Validation: Check for empty fields
    if (empty($full_name) || empty($email) || empty($password) || empty($username) || empty($role)) {
        $errorMsg = "Please fill out all required fields.";
    } else {
        // Insert data into the database
        $sql = "INSERT INTO users (full_name, email, password, username, phone_no, role)
                VALUES ('$full_name', '$email', '$password', '$username', '$phone_no', '$role')";
        
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
    <title>Sign Up </title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* Full page background (reuse the same background as the login page) */
        body {
            background: url('https://media.giphy.com/media/PXApia9fVviiWREDRq/giphy.gif') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            max-width: 600px; /* Increased width */
            width: 100%;
            padding: 60px; /* Increased padding */
            background-color: rgba(255, 255, 255, 0.75); /* Semi-transparent white background */
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15); /* Slightly larger shadow */
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2rem; /* Slightly larger heading */
            font-weight: bold;
        }

        label {
            font-size: 1rem;
            margin-bottom: 5px;
            display: block;
            font-weight: 600; /* Semi-bold text */
        }

        .container input[type="text"],
        .container input[type="email"],
        .container input[type="password"],
        .container input[type="tel"],
        .container select {
            width: 100%;
            padding: 14px; /* Increased padding for form fields */
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #ddd;
            font-size: 1.1rem; /* Slightly larger text */
            box-sizing: border-box;
        }

        .container input[type="submit"] {
            width: 100%;
            padding: 14px; /* Increase button size */
            background-color: #e83e8c; /* Pink button color */
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1.1rem; /* Slightly larger button text */
            cursor: pointer;
            font-weight: 600; /* Semi-bold text */
        }

        .container input[type="submit"]:hover {
            background-color: #d63384; /* Darker pink on hover */
        }

        .error, .success {
            text-align: center;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .error {
            color: red;
        }

        .success {
            color: green;
        }

    </style>
</head>
<body>

<div class="container">
    <h2>Sign up</h2>

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
        <!-- Hidden input for role set as "Freelancer" -->
        <input type="hidden" name="role" value="client">

        <label for="skills">Skills (comma-separated)</label>
        <input type="text" id="skills" name="skills" placeholder="Enter your skills">
        <input type="submit" value="Register">
    </form>
</div>

</body>
</html>
