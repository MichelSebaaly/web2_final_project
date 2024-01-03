   <?php
	session_start();
	if (!isset($_SESSION['adminId'])) {
		header("Location:adminLogIn.php");
	}

	// if(!isset($_SESSION['prodIdSelected'])){
	// header("Location:adminAllProducts.php");
	// }
	?>

   <!DOCTYPE html>
   <html>

   <head>
   	<link rel="stylesheet" href="style.css">
   	<script src="script.js"></script>
   	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   </head>

   <body style="margin:0px;overflow-x:hidden;">

   	<?php

		$loggedIn = false;
		if (isset($_SESSION['adminId'])) {
			// echo "rosa has logged in";

			// echo " ".$_SESSION['prodIdSelected'];
			$loggedIn = true;
		} else {
			echo "error";
		}

		?>
   	<div class="navDiv">
   		<div class="navDivIcon">

   		</div>

   		<div class="navDivSearch">
   			<div class="navDivSearchDiv">
   				<input id="navDivSearchDivInpId" class="navDivSearchDivInput" placeholder="Search Products..." onkeyup="searchProducts(this.value);" disabled />

   			</div>
   			<div id="navDivSearchDivToAppId" class="navDivSearchDivToAppTrans">
   				<table id="navDivSearchDivToAppTablId" class="navDivSearchDivToAppTablClass">
   					<?php
						?>
   				</table>
   			</div>

   		</div>

   		<div class="navDivLogIn" id="adminHomePageLogInId">
   			<div id="HomePageDivOfLogIn">
   				<div><img src="images/logIn.png" alt="logInButton" width="40px" height="40px" /></div>
   				<div class="navDivText">Log In</div>
   			</div>
   			<div class="LogInDivToApp">
   				<div class="LogInDivToAppSignInDiv"><label class="LogInDivToAppSignIn"><b>Sign in</b></label></div>
   				<div class="LogInDivToAppCreateAccDiv"><a href="register.php" class="LogInDivToAppCreateAcc">Create an account</a></div>
   				<hr>
   				<div class="LogInDivToAppUserNameEmailDiv"><label class="LogInDivToAppUserNameEmail">User name or Email</label><br>
   					<input name="LogInUserNameEmail" class="LogInDivToAppUserNameEmailClass" id="LogInDivToAppUserNameEmailId" placeholder="Email or User name" />
   				</div>
   				<div class="LogInDivToAppPasswordDiv"><label class="LogInDivToAppPassword">Password</label><br>
   					<input name="LogInPassword" type="password" class="LogInDivToAppPasswordClass" id="LogInDivToAppPassId" placeholder="Password" />
   				</div>
   				<button class="LogInDivToAppLogInButton" onclick="loginUser(this.id);">Log In</button>
   			</div>
   		</div>


   		<div class="navDivLogOutInvisible" id="adminHomePageLogOutId">
   			<div id="HomePageDivOfLogOut">
   				<div><img src="images/logOut.png" alt="logOutButton" width="40px" height="40px" /></div>
   				<div class="navDivText">Log Out</div>
   			</div>
   		</div>

   	</div>

   	<?php

		if (!$loggedIn) {
		?>
   		<script>
   			var logIn = document.getElementById("adminHomePageLogInId").classList;
   			var logOut = document.getElementById("adminHomePageLogOutId").classList;

   			if (logIn.contains("navDivLogInInvisble")) {
   				if (logOut.contains("navDivLogOut")) {
   					logIn.remove("navDivLogInInvisble");
   					logIn.add("navDivLogIn");
   					logOut.remove("navDivLogOut");
   					logOut.add("navDivLogOutInvisible");
   				}
   			}
   		</script>

   	<?php
		} else {
		?>
   		<script>
   			var logIn = document.getElementById("adminHomePageLogInId").classList;
   			var logOut = document.getElementById("adminHomePageLogOutId").classList;

   			if (logIn.contains("navDivLogIn")) {
   				if (logOut.contains("navDivLogOutInvisible")) {
   					logIn.remove("navDivLogIn");
   					logIn.add("navDivLogInInvisible");
   					logOut.remove("navDivLogOutInvisible");
   					logOut.add("navDivLogOut");
   				}
   			}
   		</script>

   	<?php
		}
		// if($loggedIn){

		// }

		?>


   	<div class="navigationBar">


   		<div class="NavBarAll navBarHomeButt" id="adminHomePagNavBarHomeId">
   			<label class="buttStyle">Home&nbsp </label>
   			<img src="images/home.png" alt="searchButton" class="navBarImage" />
   		</div>

   		<div class="NavBarAll navBarProductsButt" id="adminHomePagNavBarPrdctsId">
   			<label class="buttStyle">products&nbsp </label>
   			<img src="images/products.png" alt="searchButton" class="navBarImage" />

   		</div>

   		<div class="NavBarAll navBarUsersButt" id="adminHomePagNavBarUsersId">
   			<label class="buttStyle">Users&nbsp </label>
   			<img src="images/users.png" alt="searchButton" class="navBarImage" />
   		</div>

   		<div class="NavBarAll navBarUsersButt" id="adminHomePagNavBarOrdersId">
   			<label class="buttStyle">Orders&nbsp </label>
   			<img src="images/orders.png" alt="searchButton" class="navBarImage" />
   		</div>

   		<div class="NavBarAll navBarProductsButt" id="adminHomePagNavBarCommentsId">
   			<label class="buttStyle">Comments&nbsp </label>
   			<img src="images/comments.png" alt="searchButton" class="navBarImage" />
   		</div>


   	</div>


   	<?php
		$con = mysqli_connect("localhost", "root", "", "web3") or die("unable to connect");
		$query = "SELECT * FROM product_type";
		$res = mysqli_query($con, $query);
		?>

   	<form method="POST" enctype="multipart/form-data" action="adminAddNewProduct.php">
   		<div class="adminAddProdDiv">
   			<div class="adminSelectedProdDivRightName">
   				<div class="adminSelectedProdDivRightNameLeft">name : </div>
   				<div class="adminSelectedProdDivRightNameRight"><textarea id="adminPrdctSlctdNameId" name="productName" class="adminSelectedProdDivRightNameTxtArea"></textarea></div>
   			</div>
   			<div class="adminSelectedProdDivRightNameSlct">
   				<div class="adminSelectedProdDivRightNameLeft">product type : </div>
   				<div class="adminSelectedProdDivRightNameRightSlct">
   					<select class="adminNewProductSlct" name="productType">
   						<?php
							while ($fetch = mysqli_fetch_assoc($res)) {
								echo "<option  value='" . $fetch['id'] . "'>" . $fetch['name'] . "</option>";
							}
							?>
   					</select>
   				</div>
   			</div>

   			<div class="adminSelectedProdDivRightDesc">
   				<div class="adminSelectedProdDivRightNameLeft">description : </div>
   				<div class="adminSelectedProdDivRightNameRight"><textarea id="adminPrdctSlctdDescId" name="productDescription" class="adminSelectedProdDivRightNameTxtArea"></textarea></div>
   			</div>
   			<br>
   			<div class="adminSelectedProdDivRightImage">
   				<div class="adminSelectedProdDivRightNameLeft">Image : </div>
   				<div class="adminSelectedProdDivRightNameRight"><input type="file" name="productImage" class="adminCreateProdFile" /></div>
   			</div>
   			<div class="adminSelectedProdDivRightPric">
   				<div class="adminSelectedProdDivRightNameLeft">price : </div>
   				<div class="adminSelectedProdDivRightNameRight"><textarea id="adminPrdctSlctdPricId" name="productPrice" class="adminSelectedProdDivRightNameTxtArea" type="number"></textarea></div>
   			</div>
   			<div class="adminSelectedProdDivRightQtt">
   				<div class="adminSelectedProdDivRightNameLeft">quantity : </div>
   				<div class="adminSelectedProdDivRightNameRight"><textarea id="adminPrdctSlctdQttId" name="productsQuantity" class="adminSelectedProdDivRightNameTxtArea"></textarea></div>
   			</div><br>
   			<div style="text-align:center;"><input type="submit" class="adminAddPrdctBtn" value="save" /></div>
   			<br><br>
   		</div>
   	</form>
   	<br><br>

   	<script>
   		$("#adminHomePagNavBarHomeId").click(function() {
   			window.location.href = "adminHomePage.php";
   		});

   		$("#adminHomePageLogOutId").click(function() {
   			if (confirm("Do you want to log out?")) {
   				window.location.href = "adminLogOutFunction.php";
   			} else {
   				return;
   			}
   		});

   		$("#adminHomePagNavBarPrdctsId").click(function() {
   			window.location.href = "adminAllProducts.php";
   		});

   		$("#adminHomePagNavBarUsersId").click(function() {
   			window.location.href = "adminAllUsers.php";
   		});

   		$("#adminHomePagNavBarOrdersId").click(function() {
   			window.location.href = "adminAllOrders.php";
   		});

   		$("#adminHomePagNavBarCommentsId").click(function() {
   			window.location.href = "adminAllComments.php";
   		});

   		var searchDivToApp = document.getElementById("navDivSearchDivToAppId");
   		var searchDivInp = document.getElementById("navDivSearchDivInpId");
   	</script>

   </body>

   </html>