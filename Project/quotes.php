<?php

	session_start();

	if( !isset($_SESSION['logged_in']) ) {
		header("Location: login.php");
   	}

  include("db_connect.php");
	include('templates/header.html');

  //if logged in show everything
  $select_query = "SELECT * FROM QUOTES";
  $select_result = $mysqli->query($select_query);

  if($mysqli->error) {
      print "Select query error!  Message: ".$mysqli->error;
  }

  print '<section><h1>Quotes</h1>';

  if ( $_SESSION['logged_in'] ) {
    print '<a href="add_quote.php">Add New Quote</a><br><br>';
  }

  while($row = $select_result->fetch_object()) {
      print '<div>' . $row->text;//$row->id
      print '<br><br><b>' . $row->author . '</b><br>';

      if ( $_SESSION['logged_in'] ) {
        print "<a href='update_quote.php?id={$row->id}'> Edit </a>";
        print "<a href='delete_quote.php?id={$row->id}'> Delete </a>";
      }
      print '</div><hr>';
  }

  print '</section>';

  //if not logged in only show quotes (dont do separate because redundancy)


?>

 <?php //Return to PHP
 	include('templates/footer.html');
 	//Include the footer
 ?>
