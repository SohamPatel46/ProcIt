<?php
    require '../Connection_Procit_DB.php'; 
    require '../session_student.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Start Quiz</title>
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
	<div class="page-container" style="background-color: white;">

	<!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div style="height: 71px;" class="sidebar-header">
                <div class="logo" style=" margin-top: 15px;">
                    <a style="text-decoration: none;" href="Main_index.php"><p style="font-family: Helvetica; font-size: 18px; color: white"> <b>ProcIT <br> Online Exam</b></p></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                    	<div >
	                        <div >
	                            <img style="margin-left: 75px;  height: 120px; width: 120px; border-radius: 5px;"  src="../<?php echo $_SESSION['Image']; ?>" alt="avatar">
	                            <h4 class="user-name " style="text-align: center; padding: 30px; "><?php echo $_SESSION['Name']; 
                                ?></h4>	                            	
	                        </div>
                   		</div>
                        <ul class="metismenu" id="menu">
                            
                            <li><a href="ToDoList.php"><i class="ti-book"></i> <span>To-Do List</span></a></li>
                            <li><a href="#"><i class="ti-receipt"></i> <span>Gate Portal</span></a></li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layers-alt"></i> <span>All Subjects</span></a>
                                <ul class="collapse">
                                    <?php
                                        $batch_year = $_SESSION['Batch_Year'];
                                        $deg_dip = $_SESSION['Deg_Dip'];
                                        $take_sub_card_query = "SELECT * FROM `new_course_add` WHERE Batch_Year='$batch_year' && Degree_Diploma = '$deg_dip' ";
                    
                                        $take_sub_card_query_check = mysqli_query($con,$take_sub_card_query);
                                        while ($rows1 = mysqli_fetch_array($take_sub_card_query_check))
                                        {
                                            $cciid=$rows1['Course_Id'];
                                    ?>
                                    <li><a href="CoursePage.php?courseid=<?php echo $cciid; ?>&by=<?php echo $batch_year; ?>&dgdp=<?php echo $deg_dip; ?>"><?php echo $rows1['Course_Name']; ?></a></li>
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
                                <li><span>Dashboard</span></li>
                                <?php
                                    $course_id = $_GET['courseid'];
                                    $batch_year = $_GET['by'];
                                    $deg_dip = $_GET['dgdp'];           
                                    $take_sub_card_query = "SELECT * FROM `new_course_add` WHERE Batch_Year='$batch_year' && Degree_Diploma = '$deg_dip' && Course_Id='$course_id' ";

                                    $take_sub_card_query_check = mysqli_query($con,$take_sub_card_query);
                                    $row = mysqli_fetch_array($take_sub_card_query_check);
                                ?>
                                <a href="CoursePage.php?courseid=<?php echo $cciid; ?>&by=<?php echo $batch_year; ?>&dgdp=<?php echo $deg_dip; ?>"><li><span>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;<?php echo $row['Course_Name']?></span></li></a>
                                <a href="#"><li><span>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;&nbsp;Start Quiz</span></li></a>
                            </ul>
                        </div>
                    </div>                    
                </div>
            </div>
            <!-- page title area end -->
            <div>
                <?php 
                    $cciid = $_GET['courseid'];
                    $qid = $_GET['qid'];
                    $batch_year = $_GET['by'];
                    $deg_dip = $_GET['dgdp'];
                    
                    $select_details_quiz = "SELECT * FROM `to_do_list_student` WHERE Course_Id='$cciid' && Degree_diploma='$deg_dip' && Batch_Year= '$batch_year' && Quiz_Id='$qid' ";
                    $select_details_quiz_check = mysqli_query($con,$select_details_quiz);
                    while($row = mysqli_fetch_array($select_details_quiz_check))
                    {
                ?>
                <h5 style=" padding: 3%; padding-left:40%;"><?php echo $row['Quiz_Name']; ?></h1>
                <div style="padding-left: 30%; padding-right: 30%; justify-content: center;">
                    <table class="table" style="padding: 200px;">
                        <tr>                          
                          <td>Topic</td>
                          <td><?php echo $row['Topic']; ?></td>
                        </tr>

                        <tr>                          
                          <td>Total Question</td>
                          <td><?php echo $row['Total_Question']; ?></td>
                        </tr>

                        <tr>                                                  
                          <td>Total Marks</td>
                          <td><?php echo $row['Marks']; ?></td>
                        </tr>

                        <tr>                                                  
                          <td>Allowed Attempts</td>
                          <td><?php $allowed_attempts=$row['Attempts'];  echo $allowed_attempts; ?></td>
                        </tr>
                        
                        <tr>                                                  
                          <td>Date</td>
                          <td><?php echo $row['Quiz_Date']; ?></td>
                        </tr>

                        <tr>                                                  
                          <td>Start Time</td>
                          <td><?php echo $row['Start_Time']; ?></td>
                        </tr>

                        <tr>                                                  
                          <td>End Time</td>
                          <td><?php echo $row['End_Time']; ?></td>
                        </tr>                      
                    <?php
                        $strt_time = $row['Start_Time'];
                        $end_time = $row['End_Time'];
                        $date_st = $row['Quiz_Date'];
                        }
                    ?>
                    </table>
                    <div>
                        <?php
                            $dt_time_concat_strt = $date_st." ".$strt_time;
                            $dt_time_concat_end = $date_st." ".$end_time;
                            $dt_time_strt = strtotime($dt_time_concat_strt);
                            $dt_time_end = strtotime($dt_time_concat_end);                             

                            $get_date_only = date("Y-m-d",$dt_time_strt);
                            $get_only_time_start = date("H:i:sa",$dt_time_strt);
                            $get_only_time_end = date("H:i:sa",$dt_time_end);

                            $sid = $_SESSION['ID'];
                            $get_attempted_or_not = "SELECT * FROM `quiz_respose` WHERE ID='$sid' && Course_ID='$cciid' && Quiz_ID='$qid'";
                            $get_attempted_or_not_check = mysqli_query($con,$get_attempted_or_not);

                            $count_attempt = mysqli_num_rows($get_attempted_or_not_check);
                            
                            if(($get_current_time >= $get_only_time_start && $get_current_time <= $get_only_time_end && $get_today_date===$get_date_only) && ($count_attempt<$allowed_attempts))
                            {
                        ?>

                        <button  style="margin-top: 10px; margin-left: 20%;" class="btn btn-secondary " onclick="func() ;" type="submit" >Start Quiz</button>
                        
                        <script type="text/javascript">
                            function func(){
                                <?php
                                    $_SESSION["Quiz_Id"]=$qid;
                                    $_SESSION["Course_Id"] = $cciid;
                                    $_SESSION['start_quiz_url']="?courseid=$cciid&qid=$qid&by=$batch_year&dgdp=$deg_dip";
                                ?>
                                location.href="quiz.php";                                
                            }
                        </script>

                        <?php
                            }                        
                            else if(($get_current_time > $get_only_time_end && $get_today_date===$get_date_only)&&($count_attempt==0))
                            {
                        ?>
                        <button  disabled style="margin-top: 10px; margin-left: 20%;" class="btn btn-danger" type="submit">Missed it</button>
                        <?php
                            }
                            else if($count_attempt!=0)
                            {
                        ?>
                        <button  disabled style="margin-top: 10px; margin-left: 20%;" class="btn btn-success" type="submit">Already Attempted</button>
                           
                        <?php
                            }else{
                        ?>  
                        <button disabled style="margin-top: 10px; margin-left: 20%;" class="btn btn-secondary " onclick="func() ;" type="submit" >Start Quiz</button>
                        <?php
                            }
                        ?>  
                        
                        
                    </div>

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