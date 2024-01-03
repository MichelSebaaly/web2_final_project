 <tr class="adminProductTabelTrTitle"><th class="name">Id</th><th class="name">user Name</th><th class="name">email</th><th class="name">phone number</th><th class="name">created at</th></tr>
 <?php
	session_start();
	$userName = $_POST['userName'];
	
	$con = mysqli_connect("localhost","root","","web3") or die ("unable to connect");
	if(strlen($userName) == 0){
		$query = "SELECT * FROM users WHERE is_admin = '0'";
		$res = mysqli_query($con,$query);
		while($fetch = mysqli_fetch_assoc($res)){
			if(empty($fetch['email'])){
				$fetch['email'] = "NULL";
			}
			echo "<tr class='adminHomePageDivProductsDivTableTr' onclick='adminGetThisUser(".$fetch['id'].")'><td class='name'>".$fetch['id']."</td><td class='name'>".$fetch['user_name']."</td><td class='name'>".$fetch['email']."</td><td class='name'>".$fetch['phoneNumber']."</td><td class='name'>".$fetch['created_at']."</td></tr>";
		}
	}else{
			$query = "SELECT * FROM users WHERE (user_name LIKE '%".$userName."%' AND is_admin = '0')";
			$res = mysqli_query($con,$query);
		if(mysqli_num_rows($res)>0){
			while($fetch = mysqli_fetch_assoc($res)){
				if(empty($fetch['email'])){
					$fetch['email'] = "NULL";
				}
				echo "<tr class='adminHomePageDivProductsDivTableTr' onclick='adminGetThisUser(".$fetch['id'].")'><td class='name'>".$fetch['id']."</td><td class='name'>".$fetch['user_name']."</td><td class='name'>".$fetch['email']."</td><td class='name'>".$fetch['phoneNumber']."</td><td class='name'>".$fetch['created_at']."</td></tr>";
			}
		}else{
			echo "<tr class='adminHomePageDivProductsDivTableTrEmpty'><td class='name' colspan='5' style='text-align:center;'>no users with this name</td></tr>";
		}
	}
 ?>