<?php
session_start();

// Check if the user cleared level 5
if (!isset($_SESSION['level']) || $_SESSION['level'] < 6) {
    // Redirect user to level 5 if they haven't cleared it yet
    header("Location: level5_form.php");
    exit();
}

// Define the instruction for level 6
$instruction = "Identify the largest and smallest numbers in the set:";

// Generate random numbers for the game (you can define your own numbers)
$randomNumbers = array(10, 20, 30, 40, 50, 60);

// Display the game form for level 6
echo "<h1>Level 6</h1>";
echo "<h2>Lives " . $_SESSION['lives']. "</h2>";
echo "<p>Identify the largest and smallest numbers in the set:</p>";
echo "<p>Numbers: " . implode(", ", $randomNumbers) . "</p>";



// Display the form for user input
echo "<form method='post'>";
echo "<label for='user_input'>Your Answer:</label>";
echo "<input type='text' id='user_input' name='user_input'>";
echo "<button type='submit'>Submit</button>";
echo "</form>";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check user input and process accordingly
    $userInput = $_POST['user_input'];
    // Validate user input and check if it's correct
    if (validateUserInput($userInput, $randomNumbers)) {
        // User input is correct
        echo "<script> 

        alert('Congratulations your responses were correct & You have cleared the complete game with remaining lives: " . $_SESSION['lives'] . "');         
        window.location.href='game.php';       
        </script>";
       // header("Location: game.php"); // Redirect to the next level

        // You can perform any other action here, like redirecting to a completion page
    } else {
        // User input is incorrect
        echo "<p>Incorrect answer. Please try again.</p>";
        // Decrease the number of lives
    $_SESSION['lives']--;
    // Check if the user has any lives left
    if ($_SESSION['lives'] == 0) {
        // Game over, redirect to a game over page
        echo "<script>         
        alert('Game Over!! You have used all the opportunities. Please try again with a new game');         
        window.location.href='game.php';       
        </script>";
        exit();
        
    }
    else {
        echo "<script>         
        alert('Incorrect – Your numbers were not correctly arranged in largest and smallest order.');         
        window.location.href='level6_form.php';       </script>";
    }
    }
     
}

// Function to validate user input for level 6
function validateUserInput($userInput, $randomNumbers) {
    // Split user input into an array and remove any whitespace
    $userNumbers = array_map('trim', explode(",", $userInput));
    
    // Convert user input to integers
    $userNumbers = array_map('intval', $userNumbers);
    
    // Check if both the largest and smallest numbers are present in user input
    $largest = max($randomNumbers);
    $smallest = min($randomNumbers);
    
    if (in_array($largest, $userNumbers) && in_array($smallest, $userNumbers)) {
        // User input is correct
        return true;
    } else {
        // User input is incorrect
        return false;
    }
}
?>
