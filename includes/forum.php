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
			<div class="col-md-12">
				<a href="create_topic.php?id='.$id.'" class="btn btn-primary">Create new topic</a>
				<br />
				<br />';

		$topics = query($pdo, "SELECT * FROM topics WHERE forum_id= :forum_id", ['forum_id' => $id]);
		if(count($topics) == 0) {
			echo "No topics yet!";
		} else {
			foreach($topics as $topic) {
				echo '
				<div class="row">
					<div class="col-md-12">
						<a href="../topic.php?id='.$topic['id'].'">'.$topic['title'].'</a>
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