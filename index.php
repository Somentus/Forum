<?php

session_start();

if($_SESSION['loggedin']) {
	echo $_SESSION['id'];
}

require_once('includes/html.php');

$navbar = navbar()

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

<?php echo $navbar ?>
  
</body>
</html>