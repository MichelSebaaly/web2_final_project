 <?php 
	session_start();
	$addressLine = $_POST['addressLine'];
	$city = $_POST['city'];
	$nearTo = $_POST['nearTo'];
	$country = $_POST['country'];
	
	$con = mysqli_connect("localhost","root","","web3") or die ("unable to connect");
	$query = "INSERT INTO user_address VALUES (null,'".$_SESSION['userId']."','".$addressLine."','".$city."','".$nearTo."','".$country."')";
	$res = mysqli_query($con,$query);
	if($res){
		echo "Operation Done ! ";
	}else{
		echo "Somethin went wrong ! ";
	}
	
	mysqli_close($con);
 ?>