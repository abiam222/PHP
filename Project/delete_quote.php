<?php

	session_start();

	if( !isset($_SESSION['logged_in']) ) {
		header("Location: login.php");
   	}

  include("db_connect.php");
	include('templates/header.html');


  if ( isset($_GET['id']) && is_numeric($_GET['id']) ) {

      //DEFINE QUERY
      $select_query = "SELECT text,author FROM QUOTES WHERE id='$_GET[id]' ";
      $select_result = $mysqli->query($select_query);
      $row = $select_result->fetch_object();

   //SHOW DELETE BUTTON
    if($mysqli->error) {
        print "Select query error!  Message: ".$mysqli->error;
    } else {
          print '<form action="" method="post">
                    <p>Are you sure you want to delete this entry?</p>
                    <p><h3>' . $row->author . '</h3>' .
                    $row->text . '<br/>
                      <input type="submit" name="submit" value="Delete this Entry!" /></p>
                      </form>';
      }
  }

  if ( $_SERVER['REQUEST_METHOD']  == 'POST' ) {
    $delete_query = "DELETE FROM QUOTES WHERE id='$_GET[id]' LIMIT 1 ";
    $delete_result = $mysqli->query($delete_query);

    if($mysqli->error) {
        print "Select query error!  Message: ".$mysqli->error;
    } else {
        print '<p>The blog entry has been deleted</p>';
    }
  }

  //mysql_Close(db)
?>

 <?php //Return to PHP
 	include('templates/footer.html');
 	//Include the footer
 ?>
