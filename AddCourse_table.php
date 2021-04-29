<?php
	require 'Connection_Procit_DB.php'; 
    session_start();


    if(isset($_POST['addcourse']))
    {
    	$SubName = $_POST['subname'];
    	$SubId = $_POST['subid'];
    	$DegDip = $_POST['degdip'];
    	$AcadGate  = $_POST['acadGate'];
    	$BatchYear = $_POST['batchyear'];
		$fid = $_SESSION['ID'];
		
		$name = $_FILES['sub_imge']['name'];
		$target_dir = "Uploads/";
		
		
		if(!file_exists($_FILES['sub_imge']['tmp_name']))
        {
            $upload_file = "Uploads/Default_Course.jpg";
            $add_course_query = "INSERT INTO `new_course_add` VALUES ($fid,'$SubId','$SubName','$DegDip','$AcadGate','$BatchYear','$upload_file')";

			if($add_course_query_check =  mysqli_query($con,$add_course_query))
			{
    			echo "<script type='text/javascript'>
                            window.location.replace(\"DASHBOARDS/Main_index.php\");
                        </script>
                    ";
			}
			else{
				echo "Error In executing QUery";
			}
        }
        else{
            $target_file = $target_dir.basename($_FILES['sub_imge']['name']);

    		$img_file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    		$extension_arr = array("JPG","jpg","JPEG","jpeg","PNG","png","gif");
    
    		if(in_array($img_file_type,$extension_arr))
    		{
    			$add_course_query = "INSERT INTO `new_course_add` VALUES ($fid,'$SubId','$SubName','$DegDip','$AcadGate','$BatchYear','$target_file')";
    
    			if($add_course_query_check =  mysqli_query($con,$add_course_query))
    			{
    				move_uploaded_file($_FILES['sub_imge']['tmp_name'], $target_dir.$name);
    				//header("location:DASHBOARDS/Main_index.php");
    				echo "<script type='text/javascript'>
                        window.location.replace(\"DASHBOARDS/Main_index.php\");
                    </script>
                ";
    			}
    			else{
    				echo "Error In executing QUery";
    			}
    		}
        }
    }
    else{
        echo "Error";
    }
?>