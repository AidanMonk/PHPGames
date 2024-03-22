<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/PHPGames-main/public/assets/css/style.css">
	<title>Sign In</title>

</head>
<body>

	<div id="errorMessages"></div> 
	
	<form id="signinForm" method="post">
		<h2>Sign In</h2>
		
		<label for="username">Username:</label>
		<input type="text" id="username" name = "username" required><br>

		<label for="password">Password:</label>
		<input type="password" id="password" name = "password" required><br>

		<button type ="submit">Login</button>
		<button type="submit" onclick="window.location.href='signup-form.php';">Register</button>

	</form>



</body>
</html>