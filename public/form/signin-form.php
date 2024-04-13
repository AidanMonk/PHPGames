<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PHPGames-main/public/assets/css/design.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<title>Sign In</title>

</head>
<body>


	<form id="signinForm" method="post" action="../../src/features/signin.php">		
		<?php if (isset($_SESSION['signin-errorMessages'])): ?>
    		<div style="color: red;">
        	<?php 
        	#echo htmlspecialchars($_SESSION['signin-errorMessages']);
        	unset($_SESSION['signin-errorMessages']); // Clear the error message after displaying it
        ?>
    		</div>
			<?php endif; 
		?>
		<!--
		<div class="wrapper">
		<form action="">

			<div class="input-box">
				<input type="text" placeholder="Username"
				required>
				<box-icon type='solid' name='user'></box-icon>
			</div>
			<div class="input-box">
				<input type="password" placeholder="Password"
				required>
				<box-icon name='lock-alt' type='solid' ></box-icon>
			</div>

			<div class="remember-forgot">
				<label><input type="checkbox"> Remember Me</label>
				<a href="#">Forgot password?</a>
			</div>
			<button type="submit" class="btn">Login</button>
			<div class="register-link">
				<p>Don't have an account? <a href="signup-form.php">Register</a></p>
			</div>
		</form>
		</div>
		-->
		<div class="wrapper">
			<h1>Login</h1>
			<div class="input-box">
			<input type="text" id="username" name = "username" placeholder="Username"><br>
			</div>

			<div class="input-box">
			<input type="password" id="password" name = "password" placeholder="Password"><br>
			</div>

			<div class="input-box">
			<button type ="submit" class="btn">Login</button>
			</div>

			<div class="register-link">
				<p>Don't have an account? <a href="signup-form.php">Register</a></p>
			</div>
		</div>

		
	</form>
</body>
</html>
