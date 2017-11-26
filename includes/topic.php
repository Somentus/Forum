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
		<div class="row">
			<div class="col-md-12">
				<h6>'.$topic['title'].'</h6>';

		$posts = query($pdo, "SELECT * FROM posts WHERE topic_id= :topic_id", ['topic_id' => $id]);
		if(count($posts) == 0) {
			echo "No posts yet!";
		} else {
			foreach($posts as $post) {
				echo '
				<div class="row">
					<div class="col-md-12">
						'.$post['body'].'
					</div>
				</div>';
			}
		}

		echo '
				</div>
			</div>
		';

	}
}

?>