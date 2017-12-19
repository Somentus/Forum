<?php

function resetPassword($pdo) {
	$errors = [];

	if(isset($_POST['resetPassword'])) {
		$email = $_POST['email'];
		$username = $_POST['username'];

		if(!empty($email)) {
			$emailUser = query($pdo, "SELECT * FROM users WHERE email = :email", ['email' => $email]);
			if(count($emailUser) == 1) {
				$emailUser = $emailUser[0];
			} else {
				$errors[] = "No user found with that email address.";
			}
		}


		if(!empty($username)) {
			$usernameUser = query($pdo, "SELECT * FROM users WHERE username = :username", ['username' => $username]);
			if(count($usernameUser) == 1) {
				$usernameUser = $usernameUser[0];
			} else {
				$errors[] = "No user found with that username.";
			}
		}

		if(!empty($email) && !empty($username)) {
			if($emailUser['id'] == $usernameUser['id']) {
				$user = $emailUser;
				// TODO: Email user with a link to reset their password.
			} else {
				$errors[] = "That username does not belong to that email address.";
			}
		}
	}

	return $errors;
}

?>
