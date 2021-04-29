<?php
    require 'Connection_Procit_DB.php'; 
    session_start();

    if(isset($_POST['add_db_question']))
    {
        $fid = $_SESSION['ID'];
        $Course_id = $_GET['courseid'];
        
        $Question = $_POST['question'];
        $Option_1 = $_POST['option1'];
        $Option_2 = $_POST['option2'];
        $Option_3 = $_POST['option3'];
        $Option_4 = $_POST['option4'];
        $Correct_option = $_POST['correctoption'];
        $Question_Marks = $_POST['questionmarks'];
        $Explaination = $_POST['explaination'];
        $Topic = $_POST['topic'];
        $type = "mcqs";
        $name = $_FILES['question_img']['name'];
        $target_dir = "Uploads/";
        

        if(!file_exists($_FILES['question_img']['tmp_name']))
        {
            $upload_file = "Uploads/notverified.jpg";
            $Add_To_Database_question_query = "INSERT INTO `add_database_question` (ID,Course_Id,Question,Option1,Option2,Option3,Option4,Correct_Option,Image,Explaination,Topic,Marks,question_type)
                                            VALUES ($fid,'$Course_id','$Question','$Option_1','$Option_2',
                                                    '$Option_3','$Option_4','$Correct_option','$upload_file','$Explaination','$Topic','$Question_Marks','$type') ";
            
            if($Add_To_Database_question_query_check = mysqli_query($con,$Add_To_Database_question_query))
            {
                echo "Success";
                //header("location:DASHBOARDS/QuestionBank.php?Cid=$Course_id");
                echo "<script type='text/javascript'>
                        window.location.replace(\"DASHBOARDS/QuestionBank.php?Cid=$Course_id\");
                    </script>
                ";
            }
            else{
                echo "Error In Query Exectuion mcq";
            }
        }
        else
        {
            $target_file = $target_dir.basename($_FILES['question_img']['name']);
            $img_file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $extension_arr = array("JPG","jpg","JPEG","jpeg","PNG","png","gif");
            if(in_array($img_file_type,$extension_arr))
            {            
                $Add_To_Database_question_query = "INSERT INTO `add_database_question` (ID,Course_Id,Question,Option1,Option2,Option3,Option4,Correct_Option,Image,Explaination,Topic,Marks,question_type)
                                                VALUES ($fid,'$Course_id','$Question','$Option_1','$Option_2',
                                                        '$Option_3','$Option_4','$Correct_option','$target_file','$Explaination','$Topic','$Question_Marks','$type') ";

                if($Add_To_Database_question_query_check = mysqli_query($con,$Add_To_Database_question_query))
                {
                    echo "Success";
                    move_uploaded_file($_FILES['question_img']['tmp_name'], $target_dir.$name);
                    //header("location:DASHBOARDS/QuestionBank.php?Cid=$Course_id");
                    echo "<script type='text/javascript'>
                        window.location.replace(\"DASHBOARDS/QuestionBank.php?Cid=$Course_id\");
                    </script>
                ";
                }
                else{
                    echo "Error In Query Exectuion mcq 1";
                }
            }
        }
    }
    else if(isset($_POST['save_question_oneword'])){
        $fid = $_SESSION['ID'];
        $Course_id = $_GET['courseid'];

        $Question = $_POST['question_oneword'];
        $Option_1 = "--";
        $Option_2 = "--";
        $Option_3 = "--";
        $Option_4 = "--";
        $Correct_option = $_POST['correctoption_oneword'];
        $Question_Marks = $_POST['questionmarks_oneword'];
        $Explaination = $_POST['explaination_oneword'];
        $type = "oneword";
        $Topic = $_POST['topic_oneword'];
        $name = $_FILES['question_img_oneword']['name'];
        $target_dir = "Uploads/";

        if(!file_exists($_FILES['question_img_oneword']['tmp_name'])){
            $upload_file = "Uploads/notverified.jpg";
            $Add_To_Database_question_query = "INSERT INTO `add_database_question` (ID,Course_Id,Question,Option1,Option2,Option3,Option4,Correct_Option,Image,Explaination,Topic,Marks,question_type)
                                            VALUES ($fid,'$Course_id','$Question','$Option_1','$Option_2',
                                                    '$Option_3','$Option_4','$Correct_option','$upload_file','$Explaination','$Topic','$Question_Marks','$type') ";
            
            if($Add_To_Database_question_query_check = mysqli_query($con,$Add_To_Database_question_query))
            {
                echo "Success";
                //header("location:DASHBOARDS/QuestionBank.php?Cid=$Course_id");
                echo "<script type='text/javascript'>
                        window.location.replace(\"DASHBOARDS/QuestionBank.php?Cid=$Course_id\");
                    </script>
                ";
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
                $Add_To_Database_question_query = "INSERT INTO `add_database_question` (ID,Course_Id,Question,Option1,Option2,Option3,Option4,Correct_Option,Image,Explaination,Topic,Marks,question_type)
                                                VALUES ($fid,'$Course_id','$Question','$Option_1','$Option_2',
                                                        '$Option_3','$Option_4','$Correct_option','$target_file','$Explaination','$Topic','$Question_Marks','$type') ";

                if($Add_To_Database_question_query_check = mysqli_query($con,$Add_To_Database_question_query))
                {
                    echo "Success";
                    move_uploaded_file($_FILES['question_img_oneword']['tmp_name'], $target_dir.$name);
                    //header("location:DASHBOARDS/QuestionBank.php?Cid=$Course_id");
                    echo "<script type='text/javascript'>
                        window.location.replace(\"DASHBOARDS/QuestionBank.php?Cid=$Course_id\");
                    </script>
                ";
                }
                else{
                    echo "Error In Query Exectuion";
                }
            }
        }
    }
    else if(isset($_POST['save_question_numerical'])){
        $fid = $_SESSION['ID'];
        $Course_id = $_GET['courseid'];

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
        $Topic = $_POST['topic_numerical'];

        if(!file_exists($_FILES['question_img_numerical']['tmp_name'])){
            $upload_file = "Uploads/notverified.jpg";
            $Add_To_Database_question_query = "INSERT INTO `add_database_question` (ID,Course_Id,Question,Option1,Option2,Option3,Option4,Correct_Option,Image,Explaination,Topic,Marks,question_type)
                                            VALUES ($fid,'$Course_id','$Question','$Option_1','$Option_2',
                                                    '$Option_3','$Option_4','$Correct_option','$upload_file','$Explaination','$Topic','$Question_Marks','$type') ";
            
            if($Add_To_Database_question_query_check = mysqli_query($con,$Add_To_Database_question_query))
            {
                echo "Success";
                //header("location:DASHBOARDS/QuestionBank.php?Cid=$Course_id");
                echo "<script type='text/javascript'>
                        window.location.replace(\"DASHBOARDS/QuestionBank.php?Cid=$Course_id\");
                    </script>
                ";
                
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
                $Add_To_Database_question_query = "INSERT INTO `add_database_question` (ID,Course_Id,Question,Option1,Option2,Option3,Option4,Correct_Option,Image,Explaination,Topic,Marks,question_type)
                                                VALUES ($fid,'$Course_id','$Question','$Option_1','$Option_2',
                                                        '$Option_3','$Option_4','$Correct_option','$target_file','$Explaination','$Topic','$Question_Marks','$type') ";

                if($Add_To_Database_question_query_check = mysqli_query($con,$Add_To_Database_question_query))
                {
                    echo "Success";
                    move_uploaded_file($_FILES['question_img_numerical']['tmp_name'], $target_dir.$name);
                    //header("location:DASHBOARDS/QuestionBank.php?Cid=$Course_id");
                    echo "<script type='text/javascript'>
                        window.location.replace(\"DASHBOARDS/QuestionBank.php?Cid=$Course_id\");
                    </script>
                    ";
                }
                else{
                    echo "Error In Query Exectuion";
                }
            }
        }
    }
    else if(isset($_POST['save_question_multipleanswer'])){
        $fid = $_SESSION['ID'];
        $Course_id = $_GET['courseid'];

        $Question = $_POST['question_multipleanswer'];
        $Option_1 = $_POST['option1_multipleanswer'];
        $Option_2 = $_POST['option2_multipleanswer'];
        $Option_3 = $_POST['option3_multipleanswer'];
        $Option_4 = $_POST['option4_multipleanswer'];
        $Correct_option = $_POST['correctoption_multipleanswer'];
        $Question_Marks = $_POST['questionmarks_multipleanswer'];
        $Explaination = $_POST['explaination_multipleanswer'];
        $type = "multiple_answer";
        $Topic = $_POST['topic_multipleanswer'];

        $name = $_FILES['question_img_multipleanswer']['name'];
        $target_dir = "Uploads/";

        if(!file_exists($_FILES['question_img_multipleanswer']['tmp_name'])){
            $upload_file = "Uploads/notverified.jpg";
            $Add_To_Database_question_query = "INSERT INTO `add_database_question` (ID,Course_Id,Question,Option1,Option2,Option3,Option4,Correct_Option,Image,Explaination,Topic,Marks,question_type)
                                                VALUES ($fid,'$Course_id','$Question','$Option_1','$Option_2',
                                                    '$Option_3','$Option_4','$Correct_option','$upload_file','$Explaination','$Topic','$Question_Marks','$type') ";
            
            if($Add_To_Database_question_query_check = mysqli_query($con,$Add_To_Database_question_query))
            {
                echo "Success";
                //header("location:DASHBOARDS/QuestionBank.php?Cid=$Course_id");
                echo "<script type='text/javascript'>
                        window.location.replace(\"DASHBOARDS/QuestionBank.php?Cid=$Course_id\");
                    </script>
                ";
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
                $Add_To_Database_question_query = "INSERT INTO `add_database_question` (ID,Course_Id,Question,Option1,Option2,Option3,Option4,Correct_Option,Image,Explaination,Topic,Marks,question_type)
                                                VALUES ($fid,'$Course_id','$Question','$Option_1','$Option_2',
                                                        '$Option_3','$Option_4','$Correct_option','$target_file','$Explaination','$Topic','$Question_Marks','$type') ";

                if($Add_To_Database_question_query_check = mysqli_query($con,$Add_To_Database_question_query))
                {
                    echo "Success";
                    move_uploaded_file($_FILES['question_img_multipleanswer']['tmp_name'], $target_dir.$name);
                    //header("location:DASHBOARDS/QuestionBank.php?Cid=$Course_id");
                    echo "<script type='text/javascript'>
                        window.location.replace(\"DASHBOARDS/QuestionBank.php?Cid=$Course_id\");
                    </script>
                    ";
                }
                else{
                    echo "Error In Query Exectuion";
                }
            }
        }
    }
    else if(isset($_POST['save_question_true_false'])){
        $fid = $_SESSION['ID'];
        $Course_id = $_GET['courseid'];

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
        $Topic = $_POST['topic_truefalse'];

        if(!file_exists($_FILES['question_img_truefalse']['tmp_name'])){
            $upload_file = "Uploads/notverified.jpg";
            $Add_To_Database_question_query = "INSERT INTO `add_database_question` (ID,Course_Id,Question,Option1,Option2,Option3,Option4,Correct_Option,Image,Explaination,Topic,Marks,question_type)
                                            VALUES ($fid,'$Course_id','$Question','$Option_1','$Option_2',
                                                    '$Option_3','$Option_4','$Correct_option','$upload_file','$Explaination','$Topic','$Question_Marks','$type') ";
            
            if($Add_To_Database_question_query_check = mysqli_query($con,$Add_To_Database_question_query))
            {
                echo "Success";
                //header("location:DASHBOARDS/QuestionBank.php?Cid=$Course_id");
                echo "<script type='text/javascript'>
                        window.location.replace(\"DASHBOARDS/QuestionBank.php?Cid=$Course_id\");
                    </script>
                ";
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
                $Add_To_Database_question_query = "INSERT INTO `add_database_question` (ID,Course_Id,Question,Option1,Option2,Option3,Option4,Correct_Option,Image,Explaination,Topic,Marks,question_type)
                                                VALUES ($fid,'$Course_id','$Question','$Option_1','$Option_2',
                                                        '$Option_3','$Option_4','$Correct_option','$target_file','$Explaination','$Topic','$Question_Marks','$type') ";

                if($Add_To_Database_question_query_check = mysqli_query($con,$Add_To_Database_question_query))
                {
                    echo "Success";
                    move_uploaded_file($_FILES['question_img_truefalse']['tmp_name'], $target_dir.$name);
                    //header("location:DASHBOARDS/QuestionBank.php?Cid=$Course_id");
                    echo "<script type='text/javascript'>
                        window.location.replace(\"DASHBOARDS/QuestionBank.php?Cid=$Course_id\");
                    </script>
                    ";
                }
                else{
                    echo "Error In Query Exectuion";
                }
            }
        }
    }
    else if(isset($_POST['save_question_matchfollowing'])){
        $fid = $_SESSION['ID'];
        $Course_id = $_GET['courseid'];

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
        $Topic = $_POST['topic_matchfollowing'];

        if(!file_exists($_FILES['question_img_matchfollowing']['tmp_name'])){
            $upload_file = "Uploads/notverified.jpg";
            $Add_To_Database_question_query = "INSERT INTO `add_database_question` (ID,Course_Id,Question,Option1,Option2,Option3,Option4,Correct_Option,Image,Explaination,Topic,Marks,question_type)
                                            VALUES ($fid,'$Course_id','$Question','$Option_1','$Option_2',
                                                    '$Option_3','$Option_4','$Correct_option','$upload_file','$Explaination','$Topic','$Question_Marks','$type') ";
            
            if($Add_To_Database_question_query_check = mysqli_query($con,$Add_To_Database_question_query))
            {
                echo "Success";
                //header("location:DASHBOARDS/QuestionBank.php?Cid=$Course_id");
                echo "<script type='text/javascript'>
                        window.location.replace(\"DASHBOARDS/QuestionBank.php?Cid=$Course_id\");
                    </script>
                ";
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
                $Add_To_Database_question_query = "INSERT INTO `add_database_question` (ID,Course_Id,Question,Option1,Option2,Option3,Option4,Correct_Option,Image,Explaination,Topic,Marks,question_type)
                                                VALUES ($fid,'$Course_id','$Question','$Option_1','$Option_2',
                                                        '$Option_3','$Option_4','$Correct_option','$target_file','$Explaination','$Topic','$Question_Marks','$type') ";

                if($Add_To_Database_question_query_check = mysqli_query($con,$Add_To_Database_question_query))
                {
                    echo "Success";
                    move_uploaded_file($_FILES['question_img_matchfollowing']['tmp_name'], $target_dir.$name);
                    //header("location:DASHBOARDS/QuestionBank.php?Cid=$Course_id");
                    echo "<script type='text/javascript'>
                        window.location.replace(\"DASHBOARDS/QuestionBank.php?Cid=$Course_id\");
                    </script>
                     ";
                }
                else{
                    echo "Error In Query Exectuion";
                }
            }
        }
    }
?>