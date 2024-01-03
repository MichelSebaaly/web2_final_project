 <?php
	session_start();
	$amount = $_POST['amount'];
	$dateTdy = date("Y-m-d");
	$error = false;
	
	$status = $_POST['status'];
	// $dateTdy = date("Y-m-d");
 
	$con = mysqli_connect("localhost","root","","web3") or die ("unable to connect");
	$queryOrderCount = "SELECT count(id) as numb FROM order_details";
	$resOrderCount = mysqli_query($con,$queryOrderCount);
	$resOrderFetchCount = mysqli_fetch_assoc($resOrderCount);
	
	if($resOrderFetchCount['numb'] == 0){
		$orderId = 1;
		echo "count order details = 1";
		
	}else{
		
		$queryOrderMax = "SELECT MAX(id) as max FROM order_details";
		$resOrderMax = mysqli_query($con,$queryOrderMax);
		$resOrderFetchMax = mysqli_fetch_assoc($resOrderMax);
		$orderId = $resOrderFetchMax['max'] + 1;
		echo "max id = ".$orderId;
	}
	
	if(isset($_POST['code'])){
		if(!empty($_POST['code'])){
			$code = $_POST['code'];
			$queryInsertPaym = "INSERT INTO payment_details VALUES (null,'".$orderId."','".$amount."','".$code."','".$status."','".$dateTdy."')";
		}else{
			$queryInsertPaym = "INSERT INTO payment_details VALUES (null,'".$orderId."','".$amount."',null,'".$status."','".$dateTdy."')";
		}
	}	
	
	$resInsrtPaym = mysqli_query($con,$queryInsertPaym);
	if($resInsrtPaym){
		echo $_SESSION['userId']."<br>";
		$lastPaymentId = mysqli_insert_id($con);
	}else{
		echo "error with payment details";
		$error = true;
	}
	
	$queryGetAddressOfUser = "SELECT id FROM user_address WHERE user_id = '".$_SESSION['userId']."'";
	$resGetAddress = mysqli_query($con,$queryGetAddressOfUser);
		$fetchGetAddress = mysqli_fetch_assoc($resGetAddress);
		$addressIdUser = $fetchGetAddress['id'];
	
	$queryInsertOrderDetails = "INSERT INTO order_details VALUES (null,'".$_SESSION['userId']."','".$_SESSION['totalPrice']."','".$lastPaymentId."','".$dateTdy."','".$addressIdUser."')";
	$resInsertOrderDetails = mysqli_query($con,$queryInsertOrderDetails);
	if($resInsertOrderDetails){
		// echo "1 row inserted to order details !";
		$lastOrderId = mysqli_insert_id($con);
	}else{
		echo "error in order details !";
		$error = true;
	}
	
	for($i = 0 ; $i < count($_SESSION['AllMyProducts']) ; $i++){
		$queryInsertOrderItems = "INSERT INTO order_items VALUES (null,'".$lastOrderId."','".$_SESSION['AllMyProducts'][$i]."','".$_SESSION['quantityOfEachProduct'][$i]."','".$dateTdy."')";
		$resInsertOrdItems = mysqli_query($con,$queryInsertOrderItems);
		if(!$resInsertOrdItems){
			$error = true;
		}else{
			$queryRemoveQuantityStck = "UPDATE stock SET Quantity = Quantity - '".$_SESSION['quantityOfEachProduct'][$i]."',Modified_at = '".$dateTdy."' WHERE product_id = '".$_SESSION['AllMyProducts'][$i]."'";
			$resRemQttStck = mysqli_query($con,$queryRemoveQuantityStck);
			if($resRemQttStck){
				echo "quantity from stock removed !";
			}else{
				echo "error with stock";
				$error = true;
			}
		}
	}
	
	if($error){
			echo "cant add to products items";
		}else{
			echo "products items has been added !";
			$_SESSION['AllMyProducts'] = array();
			$_SESSION['DesignOfMyProducts'] = "";
			$_SESSION['quantityOfEachProduct'] = array();
			$_SESSION['totalPrice'] = 0;
			$_SESSION['priceOfEachProduct'] = array();
		}
		
	mysqli_close($con);
	exit();
 ?>