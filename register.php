<?php

$errors = [];

if(isset($_POST['submit'])) {
	$unVerifiedUsername = $_POST['username'];
	$unVerifiedEmail = $_POST['email'];
	$unVerifiedPassword = $_POST['password'];

	require_once('classes/Database.php');

	// Check if username already exists
	$usernameAlreadyExists = Database::query("SELECT * FROM users WHERE username= :username", ['username' => $unVerifiedUsername]);
	if(count($usernameAlreadyExists) >= 1) {
		$errors[] = "Username already exists.";
	} else {
		$username = $unVerifiedUsername;
	}

	// Check if emailaddress is valid
	if(!filter_var($unVerifiedEmail, FILTER_VALIDATE_EMAIL)) {
		$errors[] = "Please enter a valid email address." ;
	} else {
		$emailAlreadyExists = Database::query("SELECT * FROM users WHERE email= :email", ['email' => $unVerifiedEmail]);
		if(count($emailAlreadyExists) >= 1) {
			$errors[] = "Email address already exists." ;
		} else {
			$email = $unVerifiedEmail;
		}
	}

	// Hash password
	if(strlen($unVerifiedPassword) > 72 ) {
		$errors[] = "Password is too long. Please enter a password of 72 characters or fewer.";
	} else {
		// TODO Check if password is strong enough
		$password = password_hash($unVerifiedPassword, PASSWORD_DEFAULT);
	}

	// TODO: Captcha

	// If no errors, register user
	if (empty($errors)) {
		$query = Database::query("INSERT INTO users (id, username, email, password, created_at, updated_at) VALUES (:id, :username, :email, :password, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)", ['id' => NULL, 'username' => $username, 'email' => $email, 'password' => $password]);
		$errors[] = "User succesfully registered.";
	}
}

?>

<!DOCTYPE HTML>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Functional Forum</title>

  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
</head>

<body>
  <script src="js/scripts.js"></script>

  	<div id="errors">
  		<?php
  			foreach($errors as $error) {
  				echo $error."<br />";
  			}
  		?>
  	</div>
	<form action="register.php" method="POST">
		<h3>Username:</h3>
		<input type="text" name="username" /><p />

		<h3>Email:</h3>
		<input type="email" name="email" /><p />

		<h3>Password:</h3>
		<input type="password" name="password" /><p />

		<input type="submit" name="submit" value="Register" /><p />
	</form>

</body>
</html>