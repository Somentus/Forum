<?php

session_start();

if($_SESSION['loggedin']) {
	echo $_SESSION['id'];
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

  <div id="navbar">
  	<a href="register.php">Register</a>
  	<a href="login.php">Login</a>
  </div>

  <h1>Hi there!</h1>
</body>
</html>