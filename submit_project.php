<?php
session_start();

error_reporting(E_ALL); // Enable error reporting for debugging
ini_set('display_errors', 1);

// Database connection (adjust credentials as per your environment)
$servername = "localhost";
$username = "root";
$password = ""; // Change if you have a password
$dbname = "syncwork"; // Database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If form is submitted, process the data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Retrieve and sanitize form inputs
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $skills_required = mysqli_real_escape_string($conn, $_POST['skills_required']);
    $repo_name = mysqli_real_escape_string($conn, $_POST['repoName']);
    
    // SQL query to insert form data into the 'projects' table
    $sql = "INSERT INTO projects (description, skills_required, repo_name, created_at) 
            VALUES ('$description', '$skills_required', '$repo_name', NOW())";
    
    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "<script type='text/javascript'>
                alert('Data Entry Successful!');
                window.location.href = 'current_ongoing.php';
              </script>";
    } else {
        echo "<script type='text/javascript'>
                alert('Error during data entry. Please try again.');
                window.location.href = 'client_dashboard.php';
              </script>";
    }

    // Close the connection
    $conn->close();
}
?>
