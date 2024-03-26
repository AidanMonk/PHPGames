<?php session_start(); // Start the session at the very beginning ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="/PHPGames-main/public/assets/css/style.css">
    <script type = "text/javascript" src = "/PHPGames-main/public/assets/js/signup-onkeyup/fname-ajax.js"></script>
    <script type = "text/javascript" src = "/PHPGames-main/public/assets/js/signup-onkeyup/lname-ajax.js"></script>
    <script type = "text/javascript" src = "/PHPGames-main/public/assets/js/signup-onkeyup/uname-ajax.js"></script>
    <script type = "text/javascript" src = "/PHPGames-main/public/assets/js/signup-onkeyup/pcode1-ajax.js"></script>
    <script type = "text/javascript" src = "/PHPGames-main/public/assets/js/signup-onkeyup/pcode2-ajax.js"></script>

</head>
<body>

    <form id="signupForm" method="post" action="../../src/features/signup.php">
        <h2>Sign Up</h2>

        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName" required onkeyup="validateFirstName()">
        <div class="fname" id="firstNameMessage"></div>

        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName" required onkeyup="validateLastName()">
        <div class="lname" id="lastNameMessage"></div>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required onkeyup="validateUserName()">
        <div class="uname" id="usernameMessage"></div>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required onkeyup="validatePassword()">
        <div class="pcode1" id="passwordMessage"></div>

        <label for="confirmPassword">Confirm Password:</label>
        <input class="pcode2" type="password" id="confirmPassword" name="confirmPassword" required onkeyup="validateConfirmPassword(); validateConfirmPassword()">
        <div id="confirmPasswordMessage"></div>

        <button type="submit" name="action" value="register">Register</button>
		<button type ="submit" onclick="window.location ='signin-form.php'">Login</button>

    </form>
</body>
</html>
