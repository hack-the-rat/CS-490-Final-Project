document.querySelector("#loginForm").addEventListener("submit", function(e) {
	e.preventDefault();
	userLogin();
});

document.querySelector("#username").addEventListener("invalid", function() {
	if(String(this.value).length == 0) {
		this.setCustomValidity("Username is required.");
	} else {
		this.setCustomValidity("");
	}
});

document.querySelector("#password").addEventListener("invalid", function() {
	if(String(this.value).length == 0) {
		this.setCustomValidity("Password is required.");
	} else {
		this.setCustomValidity("");
	}
});

function userLogin() {
	var username = document.getElementById('username');
	var password = document.getElementById('password');

	makeAjaxCall(username.value, password.value);
}

function makeAjaxCall(username, password) {
	var data = 'json_string={"header":"login","username":"'+username+'","password":"'+password+'"}'
	var request = new XMLHttpRequest();

	request.open('POST', '../php/frontend.php', true);
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=utf-8');
	request.send(data);

	request.onload = function() {
		if(request.status >= 200 && request.status < 400) {
			var response = request.responseText;
			console.log(response);
			loginAttempt(response, username);
		} else {
			console.log(response);
		}
	};
}

function loginAttempt(response, username) {
	var responseJSON = JSON.parse(response);
	if(responseJSON == "fail") {
		console.log("Login failed.");
	} else {
		window.localStorage.setItem('username', username);
		window.localStorage.setItem('type', responseJSON);

		if(responseJSON == "student") {
			console.log("Welcome, student.");
			window.location.replace("../student/student.html");
		} else if(responseJSON == "teacher") {
			console.log("Welcome, teacher.");
			window.location.replace("../teacher/teacher.html");
		}
	}
}