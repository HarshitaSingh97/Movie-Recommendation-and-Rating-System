function profile(){
  //var b64toBlob = require('b64-to-blob');
  othis=this;
  this.img=null;
  this.save1=null;
  this.save2=null;
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
  this.first_name="";
  this.last_name="";
  this.phone="";
  this.mobile="";
  this.email_id="";
  this.loc="";
	this.xhr= new XMLHttpRequest();
  this.changephoto = function(){
    //readURL(this);
    //alert("yhjfhjhjshjh");
	
    var filename=document.getElementById("upload");
    var freader=new FileReader();
    freader.readAsDataURL(filename.files[0])
    freader.onloadend=function(event){
      othis.img=document.getElementById("avatar");
      othis.img.src=event.target.result;
	  
	//alert((othis.img.src).length)
	othis.xhr.onreadystatechange=othis.uploaded;
    //alert(othis.first_name);
	othis.xhr.open("POST","http://localhost/SE/uploadimage.php",true);
	othis.xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	othis.xhr.send("usr="+document.getElementById('username').textContent+"&imagesrc="+othis.img.src);
	/*var canvas  =  document.getElementById( 'myCanvas' ); 
	canvas.setAttribute( "width", img.width );
	canvas.setAttribute( "height", img.height );

	var context  =  canvas.getContext( '2d' );
	context.drawImage( img, 0, 0 );
	canvas.style.width = "100%"; 
	var data = canvas.toDataURL("image/jpg");
	loc="../SE/usericon/"+username+".jpg";
	localStorage.setItem( 'data', data );
	*/
      //alert("yah");
      //alert(othis.img.src);
      //var encoded=(othis.img.src).replace(/^data:image\/[a-z]+;base64,/, "");
      //alert(encoded);
      //var decode=base64_decode(encoded);
      //var newicon=URL.createObjectURL(new Blob([othis.img.src] , {type:'text/plain'}));
      //alert("yus");
      //var contentType = 'image/jpg';
      //var encodedData = str_replace(' ','+',othis.img.src);
      //var imgData = substr(othis.img.src, 1+strrpos(othis.img.src, ','));
      //var blob = b64toBlob(imgData, contentType);
      //alert(blob);
      /*othis.xhr.onreadystatechange=othis.displayicon;
      othis.xhr.open("POST","http://localhost/SE/uploadimage.php",true);
      othis.xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

      var params="username=" + document.getElementById('username').textContent + "&usericon=" + encoded;
      //alert((othis.img.src).length);
      othis.xhr.send(params);*/

    }
  }
  this.uploaded = function(){
	  if(othis.xhr.readyState==4 && othis.xhr.status==200)
    {
      //alert(othis.xhr.responseText);
	}
  }
  /*this.displayicon = function(){
    if(othis.xhr.readyState==4 && othis.xhr.status==200)
		{
			response=othis.xhr.responseText;
      alert(response);
      //do nothing;
		}
  }*/
  this.displaygenres =function(){
    //alert("here");
    
    othis.xhr.onreadystatechange=othis.showgenres;
    othis.xhr.open("GET","http://localhost/SE/fetchgenres.php?username="+document.getElementById('username').textContent,true);
    othis.xhr.send();
  }
  this.showgenres =function(){
    if(othis.xhr.readyState==4 && othis.xhr.status==200)
    {
      response=othis.xhr.responseText;
      //alert(response);
      //alert(response);

      var splitting=response.split("analyze");
      var genres=splitting[0].split("lang")[0].split(",");
      var languages=splitting[0].split("lang")[1].split(",");
      var analysis=JSON.parse(splitting[1]);
      var analysis2=JSON.parse(splitting[2]);
      //alert(Object.keys(analysis));
      var chart = new CanvasJS.Chart("chartContainer", {
    		title:{
    			text: "Monthly Expenditure"
    		},
        axisY:{
          interval: 50,
        },
    		data: [
    		{
    			// Change type to "doughnut", "line", "splineArea", etc.
    			type: "column",
    			dataPoints: analysis

    		}
    		]
    	});

      var chart2 = new CanvasJS.Chart("chartContainer2", {
        //exportEnabled: true,
	      animationEnabled: true,
        title:{
    			text: "Genres"
    		},
        data: [
    		{
    			// Change type to "doughnut", "line", "splineArea", etc.
          type: "pie",
      		dataPoints: analysis2

    		}
    		]
    	});
      chart.render();

      chart2.render();
      var i=0;
      for (i=0;i<genres.length-1;i++){
        var gen=document.getElementById(genres[i]);
        try{
          gen.checked=true;
        }
        catch(e){
          //alert(e);
        }

      }
      for (i=0;i<languages.length-1;i++){
        var lang=document.getElementById(languages[i]);
        try{
        lang.checked=true;
        }
        catch(e){
          //alert(e);
        }
      }
    }
  }
  /*this.explodePie =function(e) {
	if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
	} else {
		e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
	}
	e.chart.render();

}*/
  this.sethomedetails =function (){
    othis.first_name=document.getElementById("first_name").value;
    othis.last_name=document.getElementById("last_name").value;
    othis.phone=document.getElementById("phone").value;
    othis.mobile=document.getElementById("mobile").value;
    othis.email_id=document.getElementById("email").value;
    othis.location=document.getElementById("location").value;
    othis.xhr.onreadystatechange=othis.savedhomedetails;
    //alert(othis.first_name);
		othis.xhr.open("GET","http://localhost/SE/savehomedetails.php?user_name=" + document.getElementById('username').textContent + "&first_name="+othis.first_name+"&last_name="+othis.last_name+"&email_id="+othis.email_id+"&phone_number="+othis.phone+"&mobile="+othis.mobile+"&location="+othis.location,true);

		othis.xhr.send();
    //first_name.value="blah";
    /*
    <?php $newname?>=first_name.value;
    <?php $newphone_number?>=phone.value;
    <?php $newemail_id?>=email_id.value;*/
  }
  this.savedhomedetails =function(){
    if(othis.xhr.readyState==4 && othis.xhr.status==200)
		{
      response=othis.xhr.responseText;
      alert("Details Saved");
      //var disable=document.getElementById("save");
      //disable.disabled = true;
    }
  }
  this.savepreference = function(){
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

		othis.xhr.onreadystatechange=othis.savedpreferences;
    //alert("here");
		othis.xhr.open("GET","http://localhost/SE/savepreferences.php?user_name=" + document.getElementById('username').textContent + "&genres="+othis.genres+"&languages="+othis.languages,true);

		othis.xhr.send();

  }
  this.savedpreferences= function(){
    //if(othis.xhr.readyState==4 && othis.xhr.status==200)
		//{
      response=othis.xhr.responseText;
      alert("preferences saved");
    //}
  }
}
obj=new profile();
