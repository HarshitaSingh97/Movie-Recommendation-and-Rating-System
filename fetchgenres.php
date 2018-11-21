<?php
session_start();

$username=$_SESSION['username'];
	//extract whatever the client sent.
	$db_server = mysqli_connect('localhost', 'root', 'root','se_moviemania2');
  //$username=$_POST['username'];
  //$encodedData = str_replace(' ','+',$usericon);
  /*$imgData = substr($usericon, 1+strrpos($usericon, ','));*/


  //echo $imgData;
// write the decoded file
//file_put_contents('../SE/img/newicon.jpg', base64_decode($imgData));
  //echo $username;
  //$usericon=base64_decode($usericon);
  //$encodedData= chunk_split(base64_encode(file_get_contents($usericon)));
  //$blob = $encodedData;
  // Check connection
  //$imgData=base64_decode('$imgData');
  //echo $decoded;
	if (!$db_server) {
		die("Connection failed: " . mysqli_connect_error());
	}

  $username=$_SESSION['username'];
	mysqli_select_db($db_server, 'se_moviemania2')

	or die("Unable to select database: " . mysqli_error());

  $query = "select genre.genre_name from user_genres,genre  WHERE user_name='$username' and user_genres.genre_id=genre.genre_id";
  $result = mysqli_query($db_server,$query);

  if (!$result) die ("Database access failed: " . mysqli_error($db_server));
  $rows = mysqli_num_rows($result);
  $genres="";
  for ($k = 0 ; $k < $rows ; ++$k)

  {
    $row = mysqli_fetch_row($result);
    $genres=$genres.$row[0].",";
  }
  $query = "select user_language.language from user_language  WHERE user_name='$username';";
  $result = mysqli_query($db_server,$query);

  if (!$result) die ("Database access failed: " . mysqli_error($db_server));
  $rows = mysqli_num_rows($result);
  $languages="";
  for ($k = 0 ; $k < $rows ; ++$k)

  {
    $row = mysqli_fetch_row($result);
    if($row[0]=='en'){
      $row[0]="English";
    }
    else if($row[0]=='hi'){
      $row[0]="Hindi";
    }
    $languages=$languages.$row[0].",";
  }

	$json_array=array();
	$query = "select extract(month from user_date) as mon, sum(user_amount) as amt from user_watched  WHERE user_name='$username' and extract(year from user_date)=extract(year from now()) group by extract(month from user_date);";
	$result = mysqli_query($db_server,$query);

	if (!$result) die ("Database access failed: " . mysqli_error($db_server));
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$monthName = date('F', mktime(0, 0, 0, $row['mon'], 10));
		$row_array['label']=$monthName;
		$row_array['y'] =(float)$row['amt'];
    array_push($json_array,$row_array);

	}


		$json_array2=array();
		$query = "select g.genre_name as gen,count(uw.movie_id) as cnt from user_watched uw, movie_genres mg, genre g  WHERE uw.user_name='$username' and uw.movie_id=mg.movie_id and mg.genre_id=g.genre_id group by mg.genre_id;";
		$result = mysqli_query($db_server,$query);

		if (!$result) die ("Database access failed: " . mysqli_error($db_server));
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			//$monthName = date('F', mktime(0, 0, 0, $row['mon'], 10));
			$row_array['label']=$row['gen'];
			$row_array['y'] =(float)$row['cnt'];
	    array_push($json_array2,$row_array);

		}
	/*$rows = mysqli_num_rows($result);
	$languages="";
	for ($k = 0 ; $k < $rows ; ++$k)

	{
		$row = mysqli_fetch_row($result);

		$languages=$languages.$row[0].",";
	}
*/
    mysqli_close($db_server);
  echo $genres."lang".$languages."analyze".json_encode($json_array)."analyze".json_encode($json_array2);


?>
