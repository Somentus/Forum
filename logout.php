<?php

session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && isset($_POST['submit'])) {
	session_destroy();	
}
header('Location: /');
exit;

?>