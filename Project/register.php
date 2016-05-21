<?
    session_start();
    ob_start();

    include("db_connect.php");
    include('templates/header.html');


    $dir = '../users/';
    $file = $dir . 'users.txt';
    $contents = scandir($dir);
    $file = "../users/users.txt";

    //THE USER SUBMITS THE REGISTER POST
    if ( $_SERVER['REQUEST_METHOD']  == 'POST'  && (!isset($_SESSION['logged_in'])) ) {

        if ( (!empty($_POST['username'])) && (!empty($_POST['password'])) ) {

            //NO PROBLEMS
            $problem = false;

            //CHECK IF BOTH PASSWORDS MATCH
            if ($_POST['password'] != $_POST['password2']) {
                $problem = true;
                print '<p class="error">Your passwords did not match, please try again!!!</p>';
            }


            //CHECK IF USERSNAME THE USER ENTER HAS ALREADY BEEN CREATED
            $select_query = "SELECT * FROM USERS";
            $select_result = $mysqli->query($select_query);

            if($mysqli->error) {
                print "Select query error!  Message: ".$mysqli->error;
            }

            while($row = $select_result->fetch_object()) {
                if ((($_POST['username']) == ($row->username))) {
                    $problem = true;
                    print '<p>The username has already been taken. Please try another username</p>';
                    break;
                }
            }
            // foreach ($contents as $item) { //same as above for the file
            //    if($item == $_POST['username']) {
            //         $problem = true;
            //         print '<p>The username has already been taken. Please try another username</p>';
            //    }
            // }

            //IF USERNAME HASN"T BEEN TAKEN AND PASSWORDS MATCH, REGISTER USER
            if (!$problem) {

                $insert_query = "INSERT INTO USERS(username, password, status, admin) VALUES ('$_POST[username]', md5('$_POST[password]'), 'OPEN', 'N')";
                $insert_result = $mysqli->query($insert_query);

                if(is_writable($file)) { //confirm that the file is writable
                    //echo "here";
                    $data = $_POST['username'] . "\t" . md5(trim($_POST['password']))
                    . "\t" . PHP_EOL;

                    file_put_contents($file, $data, FILE_APPEND | LOCK_EX ); //write data
                    mkdir($dir . $_POST['username']);
                    print '<p>You are now registered!</p>';//this isn't working
                }
                $_SESSION['logged_in'] = true;
                $_SESSION['locked'] = false;
                $_SESSION['admin'] = false;
            }
        }
    }

     if ( isset($_SESSION['logged_in']) ) {
        header("Location: index.php");
    }

?>
<section class="center">
    <form method="post" action="">
        <fieldset>
            <h1>Register Form</h1>
                <label>Username:</label>
                <input type="text" name="username" placeholder="Username"><br/>
                <label>Password:</label>
                <input type="password" name="password" placeholder="Password"><br/>
                <label>Confirm Password:</label>
                <input type="password" name="password2" placeholder="Password"><br/>
                <input type="submit" value="Register"><br/>
        </fieldset>
     </form>
</section>


 <?php //Return to PHP
    include('templates/footer.html');
    //Include the footer
 ?>
