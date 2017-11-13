<?php

session_start();

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true ) {
	echo $_SESSION['id'];
}

require_once('includes/html.php');
require_once('includes/codes.php');

$navbar = navbar();

$body = indexBody();

$loginErrors = login();
$registerErrors = register();

?>

<!DOCTYPE HTML>

<html lang="en">
<head>
	<meta charset="utf-8">

	<title>Functional Forum</title>

	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<script src="js/scripts.js" type="text/javascript" ></script>
</head>

<body>

	<?php echo $navbar ?>

	<?php echo $body ?>

	<div id="errors">
  		<?php
  			foreach($loginErrors as $error) {
  				echo $error."<br />";
  			}
  			foreach($registerErrors as $error) {
  				echo $error."<br />";
  			}
  		?>
  	</div>

  	<button name="toggleLogin" onclick="document.getElementById('loginWrapper').style.display='block'; document.getElementById('registerWrapper').style.display='none';">Login</button>
  	<button name="toggleRegister" onclick="document.getElementById('loginWrapper').style.display='none'; document.getElementById('registerWrapper').style.display='block';">Register</button>

  	<button name="loginTest" onclick="toggleLogin();" >Login Test</button>
  	<button name="registerTest" onclick="toggleRegister();" >Register Test</button>

  	<div id="loginWrapper">
		<form action="index.php" method="POST">
			<h3>Username:</h3>
			<input type="text" name="username" required/><p />

			<h3>Password:</h3>
			<input type="password" name="password" required/><p />

			<input type="submit" name="login" value="Login" /><p />
		</form>
  	</div>

  	<div id="registerWrapper" style="display:none">
	  	<form action="register.php" method="POST">
			<h3>Username:</h3>
			<input type="text" name="username" /><p />

			<h3>Email:</h3>
			<input type="email" name="email" /><p />

			<h3>Password:</h3>
			<input type="password" name="password" /><p />

			<input type="submit" name="register" value="Register" /><p />
		</form>
	</div>

</body>
</html>