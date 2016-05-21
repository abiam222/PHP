<?php

	session_start();

	if( !isset($_SESSION['logged_in']) ) {
		header("Location: login.php");
   	}

  include("db_connect.php");
	include('templates/header.html');

 print "Your account is locked!! Please talk to the administrator to unlock you account";

?>

 <?php //Return to PHP
 	include('templates/footer.html');
 	//Include the footer
 ?>
