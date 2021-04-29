<?php
	require 'Connection_Procit_DB.php'; 
	session_start(); 

	$login_email = $_POST['login_email'];
	$login_pass = $_POST['login_password'];

	$email='';
	$pass='';
	$sel_query = "SELECT * FROM `login` WHERE Email_Id = '$login_email' && Password ='$login_pass'";
	$n=5;

	if ($is_query_run = mysqli_query($con,$sel_query)) 
	{ 	
		$row = mysqli_num_rows($is_query_run);
		if($row == 1)
		{
			$start = strlen($login_email) - $n;
			$fac_stu = substr($login_email,$start);
			if($fac_stu === 'du.in')
			{
				$query_executed = mysqli_fetch_array($is_query_run);
				$email = $query_executed['Email_Id'];
				$pass = $query_executed['Password'];

				$sel_query_2 = "SELECT * FROM `faculty_data` WHERE Email_Id = '$login_email'";
				if($is_query_run_2 = mysqli_query($con,$sel_query_2))
				{
					$query_executed_2 = mysqli_fetch_array($is_query_run_2);
					$_SESSION["Email_Id"] = $query_executed_2['Email_Id']; 
					$_SESSION["ID"] = $query_executed_2['ID']; 
					$_SESSION["Name"] = $query_executed_2['Name'];
					$_SESSION['Image'] = $query_executed_2['Image'];
					$_SESSION['login_user_faculty']="True";
					header('location:DASHBOARDS/Main_index.php');
				}
			}
			else if($fac_stu==='ac.in')
			{
				$query_executed = mysqli_fetch_array($is_query_run);
				$email = $query_executed['Email_Id'];
				$pass = $query_executed['Password'];

				$sel_query_2 = "SELECT * FROM `student_data` WHERE Email_Id = '$login_email'";
				if($is_query_run_2 = mysqli_query($con,$sel_query_2))
				{
					$query_executed_2 = mysqli_fetch_array($is_query_run_2);
					$_SESSION["Email_Id"] = $query_executed_2['Email_Id']; 
					$_SESSION["ID"] = $query_executed_2['ID']; 
					$_SESSION["Name"] = $query_executed_2['Name'];
					$_SESSION['Image'] = $query_executed_2['Image'];
					$_SESSION['Deg_Dip'] = $query_executed_2['Degree_Diploma'];
					$_SESSION['Semester'] = $query_executed_2['Semester'];
					$_SESSION['Batch_Year'] = $query_executed_2['Batch_Year'];
					$_SESSION['login_user_student']="True";
					header('location:DASHBOARDS_STUDENT/Main_index.php');
				}
			}				
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