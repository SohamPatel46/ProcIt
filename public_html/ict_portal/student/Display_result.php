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
	<script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
	
	<style type="text/css" >

		body {
		background-color: #eee
		}

		label.radio {
		cursor: pointer
		}

        .anss{
            float:right;
            color:green;
            margin-left:10px;   
        }

        .anssi{
            float:right;
            color:red;
            margin-left:10px;  
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

        label.radiocolor span {
		padding: 5px;
		border: 1px solid black;
		display: inline-block;
		color: black;
		width: auto;
		text-align: center;
		border-radius: 3px;
		margin-top: 7px;
        background-color:#6ae02f;		
		}

		label.radiored span {
		padding: 5px;
		border: 1px solid black;
		display: inline-block;
		color: black;
		width: auto;
		text-align: center;
		border-radius: 3px;
		margin-top: 7px;
        background-color:#f51616;		
		}
		
		label.radio input:checked+span {
		border-color: black;
		background-color: yellow;
		color:black;
		}

		.btn:focus {
		outline: 0 !important;
		box-shadow: none !important
		}

		.btn:active {
		outline: 0 !important;
		box-shadow: none !important
		}


        .ans {
		margin-left: 36px !important
		}
	</style>
</head>
<body>
	<?php
		$cid = $_SESSION['Course_Id'];
        $quiz_id = $_SESSION['Quiz_Id'];
        $sid = $_SESSION['ID'];

		$select_quiz_data = "SELECT * FROM `to_do_list_student` WHERE Course_Id='$cid' && Quiz_Id='$quiz_id'";
        $fetch_response = "SELECT * FROM `quiz_respose` WHERE ID='$sid' && Course_ID='$cid' && Quiz_ID='$quiz_id'";


		$select_quiz_data_check = mysqli_query($con,$select_quiz_data);
		while($rows = mysqli_fetch_array($select_quiz_data_check))
		{
			$quiz_name = $rows['Quiz_Name'];
			$topic = $rows['Topic'];
			$tot_ques = $rows['Total_Question'];
			$date = $rows['Quiz_Date'];
            $end_time = $rows['End_Time'];
			$reference_link = $rows['Reference_Link'];
			$marks = $rows['Marks'];
        }

        $fetch_response_check = mysqli_query($con,$fetch_response);
		while($data = mysqli_fetch_array($fetch_response_check))
		{
            $score = $data['Score'];
			$flag_string = $data['Flag_string'];
			$response_string = $data['Response_string'];
			$time = $data['Time_Taken'];
        }
        
		$flag_array = explode("~",$flag_string);
		$response_array = explode("~",$response_string);

		$select_quiz_questions = "SELECT * FROM `add_quiz_question` WHERE Course_Id='$cid' && Quiz_Id='$quiz_id'";
		$select_quiz_questions_check = mysqli_query($con,$select_quiz_questions);

		$question = [];
		$option1 = [];
		$option2 = [];
		$option3 = [];
		$option4 = [];
        $correct_option = [];
        $explaination = [];
		$question_type= [];
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
            $explaination[$row['Question_Number']]=$row['Explaination'];
			$question_type[$row['Question_Number']] = $row['question_type'];
		}
	?>

	<div>
		<div style="width: 100%; padding:20px;float: left">
			<div style="float:left;margin-left:0.8%"><h1><?php echo $quiz_name; ?></h1></div>
			<div style="margin-right:2%; float:right;"><h2> Score : <?php echo $score.'/'.$marks ?></h2>
		</div>

	</div>
	<?php 
		// Declare and define two dates 
		 		
	?>
	<div>
		<div class="container" style="float:left;width: 100%; margin-left:2%; height: 200px;">
		    <div class="row">
		        <div class="" style="width: 100%;">
		            <div class="border">
		                <div class="question bg-white p-3 border-bottom" style="width:125%;">
		                    <div class="d-flex flex-row justify-content-between align-items-center mcq">
		                        <h4><?php echo $topic; ?></h4><h4><span>Quiz Time : <?php echo $time; ?></span></h4><h4><a href="<?php echo $reference_link; ?>" target=_blank><span style="float:right;">Reference Link</span></a></h4>
		                    </div>
		                </div>
						
						<form action="../Exit_test.php?cid=<?php echo $cid?>" method="post">
						
						<?php
							for($q_i=1;$q_i<=$tot_ques;$q_i++) 
							{
								if($question_type[$q_i]=="mcqs"){
							?>					
						<div id="mcq_type">
							<div class="question bg-white p-3 border-bottom" style="height: 450px; margin-top:10px;width:125%;">
								<div class="d-flex flex-row align-items-center question-title"style="padding: 10px;	">
									<h3 class="">Q.</h3>
									<h5 class="mt-1 ml-2"><?php echo $question[$q_i]; ?><p class="anss<?php if($flag_array[$q_i-1]=="0"){echo "i";} ?>"> <?php if($flag_array[$q_i-1]=="0"){echo "<b>Incorrect</b>";}else{echo "<b>Correct</b>";} ?> </p>
									</h5>
								</div>
								<div class="ans ml-2" style="padding: 10px;">
									<label class="radio<?php if(($option1[$q_i]==$correct_option[$q_i])) {echo 'color';} else if($option1[$q_i]==$response_array[$q_i-1]){ echo 'red'; } ?>"> <span><?php echo $option1[$q_i];?></span>
									</label>
								</div>
								<div class="ans ml-2" style="padding: 10px;">
									<label class="radio<?php if(($option2[$q_i]==$correct_option[$q_i])) {echo 'color';} else if($option2[$q_i]==$response_array[$q_i-1]){ echo 'red'; } ?>"> <span><?php echo $option2[$q_i]; ?></span>
									</label>
								</div>
								<div class="ans ml-2" style="padding: 10px;">
									<label class="radio<?php if(($option3[$q_i]==$correct_option[$q_i])) {echo 'color';} else if($option3[$q_i]==$response_array[$q_i-1]){ echo 'red'; } ?>"> <span><?php echo $option3[$q_i]; ?></span>
									</label>
								</div>
								<div class="ans ml-2" style="padding: 10px;">
									<label class="radio<?php if(($option4[$q_i]==$correct_option[$q_i])) {echo 'color';} else if($option4[$q_i]==$response_array[$q_i-1]){ echo 'red'; } ?>"> <span><?php echo $option4[$q_i]; ?></span>
									</label>
								</div>
								<div> <h6 style="margin-left:1%;float:left; padding:10px;">Explaination -> <?php echo $explaination[$q_i] ?> </h6>
								</div>
							</div>
						</div>
						<?php
							}
							else if($question_type[$q_i]=="oneword"){
						?>
						<div id="one_word_type">
							<div class="question bg-white p-3 border-bottom" style="height: 340px; margin-top:10px;width:125%;">
								<div class="d-flex flex-row align-items-center question-title"style="padding: 10px;	">
									<h3 class="">Q.</h3>
									<h5 class="mt-1 ml-2"><?php echo $question[$q_i]; ?><p class="anss<?php if($flag_array[$q_i-1]=="0"){echo "i";} ?>"> <?php if($flag_array[$q_i-1]=="0"){echo "<b>Incorrect</b>";}else{echo "<b>Correct</b>";} ?> </p>
									</h5>
								</div>
								<div class="col-md-6 mb-3" >
									<label style="float:left;" for="validationCustom01" style="margin-left: 3px;">Correct Answer :</label>
									<input style="float:right;" type="text" class="form-control" name="" id="validationCustom01" placeholder="Enter Answer Here.." value="<?php echo $correct_option[$q_i]; ?>" disabled required>              
								</div>
								<br><br><br>
								<div class="col-md-6 mb-3" >
									<label style="float:left;" for="validationCustom01" style="margin-left: 3px;">Your Answer :</label>
									<input style="float:right;" type="text" class="form-control" name="" id="validationCustom01" placeholder="Enter Answer Here.." value="<?php echo $response_array[$q_i-1]; ?>" disabled required>              
								</div>
								<br><br><br>
								<div> <h6 style="margin-left:1%;float:left; padding:10px;">Explaination -> <?php echo $explaination[$q_i] ?> </h6>
								</div>
							</div>
						</div>
						<?php		
							}
							else if($question_type[$q_i]=="numerical"){
						?>	
						<div id="numerical_type">
							<div class="question bg-white p-3 border-bottom" style="height: 340px; margin-top:10px;width:125%;">
								<div class="d-flex flex-row align-items-center question-title"style="padding: 10px;	">
									<h3 class="">Q.</h3>
									<h5 class="mt-1 ml-2"><?php echo $question[$q_i]; ?><p class="anss<?php if($flag_array[$q_i-1]=="0"){echo "i";} ?>"> <?php if($flag_array[$q_i-1]=="0"){echo "<b>Incorrect</b>";}else{echo "<b>Correct</b>";} ?> </p>
									</h5>
								</div>
								<div class="col-md-6 mb-3" >
									<label style="float:left;" for="validationCustom01" style="margin-left: 3px;">Correct Answer :</label>
									<input style="float:right;" type="text" class="form-control" name="" id="validationCustom01" placeholder="Enter Answer Here.." value="<?php echo $correct_option[$q_i]; ?>" disabled required>              
								</div>
								<br><br><br>
								<div class="col-md-6 mb-3" >
									<label style="float:left;" for="validationCustom01" style="margin-left: 3px;">Your Answer :</label>
									<input style="float:right;" type="text" class="form-control" name="" id="validationCustom01" placeholder="Enter Answer Here.." value="<?php echo $response_array[$q_i-1]; ?>" disabled required>              
								</div>
								<div> <h6 style="margin-left:1%;float:left; padding:10px;">Explaination -> <?php echo $explaination[$q_i] ?> </h6>
								</div>
							</div>
						</div>
						<?php
							}
							else if($question_type[$q_i]=="multiple_answer"){
						?>
						<div id="multiple_answer_type">
							<?php
								$correct_options_multiple_answer_array = explode(",",$correct_option[$q_i]);	
								$count_answer_correct = count($correct_options_multiple_answer_array);
								$correct_answers_array = [];

								$response_array_multiple_answers_array = explode(",",$response_array[$q_i-1]);
								$count_response_answers = count($response_array_multiple_answers_array);
								$response_answers_array = [];
								for($i=0;$i<4;$i++)
								{
									$correct_answers_array[$i]='*';
									$response_answers_array[$i]='*';
								}
								for($i=0;$i<$count_answer_correct;$i++)
								{
									if($correct_options_multiple_answer_array[$i]=='a')
									{
										$correct_answers_array[0]=$option1[$q_i];
									}
									else if($correct_options_multiple_answer_array[$i]=='b')
									{
										$correct_answers_array[1]=$option2[$q_i];
									}
									else if($correct_options_multiple_answer_array[$i]=='c')
									{
										$correct_answers_array[2]=$option3[$q_i];
									}
									else if($correct_options_multiple_answer_array[$i]=='d')
									{
										$correct_answers_array[3]=$option4[$q_i];
									}
								}
								for($i=0;$i<$count_response_answers;$i++)
								{
									if($response_array_multiple_answers_array[$i]=='a')
									{
										$response_answers_array[0]=$option1[$q_i];
									}
									else if($response_array_multiple_answers_array[$i]=='b')
									{
										$response_answers_array[1]=$option2[$q_i];
									}
									else if($response_array_multiple_answers_array[$i]=='c')
									{
										$response_answers_array[2]=$option3[$q_i];
									}
									else if($response_array_multiple_answers_array[$i]=='d')
									{
										$response_answers_array[3]=$option4[$q_i];
									}
								}
							?>
							<div class="question bg-white p-3 border-bottom" style="height: 450px; margin-top:10px;width:125%;">
								<div class="d-flex flex-row align-items-center question-title"style="padding: 10px;	">
									<h3 class="">Q.</h3>
									<h5 class="mt-1 ml-2"><?php echo $question[$q_i]; ?><p class="anss<?php if($flag_array[$q_i-1]=="0"){echo "i";} ?>"> <?php if($flag_array[$q_i-1]=="0"){echo "<b>Incorrect</b>";}else{echo "<b>Correct</b>";} ?> </p>
									</h5>
								</div>
								<div class="ans ml-2" style="padding: 10px;">
									<label class="radio<?php if(($option1[$q_i]==$correct_answers_array[0])) {echo 'color';} else if($option1[$q_i]==$response_answers_array[0]){ echo 'red'; } ?>"> <span><?php echo $option1[$q_i];?></span>
									</label>
								</div>
								<div class="ans ml-2" style="padding: 10px;">
									<label class="radio<?php if(($option2[$q_i]==$correct_answers_array[1])) {echo 'color';} else if($option2[$q_i]==$response_answers_array[1]){ echo 'red'; } ?>"> <span><?php echo $option2[$q_i]; ?></span>
									</label>
								</div>
								<div class="ans ml-2" style="padding: 10px;">
									<label class="radio<?php if(($option3[$q_i]==$correct_answers_array[2])) {echo 'color';} else if($option3[$q_i]==$response_answers_array[2]){ echo 'red'; } ?>"> <span><?php echo $option3[$q_i]; ?></span>
									</label>
								</div>
								<div class="ans ml-2" style="padding: 10px;">
									<label class="radio<?php if(($option4[$q_i]==$correct_answers_array[3])) {echo 'color';} else if($option4[$q_i]==$response_answers_array[3]){ echo 'red'; } ?>"> <span><?php echo $option4[$q_i]; ?></span>
									</label>
								</div>
								<div> <h6 style="margin-left:1%;float:left; padding:10px;">Explaination -> <?php echo $explaination[$q_i] ?> </h6>
								</div>
							</div>
						</div>
						<?php
							}
							else if($question_type[$q_i]=="T_F"){
						?>
						<div id="true_false_type">
							<div class="question bg-white p-3 border-bottom" style="height: 320px; margin-top:10px;width:125%;">
								<div class="d-flex flex-row align-items-center question-title"style="padding: 10px;	">
									<h3 class="">Q.</h3>
									<h5 class="mt-1 ml-2"><?php echo $question[$q_i]; ?><p class="anss<?php if($flag_array[$q_i-1]=="0"){echo "i";} ?>"> <?php if($flag_array[$q_i-1]=="0"){echo "<b>Incorrect</b>";}else{echo "<b>Correct</b>";} ?> </p>
									</h5>
								</div>
								<div class="ans ml-2" style="padding: 10px;">
									<label class="radio<?php if(($correct_option[$q_i]=="True")) {echo 'color';} else if($response_array[$q_i-1]=="True"){ echo 'red'; } ?>"> <span>TRUE</span>
									</label>
								</div>
								<div class="ans ml-2" style="padding: 10px;">
									<label class="radio<?php if(($correct_option[$q_i]=="False")) {echo 'color';} else if($response_array[$q_i-1]=="False"){ echo 'red'; } ?>"> <span>FALSE</span>
									</label>
								</div>
								<div> <h6 style="margin-left:1%;float:left; padding:10px;">Explaination -> <?php echo $explaination[$q_i] ?> </h6>
								</div>
							</div>
						</div>
						<?php
							}
							else if($question_type[$q_i]=="match_following"){
						?>
						<div id="match_follow_type">
							<div class="question bg-white p-3 border-bottom" style="height: 450px; margin-top:10px;width:125%;">
								<div class="d-flex flex-row align-items-center question-title"style="padding: 10px;	">
									<h3 class="">Q.</h3>
									<h5 class="mt-1 ml-2"><?php echo $question[$q_i]; ?><p class="anss<?php if($flag_array[$q_i-1]=="0"){echo "i";} ?>"> <?php if($flag_array[$q_i-1]=="0"){echo "<b>Incorrect</b>";}else{echo "<b>Correct</b>";} ?> </p>
									</h5>
								</div>
								<div class="col-md-6 mb-3" >
									<label style="margin-bottom:-10px;" for="validationCustom01" style="margin-left: 3px;">Correct Match :</label>
								</div>
								<?php
									$option1_a = explode(",",$option1[$q_i]);
									$option2_b = explode(",",$option2[$q_i]);
									$option3_c = explode(",",$option3[$q_i]);
									$option4_d = explode(",",$option4[$q_i]);

									$correct_response = $correct_option[$q_i];
									$correct_response_array = explode(",",$correct_response);

									$correct_1_a = "";
									$correct_2_b = "";
									$correct_3_c = "";
									$correct_4_d = "";

									if($correct_response_array[0]=="1a"){
										$correct_1_a = $option1_a[1];
									}
									else if($correct_response_array[0]=="1b"){
										$correct_1_a = $option2_b[1];
									}
									else if($correct_response_array[0]=="1c"){
										$correct_1_a = $option3_c[1];
									}
									else if($correct_response_array[0]=="1d"){
										$correct_1_a = $option4_d[1];
									}


									if($correct_response_array[1]=="2a"){
										$correct_2_b = $option1_a[1];
									}
									else if($correct_response_array[1]=="2b"){
										$correct_2_b = $option2_b[1];
									}
									else if($correct_response_array[1]=="2c"){
										$correct_2_b = $option3_c[1];
									}
									else if($correct_response_array[1]=="2d"){
										$correct_2_b = $option4_d[1];
									}


									if($correct_response_array[2]=="3a"){
										$correct_3_c = $option1_a[1];
									}
									else if($correct_response_array[2]=="3b"){
										$correct_3_c = $option2_b[1];
									}
									else if($correct_response_array[2]=="3c"){
										$correct_3_c = $option3_c[1];
									}
									else if($correct_response_array[2]=="3d"){
										$correct_3_c = $option4_d[1];
									}


									if($correct_response_array[3]=="4a"){
										$correct_4_d = $option1_a[1];
									}
									else if($correct_response_array[3]=="4b"){
										$correct_4_d = $option2_b[1];
									}
									else if($correct_response_array[3]=="4c"){
										$correct_4_d = $option3_c[1];
									}
									else if($correct_response_array[3]=="4d"){
										$correct_4_d = $option4_d[1];
									}

								?>
								<div class="ans ml-2" style="padding: 10px;margin-top:-10px;">
									<label class="radio"><span style="background-color:#faf870;"><?php echo $option1_a[0]; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="background-color:#faf870;"><?php echo $correct_1_a; ?></span>
									</label>
								</div>
								<div class="ans ml-2" style="padding: 10px;margin-top:-10px;">
									<label class="radio"><span style="background-color:#ffcf4a;"><?php echo $option2_b[0]; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="background-color:#ffcf4a;"><?php echo $correct_2_b; ?></span>
									</label>
								</div>
								<div class="ans ml-2" style="padding: 10px;margin-top:-10px;">
									<label class="radio"><span style="background-color:#ff9d42;"><?php echo $option3_c[0]; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="background-color:#ff9d42;"><?php echo $correct_3_c; ?></span>
									</label>
								</div>
								<div class="ans ml-2" style="padding: 10px;margin-top:-10px;">
									<label class="radio"><span style="background-color:#ff643d;"><?php echo $option4_d[0]; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="background-color:#ff643d;"><?php echo $correct_4_d; ?></span>
									</label>
								</div>
								<div> <h6 style="margin-left:1%;float:left; padding:10px;">Explaination -> <?php echo $explaination[$q_i] ?> </h6>
								</div>
							</div>
						</div>
						<?php
							}
						?>						
					<?php 	
					}
					?>						
						<button class="btn btn-outline-success" type="submit" name="exit" style="margin-top:10px; float:right;width:25%;margin-right:25%;font-size:20px;">Exit Test</button>
						<br><br><br><br><br>
						</form>
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








