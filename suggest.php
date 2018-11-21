//constructor function. Will use it to create 'obj' which we will use for suggest functionality
function Suggest()
{
	othis=this;
	
	this.xhr= new XMLHttpRequest();

	this.movie=null;
	
	this.containerdiv=null;
	
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
			if(localStorage["http://localhost/wt2/getmovies.php?movie=" + othis.movie.value])
			{
				cachedmovies=localStorage["http://localhost/wt2/getmovies.php?movie=" + othis.movie.value];
				othis.populate(JSON.parse(cachedmovies));
			}
			else
			{
				//we have no option but to visit server
				othis.xhr.onreadystatechange=othis.processResults;
				
				othis.xhr.open("GET","http://localhost/wt2/getmovies.php?movie=" + othis.movie.value,true);
				
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
				key="http://localhost/wt2/getmovies.php?movie=" + othis.movie.value;
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

obj=new Suggest();