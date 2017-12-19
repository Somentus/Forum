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
					$user_id = $user['id'];
					query($pdo, "INSERT INTO old_usernames (user_id, username) VALUES (:user_id, :username)", ['user_id' => $user_id, 'username' => $oldUsername]);
					query($pdo, "UPDATE users SET username = :username WHERE id = :id", ['id' => $_SESSION['id'], 'username' => $newUsername]);

					$to = $user['email'];
					$subject = 'Username changed!';
					$message = '
					<!DOCTYPE HTML>

					<html lang="en">
					<head>
					  <meta charset="utf-8">
					  <title>'.$subject.'</title>
					</head>
					<body>
					  <p>Your username has been changed to: '.$newUsername.'.</p>
					</body>
					</html>
					';

					// To send HTML mail, the Content-type header must be set
					$headers[] = 'MIME-Version: 1.0';
					$headers[] = 'Content-type: text/html; charset=iso-8859-1';

					// Additional headers
					$headers[] = "To: ".$user['username']." <".$to.">";
					$headers[] = "From: Functional Forum <somentusforum@gmail.com>";

					// Mail it
					mail($to, $subject, $message, implode("\r\n", $headers));
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
						$user_id = $user['id'];
						query($pdo, "INSERT INTO old_emails (user_id, email) VALUES (:user_id, :email)", ['user_id' => $user_id, 'email' => $oldEmail]);
						query($pdo, "UPDATE users SET email = :email WHERE id = :id", ['id' => $_SESSION['id'], 'email' => $newEmail]);

						$to = $oldEmail;
						$subject = 'Email address changed!';
						$message = '
						<!DOCTYPE HTML>

						<html lang="en">
						<head>
						  <meta charset="utf-8">
						  <title>'.$subject.'</title>
						</head>
						<body>
						  <p>Your email address has been changed to: '.$newEmail.'.</p>
						</body>
						</html>
						';

						// To send HTML mail, the Content-type header must be set
						$headers[] = 'MIME-Version: 1.0';
						$headers[] = 'Content-type: text/html; charset=iso-8859-1';

						// Additional headers
						$headers[] = "To: ".$user['username']." <".$to.">";
						$headers[] = "From: Functional Forum <somentusforum@gmail.com>";

						// Mail it
						mail($to, $subject, $message, implode("\r\n", $headers));
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

				$user = query($pdo, "SELECT * FROM users WHERE id = :id", ['id' => $_SESSION['id']])[0];
				$oldPassword = $user['password'];
				$user_id = $user['id'];
				$email = $user['email'];

				query($pdo, "INSERT INTO old_passwords (user_id, password) VALUES (:user_id, :password)", ['user_id' => $user_id, 'password' => $oldPassword]);
				query($pdo, "UPDATE users SET password = :password WHERE id = :id", ['id' => $_SESSION['id'], 'password' => $password]);

				$to = $email;
				$subject = 'Password changed!';
				$message = '
				<!DOCTYPE HTML>

				<html lang="en">
				<head>
				  <meta charset="utf-8">
				  <title>'.$subject.'</title>
				</head>
				<body>
				  <p>Your password has been changed.</p>
				</body>
				</html>
				';

				// To send HTML mail, the Content-type header must be set
				$headers[] = 'MIME-Version: 1.0';
				$headers[] = 'Content-type: text/html; charset=iso-8859-1';

				// Additional headers
				$headers[] = "To: ".$user['username']." <".$to.">";
				$headers[] = "From: Functional Forum <somentusforum@gmail.com>";

				// Mail it
				mail($to, $subject, $message, implode("\r\n", $headers));

				// TODO: Send email to email address, store old password somewhere
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

function getUser($pdo, $id) {
	return query($pdo, "SELECT * FROM users WHERE id = :id", ['id' => $id])[0];
}

function getUsername($pdo) {
	return getUser($pdo, $_SESSION['id'])['username'];;
}

function getEmail($pdo) {
	return getUser($pdo, $_SESSION['id'])['email'];;
}

?>
