function toggle(element, show) {
	document.getElementById(element).style.display = show;
}

function togglePortal(to) {
	switch(to) {
		case 'login':
			toggle("portal", "block");
			document.getElementById("submit").setAttribute("name", "login");
			document.getElementById("submit").setAttribute("value", "Login");
			document.getElementById("email").required = false;
			document.getElementById("errors").innerHTML = "";
			toggle("email", "none");
			break;
		case 'register':
			toggle("portal", "block");
			document.getElementById("submit").setAttribute("name", "register");
			document.getElementById("submit").setAttribute("value", "Register");
			document.getElementById("email").required = true;
			document.getElementById("errors").innerHTML = "";
			toggle("email", "block"); 
			break;
		case 'close':
			document.getElementById("errors").innerHTML = "";
			toggle("portal", "none");
			break;
		default:
			break;
	}
}
