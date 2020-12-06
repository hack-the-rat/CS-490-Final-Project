<?php
	header("Content-type: application/json; charset=utf-8");
	$qName = $_POST[functionName];
	$question = $_POST[question];
	$topic = $_POST[topic];
	$difficulty = $_POST[difficulty];
	$cases = $_POST[parameters];
	$input = $_POST[input];
	$output = $_POST[output];
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
  
	$sql = "INSERT INTO questionBank(qName, question, topic, difficulty, cases, input, output) 
		VALUES ('$qName','$question', '$topic', '$difficulty', '$cases', '$input', '$output')";
  
	$fail = fail;
	$success = success;

	if ($conn->query($sql) === TRUE) {
		echo json_encode($success);
	} else {
		echo json_encode("Error: " . $sql . "<br>" . $conn->error);
	}
	$conn->close();
?>