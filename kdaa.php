<?php
// poorman.php
/*echo "< form action='poorman.php' method='get'>";
echo "Number values to generate: < input type='text' name='N' />";
echo "< input type='submit' />";
echo "< /form>";*/
//if( isset($_GET['N']))
//{
  //$N = $_GET['N'];

  // execute R script from shell
  // this will save a plot at temp.png to the filesystem

  exec("kdaa.R");

  // return image tag

//  $nocache = rand();

  //echo("< img src='C:/xampp/htdocs/SE/temp.png?$nocache' /> ");
//}
?>
