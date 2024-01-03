 <tr class="adminProductTabelTrTitle"><th class="userName">Id</th><th class="userName">user id</th><th class="userName">user Name</th><th class="userName">total</th><th class="userName">payment type</th><th class="userName">address</th><th class="userName">created at</th></tr>
 <?php
	session_start();
	$userName = $_POST['userName'];
	
	$con = mysqli_connect("localhost","root","","web3") or die ("unable to connect");
	if(strlen($userName) == 0){
		$query = "SELECT * FROM order_details";
	}else{
			$query = "SELECT * FROM order_details WHERE user_id in (SELECT id FROM users WHERE user_name LIKE '%".$userName."%')";
		}
	
	$res = mysqli_query($con,$query);
				
	$res = mysqli_query($con,$query);
	if(mysqli_num_rows($res) > 0){
		while($fetch = mysqli_fetch_assoc($res)){				
		$queryGetUserName = "SELECT user_name FROM users WHERE id = '".$fetch['user_id']."'";
		$resGetUserName = mysqli_query($con,$queryGetUserName);
		$fetchGetUserName = mysqli_fetch_assoc($resGetUserName);
					
		$queryGetPayTyp = "SELECT status FROM payment_details WHERE order_id = '".$fetch['id']."'";
		$resGetPayTyp = mysqli_query($con,$queryGetPayTyp);
		$fetchGetPayTyp = mysqli_fetch_assoc($resGetPayTyp);
					
		$queryGetAdd = "SELECT city FROM user_address WHERE user_id = '".$fetch['user_id']."'";
		$resGetAdd = mysqli_query($con,$queryGetAdd);
		$fetchGetAdd = mysqli_fetch_assoc($resGetAdd);
					
		echo "<tr class='adminHomePageDivProductsDivTableTr' onclick='adminGetThisUser(".$fetch['id'].")'><td class='userName'>".$fetch['id']."</td><td class='userName'>".$fetch['user_id']."</td><td class='userName'>".$fetchGetUserName['user_name']."</td><td class='userName'>".$fetch['total']."</td><td class='userName'>".$fetchGetPayTyp['status']."</td><td class='userName'>".$fetchGetAdd['city']."</td><td class='userName'>".$fetch['created_at']."</td></tr>";
		}
	}else{
		echo "<tr class='adminHomePageDivProductsDivTableTrEmpty'><td colspan='7' style='text-align:center;'>no orders with this name</td></tr>";
	}
	
 ?>