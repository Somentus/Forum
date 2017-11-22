<?php

function navbar() {
	if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true ) {
		// Return navbar for logged in user
		// TODO: Add navbar for logged in user
		return '
		<div id="navbar">
			<form action="logout.php" method="POST" >
    			<input type="submit" name="logout" value="Log Out" />
			</form>
	  	</div>';
	} else {
		// Return navbar for guest
		return '
		<div id="navbar">
	  		<button id="navbarLogin" name="login" onclick="togglePortal(\'login\');" class="btn btn-secondary" >Login</button>
		  	<button id="navbarRegister"name="register" onclick="togglePortal(\'register\');" class="btn btn-secondary" >Register</button>
		  	<button id="navbarClose"name="closePortal" onclick="togglePortal(\'close\');" class="btn btn-light" >X</button>
	  	</div>';
	}
}

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

function body($type) {
	if($type == "portal") {
		echo '
		<div id="portal" style="display:none">
			<form action="index.php" method="POST">
				<h3>Username:</h3>
				<input type="text" name="username" required/>
				<br />

				<div id="email" style="display:none">
					<h3>Email:</h3>
					<input id="email" type="email" name="email" />
				</div>
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

	if($type == "portal" || $type == "forum") {
		$categories = Database::query("SELECT * FROM categories");

		foreach($categories as $category) {
			echo "<div id=".strtolower($category['name']).">";
				$forums = Database::query("SELECT * FROM forums WHERE category_id = :category_id", ['category_id' => $category['id']]);
				foreach($forums as $forum) {
					echo $forum['name'];
				}
			echo "</div>";
		}
	}
}

function adminCategories() {
	$categories = Database::query("SELECT * FROM categories");

	echo "
		<div class='container'>
			<form action='categories.php' method='POST'>
				<input type='text' name='name' required/>
				<input id='add' type='submit' name='add' value='Add Category' />
			</form>

			<br/>
			
			<table class='table'>
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Priority</th>
						<th>Created At</th>
						<th>Updated At</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>";
	foreach($categories as $category) {
		$id = $category['id'];
		$name = ucfirst($category['name']);
		$priority = $category['priority'];
		$created_at = $category['created_at'];
		$updated_at = $category['updated_at'];

		echo "		<tr>
						<td>$id</td>
						<td>$name</td>
						<td>
						<span class='glyphicon glyphicon-chevron-up' aria-hidden='true'></span>
							<form action='categories.php' method='POST'>
								<input type='hidden' name='id' value='$id' />
								<input type='submit' name='priority' value='Up' class='btn btn-light'/>
								$priority 
								<input type='submit' name='priority' value='Down' class='btn btn-light'/>
							</form>
						</td>
						<td>$created_at</td>
						<td>$updated_at</td>
						<td><form action='categories.php' method='POST'>
								<input type='hidden' name='id' value='$id' />
								<input type='submit' name='delete' value='X' class='btn btn-light'/>
							</form>
						</td>
					</tr>";

	}	
	echo "
				</tbody>
			</table>
		</div>
	";
}

function categories() {
	if(isset($_POST['add'])) {
		$errors = [];
		$unverifiedName = $_POST['name'];

		// Check if category already exists
		$categoryAlreadyExists = Database::query("SELECT * FROM categories WHERE name= :name", ['name' => $unverifiedName]);
		if(count($categoryAlreadyExists) >= 1) {
			$errors[] = "Category already exists.";
		} else {
			$name = strtolower($unverifiedName);
		}

		// If no errors, add category
		if (empty($errors)) {
			$query = Database::query("INSERT INTO categories (id, name, priority, created_at, updated_at) VALUES (:id, :name, :priority, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)", ['id' => NULL, 'name' => $name, 'priority' => 0]);
			$errors[] = "Category succesfully added.";
		}
	} else if (isset($_POST['delete'])) {
		$errors = [];
		$id = $_POST['id'];

		// Retrieve category
		$query = Database::query("SELECT * FROM categories WHERE id= :id", ['id' => $id]);
		$category = $query[0];
		$name = $category['name'];

		$query = Database::query("DELETE FROM categories WHERE id= :id limit 1", ['id' => $id]);
		$errors[] = "Deleted '$name' from categories.";
	} else if (isset($_POST['priority'])) {
		$errors = [];

		$id = $_POST['id'];
		$priority = $_POST['priority'];
		$change = 0;
		if($priority == "Up") {
			$change++;
		} else if($priority == "Down") {
			$change--;
		}
		$query = Database::query("SELECT * FROM categories WHERE id= :id", ['id' => $id]);
		$category = $query[0];
		$oldPriority = $category['priority'];
		if($oldPriority == 0 && $change == -1) {
			$change = 0;
			$errors[] = "Priority is already 0, can not lower priority.";
		}
		$newPriority = $oldPriority + $change;
		$query = Database::query("UPDATE categories SET priority = :priority WHERE id= :id", ['id' => $id, 'priority' => $newPriority]);
		if(empty($errors)) {
			$errors[] = "Priority succesfully changed by $change to $newPriority.";
		}

	}

	return $errors;
}

function adminForums() {
	$forums = Database::query("SELECT * FROM forums");
	$categories = Database::query("SELECT * FROM categories");

	echo "
		<div class='container'>
			<form action='forums.php' method='POST'>
				<input type='text' name='name' required/>
				<select name='category' id='category'>";
				foreach($categories as $category) {
					$id = $category['id'];
					$name = ucfirst($category['name']);
					echo "<option>$id</option>";
				}

	echo "
             	</select>
				<input id='add' type='submit' name='add' value='Add Forum' />
			</form>

			<br/>
			
			<table class='table'>
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Priority</th>
						<th>Category Name</th>
						<th>Created At</th>
						<th>Updated At</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>";
	foreach($forums as $forum) {
		$id = $forum['id'];
		$name = ucfirst($forum['name']);
		$priority = $forum['priority'];
		$category_id = $forum['category_id'];
		$category_name = ucfirst(Database::query("SELECT * FROM categories WHERE id= :id", ['id' => $category_id])[0]['name']);
		$created_at = $forum['created_at'];
		$updated_at = $forum['updated_at'];

		echo "		<tr>
						<td>$id</td>
						<td>$name</td>
						<td>
						<span class='glyphicon glyphicon-chevron-up' aria-hidden='true'></span>
							<form action='forums.php' method='POST'>
								<input type='hidden' name='id' value='$id' />
								<input type='submit' name='priority' value='Up' class='btn btn-light'/>
								$priority 
								<input type='submit' name='priority' value='Down' class='btn btn-light'/>
							</form>
						</td>
						<td>$category_name</td>
						<td>$created_at</td>
						<td>$updated_at</td>
						<td><form action='forums.php' method='POST'>
								<input type='hidden' name='id' value='$id' />
								<input type='submit' name='delete' value='X' class='btn btn-light'/>
							</form>
						</td>
					</tr>";

	}	
	echo "
				</tbody>
			</table>
		</div>
	";
}

function forums() {
	if(isset($_POST['add'])) {
		$errors = [];
		$unverifiedName = $_POST['name'];
		$unverifiedCategoryId = $_POST['category'];

		// Check if category exists
		$category = Database::query("SELECT * FROM categories WHERE id= :id", ['id' => $unverifiedCategoryId]);
		if(count($category) == 0) {
			$errors[] = "Category not found.";
		} else {
			$category_id = $unverifiedCategoryId;
		}

		// Check if forum already exists
		$forumAlreadyExists = Database::query("SELECT * FROM forums WHERE name= :name", ['name' => $unverifiedName]);
		if(count($forumAlreadyExists) >= 1) {
			$errors[] = "Forum already exists.";
		} else {
			$name = strtolower($unverifiedName);
		}


		// If no errors, add forum
		if (empty($errors)) {
			$query = Database::query("INSERT INTO forums (id, name, category_id, is_subforum, priority, created_at, updated_at) VALUES (:id, :name, :category_id, 0, :priority, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)", ['id' => NULL, 'name' => $name, 'priority' => 0, 'category_id' => $category_id]);
			$errors[] = "Forum succesfully added.";
		}
	} else if (isset($_POST['delete'])) {
		$errors = [];
		$id = $_POST['id'];

		// Retrieve forum
		$query = Database::query("SELECT * FROM forums WHERE id= :id", ['id' => $id]);
		$forum = $query[0];
		$name = $forum['name'];

		$query = Database::query("DELETE FROM forums WHERE id= :id limit 1", ['id' => $id]);
		$errors[] = "Deleted '$name' from forums.";
	} else if (isset($_POST['priority'])) {
		$errors = [];

		$id = $_POST['id'];
		$priority = $_POST['priority'];
		$change = 0;
		if($priority == "Up") {
			$change++;
		} else if($priority == "Down") {
			$change--;
		}
		$query = Database::query("SELECT * FROM forums WHERE id= :id", ['id' => $id]);
		$forum = $query[0];
		$oldPriority = $forum['priority'];
		if($oldPriority == 0 && $change == -1) {
			$change = 0;
			$errors[] = "Priority is already 0, can not lower priority.";
		}
		$newPriority = $oldPriority + $change;
		$query = Database::query("UPDATE forums SET priority = :priority WHERE id= :id", ['id' => $id, 'priority' => $newPriority]);
		if(empty($errors)) {
			$errors[] = "Priority succesfully changed by $change to $newPriority.";
		}

	}

	return $errors;
}
