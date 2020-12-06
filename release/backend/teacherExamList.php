<?php
  try {
    $db = new mysqli("sql.njit.edu", "rat27", "hub1881", "rat27");
  }
  catch (Exception $e) {
    $message = "Service Unavailable. Error: " . $e;
    echo json_encode($message);
    exit;
  }
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $query = "SELECT ExamName, ExamStatus FROM Exams;";
  $result = mysqli_query($db, $query);
  $data = array();
  $i = -1;
  while($row = mysqli_fetch_assoc($result)) { 
    $i++;
    $row_array[$i]['examName'] = $row['ExamName'];
    $row_array[$i]['status'] = $row['ExamStatus'];
  }
  echo json_encode($row_array);
  mysqli_close($db);
?>