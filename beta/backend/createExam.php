<?php
	header("Content-type: application/json; charset=utf-8");
  
	$examName = $_POST[examName];
	$idList = $_POST[questionList];
 
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

	$students = array();
	$sql1 = "SELECT username FROM user WHERE type='student'";
	$result = $conn->query($sql1);

	while($row = $result->fetch_assoc()) { 
		array_push($students, $row['username']);
    }
  
	$sql2 = "INSERT INTO exams(examName, status, idList)
		VALUES('$examName', 'assigned', '$idList')";
 
	if ($conn->query($sql2) === TRUE) {
		foreach ($students as $studentName){//***
			$sql3 = "INSERT INTO StudentExamStatus(username, examName, status)
				VALUES('$studentName', '$examName', 'assigned')";
			if (!empty($studentName)){//---
				if($conn->query($sql3) === TRUE){
					$status = $success;
				} else {
					$status = $fail;
				}
            }//---
		}//***
	} else {
		$status = $fail;
	}
	echo json_encode($status);
?>