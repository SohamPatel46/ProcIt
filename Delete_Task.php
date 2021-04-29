<?php
	require 'Connection_Procit_DB.php'; 
    session_start();

    $Task_No = $_GET['tno'];

    $delete_task = "DELETE FROM `to_do_task_faculty` WHERE Sr_No='$Task_No'";

    if($delete_task_check = mysqli_query($con,$delete_task)){
        header('location:DASHBOARDS/Main_index.php');
    }
    else{
        echo "Error In query Executing";
    }