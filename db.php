othis.movie=document.getElementById("movie");
		othis.thriller=document.getElementById("Thriller");
		othis.scifi=document.getElementById("Sci-fi");
		othis.horror=document.getElementById("Horror");
		othis.english=document.getElementById("English");
		othis.hindi=document.getElementById("Hindi");
		othis.containerdiv=document.getElementById("container");
		var genres=[];
		var languages=[];
		if(othis.thriller.checked==true){
			genres.push("Thriller");
		}
		
		if(othis.scifi.checked==true){
			genres.push("Sci-fi");
		}
		
		if(othis.horror.checked==true){
			genres.push("Horror");
		}
		if(othis.english.checked==true){
			languages.push("English");
		}
		
		if(othis.horror.checked==true){
			languages.push("Hindi");
		}
		alert(genres[0]);
		this.containerdiv=null;
	this.thriller=null;
	this.scifi=null;
	this.horror=null;
	this.english=null;
	this.hindi=null;




<!--<!DOCTYPE html>
<head>
<title>AutoSuggest</title>
<link rel="stylesheet" type="text/css" href="suggest.css"></link>
<script type="text/javascript" src="suggest.js"></script>
</head>
<body>

<table border="0">
	<tr>
		<select name="Filter" id="filter" onchange="obj.fetchfilter()">
		<option selected="selected" disabled hidden>Select</option>
		<option value="English">English</option>
		<option value="hindi">hindi</option>
		</select>
	</tr>
	<tr>
		<td>FAV Movie:</td>
		<td><input type="text" id="movie" size="50" onkeyup="obj.getMovies()" /></td>
	</tr>
	<tr>
		<td></td>
		<td><div id="container"></div></td>
	</tr>
</table>
</body>
</html>-->
//constructor function. Will use it to create 'obj' which we will use for suggest functionality
/*function Suggest()
{
	othis=this;
	
	this.xhr= new XMLHttpRequest();

	this.movie=null;
	
	this.containerdiv=null;
	this.filter=null;
	//we have a timer to control timing
	this.timer=null;
	
	this.getMovies = function()
	{
		//If we came here, it means user typed something, so we hang on and not go to the server, if the user has paused,
		//then go to server(after 1 second) 
		if(othis.timer)
		{
			clearTimeout(othis.timer);
		}
		othis.timer=setTimeout(othis.fetchMovies,1000);
	};
	
	this.fetchfilter=function()
	{
		othis.filter=document.getElementById("filter");
		alert(othis.filter);
	};
	
	this.fetchMovies = function()
	{
		//check if we have the data in browser cache. if we have it we use it else go to server.
		//before anything check if $movie is empty.
		//because user may have "backspaced" and made the field empty
		othis.movie=document.getElementById("movie");
		othis.containerdiv=document.getElementById("container");
		if(othis.movie.value=="")
		{
			othis.containerdiv.innerHTML="";
			othis.containerdiv.style.display="none";
			return;
		}
		else
		{
			if(localStorage["http://localhost/SE/getmovies.php?movie=" + othis.movie.value])
			{
				cachedmovies=localStorage["http://localhost/SE/getmovies.php?movie=" + othis.movie.value];
				othis.populate(JSON.parse(cachedmovies));
			}
			else
			{
				//we have no option but to visit server
				othis.xhr.onreadystatechange=othis.processResults;
				
				othis.xhr.open("GET","http://localhost/SE/getmovies.php?movie=" + othis.movie.value,true);
				
				othis.xhr.send();
			}
		}
		
	}
	
	this.processResults=function()
	{
		//check for usual conditions
		if(othis.xhr.readyState==4 && othis.xhr.status==200)
		{
			movies=JSON.parse(othis.xhr.responseText);
			
			//if there is no match
			if(movies.length==0)
			{
				othis.containerdiv.innerHTML="";
				othis.containerdiv.style.display="none";
				
				//also let the user know that there were no match
				othis.movie.className="notfound";
			}
			
			//else we found match
			//lets add it to the containerdiv
			
			else
			{
				othis.populate(movies);
				key="http://localhost/SE/getmovies.php?movie=" + othis.movie.value;
				localStorage[key]=othis.xhr.responseText
			}
		}
	}
	this.populate=function(movies)
	{
		othis.containerdiv.innerHTML="";
		for(i=0;i<movies.length;i++)
		{
			div=document.createElement("div");
			
			div.innerHTML=movies[i];
			div.className="suggest";
			
			div.onclick=othis.setMovie;
			
			othis.containerdiv.appendChild(div);
		}
		othis.containerdiv.style.display="block";
	}
	this.setMovie=function()
	{
		clickeddiv=event.target;
		othis.movie.value=clickeddiv.innerHTML;
		
		othis.containerdiv.innerHTML="";
		othis.containerdiv.style.display="none";
		
		othis.movie.className="found";
	}

}

obj=new Suggest();*/


<?php
	/*//extract whatever the client sent.
	extract($_GET);
	$db_server = mysqli_connect('localhost', 'root', 'root','setrial1'); 

	// Check connection
	if (!$db_server) {
		die("Connection failed: " . mysqli_connect_error());
	}


	mysqli_select_db($db_server, 'setrial1')

	or die("Unable to select database: " . mysqli_error());
	
	//open movies.txt to do pattern matching
	//$file=fopen("movies.txt","r");
	
	$query = "select name from movie where name like" . $movie . "%";

	if (!$result) die ("Database access failed: " . mysql_error());
	$rows = mysql_num_rows($result);
	$ret=array();
	for ($j = 0 ; $j < $rows ; ++$j)

	{
		echo $row."\n";
		$row = mysql_fetch_row($result);
		//$ret[]=$row;
	}
	
	//loop over all the movies and fetch only those whose initial few chars match the movie name sent by client.
	//trim() is used to get rid of carriage returns(spaces) 
	if(!$file){
		while($line=trim(fgets($file)))
		{
			//strnatcasecmp(haystack,needle,length)
			if(strncasecmp($line,$movie,strlen($movie))==0)
			{
				$ret[]=$line;//dont specify the index then it autoincrements
				
			}
		}
		echo json_encode($ret);
	}	
mysqli_close($db_server);
*/
?>








































<?php
/*$servername = ;
$username = ;
$password = ;
$db_database = ;
*/
// Create connection
$db_server = mysqli_connect('localhost', 'root', 'root','setrial1'); 

// Check connection
if (!$db_server) {
    die("Connection failed: " . mysqli_connect_error());
}


mysqli_select_db($db_server, 'setrial1')

or die("Unable to select database: " . mysqli_error());

/*
if (isset($_POST['First Name']) &&

isset($_POST['Last Name']) &&

isset($_POST['Event']) &&

isset($_POST['Email id']) &&

isset($_POST['Phone Number']))

{

$fname = get_post('First Name');

$lname = get_post('Last Name');

$event = get_post('Event');

$eid = get_post('Email id');

$phno = get_post('Phone Number');

//$date 

$query = "INSERT INTO register VALUES" .

"('$fname', '$lname', '$event', '', '$eid', '$phno')";

if (!mysql_query($query, $db_server))

echo "INSERT failed: $query<br>" .

mysql_error() . "<br><br>";

}
echo <<<_END


_END;
	
$query = "INSERT INTO register(fname,lname,event,date,eid,phno) VALUES('$_POST[First_Name]','$_POST[Last_Name]','$_POST[Event]', '$date','$_POST[Email_Id]','$_POST[Phone_Number]')";

if (!mysql_query($query, $db_server))

echo "INSERT failed: $query<br>" .

mysql_error() . "<br><br>";



echo "<h1>Congratulations!</h1>You have successfully registered for an event. An email will be sent to you shortly, giving you the details about the event. Keep in touch!";


//echo "Connected successfully";
*/
mysqli_close($db_server);
?>