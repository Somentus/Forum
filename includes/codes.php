<?php

function location($pdo) {
    foreach ($_GET as $key => $value) {
        if($key == "id") {
            $id = $value;
        }
    }

    $location = basename($_SERVER['PHP_SELF']);
    $currentFile = explode('.', $location)[0];

    switch($currentFile) {
        case 'forum':
            $forum_id = $id;
            $forum = query($pdo, "SELECT * FROM forums WHERE id = :id", ['id' => $forum_id])[0];
            $forum_name = $forum['name'];
            $category_id = $forum['category_id'];
            $category = query($pdo, "SELECT * FROM categories WHERE id = :id", ['id' => $category_id])[0];
            $category_name = $category['name'];

            $objectNames = [$category_name, $forum_name];
            $urls = ['index.php', 'forum.php?id='.$forum_id];           
            break;
        case 'topic':
            $topic_id = $id;
            $topic = query($pdo, "SELECT * FROM topics WHERE id = :id", ['id' => $topic_id])[0];
            $topic_title = $topic['title'];
            $forum_id = $topic['forum_id'];
            $forum = query($pdo, "SELECT * FROM forums WHERE id = :id", ['id' => $forum_id])[0];
            $forum_name = $forum['name'];
            $category_id = $forum['category_id'];
            $category = query($pdo, "SELECT * FROM categories WHERE id = :id", ['id' => $category_id])[0];
            $category_name = $category['name'];

            $objectNames = [$category_name, $forum_name, $topic_title];
            $urls = ['index.php', 'forum.php?id='.$forum_id, 'topic.php?id='.$topic_id];
            break;
        default:
            $currentFileCapitalised = ucfirst($currentFile);
            $objectNames = [$currentFileCapitalised];
            $urls = [$location];
            break;
    }

    $return = [$objectNames, $urls];
    return $return;
}

function navbar($pdo) {
    $location = location($pdo);
    $currentLocation = $location[0];
    $currentLocationFiles = $location[1];
    $locationSteps = count($currentLocation);

    echo '
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="index.php">Forum</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

            ';

    if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == true) {
    	echo '
    		<span class="navbar-text">|</span>
    		<li class="nav-item';
			if($currentLocation[0] == "Categories") {
				echo ' active';
			}
    		echo '" >
    			<a class="nav-link" href="./categories.php">Categories</a>
			</li>
			<span class="navbar-text">|</span>
			<li class="nav-item';

			if($currentLocation[0] == "Forums") {
				echo ' active';
			}

			echo '" >
				<a class="nav-link" href="./forums.php">Forums</a>
			</li>
		';
    } else {
	    for($i = 0; $i < $locationSteps; $i++) {
	        echo '
	            <span class="navbar-text">/</span>
	            <li class="nav-item';
	        if($i == $locationSteps - 1) {
	            echo ' active';
	        }
	        echo '"><a class="nav-link" href="'.$currentLocationFiles[$i].'">'.$currentLocation[$i].'
	                </a>
	            </li>
	        ';
	    } 
    }


    echo '</ul>';

    echo '<ul class="navbar-nav ml-auto">';

    // Check if user is logged in
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] == false)) {
        echo '
            <li class="nav-item">
                <a class="nav-link" href="#">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Log Out</a>
            </li>
        ';
    } else if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == false) {
    	// Placeholder. TODO
       	echo '
            <li class="nav-item">
                <a class="nav-link" href="#">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Log Out</a>
            </li>
        ';
    } else {
        echo '
            <li class="nav-item">
                <a id="navbarLogin" name="login" onclick="togglePortal(\'login\');" class="nav-link" >Login</a>
            </li>
            <li class="nav-item">
                <a id="navbarRegister" name="register" onclick="togglePortal(\'register\');" class="nav-link" >Register</a>
            </li>
            <li class="nav-item">
                <a id="navbarClose" name="closePortal" onclick="togglePortal(\'close\');" class="nav-link" >X</a>
            </li>';
    }

    echo '
            </ul>
        </div>
    </nav>
    ';

}

function portal($errors) {
	echo '
	<div id="errors">';
		foreach($errors as $error) {
			echo $error."<br />";
		}
  	echo '
  	</div>
	<div id="portal" class="portal" style="display:none;">
		<form action="index.php" method="POST">
			
			<div id="username" style="display:none">
				<h3>Username:</h3>
				<input id="usernameField" type="text" name="username" />
			</div>

			<h3>Email:</h3>
			<input type="email" name="email" required/>
			<br />

			<h3>Password:</h3>
			<input type="password" name="password" required/>
			<br />
			<br />

			<input id="submit" type="submit" name="login" value="Login" class="btn btn-primary" />
			<br />
		</form>
	</div>
	<br />
	';
}

function login($pdo) {
	$errors = [];

	if(isset($_POST['login'])) {
	    $email = $_POST['email'];
	    $password = $_POST['password'];

	    $user = query($pdo, "SELECT * FROM users WHERE email= :email", ['email' => $email]);
	    if(count($user) == 1) {
	        // User found
	        $user = $user[0];

	        $passwordHash = $user['password'];

	        if(password_verify($password, $passwordHash)) {
	            $_SESSION['loggedin'] = true;
	            $_SESSION['id'] = $user['id'];
	        	if($user['is_admin'] == true) {
	        		$_SESSION['is_admin'] = true;
		            header('location:admin/categories.php');
	        	} else {        		
		            header('location:index.php');
	        	}
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

function register($pdo) {
	$errors = [];

	if(isset($_POST['register'])) {
		$unVerifiedUsername = $_POST['username'];
		$unVerifiedEmail = $_POST['email'];
		$unVerifiedPassword = $_POST['password'];

		

		// Check if username already exists
		$usernameAlreadyExists = query($pdo, "SELECT * FROM users WHERE username= :username", ['username' => $unVerifiedUsername]);
		if(count($usernameAlreadyExists) >= 1) {
			$errors[] = "Username already exists.";
		} else {
			$username = $unVerifiedUsername;
		}

		// Check if emailaddress is valid
		if(!filter_var($unVerifiedEmail, FILTER_VALIDATE_EMAIL)) {
			$errors[] = "Please enter a valid email address." ;
		} else {
			$emailAlreadyExists = query($pdo, "SELECT * FROM users WHERE email= :email", ['email' => $unVerifiedEmail]);
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
			$query = query($pdo, "INSERT INTO users (id, username, email, password, created_at, updated_at) VALUES (:id, :username, :email, :password, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)", ['id' => NULL, 'username' => $username, 'email' => $email, 'password' => $password]);
			$errors[] = "User succesfully registered.";
		}
	}

	return $errors;
}

function body($pdo) {
	$categories = query($pdo, "SELECT * FROM categories");

	foreach($categories as $category) {
		echo "<div class='row border border-secondary'>";
			echo $category['name'];
			$forums = query($pdo, "SELECT * FROM forums WHERE category_id = :category_id", ['category_id' => $category['id']]);
			foreach($forums as $forum) {
				echo "
					<div class='col-md-12'>
						<div class='row border border-secondary border-left-0 border-right-0 border-bottom-0' >
							<div class='col-md-6'>
								<a href='forum.php?id=".$forum['id']."''>".$forum['name']."</a>
							</div>
							<div class='col-md-6'>";

				$lastPost = lastPost($pdo, $forum['id']);
				echo "<span class='float-right'>";
				if(!empty($lastPost)) {
					$lastPostUser = query($pdo, "SELECT * FROM users WHERE id = :user_id", ['user_id' => $lastPost['user_id']])[0];
					$lastPostTopic = query($pdo, "SELECT * FROM topics WHERE id = :topic_id", ['topic_id' => $lastPost['topic_id']])[0];	
					echo "
									<span class='float-right'>	
										<a href='topic.php?id=".$lastPostTopic['id']."'>".$lastPostTopic['title']."</a>
									</span>
									<br/>
									<span class='float-right'>
										<a href='user.php?id=".$lastPostUser['id']."'>".$lastPostUser['username']."</a> - ".parseTimeSinceTimestamp($lastPost['created_at'])."
									</span>";

				} else {
					echo "
									No posts yet.
					";
				}

				echo "
								</span>
							</div>
						</div>
					</div>";
			}
		echo "
			</div>
			<br />";
	}
}

function parseTimeSinceTimestamp($timestamp) {
	$timePast = strtotime($timestamp);
	$date = new DateTime();
	$date->setTimestamp($timePast);
	$interval = $date->diff(new DateTime('now'));

	$years = $interval->format('%y');
	$months = $interval->format('%m');
	$days = $interval->format('%d');
	$hours = $interval->format('%h');
	$minutes = $interval->format('%i');
	$seconds = $interval->format('%s');

	if($years > 0) {
		if($years == 1) {
			return $years." year ago";
		} else {
			return $years." years ago";
		}
	} else if($months > 0) {
		if($months == 1) {
			return $months." month ago";
		} else {
			return $months." months ago";
		}
	} else if($days > 0) {
		if($days == 1) {
			return $days." day ago";
		} else {
			return $days." days ago";
		}
	} else if($hours > 0){
		if($hours == 1) {
			return $hours." hour ago";
		} else {
			return $hours." hours ago";
		}
	} else if($minutes >= 5) {
		return $minutes." minutes ago";
	} else {
		return "just now";
	}
}

function lastPost($pdo, $forumId) {
	$lastPostId = query($pdo, "SELECT MAX(id) FROM posts WHERE topic_id IN (SELECT id FROM topics WHERE forum_id = :forum_id)", ['forum_id' => $forumId])[0]['MAX(id)'];
	$lastPost = query($pdo, "SELECT * FROM posts WHERE id = :id", ['id' => $lastPostId]);
	if(!empty($lastPost) ) {
		return $lastPost[0];	
	} else {
		return 0;
	}
}
