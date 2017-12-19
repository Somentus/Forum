<?php

function security($pdo) {
	$errors = [];

	if(isset($_POST['securitySubmit'])) {
		if(!empty($_POST['username'])) {
			$username = $_POST['username'];

			// Check if username already exists
			$usernameAlreadyExists = query($pdo, "SELECT * FROM users WHERE username = :username", ['username' => $username]);
			if(count($usernameAlreadyExists) >= 1) {
				$errors[] = "Username already exists.";
			} else {
				$newUsername = $username;
				$user = query($pdo, "SELECT * FROM users WHERE id = :id LIMIT 1", ['id' => $_SESSION['id']])[0];
				$oldUsername = $user['username'];

				if($oldUsername != $newUsername) {
					query($pdo, "UPDATE users SET username = :username WHERE id = :id", ['id' => $_SESSION['id'], 'username' => $newUsername]);
				}
				$errors[] = "Username succesfully changed to $newUsername.";
			}
		}

		if(!empty($_POST['email'])) {
			$unVerifiedEmail = $_POST['email'];

			// Check if emailaddress is valid
			if(!filter_var($unVerifiedEmail, FILTER_VALIDATE_EMAIL)) {
				$errors[] = "Please enter a valid email address." ;
			} else {
				$emailAlreadyExists = query($pdo, "SELECT * FROM users WHERE email = :email", ['email' => $unVerifiedEmail]);
				if(count($emailAlreadyExists) >= 1) {
					$errors[] = "Email address already exists." ;
				} else {
					$newEmail = $unVerifiedEmail;
					$user = query($pdo, "SELECT * FROM users WHERE id = :id LIMIT 1", ['id' => $_SESSION['id']])[0];
					$oldEmail = $user['email'];

					if($oldEmail != $newEmail) {
						query($pdo, "UPDATE users SET email = :email WHERE id = :id", ['id' => $_SESSION['id'], 'email' => $newEmail]);
					}
					$errors[] = "Emailaddress succesfully changed to $newEmail.";
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

				query($pdo, "UPDATE users SET password = :password WHERE id = :id", ['id' => $_SESSION['id'], 'password' => $password]);
				$errors[] = "Password succesfully changed.";
			}
		}
	}

	return $errors;
}

function profile($pdo) {
	$errors = [];

	if(isset($_POST['profileSubmit'])) {
		if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
			$replaced = processImage($pdo, $_FILES, $_SESSION['id']);
			if($replaced) {
				$errors[] = "Old profile picture succesfully replaced!";
			} else {
				$errors[] = "New profile picture succesfully uploaded!";
			}
		} else if($_FILES['image']['error'] == 1) {
			$errors[] = "File size is too big, please upload files smaller than 2MB!";
		}

		if(isset($_POST['bio']) && !empty($_POST['bio'])) {
			$bio = trim($_POST['bio']);
			$currentBio = query($pdo, "SELECT * FROM users WHERE id = :id", ['id' => $_SESSION['id']])[0]['bio'];
			if($bio != $currentBio) {
				query($pdo, "UPDATE users SET bio = :bio WHERE id = :id", ['id' => $_SESSION['id'], 'bio' => $bio]);
				$errors[] = "Bio succesfully changed.";
			}
		}

		if(isset($_POST['birthdate']) && !empty($_POST['birthdate'])) {
			query($pdo, "UPDATE users SET birth_date = :birth_date WHERE id = :id", ['id' => $_SESSION['id'], 'birth_date' => $_POST['birthdate']]);
			$errors[] = "Birthdate succesfully changed.";
		}
	}

	return $errors;
}

?>
