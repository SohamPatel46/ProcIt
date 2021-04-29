<?php
    require 'Connection_Procit_DB.php'; 
    session_start();

    $fid= $_SESSION['ID'];
    $courseid=$_GET['courseid'];
    $quizid=$_GET['quizid'];
    $question_no = (int) $_GET['qno'];

    $Delete_quiz_question_query = "DELETE FROM `add_quiz_question` WHERE ID=$fid && Course_Id='$courseid' && Quiz_Id='$quizid' && Question_Number=$question_no ";
    if($Delete_quiz_question_query_check = mysqli_query($con,$Delete_quiz_question_query))
    {
        header("location:DASHBOARDS/previewQuiz.php?courseid=$courseid&quizid=$quizid");
    }
    else
    {
        echo "Error In Query Execution";
    }
?>