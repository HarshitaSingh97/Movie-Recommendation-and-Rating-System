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
$query="SELECT cluster_id from clusters_5 where movie_id in (SELECT movie_id from user_watched where user_name='$username') ";
$result = mysqli_query($db_server,$query);
if (!$result) die ("Database access failed: " . mysqli_error($db_server));
$rows = mysqli_num_rows($result);
$cluster=array();
for ($k = 0 ; $k < $rows ; ++$k)

{
  //echo "45";
  $row = mysqli_fetch_row($result);
  $cluster[]=$row[0];
  //echo $row[0];
}
//echo "50";
/*
$m=-1;
$c=[0,0,0,0,0];
$i=0;
$clus=-1;
for($i=0;$i<count($cluster);$i++)
{
  $c[$cluster-1]=$c[$cluster-1]+1;
}
for($i=0;$i<5;$i++)
{
  if($m<$c[i])
  {
    $m=$c[i];
    $clus=i+1;
  }
}*/
$m=array_count_values($cluster);
$str="";
$max=-1;
$maxc=-1;
foreach($m as $k => $v){
  $str=$str.$k.$v.";";
  if($v>$max){
    $max=$v;
    $maxc=$k;
  }
}
$query2="SELECT c.movie_id from clusters_5 c,movie m where c.cluster_id ='$maxc' and c.movie_id not in(SELECT movie_id from user_watched where user_name='$username')";
$result = mysqli_query($db_server,$query2);
if (!$result) die ("Database access failed: " . mysqli_error($db_server));
$rows = mysqli_num_rows($result);
$movies=array();
for ($k = 0 ; $k < $rows ; ++$k)

{
  $row = mysqli_fetch_row($result);
  $movies[]=$row[0];
  //echo $row[0]."84   ";
}
//echo $movies[0];
$query1 = "select title from movie where movie_id in ('" .implode("', '", $movies). "') LIMIT 20";
$query2 = "select average_vote from movie where movie_id in ('" .implode("', '", $movies). "') LIMIT 20";
$query3 = "select url from movie where movie_id in ('" .implode("', '", $movies). "') LIMIT 20";
$query4 = "select avg(uw.user_rating) from movie m LEFT JOIN user_watched uw on m.movie_id=uw.movie_id where m.movie_id in ('" .implode("', '", $movies). "') group by m.movie_id LIMIT 20;";
//processquery($query1,$query2,$query3,$query4,$db_server);



//function processquery($query1,$query2,$query3,$query4,$db_server){
$imgarray=array();
$result = mysqli_query($db_server,$query1);
if (!$result) $result = mysqli_query($db_server,$query1);//die ("Database access failed: " . mysqli_error($db_server));

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

  //echo $row[0]."113   ";

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

  //echo $row[0]."129   ";
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
  //echo $row[0]."143   ";
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

  //echo $row[0]."158   ";
}
$GLOBALS['avguserret']=$GLOBALS['avguserret'].$rows."moviemaniaavguser";
if($rows==0)
{
  $GLOBALS['avguserret']=$GLOBALS['avguserret']."Not Enough Ratingsmoviemaniaavguser";
}


//}
//$GLOBALS['ret']=$GLOBALS['ret'].$GLOBALS['nameret']."moviemaniaseparator".$GLOBALS['imgret']."moviemaniaseparator".$GLOBALS['urlret'];//."moviemaniasetseparator";
$GLOBALS['ret']=$GLOBALS['ret'].$GLOBALS['nameret']."moviemaniaseparator".$GLOBALS['criticret']."moviemaniaseparator".$GLOBALS['avguserret']."moviemaniaseparator".$GLOBALS['urlret'];//."moviemaniasetseparator";
echo $GLOBALS['ret'];

mysqli_close($db_server);



?>
