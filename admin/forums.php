<?php

session_start();

require_once($_SERVER["DOCUMENT_ROOT"].'/includes/DB.php');
$pdo = DB();
require_once($_SERVER["DOCUMENT_ROOT"].'/includes/admin.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/includes/codes.php');

// Redirect if not admin
if(!isLoggedIn(true)) {
	header('Location: /');
	exit();
}

$errors = [];
if(isset($_POST['add']) || isset($_POST['delete']) || isset($_POST['priority'])) {
	$errors = forums($pdo);
}

?>

<!DOCTYPE HTML>

<html lang="en">
<head>
	<meta charset="utf-8">

	<title>Admin - Forums</title>

	<link rel="stylesheet" href="/css/main.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<script src="/js/scripts.js" type="text/javascript" ></script>
</head>

<body>

	<div>
		<?php navbar($pdo); ?>
	</div>

	<br />

	<div class="container">
		<div id="errors">
			<?php
				foreach($errors as $error) {
					echo $error."<br />";
				}
			?>
			<br />
	  	</div>
	</div>

	<?php adminForums($pdo); ?>

</body>
</html>
