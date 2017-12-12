<?php

function content($pdo) {
	$errors = [];

	$id = $_GET['id'];
	$forum = query($pdo, "SELECT * FROM forums WHERE id= :id", ['id' => $id]);
	if(count($forum) == 0) {
		$errors[] = "Forum not found!";
	} else if(count($forum) == 1) {
		// TODO: Verify if user has access to current forum

		echo '
		<div class="row">
			<div class="col-md-12">';

		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && isset($_SESSION['id'])) {
			echo '<a href="create_topic.php?id='.$id.'" class="btn btn-primary">Create new topic</a>';
		}
		echo '	<br />
				<br />';

		$topics = query($pdo, "SELECT * FROM topics WHERE forum_id= :forum_id", ['forum_id' => $id]);
		if(count($topics) == 0) {
			echo "No topics yet!";
		} else {
			foreach($topics as $topic) {
				$lastPostId = query($pdo, "SELECT MAX(id) FROM posts WHERE topic_id = :topic_id", ['topic_id' => $topic['id']])[0]['MAX(id)'];
				$lastPost = query($pdo, "SELECT * FROM posts WHERE id = :id", ['id' => $lastPostId])[0];
				echo '
				<div class="row" style="border: 1px solid black">
					<div class="col-md-6">
						<a href="../topic.php?id='.$topic['id'].'">'.$topic['title'].'</a>
					</div>

					<div class="col-md-6">
						<span class="float-right">';
				if(!empty($lastPost)) {
						$lastPostUser = query($pdo, "SELECT * FROM users WHERE id = :id", ['id' => $lastPost['user_id']])[0];
					// echo $lastPostUser['username']." - ".$lastPost['created_at'];
					echo "<a href='user.php?id=".$lastPostUser['id']."'>".$lastPostUser['username']."</a> - ".parseTimeSinceTimestamp($lastPost['created_at']);
				} else {
					echo "No posts yet.";
				}
				echo '
						</span>
					</div>
				</div>';
			}
		}

		echo '
				</div>
			</div>
		';
	}


	return $errors;
}

?>
