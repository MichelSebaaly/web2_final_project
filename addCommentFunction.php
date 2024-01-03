 <?php
	session_start();
	$comment = $_POST['comment'];
	$dateTdy = date("Y-m-d");
	
	$con = mysqli_connect("localhost","root","","web3") or die ("unable to connect");
	$query = "INSERT INTO comments VALUES (null,'".$comment."','".$_SESSION['userId']."','".$dateTdy."')";
	// $res = mysqli_query($con,$query);
	if(mysqli_query($con,$query)){
	// if($res){
		echo "true";
	}else{
		echo "error";
	}
	
	mysqli_close($con);
	exit();
 ?>