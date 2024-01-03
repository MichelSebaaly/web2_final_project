<?php
	session_start();
	$con = mysqli_connect("localhost","root","","web3") or die ("unable to connect");
	$dateTdy = date("Y-m-d");
	if(isset($_POST['prodId'])){
		$prodId = $_POST['prodId'];
	}
	$queryGetImage = "SELECT image FROM products WHERE id = '".$prodId."'";
	$resImage = mysqli_query($con,$queryGetImage);
	$fetchImage = mysqli_fetch_assoc($resImage);
	$imageToDel = "images/".$fetchImage['image'];
	
	$queryStck = "UPDATE stock SET archived_at = '".$dateTdy."' WHERE product_id = '".$prodId."'";
	$resStck = mysqli_query($con,$queryStck);
	
	$query = "UPDATE products SET archived_at = '".$dateTdy."' WHERE id = '".$prodId."'";
	$res = mysqli_query($con,$query);
	if($res){
		
		
		// if((unlink($imageToDel))&&($resStck)){
			echo "true";
			// unset($_SESSION['prodIdSelected']);
		// }else{
			// echo "false";
		// }
	}else{
		echo "false";
	}
	mysqli_close($con);
 ?> 