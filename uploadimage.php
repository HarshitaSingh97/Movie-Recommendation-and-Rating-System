<?php
	//extract whatever the client sent.
  //header( "Content-type: image/png" );
	$username=$_POST['usr'];
	$data=$_POST['imagesrc'];
	file_put_contents('imglla.jpg', (preg_replace('#^data:image/\w+;base64,#i', '', $data)));
	echo preg_replace('#^data:image/\w+;base64,#i', '', $data);
	/*$target_dir = "../SE/usericon/";
	 $username=$_POST['username'];
	 if (isset($_FILES["file"]["name"])) {
	     $name = $_FILES["upload"]["name"];
	     $tmp_name = $_FILES['upload']['tmp_name'];
	     $error = $_FILES['upload']['error'];

	     if (!empty($name)) {
	         $location = "../SE/usericon/";

	         if  (move_uploaded_file($tmp_name, $location.$name)){
	             echo 'Uploaded';
	         }

	     } else {
	         echo 'please choose a file';
	     }
	 }


	 header("Location: yo.php");
	*/

?>
