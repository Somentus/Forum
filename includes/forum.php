<?php

function content() {
	require_once('classes/Database.php');
	$errors = [];

	$id = $_GET['id'];
	$forum = Database::query("SELECT * FROM forums WHERE id= :id", ['id' => $id]);
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

		$topics = Database::query("SELECT * FROM topics WHERE forum_id= :forum_id", ['forum_id' => $id]);
		if(count($topics) == 0) {
			echo "No topics yet!";
		} else {
			foreach($topics as $topic) {
				echo '
				<div class="row">
					<div class="col-md-12">
						'.$topic['title'].'
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