<?php
session_start();

// Check if the user cleared level 4
if (!isset($_SESSION['level']) || $_SESSION['level'] < 5) {
    // Redirect user to level 4 if they haven't cleared it yet
    header("Location: level4_form.php");
    exit();
}

// Define the instruction for level 5
$instruction = "Identify the smallest and largest numbers in the set:";

// Generate random numbers for the game
$randomNumbers = array(42, 87, 3, 95, 31, 97);


?>
<style>
    body {
        background-image: url('images/tiger.jpg'); /* Update this with the actual path to your image */
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }
</style>
<?php

require_once '../../public/template/head.php'; 
require_once '../../public/template/header.php'; 

echo "<title>Level 5</title>";
echo "<div style='background: rgba(255, 255, 255, 0.8); padding: 20px; border-radius: 10px; text-align: center;'>";
echo "<h1 style='color: #333; font-size: 2em; text-shadow: 1px 1px 2px rgba(0,0,0,0.7);'>Level 5</h1>";
echo "<h2 style='color: #555; font-size: 1.5em; text-shadow: 1px 1px 2px rgba(0,0,0,0.5);'>Lives " . $_SESSION['lives'] . "</h2>";
echo "<p style='font-size: 1.2em;'>Identify the smallest and largest numbers in the set:</p>";
echo "<p style='font-size: 1.2em; font-weight: bold;'>Numbers: " . implode(", ", $randomNumbers) . "</p>";

// Display the form for user input
echo "<form method='post' style='margin-top: 20px;'>";
echo "<label for='user_input' style='display: block; font-size: 1.2em;'>Your Answer:</label>";
echo "<input type='text' id='user_input' name='user_input' style='font-size: 1.2em; margin-bottom: 10px; width: 100%; padding: 5px;'>";
echo "<button type='submit' style='font-size: 1.2em; padding: 10px 20px; margin-top: 5px;'>Submit</button>";
echo "</form>";
echo "</div>";

require_once '../../public/template/footer.php'; 
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check user input and process accordingly
    $userInput = $_POST['user_input'];
    // Validate user input and check if it's correct
    if (validateUserInput($userInput, $randomNumbers)) {
        // User input is correct
        echo "<p>Congratulations! Your answer is correct.</p>";
        // Move to the next level if needed
        header("Location: level6_form.php"); // Redirect to the next level

    } else {
        // User input is incorrect
        echo "<p>Incorrect answer. Please try again.</p>";
        // Decrease the number of lives
    $_SESSION['lives']--;
    // Check if the user has any lives left
    if ($_SESSION['lives'] == 0) {
        // Game over, redirect to a game over page
        echo "<script>         
        alert('Game Over!! You have used all the opportunities. Please try again with a new game ');         
        window.location.href='game-form.php';       
        </script>";        
        exit();
        
    }
    else {
        echo "<script>         
        alert('Incorrect – Your numbers were not correctly arranged in smallest and largest order.');         
        window.location.href='level5_form.php';       </script>";
    }
    }
    
}

// Function to validate user input for level 5
function validateUserInput($userInput, $randomNumbers) {
    // Split user input into an array and remove any whitespace
    $userNumbers = array_map('trim', explode(",", $userInput));
    
    // Convert user input to integers
    $userNumbers = array_map('intval', $userNumbers);
    
    // Check if both the smallest and largest numbers are present in user input
    $smallest = min($randomNumbers);
    $largest = max($randomNumbers);
    
    if (in_array($smallest, $userNumbers) && in_array($largest, $userNumbers)) {
        // User input is correct
        $_SESSION['level'] = 6; // Set the level to 6
        header("Location: level6_form.php"); // Redirect to level 6
        exit();
    } else {
        // User input is incorrect
        return false;
    }
}

?>