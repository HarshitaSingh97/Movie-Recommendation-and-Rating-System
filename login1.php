<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<a href="homepage.html"><img src="homeicon.png" width="42" height="42" style="color:teal
;" alt="HOME"/></a>
<form method="post" action="login.php">
<?php include('errors.php'); ?>
<div class="container"> 	
  	<center><h2>Login Here</h2></center>
	<div class="input-group">	
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="button" name="login_user">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="register1.php">Sign up</a>
  	</p>
</div>
</form>
</body>
</html>