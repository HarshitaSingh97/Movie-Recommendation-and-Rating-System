<?php
   include('config.php');
   session_start();

   $user_check = $_SESSION['login_user'];

   $ses_sql = mysqli_query($db,"select name,age,email,price from user_data where name = '$user_check' ");

   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

   $login_session['name'] = $row['name'];
   $login_session['age'] = $row['age'];
   $login_session['email'] = $row['email'];
   $login_session['price'] = $row['price'];
   /*if(!isset($_SESSION['login_user'])){
      header("location:login.php");
   }*/
?>
