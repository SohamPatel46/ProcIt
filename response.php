<?php
    require 'Connection_Procit_DB.php'; 
    session_start();
    
    if(isset($_POST['save']))
    {
        $count = $_POST['counter'];
        //$face_count =  $_POST['face_count'];
        //$face_count = round(($face_count/60),2);
        $selected = $_POST['option'];
        $match_follow_1 = $_POST['optiona'];
        $match_follow_2 = $_POST['optionb'];
        $match_follow_3 = $_POST['optionc'];
        $match_follow_4 = $_POST['optiond'];
        
        $_SESSION['End_Time'] = $new_time;

        $tot_ques = $_SESSION['total_questions'];

        $correct_res_array=[];
        $i=1;
        $correct_string="";
        $response_string="";

        foreach($_SESSION['correct'] as $correct_option ){
            #echo $correct_option.'<br>';
            $correct_string = $correct_string.$correct_option.'~';
            $correct_res_array[$i]=$correct_option;
            $i++;
        }

        $array_mcq_fill = [];
        for($ll=1;$ll<=$tot_ques;$ll++){
            if(!empty($selected[$ll])){
                $array_mcq_fill[$ll]=$selected[$ll];
            }
            else{
                $array_mcq_fill[$ll]='na';
            }
        }

        $multiple_question_no_in_question = [];
        $match_following_question_no = [];
        
        for($k=0;$k<=$tot_ques;$k++){
            $multiple_question_no_in_question[$k]=0;
            $match_following_question_no[$k]=0;
        }
        $maq=1;
        foreach($_SESSION['question_type'] as $type){
            if($type=="multiple_answer"){
                $multiple_question_no_in_question[$maq]=1;
            }
            else if($type=="match_following"){
                $match_following_question_no[$maq]=1;
            }
            $maq++;
        }
   
        $maqq=1;
        for($h=1;$h<=$tot_ques;$h++){
            if($multiple_question_no_in_question[$maqq]==1){
                if(!empty($_POST['option'.$maqq])){
                    foreach($_POST['option'.$maqq] as $options){
                        $response_string = $response_string.$options.',';
                    }
                    $response_string = rtrim($response_string, ",");
                    $response_string = $response_string.'~';
                }
                else{
                    $response_string = $response_string.'na'.'~';
                }
            }
            else if($match_following_question_no[$h]==1){
                $response_string = $response_string.$match_follow_1[$h].',';
                $response_string = $response_string.$match_follow_2[$h].',';
                $response_string = $response_string.$match_follow_3[$h].',';
                $response_string = $response_string.$match_follow_4[$h].'~';
            }
            else{
                if($array_mcq_fill[$h]=='na'){
                    $response_string = $response_string.$array_mcq_fill[$h].'~'; 
                }
                else{
                    $response_string = $response_string.$array_mcq_fill[$h].'~';
                }
            }
            $maqq++;
        }

        #echo $correct_string."<br>";
        #echo $response_string."<br>";

        $responses_array = explode('~',$response_string);
        $actual_marks_array = [];
        $p=0;
        $total_mark_actual = 0;
        foreach($_SESSION['question_marks'] as $qmarks){
            $actual_marks_array[$p] = $qmarks;
            $total_mark_actual+=$qmarks;
            $p++;
        }
        /*
        foreach($responses_array as $res)
        {
            echo "<br>".$res."<br>";
        }*/
        /*
        for($o=0;$o<count($responses_array);$o++){
            echo "<br>".$responses_array[$o]."<br>";
        }*/
        $mark=0;
        $flag_string="";
        $total=count($responses_array);
        for($j=1;$j<$total;$j++)
        {
            if($responses_array[$j-1]==$correct_res_array[$j])
            {
               $flag_string=$flag_string."1~";
               $mark+=$actual_marks_array[$j-1];
            }else{
                $flag_string=$flag_string."0~";               
            }
        }
        #echo $mark;
        #$total = $total-1;
        /*---------------Timer Details ----------------------------*/
        $date1 = strtotime($_SESSION['Start_Time']); 
		$date2 = strtotime($_SESSION['End_Time']); 
		
		// Formulate the Difference between two dates 
		$diff = abs($date2 - $date1); 
		
		
		// To get the year divide the resultant date into 
		// total seconds in a year (365*60*60*24) 
		$years = floor($diff / (365*60*60*24)); 
		
		
		// To get the month, subtract it with years and 
		// divide the resultant date into 
		// total seconds in a month (30*60*60*24) 
		$months = floor(($diff - $years * 365*60*60*24) 
									/ (30*60*60*24)); 
		
		
		// To get the day, subtract it with years and 
		// months and divide the resultant date into 
		// total seconds in a days (60*60*24) 
		$days = floor(($diff - $years * 365*60*60*24 - 
					$months*30*60*60*24)/ (60*60*24)); 
		
		
		// To get the hour, subtract it with years, 
		// months & seconds and divide the resultant 
		// date into total seconds in a hours (60*60) 
		$hours = floor(($diff - $years * 365*60*60*24 
			- $months*30*60*60*24 - $days*60*60*24) 
										/ (60*60)); 
		
		
		// To get the minutes, subtract it with years, 
		// months, seconds and hours and divide the 
		// resultant date into total seconds i.e. 60 
		$minutes = floor(($diff - $years * 365*60*60*24 
				- $months*30*60*60*24 - $days*60*60*24 
								- $hours*60*60)/ 60); 
		
		
		// To get the minutes, subtract it with years, 
		// months, seconds, hours and minutes 
        $seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24- $hours*60*60 - $minutes*60));

        $time = $minutes." m ".$seconds." s ";
        
        /*-----------------Time Details------------------>*/
        
        
        
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

        $insert_respose = "INSERT INTO `quiz_respose` (ID,Course_ID,Quiz_ID,Response_string,Correct_string,Flag_string,Score,Out_of,change_screen_count,Face_count,Attempt,Time_Taken)
                           VALUES ('$SID','$cid','$quiz_id','$response_string','$correct_string','$flag_string','$mark','$total_mark_actual','$count','$face_count',1,'$time')";

        if($insert_response_check = mysqli_query($con,$insert_respose))
        {
            $msg =  "Quiz Name : ".$quiz_name."<br>Result : See Portal<br>Marks : ".$mark;
            $subject_mail = "Quiz Response";
            $msg = wordwrap($msg,70);
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            
            // More headers
            $headers .= 'From: <noreply@ictmu.in>' . "\r\n";
            
            $msg_to_sir =  "Quiz Name : ".$quiz_name."<br>Given By:".$to."<br>Marks : ".$mark;
            $subject_mail_sir = "Quiz Response";
            $msg_sir = wordwrap($msg_to_sir,70);
            
            $to_sir="chandrasinh.parmar@marwadieducation.edu.in";
            mail($to_sir,$subject_mail_sir,$msg_sir,$headers);

            
            if(mail($to,$subject_mail,$msg,$headers)){
                //echo "Mail Sent";
                echo "<script>localStorage.removeItem('change_screen');</script>";
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
            
        }else{
            echo("Error");
        }
        #TO add student side datyabase question after quiz#
        /*
            $select_quiz_questions = "SELECT * FROM `add_quiz_question` WHERE Course_Id='$cid' && Quiz_Id='$quiz_id'";
            $select_quiz_questions_check = mysqli_query($con,$select_quiz_questions);
            while($row = mysqli_fetch_array($select_quiz_questions_check))
            {
                $question = $row['Question'];
                $Option1 = $row['Option1'];
                $Option2 = $row['Option2'];
                $Option3 = $row['Option3'];
                $Option4 = $row['Option4'];
                $Correct_Option = $row['Correct_Option'];
                $img = $row['Image'];
                $explaination = $row['Explaination'];
                $topic = $row['Topic'];
                $marks = $row['Marks'];
            }
        */
    }else
    {
        $count = $_POST['counter'];
        //$face_count =  $_POST['face_count'];
        //$face_count = round(($face_count/60),2);
        $selected = $_POST['option'];
        $match_follow_1 = $_POST['optiona'];
        $match_follow_2 = $_POST['optionb'];
        $match_follow_3 = $_POST['optionc'];
        $match_follow_4 = $_POST['optiond'];

        $tot_ques = $_SESSION['total_questions'];
        
        $_SESSION['End_Time'] = $new_time;

        $correct_res_array=[];
        $i=1;
        $correct_string="";
        $response_string="";

        foreach($_SESSION['correct'] as $correct_option ){
            #echo $correct_option.'<br>';
            $correct_string = $correct_string.$correct_option.'~';
            $correct_res_array[$i]=$correct_option;
            $i++;
        }
        
        $array_mcq_fill = [];
        for($ll=1;$ll<=$tot_ques;$ll++){
            if(!empty($selected[$ll])){
                $array_mcq_fill[$ll]=$selected[$ll];
            }
            else{
                $array_mcq_fill[$ll]='na';
            }
        }

        $multiple_question_no_in_question = [];
        $match_following_question_no = [];
        
        for($k=0;$k<=$tot_ques;$k++){
            $multiple_question_no_in_question[$k]=0;
            $match_following_question_no[$k]=0;
        }
        $maq=1;
        foreach($_SESSION['question_type'] as $type){
            if($type=="multiple_answer"){
                $multiple_question_no_in_question[$maq]=1;
            }
            else if($type=="match_following"){
                $match_following_question_no[$maq]=1;
            }
            $maq++;
        }
   
        $maqq=1;
        for($h=1;$h<=$tot_ques;$h++){
            if($multiple_question_no_in_question[$maqq]==1){
                if(!empty($_POST['option'.$maqq])){
                    foreach($_POST['option'.$maqq] as $options){
                        $response_string = $response_string.$options.',';
                    }
                    $response_string = rtrim($response_string, ",");
                    $response_string = $response_string.'~';
                }
                else{
                    $response_string = $response_string.'na'.'~';
                }
                
            }
            else if($match_following_question_no[$h]==1){
                $response_string = $response_string.$match_follow_1[$h].',';
                $response_string = $response_string.$match_follow_2[$h].',';
                $response_string = $response_string.$match_follow_3[$h].',';
                $response_string = $response_string.$match_follow_4[$h].'~';
            }
            else{
                if($array_mcq_fill[$h]=='na'){
                    $response_string = $response_string.$array_mcq_fill[$h].'~'; 
                }
                else{
                    $response_string = $response_string.$array_mcq_fill[$h].'~';
                }
            }
            $maqq++;
        }

        #echo $correct_string."<br>";
        echo $response_string."<br>";

        $responses_array = explode('~',$response_string);
        $actual_marks_array = [];
        $p=0;
        $total_mark_actual = 0;
        foreach($_SESSION['question_marks'] as $qmarks){
            $actual_marks_array[$p] = $qmarks;
            $total_mark_actual+=$qmarks;
            $p++;
        }
        /*
        foreach($responses_array as $res)
        {
            echo "<br>".$res."<br>";
        }*/
        /*
        for($o=0;$o<count($responses_array);$o++){
            echo "<br>".$responses_array[$o]."<br>";
        }*/
        $mark=0;
        $flag_string="";
        $total=count($responses_array);
        for($j=1;$j<$total;$j++)
        {
            if($responses_array[$j-1]==$correct_res_array[$j])
            {
               $flag_string=$flag_string."1~";
               $mark+=$actual_marks_array[$j-1];
            }else{
                $flag_string=$flag_string."0~";               
            }
        }
        #echo $mark;
        #$total = $total-1;
        /*---------------Timer Details ----------------------------*/
        $date1 = strtotime($_SESSION['Start_Time']); 
		$date2 = strtotime($_SESSION['End_Time']); 
		
		// Formulate the Difference between two dates 
		$diff = abs($date2 - $date1); 
		
		
		// To get the year divide the resultant date into 
		// total seconds in a year (365*60*60*24) 
		$years = floor($diff / (365*60*60*24)); 
		
		
		// To get the month, subtract it with years and 
		// divide the resultant date into 
		// total seconds in a month (30*60*60*24) 
		$months = floor(($diff - $years * 365*60*60*24) 
									/ (30*60*60*24)); 
		
		
		// To get the day, subtract it with years and 
		// months and divide the resultant date into 
		// total seconds in a days (60*60*24) 
		$days = floor(($diff - $years * 365*60*60*24 - 
					$months*30*60*60*24)/ (60*60*24)); 
		
		
		// To get the hour, subtract it with years, 
		// months & seconds and divide the resultant 
		// date into total seconds in a hours (60*60) 
		$hours = floor(($diff - $years * 365*60*60*24 
			- $months*30*60*60*24 - $days*60*60*24) 
										/ (60*60)); 
		
		
		// To get the minutes, subtract it with years, 
		// months, seconds and hours and divide the 
		// resultant date into total seconds i.e. 60 
		$minutes = floor(($diff - $years * 365*60*60*24 
				- $months*30*60*60*24 - $days*60*60*24 
								- $hours*60*60)/ 60); 
		
		
		// To get the minutes, subtract it with years, 
		// months, seconds, hours and minutes 
        $seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24- $hours*60*60 - $minutes*60));

        $time = $minutes." m ".$seconds." s ";
        
        /*-----------------Time Details------------------>*/
        
        
        
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

        $insert_respose = "INSERT INTO `quiz_respose` (ID,Course_ID,Quiz_ID,Response_string,Correct_string,Flag_string,Score,Out_of,change_screen_count,Face_count,Attempt,Time_Taken)
                           VALUES ('$SID','$cid','$quiz_id','$response_string','$correct_string','$flag_string','$mark','$total_mark_actual','$count','$face_count',1,'$time')";

        if($insert_response_check = mysqli_query($con,$insert_respose))
        {
            $msg =  "Quiz Name : ".$quiz_name."<br>Result : See Portal<br>Marks : ".$mark;
            $subject_mail = "Quiz Response";
            $msg = wordwrap($msg,70);
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            
            // More headers
            $headers .= 'From: <noreply@ictmu.in>' . "\r\n";
            
            $msg_to_sir =  "Quiz Name : ".$quiz_name."<br>Given By:".$to."<br>Marks : ".$mark;
            $subject_mail_sir = "Quiz Response";
            $msg_sir = wordwrap($msg_to_sir,70);
            
            $to_sir="chandrasinh.parmar@marwadieducation.edu.in";
            mail($to_sir,$subject_mail_sir,$msg_sir,$headers);
            if(mail($to,$subject_mail,$msg,$headers)){
                //echo "Mail Sent";
                echo "<script>localStorage.removeItem('change_screen');</script>";
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
            
        }else{
            echo("Error");
        }
        
        #TO add student side datyabase question after quiz#
        /*
            $select_quiz_questions = "SELECT * FROM `add_quiz_question` WHERE Course_Id='$cid' && Quiz_Id='$quiz_id'";
            $select_quiz_questions_check = mysqli_query($con,$select_quiz_questions);
            while($row = mysqli_fetch_array($select_quiz_questions_check))
            {
                $question = $row['Question'];
                $Option1 = $row['Option1'];
                $Option2 = $row['Option2'];
                $Option3 = $row['Option3'];
                $Option4 = $row['Option4'];
                $Correct_Option = $row['Correct_Option'];
                $img = $row['Image'];
                $explaination = $row['Explaination'];
                $topic = $row['Topic'];
                $marks = $row['Marks'];
            }
        */
    }
?>