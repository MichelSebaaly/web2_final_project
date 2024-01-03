 <?php
	session_start();
	$name = $_POST['name'];
	$desc = $_POST['desc'];
	$pric = $_POST['pric'];
	$qtt = $_POST['qtt'];
	$prodId = $_POST['prodId'];
	$archive = $_POST['arch'];
	$prodNameChck ="";
	
	$errorPrdctExists = false;
	$dateTdy = date("Y-m-d");
	$error = false;
	$msg ="";
	
	$con = mysqli_connect("localhost","root","","web3") or die ("Unable to connect");
	$queryChckBefr = "SELECT * FROM products WHERE id = '".$prodId."'";
	$resChckBef = mysqli_query($con,$queryChckBefr);
	$fetchChckBef = mysqli_fetch_assoc($resChckBef);
	
	$queryChckQttBef = "SELECT Quantity FROM stock WHERE product_id = '".$prodId."'";
	$resBefQtt = mysqli_query($con,$queryChckQttBef);
	$fetchBefQtt = mysqli_fetch_assoc($resBefQtt);
	
	if(($fetchChckBef['name'] == $name) && ($fetchChckBef['description'] == $desc) && ($fetchChckBef['price'] == $pric) && ($fetchBefQtt['Quantity'] == $qtt)){
		if($archive == "true"){
			if($fetchChckBef['archived_at'] != NULL){
				$error = true;
				$msg= "Nothing has changed";
			}else{
				$error = false;
				$msg= "false00";
			}
		}else{
			if($fetchChckBef['archived_at'] == NULL){
				$error = true;
				$msg= "Nothing has changed";
			}else{
				$error = false;
				$msg= "false01";
			}
		}
	}else{
		if($fetchChckBef['name'] != $name){
			$prodNameChck = str_replace(' ','',$_POST['name']);
			$queryChckProdSameName = "SELECT * FROM products";
			$arrayAllPrdctsReplaced = array();
			$resChckProdSameName = mysqli_query($con,$queryChckProdSameName);
			while($fetchPrdSameName = mysqli_fetch_assoc($resChckProdSameName)){
				$fetchPrdSameName['name'] = str_replace(' ','',$fetchPrdSameName['name']);
				array_push($arrayAllPrdctsReplaced,$fetchPrdSameName['name']);
			}
			
			for($i = 0 ; $i < count($arrayAllPrdctsReplaced) ; $i++){
				if($prodNameChck == $arrayAllPrdctsReplaced[$i])$errorPrdctExists = true;$error = true;
			}
		}else{
			$errorPrdctExists = false;$error = false;
		}
	}
	if($errorPrdctExists == true){
		$msg = "Product with this name already exists";
	}else{
		// $msg = "mafi error";
		if($error == false){
			
			if(($archive == "true")){
					$queryChangeProd = "UPDATE products SET name = '".$name."',description = '".$desc."', price = '".$pric."',modified_at = '".$dateTdy."',archived_at = '".$dateTdy."' WHERE id = '".$prodId."'";
			}else{
				$queryChangeProd = "UPDATE products SET name = '".$name."',description = '".$desc."', price = '".$pric."',modified_at = '".$dateTdy."',archived_at = NULL WHERE id = '".$prodId."'";
			}
			$resChangProd = mysqli_query($con,$queryChangeProd);
			
			if(!$resChangProd){
				$error = true;
				echo "error1";
				$msg.= "false1";
			}
			
			if($archive == "true"){
				$queryChangeQtt = "UPDATE stock SET Quantity = '".$qtt."',Modified_at = '".$dateTdy."',Archived_at = '".$dateTdy."' WHERE product_id = '".$prodId."'";
			}else{
				$queryChangeQtt = "UPDATE stock SET Quantity = '".$qtt."',Modified_at = '".$dateTdy."',Archived_at = NULL WHERE product_id = '".$prodId."'";
			}
			$resChangQtt = mysqli_query($con,$queryChangeQtt);
			
			if(!$resChangQtt){
				$error = true;
				echo "error2";
				$msg.= "false2";
			}
		}
	}
	
	if($error){
		echo $msg;
	}else{
		echo "true";
	}
	
	mysqli_close($con);
	exit();
 ?>