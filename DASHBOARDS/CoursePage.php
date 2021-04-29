<?php
    require '../Connection_Procit_DB.php'; 
    require '../session.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>CoursePage</title>
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
        $f_id = $_SESSION['ID'];
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
	                            <h4 class="user-name " style="text-align: center; padding: 30px; "><?php echo $_SESSION['Name']; ?> </h4>	                            	
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
                    <div class="col-sm-12">
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
                                <a href="#"><li><span><?php echo $course_name; ?></span></li><a>
                            </ul>
                            <a href="Result.php?Cid=<?php echo $Courseid; ?>"><button type="button" class="btn btn-outline-secondary btn-xs" style="float: right; margin-right: 20px;">Result Analysis</button> </a>
                            <a href="QuestionBank.php?Cid=<?php echo $Courseid ?>"><button type="button" class="btn btn-outline-secondary btn-xs" style="float: right;margin-right: 20px;">Question Bank</button></a>
                            <a href="newQuizPage.php?Cid=<?php echo $Courseid ?>" ><button type="button"  class="btn btn-outline-secondary btn-xs" style="float: right;margin-right: 20px;">New Quiz</button></a>
                        </div>
                    </div>                    
                </div>
            </div>
            <!-- page title area end -->
        <div class="main-content-inner">
            <div class="row">
                <?php
                    $take_sub_quiz_card_query = "SELECT * FROM `new_quiz_generate` WHERE ID = $ID && Course_Id = '$Courseid'";
                    $take_sub_quiz_card_query_check = mysqli_query($con,$take_sub_quiz_card_query);
                    $i=1;
                    while ($rows1 = mysqli_fetch_array($take_sub_quiz_card_query_check))
                    {
                ?>
                <a style="text-decoration: none;" href="previewQuiz.php?courseid=<?php echo $Courseid?>&quizid=<?php echo $rows1['Quiz_Id']?>" >
                <div class="col-md-4">
                        <div class="card" style="margin-top: 20px;height: auto;width: 300px;padding-bottom:5%;">
                            <div class="card-body" style=" height: 250px;padding: 20px;">              
                                <h5 style="color: black; text-align: center; margin-top: 7px; margin-bottom: 13px;"><?php echo $rows1['Quiz_Name']; ?></h5>

                                <h5 style="color: black; text-align: center; margin-bottom: 13px;"><?php echo $rows1['Topic_Name']; ?></h5>

                                <h5 style="color: black; text-align: center; margin-bottom: 13px;"><?php echo $rows1['Date']; ?></h5>

                                <h5 style="color: black; text-align: center; margin-bottom: 13px;"><?php echo $rows1['Start_Time']; ?></h5>

                                <h5 style="color: black; text-align: center; margin-bottom: 13px;"><?php echo "Marks : ".$rows1['Total_Marks']; ?></h5></a>

                                <div >
                                    <?php
                                        $take_deg_dip_query = "SELECT Degree_Diploma FROM `new_course_add` WHERE ID= $f_id && Course_Id = '$Courseid' ";

                                        $take_deg_dip_query_check = mysqli_query($con,$take_deg_dip_query);

                                        while($rows = mysqli_fetch_array($take_deg_dip_query_check))
                                        {
                                            $deg_dip = $rows['Degree_Diploma'];
                                        }

                                        $date_st=$rows1['Date'];
                                        $end_time=$rows1['End_Time'];
                                        $dt_time_concat_end = $date_st." ".$end_time;
                                        $dt_time_end = strtotime($dt_time_concat_end); 

                                        $get_date_only = date("Y-m-d",$dt_time_end);
                                        $get_only_time_end = date("H:i:sa",$dt_time_end);  


                                    ?>
                                    <span style="float:left; margin-top: 19px;<?php 
                                    if($get_today_date>$get_date_only ){ 
                                        echo "background-color:yellow;";
                                        
                                    }else if($get_today_date<$get_date_only ){
                                            echo "background-color:white;";
                                        } 
                                        else{
                                            if($get_current_time >= $get_only_time_end){
                                            echo "background-color:yellow;";
                                            }
                                            else{
                                                echo "background-color:white;";
                                            }
                                        }
                                        ?>" class="badge badge-pill badge-light"><?php echo $deg_dip; ?></span>  

                                    <input style="float: right; margin-top: 5px; margin-left: 6px;" type="button" value="Delete" name="del" class="btn btn-outline-danger btn-xs mb-3" data-toggle="modal" data-target="#exampleModalCenter[<?php echo $i ?>]" >
                                    <div class="modal fade" id="exampleModalCenter[<?php echo $i ?>]">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Delete Quiz</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you Sure Want to Delete the Quiz  ? </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                                                    <a href="../DeleteQuiz.php?Cid=<?php echo $rows1['Course_Id']; ?>&quizid=<?php echo $rows1['Quiz_Id']; ?>"><input type="button" value="Delete" name="del" class="btn btn-outline-secondary"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php 
                                        $i+=1;
                                    ?>
                                    <a href="AddQuizQuestion.php?Cid=<?php echo $Courseid?>&Qid=<?php echo $rows1['Quiz_Id']; ?>"><input style="float: right; margin-top: 5px; margin-left: 6px;" type="button" class="btn btn-outline-success btn-xs mb-3" value="Add Que"></a>

                                    <input style="float: right; margin-top: 5px; margin-left: 6px;" type="button" class="btn btn-outline-secondary btn-xs mb-3" name="edit" value="Edit" data-toggle="modal" data-target="#exampleModalCenter[<?php echo $i ?>]">
                                    <div class="modal fade" id="exampleModalCenter[<?php echo $i ?>]">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Quiz</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you Sure Want to Edit the Quiz  ? </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                                                    <a href="Edit_Quiz.php?Cid=<?php echo $rows1['Course_Id']; ?>&Qid=<?php echo $rows1['Quiz_Id']; ?>"><input type="button" value="Edit" name="edit" class="btn btn-outline-secondary"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                           
                        </div>
                    </div>    
                </div>
                <?php
                    $i+=1;
                    }
                    
                ?>
            </div>
        </div>


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