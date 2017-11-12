<?php

session_start();


require_once('includes/html.php');
require_once('classes/Database.php');

$navbar = navbar();

$errors = [];

if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = Database::query("SELECT * FROM users WHERE username= :username", ['username' => $username]);
    if(count($user) == 1) {
        // User found
        $user = $user[0];

        $passwordHash = $user['password'];
        if(password_verify($password, $passwordHash)) {
            // Correct password
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $user['id'];
            header('location:index.php');
            exit();

        } else {
            // TODO: After X tries, wait Y seconds before you can retry logging in to prevent spamming
            $errors[] = "Incorrect password!";
        }
    }
}

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