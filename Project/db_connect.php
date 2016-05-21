<?
$mysqli = new mysqli('localhost', 'root', 'root', 'fanclub');
	if($mysqli->error) {
		print "Error connecting! Message:".$mysqli->error;
	}
?>