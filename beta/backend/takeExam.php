<?php
  header("Content-type: application/json; charset=utf-8");
 
  define('dbhost', 'sql.njit.edu');
	define('dbuser', 'rat27');
	define('dbpass', 'hub1881');
	define('dbtable', 'rat27');

  $conn = new mysqli(dbhost,dbuser,dbpass,dbtable);

  $username = $_POST[username];
  $examName = $_POST[examName];

 
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql1 = "SELECT idList FROM exams WHERE examName = '$examName'";
  $result = $conn->query($sql1);
  while($row = $result->fetch_assoc()) {
    $idString = $row["idList"];
  }
  $idString = str_replace(' ', '', $idString);
  $idList = explode(",", $idString);
  $output= [];

  foreach ($idList as $i){
    $sql2 = "SELECT qName, question, topic, id, difficulty, input, output, cases FROM questionBank WHERE id = '$i'";
    $result = $conn->query($sql2);
    if($result->num_rows > 0){
      while($row = $result->fetch_assoc()) { 
        $output[$i]['id'] = $row["id"];
        $output[$i]['functionNameName'] = $row["qName"];
        $output[$i]['question'] = $row["question"];
        $output[$i]['topic'] = $row["topic"];
        $output[$i]['difficulty'] = $row["difficulty"];
        $output[$i]['parameters'] = $row["cases"];
        $output[$i]['input'] = $row["input"];
        $output[$i]['output'] = $row["output"];  
      }
    }
  }
  echo json_encode($output);
  $conn->close();  
?>