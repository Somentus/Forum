<?php

function create_topic() {
	$errors = [];

	if(isset($_POST['create_topic'])) {
		$forum_id = $_GET['forum_id'];
		$title = $_POST['topic_title'];
		$body = $_POST['topic_body'];
		$user_id = $_SESSION['id'];

		/*
		TOPIC:
		- id X
		- title X
		- forum_id X
		- user_id X

		POST:
		- id X
		- body X
		- user_id X
		- topic_id 
		*/

		require_once('classes/Database.php');

		// If no errors, register user
		if (empty($errors)) {
			$query = Database::query("INSERT INTO topics (title, forum_id, user_id) VALUES (:title, :forum_id, :user_id)", ['title' => $title, 'forum_id' => $forum_id, 'user_id' => $user_id]);
			$id = $query[0]['id'];

			$query = Database::query("INSERT INTO posts (title, forum_id, user_id) VALUES (:title, :forum_id, :user_id)", ['title' => $title, 'forum_id' => $forum_id, 'user_id' => $user_id]);

			$errors[] = "Topic succesfully created.";
		}
	}

	return $errors;
}
}

?>