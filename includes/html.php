<?php

function navbar() {
	if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true ) {
		// Return navbar for logged in user
		// TODO: Add navbar for logged in user
		return '
		<div id="navbar">
			<a href="logout.php">Log out</a>
	  	</div>';
	} else {
		// Return navbar for guest
		return '
		<div id="navbar">
	  		<a href="register.php">Register</a>
	  		<a href="login.php">Login</a>
	  	</div>';
	}
}

?>