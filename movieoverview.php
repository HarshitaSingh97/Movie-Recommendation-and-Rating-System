<?php
	//extract whatever the client sent.
	extract($_GET);
	$db_server = mysqli_connect('localhost', 'root', 'root','se_moviemania2');

	// Check connection
	if (!$db_server) {
		die("Connection failed: " . mysqli_connect_error());
	}


	mysqli_select_db($db_server, 'se_moviemania2')

	or die("Unable to select database: " . mysqli_error());
  $movie_id=-1;
  $query="select movie_id from movie where title='$movie';";
  $result = mysqli_query($db_server,$query);
  if (!$result) die ("Database access failed: " . mysqli_error($db_server));
  $rows = mysqli_num_rows($result);
  for ($k = 0 ; $k < $rows ; ++$k)

  {
    $row = mysqli_fetch_row($result);
    $movie_id=$row[0];
  }
  $overview="";
  $query="select overview from movie where movie_id='$movie_id';";
  $result = mysqli_query($db_server,$query);
  if (!$result) die ("Database access failed: " . mysqli_error($db_server));
  $rows = mysqli_num_rows($result);
  for ($k = 0 ; $k < $rows ; ++$k)

  {
    $row = mysqli_fetch_row($result);
    $overview=$row[0];
  }
  $genres="";
  $query="select g.genre_name from movie as m, genre as g, movie_genres as mg where m.movie_id='$movie_id' and mg.movie_id=m.movie_id and g.genre_id=mg.genre_id;";
  $result = mysqli_query($db_server,$query);
  if (!$result) die ("Database access failed: " . mysqli_error($db_server));
  $rows = mysqli_num_rows($result);
  for ($k = 0 ; $k < $rows ; ++$k)

  {
    $row = mysqli_fetch_row($result);
    $genres=$genres.$row[0];
    if($k!=$rows-1){
      $genres=$genres.",";
    }
  }

  $language="";
  $query="select language from movie where movie_id='$movie_id';";
  $result = mysqli_query($db_server,$query);
  if (!$result) die ("Database access failed: " . mysqli_error($db_server));
  $rows = mysqli_num_rows($result);
  for ($k = 0 ; $k < $rows ; ++$k)

  {
    $row = mysqli_fetch_row($result);
    if($row[0]=='en'){
      $row[0]="English";
    }
    else if($row[0]=='hi'){
      $row[0]="Hindi";
    }
    $language=$row[0];
  }
  $releasedate="";
  $query="select release_date from movie where movie_id='$movie_id';";
  $result = mysqli_query($db_server,$query);
  if (!$result) die ("Database access failed: " . mysqli_error($db_server));
  $rows = mysqli_num_rows($result);
  for ($k = 0 ; $k < $rows ; ++$k)

  {
    $row = mysqli_fetch_row($result);
    $releasedate=$row[0];
  }
  $moredetails="";
  $query="select homepage from movie where movie_id='$movie_id';";
  $result = mysqli_query($db_server,$query);
  if (!$result) die ("Database access failed: " . mysqli_error($db_server));
  $rows = mysqli_num_rows($result);
  for ($k = 0 ; $k < $rows ; ++$k)

  {
    $row = mysqli_fetch_row($result);
    if($row[0]==NULL){
      $row[0]="Not Available";
    }
    $moredetails=$row[0];
  }
  $url="";
  $query="select url from movie where movie_id='$movie_id';";
  $result = mysqli_query($db_server,$query);
  if (!$result) die ("Database access failed: " . mysqli_error($db_server));
  $rows = mysqli_num_rows($result);
  for ($k = 0 ; $k < $rows ; ++$k)

  {
    $row = mysqli_fetch_row($result);
    if($row[0]=="#"){
      $row[0]="Not Available";
    }
    $url=$row[0];
  }
  /*$img="";
  $query="select img from movie where movie_id='$movie_id';";
  $result = mysqli_query($db_server,$query);
  if (!$result) die ("Database access failed: " . mysqli_error($db_server));
  $rows = mysqli_num_rows($result);
  for ($k = 0 ; $k < $rows ; ++$k)

  {
    $row = mysqli_fetch_row($result);
    file_put_contents('../SE/img/'.$movie.".jpg", $row[0]);
    $img=$row[0];
  }*/
  echo $movie."splithere".$overview."splithere".$genres."splithere".$language."splithere".$releasedate."splithere".$moredetails."splithere".$url;
  mysqli_close($db_server);
?>
