function myFunction() {
	var x = document.getElementById("myTopnav");
  	if (x.className === "topnav") {
    	x.className += " responsive";
  	} else {
    	x.className = "topnav";
  	}
}

function redirect(url) {
	window.location.href = url;
}

function popup(message, target) {
	let text = message;
	alert(text);
	redirect(target);
}