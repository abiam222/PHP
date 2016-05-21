<?
    session_start();

	if(isset($_SESSION['logged_in'])) {
        unset($_SESSION['logged_in']);
    }

	if(isset($_SESSION['test'])) {
        unset($_SESSION['test']);
    }

  if(isset($_SESSION['locked'])) {
      unset($_SESSION['locked']);
  }

    header("Location: login.php");

?>
