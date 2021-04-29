<?php


	require 'Connection_Procit_DB.php'; 
    session_start();

	$cid = $_GET['Cid'];
	$fid = $_SESSION['ID'];


	$Del_course_query = "DELETE FROM `new_course_add` WHERE ID=$fid && Course_Id = '$cid' ";

	if($Del_course_query_check = mysqli_query($con,$Del_course_query))
	{
		$Del_course_quiz_query = "DELETE FROM `new_quiz_generate` WHERE ID=$fid && Course_Id = '$cid' ";
		$Del_course_quiz_query_check = mysqli_query($con,$Del_course_quiz_query);
		$Del_course_quiz_question_query = "DELETE FROM `add_quiz_question` WHERE ID=$fid && Course_Id = '$cid' ";
		$Del_course_quiz_question_query_check = mysqli_query($con,$Del_course_quiz_question_query);
		$del_student_to_do = "DELETE FROM `to_do_list_student` WHERE Course_Id = '$cid' ";
		$del_student_to_do_check = mysqli_query($con,$del_student_to_do);
		
		header("location:DASHBOARDS/Main_index.php");
	}
	else{
		echo "Error In Execurion";
	}
?>