<?php

function content($pdo) {
	$errors = [];

	$id = $_GET['id'];
	$forum = query($pdo, "SELECT * FROM forums WHERE id = :id", ['id' => $id]);
	if(count($forum) == 0) {
		$errors[] = "Forum not found!";
	} else if(count($forum) == 1) {
		// TODO: Verify if user has access to current forum
		$forum = $forum[0];
		echo '
		<div class="row">
			<div class="col-md-12">';

		if(isLoggedIn()) {
			echo '<a href="/create_topic.php?id='.$id.'" class="btn btn-primary">Create new topic</a>';
		}
		echo '	<br />
				<br />';

		$topics = query($pdo, "SELECT * FROM topics WHERE forum_id = :forum_id", ['forum_id' => $id]);
		if(count($topics) == 0) {
			echo "No topics yet!";
		} else {
			echo "
				<div class='row border border-secondary'>
					<div class='col-md-12'>
						".htmlspecialchars($forum['name'])
			;

			foreach($topics as $topic) {
				$lastPostId = query($pdo, "SELECT MAX(id) FROM posts WHERE topic_id = :topic_id", ['topic_id' => $topic['id']])[0]['MAX(id)'];
				$lastPost = query($pdo, "SELECT * FROM posts WHERE id = :id", ['id' => $lastPostId])[0];
				echo "
				<div class='row border border-secondary border-left-0 border-right-0 border-bottom-0' >
					<div class='col-md-6'>
						<a href='../topic.php?id=".$topic['id']."'>".htmlspecialchars($topic['title'])."</a>
					</div>

					<div class='col-md-6'>
						<span class='float-right'>";
				if(!empty($lastPost)) {
						$lastPostUser = query($pdo, "SELECT * FROM users WHERE id = :id", ['id' => $lastPost['user_id']])[0];
					// echo $lastPostUser['username']." - ".$lastPost['created_at'];
					echo "	<div>
								<span class='float-right'>
									<a href='user.php?id=".$lastPostUser['id']."'>".htmlspecialchars($lastPostUser['username'])."</a>
								</span>
							</div>
							<div>
								<span class='float-right'>
									".parseTimeSinceTimestamp($lastPost['created_at'])."
								</span>
							</div>";

				} else {
					echo "No posts yet.";
				}
				echo '
						</span>
					</div>
				</div>';
			}
			echo '</div></div>';
		}

		echo '
				</div>
			</div>
		';
	}


	return $errors;
}

function forumGetName($pdo, $id) {
	$forum = query($pdo, "SELECT * FROM forums WHERE id = :id", ['id' => $id])[0];
	return $forum['name'];
}

?>
