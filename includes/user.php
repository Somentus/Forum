<?php

function security($pdo) {
	$errors = [];

	if(isset($_POST['securitySubmit'])) {
		if(!empty($_POST['email'])) {
			$unVerifiedEmail = $_POST['email'];

			// Check if emailaddress is valid
			if(!filter_var($unVerifiedEmail, FILTER_VALIDATE_EMAIL)) {
				$errors[] = "Please enter a valid email address." ;
			} else {
				$emailAlreadyExists = query($pdo, "SELECT * FROM users WHERE email= :email", ['email' => $unVerifiedEmail]);
				if(count($emailAlreadyExists) >= 1) {
					$errors[] = "Email address already exists." ;
				} else {
					$newEmail = $unVerifiedEmail;
					$user = query($pdo, "SELECT * FROM users WHERE id = :id LIMIT 1", ['id' => $_SESSION['id']])[0];
					$oldEmail = $user['email'];

					if($oldEmail != $newEmail) {
						query($pdo, "UPDATE users SET email = :email WHERE id= :id", ['id' => $_SESSION['id'], 'email' => $newEmail]);
						$errors[] = "Emailaddress succesfully changed to $newEmail.";
					} else {
						$errors[] = "Emailaddress succesfully changed to $newEmail.";
					}
				}
			}
		}

		if(!empty($_POST['password'])) {
			$unVerifiedPassword = $_POST['password'];

			// Hash password
			if(strlen($unVerifiedPassword) > 72 ) {
				$errors[] = "Password is too long. Please enter a password of 72 characters or fewer.";
			} else {
				// TODO Check if password is strong enough
				$password = password_hash($unVerifiedPassword, PASSWORD_DEFAULT);

				query($pdo, "UPDATE users SET password = :password WHERE id= :id", ['id' => $_SESSION['id'], 'password' => $password]);
				$errors[] = "Password succesfully changed.";
			}
		}
	}

	return $errors;
}

?>
