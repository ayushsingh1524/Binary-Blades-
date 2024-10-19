<?php
session_start();

// Check if session variables are set
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'Guest';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard</title>
    <style>/* General Styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #6B73FF 10%, #000DFF 100%);
            color: #fff;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }
        
        .container {
            background-color: #22254b;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.5);
            width: 500px;
            animation: slideIn 1s ease-out;
            position: relative;
            overflow: hidden;
        }
        
        .container:before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(#6B73FF, #22254b);
            animation: rotateGradient 5s infinite linear;
            z-index: -1;
        }
        
        @keyframes slideIn {
            from {
                transform: translateY(50%);
                opacity: 0;
            }
            to {
                transform: translateY(0%);
                opacity: 1;
            }
        }
        
        @keyframes rotateGradient {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
        
        h1 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 2.5rem;
            color: #F5A623;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }
        
        label {
            font-size: 1.1rem;
            font-weight: 500;
            margin-bottom: 8px;
            display: block;
        }
        
        input[type="text"],
        textarea {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            border: none;
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
            font-size: 1rem;
            box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }
        
        input[type="text"]:focus,
        textarea:focus {
            outline: none;
            background-color: rgba(255, 255, 255, 0.15);
            box-shadow: inset 0 2px 10px rgba(0, 0, 0, 0.3);
        }
        
        textarea {
            resize: none;
            height: 100px;
        }
        
        button {
            background-color: #F5A623;
            border: none;
            padding: 12px;
            width: 100%;
            color: #fff;
            font-size: 1.2rem;
            border-radius: 12px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s;
            margin-top: 15px;
        }
        
        button:hover {
            background-color: #ffa51f;
            transform: translateY(-3px);
        }
        
        button:active {
            transform: translateY(0px);
        }
        
        button:focus {
            outline: none;
        }

        /* Styling for the top right corner where the username and role are displayed */
        .user-info {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #F5A623;
            font-size: 1rem;
            text-align: right;
        }

        @media (max-width: 768px) {
            .container {
                width: 90%;
            }
        
            h1 {
                font-size: 2rem;
            }
        }
        </style>
</head>
<body>
    <!-- Display user info in the top right corner -->
    <div class="user-info">
        <p>Logged in as: <strong><?php echo $username; ?></strong></p>
        <p>Role: <strong><?php echo $role; ?></strong></p>
    </div>
    <div class="container">
    <h1>Client Dashboard</h1>
    <form action="" method="POST">
        <div class="form-group">
            <label for="projectName">Project Name:</label>
            <input type="text" id="projectName" name="project_name" placeholder="Enter project name" required>
        </div>
        <div class="form-group">
            <label for="description">Project Description:</label>
            <textarea id="description" name="description" rows="4" placeholder="Enter project details..." required></textarea>
        </div>
        <div class="form-group">
            <label for="skills_required">Technologies (comma separated):</label>
            <textarea id="skills_required" name="technologies" rows="4" cols="50" required></textarea>
        </div>
        <div class="form-group">
            <label for="budget">Budget:</label>
            <input type="number" id="budget" name="budget" placeholder="Enter project budget" required>
        </div>
        <div class="form-group">
            <label for="deadline">Deadline:</label>
            <input type="date" id="deadline" name="deadline" required>
        </div>
        <button type="submit">Submit Project</button>
    </form>
</div>
<div class="container">
    <a href="current_ongoing.php"><h2>Go to Your Ongoing Projects</h2></a>
</div>
</body>
</html>
