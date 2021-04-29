<?php
	require 'Connection_Procit_DB.php'; 
    session_start();

	$cid = $_GET['Cid'];
	$fid = $_SESSION['ID'];
	$Quizid = $_GET['quizid'];

	$take_deg_dip_query = "SELECT * FROM `new_course_add` WHERE ID= $fid && Course_Id = '$cid' ";

	$take_deg_dip_query_check = mysqli_query($con,$take_deg_dip_query);

	while($rows = mysqli_fetch_array($take_deg_dip_query_check))
	{
		$deg_dip = $rows['Degree_Diploma'];
		$acd_gate = $rows['Academic_GATE'];
		$batch_year = $rows['Batch_Year'];
	}

	$Del_quiz_query = "DELETE FROM `new_quiz_generate` WHERE ID=$fid && Course_Id = '$cid' && Quiz_Id = '$Quizid' ";


	if($Del_quiz_query_check = mysqli_query($con,$Del_quiz_query))
	{
		$Del_course_quiz_question_query = "DELETE FROM `add_quiz_question` WHERE ID=$fid && Course_Id = '$cid' && Quiz_Id = '$Quizid' ";
		$Del_course_quiz_question_query_check = mysqli_query($con,$Del_course_quiz_question_query);

		$del_to_do_quiz = "DELETE FROM `to_do_list_student` WHERE Course_Id = '$cid' && Quiz_Id = '$Quizid' ";
		$del_to_do_quiz_check = mysqli_query($con,$del_to_do_quiz);

		$del_from_student_to_do = "DELETE FROM `to_do_list_student` WHERE Course_Id = '$cid' && Quiz_Id = '$Quizid' && Batch_Year='$batch_year' && Degree_diploma='$deg_dip' ";

		if($del_from_student_to_do_check = mysqli_query($con,$del_from_student_to_do))
		{
			header("location:DASHBOARDS/CoursePage.php?Cid=$cid");
		}
		else
		{
			echo "Error in 2 query !!".mysqli_error($con);
		}

	}
	else{
		echo "Error In Execurion";
	}
?>