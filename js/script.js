function registeruser() {
	var username = document.getElementById('register-input-username').value;
	var pw = document.getElementById('register-input-password').value;
	var name = document.getElementById('register-input-name').value;
	var params = "username="+ username + "&pw=" + pw + "&name=" + name;

	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	  if (this.readyState == 4 && this.status == 200) {
		//document.getElementById("register-input-name").value = this.responseText;	
		alert(this.responseText);
	  }
	};
	xhttp.open("POST", "register.php", true);
	xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhttp.send(params);		
}

function loginuser() {
	var username = document.getElementById('login-input-username').value;
	var pw = document.getElementById('login-input-password').value;
	var params = "username="+ username + "&pw=" + pw;

	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	  if (this.readyState == 4 && this.status == 200) {
			if(this.responseText == 'true'){
				location.href = "chat.php"; 
			}
	  }
	};
	xhttp.open("POST", "login.php", true);
	xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhttp.send(params);		
}