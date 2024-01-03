 <?php
	session_start();
	$userName = $_POST['userName'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$phoneNumb = $_POST['phoneNumb'];
	$addressLine = $_POST['addressLine'];
	$addressCity = $_POST['addressCity'];
	$addressNearTo = $_POST['addressNearTo'];
	$error = false;
	$msg = "";
	
	$con = mysqli_connect("localhost","root","","web3") or die ("unable to connect");
	
	
	
	if(isset($_SESSION['userName'])){
		if(($_SESSION['userName'] == $userName) && ($_SESSION['email'] == $email)&& ($_SESSION['password'] == $password)&& ($_SESSION['phoneNumb'] == $phoneNumb)){
			$queryAddrss = "SELECT * FROM user_address WHERE user_id = '".$_SESSION['userId']."'";
			$resAddrss = mysqli_query($con,$queryAddrss);
			$fetchAddrss = mysqli_fetch_assoc($resAddrss);
			if(($_SESSION['addressLine'] == $addressLine) && ($_SESSION['addressCity'] == $addressCity) && ($_SESSION['addressNearTo'] == $addressNearTo)){
				$msg= "error0";
				$error = true;
				return;
			}else{
				$error = false;
			}
		}else{
			if(($_SESSION['userName'] != $userName) || ($_SESSION['email'] != $email) || ($_SESSION['password'] != $password) || ($_SESSION['phoneNumb'] != $phoneNumb)||($_SESSION['addressLine'] != $addressLine)||($_SESSION['addressCity'] != $addressCity)||($_SESSION['addressNearTo'] != $addressNearTo)){
				$queryChckUsrName = "SELECT * FROM users WHERE (user_name = '".$userName."' AND id <> '".$_SESSION['userId']."')";
				$queryChckEmail = "SELECT * FROM users WHERE (email = '".$email."' AND id <> '".$_SESSION['userId']."')";
				$queryChckPhoneNumb = "SELECT * FROM users WHERE (phoneNumber = '".$phoneNumb."' AND id <> '".$_SESSION['userId']."')";
				$resUsrName = mysqli_query($con,$queryChckUsrName);
				$resEmail = mysqli_query($con,$queryChckEmail);
				$resPhoneNumb = mysqli_query($con,$queryChckPhoneNumb);
				if(mysqli_num_rows($resUsrName) > 0){
					echo "errorName";
					$error = true;
					return;
				}else{
					$error = false;
				}
				if(mysqli_num_rows($resEmail) > 0){
					echo "errorEmail";
					$error = true;
					return;
				}else{
					$error = false;
				}
				
				if(mysqli_num_rows($resPhoneNumb) > 0){
					echo "errorPhoneNumb";
					$error = true;
					return;
				}else{
					$error = false;
				}
			}else{
				$error = false;
			}
		}
		
		if($error == false){
			$updateUserAddressQuery = "UPDATE user_address SET address_line = '".$addressLine."',city = '".$addressCity."',near_to = '".$addressNearTo."' WHERE user_id='".$_SESSION['userId']."'";
			$resUpdtAddrss = mysqli_query($con,$updateUserAddressQuery);
			if(!$resUpdtAddrss){
				$msg= "error3";
				return;
			}else{
				$updateUserQuery = "UPDATE users SET user_name = '".$userName."',email = '".$email."',password = '".$password."',phoneNumber = '".$phoneNumb."' WHERE id='".$_SESSION['userId']."'";
				$resUpdtUser = mysqli_query($con,$updateUserQuery);
				if(!$resUpdtUser){
					$msg= "error4";
					return;
				}else{
					$_SESSION['userName'] = $userName;
					$_SESSION['email'] = $email;
					$_SESSION['password'] = $password;
					$_SESSION['phoneNumb'] = $phoneNumb;
					$_SESSION['addressLine'] = $addressLine;
					$_SESSION['addressCity'] = $addressCity;
					$_SESSION['addressNearTo'] = $addressNearTo;
					$msg = "Done";
				}
			}
		}else{
			$msg = "nthgh";
		}
			echo $msg;
	}else{
		echo "big error";
	}
	mysqli_close($con);
	exit();
 ?>