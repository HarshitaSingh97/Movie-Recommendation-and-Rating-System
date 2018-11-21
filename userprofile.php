<?php // sqltest.php
session_start();

$username=$_SESSION['username'];
$db_server = mysqli_connect('localhost', 'root', 'root','se_moviemania2');

// Check connection
if (!$db_server) {
  die("Connection failed: " . mysqli_connect_error());
}


mysqli_select_db($db_server, 'se_moviemania2')

or die("Unable to select database: " . mysqli_error());
$first_name="";
$last_name="";
$email_id="";
$phone_number="";
$mobile="";
$location="";
/*
$json_array=array();
$query = "SELECT user.user_name,count(movie.movie_id) FROM user, movie WHERE user.user_name='$username' and user.user_nam watches blah blah blah";
$result = mysqli_query($db_server,$query);

if (!$result) die ("Database access failed: " . mysqli_error($db_server));

$rows = mysqli_num_rows($result);

while($row = mysqli_fetch_assoc($result))

{
$json_array[] = $row;
}
*/
$user_img="";


$query = "SELECT first_name FROM user WHERE user_name='$username'";
$result = mysqli_query($db_server,$query);

if (!$result) die ("Database access failed: " . mysqli_error($db_server));

$rows = mysqli_num_rows($result);

for ($j = 0 ; $j < $rows ; ++$j)

{

$row = mysqli_fetch_row($result);
$first_name=$row[0];
}
$query = "SELECT last_name FROM user WHERE user_name='$username'";
$result = mysqli_query($db_server,$query);

if (!$result) die ("Database access failed: " . mysqli_error($db_server));

$rows = mysqli_num_rows($result);

for ($j = 0 ; $j < $rows ; ++$j)

{

$row = mysqli_fetch_row($result);
$last_name=$row[0];
}
$query = "SELECT email_id FROM user WHERE user_name='$username'";
$result = mysqli_query($db_server,$query);

if (!$result) die ("Database access failed: " . mysqli_error($db_server));

$rows = mysqli_num_rows($result);

for ($j = 0 ; $j < $rows ; ++$j)

{

$row = mysqli_fetch_row($result);
$email_id=$row[0];
}

$query = "SELECT phone_number FROM user WHERE user_name='$username'";
$result = mysqli_query($db_server,$query);

if (!$result) die ("Database access failed: " . mysqli_error($db_server));

$rows = mysqli_num_rows($result);

for ($j = 0 ; $j < $rows ; ++$j)

{

$row = mysqli_fetch_row($result);
$phone_number=$row[0];
}
$query = "SELECT mobile FROM user WHERE user_name='$username'";
$result = mysqli_query($db_server,$query);

if (!$result) die ("Database access failed: " . mysqli_error($db_server));

$rows = mysqli_num_rows($result);

for ($j = 0 ; $j < $rows ; ++$j)

{

$row = mysqli_fetch_row($result);
$mobile=$row[0];
}
$query = "SELECT location FROM user WHERE user_name='$username'";
$result = mysqli_query($db_server,$query);

if (!$result) die ("Database access failed: " . mysqli_error($db_server));

$rows = mysqli_num_rows($result);

for ($j = 0 ; $j < $rows ; ++$j)

{

$row = mysqli_fetch_row($result);
$location=$row[0];
}



$movieswatched="";
$query = "SELECT count(*) FROM user_watched WHERE user_name='$username'";
$result = mysqli_query($db_server,$query);

if (!$result) die ("Database access failed: " . mysqli_error($db_server));

$rows = mysqli_num_rows($result);

for ($j = 0 ; $j < $rows ; ++$j)

{

$row = mysqli_fetch_row($result);
$movieswatched=(int)$row[0];
}



$amountspent="";
$query = "SELECT sum(user_amount) FROM user_watched WHERE user_name='$username'";
$result = mysqli_query($db_server,$query);

if (!$result) die ("Database access failed: " . mysqli_error($db_server));

$rows = mysqli_num_rows($result);

for ($j = 0 ; $j < $rows ; ++$j)

{

$row = mysqli_fetch_row($result);
$amountspent=(float)$row[0];
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
  <title>MovieMania</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script type="text/javascript" src="userprofile.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
   <link href="img/favicon.ico" rel="shortcut icon"/>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i" rel="stylesheet">

  <!-- Stylesheets -->
  <!--link rel="stylesheet" href="css/bootstrap.min.css"/-->
  <link rel="stylesheet" href="css/font-awesome.min.css"/>
  <link rel="stylesheet" href="css/owl.carousel.css"/>
  <link rel="stylesheet" href="css/style.css"/>
  <link rel="stylesheet" href="css/animate.css"/>


</head>

<body onload="obj.displaygenres()" style="background-image: url('img/bg-10.jpg'); background-size:cover;">
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
          <li><a href="#" style="color: #ffb320;">My Profile</a></li>
          <li><a href="suggest.html">Search</a></li>
          <li><a href="aboutUs.html">About Us</a></li>
          <li><a href="contactUs.html">Contact Us</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <!-- Header section end -->

<div class="container bootstrap snippet">
    <!--div class="row">
    <div class="col-sm-12"><a href="../SE/suggest.html" class="pull-right"><input type="button" style="float:right;" value="Dashboard"></a></div>
    </div-->
    <br><br>
    <div class="row">
  		<div class="col-sm-10"><h1 id="username" >$username</h1></div>
    	<!--div class="col-sm-2"><a href="/users" class="pull-right"><img title="profile image" class="img-circle img-responsive" style="max-height:10em;max-width:10em;" src="MovieMania.png"></a></div-->

    </div>
    <br><br>
    <div class="row">
  		<div class="col-sm-3"><!--left col-->


      <div class="text-center">
        <img src="../SE/usericon/$username.jpg" id="avatar" class="avatar img-circle img-thumbnail" style="max-height:10em;max-width:10em;min-height:10em;min-width:10em;" onerror="this.src='../SE/usericon/default.jpg';"/>
        <!--h6>Upload a different photo...</h6>-->
		<h6></h6>
		<canvas id="myCanvas" width="0px" height="0px"></canvas>
    <form id="uploadbanner" method="post" action="" enctype="multipart/form-data">
        <input id="upload" type="file" accept="image/*" name="upload" onchange="obj.changephoto()" class="text-center center-block file-upload" style="display:none;">
		<label for="upload"><u style="color:blue;">Edit Photo</u></label><br>
      <input type="submit" name="save" id="save" value="save" class="save/>"
    </form>
      </div></hr><br>


          <!--<div class="panel panel-default">
            <div class="panel-heading">Website <i class="fa fa-link fa-1x"></i></div>
            <div class="panel-body"><a href="http://bootnipets.com">bootnipets.com</a></div>
          </div>-->


          <ul class="list-group">
            <li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Movies Watched</strong></span> $movieswatched</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Amount Spent</strong></span> $amountspent</li>
          </ul>

          <!--<div class="panel panel-default">
            <div class="panel-heading">Social Media</div>
            <div class="panel-body">
            	<i class="fa fa-facebook fa-2x"></i> <i class="fa fa-github fa-2x"></i> <i class="fa fa-twitter fa-2x"></i> <i class="fa fa-pinterest fa-2x"></i> <i class="fa fa-google-plus fa-2x"></i>
            </div>
          </div>-->

        </div><!--/col-3-->
    	<div class="col-sm-9">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home" style="color:black;">Home</a></li>
                <li><a data-toggle="tab" href="#messages" style="color:black;">Preferences</a></li>
                <li><a data-toggle="tab" href="#settings" style="color:black;">Activity</a></li>
            </ul>


          <div class="tab-content">
            <div class="tab-pane active" id="home">
                

                  <form class="form" action="" method="post" id="registrationForm">
                      <div class="form-group">

                          <div class="col-xs-6">
                          <br>
                              <label for="first_name"><h4>First name</h4></label>
                              <br>
                              <input type="text" onKeyUp="enablesave1()" class="form-control" name="first_name" id="first_name" value="$first_name" placeholder="first name" title="enter your first name if any.">
                          </div>
                      </div>
                      <div class="form-group">

                      <div class="col-xs-6">
                      <br>
                            <label for="last_name"><h4>Last name</h4></label>
                        <br>
                              <input type="text" onKeyUp="enablesave1()" class="form-control" name="last_name" id="last_name" value="$last_name" placeholder="last name" title="enter your last name if any.">
                          </div>
                      </div>

                      <div class="form-group">

                          <div class="col-xs-6">
                              <br><label for="phone"><h4>Phone</h4></label>
                              <br>
                              <input type="text" onKeyUp="enablesave1()" class="form-control" name="phone" id="phone"  value="$phone_number" placeholder="enter phone" title="enter your phone number if any.">
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-xs-6">
                             <br><label for="mobile"><h4>Mobile</h4></label>
                              <br><input type="text" onKeyUp="enablesave1()" class="form-control" name="mobile" id="mobile" placeholder="enter mobile number" value="$mobile" title="enter your mobile number if any.">
                          </div>
                      </div>
                      <div class="form-group">

                          <div class="col-xs-6">
                             <br> <label for="email"><h4>Email</h4></label>
                              <br><input type="email" onKeyUp="enablesave1()" class="form-control" name="email" id="email" placeholder="you@email.com"  value="$email_id" title="enter your email.">
                          </div>
                      </div>
                      <div class="form-group">

                          <div class="col-xs-6">
                             <br> <label><h4>Location</h4></label>
                             <br> <input type="email" onKeyUp="enablesave1()" class="form-control" id="location" placeholder="somewhere" value="$location" title="enter a location">
                          </div>
                      </div>
                      <div class="form-group">
                           <div class="col-xs-12">
                              <br>  <br>
                              	<button id="save1" class="btn btn-lg btn-success" type="submit" onclick="obj.sethomedetails();"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                               	<button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
                            </div>
                      </div>
              	</form>

              <hr>

             </div><!--/tab-pane-->
             <div class="tab-pane" id="messages">

               <h2></h2>
               <hr>
               <form class="form" action="" method="post" id="registrationForm">
                 <div class="form-group">

                     <div class="col-xs-6">
                       <div style="left-margin:50%;">
                        <label for="Genres"><h4>Genres</h4></label>
               					    <br>
                            <label><input type="checkbox" onchange="enablesave2()" class="genres" id="Action" value="Action" name="Genres" style="color:white;"/>Action</label><br>
                            <label><input type="checkbox" onchange="enablesave2()" class="genres" id="Adventure" name="Genres" value="Adventure" style="color:white;"/>Adventure</label><br>
                 						<label><input type="checkbox" onchange="enablesave2()" class="genres" id="Animation" name="Genres" value="Animation" style="color:white;"/>Animation</label><br>
                 						<label><input type="checkbox" onchange="enablesave2()" class="genres" id="Comedy" value="Comedy" name="Genres" style="color:white;"/>Comedy</label><br>
                 						<label><input type="checkbox" onchange="enablesave2()" class="genres" id="Drama" name="Genres" value="Drama" style="color:white;"/>Drama</label><br>
                 						<label><input type="checkbox" onchange="enablesave2()" class="genres" id="Fantasy" name="Genres" value="Fantasy" style="color:white;"/>Fantasy</label><br>
                            <label><input type="checkbox" onchange="enablesave2()" class="genres" id="Horror" name="Genres" value="Horror" style="color:white;"/>Horror</label><br>
                 						<label><input type="checkbox" onchange="enablesave2()" class="genres" id="Mystery" name="Genres" value="Mystery" style="color:white;"/>Mystery</label><br>
                 						<label><input type="checkbox" onchange="enablesave2()" class="genres" id="Romance" value="Romance" name="Genres" style="color:white;"/>Romance</label><br>
                 						<label><input type="checkbox" onchange="enablesave2()" class="genres" id="Sci-Fi" name="Genres" value="Sci-Fi" style="color:white;"/>Sci-Fi</label><br>
                 						<label><input type="checkbox" onchange="enablesave2()" class="genres" id="Thriller" value="Thriller" name="Genres" style="color:white;"/>Thriller</label><br>


                 				</div>
                      </div>
                      <div class="col-xs-6">
                        <div style="left-margin:50%;">
                          <label for="Languages"><h4>Languages</h4></label><br>
                 							<label><input type="checkbox" onchange="enablesave2()" id="English" value="English" name="English" style="color:white;"/>English</label><br>
                   						<label><input type="checkbox" onchange="enablesave2()" id="Hindi" name="Hindi" value="Hindi" style="color:white;"/>Hindi</label><br>

                        </div>
                      </div>

                  </div>
                  <div class="form-group">
                       <div class="col-xs-12">
                            <br>
                            <button id="save2" class="btn btn-lg btn-success" onclick="obj.savepreference()" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                            <button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
                        </div>
                  </div>
              </form>
             </div>

             <div class="tab-pane" id="settings">


                  <hr>
                  <div id="chartContainer" style="height: 30em; width: 150%;"></div>
              <br>


                   <div id="chartContainer2" style="height: 30em; width: 150%;"></div>
               </div><!--/tab-pane-->

          </div><!--/tab-content-->

        </div><!--/col-9-->
    </div><!--/row-->
<script>
document.getElementById("save2").disabled = true;
document.getElementById("save1").disabled = true;
function enablesave1(){
  document.getElementById("save1").disabled = false;
}
function enablesave2(){
  document.getElementById("save2").disabled = false;
}
</script>

</body>
</html>


_END;


 //header("Location: yo.php");
/*$query = "SELECT user_icon FROM user WHERE user_name='$username'";

$result = mysqli_query($db_server,$query);
$userimage="";
if (!$result) die ("Database access failed: " . mysqli_error($db_server));

$rows = mysqli_num_rows($result);

for ($j = 0 ; $j < $rows ; ++$j)

{
$row = mysqli_fetch_row($result);
//echo explode(",",$row[0])[1];
if($row[0]!=null){
    echo '
    <script>
      var icon=document.getElementById("avatar");
      icon.src="../SE/usericon/'.$row[0].";
    </script>';

}

}

*/
mysqli_close($db_server);
/*
function get_post($var)

{

return mysql_real_escape_string($_POST[$var]);

}*/

?>
