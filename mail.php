
<?php

require 'vendor/autoload.php';

use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseACL;
use Parse\ParsePush;
use Parse\ParseUser;
use Parse\ParseInstallation;
use Parse\ParseException;
use Parse\ParseAnalytics;
use Parse\ParseFile;
use Parse\ParseCloud;
use Parse\ParseClient;

ParseClient::initialize( 'N8E0v1gynQwPXKTy80p8XMMP9IUrw2T8hesIGZBw', 
                         'm8FArmh89MFoqwGXkCfYGJ7BzfWC4cogQdy5At6Z',
                         'mrwL1Jw0X1WzTPrzIdc6KvmStNAZobqH14h0ZeNw');


/*$user = new ParseUser();
$user->set('username','my name');
$user->set('email','email@example.com');
*/



if(isset($_POST['submit'])){

	$name = $_POST['name'];
	$email = $_POST['email'];
	$message = $_POST['message'];
	$msg .=  $email . '; ' .$name . '; '  .$message;

	mail("abiam222@gmail.com", "KoK Message" ,$msg);

} else{
	echo "this works";
}


?>