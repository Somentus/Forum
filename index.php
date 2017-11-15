<?php

session_start();

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true ) {
	echo $_SESSION['id'];
	$bodyType = "forum";
} else {
	$bodyType = "portal";
}

require_once('includes/codes.php');

$navbar = navbar();

$errors = [];
if(isset($_POST['login'])) {
	$errors = login();
} else if (isset($_POST['register'])) {
	$errors = register();
}

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

	<div id="errors">
		<?php
			foreach($errors as $error) {
				echo $error."<br />";
			}
		?>
  	</div>

	<?php body($bodyType); ?>

</body>
</html>
