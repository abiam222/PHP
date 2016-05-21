<?php
	
	session_start();

	if( !isset($_SESSION['logged_in']) ) {
		header("Location: login.php");
   	}

	include('templates/header.html');

	
?>
<div class="main">
 <h2>Welcome to the Abiam Velazquez Fan Club</h2>
 	<p>This site is a built with templates that shows Books, Stories, and Quotes.  You can send the club any messages
 	if you would like by clicking the contact link and entering your message. </p>
		<h2>Welcome</h2> 
			<p>This is the A.V. Fan Club where all the best computer scientist, mathmaticians, physicist, and statiscians
			come together to explore the wonderful world of computing and mathematics.  You can read books, other users
			stories, even upload your own stories, and read wonderful quotes produced by quality poets. </p>
 </div>
 <?php //Return to PHP
 	include('templates/footer.html');
 	//Include the footer
 ?>



