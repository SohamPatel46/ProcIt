<?php
    require 'Connection_Procit_DB.php'; 
    session_start();

    if(isset($_POST['register']))
    {
        $name_surname = $_POST['name'];
        $sem = $_POST['sem'];
        $batch = $_POST['Batch_Year'];
        $deg_dip = $_POST['deg_dip'];
        $password = $_POST['password'];
        $er = $_POST['erno'];
        $email = $_POST['email'];
        
        $name_arr = explode(" ",$name_surname);
        
        $st = substr($name_arr[0],0,2);
        $st1 = substr($name_arr[1],0,2);

        $c = $st.$batch;
        $d = $c.$st1;
        $id = $d.$st;
        
        $name = $_FILES['stud_image']['name'];
        $target_dir = "uploads_student_img/";
        
        $check_already_register = "SELECT * FROM `login` WHERE Email_Id='$email' ";
        
        $check_already_register_check = mysqli_query($con,$check_already_register);
        
        $rows = mysqli_num_rows($check_already_register_check);
        
        if($rows==1){
            echo "<h1>Already a User Registered</h1>";
        }
        else{
            if(!file_exists($_FILES['stud_image']['tmp_name'])){
                $upload_file = "uploads_student_img/dummy.jpg";
                $insert_query = "INSERT INTO `student_data` VALUES ('$email','$password','$id','$name_surname','$upload_file','$deg_dip','$sem','$batch','$er')";
        
                if($insert_query_check = mysqli_query($con,$insert_query)){
                    $insert_login = "INSERT INTO `login` VALUES ('$email','$password') ";
                    
                    if($insert_login_check = mysqli_query($con,$insert_login)){
                        echo "<h1>Your response has been Recorded</h1>";
                    }
                    else{
                        echo "<h1>Error</h1>";
                    }
                }
                else{
                    echo "<h1>Error</h1>";
                }
            }
            else{
                $target_file = $target_dir.basename($_FILES['stud_image']['name']);

                $img_file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
                $extension_arr = array("JPG","jpg","JPEG","jpeg","PNG","png","gif");
    
                if(in_array($img_file_type,$extension_arr)){
                    $insert_query = "INSERT INTO `student_data` VALUES ('$email','$password','$id','$name_surname','$target_file','$deg_dip','$sem','$batch','$er')";
        
                    if($insert_query_check = mysqli_query($con,$insert_query)){
                        $insert_login = "INSERT INTO `login` VALUES ('$email','$password') ";
                        
                        if($insert_login_check = mysqli_query($con,$insert_login)){
                            move_uploaded_file($_FILES['stud_image']['tmp_name'], $target_dir.$name);
                            echo "<h1>Your response has been Recorded</h1>";
                        }
                        else{
                            echo "<h1>Error</h1>";
                        }
                    }
                    else{
                        echo "<h1>Error</h1>";
                    }
                }
            }
        }
    }
?>