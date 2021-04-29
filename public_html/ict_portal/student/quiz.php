<?php
    require '../Connection_Procit_DB.php'; 
	require '../session_student.php';
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
	<script type = "text/javascript" >  
        function preventBack() { window.history.forward(); }  
        setTimeout("preventBack()", 0);  
        window.onunload = function () { null };  
    </script>
	<script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
	<script>
		var counter=0;
		var screen_height = 0;
		$(document).ready(function(){
			$("#quiz_display").hide();
			$("#full-view").click(function(){
		    	$(this).hide();
				$("#quiz_display").show();
				$("#camera").addClass("cam2");
				$("#camera").removeClass("cam1");
				$("#inst1").hide();
				$("#inst2").hide();
				<?php
					$_SESSION['Start_Time'] = $new_time;
				?>
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
		background-color: #60e1eb;
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

		.cam2{
			margin-left:auto;
			margin-right:auto;
			width:15%;
			margin-top:-8%;
			margin-right:15%;
		}

		.cam1{
			margin-top:4%;
			float:left;
			width:40%;
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
		$question_type = [];
		$question_marks = [];

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
			$question_type[$row['Question_Number']] = $row['question_type'];
			$question_marks[$row['Question_Number']] = $row['Marks'];
		}
		$_SESSION['correct']=$correct_option;
		$_SESSION['question_type']=$question_type;
		$_SESSION['total_questions']=$tot_ques;
		$_SESSION['question_marks'] = $question_marks;
	?>

	<div>
		<!-- timer -->
		<script type="text/javascript">
			//alert("hey");
			function getScreenHeight(){
					
					setTimeout(function(){ 	
						var win = window,
						doc = document,
						docElem = doc.documentElement,
						body = doc.getElementsByTagName('body')[0],
						y = win.innerHeight|| docElem.clientHeight|| body.clientHeight;
						screen_height = y;
					}, 1000);
			}
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


					//New Code --Screen Change Dimension

					var win = window,
					doc = document,
					docElem = doc.documentElement,
					body = doc.getElementsByTagName('body')[0],
					y = win.innerHeight|| docElem.clientHeight|| body.clientHeight;
		
				    document.getElementById("d").innerHTML = "Remaining Time : "+minutes + "m " + seconds + "s ";

					if(y!=screen_height && screen_height!=0){
						document.getElementById("er2").innerHTML = "You Disabled Full Screen..Redirecting To Course Page";						
						setTimeout(function(){ 
							location.href = "../Disabled_redirection.php";
						}, 4000);						
					}
					else{
						document.getElementById("er2").innerHTML = "";
					}


				    if (distance < 0) {
				    	clearInterval(x);
				    	document.getElementById("d").innerHTML = "EXPIRED";
				    }
				}, 1000);
		}
     	</script>

	<div style="overflow:hidden;position:fixed;background-color: #bfbfbf;top:0;width:100%;">
		<div style="padding-left:20px;padding-top:10px; "><h1><?php echo $quiz_name; ?></h1></div>
		<div><h2 id="d" style="padding-left:20px;margin-bottom:2%;"></h2></div>
		<div style="text-align:center;width:100%;">
			<p id="inst1" style="float:left;width:30%;margin-top:4%;font-size:30px;"> <br> <br> <br><b>Instructions</b> : <br> <br>
				1. Allow your camera access<br> <br>
				2. Dont try to change screen<br> <br>
				3. Dont try to exit fullscreen<br> <br>
				4. You wont be able to copy <br> <br>questions 
			</p>
			<canvas id="camera" class="cam1" width="640" height="480"></canvas>
			<p id="inst2" style="float:left;width:30%;margin-top:4%;font-size:30px;"><br> <br> <br><b>Tips For Camera</b> : <br> <br>
				1. Ensure you are recognized in <br> <br> camera before launching Quiz<br><br>
				2. Maintain proper lightning <br> <br>
				3. Dont look off screen <br> <br>
				4. Stay stable throughout<br><br> examination
			</p>
		</div>
		<div style="text-align:center;width:100%;">
			<input id="full-view" style="margin-right:30%;margin-left:30%;margin-top:2%;margin-bottom:2%;font-size:20px;" class="btn btn-outline-primary" type="button" onclick="start_timer(); getScreenHeight();" value="Launch Quiz">
		</div>
		<p style="margin-left:67%;border-radius:10px;position:fixed;top:0;padding:5px;margin-top:1%;text-align: center;color:black; font-size:40px;" id="er"></p>				
		<p style="margin-left:55%;margin-top:4%;border-radius:10px;position:fixed;top:0;padding: 5px; text-align: center; font-size:40px;color: black"  id="er1"></p>
		<p style="margin-left:55%;margin-top:7%;border-radius:10px;position:fixed;top:0;padding: 5px; text-align: center; font-size:30px;color: black"  id="er2"></p>
	</div>
	<div id="quiz_display" style="margin-top:13%;" >
		<div class="container" style="float:left;width: 100%; margin-left:1.5%; height: 200px;">
		    <div class="row">
		        <div class="" style="width: 100%;">
		            <div class="border">
		                <div class="question bg-white p-3 border-bottom" style="width:125%;">
		                    <div class="d-flex flex-row justify-content-between align-items-center mcq">
		                        <h4><?php echo $topic; ?></h4>
		                    </div>
		                </div>
						
						<form id="myform_submit" action="../response.php" method="post">
						
						<?php
							for($q_i=1;$q_i<=$tot_ques;$q_i++) 
							{
								?>
							<?php
								if($question_type[$q_i]=="mcqs"){
							?>
		                <div class="question bg-white p-3 border-bottom" style="height: 400px; margin-top:10px;width:125%;">
		                    <div class="d-flex flex-row align-items-center question-title"style="padding: 10px;	">
		                        <h3 class="">Q.</h3>
		                        <h5 class="mt-1 ml-2" style="user-select:none;"><?php echo $question[$q_i]; ?>
		                        </h5><span style="float:right;margin-left:auto;"><b>Marks : <?php echo $question_marks[$q_i]; ?></b></span>
							</div>
						
							<div id="mcq_options">
								<div class="ans ml-2" style="padding: 10px;">
									<label class="radio"> <input type="radio" name="option[<?php echo $q_i; ?>]" value="<?php echo $option1[$q_i]; ?>"> <span><?php echo $option1[$q_i]; ?></span>
									</label>
								</div>
								<div class="ans ml-2" style="padding: 10px;">
									<label class="radio"> <input type="radio" name="option[<?php echo $q_i; ?>]" value="<?php echo $option2[$q_i]; ?>"> <span><?php echo $option2[$q_i]; ?></span>
									</label>
								</div>
								<div class="ans ml-2" style="padding: 10px;">
									<label class="radio"> <input type="radio" name="option[<?php echo $q_i; ?>]" value="<?php echo $option3[$q_i]; ?>"> <span><?php echo $option3[$q_i]; ?></span>
									</label>
								</div>
								<div class="ans ml-2" style="padding: 10px;">
									<label class="radio"> <input type="radio" name="option[<?php echo $q_i; ?>]" value="<?php echo $option4[$q_i]; ?>"> <span><?php echo $option4[$q_i]; ?></span>
									</label>
								</div>
							</div>
						</div>	
							<?php
								}
								else if($question_type[$q_i]=="oneword"){
							?>
							<div class="question bg-white p-3 border-bottom" style="height: 200px; margin-top:10px;width:125%;">
								<div class="d-flex flex-row align-items-center question-title"style="padding: 10px;	">
									<h3 class="">Q.</h3>
									<h5 class="mt-1 ml-2" style="user-select:none;"><?php echo $question[$q_i]; ?>
									</h5><span style="float:right;margin-left:auto;"><b>Marks : <?php echo $question_marks[$q_i]; ?></b></span>
								</div>
								<div id="oneword_type">
									<div style="margin-left:2.5%;" >
										<label for="validationCustom01" style="margin-left: 3px;">Your Answer :</label>
										<input style="width:60%;" autocomplete="off" type="text" class="form-control" name="option[<?php echo $q_i; ?>]" id="validationCustom01" placeholder="Enter Answer Here.." value="" required>              
									</div>
								</div>
							</div>
							<?php
								}
								else if($question_type[$q_i]=="numerical"){
							?>
							<div class="question bg-white p-3 border-bottom" style="height: 200px; margin-top:10px;width:125%;">
								<div class="d-flex flex-row align-items-center question-title"style="padding: 10px;	">
									<h3 class="">Q.</h3>
									<h5 class="mt-1 ml-2" style="user-select:none;"><?php echo $question[$q_i]; ?>
									</h5><span style="float:right;margin-left:auto;"><b>Marks : <?php echo $question_marks[$q_i]; ?></b></span>
								</div>
								<div id="numerical_type">
									<div style="margin-left:2.5%;" >
										<label  for="validationCustom01" style="margin-left: 3px;">Your Answer :</label>
										<input style="width:60%;" autocomplete="off" type="text" class="form-control" name="option[<?php echo $q_i; ?>]" id="validationCustom01" placeholder="Enter Answer Here.." value="" required>              
									</div>
								</div>
							</div>
							<?php
								}
								else if($question_type[$q_i]=="multiple_answer"){
							?>
							<div class="question bg-white p-3 border-bottom" style="height: 400px; margin-top:10px;width:125%;">
								<div class="d-flex flex-row align-items-center question-title"style="padding: 10px;	">
									<h3 class="">Q.</h3>
									<h5 class="mt-1 ml-2" style="user-select:none;"><?php echo $question[$q_i]; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<span style="color:#fa3939;">(*) Multiple Correct Answer Question</span>
									</h5><span style="float:right;margin-left:auto;"><b>Marks : <?php echo $question_marks[$q_i]; ?></b></span>
								</div>
								<div id="multiple_type">
									<div class="ans ml-2" style="padding: 10px;">
										<label class="radio"> <input type="checkbox" name="option<?php echo $q_i; ?>[]" value="a"> <span><?php echo $option1[$q_i]; ?></span>
										</label>
									</div>
									<div class="ans ml-2" style="padding: 10px;">
										<label class="radio"> <input type="checkbox" name="option<?php echo $q_i; ?>[]" value="b"> <span><?php echo $option2[$q_i]; ?></span>
										</label>
									</div>
									<div class="ans ml-2" style="padding: 10px;">
										<label class="radio"> <input type="checkbox" name="option<?php echo $q_i; ?>[]" value="c"> <span><?php echo $option3[$q_i]; ?></span>
										</label>
									</div>
									<div class="ans ml-2" style="padding: 10px;">
										<label class="radio"> <input type="checkbox" name="option<?php echo $q_i; ?>[]" value="d"> <span><?php echo $option4[$q_i]; ?></span>
										</label>
									</div>
								</div>
							</div>
							<?php
								}
								else if($question_type[$q_i]=="T_F"){
							?>
							<div class="question bg-white p-3 border-bottom" style="height: 250px; margin-top:10px;width:125%;">
								<div class="d-flex flex-row align-items-center question-title"style="padding: 10px;	">
									<h3 class="">Q.</h3>
									<h5 class="mt-1 ml-2" style="user-select:none;"><?php echo $question[$q_i]; ?>
									</h5><span style="float:right;margin-left:auto;"><b>Marks : <?php echo $question_marks[$q_i]; ?></b></span>
								</div>
								<div id="t_f_options">
									<div class="ans ml-2" style="padding: 10px;">
										<label class="radio"> <input type="radio" name="option[<?php echo $q_i; ?>]" value="True"> <span>TRUE</span>
										</label>
									</div>
									<div class="ans ml-2" style="padding: 10px;">
										<label class="radio"> <input type="radio" name="option[<?php echo $q_i; ?>]" value="False"> <span>FALSE</span>
										</label>
									</div>
								</div>
							</div>
							<?php
								}
								else if($question_type[$q_i]=="match_following"){
							?>
							<div class="question bg-white p-3 border-bottom" style="height: 400px; margin-top:10px;width:125%;">
								<div class="d-flex flex-row align-items-center question-title"style="padding: 10px;	">
									<h3 class="">Q.</h3>
									<h5 class="mt-1 ml-2" style="user-select:none;"><?php echo $question[$q_i]; ?>
									</h5><span style="float:right;margin-left:auto;"><b>Marks : <?php echo $question_marks[$q_i]; ?></b></span>
								</div>
								<?php
									$option1_a = explode(",",$option1[$q_i]);
									$option2_b = explode(",",$option2[$q_i]);
									$option3_c = explode(",",$option3[$q_i]);
									$option4_d = explode(",",$option4[$q_i]);
								?>
								<div id="match_following_options">
									<div class="ans ml-2" style="padding: 10px;">
										<label class="radio"><span style="background-color:#faf870;"><?php echo $option1_a[0]; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<select name="optiona[<?php echo $q_i; ?>]" style="background-color:#faf870;" class="btn btn-light dropdown-toggle btn-xs">
												<option value="none" selected disabled hidden>Select an Option</option> 
												<option value="1a"><?php echo $option1_a[1]; ?></option>
												<option value="1b"><?php echo $option2_b[1]; ?></option>
												<option value="1c"><?php echo $option3_c[1]; ?></option>
												<option value="1d"><?php echo $option4_d[1]; ?></option>
											</select>
										</label>
									</div>
									<div class="ans ml-2" style="padding: 10px;">
										<label class="radio"><span style="background-color:#ffcf4a;"><?php echo $option2_b[0]; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<select name="optionb[<?php echo $q_i; ?>]" style="background-color:#ffcf4a" class="btn btn-light dropdown-toggle btn-xs">
												<option value="none" selected disabled hidden>Select an Option</option>
												<option value="2a"><?php echo $option1_a[1]; ?></option>
												<option value="2b"><?php echo $option2_b[1]; ?></option>
												<option value="2c"><?php echo $option3_c[1]; ?></option>
												<option value="2d"><?php echo $option4_d[1]; ?></option>
											</select>
										</label>
									</div>
									<div class="ans ml-2" style="padding: 10px;">
										<label class="radio"><span style="background-color:#ff9d42;"><?php echo $option3_c[0]; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<select name="optionc[<?php echo $q_i; ?>]" style="background-color:#ff9d42;" class="btn btn-light dropdown-toggle btn-xs">
												<option value="none" selected disabled hidden>Select an Option</option>
												<option value="3a"><?php echo $option1_a[1]; ?></option>
												<option value="3b"><?php echo $option2_b[1]; ?></option>
												<option value="3c"><?php echo $option3_c[1]; ?></option>
												<option value="3d"><?php echo $option4_d[1]; ?></option>
											</select>
										</label>
									</div>
									<div class="ans ml-2" style="padding: 10px;">
										<label class="radio"><span style="background-color:#ff643d;"><?php echo $option4_d[0]; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<select name="optiond[<?php echo $q_i; ?>]" style="background-color:#ff643d;" class="btn btn-light dropdown-toggle btn-xs">
												<option value="none" selected disabled hidden>Select an Option</option>
												<option value="4a"><?php echo $option1_a[1]; ?></option>
												<option value="4b"><?php echo $option2_b[1]; ?></option>
												<option value="4c"><?php echo $option3_c[1]; ?></option>
												<option value="4d"><?php echo $option4_d[1]; ?></option>
											</select>
										</label>
									</div>
								</div>
							</div>
							<?php
								}
							?>
						<?php 	
						}
						?>
						<input type="hidden" id="hiddenfield" value="" name="counter">						
						<a style="margin-top:10px; float:right;width:25%;margin-right:25%;font-size:20px;" class="btn btn-outline-primary btn-xs" data-toggle="modal" data-target="#exampleModalCentere[1]">Submit Test</a>
						<div class="modal fade" id="exampleModalCentere[1]">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Submit Quiz</h5>
										<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
									</div>
									<div class="modal-body">
										<p>Are you Sure Want to Submit this Quiz  ? </p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
										<input type="submit" onClick="mySubmit();" value="Submit Test" name="save" class="btn btn-outline-danger">	
									</div>
								</div>
							</div>
						</div>
						<br><br><br><br><br>
						</form>
		            </div>
		        </div>
		    </div>
	    </div>
	</div>

	<script>
	function mySubmit(){
		document.getElementById('hiddenfield').value = counter;
		document.getElementById('myform_submit').submit(); 
	}
	</script>
	<script>
		document.body.addEventListener("keydown", function(event) {
			if(!(event.keyCode>=48 && event.keyCode<=57) && !(event.keyCode>=65 && event.keyCode<=90) && (event.keyCode!=8) && (event.keyCode!=32))
			{
				counter+=1;
				er1.innerHTML="You tried to change screen : "+counter+" Times";	
				er1.style.background="red";
				
			}
			else{
				er1.innerHTML="";
				er1.style.background="white";
			}
			setTimeout(function(){ 	
				er1.innerHTML=""
				er1.style.background="white";
			}, 7000);
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