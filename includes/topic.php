<?php

function content($pdo) {
	$id = $_GET['id'];
	$topic = query($pdo, "SELECT * FROM topics WHERE id= :id", ['id' => $id]);
	if(count($topic) == 0) {
		echo "Topic not found!";
	} else if(count($topic) == 1) {
		$topic = $topic[0];
		// TODO: Verify if user has access to current topic

		echo '
				<h6>'.htmlspecialchars($topic['title']).'</h6>';

		$posts = query($pdo, "SELECT * FROM posts WHERE topic_id = :topic_id", ['topic_id' => $id]);
		if(count($posts) == 0) {
			echo "No posts yet!";
		} else {
			foreach($posts as $post) {
				$user = query($pdo, "SELECT * FROM users WHERE id = :id", ['id' => $post['user_id']])[0];
				echo "
					<div class='row border'>
						<div class='col-md-1'>
							<a name='".$post['id']."'></a>
							<div class='pt-1'>
								<img src='".retrieveProfilePicture($pdo, $user['id'])."' class='img-fluid rounded'>
							</div>
							<div>
								<a href='user.php?id=".$user['id']."'>".htmlspecialchars($user['username'])."</a>
							</div>
						</div>
						<div class='col-md-11'>
							<span class='float-right'>
								<small class='text-muted'>".ucfirst(parseTimeSinceTimestamp($post['created_at']))."</small>
							</span>
							".htmlspecialchars($post['body'])."
						</div>
					</div>
					<br />";
			}
		}
	}
}

function post($pdo) {
	if(isLoggedIn()) {
		echo '
			<form action="topic.php?topic_id='.htmlspecialchars($_GET['id']).'" method="POST">
				<div class="form-group">
					<textarea name="body" class="form-control" id="body" rows="3"></textarea>
				</div
				<div class="text-center">
					<button type="submit" name="post" class="btn btn-primary">Submit</button>
				</div>
			</form>
		';

		if(isset($_POST['post'])) {
			$topic_id = htmlspecialchars($_GET['topic_id']);
			$body = htmlspecialchars($_POST['body']);
			$user_id = $_SESSION['id'];

			// If no errors, register user
			$query = query($pdo, "INSERT INTO posts (body, user_id, topic_id) VALUES (:body, :user_id, :topic_id)", ['body' => $body, 'user_id' => $user_id, 'topic_id' => $topic_id]);
			header('location:topic.php?id='.$topic_id);
		}
	}
}

?>
