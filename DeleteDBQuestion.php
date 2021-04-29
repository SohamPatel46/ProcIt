<?php
    require 'Connection_Procit_DB.php'; 
    session_start();

    $fid= $_SESSION['ID'];
    $courseid=$_GET['Cid'];
    $question_id = $_GET['questionid'];

    $Delete_DB_question_query = "DELETE FROM `add_database_question` WHERE ID=$fid && Course_Id='$courseid' && Question_Id='$question_id' ";
    if($Delete_DB_question_query_check = mysqli_query($con,$Delete_DB_question_query))
    {
        header("location:DASHBOARDS/QuestionBank.php?Cid=$courseid");
    }
    else
    {
        echo "Error In Query Execution";
    }
?>