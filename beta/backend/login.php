<?php
	header("Content-type: application/json; charset=utf-8");
	$username = $_POST[username];
	$password = $_POST[password];
	define('dbhost', 'sql.njit.edu');
	define('dbuser', 'rat27');
	define('dbpass', 'hub1881');
	define('dbtable', 'rat27');

	//sample logins
	//username || password
	//rat27 || student
	//rat27 || teacher
  
	$conn = new mysqli(dbhost,dbuser,dbpass,dbtable);
  
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
  
	$sql = "SELECT username, password, type FROM user WHERE username='$username' and password='$password'";
  
	$result = $conn->query($sql);

	$fail = 'fail';
	if ($result->num_rows == 0) {
		echo json_encode($fail);
	} elseif ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) { 
			$output = $row["type"];
		}
		echo json_encode($output);
	}
  
	$conn->close();
?>