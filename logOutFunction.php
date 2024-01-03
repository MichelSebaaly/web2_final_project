 <?php
	session_start();
	if ((isset($_SESSION['email']))) {
		unset($_SESSION['userId']);
		unset($_SESSION['email']);
		unset($_SESSION['AllMyProducts']);
		unset($_SESSION['totalPrice']);
		unset($_SESSION['userName']);
	} else {
		unset($_SESSION['userId']);
		unset($_SESSION['userName']);
		unset($_SESSION['AllMyProducts']);
		unset($_SESSION['totalPrice']);
	}
	session_destroy();
	header("Location:homePage.php");
	?>