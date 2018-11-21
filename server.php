<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array();

// connect to the database
$db = mysqli_connect('localhost', 'root', 'root', 'se_moviemania2');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $Firstname = mysqli_real_escape_string($db, $_POST['first_name']);
  $Lastname = mysqli_real_escape_string($db, $_POST['last_name']);
  $Phone_number= mysqli_real_escape_string($db, $_POST['phone_number']);
  $dob= mysqli_real_escape_string($db, $_POST['dob']);
  
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM user WHERE user_name='$username' OR email_id='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
 // echo 'lalala';
  //echo($user['user_name']);
  //echo($user['email_id']);
  //array_push($errors,$user['user_name']);
  //array_push($errors,$user['email_id']);
  if ($user) { // if user exists
    if ($user['user_name'] == $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email_id'] == $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO user (user_name, email_id, first_name,last_name, password,date_of_birth,phone_number)
  			  VALUES('$username', '$email','$Firstname','$Lastname', '$password','$dob','$Phone_number')";
  	mysqli_query($db, $query);
    /*for
    $query = "INSERT INTO user (user_name, email_id, first_name,last_name, password,date_of_birth,phone_number)
          VALUES('$username', '$email','$Firstname','$Lastname', '$password','$dob','$phone_number')";
    mysqli_query($db, $query);*/
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: suggest.html');
  }
}
