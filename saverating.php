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


//get movie id
$query="select movie_id from movie where title='$name';";
  $result = mysqli_query($db_server,$query);
  if (!$result) die ("Database access failed: " . mysqli_error($db_server));
  $rows = mysqli_num_rows($result);
  for ($k = 0 ; $k < $rows ; ++$k)

  {
    $row = mysqli_fetch_row($result);
    $movie_id=$row[0];
  }

//ends here

$query="insert into user_watched(user_name,movie_id,user_rating) values ('$username',$movie_id,$rating);";
$result = mysqli_query($db_server,$query);

if (!$result) die ("Database access failed: " . mysqli_error($db_server));
mysqli_close($db_server);



?>
