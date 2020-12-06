<?php
	$array = [];
	foreach ($_POST as $key => $value)
	{
		switch($key)
		{
			case 'header':
				$array['header'] =$value;
				break;
			case 'username':
				$array['username'] =$value;
				break;
			case 'password':
				$array['password'] =$value;
				break;
			case 'examName':
				$array['examName'] =$value;
				break;
			case 'functionName':
				$array['functionName'] =$value;
				break;
			case 'topic':
				$array['topic'] =$value;
				break;
			case 'difficulty':
				$array['difficulty'] =$value;
				break;
			case 'input':
				$array['input'] =$value;
				break;
			case 'output':
				$array['output'] =$value;
				break;
			case 'questionList':
				$array['questionList'] =$value;
				break;
			case 'question':
				$array['question'] =$value;
				break;	
			case 'parameters':
				$array['parameters'] =$value;
				break;
			case 'maxGrade':
				$array['maxGrade'] =$value;
				break;
			case 'grade':
				$array['grade'] =$value;
				break;
			case 'teacherNotes':
				$array['teacherNotes'] =$value;
				break;
			case 'id':
				$array['id'] =$value;
				break;
			case 'status':
				$array['status'] =$value;
				break;
			case 'pointWorth':
				$array['pointWorth'] =$value;
				break;
			case 'pointList':
				$array['pointList'] =$value;
			case 'autoNotes':
				$array['pointList'] =$value;
			default:
				break;
		}
	}

	$url = '';
	$flag = false;
	switch($array['header'])
	{
		//------------------------------------------------------------------------
		case 'login':
			$url = 'https://web.njit.edu/~cs558/login.php';
			break;
		//------------------------------------------------------------------------
		case 'questionBankRequest':
			$url = 'https://web.njit.edu/~cs558/questionBank.php';
			break;
		//------------------------------------------------------------------------	
		case 'addQuestionRequest':
			$url = 'https://web.njit.edu/~cs558/addQuestion.php';
			break;
		//------------------------------------------------------------------------
		case 'createExam':
			'https://web.njit.edu/~cs558/createExam.php';
			break;
		//------------------------------------------------------------------------
		case "teacherExamListRequest":
			$url = 'https://web.njit.edu/~cs558/teacherExamList.php';
			break;
		//------------------------------------------------------------------------
		case 'studentExamListRequest':
			$url = 'https://web.njit.edu/~cs558/studentExamList.php';
			break;
		//------------------------------------------------------------------------
		case 'takeExamRequest':
			$url = 'https://web.njit.edu/~cs558/takeExam.php';
			break;
		//------------------------------------------------------------------------	
		case 'examStudentList':
			$url = 'https://web.njit.edu/~cs558/studentExamRequest.php';
			break;
		//------------------------------------------------------------------------
		case 'reviewExamRequest':
			$url = 'https://web.njit.edu/~cs558/reviewExam.php';
			break;
		//------------------------------------------------------------------------	
		case 'examUpdateRequest':
			$url = 'https://web.njit.edu/~cs558/examUpdate.php';
			break;
		//------------------------------------------------------------------------
		case 'examReleaseRequest':
			$url = 'https://web.njit.edu/~cs558/examReleaseScores.php';
			break;
    	//------------------------------------------------------------------------
		case 'teacherExamScoreRequest':
			$url='https://web.njit.edu/~cs558/teacherExamScoreRequest.php';
			break;
		//------------------------------------------------------------------------
		case 'questionBankSortRequest':
			$url='https://web.njit.edu/~cs558/searchQuestionBank.php';
			break;
		//=========================================================================
		default:
			$flag = true;
			break;
	}

	if ($flag != true) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_URL, $url);  
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $array);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

		$response = curl_exec($curl);	
		curl_close($curl);

		echo $response;
	} else {
		$array['url']=$url;
		echo json_encode($array);
	}
?>