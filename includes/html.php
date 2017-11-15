<?php

function navbar() {
	if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true ) {
		// Return navbar for logged in user
		// TODO: Add navbar for logged in user
		return '
		<div id="navbar">
			<form action="logout.php" method="POST" >
    			<input type="submit" name="submit" value="Log Out" />
			</form>
	  	</div>';
	} else {
		// Return navbar for guest
		return '
		<div id="navbar">
	  		<button name="loginTest" onclick="togglePortal(\'login\');" >Login Test</button>
		  	<button name="registerTest" onclick="togglePortal(\'register\');" >Register Test</button>
		  	<button name="registerTest" onclick="togglePortal(\'close\');" >X</button>
	  	</div>';
	}
}

?>