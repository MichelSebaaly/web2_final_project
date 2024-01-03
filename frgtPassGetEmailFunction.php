<?php
	$userEmailName = $_POST['userNameEmail'];
	$con = mysqli_connect("localhost","root","","web3") or die ("unable to connect");
	
	if(strpos($userEmailName,"@gmail.com")){
		$query = "SELECT email FROM users WHERE email = '".$userEmailName."'";
	}else{
		$query = "SELECT email FROM users WHERE user_name = '".$userEmailName."'";
	}
	
	$res = mysqli_query($con,$query);
	if(mysqli_num_rows($res)>0){
		$fetch = mysqli_fetch_assoc($res);
		echo $fetch['email'];
	}else{
		echo "error";
	}
	
	mysqli_close($con);
	exit();
 ?>