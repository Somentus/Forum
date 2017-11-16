<?php

session_start();

// Redirect if not admin
if(!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && isset($_SESSION['id']) && $_SESSION['is_admin'] == true)) {
	header('Location: /');
	exit();
}

require_once('includes/codes.php');

$errors = [];
if(isset($_POST['admin'])) {
	$errors = admin();
}

?>

<!DOCTYPE HTML>

<html lang="en">
<head>
	<meta charset="utf-8">

	<title>Admin</title>

	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<script src="js/scripts.js" type="text/javascript" ></script>
</head>

<body>

	<div id="adminLinks">
		<a href="admin/categories.php">Categories</a>
		<a href="admin/forums.php">Forums</a>
		<a href="admin/users.php">Users</a>
	</div>

</body>
</html>
