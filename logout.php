<?php
	session_start();
	session_destroy();
	header('location:Login/index.html');
?>