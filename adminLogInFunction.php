 <?php
	session_start();
	$nameEmail = $_POST['nameEmail'];
	$password = $_POST['password'];
	
	$con = mysqli_connect("localhost","root","","web3") or die ("unable to connect");
	if(strpos($nameEmail,"@gmail.com")>0){
		$query = "SELECT * FROM users WHERE (email = '".$nameEmail."' AND password = '".$password."' AND is_admin = '1')";
	}else{
		$query = "SELECT * FROM users WHERE (user_name = '".$nameEmail."' AND password = '".$password."' AND is_admin = '1')";
	}
	
	$res = mysqli_query($con,$query);
	if(mysqli_num_rows($res)>0){
		$fetch = mysqli_fetch_assoc($res);
		$_SESSION['adminUserName'] = $fetch['user_name'];
		$_SESSION['adminId'] = $fetch['id'];
		echo "true";
	}else{
		echo "error with UserName/Password";
	}
	
	mysqli_close($con);
	exit();
 ?>