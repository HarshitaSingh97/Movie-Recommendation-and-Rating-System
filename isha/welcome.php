<?php
   include('session.php');
?>
<html>

   <head>
      <title>Welcome </title>
   </head>
   <style>

   .signout {
    position: absolute;
    right: 100px;
    top: 150px;
}

   .ageandname{
       background-color: #3498DB;
       color: white;
       padding: 16px;
       font-size: 16px;
       border: none;
       cursor: pointer;
       display: inline-block;
   }
   /* Dropdown Button */
   .dropbtn {
       background-color: #3498DB;
       color: white;
       padding: 16px;
       font-size: 16px;
       border: none;
       cursor: pointer;
   }

   /* Dropdown button on hover & focus */
   .dropbtn:hover, .dropbtn:focus {
       background-color: #2980B9;
   }

   /* The container <div> - needed to position the dropdown content */
   .dropdown {
       position: relative;
       display: inline-block;
   }

   /* Dropdown Content (Hidden by Default) */
   .dropdown-content {
       display: none;
       position: absolute;
       background-color: #f1f1f1;
       min-width: 160px;
       box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
       z-index: 1;
   }

   /* Links inside the dropdown */
   .dropdown-content a {
       color: black;
       padding: 12px 16px;
       text-decoration: none;
       display: block;
   }

   /* Change color of dropdown links on hover */
   .dropdown-content a:hover {background-color: #ddd}

   /* Show the dropdown menu (use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button) */
   .show {display:block;}
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
   </script>
   <body>
      <div id = "user-profile"><img src="user.png"></div>
      <h1 >Welcome<?php echo "   ".$login_session['name'] ?></h1>
      <h1><div id="age" class="ageandname">AGE</div><?php echo "  ".$login_session['age'] ?></h1>
      <h1><div id="email" class="ageandname">EMAIL</div><?php echo "  ".$login_session['email'] ?></h1>
      <h1><div id="price" class="ageandname">PRICE</div><?php echo "  ".$login_session['price'] ?></h1>
      <div class="dropdown">
        <button onclick="genre()" class="dropbtn">GENRE</button>
        <div id="myDropdown" class="dropdown-content">
        <a href="#">DRAMA</a>
        <a href="#">HORROR</a>
        <a href="#">COMEDY</a>
        </div>
      </div>
      <div id="signout"><h2><a href = "login.html">Sign Out</a></h2></div>
   </body>

</html>
