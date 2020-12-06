function login(form){
	var ajax=new XMLHttpRequest();
	ajax.onreadystatechange = function(){
    document.getElementById("demo").innerHTML = "loading...";
		if(ajax.readyState == 4 && ajax.status == 200){
			
			document.getElementById("demo").innerHTML = this.responseText;
			return;
		}
	}
	ajax.open("POST", "https://web.njit.edu/~rat27/frontend/login.php", true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajax.send("ucid="+form.ucid.value+"&password="+form.password.value);
}