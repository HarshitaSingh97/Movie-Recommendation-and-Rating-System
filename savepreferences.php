<?php
	//extract whatever the client sent.
	$db_server = mysqli_connect('localhost', 'root', 'root','se_moviemania2');
  extract($_GET);
	if (!$db_server) {
		die("Connection failed: " . mysqli_connect_error());
	}

  $username="Harshita97";
	mysqli_select_db($db_server, 'se_moviemania2')

	or die("Unable to select database: " . mysqli_error());
  $ret="";
  $nameret="";
  $imgret="";
  $urlret="";
  if($genres!="")
  {
    $genres=explode(",",$genres);
  }
  else{
    $genres=array(1);
  }
  if($languages!="")
  {
    $languages=explode(",",$languages);
  }
  else{
    $languages=array(1);
  }
  $query="delete from user_genres where user_name='$username';";
  $result = mysqli_query($db_server,$query);

  if (!$result) die ("Database access failed: " . mysqli_error($db_server));
  $genre_id=array();
  for($i=0;$i<count($genres)-1;$i++){
    $query="select genre_id from genre where genre_name='$genres[$i]';";
    $result = mysqli_query($db_server,$query);

    if (!$result) die ("Database access failed: " . mysqli_error($db_server));
    $rows = mysqli_num_rows($result);
    for($k=0;$k<$rows;$k++){
      $row = mysqli_fetch_row($result);
      $genre_id[]=$row[0];
    }
  }
  for($i=0;$i<count($genres)-1;$i++){
    $query = "insert into user_genres values('$username','$genre_id[$i]');";
    $result = mysqli_query($db_server,$query);
    //echo $query;
    if (!$result) die ("Database access failed: " . mysqli_error($db_server));
    $rows = mysqli_num_rows($result);
  }
  $query="delete from user_language where user_name='$username';";
  $result = mysqli_query($db_server,$query);

  if (!$result) die ("Database access failed: " . mysqli_error($db_server));
  for($i=0;$i<count($languages)-1;$i++){
    $query = "insert into user_language values('$username','$languages[$i]');";
    $result = mysqli_query($db_server,$query);
    //echo $query;
    if (!$result) die ("Database access failed: " . mysqli_error($db_server));
    $rows = mysqli_num_rows($result);
  }

mysqli_close($db_server);

echo "done";

?>
