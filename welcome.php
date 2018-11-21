<?php
   include('session.php');
?>
<html>

   <head>
      <title>Welcome </title>
      <!--<link rel="stylesheet" type="text/css" href="header.css"/>-->
   <!--<style>
   h1,h2,h3{
	   color:white;
   }
   #apply{
		background: transparent;
		border: 0;
		padding: 0;
		cursor: pointer;
		outline: 0;
		-webkit-appearance: none;
	    display: inline-block;
		position: relative;
		padding: 20px 38px;
		top: 0;
		font-size: 1em;
		font-family: "Open Sans", Helvetica;
		border-radius: 4px;
		border-bottom: 1px solid rgba( 28, 227, 125, 0.5 );
		background: rgba( 22, 230, 137, 1 );
		color:#fff;
		background-image: url("backgroundimage.jpg");  
		box-shadow: 0px 0px 0px rgba( 15, 165, 60, 0.1 );
  
		-webkit-transform: translateZ(0);
		-moz-transform: translateZ(0);
		-ms-transform: translateZ(0);
		transform: translateZ(0);

		-webkit-transition: all 0.2s ease;
		-moz-transition: all 0.2s ease;
		-ms-transition: all 0.2s ease;
		transition: all 0.2s ease;
	}
   </style>
   <script>
   function genre() {
       document.getElementById("myDropdown").classList.toggle("show");
   }

   // Close the dropdown menu if the user clicks outside of it
   window.onclick = function(event) {
     if (!event.target.matches('.dropbtn')) {

       var dropdowns = document.getElementsByClassName("dropdown-content");
       var i;
       for (i = 0; i < dropdowns.length; i++) {
         var openDropdown = dropdowns[i];
         if (openDropdown.classList.contains('show')) {
           openDropdown.classList.remove('show');
         }
       }
     }
   }
   </script>-->
   </head>
   <body>
	<div>
		<div class="mm" style="font-size:2em;margin-top:1em;height:10%;"><center>Movie Mania</center></div>
		<div>Welcome,<?php echo " ".$login_session['name'] ?></div>
			
		
	</div>
	
	  <!--<div><span style="float:right;"><a href="suggest.html"><button class="button" style="margin-top:0em;width:9em;margin-right:0em;height:3em;" data-button="Dashboard">Dashboard</button></a></span></div>
	  <div><span><a href="#" style="color:white;margin-top:-10em;margin-right:50em;font-family:arial;font-size:0.9em;">Welcome,<?php echo " ".$login_session['name'] ?></a></span><br><span style="float:right;"><a href="homepage.html"><button class="button" style="margin-top:2em;width:9em;margin-right:-10em;height:3em;" data-button="LogOut">Log Out</button></a></span></div>
      <div class="mm" style="font-size:4em;margin-top:-1em;">Movie Mania</div>
      <div id = "user-profile"><img src="user.png"></div>
      <center><span><a href="#"><div  id="Apply" name="Apply" class="button" style="text-align:center;margin-top:0px;height:2em">DOB</div></a></span><h3 style="display:inline-block"><?php echo "  ".$login_session['dob'] ?></h3></center>
	  <br><br>
	  <center><span><a href="#"><div  id="Apply" name="Apply" class="button" style="text-align:center;margin-top:0px;height:2em">Email Id</div></a></span><h3 style="display:inline-block"><?php echo "  ".$login_session['email'] ?></h3></center>
	  <br><br>
	  <center><span><a href="#"><div  id="Apply" name="Apply" class="button" style="text-align:center;margin-top:0px;height:2em">Gender</div></a></span><h3 style="display:inline-block"><?php echo "  ".$login_session['gender'] ?></h3></center>
      <div class="dropdown">
        <button onclick="genre()" class="dropbtn">GENRE</button>
        <div id="myDropdown" class="dropdown-content">
        <a href="#">DRAMA</a>
        <a href="#">HORROR</a>
        <a href="#">COMEDY</a>
        </div>
      </div>-->
      
   </body>

</html>
