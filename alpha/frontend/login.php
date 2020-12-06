<?php
	header("Content-type: application/json; charset=UTF-8");
	$ucid=$_POST['ucid'];
	$password=$_POST['password'];
	$check=$_POST['check'];
	$curl = curl_init();
	$info = array('ucid' => $ucid,'password' => $password);


	curl_setopt($curl, CURLOPT_POST, 1);
	//curl_setopt($curl, CURLOPT_URL, 'https://web.njit.edu/~rat27/backend/backend.php');  
	curl_setopt($curl, CURLOPT_URL, 'https://web.njit.edu/~rat27/middleend/middleend.php');  
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $info);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	
	$response = curl_exec($curl);
	curl_close($curl);

   	echo $response;
?>