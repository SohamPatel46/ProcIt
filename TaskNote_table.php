<?php
	require 'Connection_Procit_DB.php'; 
    session_start();

    if(isset($_POST['addTask']))
    {
    	$SubName = $_POST['subject'];
    	$Date = (string)$_POST['date'];
        $Time = (string)$_POST['time'];
        $Task_Note = $_POST['note'];
        $fid = $_SESSION['ID'];

        $take_sub_id_query = "SELECT * FROM `new_course_add` WHERE Course_Name = '$SubName' && ID='$fid' ";

        $take_sub_id_query_check = mysqli_query($con,$take_sub_id_query);
        $SubId = '';
        while ($rows = mysqli_fetch_array($take_sub_id_query_check)) {
            $SubId = $rows['Course_Id'];
        }
        $to="";
        
        $stringDate = $Date;
        $select_email_login = "SELECT * FROM `faculty_data` WHERE ID='$fid'";
        $select_email_login_check = mysqli_query($con,$select_email_login);
        while($res = mysqli_fetch_array($select_email_login_check)){
            $to = $res['Email_Id'];
        }
    	$add_task_query = "INSERT INTO `to_do_task_faculty` (ID,Course_Id,Task_Date,Task_Time,Remarks) VALUES ($fid,'$SubId','$Date','$Time','$Task_Note')";

    	if($add_task_query_check =  mysqli_query($con,$add_task_query))
    	{
            $msg =  "Task : ".$Task_Note."\nSubject : ".$SubName."\nLast Date : ".$stringDate."\nTime : ".$Time; 
            $subject_mail = "Remainder About To Do Task";
            $msg = wordwrap($msg,70);
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $to = "hitkumar.bhalodia105373@marwadiuniversity.ac.in";
            // More headers
            $headers .= 'From: <noreply@ictmu.in>' . "\r\n";
            //mail($to,$subject_mail,$msg,$headers);
            if (mail($to,$subject_mail,$msg,$headers)) {
                header("location:DASHBOARDS/Main_index.php");
            } else {
                echo "<script>alert('Email sending failed...')</script>";
                header("location:DASHBOARDS/Main_index.php");
            }
    	}
    	else{
    		echo "Error In executing QUery";
    	}
    }
?>

