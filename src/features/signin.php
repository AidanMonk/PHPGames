
<?php
session_start(); // Start or resume a session

//require 'FINAL PROJECT-PHP/db/baseversion'; // Adjust this path to your database connection script
require '/PHPGames-main/db/Database.php'; // Adjust this path to your database connection script

$errorMessages = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'login') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Replace the SQL query and password verification according to your database schema and security practices
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Assume password_verify for hashed passwords; adjust if necessary
        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = $username; // Store username in session
            header("Location: level1.php"); // Redirect to Level 1 of the game
            exit();
        } else {
            $errorMessages[] = "Sorry, the username or password is incorrect!";
        }
    } else {
        $errorMessages[] = "Sorry, the username or password is incorrect!";
    }
    
    // If execution reaches here, authentication failed
    $_SESSION['signin_errors'] = $errorMessages;
    $_SESSION['attempted_username'] = $username; // Store attempted username for repopulation
    header("Location: signin-form.php"); // Redirect back to the sign-in form
    exit();
}

// Include database connection script here if needed

