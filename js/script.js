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

function getmessages() {
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "getmessage.php", true);
	xhttp.onload = function() {
	  if (this.readyState == 4 && this.status == 200) {
			var data = JSON.parse(xhttp.responseText);
			renderHTML(data);
	  }
	};
	xhttp.send();		
}

function sendmessage() {
	var message = document.getElementById('chatinputflield').value;
	var params = "message="+ message;

	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "sendmessage.php", true);
	xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhttp.send(params);		
	document.getElementById('chatinputflield').value = '';
}


function renderHTML(data){
	var messagecontainer = document.getElementById("chatcontent");
	while (messagecontainer.firstChild) {
		messagecontainer.removeChild(messagecontainer.firstChild);
	}
	var htmlString = "";

	for(i = 0; i < data.length; i++){
		htmlString += '<div class="message"><p class="username">'+data[i].username + ': </p>';
		htmlString += '<p class="text">' + data[i].message + '</p></div>';
	}

	messagecontainer.insertAdjacentHTML('beforeend', htmlString);
}