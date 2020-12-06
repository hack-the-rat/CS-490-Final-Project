<?php
  //location: njit.edu/~public/cs490/backend/backend.php/
  header("Content-type: application/json; charset=UTF-8");
  $ucid = $_POST[ucid];
  $password = $_POST[password];
  define('dbhost', 'sql.njit.edu');
  define('dbuser', 'rat27');
  define('dbpass', 'Rt27Rcl69775728.');
  define('dbtable', 'rat27');

  //sample logins
  //ucid  || password
  //rat27 || abc
  //test  || test
  
  //create connection
  $conn = new mysqli(dbhost,dbuser,dbpass,dbtable);
  
  //check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  $sql = "SELECT ucid, password FROM user WHERE ucid='$ucid' and password='$password'";
  
  $result = $conn->query($sql);
  
  $fail = false;
  $success = true;
  
  if ($result->num_rows == 0) { //user doesnt exist
    echo json_encode($fail);
    //output data of each row
 
  } else {
    echo json_encode($success);
  }
  
  $conn->close();
?>