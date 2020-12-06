<?php 
  header("Content-type: application/json; charset=UTF-8");
 
  define('dbhost', 'sql.njit.edu');
	define('dbuser', 'rat27');
	define('dbpass', 'hub1881');
	define('dbtable', 'rat27');

  $conn = new mysqli(dbhost,dbuser,dbpass,dbtable);

  $username = $_POST[username];
  $examName = $_POST[examName];
 /* $username = 'student1';
  $examName = 'TestNumber1';*/

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
        $output[$i]['functionName'] = $row["qName"];
        $output[$i]['question'] = $row["question"];
        $output[$i]['topic'] = $row["topic"];
        $output[$i]['difficulty'] = $row["difficulty"];
        $output[$i]['parameters'] = $row["cases"];
        $output[$i]['input'] = $row["input"];
        $output[$i]['output'] = $row["output"];  
      }
    }
    $sql3="SELECT answer, teacherNotes, notes, grade FROM answers WHERE examName = '$examName' AND username = '$username' AND id ='$i'";
    $result =$conn->query($sql3);
    if($result->num_rows > 0){
      while($row = $result->fetch_assoc()) {
        $output[$i]['answer'] = $row["answer"];
        $output[$i]['teacherNotes'] = $row["teacherNotes"];
        $output[$i]['autoNotes'] = $row["notes"];
        $output[$i]['grade'] = $row["grade"];
      }
    }
  }

  $conn->close();

  echo json_encode($output);
?>