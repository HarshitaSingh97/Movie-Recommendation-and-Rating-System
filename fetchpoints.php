<?php

$db_server = mysqli_connect('localhost', 'root', 'root','se_moviemania2');

if (!$db_server) {
  die("Connection failed: " . mysqli_connect_error());
}

//$username=$_SESSION['username'];
mysqli_select_db($db_server, 'se_moviemania2')

or die("Unable to select database: " . mysqli_error());
$query = "SELECT count(*) FROM movie";
$result = mysqli_query($db_server,$query);
if (!$result) die ("Database access failed: " . mysqli_error($db_server));
$count=0;
$rows = mysqli_num_rows($result);

for ($k = 0 ; $k < $rows ; ++$k)

{
  $row = mysqli_fetch_row($result);
  //echo $row[0];
  //echo ;
  //$imagearray[]=$row[0];
  $count=$row[0];

}
$i=0;
$lim=500;
$points="";
$counts=0;
for($i=0;$i<$count;$i=$i+$lim){
  $query = "SELECT movie.movie_id,movie_genres.genre_id,movie.average_vote FROM movie_genres INNER JOIN movie on movie.movie_id=movie_genres.movie_id LIMIT $i,$lim";
  $result = mysqli_query($db_server,$query);
  if (!$result) die ("Database access failed: " . mysqli_error($db_server));

  while ($row = mysqli_fetch_assoc($result)) {
      $GLOBALS['points']=$GLOBALS['points'].$row["genre_id"].",".$row["average_vote"].",".$row["movie_id"].";";
      /*if($count>=5){
        break;
      }*/
      $GLOBALS['counts']=$GLOBALS['counts']+1;
  }
}
mysqli_close($db_server);
//echo $GLOBALS['counts'] ."jmyhtbgrfveethyjkijuyhtgrtynjmuk,ikmjnhb";
echo $GLOBALS['points'];


?>
