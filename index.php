<?php

session_start();

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true ) {
	echo $_SESSION['id'];
}

require_once('includes/html.php');
require_once('includes/codes.php');

$navbar = navbar();

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

	<?php body(); ?>

</body>
</html>