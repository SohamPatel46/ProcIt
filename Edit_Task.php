<?php
	require 'Connection_Procit_DB.php'; 
    session_start();

    if(isset($_POST['editTask']))
    {
    	$SubName = $_POST['subject'];
    	$Date = (string)$_POST['Edit_date'];
        $Time = (string)$_POST['Edittime'];
        $Task_Note = $_POST['Editnote'];
        $fid = $_SESSION['ID'];

        $take_sub_id_query = "SELECT * FROM `new_course_add` WHERE Course_Name = '$SubName' && ID='$fid'";

        $take_sub_id_query_check = mysqli_query($con,$take_sub_id_query);
        $SubId = '';
        while ($rows = mysqli_fetch_array($take_sub_id_query_check)) {
            $SubId = $rows['Course_Id'];
        }
        
        $stringDate = $Date;
        $select_email_login = "SELECT * FROM `faculty_data` WHERE ID='$fid'";
        $select_email_login_check = mysqli_query($con,$select_email_login);
        while($res = mysqli_fetch_array($select_email_login_check)){
            $to = $res['Email_Id'];
        }

        $task_no = $_GET['tno'];
    	$update_task_query = "UPDATE `to_do_task_faculty` SET Course_Id='$SubId' , Task_Date='$Date' , Task_Time='$Time' , Remarks='$Task_Note' WHERE Sr_No='$task_no' ";

    	if($update_task_query_check =  mysqli_query($con,$update_task_query))
    	{
            $msg =  "Task : ".$Task_Note."\nSubject : ".$SubName."\nLast Date : ".$stringDate."\nTime : ".$Time; 
            $subject_mail = "Edited Task - Remainder About To Do Task";
            $msg = wordwrap($msg,70);
            
            if (mail($to,$subject_mail,$msg, 'From: hitkumar.bhalodia105373@marwadiuniversity.ac.in')) {
                header("location:DASHBOARDS/Main_index.php");
            } else {
                echo "Email sending failed...";
                header("location:DASHBOARDS/Main_index.php");
            }
    	}
    	else{
    		echo "Error In executing QUery";
    	}
    }
?>

