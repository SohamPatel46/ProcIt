<?php

    require 'Connection_Procit_DB.php'; 
    session_start();

    if(isset($_POST['addtoquiz_random']))
    {
        $fid = $_SESSION['ID'];
        $Course_Id = $_GET['Cid'];
        $quiz_id = $_GET['quizid'];

        $take_quiz_name_query = "SELECT Quiz_Name,Total_Question FROM `new_quiz_generate` WHERE ID=$fid && Course_Id = '$Course_Id' && Quiz_Id='$quiz_id' ";

        $take_quiz_name_query_check = mysqli_query($con,$take_quiz_name_query);

        while ($row = mysqli_fetch_array($take_quiz_name_query_check)) {
            
            $quizname = $row['Quiz_Name'];
            $tot_ques = $row['Total_Question'];
        }

        $question_array_saved= array_fill(0,$tot_ques+50,0);

        $quiz_question = "SELECT * FROM `add_quiz_question` WHERE ID=$fid && Course_Id='$Course_Id' && Quiz_Id='$quiz_id' ORDER BY Question_Number ";

        $quiz_question_check = mysqli_query($con,$quiz_question);

        $i=0;
        while($row_question = mysqli_fetch_array($quiz_question_check))
        {
            $question_array_saved[$row_question['Question_Number']] = 1 ;
        }

        if(!empty($_POST['check'])) 
        {
            $i=0;
            foreach($_POST['check'] as $check)
            {
                $select_DB_quiz_question = "SELECT * FROM `add_database_question` WHERE Question_Id='$check' && ID = $fid && Course_Id='$Course_Id' ";
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
                    $type = $row['question_type'];
                    $marks = $row['Marks'];
                }             

                for($k=1;$k<$tot_ques+50;$k++)
                {
                    if($question_array_saved[$k]==0)
                    {
                        $insert_to_quiz = "INSERT INTO `add_quiz_question` VALUES ($fid,'$Course_Id','$quiz_id',$k,'$Question',
                                            '$option1','$option2','$option3','$option4','$Correct_option','$image','$explain','$marks','$type')";

                        if($insert_to_quiz_check = mysqli_query($con,$insert_to_quiz))
                        {
                            echo "ok";
                        }
                        else
                        {
                            echo "Error In Query Execution";
                        }
                        $question_array_saved[$k]=1;
                        break;
                    }
                }
                $i+=1;
            }   
        }
        //header("location:DASHBOARDS/AddQuizQuestion.php?Cid=$Course_Id&Qid=$quiz_id");
        echo "<script type='text/javascript'>
                window.location.replace(\"DASHBOARDS/AddQuizQuestion.php?Cid=$Course_Id&Qid=$quiz_id\");
                </script>
        ";
    }
?>