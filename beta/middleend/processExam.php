<?php
    $username = $_POST['username'];	
    $examName = $_POST['examName'];
    $functionName = $_POST['qName'];
    $topic = $_POST['topic'];
    $casesRaw = str_replace(' ', '',$_POST['cases']);
    $inputRaw = str_replace(' ', '',$_POST['input']);
    $outputRaw = str_replace(' ', '',$_POST['output']);
    $answer = $_POST['answer'];
    $id = $_POST['id'];

//==============================================================

    $notes = "";
    $grade = "0";
    $cases = explode(",",$casesRaw);
    $input = explode(":",$inputRaw);
    $output = explode(":",$outRaw);
/*sample input output and cases
if casesRaw = "inputA,inputB" then, cases => [0]=='inputA',  [1]=='inputB'
if inputRaw = "1,2:3,4:5,6" then, input => [0]=='1,2',  [1]=='3,4',   [2]=='5,6', || use explode(",",input[0]) to obtain an array for output 0 which is [0]=='1', and [1]=='2'
if outputRaw = "3:7:11" then, output => [0]=='3',[1]=='7',[2]=='11'
input[0] corresponds to output[0]. In other words if the function is inserted with input[0], then the output should be output[0]
*/

    $backendArray = array(
	    'username'=>$username,
	    'examName'=>$examName,
	    'answer'=>$answer,
	    'id'=>$id,
	    'notes'=>$notes,
	    'grade'=>$grade
    );

    //===========================CURL===================================

    $curl = curl_init();
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_URL, 'https://web.njit.edu/~cs558/storeStudentExam.php');  
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $backendArray);
  	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	$responseDB = json_decode(curl_exec($curl));
	curl_close($curl);

	echo json_encode($responseDB);
?>