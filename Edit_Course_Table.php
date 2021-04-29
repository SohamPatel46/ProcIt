<?php
	require 'Connection_Procit_DB.php'; 
	session_start();
	
    if(isset($_POST['editcourse']))
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
            $edit_course_query = "UPDATE `new_course_add` SET Course_Name= '$SubName', Degree_Diploma='$DegDip',Academic_GATE= '$AcadGate',Batch_Year='$BatchYear', Sub_Image='$upload_file' WHERE ID='$fid' && Course_Id = '$SubId' ";
			if($edit_course_query_check =  mysqli_query($con,$edit_course_query))
			{
				header("location:DASHBOARDS/Main_index.php");
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
    			$edit_course_query = "UPDATE `new_course_add` SET Course_Name= '$SubName', Degree_Diploma='$DegDip',Academic_GATE= '$AcadGate',Batch_Year='$BatchYear', Sub_Image='$target_file' WHERE ID='$fid' && Course_Id = '$SubId' ";
    			if($edit_course_query_check =  mysqli_query($con,$edit_course_query))
    			{
    				move_uploaded_file($_FILES['sub_imge']['tmp_name'], $target_dir.$name);
    				header("location:DASHBOARDS/Main_index.php");
    			}
    			else{
    				echo "Error In executing QUery";
    			}
    		}
        }
    }

?>