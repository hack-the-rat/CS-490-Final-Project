<?php
	$array = [];
	foreach ($_POST as $key => $value) {
		switch($key) {
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
				$array['functionName']=$value;
				break;
			case 'question':
				$array['question']=$value;
				break;
			case 'topic':
				$array['topic'] =$value;
				break;
			case 'difficulty':
				$array['difficulty'] =$value;
				break;
			case 'parameters':
				$array['parameters']=$value;
				break;
			case 'input':
				$array['input'] =$value;
				break;
			case 'output':
				$array['output'] =$value;
				break;
			case 'grade':
				$array['grade'] =$value;
				break;
			case 'maxGrade':
				$array['maxGrade']=$value;
				break;
			case 'question':
				$array['question'] =$value;
				break;	
			case 'cases':
				$array['cases'] =$value;
				break;
			case 'teacherNotes':
				$array['testName'] =$value;
				break;
			case 'status':
				$array['status']=$value;
				break;
			case 'pointWorth':
				$array['pointWorth']=$value;
				break;
			case 'answer':
				$array['answer']=$value;
				break;
			/*
			case 'questionList'
				$array['questionList']=$value;
				break;
			case 'pointList'
				$array['pointList']=$value;
				break;
			*/		
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
			$url = '../backend/login.php';
			break;
		//------------------------------------------------------------------------
		case 'questionBankRequest':
			$url = '../backend/questionBank.php';
			break;
		//------------------------------------------------------------------------	
		case 'addQuestionRequest':
			$url = '../backend/addQuestion.php';
			break;
		//------------------------------------------------------------------------	
		case 'deleteQuestionRequest':
			$url = '../backend/deleteQuestion.php';
			break;
		//------------------------------------------------------------------------
		case 'createExam':
			'../backend/createExam.php';
			break;
		//------------------------------------------------------------------------
		case "teacherExamListRequest":
			$url = '../backend/teacherExamList.php';
			break;
		//------------------------------------------------------------------------
		case 'studentExamListRequest':
			$url = '../backend/studentExamList.php';
			break;
		//------------------------------------------------------------------------
		case 'takeExamRequest':
			$url = '../backend/takeExam.php';
			break;
		//------------------------------------------------------------------------	
		case 'examStudentList':
			$url = '../backend/studentExamRequest.php';
			break;
		//------------------------------------------------------------------------
		case 'reviewExamRequest':
			$url = '../backend/reviewExam.php';
			break;
		//------------------------------------------------------------------------	
		case 'examUpdateRequest':
			$url = '../backend/examUpdate.php';
			break;
		//------------------------------------------------------------------------
		case 'examReleaseRequest':
			$url = '../backend/examReleaseScores.php';
			break;
    	//------------------------------------------------------------------------
		case 'teacherExamScoreRequest':
			$url='../backend/teacherExamScore.php';
			break;
		//------------------------------------------------------------------------
		case 'questionBankSortRequest':
			$url='../backend/searchQuestionBank.php';
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