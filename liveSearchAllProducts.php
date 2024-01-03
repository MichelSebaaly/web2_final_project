 <?php
	// echo "yes";
	$name = $_GET['name'];
	$con = mysqli_connect("localhost","root","","web3") or die ("unable to connect");
	$query = "SELECT * FROM products WHERE name LIKE '%".$name."%'";
	$res = mysqli_query($con,$query);
	// echo "<table id='navDivSearchDivToAppTablId' class='navDivSearchDivToAppTablClass'>";
	if(strlen($name) > 0){
		if(mysqli_num_rows($res) > 0){
			while($rslt = mysqli_fetch_assoc($res)){
				echo "<tr class='navDivSearchDivToAppTablClassTr'><td class='navDivSearchDivToAppTablClassTd' onclick='selectThisProduct(\"".$rslt['id']."\");'>".$rslt['name']."</td></tr>";
			}
		}else{
			echo "no rows";
		}
	}else{
		echo "no Result";
	}
	
	// echo "</table>";
	mysqli_close($con);
 ?>