<?php

session_start();


require_once('classes/Database.php');
require_once('includes/html.php');
require_once('includes/codes.php');

$navbar = navbar();

$errors = login();

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

    <?php echo $navbar ?>

    <div id="errors">
  		<?php
  			foreach($errors as $error) {
  				echo $error."<br />";
  			}
  		?>
  	</div>
	<form action="login.php" method="POST">
		<h3>Username:</h3>
		<input type="text" name="username" required/><p />

		<h3>Password:</h3>
		<input type="password" name="password" required/><p />

		<input type="submit" name="submit" value="Register" /><p />
	</form>

</body>
</html>