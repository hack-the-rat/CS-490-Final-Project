<?php
    try {
        $db = new mysqli("sql.njit.edu", "rat27", "hub1881", "rat27");
    }
    catch (Exception $e) {
        $message = "Service Unavailable. Error: " . $e;
        echo json_encode($message);
        exit;
    }
    if (isset($_POST['id'])) {
        $id = mysqli_real_escape_string($db, $_POST['id']);
        $query = "DELETE FROM QuestionBank WHERE ID = '$id';";
    
        if(mysqli_query($db, $query)) {
            $message = "success";
        } else {
            $message = "fail";
        }
    
        echo json_encode($message);
    }
    mysqli_close($db);
?>