<?
$mysqli = new mysqli('localhost', 'root', 'root', 'CMS');
	if($mysqli->error) {
		print "Error connecting! Message:".$mysqli->error;
	}
?>