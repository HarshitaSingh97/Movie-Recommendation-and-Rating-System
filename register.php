<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="zxx">
<head>
  <title>MovieMania</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" placeholder="Username" value="<?php echo $username; ?>">
  	</div>
	<div class="input-group">
  	  <label>First Name</label>
  	  <input type="text" name="first_name" placeholder="First Name">
  	</div>
	<div class="input-group">
  	  <label>Last Name</label>
  	  <input type="text" name="last_name" placeholder="Last Name">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" placeholder="Email Id" value="<?php echo $email; ?>">
  	</div>
  </div>
  <div class="col-lg-6">
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" placeholder="Password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" placeholder="Confirm Password" name="password_2">
  	</div>
	<div class="input-group">
  	  <label>Date of birth</label>
  	  <input type="date" name="dob">
  	</div>
	<div class="input-group">
  	  <label>Phone_number</label>
  	  <input type="phone number"placeholder="Phone Number" name="phone_number">
  	</div>
	<p>Genre</p>
	 <input type="checkbox" name="Genre" value="Comedy" checked>Comedy<br>
     <input type="checkbox" name="Genre" value="Action" checked>Action<br>
	 <input type="checkbox" name="Genre" value="Romance" checked>Romance<br>
	 <input type="checkbox" name="Genre" value="Anime" checked>Anime<br>
	 <input type="checkbox" name="Genre" value="Cartoon" checked>Cartoon<br>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	
  </form>
</body>
</html>

 