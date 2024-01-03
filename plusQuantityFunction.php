 <?php
	$quantity = $_POST['quantity'];
	$prodId = $_POST['productId'];
	
	$con = mysqli_connect("localhost","root","","web3") or die ("unable to connect");
	$queryCheck = "SELECT Quantity FROM stock WHERE product_id = '".$prodId."'";
	$resltCheck = mysqli_query($con,$queryCheck);
	$fetchCheck = mysqli_fetch_assoc($resltCheck);
	
	if($quantity >= $fetchCheck['Quantity']){
		echo "false";
		return;
	}else{
		echo "true";
		return;
	}
	
	mysqli_close($con);
	exit();
	
 ?>