<?php
  header("Content-type: application/json; charset=utf-8");

  $username=$_POST['username'];
 
  define('dbhost', 'sql.njit.edu');
	define('dbuser', 'rat27');
	define('dbpass', 'hub1881');
	define('dbtable', 'rat27');

  $conn = new mysqli(dbhost,dbuser,dbpass,dbtable);
  
 
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  $sql = "SELECT examName, status FROM StudentExamStatus WHERE username='$username'";
  $result = $conn->query($sql);
  
  $fail = fail;
  $i = 0;
  if ($result->num_rows == 0) {
    echo json_encode($fail);
  } elseif ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) { 
      $i++;
      $output[$i]['examName'] = $row["examName"];
      $output[$i]['status'] = $row["status"];
    }
  }
  echo json_encode($output);
  
  $conn->close();
 ?>