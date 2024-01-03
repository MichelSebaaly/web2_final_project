  <?php
	session_start();
		if(isset($_POST['orderId'])){
			if(!empty($_POST['orderId'])){
				$_SESSION['ordIdSelected'] = $_POST['orderId'];
				// echo $_SESSION['prodIdSelected'];
				echo "1";
			}else{
				echo "0";
			}
		}else{
			echo "0";
		}
 ?>
 