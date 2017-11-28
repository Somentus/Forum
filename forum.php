<?php

session_start();

require_once('includes/DB.php');
$pdo = DB();
require_once('includes/codes.php');
require_once('includes/forum.php');

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

	<div class="container">

		<br />
		<?php navbar($pdo); ?>
		<br />
	  	
		<?php content($pdo); ?>

	</div>

</body>
</html>
