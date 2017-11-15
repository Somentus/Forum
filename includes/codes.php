<?php

require_once('classes/database.php');

function login() {
	$errors = [];

	if(isset($_POST['login'])) {
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
	            $errors[] = "User not found or password incorrect.";
	        }
	    } else {
	    	$errors[] = "User not found or password incorrect.";
	    }
	}

	return $errors;
}

function register() {
	$errors = [];

	if(isset($_POST['register'])) {
		$unVerifiedUsername = $_POST['username'];
		$unVerifiedEmail = $_POST['email'];
		$unVerifiedPassword = $_POST['password'];

		require_once('classes/Database.php');

		// Check if username already exists
		$usernameAlreadyExists = Database::query("SELECT * FROM users WHERE username= :username", ['username' => $unVerifiedUsername]);
		if(count($usernameAlreadyExists) >= 1) {
			$errors[] = "Username already exists.";
		} else {
			$username = $unVerifiedUsername;
		}

		// Check if emailaddress is valid
		if(!filter_var($unVerifiedEmail, FILTER_VALIDATE_EMAIL)) {
			$errors[] = "Please enter a valid email address." ;
		} else {
			$emailAlreadyExists = Database::query("SELECT * FROM users WHERE email= :email", ['email' => $unVerifiedEmail]);
			if(count($emailAlreadyExists) >= 1) {
				$errors[] = "Email address already exists." ;
			} else {
				$email = $unVerifiedEmail;
			}
		}

		// Hash password
		if(strlen($unVerifiedPassword) > 72 ) {
			$errors[] = "Password is too long. Please enter a password of 72 characters or fewer.";
		} else {
			// TODO Check if password is strong enough
			$password = password_hash($unVerifiedPassword, PASSWORD_DEFAULT);
		}

		// TODO: Captcha

		// If no errors, register user
		if (empty($errors)) {
			$query = Database::query("INSERT INTO users (id, username, email, password, created_at, updated_at) VALUES (:id, :username, :email, :password, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)", ['id' => NULL, 'username' => $username, 'email' => $email, 'password' => $password]);
			$errors[] = "User succesfully registered.";
		}
	}

	return $errors;
}

function body() {
	echo '
	<div id="portal" style="display:none">
		<form action="index.php" method="POST">
			<h3>Username:</h3>
			<input type="text" name="username" required/>
			<br/>

			<div id="email" style="display:none">
				<h3>Email:</h3>
				<input id="email" type="email" name="email" />
			</div>
			<br/>

			<h3>Password:</h3>
			<input type="password" name="password" required/>
			<br/>

			<input id="submit" type="submit" name="login" value="Login" />
			<br/>
		</form>
	</div>
	';
}