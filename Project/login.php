<?php
	session_start();
	ob_start();

	include("db_connect.php");
	include('templates/header.html');

	//$file = '../users/users.txt';

	if ( ($_SERVER['REQUEST_METHOD'] == 'POST') && (!isset($_SESSION['logged_in'])) ) {

		$loggin_error = false;
		//ini_set('auto_detec_line_endings', 1);

		//SELECT USERS DATABASE INFORMATION
		$select_query = "SELECT * FROM USERS";
        $select_result = $mysqli->query($select_query);
        if($mysqli->error) {
            print "Select query error!  Message: ".$mysqli->error;
        }

        //CHECK DATABASE TO MAKE SURE USERNAME AND PASSWORDS MATCH BEFORE LOGGIN IN
         while($row = $select_result->fetch_object()) {
            if ((($_POST['username']) == ($row->username)) && (md5($_POST['password']) == ($row->password))) {
            		$_SESSION['logged_in'] = true;
								$_SESSION['username'] = $_POST['username'];

								if ($row->admin == 'Y') {
									$_SESSION['admin'] = true;
								} else {
									$_SESSION['admin'] = false;
								}

								if ($row->status == 'OPEN') {
									$_SESSION['locked'] = false;
								} else {
									$_SESSION['locked'] = true;
								}

								$loggin_error = false;
								break;
             } else {
             	$loggin_error = true;
             }
		//$fp = fopen($file, 'rb');
		// while ( $line = fgetcsv($fp, 200, "\t") ) {
		// 	if (($line[0] == $_POST['username'] AND ($line[1] == md5(trim($_POST['password']))))) {
		// 			$_SESSION['logged_in'] = true;
		// 			$_SESSION['username'] = $_POST['username'];
		// 	} else {
  // 				$loggin_error = true;
  // 			  }
			}//end while
	}//end if

	//fclose($fp);

	if ( $_SESSION['locked'] == true) {
		  header("Location: locked.php");
	} else if ( isset($_SESSION['logged_in']) ) {
			header("Location: index.php");
		}

//IDK WHY THE TOP WORKS AND THIS BOTTOM DOESN'T
	// if ( isset($_SESSION['logged_in'])  ) {
  //       header("Location: index.php");
	//  }
	//  else if ( $_SESSION['locked'] == true) {
	//  			header("Location: locked.php");
	//  }

?>
<section class="center">
	<form method="post" action="">
	 	<fieldset>
	 		<h1>Login Form</h1>
	 			<label>Please Login to access certain features</label><br/>
	 			<label>Username:</label>
	 			<input type="text" name="username" placeholder="Username"><br/>
	 			<label>Password:</label>
	 			<input type="password" name="password" placeholder="Password"><br/>
	 			<input type="submit" name="login" value="Login"><br/>
	 			<? if ($loggin_error) { print "<label class='error'>Error: Either your password or username is incorrect</label>"; } ?>
	 	</fieldset>
	 </form>
</section>
<?php //Return to PHP
 	include('templates/footer.html');
 	//Include the footer
?>
