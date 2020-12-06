<?php
  header("Content-type: application/json; charset=UTF-8");
  
  $examName = $_POST['examName'];
  $id = $_POST['id'];
  $username = $_POST['username'];
  $notes = $_POST['autoNotes'];
  $grade = $_POST['grade'];
  $answer =$_POST['answer'];
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
  $sql2 = "UPDATE StudentExamStatus SET status='submitted' WHERE username='$username' AND examName='$examName'";
  $flag = $conn->query($sql2);
  
 	$sql = "INSERT INTO answers(username, examName, id, notes, grade, answer) VALUES ('$username','$examName','$id','$notes','$grade','$answer')";

  if ($conn->query($sql) === TRUE) {
    echo json_encode($success);
	} else {
	  echo json_encode($fail);
	}
?>