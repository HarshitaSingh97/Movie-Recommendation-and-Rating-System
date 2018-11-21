<?php

  extract($_GET);
  $db_server = mysqli_connect('localhost', 'root', 'root','se_moviemania2');

  if (!$db_server) {
    die("Connection failed: " . mysqli_connect_error());
  }

  //$username=$_SESSION['username'];
  mysqli_select_db($db_server, 'se_moviemania2')

  or die("Unable to select database: " . mysqli_error());
  //echo $pts."ptsptsptspts";
  $arrs=explode(";",$pts);
  //echo count($arrs)."fdsghredf";
  $i=0;
  $arr=array();
  //($pts);

  for($i=0;$i<count($arrs)-1;$i++)
  {
      $arr=explode(",",$arrs[$i]);
      $genre=intval($arr[0]);
      $vote=intval($arr[1]);
      $movie_id=intval($arr[2]);
      $cluster=intval($arr[3]);


      $query="Insert into clusters_5(movie_id,cluster_id) values($movie_id,$cluster);";
      $result = mysqli_query($db_server,$query);

      //console.log("chal raha haiiii");
      //echo $movie_id.",";
      //echo ($arr[0].",".$arr[1]);


  }
  echo "done";
  mysqli_close($db_server);


?>
