<?php
	require 'Connection_Procit_DB.php'; 
    session_start(); 

    if(isset($_POST['exit']))
    {
        $course_id = $_GET['cid']; 
        $deg_dep = $_SESSION['Deg_Dip'];
        $batch_year = $_SESSION['Batch_Year'];
        header("location:DASHBOARDS_STUDENT/CoursePage.php?courseid=$course_id&by=$batch_year&dgdp=$deg_dep");
    }
?>