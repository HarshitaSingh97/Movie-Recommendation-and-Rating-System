<?php // sqltest.php
session_start();

extract($_GET);

$username=$_SESSION['username']; //$_SESSION['myssession'];
$movie=$_GET['movie'];

$db_server = mysqli_connect('localhost', 'root', 'root','se_moviemania2');

// Check connection
if (!$db_server) {
  die("Connection failed: " . mysqli_connect_error());
}

mysqli_select_db($db_server, 'se_moviemania2')

or die("Unable to select database: " . mysqli_error());
//find movie id

$query="select movie_id from movie where title='$movie';";
  $result = mysqli_query($db_server,$query);
  if (!$result) die ("Database access failed: " . mysqli_error($db_server));
  $rows = mysqli_num_rows($result);
  for ($k = 0 ; $k < $rows ; ++$k)

  {
    $row = mysqli_fetch_row($result);
    $movie_id=$row[0];
  }

//check if rating exists
$query = "SELECT user_rating FROM user_watched WHERE user_name='$username' AND movie_id='$movie_id'";
$result = mysqli_query($db_server,$query);

if (!$result) die ("Database access failed: " . mysqli_error($db_server));

$rows = mysqli_num_rows($result);
$flagrating=0;
if($rows==1)
{
  $row = mysqli_fetch_row($result);
  $rating = (int)$row[0];
  $flagrating = 1;

}

echo <<<_END

<!DOCTYPE html>
<html>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Include the above in your HEAD tag ---------->

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Include the above in your HEAD tag ---------->

<head>
  <title>Movie details</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script type="text/javascript" src="suggest.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


  <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i" rel="stylesheet">

  <!-- Stylesheets -->
  <!--link rel="stylesheet" href="css/bootstrap.min.css"/-->
  <link rel="stylesheet" href="css/font-awesome.min.css"/>
  <link rel="stylesheet" href="css/owl.carousel.css"/>
  <link rel="stylesheet" href="css/style.css"/>
  <link rel="stylesheet" href="css/animate.css"/>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="rating.css">

    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script  src="star.js"></script>


</head>

<body onload="obj.movieoverview('$movie')" style=" background-image:url('img/bg-13.jpg'); background-size:cover;background-repeat:no-repeat;">


<header class="header-section">
    <div class="container">
      <!-- logo -->
      <a class="site-logo" href="suggest.html">
      <img style="position:absolute;top:20px;left:90px" src="MovieMania.png" width="50" display="inline;" height="50" alt="MM">
        <h2 style="color: white">Movie<span style="color: #ffb320">Mania</span></h2>
        </a>
      <!--div class="user-panel">
        <a href="#">Login</a>  /  <a href="#">Register</a>
      </div-->
      <!-- responsive -->
      <div class="nav-switch">
        <i class="fa fa-bars"></i>
      </div>
      <!-- site menu -->
      <nav class="main-menu">
        <ul>
          <li><a href="userprofile.php">My Profile</a></li>
          <li><a href="suggest.html">Search</a></li>
          <li><a href="contactUs.html">Contact Us</a></li>
          <li><a href="aboutUs.html">About Us</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav>
    </div>
  </header>


<div class="row" style="float:right;height:3em;margin:1em;border:5px solid block;">
<!--span style="float:right;margin-right:0px;"><a href="../SE/suggest.html" ><button class="button" style="margin-top:1em;height:2em;"  data-button="Dashboard">Dashboard</button></a></span-->
<span  style="float:right;" ><a id="watchmovie" >
<button  id="watchbutton" class="button" style="margin:1em;width:8em;height:4em;margin-right:64em" data-button="Watch Now">Watch Now</button>
</a></span>

</div>

<div id="moviedetails" style="margin:2em;width:90%;font-size:1.2em;">


<div class="rating" style="margin-left:135px;">
    <h4 style=' color:white;'>Rate This Movie:</h4>
    <section class='rating-widget'>

    <!-- Rating Stars Box -->
    <div class='rating-stars'>
        <ul id='stars'>
            <li class='star' title='Poor' data-value='1'>
                <i class='fa fa-star fa-fw'></i>
            </li>
            <li class='star' title='Fair' data-value='2'>
                <i class='fa fa-star fa-fw'></i>
            </li>
            <li class='star' title='Good' data-value='3'>
                <i class='fa fa-star fa-fw'></i>
            </li>
            <li class='star' title='Excellent' data-value='4'>
                <i class='fa fa-star fa-fw'></i>
            </li>
            <li class='star' title='WOW' data-value='5'>
                <i class='fa fa-star fa-fw'></i>
            </li>
        </ul>
    </div>

    <div class='success-box'>
        <div class='text-message' style="background-color: transparent;"></div>
    </div>

  </section><br><br>

</div>
</div>
_END;

if($flagrating==1)
{

echo <<<_END
  <script>
    
    //alert('hello');
    var stars = document.getElementsByClassName('star');
    //alert(stars);
    for (i = 0; i < $rating; i++) {
      //alert(stars[i]);
      stars[i].className='star selected';
    }
    
    // JUST RESPONSE (Not needed)
        msg = 'You have rated this ' + $rating + ' stars.';
    
    responseMessage(msg);
    //saveRating(ratingValue);
    
  
  
  </script>
_END;
}
echo" </body> </html>";




mysqli_close($db_server);
/*
function get_post($var)

{

return mysql_real_escape_string($_POST[$var]);

}*/

?>
