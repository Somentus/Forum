alert("Hi!");

function toggle(element, show) {
	document.getElementById(element).style.display = show;
}

function toggleLogin() {
	toggle('registerWrapper', 'none');
	toggle('loginWrapper', 'block');
}

function toggleRegister() {
	toggle('loginWrapper', 'none');
	toggle('registerWrapper', 'block');
}

function togglePortal(to) {
	
}