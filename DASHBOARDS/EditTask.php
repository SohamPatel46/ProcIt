<?php
    require '../Connection_Procit_DB.php'; 
    require '../session.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>TaskNote</title>
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
                                <li><span>Edit Task Note</span></li>
                            </ul>
                        </div>
                    </div>                    
                </div>
            </div>
            <!-- page title area end -->
            <?php
                $id = $_SESSION['ID'];
                $take_subject_query = "SELECT * FROM `new_course_add` WHERE ID = '$id'";

                $take_subject_query_check = mysqli_query($con,$take_subject_query);
                ?>
            <!-- Server side start -->
            <?php
                $Task_no  = $_GET['tno'];
                $select_task = "SELECT * FROM `to_do_task_faculty` WHERE Sr_No='$Task_no'";
                $select_task_check = mysqli_query($con,$select_task);
                while($roww = mysqli_fetch_array($select_task_check)){
                    $explain = $roww['Remarks'];
                    $time = $roww['Task_Time'];
                    $Date = $roww['Task_Date'];
                }
            ?>
            <div class="col-12">
                <div class="card mt-5" style=" width: 100%; height: auto;" >
                    <div class="card-body"> 
                        <h4 class="header-title" style="font-size: 25px;">Edit Note</h4>
                        <form class="needs-validation" action="../Edit_Task.php?tno=<?php echo $Task_no; ?>" novalidate="" method="post">
                            <div class="form-row">
                                <div>
                                    <label class="custom-control-label" style="margin-right: 40px; margin-left: 5px;">Choose Subject :</label>
                                </div>
                                <select style="margin-bottom: 10px;" name="subject" class="btn btn-light dropdown-toggle btn-xs">
                                    <?php 
                                    while($rows = mysqli_fetch_array($take_subject_query_check))
                                    {

                                    ?>
                                    <option class="dropdown-item" ><?php echo $rows['Course_Name']; ?></option>

                                    <?php 
                                    }
                                ?>
                                </select>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group" style="margin-left: 5px;">
                                    <label for="example-date-input" style="margin-left:1px;" class="col-form-label"> Select Date :</label>
                                    <input class="form-control" style="width: 300px;" type="date" name="Edit_date" value="<?php echo $Date; ?>" placeholder="MM/DD/YYYY" id="example-date-input">
                                </div>

                                 <div class="form-group" style="margin-left: 30px;">
                                    <label for="example-time-input" style="margin-left:1px;" class="col-form-label">Select Time : </label>
                                    <input name="Edittime" class="form-control" type="time" style="width: 300px;" value="<?php echo $time; ?>"  id="example-time-input">
                                </div>
                            </div>

                            <div class="row form-group">
                                <!--
                                <div style="margin-left: 17px; margin-right: 17px;">
                                    <label for="textarea-input" class=" form-control-label">Remarks : </label>
                                </div>
                                <div  style="width:550px;">
                                    <textarea name="textarea-input" id="textarea-input" rows="3" placeholder="Add Note Here..." class="form-control"></textarea>
                                </div>
                            -->
                            
                                <div class="form-group mb-3">
                                    <div style="margin-left: 17px; margin-right: 17px;">
                                        <label for="textarea-input" class=" form-control-label">Remarks : </label>
                                    </div>
                                    <div  style="width:628px; margin-left: 15px;">
                                        <textarea name="Editnote" id="textarea-input" rows="3" placeholder="Add Note Here..." class="form-control"><?php echo $explain; ?></textarea>
                                    </div>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div style="margin-top: -5px;">
                                <input style=" margin-right: 20px;" class="btn btn-secondary" type="submit" name="editTask" value="Edit Task">
                                <input style=" " class="btn btn-secondary" value="Clear" type="reset">
                            </div>
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
