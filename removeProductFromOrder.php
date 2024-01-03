 <?php
	session_start();
	$dateTdy = date("Y-m-d");
	$prodId = $_POST['productId'];
	$con = mysqli_connect("localhost","root","","web3") or die ("unable to connect");
	for($i = 0 ; $i < count($_SESSION['AllMyProducts']) ; $i++){
		if($_SESSION['AllMyProducts'][$i] == $prodId){
			$index = $i;
		}
	}
	
	$_SESSION['totalPrice'] -= $_SESSION['quantityOfEachProduct'][$index] * $_SESSION['priceOfEachProduct'][$index];
	
	$queryDeleteSession = "UPDATE shopping_session SET modified_at = '".$dateTdy."',deleted = '1' WHERE (session_id = '".$_SESSION['sessionId']."' AND user_id = '".$_SESSION['userId']."' AND product_id = '".$_SESSION['AllMyProducts'][$index]."')";
	$resDeleteSession = mysqli_query($con,$queryDeleteSession);
	if($resDeleteSession){
		echo "product deleted !";
	}
	
	unset($_SESSION['AllMyProducts'][$index]);
	unset($_SESSION['priceOfEachProduct'][$index]);
	unset($_SESSION['quantityOfEachProduct'][$index]);
	
	$_SESSION['AllMyProducts'] = array_values($_SESSION['AllMyProducts']);
	$_SESSION['quantityOfEachProduct'] = array_values($_SESSION['quantityOfEachProduct']);
	$_SESSION['priceOfEachProduct'] = array_values($_SESSION['priceOfEachProduct']);
	
	$_SESSION['DesignOfMyProducts']="";
	
	
	$_SESSION['DesignOfMyProducts'] = "<div class='MyBagDivToAppTotalDiv'>Total:</div><div class='MyBagDivToAppSumPriceDiv'>".$_SESSION['totalPrice']." L.L.</div>";
	$_SESSION['DesignOfMyProducts'] .= "<div class='MyBagDivToAppAllMyProductsDiv'>";
	
	
	
	if(count($_SESSION['AllMyProducts'])>0){
		for($j = 0 ; $j < count($_SESSION['AllMyProducts']) ; $j++){
			$query = "SELECT * FROM products WHERE id='".$_SESSION['AllMyProducts'][$j]."'";
			$res = mysqli_query($con,$query);
			if(mysqli_num_rows($res) > 0){
				$rslt = mysqli_fetch_assoc($res);
				// echo "nop";
				$_SESSION['DesignOfMyProducts'].="<div id='MyBagDivToAppAllMyPrdctDivId' class='MyBagDivToAppAllMyPrdctDiv' onclick='checkThisProduct(".$_SESSION['AllMyProducts'][$j].")'>";
				$_SESSION['DesignOfMyProducts'].="<img src='images/".$rslt['image']."' class='MyBagDivToAppAllMyPrdctDivImg'/>";
				$_SESSION['DesignOfMyProducts'].="<div class='MyBagDivToAppAllMyPrdctDivInfo'>&nbspn: ".$rslt['name']."<br>&nbspp: ".$_SESSION['priceOfEachProduct'][$j]."<br>&nbspq :".$_SESSION['quantityOfEachProduct'][$j]."</div>";
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
	
 ?>