<?php
   include("config.php");
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form

      $name = mysqli_real_escape_string($db,$_POST['name']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']);

      $sql = "SELECT name FROM user_data WHERE name = '$name' and password = '$mypassword'";

      $result = mysqli_query($db,$sql);
      #echo "".$result;
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);


      $count = mysqli_num_rows($result);
      echo "".$count;
      // If result matched $myusername and $mypassword, table row must be 1 row

      if($count == 1) {
         #session_register("name");
         $_SESSION['login_user'] = $name;

         header("location: welcome.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
