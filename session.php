<?php
   include('config.php');
   session_start();

   $user_check = $_SESSION['username'];

   $ses_sql = mysqli_query($db,"select user_name,email_id,date_of_birth,gender from user where user_name = '$user_check' ");

   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

   $login_session['name'] = $row['user_name'];
   $login_session['dob'] = $row['date_of_birth'];
   $login_session['email'] = $row['email_id'];
   if($row['gender']==0){
	   $login_session['gender']="Female";
   }
   else if($row['gender']==1){
	   $login_session['gender']="Male";
   }
   else{
	   $login_session['gender']="Other";
   }
   //header("location:welcome.php/".$_SESSION['login_user']);
   //$login_session['gender'] = $row['gender'];
   /*if(!isset($_SESSION['login_user'])){
      header("location:login.php");
   }*/
?>
