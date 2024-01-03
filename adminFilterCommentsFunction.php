 <tr class="adminProductTabelTrTitle"><th class="userName">Id</th><th class="userName">user Name</th><th class="userName">description</th><th class="userName">date</th></tr>
  <?php
	session_start();
	$userName = $_POST['userName'];
	
	$con = mysqli_connect("localhost","root","","web3") or die ("unable to connect");
	if(strlen($userName) == 0){
		$query = "SELECT * FROM comments";
		$res = mysqli_query($con,$query);
		while($fetch = mysqli_fetch_assoc($res)){
			$queryGetName = "SELECT user_name FROM users WHERE id = '".$fetch['user_id']."'";
					$resGetName = mysqli_query($con,$queryGetName);
					$fetchGetName = mysqli_fetch_assoc($resGetName);
			echo "<tr class='adminHomePageDivProductsDivTableTr'><td class='userName'>".$fetch['id']."</td><td class='userName'>".$fetchGetName['user_name']."</td><td class='userName'>".$fetch['description']."</td><td class='userName'>".$fetch['date']."</td></tr>";
		}
	}else{
			$query = "SELECT * FROM comments c, users u WHERE (c.user_id = u.id AND u.user_name LIKE '%".$userName."%')";
			$res = mysqli_query($con,$query);
			if(mysqli_num_rows($res)>0){
			while($fetch = mysqli_fetch_assoc($res)){
				$queryGetName = "SELECT user_name FROM users WHERE id = '".$fetch['user_id']."'";
					$resGetName = mysqli_query($con,$queryGetName);
					$fetchGetName = mysqli_fetch_assoc($resGetName);
				echo "<tr class='adminHomePageDivProductsDivTableTr'><td class='userName'>".$fetch['id']."</td><td class='userName'>".$fetchGetName['user_name']."</td><td class='userName'>".$fetch['description']."</td><td class='userName'>".$fetch['date']."</td></tr>";
			}
		}
		else{
			echo "<tr class='adminHomePageDivProductsDivTableTrEmpty'><td class='name' colspan='4' style='text-align:center;'>no comments with this user name</td></tr>";
		}
	}
 ?>