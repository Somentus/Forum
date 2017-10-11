<?php

$errors = [];

if(isset($_POST['submit'])) {
	$unVerifiedUsername = $_POST['username'];
	$unVerifiedEmail = $_POST['email'];
	$unVerifiedPassword = $_POST['password'];

	require_once('classes/Database.php');

	// Check if username already exists
	$query = Database::query("SELECT * FROM users WHERE username= :username", ['username' => $unVerifiedUsername]);
	if(sizeof($query) >= 1) {
		$errors[] = "Username already exists.";
	}

	// Check if emailaddress is valid
	if(!filter_var($unVerifiedEmail, FILTER_VALIDATE_EMAIL)) {
		$errors[] = "Please enter a valid email address." ;
	}

	// TODO
	// Check if password is strong enough

}

?>

<!DOCTYPE HTML>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Functional Forum</title>

  <link rel="stylesheet" href="css/main.css">
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
		<input type="text" name="username" /><p />
		<input type="email" name="email" /><p />
		<input type="password" name="password" /><p />

		<input type="submit" name="submit" value="Register" /><p />
	</form>

</body>
</html>