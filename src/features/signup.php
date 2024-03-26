<?php

require_once "../../db/Database.php"; // Correct the path as needed
require_once "../../db/Insert.php"; // Correct the path as needed
require_once "../../config.php"; // Correct the path as needed


session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'register') {
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']); // Assuming direct use without hashing
    $confirmPassword = trim($_POST['confirmPassword']);
    $registrationTime = date('Y-m-d H:i:s'); // Current timestamp

    $isValid = true;
    $errorMessages = [];

    if (empty($firstName) || empty($lastName) || empty($username) || empty($password) || empty($confirmPassword)) {
        $isValid = false;
        $errorMessages[] = "All fields are required.";
    }

    if (!preg_match("/^[a-zA-Z]/", $firstName) || !preg_match("/^[a-zA-Z]/", $lastName) || !preg_match("/^[a-zA-Z]/", $username)) {
        $isValid = false;
        $errorMessages[] = "First Name, Last Name, and Username must begin with a letter.";
    }

    if (strlen($username) < 8 || strlen($password) < 8) {
        $isValid = false;
        $errorMessages[] = "Username and Password must contain at least 8 characters.";
    }

    if ($password !== $confirmPassword) {
        $isValid = false;
        $errorMessages[] = "Passwords do not match.";
    }

    $database = new Database();
    $conn = $database->getConnection();

    if ($conn === null) {
        die('Database connection failed');
    }

    // Check if the username already exists
    $stmt = $conn->prepare("SELECT COUNT(*) as cnt FROM player WHERE userName = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if ($result['cnt'] > 0) {
        $isValid = false;
        $errorMessages[] = "Username already exists.";
    }

    if ($isValid) {
        // Use the Insert class to insert the data into the database
        new Insert('insertIdentity', $firstName, $lastName, $username, $registrationTime, '', '', '', '');

        // Assuming the Insert operation is successful
        $_SESSION['message'] = "Registration successful!";
        $_SESSION['message_type'] = 'success';

        header('Location: ../../index.php');
        exit;
    } else {
        $_SESSION['message'] = implode("<br>", $errorMessages);
        $_SESSION['message_type'] = 'error';
        header('Location: ../../public/form/signup-form.php');
        exit;
    }
}
