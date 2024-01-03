 <?php
	$userName = $_POST['userName'];
	$userEmail = $_POST['userEmail'];
	$password = $_POST['password'];
	$phoneNumb = $_POST['phoneNumber'];
	$addressLine = $_POST['addressLine'];
	$userCity = $_POST['userCity'];
	$userNearTo = $_POST['userNearTo'];
	$userCountry = $_POST['userCountry'];
	$dateTdy = date("Y-m-d");
	$newUserAddressId = 0;
	$error = false;
	
	$con = mysqli_connect("localhost","root","","web3") or die ("unable to connect");
	
	$queryCheckUserBef = "SELECT * FROM users WHERE ((user_name = '".$userName."' || email = '".$userEmail."')||(user_name = '".$userName."' && email = '".$userEmail."'))";
	$resultChckUserBef = mysqli_query($con,$queryCheckUserBef);
	if(mysqli_num_rows($resultChckUserBef) > 0){
		echo "error1";
	}else{ 
		$queryCheckNumbUsers = "SELECT count(id) as numb FROM user_address";
		$resChckNumbUsers = mysqli_query($con,$queryCheckNumbUsers);
		$fetchChckNumbUsers = mysqli_fetch_assoc($resChckNumbUsers);
		if($fetchChckNumbUsers['numb'] == 0){
			$newUserAddressId = 1;
			// echo $newUserAddressId;
		}else{
			$queryGetMaxId = "SELECT MAX(id) as max FROM user_address";
			$resGetMax = mysqli_query($con,$queryGetMaxId);
			$fetchGetMax = mysqli_fetch_assoc($resGetMax);
			$newUserAddressId = $fetchGetMax['max'] +1;
			// echo $newUserAddressId;
		}
			$query = "INSERT INTO users VALUES (null,'".$userName."','".$password."','".$dateTdy."','".$newUserAddressId."','".$userEmail."','".$phoneNumb."','0')";
		if(mysqli_query($con,$query)){
			echo "Operation Done";
			$newUserId = mysqli_insert_id($con);
		}else{
			echo "error2";
		}
		
		
		$queryAddAddressOfUser = "INSERT INTO user_address VALUES ('".$newUserAddressId."','".$newUserId."','".$addressLine."','".$userCity."','".$userNearTo."','".$userCountry."')";
		$resAddAddrss = mysqli_query($con,$queryAddAddressOfUser);
		if(!$resAddAddrss){
			echo "error3";
		}else{
			echo "address of new user inserted ! <br>";
		}
	}
	mysqli_close($con);
	exit();
 ?>