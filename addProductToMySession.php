 <?php
	session_start();
	$dateTdy = date("Y-m-d");
	$productsId = $_POST['products'];
	$quantityOfThisProd = $_POST['quantity'];
	// decode : json object to php object
	$_SESSION['AllMyProducts'] = json_decode($productsId);
	
	$con = mysqli_connect("localhost","root","","web3") or die ("unable to connect");
	
	array_push($_SESSION['quantityOfEachProduct'],$quantityOfThisProd);
	
		
		$qryGetPrice = "SELECT price FROM products WHERE id = '".$_SESSION['AllMyProducts'][count($_SESSION['AllMyProducts'])-1]."'";
		$resGetPrice = mysqli_query($con,$qryGetPrice);
		$resltGetPrice = mysqli_fetch_assoc($resGetPrice);
		array_push($_SESSION['priceOfEachProduct'],$resltGetPrice['price']);
		$_SESSION['totalPrice'] += $_SESSION['priceOfEachProduct'][count($_SESSION['priceOfEachProduct'])-1] * $_SESSION['quantityOfEachProduct'][count($_SESSION['quantityOfEachProduct'])-1];
	
	
	$queryInsertSession = "INSERT INTO shopping_session VALUES (null,'".$_SESSION['sessionId']."','".$_SESSION['userId']."','".$_SESSION['AllMyProducts'][count($_SESSION['AllMyProducts'])-1]."','".$_SESSION['totalPrice']."','".$dateTdy."',null,'0','".$_SESSION['quantityOfEachProduct'][count($_SESSION['quantityOfEachProduct'])-1]."')";
			$rsltInsertSession = mysqli_query($con,$queryInsertSession);
	
	
	
	$_SESSION['DesignOfMyProducts'] = "<div class='MyBagDivToAppTotalDiv'>Total:</div><div class='MyBagDivToAppSumPriceDiv'>".$_SESSION['totalPrice']." L.L.</div>";
	
	
	
	$_SESSION['DesignOfMyProducts'] .= "<div class='MyBagDivToAppAllMyProductsDiv'>";
	
	if(count($_SESSION['AllMyProducts']) > 0){
		for($i = 0; $i< count($_SESSION['AllMyProducts']);$i++){
			$query = "SELECT * FROM products WHERE id = '".$_SESSION['AllMyProducts'][$i]."'";
			$res = mysqli_query($con,$query);
			if(mysqli_num_rows($res) > 0){
				$rslt = mysqli_fetch_assoc($res);
				$_SESSION['DesignOfMyProducts'].="<div id='MyBagDivToAppAllMyPrdctDivId' class='MyBagDivToAppAllMyPrdctDiv' >";
				$_SESSION['DesignOfMyProducts'].="<img src='images/".$rslt['image']."' class='MyBagDivToAppAllMyPrdctDivImg'/>";
				$_SESSION['DesignOfMyProducts'].="<div class='MyBagDivToAppAllMyPrdctDivInfo'>&nbspn: ".$rslt['name']."<br>&nbspp: ".$_SESSION['priceOfEachProduct'][$i]."<br>&nbspq :".$_SESSION['quantityOfEachProduct'][$i]."</div>";
				$_SESSION['DesignOfMyProducts'].="</div>";
			}
			
			
		}
		
		$_SESSION['DesignOfMyProducts'].="<button id='MyBagDivToAppAllMyPrdctBtnId' class='MyBagDivToAppAllMyPrdctBtn'>Next</button>";
		$_SESSION['DesignOfMyProducts'].="</div>";
		
		
	}else{
		
		$_SESSION['DesignOfMyProducts']="<div class='MyBagDivToAppTotalDiv'>Total:</div><div class='MyBagDivToAppSumPriceDiv'>0</div>";
		$_SESSION['DesignOfMyProducts'].="<div class='MyBagDivToAppAllMyProductsDiv'>no products";
		$_SESSION['DesignOfMyProducts'].="</div>";
		
	}
	mysqli_close($con);
 ?>
