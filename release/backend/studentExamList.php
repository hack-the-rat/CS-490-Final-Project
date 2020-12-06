<?php
  try {
    $db = new mysqli("sql.njit.edu", "rat27", "hub1881", "rat27");
  }
  catch (Exception $e) {
    $message = "Service Unavailable. Error: " . $e;
    echo json_encode($message);
    exit;
  }
  if (isset($_POST['username'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $query = "SELECT ExamName, ExamStatus FROM ExamList WHERE Username = '$username';";
    $result = mysqli_query($db, $query);
    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
      $row_array[$i]['examName'] = $row['ExamName'];
      $row_array[$i]['status']   = $row['ExamStatus'];
      $i++;
    }
    echo json_encode($row_array);
  }
  mysqli_close($db);
?>