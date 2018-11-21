//constructor function. Will use it to create 'obj' which we will use for suggest functionality
//constructor function. Will use it to create 'obj' which we will use for suggest functionality

function Suggest()
{
	othis=this;
  this.thriller=null;
	this.scifi=null;
	this.horror=null;
	this.comedy=null;
	this.drama=null;
	this.action=null;
	this.adventure=null;
	this.animation=null;
	this.mystery=null;
	this.romance=null;
	this.fantasy=null;
	this.english=null;
	this.hindi=null;
	this.xhr= new XMLHttpRequest();
	this.xhr2= new XMLHttpRequest();

	this.movie=null;
	this.detailsdiv=null;
	this.containerdiv=null;
	this.moviediv=null;

	this.moviediv2=null;
	this.genres="";
	this.languages="";
	this.movieurl=null;
	var gnres="";
	var lnguages="";
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
		/*othis.xhr2.onreadystatechange=othis.fetchrecommended;

		othis.xhr2.open("GET","http://localhost/SE/getrecommended.php?movie=" + othis.movie.value + "&genres="+othis.genres+"&languages="+othis.languages,true);

		othis.xhr2.send();*/
		setTimeout(othis.fetchrecommended,500);


	}
	othis.fetchrecommended= function(){
		var initialmovieset="";
		alert("yahhhh");

alert("hiiii");
		othis.xhr2.onreadystatechange=function()
		{
			if(othis.xhr2.readyState==4 && othis.xhr2.status==200)
			{
				alert("afafsfd");
					response=othis.xhr2.responseText;;
					alert(response);

					movies=response.split("moviemaniaseparator")[0];
					movies=movies.split("moviemaniamovies");
					critic=(response.split("moviemaniaseparator")[1]).split("moviemaniacritic");
					avguser=(response.split("moviemaniaseparator")[2]).split("moviemaniaavguser");
					//imgs=(response.split("moviemaniaseparator")[1]).split("moviemaniaimages");
					url=(response.split("moviemaniaseparator")[3]).split("moviemaniaurls");
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

						othis.displayResultsrecommended(movies,critic,avguser,url);
						var moviedefault="";
						try{
							key="http://localhost/SE/getrecommended.php?movie=" + othis.movie.value + "&genres="+othis.genres+"&languages="+othis.languages;
						}
						catch(e){
							key="http://localhost/SE/getrecommended.php?movie=" + moviedefault + "&genres="+othis.genres+"&languages="+othis.languages;
						}
					}


		}
		}
		othis.xhr2.open("GET","http://localhost/SE/getrecommended.php?movie=" + initialmovieset + "&genres="+""+"&languages="+"",true);

		othis.xhr2.send();


}
	this.fetchfilter=function()
	{
		othis.genres="";
		othis.languages="";

		othis.movie=document.getElementById("movie");
		othis.thriller=document.getElementById("Thriller");
		othis.scifi=document.getElementById("Sci-Fi");
		othis.horror=document.getElementById("Horror");

		othis.comedy=document.getElementById("Comedy");

		othis.drama=document.getElementById("Drama");

		othis.action=document.getElementById("Action");
		othis.adventure=document.getElementById("Adventure");
		othis.animation=document.getElementById("Animation");
		othis.fantasy=document.getElementById("Fantasy");

		othis.mystery=document.getElementById("Mystery");

		othis.romance=document.getElementById("Romance");

		othis.english=document.getElementById("English");
		othis.hindi=document.getElementById("Hindi");
		othis.containerdiv=document.getElementById("container");
		if(othis.thriller.checked==true){
			othis.genres=othis.genres+"Thriller,";
			//alert("t");
		}

		if(othis.scifi.checked==true){
			othis.genres=othis.genres+"Sci-Fi,";
			//alert("s");
		}

		if(othis.horror.checked==true){
			othis.genres=othis.genres+"Horror,";
			//alert("h");
		}

		if(othis.comedy.checked==true){
			othis.genres=othis.genres+"comedy,";
			//alert("h");
		}

		if(othis.drama.checked==true){
			othis.genres=othis.genres+"drama,";
			//alert("h");
		}

		if(othis.fantasy.checked==true){
			othis.genres=othis.genres+"Fantasy,";
			//alert("h");
		}
		if(othis.action.checked==true){
			othis.genres=othis.genres+"Action,";
			//alert("t");
		}

		if(othis.adventure.checked==true){
			othis.genres=othis.genres+"Adventure,";
			//alert("s");
		}

		if(othis.animation.checked==true){
			othis.genres=othis.genres+"Animation,";
			//alert("h");
		}

		if(othis.romance.checked==true){
			othis.genres=othis.genres+"Romance,";
			//alert("h");
		}

		if(othis.mystery.checked==true){
			othis.genres=othis.genres+"Mystery,";
			//alert("h");
		}
		if(othis.english.checked==true){
			othis.languages=othis.languages+"en,";
			//alert("e");
		}

		if(othis.hindi.checked==true){
			othis.languages=othis.languages+"hi,";
			//alert("hi");
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
			//alert(response);

			movies=response.split("moviemaniaseparator")[0];
			movies=movies.split("moviemaniamovies");
			critic=(response.split("moviemaniaseparator")[1]).split("moviemaniacritic");
			avguser=(response.split("moviemaniaseparator")[2]).split("moviemaniaavguser");
			//imgs=(response.split("moviemaniaseparator")[1]).split("moviemaniaimages");
			url=(response.split("moviemaniaseparator")[3]).split("moviemaniaurls");
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

				othis.displayResults(movies,critic,avguser,url);
				var moviedefault="";
				try{
					key="http://localhost/SE/getmovies.php?movie=" + othis.movie.value + "&genres="+othis.genres+"&languages="+othis.languages;
				}
				catch(e){
					key="http://localhost/SE/getmovies.php?movie=" + moviedefault + "&genres="+othis.genres+"&languages="+othis.languages;
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
			//alert(response);

			othis.genres="";
			othis.languages="";

			movies=response.split("moviemaniaseparator")[0];
			movies=movies.split("moviemaniamovies");
			critic=(response.split("moviemaniaseparator")[1]).split("moviemaniacritic");
			avguser=(response.split("moviemaniaseparator")[2]).split("moviemaniaavguser");
			//imgs=(response.split("moviemaniaseparator")[1]).split("moviemaniaimages");
			url=(response.split("moviemaniaseparator")[3]).split("moviemaniaurls");

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
				othis.displayResults(movies,critic,avguser,url);
				var moviedefault="";
				try{
					key="http://localhost/SE/getmovies.php?movie=" + othis.movie.value + "&genres="+othis.genres+"&languages="+othis.languages;
				}
				catch(e){
					key="http://localhost/SE/getmovies.php?movie=" + moviedefault + "&genres="+othis.genres+"&languages="+othis.languages;
				}
			}
		}
	}
	this.populate=function(movies)
	{
		leng=movies.length;
		if(movies.length>5){
			leng=5;
		}
		othis.containerdiv.innerHTML="";
		for(i=0;i<leng;i++)
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
	this.displayResults=function(movies,critic,avguser,url){
		othis.moviediv=document.getElementById("displaydiv");
		othis.moviediv.style.height="10%";
		othis.moviediv.innerHTML="";
		for(i=0;i<movies.length-1;i++)
		{
			anchortag=document.createElement("a");
			anchortag.href="moviedetails.php?&movie="+movies[i];
			//anchortag.addEventListener('click', function(){
    //this.movieoverview(movies[i]);}, false);

			div=document.createElement("div");
			div.style.display="inline-block";
			div.style.width="18.4%";
			if(i!=0){
				div.style.marginLeft="1%";
			}
			imaze=document.createElement("img");
			moviedeets1=document.createElement("p");
			moviedeets2=document.createElement("p");
			moviedeets3=document.createElement("p");
			try{
				imaze.src="../SE/movie_images/"+movies[i]+".jpg";
			}
			catch(e){
				//alert(movies[i]);
			}
			imaze.style.width="100%";
			imaze.style.height="20vh";

			moviedeets1.textContent=movies[i];
			moviedeets1.setAttribute('style', 'word-wrap: break-word;');
			moviedeets1.style.textAlign="left";
			moviedeets1.style.fontsize="1.5em";
			moviedeets1.style.fontFamily="Arial";

			moviedeets2.textContent="Critic Rating: "+parseFloat(critic[i]);
			moviedeets2.style.textAlign="left";
			moviedeets2.style.fontsize="1.5em";
			moviedeets2.style.fontFamily="Arial";

			moviedeets3.textContent="Avg User Rating: "+(avguser[i]==""?"Not enough ratings":parseFloat(avguser[i]));
			moviedeets3.style.textAlign="left";
			moviedeets3.style.fontsize="1.5em";
			moviedeets3.style.fontFamily="Arial";

			div.appendChild(imaze);
			div.appendChild(moviedeets1);
			div.appendChild(moviedeets2);
			div.appendChild(moviedeets3);
			div.className="display";
			anchortag.appendChild(div);
			othis.moviediv.appendChild(anchortag);
		}
		othis.moviediv.style.display="block";
	}
	this.displayResultsrecommended=function(movies,critic,avguser,url){
		othis.moviediv2=document.getElementById("Recommenddiv");
		othis.moviediv2.style.height="10%";
		othis.moviediv2.innerHTML="";
		for(i=0;i<movies.length-1;i++)
		{
			anchortag=document.createElement("a");
			anchortag.href="moviedetails.php?&movie="+movies[i];

			//anchortag.addEventListener('click', function(){
    //this.movieoverview(movies[i]);}, false);

			div=document.createElement("div");
			div.style.display="inline-block";
			div.style.width="18.4%";
			if(i!=0){
				div.style.marginLeft="1%";
			}
			imaze=document.createElement("img");

			moviedeets1=document.createElement("p");
			moviedeets2=document.createElement("p");
			moviedeets3=document.createElement("p");
			imaze.src="../SE/movie_images/"+movies[i]+".jpg";
			imaze.onerror = function(){imaze.src="../SE/notavailable.jpg"};
			imaze.style.width="100%";
			imaze.style.height="20vh";

			moviedeets1.textContent=movies[i];
			moviedeets1.setAttribute('style', 'word-wrap: break-word;');
			moviedeets1.style.textAlign="left";
			moviedeets1.style.fontsize="1.5em";
			moviedeets1.style.fontFamily="Arial";

			moviedeets2.textContent="Critic Rating: "+parseFloat(critic[i]);
			moviedeets2.style.textAlign="left";
			moviedeets2.style.fontsize="1.5em";
			moviedeets2.style.fontFamily="Arial";

			moviedeets3.textContent="Avg User Rating: "+(avguser[i]==""?"Not enough ratings":parseFloat(avguser[i]));
			moviedeets3.style.textAlign="left";
			moviedeets3.style.fontsize="1.5em";
			moviedeets3.style.fontFamily="Arial";

			div.appendChild(imaze);
			div.appendChild(moviedeets1);
			div.appendChild(moviedeets2);
			div.appendChild(moviedeets3);
			div.className="display2";
			anchortag.appendChild(div);
			othis.moviediv2.appendChild(anchortag);
		}
		othis.moviediv2.style.display="block";
	}
	this.movieoverview=function(movie)
	{
		//alert(movie);
		othis.xhr.onreadystatechange=othis.showoverview;

		othis.xhr.open("GET","http://localhost/SE/movieoverview.php?movie=" + movie,true);

		othis.xhr.send();
	}
	this.showoverview=function()
	{
		if(othis.xhr.readyState==4 && othis.xhr.status==200)
		{
			response=othis.xhr.responseText;
			var movie=response.split("splithere")[0];
			var movieoverview=response.split("splithere")[1];
			var moviegenres=response.split("splithere")[2];
			var movielanguage=response.split("splithere")[3];
			var releasedate=response.split("splithere")[4];
			var moredetails=response.split("splithere")[5];
			var url=response.split("splithere")[6];
			othis.detailsdiv=document.getElementById("moviedetails");
			othis.movieurl=document.getElementById("watchmovie")

			var moviename=document.createElement('h2');
			moviename.textContent=movie;
			/*var watchbutton=document.getElementById("watchbutton");
			if(url=="Not Available"){
				watchbutton.disabled=true;
				watchbutton.style.background="gray";
				watchbutton.style.color="white";
			}
			else{
				watchbutton.disabled=false;
				movieurl.href=url;
			}*/
			var releasetitle=document.createElement('h3');
			releasetitle.textContent="Release Date:";
			var overviewtitle=document.createElement('h3');
			overviewtitle.textContent="Overview:";
			var homepagetitle=document.createElement('h3');
			homepagetitle.textContent="Further Details:";
			var genretitle=document.createElement('h3');
			genretitle.textContent="Genre(s):";
			var languagetitle=document.createElement('h3');
			languagetitle.textContent="language:";

			var imgdiv=document.createElement("div");
			var img=document.createElement("img");
			img.src="../SE/img/"+movie+".jpg";
			//img.src="../SE/img/"+"img1"+".jpg";
			img.width=300
			img.height=300
			//var dummy1=document.createElement("p");

			//var dummy2=document.createElement("p");

			var release=document.createElement("p");
			//release.setAttribute('style', 'white-space: pre;');
			release.textContent=releasedate;

			var overview=document.createElement("p");
			overview.setAttribute('style', 'white-space: pre;');
			//overview.textContent="Overview : \r\n";
			overview.textContent=movieoverview;
			overview.setAttribute('style', 'word-wrap: break-word;');
			var furtherdetails="";
			if(moredetails=="Not Available")
			{	furtherdetails=document.createElement("p");
				//furtherdetails.setAttribute('style', 'white-space: pre;');
				furtherdetails.textContent=moredetails;
			}
			else
			{
				furtherdetails=document.createElement("a");
				//furtherdetails.setAttribute('style', 'white-space: pre;');
				furtherdetails.href=moredetails;
				furtherdetails.text=moredetails;
			}
			var genre=document.createElement("p");
			//genre.setAttribute('style', 'white-space: pre;');
			genre.textContent=moviegenres;

			var lang=document.createElement("p");
			//lang.setAttribute('style', 'white-space: pre;');
			lang.textContent=movielanguage;

			imgdiv=document.createElement("div");
			detdiv=document.createElement("div");

			imgdiv.appendChild(moviename);
			imgdiv.appendChild(img);
			//othis.detailsdiv.appendChild(dummy1);
			//othis.detailsdiv.appendChild(dummy2);
			detdiv.appendChild(releasetitle);
			detdiv.appendChild(release);
			detdiv.appendChild(overviewtitle);
			detdiv.appendChild(overview);
			detdiv.appendChild(homepagetitle);
			detdiv.appendChild(furtherdetails);
			detdiv.appendChild(genretitle);
			detdiv.appendChild(genre);
			imgdiv.appendChild(languagetitle);
			imgdiv.appendChild(lang);

			detdiv.style.width="35em";
			detdiv.style.paddingLeft="20em";
			imgdiv.style.marginTop="1em";
			imgdiv.style.width="1em";
			detdiv.style.display="inline-block";
			imgdiv.style.display="inline-block";

			othis.detailsdiv.appendChild(imgdiv);
			othis.detailsdiv.appendChild(detdiv);
		}
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
