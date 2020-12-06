<?php
  header("Content-type: application/json; charset=utf-8");
  
  $examName = $_POST['examName'];

  $fail = fail;
  $success = success;
  define('dbhost', 'sql.njit.edu');
	define('dbuser', 'rat27');
	define('dbpass', 'hub1881');
	define('dbtable', 'rat27');

  $conn = new mysqli(dbhost,dbuser,dbpass,dbtable);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $sql2 = "UPDATE StudentExamStatus SET status='released' WHERE examName='$examName'";
  $flag = $conn->query($sql2);
  $sql = "UPDATE exams SET status='released' WHERE examName='$examName'";
  
 	if ($conn->query($sql) === TRUE) {
    echo json_encode($success);
  } else {
		echo json_encode($fail);
  }
?>