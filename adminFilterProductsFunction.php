 <tr class="adminProductTabelTrTitle"><th class="name">product Name</th><th class="descrpt">Description</th><th class="price">price</th><th class="image">Image</th><th class="quantity">Quantity</th><th class="archive">Archived At</th></tr>
 <?php
	session_start();
	$prodName = $_POST['productName'];
	
	$con = mysqli_connect("localhost","root","","web3") or die ("unable to connect");
	if(strlen($prodName) == 0){
		$query = "SELECT * FROM products";
	}else{
			$query = "SELECT * FROM products WHERE name LIKE '%".$prodName."%'";
		}
	
	$res = mysqli_query($con,$query);
	if(mysqli_num_rows($res)>0){
		while($fetch = mysqli_fetch_assoc($res)){
			
			$queryQtt = "SELECT * FROM stock WHERE product_id = '".$fetch['id']."'";
			$resQtt = mysqli_query($con,$queryQtt);
			$fetchQtt = mysqli_fetch_assoc($resQtt);
			
			echo "<tr class='adminHomePageDivProductsDivTableTr'  onclick='adminGetThisProduct(".$fetch['id'].")' ><td class='nameTd'>".$fetch['name']."</td><td class='descrpt'>".$fetch['description']."</td><td class='price'>".$fetch['price']."</td><td class='image'>".$fetch['image']."</td><td class='quantity'>".$fetchQtt['Quantity']."</td><td class='archive'>".$fetchQtt['Archived_at']."</td></tr>";
		}
	}else{
		echo "<tr class='adminHomePageDivProductsDivTableTrEmpty'><td colspan='6' style='text-align:center;'>no products with this name</td></tr>";
	}
	
 ?>