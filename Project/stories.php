<?php
	
	session_start();

	if( !isset($_SESSION['logged_in']) ) {
		header("Location: login.php");
   	}

	include('templates/header.html');
	print '<section>';
	
	$search_dir = "../users/{$_SESSION['username']}";
	$contents = scandir($search_dir);

	//list the directories first...
	//print  acaption and start a list
	// print '<h2>Directories</h2>
	// 	<ul>';
	// 	foreach ($contents as $item) {
	// 		if ((is_dir($search_dir . '/' . $item)) AND (substr($item, 0, 1) != '.') ) {
	// 			print "<li>$item</li>\n";
	// 		}
	// 	}

	// 	print '</ul>'; //close the list

		//create a table header:
		print '<hr /><h2>Stories Uploaded</h2>
			<table cellpadding="2" cellspacing="2" align="left">
			<tr>
			<td>Name</td>
			<td>Last Modified</td>
			</tr>';

			//List the files:
		foreach ($contents as $item) {
			if ( (is_file($search_dir . '/' . $item)) AND (substr($item, 0, 1) != '.') ) {
				//get the file size
				//$fs = filesize($search_dir . '/' . $item);
				//get the files modification date
				$lm = date('F j, Y', filemtime($search_dir . '/' . $item));

				//print the information
				print "<tr>
				<td><a>$item</a></td>
				<td>$lm</td>
				</tr>\n";
			} //close the IF
		}//close the FOREACH

		print '</table>';
		print '</section>';

	
?>

 <?php //Return to PHP
 	//include('templates/footer.html');
 	//Include the footer
 ?>



