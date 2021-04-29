<?php
    require '../Connection_Procit_DB.php'; 
    require '../session.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>NewQuiz</title>
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
        $Courseid = $_GET['Cid'];
        $quiz_id = $_GET['Qid'];
        $f_id = $_SESSION['ID'];

        $edit_Quiz_query = "SELECT * FROM `new_quiz_generate` WHERE ID = $f_id && Course_Id = '$Courseid' && Quiz_Id = '$quiz_id' ";

        $edit_quiz_query_check = mysqli_query($con,$edit_Quiz_query);
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
                                <h4 class="user-name " style="text-align: center; padding: 30px; "><?php echo $_SESSION['Name']; ?></h4>                                    
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

            <!-- page title area start -->
            <div class="page-title-area">
                <div style="height: 60px;" class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left" style="font-family: Helvetica">Dashboard</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="Main_index.php">Home</a></li>
                                <?php 
                                    $get_subject_name="SELECT * FROM `new_course_add` WHERE ID = $ID && Course_Id='$Courseid'";
                                    $get_subject_name_check=mysqli_query($con,$get_subject_name);
                                    while($rowss = mysqli_fetch_array($get_subject_name_check))
                                    {
                                        $course_name = $rowss['Course_Name'];
                                    }
                                ?>
                                <a href="CoursePage.php?Cid=<?php echo $Courseid ?>"><li><span><?php echo $course_name; ?></span></li></a>
                                <a href="#"><li><span>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;Edit Quiz</span></li></a>
                            </ul>
                        </div>
                    </div>                    
                </div>
            </div>
            <!-- page title area end -->
        
            <!-- Server side start -->
            <div class="col-12" style="margin-top: -30px;">
                <div class="card mt-5" style="margin-top: -30px; width: 100%; height: auto; margin-bottom:5%;" >
                    <div class="card-body"> 
                        <h4 class="header-title" style="font-size: 25px;">New Quiz</h4>
                        <form class="needs-validation" action="../Edit_Quiz_Table.php?courseidd=<?php echo $Courseid; ?>&quizid=<?php echo $quiz_id; ?>" novalidate="" method="post">
                            <?php
                                while ($row = mysqli_fetch_array($edit_quiz_query_check)) {
                                    
                            ?>
                            <div class="form-row">
                                <div class="col-md-3 mb-3" >
                                    <label for="validationCustom01" style="margin-left: 3px;">Quiz name :</label>
                                    <input type="text" class="form-control" id="validationCustom01" name="quizname" placeholder="Quiz Name.." value="<?php echo $row['Quiz_Name']; ?>" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">

                                    <label for="validationCustom02">Quiz Topic :</label>
                                    <input type="text" class="form-control" id="validationCustom02" placeholder="Enter Topic.." value="<?php echo $row['Topic_Name']; ?>"  name="quiztopic" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>                  
                            </div> 
                            
                            <label for="validationCustom01">Reference Link :</label>
                            <div class=" input-group mb-5" style="margin-left: -13px; width: 50.7%;">
                                <div class="input-group-prepend" style="margin-left: 14px;">
                                    <span class="input-group-text" id="basic-addon3">https://</span>
                                </div>
                                <input type="text" class="form-control" id="validationCustom01" placeholder="Reference Link for quiz practice..." value="<?php echo $row['Reference_Link']; ?>"  name="referencelink" required>
                                <div class="valid-feedback" style="margin-left: 15px;">
                                    Looks good!
                                </div>
                            </div>
                            <div style="margin-top: -35px;">
	                            <div class="form-row">
	                                <div class="col-md-3 mb-3">
                                        <label for="example-number-input" class="col-form-label">Total Questions :</label>
                                        <input name="totalquestion" class="form-control" type="number" value="<?php echo $row['Total_Question']; ?>" id="example-number-input" placeholder="Enter Total Questions.." style=" margin-right: 10px;">
                                        <div class="valid-feedback">
                                    		Looks good!
                                		</div>
                                    </div>
	                                <div class="col-md-3 mb-3">
                                        <label for="example-number-input" class="col-form-label">Total Marks :</label>
                                        <input name="totalmarks" class="form-control" type="number" value="<?php echo $row['Total_Marks']; ?>" id="example-number-input" placeholder="Enter Total Marks.." >
                                        <div class="valid-feedback">
                                    		Looks good!
                                		</div>
                                    </div>               
	                            </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-3 mb-3">
                                    <label for="example-date-input" style="margin-left:1px;" class="col-form-label"> Select Date :</label>
                                    <input class="form-control" type="date" name="date" value="<?php echo $row['Date']; ?>" placeholder="MM/DD/YYYY" id="example-date-input">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="example-date-input" style="margin-left:1px;" class="col-form-label"> Total Allowed Attempts :</label>
                                    <input class="form-control" type="number" name="attempts" value="<?php echo $row['No_Of_Attempts']; ?>"  id="example-number-input">
                                </div>
                            </div>
                            <div class="form-row">
	                            <div class="col-md-3 mb-3">
	                                <label for="example-time-input" style="margin-left:1px;" class="col-form-label">Select Start Time : </label>
	                                <input class="form-control" type="time" name="stime" value="<?php echo $row['Start_Time']; ?>"  id="example-time-input">
	                            </div>
	                            <div class="col-md-3 mb-3">
                                    <label for="example-time-input" style="margin-left:1px;" class="col-form-label">Select End Time : </label>
                                    <input class="form-control"  name="etime" type="time"   id="example-time-input" value="<?php echo $row['End_Time']; ?>">
                                </div>
                        	</div>
                            <div style="margin-top: 10px; margin-left: 3px;">
                                <input style=" margin-right: 20px;" name="editQuiz" class="btn btn-secondary" type="submit" value="Edit Quiz">
                                <input style="margin-right: 20px;" class="btn btn-secondary" type="reset" value="Clear">
                            </div>
                            <?php
                                }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Server side end -->

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
