 <?php
	session_start();
		if(isset($_POST['productId'])){
			if(!empty($_POST['productId'])){
				$_SESSION['prodIdSelected'] = $_POST['productId'];
				echo "1";
			}else{
				echo "0";
			}
		}else{
			echo "0";
		}
 ?>
 