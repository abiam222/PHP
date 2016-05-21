<?php

	session_start();

	if( !isset($_SESSION['logged_in']) ) {
		header("Location: login.php");
   	}

	include("db_connect.php");
	include('templates/header.html');

	$submitted = false;
	$username = '';
	//$_SESSION['account'] = 'h';

	$select_query = "SELECT * FROM USERS";
	$select_result = $mysqli->query($select_query);

	if ($mysqli->error) {
				print "Select query error!  Message: ".$mysqli->error;
	}

	if ( ($_SERVER['REQUEST_METHOD'] == 'POST') && ($_POST['form1'] == true) ) { //isset for post

			$_SESSION['account'] = $_POST['username'];
			$username = $_POST['username'];
		//	 echo $username . "AP ";
			$submitted = true;
	}

	//	$_SESSION['account'] = $_POST['username'];

	if ( ($_SERVER['REQUEST_METHOD'] == 'POST') && ($_POST['form2'] == true) ) {
			if ($_POST['accOptions'] == 'open') {
					$query = "UPDATE USERS SET status = 'OPEN' WHERE username='$_SESSION[account]'  ";
					$result = $mysqli->query($query);
					$submitted = false;
			  	print "The account has been set to open";
			} else if ($_POST['accOptions'] == 'locked') {
					$query = "UPDATE USERS SET status = 'LOCKED' WHERE username='$_SESSION[account]'  ";
					$result = $mysqli->query($query);
					$submitted = false;
					print "The account has been set to lock";
			} else if ($_POST['accOptions'] == 'admin') {
				$query = "UPDATE USERS SET admin = 'Y' WHERE username='$_SESSION[account]'  ";
				$result = $mysqli->query($query);
				$submitted = false;
				print "The account is now in administrator mode";
			} else if ($_POST['accOptions'] == 'delete') {
				$query = "DELETE FROM USERS WHERE username = '$_SESSION[account]'   ";
				$result = $mysqli->query($query);
				//$submitted = false;
				print "The account has been deleted";

				//REMOVE FILES
				$search_dir = "../users/{$_SESSION['account']}";
				$contents = scandir($search_dir);
				foreach($contents as $fileInfo) {
			//	if ( (is_file($search_dir . '/' . $fileInfo)) ) {
					if (!unlink($search_dir . '/' . $fileInfo)) {
  					//echo ("Error deleting $fileInfo ");
						//print_r( error_get_last() );
  				} else {
  						echo ("Deleted $fileInfo ");
  					}
					}
			//	}

				//REMOVE DIRECTORY
				if (!rmdir($search_dir)) {
					echo ("Error deleting $search_dir ");
					//print_r( error_get_last() );
				} else {
						echo ("Deleted $search_dir ");
					}
				//$unlink($filename); Loop through files and do this
				//then remove subdirectory using rmdir($subdir)
				$submitted = false;
			}
	}

?>

<section>
	<form action="" method="post">
		<? if (!$submitted) {    //
				echo "<fieldset><h1>Administrator Functions</h1>";
			  echo "<label>Username:</label>";
				echo "<select name='username'>";  while($row = $select_result->fetch_object()) {
				  if ( $row->admin == 'N' ){ echo "<option value='{$row->username}'>" . $row->username . "</option>";	}
			} echo "</select>";
				echo "<br/><input type='submit' name='form1' value='Submit'></fieldset>";
		} ?>
	</form>
	<form action="" method="post">
		<? if ($submitted) {
			echo "<fieldset><h1>Administrator Functions</h1>";
			echo "<label>Username:</label>" . $_POST['username'];
			echo "<fieldset><h2>Account Options:</h2>";
			echo "<div><input type='radio' name='accOptions' value='open'>Open<br>";
			echo "<input type='radio' name='accOptions' value='locked'>Locked<br>";
			echo "<input type='radio' name='accOptions' value='admin'>Grant Administrator Role<br>";
			echo "<input type='radio' name='accOptions' value='delete'>Delete This Account";
			echo "</div><input type='submit' name='form2' value='Submit'></fieldset>";
			echo "</fieldset>";
		}	?>
	</form>
</section>

 <?php //Return to PHP
 	include('templates/footer.html');
 	//Include the footer
 ?>
