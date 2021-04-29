<?php
    require '../Connection_Procit_DB.php'; 
	require '../session_student.php';
	$_SESSION['q_i']=1;
?>
<!DOCTYPE html>
<html>
<head>
	<title>My Quiz</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js'></script>
	<script src="./js/camvas.js"></script>
    <script src="./js/pico.js"></script>
    <script src="./js/index.js"></script>
	<link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
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
	<script>
		$(document).ready(function(){
			$("#full-view").click(function(){
		    	$(this).hide();
		    });
		});
	</script>
	<style type="text/css" >

		body {
		background-color: #eee
		}

		label.radio {
		cursor: pointer
		}

		label.radio input {
		position: absolute;
		top: 0;
		left: 0;
		visibility: hidden;
		pointer-events: none
		}

		label.radio span {
		padding: 5px;
		border: 1px solid black;
		display: inline-block;
		color: black;
		width: auto;
		text-align: center;
		border-radius: 3px;
		margin-top: 7px;
		
		}
		label.radio2 span {
		padding: 12px;
		margin-left: 10px;
		margin-right: 10px;
		display: inline-block;		
		border: 1px solid black;
		color: black;
		width: 50px;
		text-align: center;
		border-radius: 3px;
		margin-top: 7px;
		margin-bottom: 10px;
		text-transform: uppercase
		}

		label.radio input:checked+span {
		border-color: black;
		background-color: yellow;
		color:black;
		}

		.ans {
		margin-left: 36px !important
		}

		.btn:focus {
		outline: 0 !important;
		box-shadow: none !important
		}

		.btn:active {
		outline: 0 !important;
		box-shadow: none !important
		}
	</style>
</head>
<body>
	<?php
		$cid = $_SESSION['Course_Id'];
		$quiz_id = $_SESSION['Quiz_Id'];


		$select_quiz_data = "SELECT * FROM `to_do_list_student` WHERE Course_Id='$cid' && Quiz_Id='$quiz_id'";

		$select_quiz_data_check = mysqli_query($con,$select_quiz_data);
		while($rows = mysqli_fetch_array($select_quiz_data_check))
		{
			$quiz_name = $rows['Quiz_Name'];
			$topic = $rows['Topic'];
			$tot_ques = $rows['Total_Question'];
			$date = $rows['Quiz_Date'];
			$end_time = $rows['End_Time'];
		}

		$select_quiz_questions = "SELECT * FROM `add_quiz_question` WHERE Course_Id='$cid' && Quiz_Id='$quiz_id'";
		$select_quiz_questions_check = mysqli_query($con,$select_quiz_questions);

		$question = [];
		$option1 = [];
		$option2 = [];
		$option3 = [];
		$option4 = [];
		$correct_option = [];

		$response = [];
		$status = [];



		while($row = mysqli_fetch_array($select_quiz_questions_check))
		{
			$question[$row['Question_Number']] = $row['Question'];
			$option1[$row['Question_Number']] = $row['Option1'];
			$option2[$row['Question_Number']] = $row['Option2'];
			$option3[$row['Question_Number']] = $row['Option3'];
			$option4[$row['Question_Number']] = $row['Option4'];
			$correct_option[$row['Question_Number']] = $row['Correct_Option'];
		}

	?>

	<div>
		<div style="width: 50%; padding:20px;float: left">
			<div><h1><?php echo $quiz_name; ?></h1></div>
			<div><h2 id="d" style="float: left;"></h2>
			<input id="full-view" style="float: left;padding: 3px;margin-left: 20px; margin-top: 6px; " type="button" onclick="start_timer();" value="Start Countdown"></div>
		</div>

	    <!-- timer -->
		<script type="text/javascript">
			//alert("hey");
			function start_timer(){


				//full-view.value="started";
			   	var date = "<?php echo $date; ?>";
			   	
	    		var end_time = "<?php echo $end_time;?>";

	    		var date_res = date.split("-");

	    		var end_time_res=end_time.split(":");
	    		//alert(end_time_res);

	    		//var countDownDate = new Date(2020,10,3,16,0,0,0).getTime();
	    		var countDownDate = new Date(parseInt(date_res[0]),parseInt(date_res[1])-1,parseInt(date_res[2]),parseInt(end_time_res[0]),parseInt(end_time_res[1]),0,0).getTime();

			
				var x = setInterval(function() {
			  
					var now = new Date().getTime();

					var distance = countDownDate - now;
					var days = Math.floor(distance / (1000 * 60 * 60 * 24));
				    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
					var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
					var seconds = Math.floor((distance % (1000 * 60)) / 1000);

				    document.getElementById("d").innerHTML = "Remaining Time : "+minutes + "m " + seconds + "s ";

				    if (distance < 0) {
				    	clearInterval(x);
				    	document.getElementById("d").innerHTML = "EXPIRED";
				    }
				}, 1000);
		}
     	</script>


		<div style="float: right;padding: 20px;">
			<div>
				<canvas style="display: none;" width="640" height="480"></canvas>
				<p style="padding: 5px; text-align: center; font-size:40px;" id="er"></p>				
				<p style="padding: 5px; text-align: center; font-size:40px; background-color: red; color: black"  id="er1"></p>
			</div>
		</div>
	</div>
	<?php 
		$_SESSION['q_i']=1;
		
		function load_question($tot_ques,$topic,$question,$option1,$option2,$option3,$option4)
		{
	?>

	<div>
		<div class="container" style="float:left;width: 70%; margin-left:1.5%; height: 200px;">
		    <div class="row">
		        <div class="" style="width: 100%;">
		            <div class="border">
		                <div class="question bg-white p-3 border-bottom">
		                    <div class="d-flex flex-row justify-content-between align-items-center mcq">
		                        <h4><?php echo $topic; ?></h4><span>(1 of <?php echo $tot_ques; ?>)</span>
		                    </div>
		                </div>
		                <div class="question bg-white p-3 border-bottom" style="height: 400px;">
		                    <div class="d-flex flex-row align-items-center question-title"style="padding: 10px;	">
		                        <h3 class="">Q.</h3>
		                        <h5 class="mt-1 ml-2"><?php echo $question[$_SESSION['q_i']]; ?>
		                        </h5>
		                    </div>
		                    <div class="ans ml-2" style="padding: 10px;">
		                        <label class="radio"> <input type="radio" name="option[<?php echo$_SESSION['q_i']; ?>]" value="<?php echo $option1[$_SESSION['q_i']]; ?>"> <span><?php echo $option1[$_SESSION['q_i']]; ?></span>
		                        </label>
		                    </div>
		                    <div class="ans ml-2" style="padding: 10px;">
		                        <label class="radio"> <input type="radio" name="option[<?php echo $_SESSION['q_i']; ?>]" value="<?php echo $option2[$_SESSION['q_i']]; ?>"> <span><?php echo $option2[$_SESSION['q_i']]; ?></span>
		                        </label>
		                    </div>
		                    <div class="ans ml-2" style="padding: 10px;">
		                        <label class="radio"> <input type="radio" name="option[<?php echo $_SESSION['q_i']; ?>]" value="<?php echo $option3[$_SESSION['q_i']]; ?>"> <span><?php echo $option3[$_SESSION['q_i']]; ?></span>
		                        </label>
		                    </div>
		                    <div class="ans ml-2" style="padding: 10px;">
		                        <label class="radio"> <input type="radio" name="option[<?php echo $_SESSION['q_i']; ?>]" value="<?php echo $option4[$_SESSION['q_i']]; ?>"> <span><?php echo $option4[$_SESSION['q_i']]; ?></span>
		                        </label>
		                    </div>
		                </div>
						
		                <div class="d-flex flex-row justify-content-between align-items-center p-3 bg-white">
			                <button class="btn btn-primary d-flex align-items-center btn-danger" type="button" style="background-color: black; border-color: black;">Previous</button>
			                <button class="btn btn-primary border-success align-items-center btn-success" type="button" style="background-color: green">Save and Next</button>
			                <button class="btn btn-primary align-items-center btn-success" style="background-color: red; border-color: red;" onclick="func();"  type="submit">Next button</button>
							<script type="text/javascript">
							function func()
							{
								alert('Hello clayed');
								<?php
									if($_SESSION['q_i'] != $tot_ques) 
									{
										//echo '<script>alert("In IF")</script>';
										$s=$_SESSION['q_i'];
										
										//echo "<h1> $s </h1>"; 	
										$_SESSION['q_i']+=1;
										//echo $_SESSION['q_i']; 
										load_question($tot_ques,$topic,$question,$option1,$option2,$option3,$option4);
									}else{
										//echo '<script>alert("In Else")</script>';
									}
								?>
							}
						</script>
		            	</div>
						
		            </div>
		        </div>
		    </div>
	    </div>
		<?php
			}

			if($_SESSION['q_i']==1){
				load_question($tot_ques,$topic,$question,$option1,$option2,$option3,$option4);
			}
		?>
		
	    <div class="container" style="float:right;width: 27%; margin-right:1%; margin-top: 0px; height: 200px;">
		    <div class="row">
		        <div class="" style="width: 100%;">
		            <div class="border">
		                
		                <div class="question bg-white p-3 border-bottom" style="height:364px;">
	                   
	                        <label class="radio2">

	                        	<span>1</span>
	                        	<span>2</span>
	                        	<span>3</span>
	                        	<span>4</span>
	                        	<span>5</span>
	                        	<span>6</span>
	                        	<span>7</span>
	                        	<span>8</span>
	                        	<span>9</span>

	                        	<span>8</span>
	                        	<span>9</span>

	                        	<span>1</span>
	                        	<span>2</span>
	                        	<span>3</span>
	                        	<span>14</span>
	                        	<span>15</span>
	                        	<span>16</span>
	                        	<span>17</span>
	                        	<span>18</span>
	                        	<span>9</span>

	                        </label>

	                       
		                </div>
		                
		            </div>
		        </div>
		    </div>
	    </div>

	    <div class="container" style="float:right;width: 27%; margin-right:1%; margin-top: 170px; height: 169px;">
		    <div class="row">
		        <div class="" style="width: 100%;">
		            <div class="border">
		                
		                <div class="question bg-white p-3 border-bottom" style="height:169px;">
	                   
	                        <label class="radio2">

	                        	<span style="width: auto; border: 1px solid green;background-color: green;color: white;">Answered</span>

	                        	<span style="width: auto;background-color: blue; border: 1px solid blue;color: white;">Not Visited</span>


	                        	<span style="width: auto; border: 1px solid red;background-color: red;color: white;">Not Answered</span>                       	

	                        
	                        </label>

	                       
		                </div>
		                
		            </div>
		        </div>
		    </div>
	    </div>
	</div>

	<script>

		document.body.addEventListener("keydown", function(event) {
			er1.innerHTML="You tried to change screen";
        	//alert(" You have Tried To change the Screen !! Sucpicious Activity Marked")
		    setTimeout(function(){ 	
		    	er1.innerHTML=""
			}, 5000);		

	});

	</script>
		

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








