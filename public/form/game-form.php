<?php
require_once '../../src/features/session-timeout.php';


// Check if the Start button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['start_game'])) {
    // Redirect to level 1 to start the game
    $_SESSION['level'] = 1;
    $_SESSION['lives'] = 3; // Set initial number of lives

    header("Location: level1_form.php");
exit();
}


  /*  // Initialize the lives if it's a new session
if (!isset($_SESSION['lives'])) {
}
} else {
    
    // Decrease the number of lives
    $_SESSION['lives']--;
    // Check if the user has any lives left
    if ($_SESSION['lives'] == 0) {
        // Game over, redirect to a game over page
        header("Location: game.php");
        exit();

    }
}*/

// Initialize message variable
$message = "";

// Check if there's a game result message
if (isset($_SESSION['game_result'])) {
    switch ($_SESSION['game_result']) {
        case 'win':
            $message = "Congratulations! You've successfully completed all levels.";
            break;
        case 'game_over':
            $message = "Game over. You've exhausted all lives. Try again.";
            break;
        case 'incomplete':
            $message = "Game incomplete. You've abandoned the game.";
            break;
        default:
            $message = "Unknown game result.";
            break;
    }
    unset($_SESSION['game_result']); // Clear the session variable after displaying the message
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Welcome to the Game!</h2>
        <!-- Start button to begin the game -->
        <form method="post">
            <button type="submit" name="start_game">Start Game</button>
        </form>
        <!-- Display game result message -->
        <?php if (!empty($message)) : ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
    </div>
	<!--This signout link should be inside a navigator section for now leave it as it is-->
    <br/>
	<a href="../../src/features/signout.php">signout</a>
</body>
</html>
