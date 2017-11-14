function toggle(element, show) {
	document.getElementById(element).style.display = show;
}

function togglePortal(to) {
	switch(to) {
		case 'login':
			toggle('registerWrapper', 'none');
			toggle('loginWrapper', 'block');
			break;
		case 'register':
			toggle('loginWrapper', 'none');
			toggle('registerWrapper', 'block');
			break;
		case 'close':
			toggle('loginWrapper', 'none');
			toggle('registerWrapper', 'none');
			break;
		default:
			break;
	}
}