<?php
  header("Content-type: application/json; charset=utf-8");

  $examName=$_POST['examName'];
 
	define('dbhost', 'sql.njit.edu');
	define('dbuser', 'rat27');
	define('dbpass', 'hub1881');
	define('dbtable', 'rat27');

  $conn = new mysqli(dbhost,dbuser,dbpass,dbtable);
 
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  $sql = "SELECT status, username FROM StudentExamStatus WHERE examName='$examName'";
  $result = $conn->query($sql);
  
  $fail = fail;
  $i = -1;
  if ($result->num_rows == 0) {
    echo json_encode($examName);
  } elseif ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) { 
      $i++;
      $output[$i]['username'] = $row["username"];
      $output[$i]['status'] = $row["status"];
    }
  }
 
  for($j =0; $j <= $i; $j++){
    $username = $output[$j]['username'];
    $sql ="SELECT grade FROM answers WHERE examName='$examName' AND username='$username'";
    $result = $conn->query($sql);
    $count=0;
    $grade=0;
    while($row = $result->fetch_assoc()) { 
      $grade = $grade+$row['grade'];
      $count++;
    }
    $output[$j]['total']=$count*10;
    $output[$j]['grade']=$grade;
  }
  
  echo json_encode($output);
  
  $conn->close();
 ?>