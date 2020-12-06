<?php
	header("Content-type: application/json; charset=utf-8");
 
	define('dbhost', 'sql.njit.edu');
	define('dbuser', 'rat27');
	define('dbpass', 'hub1881');
	define('dbtable', 'rat27');

	$conn = new mysqli(dbhost,dbuser,dbpass,dbtable);
  
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
  
	$sql = "SELECT qName, question, topic, id, difficulty, input, output, cases FROM questionBank";
	$result = $conn->query($sql);
  
	$fail = fail;
  
	if ($result->num_rows == 0) {
		echo json_encode($fail);
	} elseif ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) { 
			$i = $row["id"];
			$output[$i]['id'] = $row["id"];
			$output[$i]['functionName'] = $row["qName"];
			$output[$i]['question'] = $row["question"];
			$output[$i]['topic'] = $row["topic"];
			$output[$i]['difficulty'] = $row["difficulty"];
			$output[$i]['parameters'] = $row["cases"];
			$output[$i]['input'] = $row["input"];
			$output[$i]['output'] = $row["output"];
		}
	}
	echo json_encode($output);
  
	$conn->close();
 ?>