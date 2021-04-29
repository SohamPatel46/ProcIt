<?php
    require '../Connection_Procit_DB.php'; 
    require '../session.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Faculty</title>
        <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<body>
    <?php
        $fid = $_SESSION['ID'];
    ?>
    <div class="page-container" style="background-color: white;">

     <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div style="height: 71px;" class="sidebar-header">
                <div class="logo">
                    <a style="text-decoration: none;" href="Main_index.php"><p style="font-family: Helvetica; font-size: 17px; color: white"> <b>ProcIT <br> Online Exam</b></p></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <div >
                            <div >
                                <img style="margin-left: 75px;  height: 120px; width: 120px; border-radius: 5px;"  src="../<?php echo $_SESSION['Image']; ?>" alt="avatar">
                                <h4 class="user-name " style="text-align: center; padding: 30px; "><?php echo $_SESSION['Name'] ?></h4>                                    
                            </div>
                        </div>
                        <ul class="metismenu" id="menu">
                            
                            <li><a href="AddCourse.php"><i class="ti-book"></i> <span>Add Subject</span></a></li>
                            <li><a href="TaskNote.php"><i class="ti-receipt"></i> <span>Add Task Note</span></a></li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layers-alt"></i> <span>All Subjects</span></a>
                                <?php
                                    $ID = $_SESSION['ID'];
                                    $take_sub_nav_query = "SELECT * FROM `new_course_add` WHERE ID = $ID";

                                    $take_sub_nav_query_check = mysqli_query($con,$take_sub_nav_query);

                                    
                                ?>

                                <ul class="collapse">
                                    <?php
                                        while($rows = mysqli_fetch_array($take_sub_nav_query_check))
                                        {
                                    ?>
                                    <li><a href="CoursePage.php?Cid=<?php echo $rows['Course_Id']; ?>"><?php   
                                     echo $rows['Course_Name']; ?></a></li>
                                    <?php
                                        }
                                    ?>
                                </ul>
                            </li>
                            <li><a href="../logout.php"><i class="fa fa-sign-out" style="font-size:18px"></i> <span>Logout</span></a></li>
                            
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->

        <!-- main content area start -->
        <div class="main-content" style="background-color: white;">

            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="search-box pull-left">
                            <form action="#">
                                <input type="text" name="search" placeholder="Search..." required>
                                <i class="ti-search"></i>
                            </form>
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                    <?php
                        $ID = $_SESSION['ID'];
                        $task_show_query = "SELECT * FROM `to_do_task_faculty` WHERE ID = $ID ";

                        $task_show_query_check = mysqli_query($con,$task_show_query);
                        $n_task = mysqli_num_rows($task_show_query_check);

                    ?>
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                            <li id="full-view"><i class="ti-fullscreen"></i></li>
                            <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                            <li class="dropdown">
                                <i class="ti-bell dropdown-toggle" data-toggle="dropdown">
                                    <span><?php echo $n_task; ?></span>
                                </i>
                                <div class="dropdown-menu bell-notify-box notify-box">
                                    <span class="notify-title">You have <?php echo $n_task; ?> notifications available</span>
                                                             
                                    <div class="nofity-list">
                                        <?php 
                                            while ($rows2 = mysqli_fetch_array($task_show_query_check)) 
                                            {
                                        ?> 
                                        <a href="#" class="notify-item">
                                            <div class="notify-thumb"><i class="ti-announcement btn-info"></i></div>
                                            <div class="notify-text">
                                                <p><?php 
                                                echo $rows2['Remarks'];
                                                ?></p><br>
                                                <span>
                                                    <?php 
                                                    echo "Date : ".$rows2['Task_Date']."      Time : ".$rows2['Task_Time'];
                                                    ?></span>
                                                
                                            </div>
                                            <div style="margin-left:25%;margin-top:2%;padding-top:2%;margin-bottom:10%;">
                                                <button type="button" onClick="EditTask<?php echo $rows2['Sr_No']; ?>();" style="float:left;" class="btn btn-outline-secondary btn-xs ">Edit</button>
                                                <button type="button" onClick="DeleteTask<?php echo $rows2['Sr_No']; ?>();" style="float:right;margin-right:25%;" class="btn btn-outline-danger btn-xs ">Delete</button>
                                            </div>
                                            <script>
                                                function EditTask<?php echo $rows2['Sr_No']; ?>(){
                                                    location.href = "EditTask.php?tno=<?php echo $rows2['Sr_No']; ?>";
                                                }
                                                function DeleteTask<?php echo $rows2['Sr_No']; ?>(){
                                                    location.href = "../Delete_Task.php?tno=<?php echo $rows2['Sr_No']; ?>";
                                                }
                                            </script>
                                        </a>  
                                        <?php 
                                        }
                                    ?> 
                                    </div>
                                </div>
                            </li>                        
                            
                        </ul>
                    </div>
                </div>
            </div>
            <!-- header area end -->
            <!-- header area end -->

            <!-- page title area start -->
            <div class="page-title-area" style="margin-bottom:-30px;">
                <div style="height: 60px;" class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left" style="font-family: Helvetica">Dashboard</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="Main_index.php">Home</a></li>
                                <?php 
                                    $Courseid = $_GET['courseid'];
                                    $get_subject_name="SELECT * FROM `new_course_add` WHERE ID = $ID && Course_Id='$Courseid'";
                                    $get_subject_name_check=mysqli_query($con,$get_subject_name);
                                    while($rowss = mysqli_fetch_array($get_subject_name_check))
                                    {
                                        $course_name = $rowss['Course_Name'];
                                    }
                                ?>
                                <a href="CoursePage.php?Cid=<?php echo $Courseid ?>"><li><span><?php echo $course_name; ?></span></li></a>
                                <?php
                                    $quiizid = $_GET['quizid'];
                                    $get_quiz_name="SELECT * FROM `new_quiz_generate` WHERE ID = $ID && Course_Id='$Courseid' && Quiz_Id = '$quiizid'";
                                    $get_quiz_name_check=mysqli_query($con,$get_quiz_name);
                                    while($rowss = mysqli_fetch_array($get_quiz_name_check))
                                    {
                                        $quiz_name = $rowss['Quiz_Name'];
                                    }
                                
                                ?>
                                <a href="previewQuiz.php?courseid=<?php echo $Courseid?>&quizid=<?php echo $quiizid; ?>"><li><span>&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;<?php echo $quiz_name; ?></span></li></a>
                                <a href="#"><li><span>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;Edit Question </span></li></a>
                            </ul>
                        </div>
                    </div>                    
                </div>
            </div>
            <!-- page title area end -->
            <?php
                $question_no = $_GET['qno'];
                $courseid = $_GET['courseid'];
                $quizid = $_GET['quizid'];


                $select_question = "SELECT * FROM `add_quiz_question` WHERE ID = $fid && Course_Id='$courseid' && Quiz_Id='$quizid' && Question_Number = $question_no ";
                $select_question_check = mysqli_query($con,$select_question);
            ?>

            <!-- accordion style 3 start -->
            <div class="col-lg-12 mt-5" >
                <div class="card">
                    <div class="card-body" >
                        <h4 class="header-title">Edit Question </h4>
                        <div id="accordion3" class="according accordion-s3">
                            <?php 
                                while($rows1 = mysqli_fetch_array($select_question_check))
                                {
                            ?>
                            <div class="card">
                                <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" href="#<?php echo $question_no ?>">Question : <?php echo $question_no ?></a>                                
                                </div>
                                <div id="<?php echo $question_no ?>" class="collapse show" data-parent="#accordion3">
                                    <div class="card-body">
                                        <form class="needs-validation" novalidate="" enctype="multipart/form-data" action="../Edit_quiz_question_table.php?courseid=<?php echo $courseid?>&quizid=<?php echo $quizid?>&qno=<?php echo $question_no?>" method = "post">
                                            <?php
                                                if($rows1['question_type']=='mcqs'){
                                            ?>
                                            <div id="MCQ_Field">
                                                <div class="form-row">
                                                    <div class="col-md-12 mb-3" >
                                                        <label for="validationCustom01" style="margin-left: 3px;">Question :</label>
                                                        <input type="text" class="form-control" name="question" id="validationCustom01" placeholder="Enter question.." value="<?php echo $rows1['Question']; ?>" required>
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>                                    
                                                    </div>  
                                                </div> 
                                                <div class="form-row">
                                                    <div class="col-md-3 mb-3" >
                                                        <label for="validationCustom01" style="margin-left: 3px;">Option 1 :</label>
                                                        <input type="text" name="option1" class="form-control" id="validationCustom01" placeholder="Enter Option.." value="<?php echo $rows1['Option1']; ?>" required="">
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>                                    
                                                    </div>  
                                                    <div class="col-md-3 mb-3" >
                                                        <label for="validationCustom01" style="margin-left: 3px;">Option 2 :</label>
                                                        <input type="text" name="option2" class="form-control" id="validationCustom01" placeholder="Enter Option.." value="<?php echo $rows1['Option2']; ?>" required="">
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>                                    
                                                    </div>  
                                                    <div class="col-md-3 mb-3" >
                                                        <label for="validationCustom01" style="margin-left: 3px;">Option 3 :</label>
                                                        <input type="text" name="option3" class="form-control" id="validationCustom01" placeholder="Enter Option.." value="<?php echo $rows1['Option3']; ?>" required="">
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>                                    
                                                    </div> 
                                                    <div class="col-md-3 mb-3" >
                                                        <label for="validationCustom01" style="margin-left: 3px;">Option 4 :</label>
                                                        <input type="text" name="option4" class="form-control" id="validationCustom01" placeholder="Enter Option.." value="<?php echo $rows1['Option4']; ?>" required="">
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>                                    
                                                    </div>  
                                                </div>
                                                <label for="validationCustom01">Choose Image :</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="question_img"  id="inputGroupFile04">
                                                        <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                                    </div>
                                                </div>
                                                <div style="margin-top: 10px;">
                                                    <div class="form-row">
                                                        <div class="col-md-3 mb-3">
                                                            <label for="example-number-input" class="col-form-label">Correct option :</label>
                                                            <input type="text" name="correctoption" class="form-control" id="validationCustom01" placeholder="Enter Option...." value="<?php echo $rows1['Correct_Option']; ?>" required="">
                                                            <div class="valid-feedback">
                                                                Looks good!
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 mb-3">
                                                            <label for="example-number-input" class="col-form-label">Enter Marks :</label>
                                                            <input class="form-control" name="questionmarks" type="number" value="<?php echo $rows1['Marks']; ?>" id="example-number-input" placeholder="EnterMarks.." >
                                                            <div class="valid-feedback">
                                                                Looks good!
                                                            </div>
                                                        </div>               
                                                    </div>
                                                </div>
                                                <div class="col-md-12" style="margin-left: -12px; ">
                                                        <div >
                                                            <label for="textarea-input" class=" form-control-label">Explanation : </label>
                                                        </div>
                                                        <div style="width: 50.7%">
                                                            <textarea name="explaination" id="textarea-input"  rows="3" placeholder="Add Explanation Here..." class="form-control"><?php echo $rows1['Explaination']; ?></textarea>
                                                        </div>
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>
                                                </div>
                                                <div style="margin-top: 20px; margin-left: 0.6%;">
                                                    <input style="margin-right: 8.5%; width: 100px;" class="btn btn-secondary" type="reset" value="Clear">
                                                    <input style="margin-right: 8.5%; width: 100px;" class="btn btn-secondary" name="edit_question" type="submit" value="Edit">
                                                </div>
                                            </div>
                                            <?php
                                                }
                                                else if($rows1['question_type']=='oneword'){
                                            ?>
                                            <div id="One_Word_Field">   <!-- New Div For Fill the Blank Start Here -->
                                                <div class="form-row">
                                                    <div class="col-md-12 mb-3" >
                                                        <label for="validationCustom01" style="margin-left: 3px;">Question :</label>
                                                        <input type="text" class="form-control" name="question_oneword" id="validationCustom01" placeholder="Enter question.." value="<?php echo $rows1['Question']; ?>" required>
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>                                    
                                                    </div>
                                                </div>
                                                <label for="validationCustom01" style="margin-left:5px;">Choose Image :</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="question_img_oneword" id="inputGroupFile04">
                                                        <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                                    </div>
                                                </div>
                                                <div style="margin-top: 10px;">
                                                    <div class="form-row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="example-number-input" style="margin-left:6px;" class="col-form-label">Correct Answer :</label>
                                                            <input type="text" name="correctoption_oneword" class="form-control" id="validationCustom01" placeholder="Enter Option...." value="<?php echo $rows1['Correct_Option']; ?>" required="">
                                                            <div class="valid-feedback">
                                                                Looks good!
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="example-number-input" class="col-form-label">Enter Marks :</label>
                                                            <input class="form-control" name="questionmarks_oneword" type="number" value="<?php echo $rows1['Marks']; ?>" id="example-number-input" placeholder="EnterMarks.." >
                                                            <div class="valid-feedback">
                                                                Looks good!
                                                            </div>
                                                        </div>               
                                                    </div>
                                                </div>
                                                <div class="col-md-12 " style="margin-top:5px;margin-left: -14px; ">
                                                        <div >
                                                            <label for="textarea-input" style="margin-left:5px;" class=" form-control-label">Explanation : </label>
                                                        </div>
                                                        <div style="width: 102.7%">
                                                            <textarea name="explaination_oneword" id="textarea-input" rows="3" placeholder="Add Explanation Here..." class="form-control"><?php echo $rows1['Explaination'];?></textarea>
                                                        </div>
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>
                                                </div>
                                                <div style="margin-top: 20px; margin-left: 0.6%;">
                                                    <input style="margin-right: 8.5%; width: 100px;" class="btn btn-secondary" type="reset" value="Clear">
                                                    <input style="margin-right: 8.5%; width: 100px;" class="btn btn-secondary" name="edit_question_oneword" type="submit" value="Edit">
                                                </div>
                                            </div>  <!-- Div completed Here for Fill the Blanks-->
                                            <?php 
                                                }else if($rows1['question_type']=='numerical'){
                                            ?>
                                            <div id="numerical_field">   <!-- New Div For Numerical Start Here -->
                                                <div class="form-row">
                                                    <div class="col-md-12 mb-3" >
                                                        <label for="validationCustom01" style="margin-left: 3px;">Question :</label>
                                                        <input type="text" class="form-control" name="question_numerical" id="validationCustom01" placeholder="Enter question.." value="<?php echo $rows1['Question']; ?>" required>
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>                                    
                                                    </div>
                                                </div>
                                                <label for="validationCustom01" style="margin-left:5px;">Choose Image :</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="question_img_numerical" id="inputGroupFile04">
                                                        <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                                    </div>
                                                </div>
                                                <div style="margin-top: 10px;">
                                                    <div class="form-row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="example-number-input" style="margin-left:6px;" class="col-form-label">Correct Answer :</label>
                                                            <input type="text" name="correctoption_numerical" class="form-control" id="validationCustom01" placeholder="Enter Option...." value="<?php echo $rows1['Correct_Option']; ?>" required="">
                                                            <div class="valid-feedback">
                                                                Looks good!
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="example-number-input" class="col-form-label">Enter Marks :</label>
                                                            <input class="form-control" name="questionmarks_numerical" type="number" value="<?php echo $rows1['Marks']; ?>" id="example-number-input" placeholder="EnterMarks.." >
                                                            <div class="valid-feedback">
                                                                Looks good!
                                                            </div>
                                                        </div>               
                                                    </div>
                                                </div>
                                                <div class="col-md-12 " style="margin-top:5px;margin-left: -14px; ">
                                                        <div >
                                                            <label for="textarea-input" style="margin-left:5px;" class=" form-control-label">Explanation : </label>
                                                        </div>
                                                        <div style="width: 102.7%">
                                                            <textarea name="explaination_numerical" id="textarea-input" rows="3" placeholder="Add Explanation Here..." class="form-control"><?php echo $rows1['Explaination'];?></textarea>
                                                        </div>
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>
                                                </div>
                                                <div style="margin-top: 20px; margin-left: 0.6%;">
                                                    <input style="margin-right: 8.5%; width: 100px;" class="btn btn-secondary" type="reset" value="Clear">
                                                    <input style="margin-right: 8.5%; width: 100px;" class="btn btn-secondary" name="edit_question_numerical" type="submit" value="Edit">
                                                </div>
                                            </div> <!-- Div completed Here for Numerical-->
                                            <?php
                                                }else if($rows1['question_type']=='multiple_answer'){
                                            ?>
                                            <div id="Multiple_answer_Type">   <!-- Multiple Answer Question -->
                                                <div class="form-row">
                                                    <div class="col-md-12 mb-3" >
                                                        <label for="validationCustom01" style="margin-left: 3px;">Question :</label>
                                                        <input type="text" class="form-control" name="question_multipleanswer" id="validationCustom01" placeholder="Enter question.." value="<?php echo $rows1['Question'];?>" required>
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>                                    
                                                    </div> 
                                                </div> 
                                                <div class="form-row">
                                                    <div class="col-md-3 mb-3" >
                                                        <label for="validationCustom01" style="margin-left: 3px;">Option 1 :</label>
                                                        <input type="text" name="option1_multipleanswer" class="form-control" id="validationCustom01" placeholder="Enter Option.." value="<?php echo $rows1['Option1'];?>" required="">
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>                                    
                                                    </div>  
                                                    
                                                    <div class="col-md-3 mb-3" >
                                                        <label for="validationCustom01" style="margin-left: 3px;">Option 2 :</label>
                                                        <input type="text" name="option2_multipleanswer" class="form-control" id="validationCustom01" placeholder="Enter Option.." value="<?php echo $rows1['Option2'];?>" required="">
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>                                    
                                                    </div>  
                                                    
                                                    <div class="col-md-3 mb-3" >
                                                        <label for="validationCustom01" style="margin-left: 3px;">Option 3 :</label>
                                                        <input type="text" name="option3_multipleanswer" class="form-control" id="validationCustom01" placeholder="Enter Option.." value="<?php echo $rows1['Option3'];?>" required="">
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>                                    
                                                    </div> 

                                                    <div class="col-md-3 mb-3" >
                                                        <label for="validationCustom01" style="margin-left: 3px;">Option 4 :</label>
                                                        <input type="text" name="option4_multipleanswer" class="form-control" id="validationCustom01" placeholder="Enter Option.." value="<?php echo $rows1['Option4'];?>" required="">
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>                                    
                                                    </div>  
                                                </div>
                                                <label for="validationCustom01">Choose Image :</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="question_img_multipleanswer" id="inputGroupFile04">
                                                        <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                                    </div>
                                                </div>
                                                <div style="margin-top: 10px;">
                                                    <div class="form-row">
                                                        <div class="col-md-3 mb-3">
                                                            <label for="example-number-input" class="col-form-label">Correct options(a,b,c,d:Type) :</label>
                                                            <input type="text" name="correctoption_multipleanswer" class="form-control" id="validationCustom01" placeholder="Enter Option...." value="<?php echo $rows1['Correct_Option'];?>" required="">
                                                            <div class="valid-feedback">
                                                                Looks good!
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 mb-3">
                                                            <label for="example-number-input" class="col-form-label">Enter Marks :</label>
                                                            <input class="form-control" name="questionmarks_multipleanswer" type="number" value="<?php echo $rows1['Marks'];?>" id="example-number-input" placeholder="EnterMarks.." >
                                                            <div class="valid-feedback">
                                                                Looks good!
                                                            </div>
                                                        </div>             
                                                    </div>
                                                </div>

                                                <div class="col-md-12" style="margin-left: -12px; ">
                                                        <div >
                                                            <label for="textarea-input" class=" form-control-label">Explanation : </label>
                                                        </div>
                                                        <div style="width: 102.7%">
                                                            <textarea name="explaination_multipleanswer" id="textarea-input" rows="3" placeholder="Add Explanation Here..." class="form-control"><?php echo $rows1['Explaination'];?></textarea>
                                                        </div>
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>
                                                </div>
                                                <div style="margin-top: 20px; margin-left: 0.6%;">
                                                    <input style="margin-right: 8.5%; width: 100px;" class="btn btn-secondary" type="reset" value="Clear">
                                                    <input style="margin-right: 8.5%; width: 100px;" class="btn btn-secondary" name="edit_question_multipleanswer" type="submit" value="Edit">
                                                </div>
                                            </div>  <!-- Multiple Answer Part Finished-->
                                            <?php
                                                }else if($rows1['question_type']=="T_F"){
                                            ?>
                                            <div id="True_False_type"><!-- True/False Type Question start-->
                                                <div class="form-row">
                                                    <div class="col-md-12 mb-3" >
                                                        <label for="validationCustom01" style="margin-left: 3px;">Question :</label>
                                                        <input type="text" class="form-control" name="question_truefalse" id="validationCustom01" placeholder="Enter question.." value="<?php echo $rows1['Question']; ?>" required>
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>                                    
                                                    </div> 
                                                </div>
                                                <label for="validationCustom01" style="margin-left:5px;" >Choose Image :</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="question_img_truefalse" id="inputGroupFile04">
                                                        <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                                    </div>
                                                </div>
                                                <div style="margin-top: 10px;">
                                                    <label for="example-number-input" style="margin-left:0.3%;" class="col-form-label">Tick Answer :</label>
                                                    <br>
                                                    <div style="margin-left:1%">
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio"  id="customRadio4" name="truefalse" value="True" class="custom-control-input">
                                                            <label class="custom-control-label" for="customRadio4" style="margin-right: 25px; ">True</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" id="customRadio5" name="truefalse" value="False" class="custom-control-input">
                                                            <label class="custom-control-label" for="customRadio5">False</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="margin-top: 10px;margin:left:3%">
                                                    <div class="form-row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="example-number-input" style="margin-left:1%;" class="col-form-label">Enter Marks :</label>
                                                            <input class="form-control" name="questionmarks_truefalse" type="number" value="<?php echo $rows1['Marks']; ?>" id="example-number-input" placeholder="EnterMarks.." >
                                                            <div class="valid-feedback">
                                                                Looks good!
                                                            </div>
                                                        </div>            
                                                    </div>
                                                </div>
                                                <div class="col-md-12 " style="margin-top:5px;margin-left: -14px; ">
                                                        <div >
                                                            <label for="textarea-input" style="margin-left:5px;" class=" form-control-label">Explanation : </label>
                                                        </div>
                                                        <div style="width: 102.7%">
                                                            <textarea name="explaination_true_false" id="textarea-input" rows="3" placeholder="Add Explanation Here..." class="form-control"><?php echo $rows1['Explaination']; ?></textarea>
                                                        </div>
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>
                                                </div>
                                                <div style="margin-top: 20px; margin-left: 0.6%;">
                                                    <input style="margin-right: 8.5%; width: 100px;" class="btn btn-secondary" type="reset" value="Clear">
                                                    <input style="margin-right: 8.5%; width: 100px;" class="btn btn-secondary" name="edit_question_true_false" type="submit" value="Edit">
                                                </div>
                                            </div>  <!-- True/False Type Question Finish-->
                                            <?php
                                                }else if($rows1['question_type']=="match_following"){
                                            ?>
                                            <div id="match_following_type"> <!-- match following Starts Here -->
                                                <div class="form-row">
                                                    <div class="col-md-12 mb-3" >
                                                        <label for="validationCustom01" style="margin-left: 3px;">Question :</label>
                                                        <input type="text" class="form-control" name="question_matchfollowing" id="validationCustom01" placeholder="Enter question.." value="<?php echo $rows1['Question']; ?>" required>
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>                                    
                                                    </div> 
                                                </div>
                                                <?php
                                                    $option1_a = explode(",",$rows1['Option1']);
                                                    $option2_b = explode(",",$rows1['Option2']);
                                                    $option3_c = explode(",",$rows1['Option3']);
                                                    $option4_d = explode(",",$rows1['Option4']);
                                                ?>
                                                <div class="form-row">
                                                    <div class="col-md-3 mb-3" >
                                                        <label for="validationCustom01" style="margin-left: 3px;">Option 1 :</label>
                                                        <input type="text" name="option1_matchfollowing" class="form-control" id="validationCustom01" placeholder="Enter Option.." value="<?php echo $option1_a[0]; ?>" required="">
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>                                    
                                                    </div>  
                                                    <div class="col-md-3 mb-3" >
                                                        <label for="validationCustom01" style="margin-left: 3px;">Option 2 :</label>
                                                        <input type="text" name="option2_matchfollowing" class="form-control" id="validationCustom01" placeholder="Enter Option.." value="<?php echo $option2_b[0]; ?>" required="">
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>                                    
                                                    </div>  
                                                    <div class="col-md-3 mb-3" >
                                                        <label for="validationCustom01" style="margin-left: 3px;">Option 3 :</label>
                                                        <input type="text" name="option3_matchfollowing" class="form-control" id="validationCustom01" placeholder="Enter Option.." value="<?php echo $option3_c[0]; ?>" required="">
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>                                    
                                                    </div> 
                                                    <div class="col-md-3 mb-3" >
                                                        <label for="validationCustom01" style="margin-left: 3px;">Option 4 :</label>
                                                        <input type="text" name="option4_matchfollowing" class="form-control" id="validationCustom01" placeholder="Enter Option.." value="<?php echo $option4_d[0]; ?>" required="">
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>                                    
                                                    </div>  
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-3 mb-3" >
                                                        <label for="validationCustom01" style="margin-left: 3px;">Option A :</label>
                                                        <input type="text" name="optiona_matchfollowing" class="form-control" id="validationCustom01" placeholder="Enter Option.." value="<?php echo $option1_a[1]; ?>" required="">
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>                                    
                                                    </div>  
                                                    
                                                    <div class="col-md-3 mb-3" >
                                                        <label for="validationCustom01" style="margin-left: 3px;">Option B :</label>
                                                        <input type="text" name="optionb_matchfollowing" class="form-control" id="validationCustom01" placeholder="Enter Option.." value="<?php echo $option2_b[1]; ?>" required="">
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>                                    
                                                    </div>  
                                                    
                                                    <div class="col-md-3 mb-3" >
                                                        <label for="validationCustom01" style="margin-left: 3px;">Option C :</label>
                                                        <input type="text" name="optionc_matchfollowing" class="form-control" id="validationCustom01" placeholder="Enter Option.." value="<?php echo $option3_c[1]; ?>" required="">
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>                                    
                                                    </div> 

                                                    <div class="col-md-3 mb-3" >
                                                        <label for="validationCustom01" style="margin-left: 3px;">Option D :</label>
                                                        <input type="text" name="optiond_matchfollowing" class="form-control" id="validationCustom01" placeholder="Enter Option.." value="<?php echo $option4_d[1]; ?>" required="">
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>                                    
                                                    </div>  
                                                </div>
                                                <label for="validationCustom01">Choose Image :</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="question_img_matchfollowing" id="inputGroupFile04">
                                                        <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                                    </div>
                                                </div>
                                                <div style="margin-top: 10px;">
                                                    <div class="form-row">
                                                        <div class="col-md-3 mb-3">
                                                            <label for="example-number-input" class="col-form-label">Match options(1a,2b,3c,4d:Type) :</label>
                                                            <input type="text" name="correctoption_matchfollowing" class="form-control" id="validationCustom01" placeholder="Enter Option...." value="<?php echo $rows1['Correct_Option']; ?>" required="">
                                                            <div class="valid-feedback">
                                                                Looks good!
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 mb-3">
                                                            <label for="example-number-input" class="col-form-label">Enter Marks :</label>
                                                            <input class="form-control" name="questionmarks_matchfollowing" type="number" value="<?php echo $rows1['Marks']; ?>" id="example-number-input" placeholder="EnterMarks.." >
                                                            <div class="valid-feedback">
                                                                Looks good!
                                                            </div>
                                                        </div>               
                                                    </div>
                                                </div>
                                                <div class="col-md-12" style="margin-left: -12px; ">
                                                        <div >
                                                            <label for="textarea-input" class=" form-control-label">Explanation : </label>
                                                        </div>
                                                        <div style="width: 102.7%">
                                                            <textarea name="explaination_matchfollowing" id="textarea-input" rows="3" placeholder="Add Explanation Here..." class="form-control"><?php echo $rows1['Explaination']; ?></textarea>
                                                        </div>
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>
                                                </div>
                                                <div style="margin-top: 20px; margin-left: 0.6%;">  
                                                    <input style="margin-right: 8.5%; width: 100px;" class="btn btn-secondary" type="reset" value="Clear">
                                                    <input style="margin-right: 8.5%; width: 100px;" class="btn btn-secondary" name="edit_question_match_following" type="submit" value="Edit">
                                                </div>
                                            </div>  <!--match Following Finish Here -->
                                            <?php
                                                }
                                            ?>
                                        </form>      
                                    </div>
                                </div>
                            </div>
                                <?php
                                }
                            ?>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- accordion style 3 end -->






        </div>
    </div>  

     <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="assets/js/pie-chart.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>
</html>