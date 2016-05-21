<?php
	
	session_start();

	if( !isset($_SESSION['logged_in']) ) {
		header("Location: login.php");
   	}

	include('templates/header.html');

	if ( $_SERVER['REQUEST_METHOD'] == 'POST') {

		if (move_uploaded_file($_FILES['the_file']['tmp_name'], "../users/{$_SESSION['username']}/{$_FILES["the_file"]["name"]}")) {
			print "<p>Your file has been uploaded. Click on the Stories section to view your stories</p>";
		}  else {
		// 	//problem
		 	print "<p>Your file could not be uploaded because: ";

			//print message
			switch($_FILES["the_file"]["error"]) {
				case 1:
					print "The file exceeds the upload_max_filesize setting in php.in";
					break;
				case 2:
					print "The file exceeds the MAX_FILE_SIZE setting in the HTML form";
					break;
				case 3:
					print "The file was only partially uploaded";
					break;
				case 4:
					print "No file was uploaded";
					break;
				case 6:
					print "The temporary folder does not exist.";
					break;
				default:
					print "Something unforeseen happened";
					break;
			}
			print "</p>"; //complete paragraph
		 } //end of move_uploaded_file() IF
	} //End of submission IF
//LEAVE php and display the form
	

?>
<section class="center">
	<form action="upload.php" enctype="multipart/form-data" method="post">
		<p>Upload a file using this form:</p>
		<input type="hidden" name="MAX_FILE_SIZE" value="300000" />
		<p><input type="file" name="the_file" /></p>
		<p><input type="submit" name="submit" value="Upload This File" /></p>
	</form>
</section>

 <?php //Return to PHP
 	include('templates/footer.html');
 	//Include the footer
 ?>



