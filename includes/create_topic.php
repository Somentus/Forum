<?php

function create_topic($pdo) {
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

		// If no errors, register user
		if (empty($errors)) {
			$query = query($pdo, "INSERT INTO topics (title, forum_id, user_id) VALUES (:title, :forum_id, :user_id)", ['title' => $title, 'forum_id' => $forum_id, 'user_id' => $user_id]);
			$topic_id = $pdo->lastInsertId();

			$query = query($pdo, "INSERT INTO posts (body, user_id, topic_id) VALUES (:body, :user_id, :topic_id)", ['body' => $body, 'user_id' => $user_id, 'topic_id' => $topic_id]);

			$errors[] = "Topic succesfully created.";
			header('location:topic.php?id='.$topic_id);
		}
	}

	return $errors;
}

?>