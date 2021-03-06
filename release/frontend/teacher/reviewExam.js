var examName ="";
var studentName ="";
var question_ids = [];
var questionDB = [];

window.onload=function() {
	loggedInTeacher();
	examName = window.localStorage.getItem('examName');
	studentName = window.localStorage.getItem('studentName');
	ajaxCallTeacherReview(studentName, examName);
	document.getElementById('exam_name').innerHTML = "Exam Name: "+examName;
	document.getElementById('student_name').innerHTML = "Student Name: "+ studentName;
}; 

function populateExam(response) {
	var questionDB = JSON.parse(response);
	console.log(questionDB);

	for (var i in questionDB) {
		var exam_node = document.getElementById("question_list");
		var new_div = document.createElement("div");
		new_div.id = "question_wrapper_"+i;
		new_div.innerHTML =  `
		<div class="review-container">
			<form>
			<div class="container-title">
				<div class="caption">
					<span class="caption-title" id="question_name_`+i+`"> Op </span>
					<span class="caption-explain" id="point_worth_`+i+`"> Points: </span>
					<input type="text" id="student_score_`+i+`" style="width: 20px;" value=`+questionDB[i][grade]+`><span>/`+questionDB[i][maxGrade]+`</span>
				</div>
			</div>
			<div class="review-body">
				<div class="question">
					<h4 id="question_id_`+i+`"> Question ID: 33 </h4>
					<p id="question_`+i+`"></p>
				</div>
				<div class="answerbox">
					<h4>  Student Answer: </h4>
					<div>
						<textarea disabled class="reviewanswer" id="student_answer_`+i+`">`+questionDB[i][answer]+`</textarea>
					</div>
				</div>
				<div class="teacherNotes">
					<h4>  Teacher Notes: </h4>
					<textarea class="teacheranswer" id="teacher_notes_`+i+`">`+questionDB[i][teacherNotes]+`</textarea>
				</div>
				<div class="autoNotes">
					<table>
						<thead>
							<tr>
								<th>Generated Notes</th>
							</tr>
						</thead>
						<tbody id="autoNotes_table_`+i+`">
						</tbody>
					</table>
				</div>
			</div>
			</form>
		</div>
				`;
		exam_node.appendChild(new_div);
		question_ids.push(i);
		var table = document.getElementById("autoNotes_table_"+i);
		var notes = questionDB[i][autoNotes].split(";");
		for (var j in notes) {
			var tr = document.createElement("tr");
			var autoNotes_td = document.createElement("td")
			var autoNotes = notes[j];
			autoNotes_id.id="note_"+j;
			autoNotes_td.appendChild(autoNotes);
			table.appendChild(tr);
		}
	}
}

function updateStudentExam() {
	//console.log(document.getElementById("student_score_1").value);
	for (var i in question_ids) {
			var id = question_ids[i];
			var grade =  document.getElementById("student_score_"+id).value;
			var teacherNotes = document.getElementById("teacher_notes_"+id).value;
		
			array = {
				"header": "examUpdateRequest",
				"username": studentName,
				"examName": examName,
				"id":question_ids[i],
				"grade":grade,
				"teacherNotes": teacherNotes
			}
			fields = JSON.stringify(array);
			ajaxUpdateExamRequest(fields);	
	}	
}

function ajaxUpdateExamRequest(fields) {
	var data = 'json_string='+fields;
	console.log(data);
	var request = new XMLHttpRequest();

	request.open('POST', '../php/frontend.php', true);
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=utf-8');
	request.send(data);
	
	request.onload = function() {
		if (request.status >= 200 && request.status < 400) {
			var response = request.responseText;
			console.log(response)
			document.getElementById("status").innerHTML = "Update Complete";
		} else {
			console.log("Error: failed to recieve PHP response")
		}
	};
}

function ajaxCallTeacherReview(username, examName) {
	var data = 'json_string={"header":"reviewExamRequest","examName":"'+examName+'","username":"'+username+'"}';
	var request = new XMLHttpRequest();
	console.log(data);

	request.open('POST', '../php/frontend.php', true);
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=utf-8');
	request.send(data);

	request.onload = function() {
		if (request.status >= 200 && request.status < 400) {
			var response = request.responseText;
			populateExam(response);
		} else {
			console.log("Error: failed to recieve PHP response")
		}
	};	
}