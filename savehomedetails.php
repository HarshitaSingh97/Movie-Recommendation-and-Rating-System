<?php
	//extract whatever the client sent.
	session_start();
extract($_GET);
$username=$_SESSION['username'];
$db_server = mysqli_connect('localhost', 'root', 'root','se_moviemania2');

if (!$db_server) {
	die("Connection failed: " . mysqli_connect_error());
}
$username=$_SESSION['username'];
mysqli_select_db($db_server, 'se_moviemania2')
or die("Unable to select database: " . mysqli_error());
echo $first_name;
$query="update user set email_id='$email_id',first_name='$first_name',last_name='$last_name',phone_number='$phone_number',mobile='$mobile',location='$location' where user_name='$username';";
$result = mysqli_query($db_server,$query);

if (!$result) die ("Database access failed: " . mysqli_error($db_server));
mysqli_close($db_server);

echo "done";

?>
