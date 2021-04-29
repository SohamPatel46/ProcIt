<?php
	require 'Connection_Procit_DB.php'; 
    session_start();

    if(isset($_POST['editQuiz']))
    {
    	$course_id = $_GET['courseidd'];
    	$fid = $_SESSION['ID'];
    	$Quizzid = $_GET['quizid'];

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


        $edit_quiz_query = "UPDATE `new_quiz_generate` SET Quiz_Name = '$Quiz_Name' , Topic_Name = '$Quiz_Topic' , No_Of_Attempts = $Attempts , Total_Question = $Total_Question , Total_Marks = $Total_Marks , Reference_Link = '$Reference_Link' , Date = '$Date' , Start_Time = '$Start_Time' , End_Time = '$End_Time' WHERE ID=$fid && Course_Id = '$course_id' && Quiz_Id = '$Quizzid' "; 

        if($edit_quiz_query_check = mysqli_query($con,$edit_quiz_query))
        {
        	$update_student_to_do = "UPDATE `to_do_list_student` SET Quiz_Name = '$Quiz_Name' , Topic = '$Quiz_Topic' , Attempts = $Attempts , Total_Question = $Total_Question , Marks = $Total_Marks , Reference_Link = '$Reference_Link' , Quiz_Date = '$Date' , Start_Time = '$Start_Time' , End_Time = '$End_Time' WHERE Course_Id = '$course_id' && Quiz_Id = '$Quizzid' && Degree_diploma='$deg_dip' && Batch_Year='$batch_year' ";
            
            if($update_student_to_do_check = mysqli_query($con,$update_student_to_do))
            {
                header("location:DASHBOARDS/CoursePage.php?Cid=$course_id");
            }
            else
            {
                echo "Eror in 2nd Query".mysqli_error($con);
            }
            
        }
        else
        {
        	echo "Error In query Execution";
        }
    }

?>