<?php
    require 'Connection_Procit_DB.php'; 
    session_start();

    if(isset($_POST['addtoquiz']))
    {
        $fid = $_SESSION['ID'];
        $courseid = $_GET['Cid'];
        $quizid = $_GET['quizid'];
        $question_no_quiz = $_GET['qno'];
        $type = $_GET['qtype'];
        $question_id = $_POST['radio1'];

        $select_DB_quiz_question = "SELECT * FROM `add_database_question` WHERE Question_Id='$question_id' && ID = $fid && Course_Id='$courseid'";
        $select_DB_quiz_question_check = mysqli_query($con,$select_DB_quiz_question);

        while($row = mysqli_fetch_array($select_DB_quiz_question_check))
        {
            $Question = $row['Question'];
            $option1 = $row['Option1'];
            $option2 = $row['Option2'];
            $option3 = $row['Option3'];
            $option4 = $row['Option4'];
            $Correct_option = $row['Correct_Option'];
            $image = $row['Image'];
            $explain = $row['Explaination'];
            $marks = $row['Marks'];
        }
        $insert_to_quiz = "INSERT INTO `add_quiz_question` VALUES ($fid,'$courseid','$quizid',$question_no_quiz,'$Question',
                            '$option1','$option2','$option3','$option4','$Correct_option','$image','$explain','$marks','$type')";

        if($insert_to_quiz_check = mysqli_query($con,$insert_to_quiz))
        {
            header("location:DASHBOARDS/AddQuizQuestion.php?Cid=$courseid&Qid=$quizid");
        }
        else
        {
            echo "Error In Query Execution";
        }
    }
?>