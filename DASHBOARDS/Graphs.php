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
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
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
        $Courseid = $_GET['courseid'];
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
                                <a href="CoursePage.php?Cid=<?php echo $Courseid; ?>"><li><span><?php echo $course_name; ?></span></li><a>
                                <a href="Result.php?Cid=<?php echo $Courseid; ?>"><li><span>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;Result Analysis</span></li><a>
                                <?php
                                    $qid = $_GET['quizid'];
                                    $get_quiz_name = "SELECT * FROM `new_quiz_generate` WHERE ID = $ID && Course_Id='$Courseid' && Quiz_Id='$qid'";
                                    $get_quiz_name_check = mysqli_query($con,$get_quiz_name);
                                    while($roww = mysqli_fetch_array($get_quiz_name_check))
                                    {
                                        $quiz_name = $roww['Quiz_Name'];
                                    }
                                ?>
                                <a href="#"><li><span>&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp<?php echo $quiz_name; ?></span></li><a>
                            </ul>
                            <?php
                                $coid = $_GET['courseid'];
                                $qoid = $_GET['quizid'];
                            ?>
                            <a href="#"><button type="button" class="btn btn-outline-secondary btn-xs" style="float: right; margin-right: 20px;">Quiz Report</button></a>
                            <a href="AllStudentResult.php?cid=<?php echo $coid;?>&qid=<?php echo $qoid;?>"><button type="button" class="btn btn-outline-secondary btn-xs" style="float: right;margin-right: 20px;">Student Analysis</button></a>
                        </div>
                    </div>                    
                </div>
            </div>
            <!-- page title area end -->
            <!-- Graphs Starts-->

            <?php
                $courseidd = $_GET['courseid'];
                $quizidd = $_GET['quizid'];
                $fetch_response_for_graph = "SELECT * FROM `quiz_respose` WHERE Course_ID='$courseidd' && Quiz_ID='$quizidd ' ";
                $fetch_response_for_graph_check = mysqli_query($con,$fetch_response_for_graph);
                
                $tot_ques=0;
                $arr=[];
                $response_string=[];
                $flag_array=[];
                $i=0;
                while($row1 = mysqli_fetch_array($fetch_response_for_graph_check))
                {
                    $arr[$i] = $row1['Score'];
                    $tot_marks = $row1['Out_of'];                    
                    if($row1['Flag_string']!="-"){
                        $response_string[$i]=$row1['Flag_string'];
                        $i++;
                    }
                }   
                $fetch_tot_ques_quiz = "SELECT * FROM `new_quiz_generate` WHERE ID='$f_id' && Course_Id='$courseidd' && Quiz_Id='$quizidd'";
                $fetch_tot_ques_quiz_check = mysqli_query($con,$fetch_tot_ques_quiz);
                while($roq = mysqli_fetch_array($fetch_tot_ques_quiz_check))
                {
                    $tot_ques = $roq['Total_Question'];
                }
                $fr = array_fill(0, $tot_marks+1, 0);
                for($i=0;$i<count($arr);$i++)
                {
                    $fr[$arr[$i]] = $fr[$arr[$i]] + 1;
                } 
                for($i=0;$i<count($response_string);$i++)
                {
                    $flag_array[$i] = explode("~",$response_string[$i]);                    
                }
                
                $correct=[];
                for($i=0;$i<$tot_ques;$i++)
                {
                    $correct[$i]=0;
                }
                
                for($i=0;$i<$tot_ques;$i++)
                {
                    for($j=0;$j<count($response_string);$j++)
                    {                        
                        $correct[$i]+=$flag_array[$j][$i];
                    }
                }                
            ?>

            <script>
                window.onload = function () 
                {
                    var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: true,
                    exportEnabled: true,
                    theme: "light1", // "light1", "light2", "dark1", "dark2"
                    title:{
                        text: "Class Perfomance Marks Wise"
                    },
                    axisY: {
                    includeZero: true,
                    title:"Number of Students"
                    },
                    data: [{
                        type: "column", //change type to bar, line, area, pie, etc
                        indexLabel: "{y}", //Shows y value on all Data Points
                        indexLabelFontColor: "#5A5757",
                        indexLabelFontSize: 16,
                        indexLabelPlacement: "outside",
                        dataPoints: [
                            <?php
                                for($i=0;$i<=$tot_marks;$i++)
                                {
                                    if($i==$tot_marks)
                                    {
                                        echo "{ x: ".$i.", y: ".$fr[$i]." }";
                                    }
                                    else{
                                        echo "{ x: ".$i.", y: ".$fr[$i]." },";
                                    }
                                    
                                }
                            ?>
                        ]
                    }]
                });
                chart.render();

                var chart = new CanvasJS.Chart("chartContainer1", {
                    animationEnabled: true,
                    exportEnabled: true,
                    theme: "light1", //"light1", "dark1", "dark2"
                    title:{
                        text: "Question Analysis"             
                    },
                    axisY:{
                        interval: 10,
                        suffix: "%"
                    },
                    toolTip:{
                        shared: true
                    },
                    data:[{
                        type: "stackedBar100",
                        toolTipContent: "{label}<br><b>{name}:</b> {y} (#percent%)",
                        showInLegend: true, 
                        name: "Correct",
                        dataPoints: [
                            <?php
                                for($i=0;$i<$tot_ques;$i++)
                                {
                                    echo "{ y: ".$correct[$i].", label: \"".($i+1)."\" },";
                                }                                   
                                
                            ?>                            
                        ]
                        },
                        {
                            type: "stackedBar100",
                            toolTipContent: "<b>{name}:</b> {y} (#percent%)",
                            showInLegend: true, 
                            name: "Incorrect",
                            dataPoints: [
                                <?php
                                for($i=0;$i<$tot_ques;$i++)
                                {
                                    $var = count($response_string)-$correct[$i];
                                    echo "{ y: ".$var.", label: \"".($i+1)."\" },";
                                } 
                                ?>                                
                            ]
                        }]
                });
                chart.render();

                }
            </script>



            <div>
                <div id="chartContainer" style="float:left;margin-top:0px; height: 450px; width: 75%; padding:5%;  "></div>
                <div style="float:right;margin-top:15%;margin-right:4%;">
                    <?php
                        $meann = round((array_sum($arr)/count($arr)),2);
                        echo "<h3>Mean : $meann</h3><br>";
                        $minn = min($arr);
                        $maxx = max($arr);
                        echo "<h3>Min  : $minn</h3><br>";
                        echo "<h3>Max  : $maxx</h3><br>";

                    ?>
                </div>
            </div>

            <br><br><br>

            <div style="margin-top:40% ; padding:5%; margin-bottom:10%">
                <div id="chartContainer1" style="height: 450px;padding:5%; width: 90%;"></div>
            </div>
            
            
            <!-- Graphs Ends-->   
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