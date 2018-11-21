<?php
	//extract whatever the client sent.
  session_start();
  extract($_GET);
  $username=$_SESSION['username'];

	$db_server = mysqli_connect('localhost', 'root', 'root','se_moviemania2');
  $username=$_SESSION['username'];
	// Check connection
	if (!$db_server) {
		die("Connection failed: " . mysqli_connect_error());
	}


	mysqli_select_db($db_server, 'se_moviemania2')

	or die("Unable to select database: " . mysqli_error());
	$search=$movie."%";


	$ret="";
	$nameret="";
	$criticret="";
	$avguserret="";
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
	$i=0;
	$j=0;
	if(count($genres)==1 and count($languages)==1){
		$query1 = "select m.title from movie m,movie_genres mg,user_genres ug where m.title like '$search' and ug.genre_id=mg.genre_id and ug.user_name='$username' order by m.average_vote;";
		$query2 = "select m.average_vote from movie m,movie_genres mg,user_genres ug where m.title like '$search' and ug.genre_id=mg.genre_id and ug.user_name='$username' order by m.average_vote;";
		$query3 = "select m.url from movie m,movie_genres mg,user_genres ug where m.title like '$search' and ug.genre_id=mg.genre_id and ug.user_name='$username' order by m.average_vote;";
		$query4 = "select avg(uw.user_rating) from movie m LEFT JOIN user_watched uw on m.movie_id=uw.movie_id where m.title like '$search' and ug.genre_id=mg.genre_id and ug.user_name='$username' order by m.average_vote group by m.movie_id;";
		processquery($query1,$query2,$query3,$query4,$db_server);
	}
	else if(count($genres)==1){
		for($i=0; $i < count($languages)-1;$i++)
		{
			$query1 = "select title from movie where title like '$search' and language='$languages[$i]';";
			$query2 = "select average_vote from movie where title like '$search' and language='$languages[$i]';";
			$query3 = "select url from movie where title like '$search' and language='$languages[$i]';";
			$query4 = "select avg(uw.user_rating) from movie m LEFT JOIN user_watched uw on m.movie_id=uw.movie_id where m.title like '$search' and language='$languages[$i]' group by m.movie_id;";
			processquery($query1,$query2,$query3,$query4,$db_server);
		}
	}
	else if(count($languages)==1){
		for($i=0; $i < count($genres)-1;$i++)
		{
			$query1 = "select m.title from movie m,genre g,movie_genres mg where m.title like '$search' and g.genre_id=mg.genre_id and m.movie_id=mg.movie_id and g.genre_name='$genres[$i]';";
			$query2 = "select m.average_vote from movie m,genre g,movie_genres mg where m.title like '$search' and g.genre_id=mg.genre_id and m.movie_id=mg.movie_id and g.genre_name='$genres[$i]';";
			$query3 = "select m.url from movie m,genre g,movie_genres mg where m.title like '$search' and g.genre_id=mg.genre_id and m.movie_id=mg.movie_id and g.genre_name='$genres[$i]';";
			$query4 = "select avg(uw.user_rating) from movie m LEFT JOIN user_watched uw on m.movie_id=uw.movie_id where m.title like '$search' and m.movie_id in (select mg.movie_id from genre g, movie_genres mg where g.genre_id=mg.genre_id and g.genre_name='$genres[$i]') group by m.movie_id;";
			processquery($query1,$query2,$query3,$query4,$db_server);
		}
	}
	else{
		for($i=0; $i < count($genres)-1;$i++)
		{
			for($j=0;$j < count($languages)-1;$j++)
			{

				$query1 = "select m.title from movie m,genre g,movie_genres mg where m.title like '$search' and language='$languages[$j]' and g.genre_id=mg.genre_id and m.movie_id=mg.movie_id and g.genre_name='$genres[$i]';";
				$query2 = "select m.average_vote from movie m,genre g,movie_genres mg where m.title like '$search' and language='$languages[$j]' and g.genre_id=mg.genre_id and m.movie_id=mg.movie_id and g.genre_name='$genres[$i]';";
				$query3 = "select m.url from movie m,genre g,movie_genres mg where m.title like '$search' and language='$languages[$j]' and g.genre_id=mg.genre_id and m.movie_id=mg.movie_id and g.genre_name='$genres[$i]';";
				$query4 = "select avg(uw.user_rating) from movie m LEFT JOIN user_watched uw on m.movie_id=uw.movie_id where m.title like '$search' and language='$languages[$i]' and m.movie_id in (select mg.movie_id from genre g, movie_genres mg where g.genre_id=mg.genre_id and g.genre_name='$genres[$i]') and  group by m.movie_id;";
				processquery($query1,$query2,$query3,$query4,$db_server);
			}
		}
	}

	function processquery($query1,$query2,$query3,$query4,$db_server){
		$imgarray=array();
		$result = mysqli_query($db_server,$query1);
		if (!$result) die ("Database access failed: " . mysqli_error($db_server));

		$rows = mysqli_num_rows($result);
		if($rows>20){
			$rows=20;
		}
		for ($k = 0 ; $k < $rows ; ++$k)

		{
			$row = mysqli_fetch_row($result);
			//echo $row[0];
			//echo ;
			//$imagearray[]=$row[0];
			$GLOBALS['nameret']=$GLOBALS['nameret'].$row[0]."moviemaniamovies";

		}
		$result = mysqli_query($db_server,$query2);
		if (!$result) die ("Database access failed: " . mysqli_error($db_server));
		$rows = mysqli_num_rows($result);
		if($rows>20){
			$rows=20;
		}
		for ($k = 0 ; $k < $rows ; ++$k)

		{
			$row = mysqli_fetch_row($result);
			//file_put_contents('../SE/img/'.$imagearray[$k].".jpg", $row[0]);
			$GLOBALS['criticret']=$GLOBALS['criticret'].$row[0]."moviemaniacritic";
		}

		$result = mysqli_query($db_server,$query3);
		if (!$result) die ("Database access failed: " . mysqli_error($db_server));
		$rows = mysqli_num_rows($result);
		if($rows>20){
			$rows=20;
		}
		for ($k = 0 ; $k < $rows ; ++$k)

		{
			$row = mysqli_fetch_row($result);
			$GLOBALS['urlret']=$GLOBALS['urlret'].$row[0]."moviemaniaurls";
		}
		$result = mysqli_query($db_server,$query4);
		if (!$result) die ("Database access failed: " . mysqli_error($db_server));
		$rows = mysqli_num_rows($result);
		if($rows>20){
			$rows=20;
		}
		for ($k = 0 ; $k < $rows ; ++$k)

		{
			$row = mysqli_fetch_row($result);

			$GLOBALS['avguserret']=$GLOBALS['avguserret'].$row[0]."moviemaniaavguser";
		}
		$GLOBALS['avguserret']=$GLOBALS['avguserret'].$rows."moviemaniaavguser";
		if($rows==0)
		{
			$GLOBALS['avguserret']=$GLOBALS['avguserret']."Not Enough Ratingsmoviemaniaavguser";
		}


	}
	//$GLOBALS['ret']=$GLOBALS['ret'].$GLOBALS['nameret']."moviemaniaseparator".$GLOBALS['imgret']."moviemaniaseparator".$GLOBALS['urlret'];//."moviemaniasetseparator";
	$GLOBALS['ret']=$GLOBALS['ret'].$GLOBALS['nameret']."moviemaniaseparator".$GLOBALS['criticret']."moviemaniaseparator".$GLOBALS['avguserret']."moviemaniaseparator".$GLOBALS['urlret'];//."moviemaniasetseparator";
	echo $GLOBALS['ret'];
	mysqli_close($db_server);
?>
