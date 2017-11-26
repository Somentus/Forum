<?php

function navbar() {
	echo"
	<div id='adminLinks' class='container' >
		<div class='row'> 
			<div class='col-3'>
				<a href='./categories.php'>Categories</a>
				<a href='./forums.php'>Forums</a>

				<form action='../logout.php' method='POST' >
    				<input type='submit' name='logout' value='Log Out' class='btn btn-light'/>
				</form>				
			</div>
		</div>
	</div>
	<br />";
}

function adminCategories($pdo) {
	$categories = query($pdo, "SELECT * FROM categories");

	echo "
		<div class='container'>
			<form action='categories.php' method='POST'>
				<input type='text' name='name' required/>
				<input id='add' type='submit' name='add' value='Add Category' class='btn btn-primary'/>
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

function categories($pdo) {
	if(isset($_POST['add'])) {
		$errors = [];
		$unverifiedName = $_POST['name'];

		// Check if category already exists
		$categoryAlreadyExists = query($pdo, "SELECT * FROM categories WHERE name= :name", ['name' => $unverifiedName]);
		if(count($categoryAlreadyExists) >= 1) {
			$errors[] = "Category already exists.";
		} else {
			$name = strtolower($unverifiedName);
		}

		// If no errors, add category
		if (empty($errors)) {
			$query = query($pdo, "INSERT INTO categories (id, name, priority, created_at, updated_at) VALUES (:id, :name, :priority, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)", ['id' => NULL, 'name' => $name, 'priority' => 0]);
			$errors[] = "Category succesfully added.";
		}
	} else if (isset($_POST['delete'])) {
		$errors = [];
		$id = $_POST['id'];

		// Retrieve category
		$query = query($pdo, "SELECT * FROM categories WHERE id= :id", ['id' => $id]);
		$category = $query[0];
		$name = $category['name'];

		// Check if category contains any forums
		$query = query($pdo, "SELECT * FROM forums WHERE category_id= :category_id", ['category_id' => $id]);
		if( count($query) > 0) {
			$errors[] = "Category still contains forums. Delete the forums before deleting the category.";
		}

		if(empty($errors)) {
			$query = query($pdo, "DELETE FROM categories WHERE id= :id limit 1", ['id' => $id]);
			$errors[] = "Deleted '$name' from categories.";
		}
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
		$query = query($pdo, "SELECT * FROM categories WHERE id= :id", ['id' => $id]);
		$category = $query[0];
		$oldPriority = $category['priority'];
		if($oldPriority == 0 && $change == -1) {
			$change = 0;
			$errors[] = "Priority is already 0, can not lower priority.";
		}
		$newPriority = $oldPriority + $change;
		$query = query($pdo, "UPDATE categories SET priority = :priority WHERE id= :id", ['id' => $id, 'priority' => $newPriority]);
		if(empty($errors)) {
			$errors[] = "Priority succesfully changed by $change to $newPriority.";
		}

	}

	return $errors;
}

function adminForums($pdo) {
	$forums = query($pdo, "SELECT * FROM forums");
	$categories = query($pdo, "SELECT * FROM categories");

	echo "
		<div class='container'>
			<form action='forums.php' method='POST'>
				<input type='text' name='name' required/>
				<select name='category' id='category'>";
				foreach($categories as $category) {
					$id = $category['id'];
					$name = ucfirst($category['name']);
					echo "<option value='$id'>$name</option>";
				}

	echo "
             	</select>
				<input id='add' type='submit' name='add' value='Add Forum' class='btn btn-primary'/>
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
		$category_name = ucfirst(query($pdo, "SELECT * FROM categories WHERE id= :id", ['id' => $category_id])[0]['name']);
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

function forums($pdo) {
	if(isset($_POST['add'])) {
		$errors = [];
		$unverifiedName = $_POST['name'];
		$unverifiedCategoryId = $_POST['category'];

		// Check if category exists
		$category = query($pdo, "SELECT * FROM categories WHERE id= :id", ['id' => $unverifiedCategoryId]);
		if(count($category) == 0) {
			$errors[] = "Category not found.";
		} else {
			$category_id = $unverifiedCategoryId;
		}

		// Check if forum already exists
		$forumAlreadyExists = query($pdo, "SELECT * FROM forums WHERE name= :name", ['name' => $unverifiedName]);
		if(count($forumAlreadyExists) >= 1) {
			$errors[] = "Forum already exists.";
		} else {
			$name = strtolower($unverifiedName);
		}


		// If no errors, add forum
		if (empty($errors)) {
			$query = query($pdo, "INSERT INTO forums (id, name, category_id, is_subforum, priority, created_at, updated_at) VALUES (:id, :name, :category_id, 0, :priority, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)", ['id' => NULL, 'name' => $name, 'priority' => 0, 'category_id' => $category_id]);
			$errors[] = "Forum succesfully added.";
		}
	} else if (isset($_POST['delete'])) {
		$errors = [];
		$id = $_POST['id'];

		// Retrieve forum
		$query = query($pdo, "SELECT * FROM forums WHERE id= :id", ['id' => $id]);
		$forum = $query[0];
		$name = $forum['name'];

		$query = query($pdo, "DELETE FROM forums WHERE id= :id limit 1", ['id' => $id]);
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
		$query = query($pdo, "SELECT * FROM forums WHERE id= :id", ['id' => $id]);
		$forum = $query[0];
		$oldPriority = $forum['priority'];
		if($oldPriority == 0 && $change == -1) {
			$change = 0;
			$errors[] = "Priority is already 0, can not lower priority.";
		}
		$newPriority = $oldPriority + $change;
		$query = query($pdo, "UPDATE forums SET priority = :priority WHERE id= :id", ['id' => $id, 'priority' => $newPriority]);
		if(empty($errors)) {
			$errors[] = "Priority succesfully changed by $change to $newPriority.";
		}

	}

	return $errors;
}
