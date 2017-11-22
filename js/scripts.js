function toggle(element, show) {
	document.getElementById(element).style.display = show;
}

function togglePortal(to) {
	switch(to) {
		case 'login':
			toggle("portal", "block");
			document.getElementById("submit").setAttribute("name", "login");
			document.getElementById("submit").setAttribute("value", "Login");
			document.getElementById("navbarLogin").setAttribute("class", "btn btn-primary");
			document.getElementById("navbarRegister").setAttribute("class", "btn btn-secondary");
			document.getElementById("email").required = false;
			document.getElementById("errors").innerHTML = "";
			toggle("email", "none");
			break;
		case 'register':
			toggle("portal", "block");
			document.getElementById("submit").setAttribute("name", "register");
			document.getElementById("submit").setAttribute("value", "Register");
			document.getElementById("navbarLogin").setAttribute("class", "btn btn-secondary");
			document.getElementById("navbarRegister").setAttribute("class", "btn btn-primary");
			document.getElementById("email").required = true;
			document.getElementById("errors").innerHTML = "";
			toggle("email", "block"); 
			break;
		case 'close':
			document.getElementById("errors").innerHTML = "";
			document.getElementById("navbarLogin").setAttribute("class", "btn btn-secondary");
			document.getElementById("navbarRegister").setAttribute("class", "btn btn-secondary");
			toggle("portal", "none");
			break;
		default:
			break;
	}
}
