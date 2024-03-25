<?php
// Assuming you have a database connection setup commented out for brevity


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'register') {
    // Extract form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Initialize validation flag and error messages array
    $isValid = true;
    $errorMessages = [];

    // Validate input fields
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


    // Example for checking if the username exists in the database
    /*
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $isValid = false;
        $errorMessages[] = "Username already exists.";
    }
    */

    // If validation passes
    if ($isValid) {
        // Example for inserting user into the database
        /*
        $insertQuery = "INSERT INTO users (firstName, lastName, username, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("ssss", $firstName, $lastName, $username, $hashedPassword);
        $stmt->execute();
        */

        // Set session message and type
        $_SESSION['message'] = "Registration successful!";
        $_SESSION['message_type'] = 'success';
        // Redirect to form or success page as needed
        header('Location: signup-form.php');
        exit();
    } else {
        // Set session message for errors
        $_SESSION['message'] = implode("<br>", $errorMessages);
        $_SESSION['message_type'] = 'error';
        // Redirect back to the form to display the error messages
        header('Location: signup-form.php');
        exit();
    }
}
