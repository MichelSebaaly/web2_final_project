 <?php
	$con = mysqli_connect("localhost","root","","web3") or die ("unable to connect");
	$dateTdy = date("Y-m-d");
	$errorName = false;
	$canContinue = true;
	
	if((isset($_POST['productName']))&&(isset($_POST['productType']))&&(isset($_POST['productDescription']))&&(isset($_POST['productsQuantity']))&&(isset($_POST['productPrice']))){
		if((empty($_POST['productName']))||(empty($_POST['productDescription']))||(empty($_POST['productsQuantity']))||(empty($_POST['productPrice']))||($_FILES['productImage']['size']==0)){
			echo "Field Empty !";
			return;
		}
	}else{
		echo "You have to submit !";
	}
	
	
	if((isset($_POST['productName']))&&(!empty($_POST['productName']))){
		$prodName = $_POST['productName'];
		$arrayAllProd = array();
		$prodName = str_replace(' ','',$prodName);
		$queryCheckProd = "SELECT * FROM products";
		$resCheckProd = mysqli_query($con,$queryCheckProd);
		while($fetchProd = mysqli_fetch_assoc($resCheckProd)){
			$fetchProd['name'] = str_replace(' ','',$fetchProd['name']);
			array_push($arrayAllProd,$fetchProd['name']);
		}
		for($i = 0 ; $i < count($arrayAllProd) ; $i++){
			if($prodName == $arrayAllProd[$i]) $errorName = true;
		}
	}
	
	if((!preg_match("/^[1-9][0-9]*$/i",$_POST['productsQuantity']))||(!preg_match("/^[1-9][0-9]*$/i",$_POST['productPrice']))){
		$canContinue = false; 
	}
	
	if($canContinue){
		if($errorName == false){
			if((isset($_POST['productName']))&&(isset($_POST['productType']))&&(isset($_POST['productDescription']))&&(isset($_POST['productsQuantity']))&&(isset($_POST['productPrice']))){
				if((!empty($_POST['productName']))&&(!empty($_POST['productDescription']))&&(!empty($_POST['productsQuantity']))&&(!empty($_POST['productPrice']))&&($_FILES['productImage']['size']>0)){
					$target_dir = "images/";
					$target_file = $target_dir . basename($_FILES["productImage"]["name"]);
					$uploadOk = 1;
					$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
					$canContinue = true;
				}else{
					echo "Field Empty !<br>";
				}
			}else{
				echo "You have to submit !<br>";
			}
			
			// Allow certain file formats
			if($canContinue == true){
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
				  $uploadOk = 0;
				}
				
				
				if ($uploadOk == 0) {
				  echo "Sorry, your file was not uploaded.<br>";
				// if everything is ok, try to upload file
				} else {
				  if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $target_file)) {
					// echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
					$query = "INSERT INTO products VALUES (null,'".$_POST['productName']."','".$_POST['productDescription']."','".$_POST['productType']."','".$_POST['productPrice']."','".basename($_FILES["productImage"]["name"])."','".$dateTdy."',null,null)";
					$res = mysqli_query($con,$query);
					if($res){
						$lastId = mysqli_insert_id($con);
						$queryQtt = "INSERT INTO stock VALUES (null,'".$lastId."','".$_POST['productsQuantity']."','".$dateTdy."',null,null)";
						$resQuery = mysqli_query($con,$queryQtt);
						if($resQuery){
							$resUpdtType = mysqli_query($con,"UPDATE product_type SET modified_at = '".$dateTdy."' WHERE id = '".$_POST['productType']."'");
							header("Location:adminAllProducts.php");
						}else{
							echo "error with stock query<br>";
						}
					}else{
						echo "error with products query<br>";
					}
				  }else {
					echo "Sorry, there was an error uploading your file.<br>";
				  }
				}
			
			}else{
				echo "error when submitting<br>";
			}
		}else{
			echo "Product with this name already exists !";
		}
	}else{
		echo "Quantity and price must be numbers only !";
	}
 ?>