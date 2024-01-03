 <?php
	session_start();
	// $userId = $_POST['userId'];
	if(isset($_POST['userId'])){
		if(!empty($_POST['userId'])){
			$_SESSION['adminUserId'] = $_POST['userId'];
			echo "1";
			// echo $_SESSION['adminUserId'];
		}else{
			echo "0";
		}
	}else{
		echo "0";
	}
	
	
	
 ?>