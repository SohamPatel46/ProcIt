<?php
	require 'Connection_Procit_DB.php'; 
	session_start(); 

	$login_email = $_POST['login_email_pass'];

	$email='';
	$sel_query = "SELECT * FROM `login` WHERE Email_Id = '$login_email' ";
	$n=5;

	if ($is_query_run = mysqli_query($con,$sel_query)) 
	{ 	
		$row = mysqli_num_rows($is_query_run);
		if($row == 1)
		{
			while($roww = mysqli_fetch_array($is_query_run)){
			    $pass = $roww['Password'];
			}
			$msg =  "Email : ".$login_email."<br>Password : ".$pass;
            $subject_mail = "Forgot Password";
            $msg = wordwrap($msg,70);
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            
            // More headers
            $headers .= 'From: <noreply@ictmu.in>' . "\r\n";
            
            mail($login_email,$subject_mail,$msg,$headers);
            header('location:Login/index.html');
		}
		else
		{
			header('location:Login/index.html');
		}
	    	     
	} 
	else
	{ 
	    echo "Error in execution"; 
	}

?>