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

  if ( $_SERVER['REQUEST_METHOD']  == 'POST' ) {

    //VALIDATE AND SECURE FORM DATA
    $problem = FALSE;

    if( empty($_POST['title']) || empty($_POST['entry']) ) {
      print '<p style="color: red;">Please submit both a title and an entry.</p>';
      $problem = TRUE;
    }

    if (!$problem) {

      //IS FAVORITE CHECKED
      if ( isset($_POST['favorite'])) {
         $checked = 'Y';
      } else {
         $checked = 'N';
      }
      //DEFINE query
      $insert_query = "INSERT INTO QUOTES(text,author, favorite, date_entered) VALUES ('$_POST[entry]','$_POST[title]', '$checked', NOW())";
      $insert_result = $mysqli->query($insert_query);

      if($mysqli->error) {
          print "Select query error!  Message: ".$mysqli->error;
      }

      print '<p>Thank You, your quote has been posted</p>';
    }
  }
?>
<form action="" method="post">
  <fieldset>
    <p>Author: <input type="text" name="title" size="40" maxsize="100" /></p>
    <p>Entry Text: <textarea name="entry" cols="40" rows="5"></textarea></p>
    <input type="checkbox" name="favorite"/><label>Check to add as favorite</label><br>
    <input type="submit" name="submit" value="Post This Entry!" />
    <input type="hidden" name="submitted" value="true" />
  </fieldset>
</form>

 <?php //Return to PHP
 	include('templates/footer.html');
 	//Include the footer
 ?>
