<?php
    require '../Connection_Procit_DB.php'; 
    require '../session_student.php';
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
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
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
                                <li><span>To-Do List</span></li>
                            </ul>
                        </div>
                    </div>                    
                </div>
            </div>
            <!-- page title area end -->
        
            <!-- Server side start -->
                <div class="col-12 mt-5">
                    <div class="card" style="margin-top: -30px;">
                        <div class="card-body">
                            <h4 class="header-title">To - Do Quizzes</h4>
                            <div class="data-tables datatable-dark">
                                <table id="dataTable3" class="text-center">
                                    <thead class="text-capitalize">
                                        <tr>
                                            <th>Subject</th>
                                            <th>Topic</th>
                                            <th>Quiz Date</th>
                                            <th>Quiz marks</th>                              
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Attempts</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $batch_year = $_SESSION['Batch_Year'];
                                            $deg_dip = $_SESSION['Deg_Dip'];
                                            $select_to_do_students = "SELECT * FROM `to_do_list_student` WHERE Batch_Year='$batch_year' && Degree_diploma ='$deg_dip' ";
                                            $select_to_do_students_check = mysqli_query($con,$select_to_do_students);
                                            while($row = mysqli_fetch_array($select_to_do_students_check))
                                            {
                                                $courseid = $row['Course_Id'];
                                                $select_course_name = "SELECT * FROM `new_course_add` WHERE Course_Id = '$courseid' && Batch_Year='$batch_year' && Degree_Diploma='$deg_dip' ";

                                                $select_course_name_check = mysqli_query($con,$select_course_name);
                                                while($row2 = mysqli_fetch_array($select_course_name_check))
                                                {
                                                    $course_name = $row2['Course_Name'];
                                                }
                                        ?>
                                        
                                        <tr>
                                            <td><?php echo $course_name; ?></td>
                                            <td><?php echo $row['Topic']; ?></td>
                                            <td><?php echo $row['Quiz_Date']; ?></td>
                                            <td><?php echo $row['Marks']; ?></td>
                                            <td><?php echo $row['Start_Time']?></td>
                                            <td><?php echo $row['End_Time']?></td>
                                            <td><?php echo $row['Attempts']?> </td>

                                        </tr>
                                        <?php
                                            }
                                        ?>
                                                                             
                                    </tbody>
                                </table>
                            </div>
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

    <!-- Start datatable js -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>
</html>
