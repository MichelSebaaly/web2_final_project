 <?php
	session_start();
	$addressLine = $_POST['addressLine'];
	$city = $_POST['city'];
	$nearTo = $_POST['nearTo'];
	$country = $_POST['country'];
	
	$con = mysqli_connect("localhost","root","","web3") or die ("unable to connect");
	
	$queryCheckBef = "SELECT * FROM user_address WHERE user_id = '".$_SESSION['userId']."'";
	$resCheckBef = mysqli_query($con,$queryCheckBef);
	$fetchCheckBef = mysqli_fetch_assoc($resCheckBef);
	if(($fetchCheckBef['address_line']==$addressLine)&&($fetchCheckBef['near_to']==$nearTo)&&($fetchCheckBef['city']==$city)){
		echo "errorName";
	}else{
		$query = "UPDATE user_address SET address_line = '".$addressLine."',city = '".$city."',near_to = '".$nearTo."',country = '".$country."' WHERE user_id = '".$_SESSION['userId']."'";
		$res = mysqli_query($con,$query);
		if(!$res){
			echo "error";
		}else{
			echo "true";
		}
	}
	
	
	mysqli_close($con);
	exit();
 ?>