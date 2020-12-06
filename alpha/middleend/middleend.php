<?php
	header("Content-type: application/json; charset=UTF-8");
	$ucid=$_POST[ucid];
	$password=$_POST[password];

//============= Back End ==================

	$info = array('ucid' => $ucid,'password' => $password);
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_URL, 'https://web.njit.edu/~rat27/backend/backend.php');  
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $info);
  curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

	$responseDB = json_decode(curl_exec($curl));
	curl_close($curl);

//============== NJIT Spoof ================

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://njit.datacenter.adirondacksolutions.com/NJIT_THDSS_PROD/navigation/student/my-screen");
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
    "user" => $ucid,
    "pass" => $password,
    "uuid" => "0xACA021"
		)));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	$responseNJIT = curl_exec($ch);
	curl_close($ch);

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://www5.njit.edu/reslife/apply.php");
	curl_exec($ch);
	curl_close($ch);

//============= processing data ============
	
	$response = array(
		'NJIT' => false,
		'DB' => $responseDB
	);

	if (strpos($responseNJIT, 'Login Successful') !== false) {
    $response['NJIT'] = True;
  } else {
	  $response['NJIT'] = False;
  }
   	echo json_encode($response);
?>