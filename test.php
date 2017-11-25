<?php

require_once('classes/DB.php');



$query = Database::query("INSERT INTO topics (id, title, forum_id, user_id) VALUES (:id, :title, :forum_id, :user_id)", ['id' => NULL, 'title' => 'Hoi', 'forum_id' => 11, 'user_id' => 2]);
// $title_id = $query['id'];

// echo $title_id;

var_dump($query);
?>