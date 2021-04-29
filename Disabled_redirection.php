<?php
    require 'Connection_Procit_DB.php'; 
    session_start();
    
    $actual_marks_array = [];
    $p=0;
    $total_mark_actual = 0;
    foreach($_SESSION['question_marks'] as $qmarks){
        $actual_marks_array[$p] = $qmarks;
        $total_mark_actual+=$qmarks;
        $p++;
    }
    $deg_dep = $_SESSION['Deg_Dip'];
    $batch_year = $_SESSION['Batch_Year'];
    $SID=$_SESSION['ID'];
    $cid = $_SESSION['Course_Id'];
    $quiz_id = $_SESSION['Quiz_Id'];
    
    $select_quiz_name = "SELECT * FROM `new_quiz_generate` WHERE Course_Id ='$cid' && Quiz_Id ='$quiz_id' ";
    $select_quiz_name_check = mysqli_query($con,$select_quiz_name);
    
    while($row = mysqli_fetch_array($select_quiz_name_check)){
        $quiz_name = $row['Quiz_Name'];
    }
    
    $select_student_email = "SELECT * FROM `student_data` WHERE ID='$SID' ";
    $select_student_email_check = mysqli_query($con,$select_student_email);
    
    while($row1 = mysqli_fetch_array($select_student_email_check)){
        $to = $row1['Email_Id'];
    }
        
        
    $insert_respose = "INSERT INTO `quiz_respose` (ID,Course_ID,Quiz_ID,Response_string,Correct_string,Flag_string,Score,Out_of,change_screen_count,Face_Count,Attempt,Time_Taken)
                        VALUES ('$SID','$cid','$quiz_id','-','-','-',0,'$total_mark_actual','-','-',1,'Unfair means')";

    if($insert_response_check = mysqli_query($con,$insert_respose))
    {
        
        $msg =  "Quiz Name : ".$quiz_name."<br>Result : Unfair Means<br>Marks : 0";
        $subject_mail = "Quiz Response";
        $msg = wordwrap($msg,70);
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        
        // More headers
        $headers .= 'From: <noreply@ictmu.in>' . "\r\n";
        if(mail($to,$subject_mail,$msg,$headers)){
            //echo "Mail Sent";
            //header("location:DASHBOARDS_STUDENT/CoursePage.php?courseid=$cid&by=$batch_year&dgdp=$deg_dep");
            echo "<script type='text/javascript'>
                    window.location.replace(\"DASHBOARDS_STUDENT/CoursePage.php?courseid=$cid&by=$batch_year&dgdp=$deg_dep\");
                </script>";
        }
        else{
            echo "<script type='text/javascript'>
                    window.location.replace(\"DASHBOARDS_STUDENT/CoursePage.php?courseid=$cid&by=$batch_year&dgdp=$deg_dep\");
                </script>";
        }
    }
    else{
        echo("Error");
    }
?>