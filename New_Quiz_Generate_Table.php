<?php
	require 'Connection_Procit_DB.php'; 
    session_start();


    if(isset($_POST['savequiz']))
    {
    	$course_id = $_SESSION['courseidd'];
    	$fid = $_SESSION['ID'];


        $Quiz_Name = $_POST['quizname'];
        $Quiz_Topic = $_POST['quiztopic'];
        $Reference_Link = $_POST['referencelink'];
        $Total_Question = $_POST['totalquestion'];
        $Total_Marks = $_POST['totalmarks'];
        $Date = (string)$_POST['date'];
        $Attempts = $_POST['attempts'];
        $Start_Time = (string)$_POST['stime'];
        $End_Time = (string) $_POST['etime'];


        $take_deg_dip_query = "SELECT * FROM `new_course_add` WHERE ID= $fid && Course_Id = '$course_id' ";

        $take_deg_dip_query_check = mysqli_query($con,$take_deg_dip_query);

        while($rows = mysqli_fetch_array($take_deg_dip_query_check))
        {
            $deg_dip = $rows['Degree_Diploma'];
            $acd_gate = $rows['Academic_GATE'];
            $batch_year = $rows['Batch_Year'];
        }

        

        $total_quiz = "SELECT * FROM `new_quiz_generate` WHERE ID= $fid && Course_Id = '$course_id' ";

        $total_quiz_check = mysqli_query($con,$total_quiz);

        $n_quiz =  mysqli_num_rows($total_quiz_check);
        $n_quiz = (string)($n_quiz + 1);

        $quizId = substr($course_id,0,3).$n_quiz;

    	$new_quiz_add_query = "INSERT INTO `new_quiz_generate` VALUES ($fid,'$course_id','$quizId','$acd_gate','$Quiz_Name','$Quiz_Topic','$Attempts','$Total_Question','$Total_Marks','$Reference_Link','$Date','$Start_Time','$End_Time')";



    	if($new_quiz_add_query_check =  mysqli_query($con,$new_quiz_add_query))
    	{
    		$insert_to_do_student = "INSERT INTO `to_do_list_student` (Course_Id,Degree_diploma,Academic_Gate,Batch_Year,Quiz_Id,
                                Quiz_Name,Topic,Attempts,Marks,Total_Question,Reference_Link,Quiz_Date,Start_Time,End_Time) VALUES 
                                ('$course_id','$deg_dip','$acd_gate','$batch_year','$quizId','$Quiz_Name','$Quiz_Topic','$Attempts','$Total_Marks',
                                '$Total_Question','$Reference_Link','$Date','$Start_Time','$End_Time') ";
            if($insert_to_do_student_check = mysqli_query($con,$insert_to_do_student))
            {
    		    header("location:DASHBOARDS/CoursePage.php?Cid=$course_id");
            }
            else{
                echo "Error in 2nd QUesry".mysqli_error($con);
            }
        }
    	else{
    		echo "Error In executing QUery";
    	}
    }
?>