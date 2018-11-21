<?php
session_start();
// initializing variables
$username = "";
$email    = "";
$errors = array(); 
$_SESSION['username']="";

$db = mysqli_connect('localhost', 'root', 'root', 'se_moviemania2');
if(isset($_POST['username']))
{
	//echo("in if");
	$username=$_POST['username'];
	$password=md5($_POST['password']);

	$user_check_query = "SELECT * FROM user WHERE user_name='$username'";
	$result = mysqli_query($db, $user_check_query);
	$user = mysqli_fetch_assoc($result);
	if($user['password']==$password)
	{
		$_SESSION['username']=$username;
		header('location: suggest.html');
	}
	else if(!$user)
	{
		array_push($errors, "Not a member. Please register!");
		
	}
	else if($user['password']!=$password)
	{
		array_push($errors, "Wrong password");
		$_SESSION['errors']=$errors;
	
	}
}
?>  
