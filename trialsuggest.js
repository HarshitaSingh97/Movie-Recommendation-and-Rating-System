//constructor function. Will use it to create 'obj' which we will use for suggest functionality

function Suggest()
{
	othis=this;
	this.thriller=null;
	this.scifi=null;
	this.horror=null;
	this.english=null;
	this.hindi=null;
	this.xhr= new XMLHttpRequest();

	this.movie=null;
	
	this.containerdiv=null;
	this.moviediv=null;
	this.genres="";
	this.languages="";
		
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
			//we have no option but to visit server
			othis.xhr.onreadystatechange=othis.processResults;
			
			othis.xhr.open("GET","http://localhost/SE/getmovies.php?movie=" + othis.movie.value + "&genres="+othis.genres+"&languages="+othis.languages,true);
			
			othis.xhr.send();
			
		}
		
	}
	this.populateall = function(){
		var initialmovieset="";
		othis.xhr.onreadystatechange=othis.moviestodisplay;
			
		othis.xhr.open("GET","http://localhost/SE/getmovies.php?movie=" + initialmovieset + "&genres="+othis.genres+"&languages="+othis.languages,true);
			
		othis.xhr.send();
	}
	
	this.fetchfilter=function()
	{
		othis.movie=document.getElementById("movie");
		othis.thriller=document.getElementById("Thriller");
		othis.scifi=document.getElementById("Sci-fi");
		othis.horror=document.getElementById("Horror");
		othis.english=document.getElementById("English");
		othis.hindi=document.getElementById("Hindi");
		othis.containerdiv=document.getElementById("container");
		if(othis.thriller.checked==true){
			genres+"Thriller,";
		}
		
		if(othis.scifi.checked==true){
			genres+"Sci-fi,";
		}
		
		if(othis.horror.checked==true){
			genres+"Horror,";
		}
		if(othis.english.checked==true){
			languages+"English,";
		}
		
		if(othis.horror.checked==true){
			languages+"Hindi,";
		}
		this.containerdiv=null;
		
		othis.xhr.onreadystatechange=othis.moviestodisplay;
				
		othis.xhr.open("GET","http://localhost/SE/getmovies.php?movie=" + othis.movie.value + "&genres="+othis.genres+"&languages="+othis.languages,true);
				
		othis.xhr.send();
	}
	this.moviestodisplay=function()
	{
		if(othis.xhr.readyState==4 && othis.xhr.status==200)
		{
			response=othis.xhr.responseText;
			movies=response.split("moviemaniaseparator")[0];
			movies=movies.split("moviemaniamovies");
			imgs=(response.split("moviemaniaseparator")[1]).split("moviemaniaimages");
			url=(response.split("moviemaniaseparator")[2]).split("moviemaniaurls");
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
				othis.displayResults(movies,imgs,url);
				var moviedefault="";
				try{
					key="http://localhost/SE/getmovies.php?movie=" + othis.movie.value + "&genres="+genres+"&languages="+languages;
				}
				catch(e){
					key="http://localhost/SE/getmovies.php?movie=" + moviedefault + "&genres="+genres+"&languages="+languages;
				}
			}
		}	
	}
	this.processResults=function()
	{
		//check for usual conditions
		if(othis.xhr.readyState==4 && othis.xhr.status==200)
		{
			response=othis.xhr.responseText;
			movies=response.split("moviemaniaseparator")[0];
			movies=movies.split("moviemaniamovies");
			imgs=(response.split("moviemaniaseparator")[1]).split("moviemaniaimages");
			url=(response.split("moviemaniaseparator")[2]).split("moviemaniaurls");
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
				othis.displayResults(movies,imgs,url);
				var moviedefault="";
				try{
					key="http://localhost/SE/getmovies.php?movie=" + othis.movie.value + "&genres="+genres+"&languages="+languages;
				}
				catch(e){
					key="http://localhost/SE/getmovies.php?movie=" + moviedefault + "&genres="+genres+"&languages="+languages;
				}
			}
		}
	}
	this.populate=function(movies)
	{
		othis.containerdiv.innerHTML="";
		for(i=0;i<movies.length;i++)
		{
			if(movies[i].length>0)
			{
				div=document.createElement("div");
				
				div.innerHTML=movies[i];
				div.className="suggest";
				
				div.onclick=othis.setMovie;
				if(i==movies.length-1){
					div.style.bottom="0.5px solid green";
				}
				othis.containerdiv.appendChild(div);
			}
		}
		othis.containerdiv.style.display="block";
	}
	this.displayResults=function(movies,imgs,url){
		othis.moviediv=document.getElementById("displaydiv");
		othis.moviediv.innerHTML="";
		for(i=0;i<movies.length-1;i++)
		{
			anchortag=document.createElement("a");
			anchortag.href=url[i];
			div=document.createElement("div");
			//div.style.display="inline-block";
			div.style.width="18.4%";
			
			if(i!=0){
				div.style.marginLeft="1%";
			}
			imaze=document.createElement("img");
			moviedeets1=document.createElement("p");
			moviedeets2=document.createElement("p");
			moviedeets3=document.createElement("p");
			
			imaze.src="../SE/img/movieimg"+i+".jpg";
			imaze.style.width="100%";
			imaze.style.height="100%";
			
			moviedeets1.textContent=movies[i];
			+"\n Critic Rating";
			moviedeets1.style.textAlign="left";
			moviedeets1.style.fontsize="1.5em";
			moviedeets1.style.fontFamily="Arial";
			
			moviedeets2.textContent="Critic Rating:";
			//moviedeets2.style.marginTop="-20px";
			moviedeets2.style.textAlign="left";
			//moviedeets2.style.border="1px solid black";
			moviedeets2.style.fontsize="1.5em";
			moviedeets2.style.fontFamily="Arial";
			
			moviedeets3.textContent="Avg User Rating:";
			//moviedeets2.style.marginTop="-20px";
			//moviedeets3.style.border="1px solid black";
			moviedeets3.style.textAlign="left";
			moviedeets3.style.fontsize="1.5em";
			moviedeets3.style.fontFamily="Arial";
			
			div.appendChild(imaze);
			div.appendChild(moviedeets1);
			div.appendChild(moviedeets2);
			div.appendChild(moviedeets3);
			div.className="bktibx";
			//anchortag.className="";
			anchortag.appendChild(div);
			othis.moviediv.appendChild(anchortag);
		}
		othis.moviediv.style.display="block";
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