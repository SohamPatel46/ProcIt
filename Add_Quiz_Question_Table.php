<?php
    require 'Connection_Procit_DB.php'; 
    session_start();

    if(isset($_POST['save_question']))
    {
        $fid = $_SESSION['ID'];
        $Course_id = $_GET['cid'];
        $Quiz_id = $_GET['qid'];
        $question_Number = (int)$_POST['question_number'];
        
        $Question = $_POST['question'];
        $Option_1 = $_POST['option1'];
        $Option_2 = $_POST['option2'];
        $Option_3 = $_POST['option3'];
        $Option_4 = $_POST['option4'];
        $Correct_option = $_POST['correctoption'];
        $Question_Marks = $_POST['questionmarks'];
        $Explaination = $_POST['explaination'];
        $type = "mcqs";

        $name = $_FILES['question_img']['name'];
		$target_dir = "Uploads/";

        if(!file_exists($_FILES['question_img']['tmp_name']))
        {
            $select_topic_quiz = "SELECT * FROM `new_quiz_generate` WHERE ID=$fid && Course_Id='$Course_id' && Quiz_Id='$Quiz_id' ";
            $select_topic_quiz_check = mysqli_query($con,$select_topic_quiz);
            while($row=mysqli_fetch_array($select_topic_quiz_check))
            {
                $quiz_topic= $row['Topic_Name'];
            }
            $upload_file = "Uploads/notverified.jpg";
            $Add_particular_quiz_question_query = "INSERT INTO `add_quiz_question` VALUES ($fid,'$Course_id','$Quiz_id',
                                                        $question_Number,'$Question','$Option_1','$Option_2',
                                                        '$Option_3','$Option_4','$Correct_option','$upload_file','$Explaination','$Question_Marks','$type') ";
            
            $Add_To_Database_question_query = "INSERT INTO `add_database_question` (ID,Course_Id,Question,Option1,Option2,Option3,Option4,Correct_Option,Image,Explaination,Topic,Marks,question_type)
                                            VALUES ($fid,'$Course_id','$Question','$Option_1','$Option_2',
                                                    '$Option_3','$Option_4','$Correct_option','$upload_file','$Explaination','$quiz_topic','$Question_Marks','$type') ";

            $Add_To_Database_question_query_check = mysqli_query($con,$Add_To_Database_question_query);

            if($Add_particular_quiz_question_query = mysqli_query($con,$Add_particular_quiz_question_query))
            {
                header("location:DASHBOARDS/AddQuizQuestion.php?Cid=$Course_id&Qid=$Quiz_id");
            }
            else{
                echo "Error In Query Exectuion";
            }
        }
        else
        {
            $target_file = $target_dir.basename($_FILES['question_img']['name']);

            $img_file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            $extension_arr = array("JPG","jpg","JPEG","jpeg","PNG","png","gif");

            if(in_array($img_file_type,$extension_arr))
            {

                $select_topic_quiz = "SELECT * FROM `new_quiz_generate` WHERE ID=$fid && Course_Id='$Course_id' && Quiz_Id='$Quiz_id' ";
                $select_topic_quiz_check = mysqli_query($con,$select_topic_quiz);
                while($row=mysqli_fetch_array($select_topic_quiz_check))
                {
                    $quiz_topic= $row['Topic_Name'];
                }
                $Add_particular_quiz_question_query = "INSERT INTO `add_quiz_question` VALUES ($fid,'$Course_id','$Quiz_id',
                                                            $question_Number,'$Question','$Option_1','$Option_2',
                                                            '$Option_3','$Option_4','$Correct_option','$target_file','$Explaination','$Question_Marks','$type') ";
                
                $Add_To_Database_question_query = "INSERT INTO `add_database_question` (ID,Course_Id,Question,Option1,Option2,Option3,Option4,Correct_Option,Image,Explaination,Topic,Marks,question_type)
                                                VALUES ($fid,'$Course_id','$Question','$Option_1','$Option_2',
                                                        '$Option_3','$Option_4','$Correct_option','$target_file','$Explaination','$quiz_topic','$Question_Marks','$type') ";

                $Add_To_Database_question_query_check = mysqli_query($con,$Add_To_Database_question_query);

                if($Add_particular_quiz_question_query = mysqli_query($con,$Add_particular_quiz_question_query))
                {
                    move_uploaded_file($_FILES['question_img']['tmp_name'], $target_dir.$name);
                    header("location:DASHBOARDS/AddQuizQuestion.php?Cid=$Course_id&Qid=$Quiz_id");
                }
                else{
                    echo "Error In Query Exectuion";
                }
            }
        }
    }
    else if(isset($_POST['save_question_oneword'])){
        $fid = $_SESSION['ID'];
        $Course_id = $_GET['cid'];
        $Quiz_id = $_GET['qid'];
        $question_Number = (int)$_POST['question_number_oneword'];

        $Question = $_POST['question_oneword'];
        $Option_1 = "--";
        $Option_2 = "--";
        $Option_3 = "--";
        $Option_4 = "--";
        $Correct_option = $_POST['correctoption_oneword'];
        $Question_Marks = $_POST['questionmarks_oneword'];
        $Explaination = $_POST['explaination_oneword'];
        $type = "oneword";

        $name = $_FILES['question_img_oneword']['name'];
        $target_dir = "Uploads/";
        
        if(!file_exists($_FILES['question_img_oneword']['tmp_name'])){
            $select_topic_quiz = "SELECT * FROM `new_quiz_generate` WHERE ID=$fid && Course_Id='$Course_id' && Quiz_Id='$Quiz_id' ";
            $select_topic_quiz_check = mysqli_query($con,$select_topic_quiz);
            while($row=mysqli_fetch_array($select_topic_quiz_check))
            {
                $quiz_topic= $row['Topic_Name'];
            }
            $upload_file = "Uploads/notverified.jpg";
            $Add_particular_quiz_question_query = "INSERT INTO `add_quiz_question` VALUES ($fid,'$Course_id','$Quiz_id',
                                                    $question_Number,'$Question','$Option_1','$Option_2',
                                                    '$Option_3','$Option_4','$Correct_option','$upload_file','$Explaination','$Question_Marks','$type') ";
            
            $Add_To_Database_question_query = "INSERT INTO `add_database_question` (ID,Course_Id,Question,Option1,Option2,Option3,Option4,Correct_Option,Image,Explaination,Topic,Marks,question_type)
                                            VALUES ($fid,'$Course_id','$Question','$Option_1','$Option_2',
                                                    '$Option_3','$Option_4','$Correct_option','$upload_file','$Explaination','$quiz_topic','$Question_Marks','$type') ";

            $Add_To_Database_question_query_check = mysqli_query($con,$Add_To_Database_question_query);


            if($Add_particular_quiz_question_query = mysqli_query($con,$Add_particular_quiz_question_query))
            {
                header("location:DASHBOARDS/AddQuizQuestion.php?Cid=$Course_id&Qid=$Quiz_id");
            }
            else{
                echo "Error In Query Exectuion";
            }
        }
        else{
            $target_file = $target_dir.basename($_FILES['question_img_oneword']['name']);

            $img_file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            $extension_arr = array("JPG","jpg","JPEG","jpeg","PNG","png","gif");

            if(in_array($img_file_type,$extension_arr)){
                $select_topic_quiz = "SELECT * FROM `new_quiz_generate` WHERE ID=$fid && Course_Id='$Course_id' && Quiz_Id='$Quiz_id' ";
                $select_topic_quiz_check = mysqli_query($con,$select_topic_quiz);
                while($row=mysqli_fetch_array($select_topic_quiz_check)){
                    $quiz_topic= $row['Topic_Name'];
                }
                $Add_particular_quiz_question_query = "INSERT INTO `add_quiz_question` VALUES ($fid,'$Course_id','$Quiz_id',
                                                        $question_Number,'$Question','$Option_1','$Option_2',
                                                        '$Option_3','$Option_4','$Correct_option','$target_file','$Explaination','$Question_Marks','$type') ";
                
                $Add_To_Database_question_query = "INSERT INTO `add_database_question` (ID,Course_Id,Question,Option1,Option2,Option3,Option4,Correct_Option,Image,Explaination,Topic,Marks,question_type)
                                            VALUES ($fid,'$Course_id','$Question','$Option_1','$Option_2',
                                                    '$Option_3','$Option_4','$Correct_option','$upload_file','$Explaination','$quiz_topic','$Question_Marks','$type') ";

                $Add_To_Database_question_query_check = mysqli_query($con,$Add_To_Database_question_query);

                if($Add_particular_quiz_question_query = mysqli_query($con,$Add_particular_quiz_question_query)){
                    move_uploaded_file($_FILES['question_img_oneword']['tmp_name'], $target_dir.$name);
                    header("location:DASHBOARDS/AddQuizQuestion.php?Cid=$Course_id&Qid=$Quiz_id");
                }
                else{
                    echo "Error In Query Exectuion";
                }
            }
        }
    }
    else if(isset($_POST['save_question_numerical'])){
        $fid = $_SESSION['ID'];
        $Course_id = $_GET['cid'];
        $Quiz_id = $_GET['qid'];
        $question_Number = (int)$_POST['question_number_numerical'];

        $Question = $_POST['question_numerical'];
        $Option_1 = "--";
        $Option_2 = "--";
        $Option_3 = "--";
        $Option_4 = "--";
        $Correct_option = $_POST['correctoption_numerical'];
        $Question_Marks = $_POST['questionmarks_numerical'];
        $Explaination = $_POST['explaination_numerical'];
        $type = "numerical";

        $name = $_FILES['question_img_numerical']['name'];
        $target_dir = "Uploads/";
        
        if(!file_exists($_FILES['question_img_numerical']['tmp_name'])){
            $select_topic_quiz = "SELECT * FROM `new_quiz_generate` WHERE ID=$fid && Course_Id='$Course_id' && Quiz_Id='$Quiz_id' ";
            $select_topic_quiz_check = mysqli_query($con,$select_topic_quiz);
            while($row=mysqli_fetch_array($select_topic_quiz_check))
            {
                $quiz_topic= $row['Topic_Name'];
            }
            $upload_file = "Uploads/notverified.jpg";
            $Add_particular_quiz_question_query = "INSERT INTO `add_quiz_question` VALUES ($fid,'$Course_id','$Quiz_id',
                                                    $question_Number,'$Question','$Option_1','$Option_2',
                                                    '$Option_3','$Option_4','$Correct_option','$upload_file','$Explaination','$Question_Marks','$type') ";
            
            $Add_To_Database_question_query = "INSERT INTO `add_database_question` (ID,Course_Id,Question,Option1,Option2,Option3,Option4,Correct_Option,Image,Explaination,Topic,Marks,question_type)
                                            VALUES ($fid,'$Course_id','$Question','$Option_1','$Option_2',
                                                    '$Option_3','$Option_4','$Correct_option','$upload_file','$Explaination','$quiz_topic','$Question_Marks','$type') ";

            $Add_To_Database_question_query_check = mysqli_query($con,$Add_To_Database_question_query);
            
            if($Add_particular_quiz_question_query = mysqli_query($con,$Add_particular_quiz_question_query))
            {
                header("location:DASHBOARDS/AddQuizQuestion.php?Cid=$Course_id&Qid=$Quiz_id");
            }
            else{
                echo "Error In Query Exectuion";
            }
        }
        else{
            $target_file = $target_dir.basename($_FILES['question_img_numerical']['name']);

            $img_file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            $extension_arr = array("JPG","jpg","JPEG","jpeg","PNG","png","gif");

            if(in_array($img_file_type,$extension_arr)){
                $select_topic_quiz = "SELECT * FROM `new_quiz_generate` WHERE ID=$fid && Course_Id='$Course_id' && Quiz_Id='$Quiz_id' ";
                $select_topic_quiz_check = mysqli_query($con,$select_topic_quiz);
                while($row=mysqli_fetch_array($select_topic_quiz_check)){
                    $quiz_topic= $row['Topic_Name'];
                }
                $Add_particular_quiz_question_query = "INSERT INTO `add_quiz_question` VALUES ($fid,'$Course_id','$Quiz_id',
                                                        $question_Number,'$Question','$Option_1','$Option_2',
                                                        '$Option_3','$Option_4','$Correct_option','$target_file','$Explaination','$Question_Marks','$type') ";
                
                $Add_To_Database_question_query = "INSERT INTO `add_database_question` (ID,Course_Id,Question,Option1,Option2,Option3,Option4,Correct_Option,Image,Explaination,Topic,Marks,question_type)
                                            VALUES ($fid,'$Course_id','$Question','$Option_1','$Option_2',
                                                    '$Option_3','$Option_4','$Correct_option','$upload_file','$Explaination','$quiz_topic','$Question_Marks','$type') ";

                $Add_To_Database_question_query_check = mysqli_query($con,$Add_To_Database_question_query);

                if($Add_particular_quiz_question_query = mysqli_query($con,$Add_particular_quiz_question_query)){
                    move_uploaded_file($_FILES['question_img_numerical']['tmp_name'], $target_dir.$name);
                    header("location:DASHBOARDS/AddQuizQuestion.php?Cid=$Course_id&Qid=$Quiz_id");
                }
                else{
                    echo "Error In Query Exectuion";
                }
            }
        }
    }
    else if(isset($_POST['save_question_multipleanswer'])){
        $fid = $_SESSION['ID'];
        $Course_id = $_GET['cid'];
        $Quiz_id = $_GET['qid'];
        $question_Number = (int)$_POST['question_number_multipleanswer'];

        $Question = $_POST['question_multipleanswer'];
        $Option_1 = $_POST['option1_multipleanswer'];
        $Option_2 = $_POST['option2_multipleanswer'];
        $Option_3 = $_POST['option3_multipleanswer'];
        $Option_4 = $_POST['option4_multipleanswer'];
        $Correct_option = $_POST['correctoption_multipleanswer'];
        $Question_Marks = $_POST['questionmarks_multipleanswer'];
        $Explaination = $_POST['explaination_multipleanswer'];
        $type = "multiple_answer";

        $name = $_FILES['question_img_multipleanswer']['name'];
        $target_dir = "Uploads/";
        
        if(!file_exists($_FILES['question_img_multipleanswer']['tmp_name'])){
            $select_topic_quiz = "SELECT * FROM `new_quiz_generate` WHERE ID=$fid && Course_Id='$Course_id' && Quiz_Id='$Quiz_id' ";
            $select_topic_quiz_check = mysqli_query($con,$select_topic_quiz);
            while($row=mysqli_fetch_array($select_topic_quiz_check))
            {
                $quiz_topic= $row['Topic_Name'];
            }
            $upload_file = "Uploads/notverified.jpg";
            $Add_particular_quiz_question_query = "INSERT INTO `add_quiz_question` VALUES ($fid,'$Course_id','$Quiz_id',
                                                    $question_Number,'$Question','$Option_1','$Option_2',
                                                    '$Option_3','$Option_4','$Correct_option','$upload_file','$Explaination','$Question_Marks','$type') ";
            
            $Add_To_Database_question_query = "INSERT INTO `add_database_question` (ID,Course_Id,Question,Option1,Option2,Option3,Option4,Correct_Option,Image,Explaination,Topic,Marks,question_type)
                                            VALUES ($fid,'$Course_id','$Question','$Option_1','$Option_2',
                                                    '$Option_3','$Option_4','$Correct_option','$upload_file','$Explaination','$quiz_topic','$Question_Marks','$type') ";

            $Add_To_Database_question_query_check = mysqli_query($con,$Add_To_Database_question_query);
            
            if($Add_particular_quiz_question_query = mysqli_query($con,$Add_particular_quiz_question_query))
            {
                header("location:DASHBOARDS/AddQuizQuestion.php?Cid=$Course_id&Qid=$Quiz_id");
            }
            else{
                echo "Error In Query Exectuion";
            }
        }
        else{
            $target_file = $target_dir.basename($_FILES['question_img_multipleanswer']['name']);

            $img_file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            $extension_arr = array("JPG","jpg","JPEG","jpeg","PNG","png","gif");

            if(in_array($img_file_type,$extension_arr)){
                $select_topic_quiz = "SELECT * FROM `new_quiz_generate` WHERE ID=$fid && Course_Id='$Course_id' && Quiz_Id='$Quiz_id' ";
                $select_topic_quiz_check = mysqli_query($con,$select_topic_quiz);
                while($row=mysqli_fetch_array($select_topic_quiz_check)){
                    $quiz_topic= $row['Topic_Name'];
                }
                $Add_particular_quiz_question_query = "INSERT INTO `add_quiz_question` VALUES ($fid,'$Course_id','$Quiz_id',
                                                        $question_Number,'$Question','$Option_1','$Option_2',
                                                        '$Option_3','$Option_4','$Correct_option','$target_file','$Explaination','$Question_Marks','$type') ";
                
                $Add_To_Database_question_query = "INSERT INTO `add_database_question` (ID,Course_Id,Question,Option1,Option2,Option3,Option4,Correct_Option,Image,Explaination,Topic,Marks,question_type)
                                            VALUES ($fid,'$Course_id','$Question','$Option_1','$Option_2',
                                                    '$Option_3','$Option_4','$Correct_option','$upload_file','$Explaination','$quiz_topic','$Question_Marks','$type') ";

                $Add_To_Database_question_query_check = mysqli_query($con,$Add_To_Database_question_query);

                if($Add_particular_quiz_question_query = mysqli_query($con,$Add_particular_quiz_question_query)){
                    move_uploaded_file($_FILES['question_img_multipleanswer']['tmp_name'], $target_dir.$name);
                    header("location:DASHBOARDS/AddQuizQuestion.php?Cid=$Course_id&Qid=$Quiz_id");
                }
                else{
                    echo "Error In Query Exectuion";
                }
            }
        }
    }
    else if(isset($_POST['save_question_true_false'])){
        $fid = $_SESSION['ID'];
        $Course_id = $_GET['cid'];
        $Quiz_id = $_GET['qid'];
        $question_Number = (int)$_POST['question_number_true_false'];

        $Question = $_POST['question_truefalse'];
        $Option_1 = "--";
        $Option_2 = "--";
        $Option_3 = "--";
        $Option_4 = "--";
        $Correct_option = $_POST['truefalse'];
        $Question_Marks = $_POST['questionmarks_truefalse'];
        $Explaination = $_POST['explaination_true_false'];
        $type = "T_F";

        $name = $_FILES['question_img_truefalse']['name'];
        $target_dir = "Uploads/";
        
        if(!file_exists($_FILES['question_img_truefalse']['tmp_name'])){
            $select_topic_quiz = "SELECT * FROM `new_quiz_generate` WHERE ID=$fid && Course_Id='$Course_id' && Quiz_Id='$Quiz_id' ";
            $select_topic_quiz_check = mysqli_query($con,$select_topic_quiz);
            while($row=mysqli_fetch_array($select_topic_quiz_check))
            {
                $quiz_topic= $row['Topic_Name'];
            }
            $upload_file = "Uploads/notverified.jpg";
            $Add_particular_quiz_question_query = "INSERT INTO `add_quiz_question` VALUES ($fid,'$Course_id','$Quiz_id',
                                                    $question_Number,'$Question','$Option_1','$Option_2',
                                                    '$Option_3','$Option_4','$Correct_option','$upload_file','$Explaination','$Question_Marks','$type') ";
            
            $Add_To_Database_question_query = "INSERT INTO `add_database_question` (ID,Course_Id,Question,Option1,Option2,Option3,Option4,Correct_Option,Image,Explaination,Topic,Marks,question_type)
                                            VALUES ($fid,'$Course_id','$Question','$Option_1','$Option_2',
                                                    '$Option_3','$Option_4','$Correct_option','$upload_file','$Explaination','$quiz_topic','$Question_Marks','$type') ";

            $Add_To_Database_question_query_check = mysqli_query($con,$Add_To_Database_question_query);
            
            if($Add_particular_quiz_question_query = mysqli_query($con,$Add_particular_quiz_question_query))
            {
                header("location:DASHBOARDS/AddQuizQuestion.php?Cid=$Course_id&Qid=$Quiz_id");
            }
            else{
                echo "Error In Query Exectuion";
            }
        }
        else{
            $target_file = $target_dir.basename($_FILES['question_img_truefalse']['name']);

            $img_file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            $extension_arr = array("JPG","jpg","JPEG","jpeg","PNG","png","gif");

            if(in_array($img_file_type,$extension_arr)){
                $select_topic_quiz = "SELECT * FROM `new_quiz_generate` WHERE ID=$fid && Course_Id='$Course_id' && Quiz_Id='$Quiz_id' ";
                $select_topic_quiz_check = mysqli_query($con,$select_topic_quiz);
                while($row=mysqli_fetch_array($select_topic_quiz_check)){
                    $quiz_topic= $row['Topic_Name'];
                }
                $Add_particular_quiz_question_query = "INSERT INTO `add_quiz_question` VALUES ($fid,'$Course_id','$Quiz_id',
                                                        $question_Number,'$Question','$Option_1','$Option_2',
                                                        '$Option_3','$Option_4','$Correct_option','$target_file','$Explaination','$Question_Marks','$type') ";
                
                $Add_To_Database_question_query = "INSERT INTO `add_database_question` (ID,Course_Id,Question,Option1,Option2,Option3,Option4,Correct_Option,Image,Explaination,Topic,Marks,question_type)
                                            VALUES ($fid,'$Course_id','$Question','$Option_1','$Option_2',
                                                    '$Option_3','$Option_4','$Correct_option','$upload_file','$Explaination','$quiz_topic','$Question_Marks','$type') ";

                $Add_To_Database_question_query_check = mysqli_query($con,$Add_To_Database_question_query);

                if($Add_particular_quiz_question_query = mysqli_query($con,$Add_particular_quiz_question_query)){
                    move_uploaded_file($_FILES['question_img_truefalse']['tmp_name'], $target_dir.$name);
                    header("location:DASHBOARDS/AddQuizQuestion.php?Cid=$Course_id&Qid=$Quiz_id");
                }
                else{
                    echo "Error In Query Exectuion";
                }
            }
        }
    }
    else if(isset($_POST['save_question_matchfollowing'])){
        $fid = $_SESSION['ID'];
        $Course_id = $_GET['cid'];
        $Quiz_id = $_GET['qid'];
        $question_Number = (int)$_POST['question_number_matchfollowing'];

        $Question = $_POST['question_matchfollowing'];
        $Option_1_a = $_POST['option1_matchfollowing'];
        $Option_2_b = $_POST['option2_matchfollowing'];
        $Option_3_c = $_POST['option3_matchfollowing'];
        $Option_4_d = $_POST['option4_matchfollowing'];
        $Option_a = $_POST['optiona_matchfollowing'];
        $Option_b = $_POST['optionb_matchfollowing'];
        $Option_c = $_POST['optionc_matchfollowing'];
        $Option_d = $_POST['optiond_matchfollowing'];
        $Correct_option = $_POST['correctoption_matchfollowing'];
        $Question_Marks = $_POST['questionmarks_matchfollowing'];
        $Explaination = $_POST['explaination_matchfollowing'];
        $type = "match_following";

        $Option_1 = $Option_1_a.",".$Option_a;
        $Option_2 = $Option_2_b.",".$Option_b;
        $Option_3 = $Option_3_c.",".$Option_c;
        $Option_4 = $Option_4_d.",".$Option_d;

        $name = $_FILES['question_img_matchfollowing']['name'];
        $target_dir = "Uploads/";
        
        if(!file_exists($_FILES['question_img_matchfollowing']['tmp_name'])){
            $select_topic_quiz = "SELECT * FROM `new_quiz_generate` WHERE ID=$fid && Course_Id='$Course_id' && Quiz_Id='$Quiz_id' ";
            $select_topic_quiz_check = mysqli_query($con,$select_topic_quiz);
            while($row=mysqli_fetch_array($select_topic_quiz_check))
            {
                $quiz_topic= $row['Topic_Name'];
            }
            $upload_file = "Uploads/notverified.jpg";
            $Add_particular_quiz_question_query = "INSERT INTO `add_quiz_question` VALUES ($fid,'$Course_id','$Quiz_id',
                                                    $question_Number,'$Question','$Option_1','$Option_2',
                                                    '$Option_3','$Option_4','$Correct_option','$upload_file','$Explaination','$Question_Marks','$type') ";
            
            $Add_To_Database_question_query = "INSERT INTO `add_database_question` (ID,Course_Id,Question,Option1,Option2,Option3,Option4,Correct_Option,Image,Explaination,Topic,Marks,question_type)
                                            VALUES ($fid,'$Course_id','$Question','$Option_1','$Option_2',
                                                    '$Option_3','$Option_4','$Correct_option','$upload_file','$Explaination','$quiz_topic','$Question_Marks','$type') ";

            $Add_To_Database_question_query_check = mysqli_query($con,$Add_To_Database_question_query);
            
            if($Add_particular_quiz_question_query = mysqli_query($con,$Add_particular_quiz_question_query))
            {
                header("location:DASHBOARDS/AddQuizQuestion.php?Cid=$Course_id&Qid=$Quiz_id");
            }
            else{
                echo "Error In Query Exectuion";
            }
        }
        else{
            $target_file = $target_dir.basename($_FILES['question_img_matchfollowing']['name']);

            $img_file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            $extension_arr = array("JPG","jpg","JPEG","jpeg","PNG","png","gif");

            if(in_array($img_file_type,$extension_arr)){
                $select_topic_quiz = "SELECT * FROM `new_quiz_generate` WHERE ID=$fid && Course_Id='$Course_id' && Quiz_Id='$Quiz_id' ";
                $select_topic_quiz_check = mysqli_query($con,$select_topic_quiz);
                while($row=mysqli_fetch_array($select_topic_quiz_check)){
                    $quiz_topic= $row['Topic_Name'];
                }
                $Add_particular_quiz_question_query = "INSERT INTO `add_quiz_question` VALUES ($fid,'$Course_id','$Quiz_id',
                                                        $question_Number,'$Question','$Option_1','$Option_2',
                                                        '$Option_3','$Option_4','$Correct_option','$target_file','$Explaination','$Question_Marks','$type') ";
                
                $Add_To_Database_question_query = "INSERT INTO `add_database_question` (ID,Course_Id,Question,Option1,Option2,Option3,Option4,Correct_Option,Image,Explaination,Topic,Marks,question_type)
                                            VALUES ($fid,'$Course_id','$Question','$Option_1','$Option_2',
                                                    '$Option_3','$Option_4','$Correct_option','$upload_file','$Explaination','$quiz_topic','$Question_Marks','$type') ";

                $Add_To_Database_question_query_check = mysqli_query($con,$Add_To_Database_question_query);

                if($Add_particular_quiz_question_query = mysqli_query($con,$Add_particular_quiz_question_query)){
                    move_uploaded_file($_FILES['question_img_matchfollowing']['tmp_name'], $target_dir.$name);
                    header("location:DASHBOARDS/AddQuizQuestion.php?Cid=$Course_id&Qid=$Quiz_id");
                }
                else{
                    echo "Error In Query Exectuion";
                }
            }
        }
    }
?>