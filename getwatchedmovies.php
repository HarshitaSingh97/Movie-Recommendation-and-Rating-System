<?php

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

/*$query="SELECT movie_id from user_watched where user_name='$username'";
$result = mysqli_query($db_server,$query);
if (!$result) die ("Database access failed: " . mysqli_error($db_server));
$rows = mysqli_num_rows($result);
$movie_id=array();
for ($k = 0 ; $k < $rows ; ++$k)

{
  $row = mysqli_fetch_row($result);
  $movie_id[]=$row[0];
}*/

	$ret="";
	$nameret="";
	$criticret="";
	$avguserret="";
	$urlret="";
$query1 = "select m.title from movie m,user_watched uw where m.movie_id=uw.movie_id and uw.user_name='$username'";
$query2 = "select m.average_vote from movie m, user_watched uw where m.movie_id=uw.movie_id and uw.user_name='$username'";
$query3 = "select m.url from movie m, user_watched uw where m.movie_id=uw.movie_id and uw.user_name='$username'";
$query4 = "select avg(uw.user_rating) from movie m LEFT JOIN user_watched uw on m.movie_id=uw.movie_id where uw.user_name='$username' group by m.movie_id;";
processquery($query1,$query2,$query3,$query4,$db_server);



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
