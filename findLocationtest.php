<?php

require_once('includes/DB.php');
$pdo = DB();

function location($pdo) {
	foreach ($_GET as $key => $value) {
		if($key == "id") {
			$id = $value;
		}
	}

	// $location = basename($_SERVER['PHP_SELF']);
	$location = "index.php";
	$currentFile = explode('.', $location)[0];	
	echo $currentFile."<br />";

	switch($currentFile) {
		case 'forum':
			$forum_id = $id;
			$forum = query($pdo, "SELECT * FROM forums WHERE id = :id", ['id' => $forum_id])[0];
			$forum_name = $forum['name'];
			$category_id = $forum['category_id'];
			$category = query($pdo, "SELECT * FROM categories WHERE id = :id", ['id' => $category_id])[0];
			$category_name = $category['name'];

			$objectNames = [$category_name, $forum_name];
			$urls = ['index.php', 'forum.php?id='.$forum_id];			
			break;
		case 'topic':
			$topic_id = $id;
			$topic = query($pdo, "SELECT * FROM topics WHERE id = :id", ['id' => $topic_id])[0];
			$topic_title = $topic['title'];
			$forum_id = $topic['forum_id'];
			$forum = query($pdo, "SELECT * FROM forums WHERE id = :id", ['id' => $forum_id])[0];
			$forum_name = $forum['name'];
			$category_id = $forum['category_id'];
			$category = query($pdo, "SELECT * FROM categories WHERE id = :id", ['id' => $category_id])[0];
			$category_name = $category['name'];

			$objectNames = [$category_name, $forum_name, $topic_title];
			$urls = ['index.php', 'forum.php?id='.$forum_id, 'topic.php?id='.$topic_id];
			break;
		default:
			$currentFileCapitalised = ucfirst($currentFile);
			$objectNames = [$currentFileCapitalised];
			$urls = [$location];
			break;
	}

	var_dump($objectNames);
	echo "<br />";
	var_dump($urls);

	$return = 'a';//[$objectNames, $urls];
	return $return;
	// ['Announcements', 'Important', 'Weekly Announcements'], ['index.php', 'forum.php?id=2', 'topic.php?id=85']
}

location($pdo);

?>