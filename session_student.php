<?php
   include('Connection_Procit_DB.php');
   session_start();
      
   if(!isset($_SESSION['login_user_student'])){
      header("location:../Login/index.html");
      die();
   }
?>