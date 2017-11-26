<?php

session_start();

require_once('includes/DB.php');
$pdo = DB();
require_once('includes/codes.php');
require_once('includes/create_topic.php');

$navbar = navbar();

$errors = [];
if(isset($_POST['create_topic'])) {
	$errors = create_topic($pdo);
}

?>

<!DOCTYPE HTML>

<html lang="en">
<head>
	<meta charset="utf-8">

	<title>Functional Forum</title>

	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<script src="js/scripts.js" type="text/javascript" ></script>
</head>

<body>

	<div class="container">

		<br />
		<?php echo $navbar; ?>
		<br />

		<div id="errors">
			<?php
				foreach($errors as $error) {
					echo $error."<br />";
				}
			?>
	  	</div>

		<form action="create_topic.php?forum_id=<?php echo $_GET['forum_id']; ?>" method="POST">
			<div class="form-group">
				<label for="topic_title">Topic Title</label>
				<input type="text" name="topic_title" class="form-control" id="topic_title" placeholder="Topic Title">
			</div>
			<div class="form-group">
				<label for="topic_body">Body</label>
				<textarea name="topic_body" class="form-control" id="topic_body" rows="3"></textarea>
			</div>
			<div class="text-center">
				<button type="submit" name="create_topic" class="btn btn-primary">Submit</button>
			</div>
		</form>

	</div>

</body>
</html>
