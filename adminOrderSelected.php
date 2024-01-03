    <?php
	session_start();
	if (!isset($_SESSION['adminId'])) {
		header("Location:adminLogIn.php");
	}

	if (!isset($_SESSION['ordIdSelected'])) {
		header("Location:adminAllUsers.php");
	}
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
			$loggedIn = true;
		} else {
		}

		?>
    	<div class="navDiv">
    		<div class="navDivIcon">

    		</div>

    		<div class="navDivSearch">
    			<div class="navDivSearchDiv">
    				<marquee width="100%" direction="right" height="100%" style="border-radius:20px;margin-top:6px;color:grey;">
    					Welcome Mme Rosa
    				</marquee>
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
		$query = "SELECT * FROM order_items WHERE order_id = '" . $_SESSION['ordIdSelected'] . "'";
		$res = mysqli_query($con, $query);
		$fetch = mysqli_fetch_assoc($res);


		$queryQtt = "SELECT quantity FROM order_items WHERE order_id = '" . $_SESSION['ordIdSelected'] . "'";
		$resQtt = mysqli_query($con, $queryQtt);
		$qttArray = array();
		while ($fetchQtt = mysqli_fetch_assoc($resQtt)) {
			array_push($qttArray, $fetchQtt['quantity']);
		}


		$queryGetAllProd = "SELECT * FROM order_details WHERE id = '" . $_SESSION['ordIdSelected'] . "'";
		$resProd = mysqli_query($con, $query);
		$tableOfProd = array();
		// $fetchGetDate = mysqli_fetch_assoc($resProd);
		while ($fetchProd = mysqli_fetch_assoc($resProd)) {
			array_push($tableOfProd, $fetchProd['product_id']);
		}

		$queryOrd = "SELECT *  FROM users WHERE id IN (SELECT user_id FROM order_details WHERE id = '" . $_SESSION['ordIdSelected'] . "')";
		$resOrdNam = mysqli_query($con, $queryOrd);
		$fetchOrdNam = mysqli_fetch_assoc($resOrdNam);

		?>

    	<div class="adminSelectedUserDiv">
    		<div class="adminSelectedUserDivRightName">
    			<div class="adminSelectedProdDivRightNameLeft">Order id : </div>
    			<div class="adminSelectedProdDivRightNameRight"><textarea id="adminPrdctSlctdNameId" class="adminSelectedProdDivRightNameTxtArea" disabled><?php echo $fetch['order_id']; ?></textarea></div>
    		</div>

    		<div class="adminSelectedUserDivRightName">
    			<div class="adminSelectedProdDivRightNameLeft">user Id : </div>
    			<div class="adminSelectedProdDivRightNameRight"><textarea id="adminPrdctSlctdNameId" class="adminSelectedProdDivRightNameTxtArea" disabled><?php echo $fetchOrdNam['id']; ?></textarea></div>
    		</div>

    		<div class="adminSelectedUserDivRightName">
    			<div class="adminSelectedProdDivRightNameLeft">user Name : </div>
    			<div class="adminSelectedProdDivRightNameRight"><textarea id="adminPrdctSlctdNameId" class="adminSelectedProdDivRightNameTxtArea" disabled><?php echo $fetchOrdNam['user_name']; ?></textarea></div>
    		</div>

    		<div class="adminSelectedUserDivRightName">
    			<div class="adminSelectedProdDivRightNameLeft">product id : </div>
    			<div class="adminSelectedProdDivRightNameRight"><textarea id="adminPrdctSlctdDescId" class="adminSelectedProdDivRightNameTxtArea" disabled><?php if (count($tableOfProd) > 0) {
																																								for ($i = 0; $i < count($tableOfProd) - 1; $i++) {
																																									echo $tableOfProd[$i] . "-";
																																								}
																																								echo $tableOfProd[count($tableOfProd) - 1];
																																							} ?></textarea></div>
    		</div>

    		<div class="adminSelectedUserDivRightName">
    			<div class="adminSelectedProdDivRightNameLeft">product Name : </div>
    			<div class="adminSelectedProdDivRightNameRight"><textarea id="adminPrdctSlctdDescId" class="adminSelectedProdDivRightNameTxtArea" disabled><?php if (count($tableOfProd) > 0) {
																																								$con = mysqli_connect("localhost", "root", "", "web3") or die("unable to connect");
																																								for ($i = 0; $i < count($tableOfProd) - 1; $i++) {
																																									// echo $tableOfProd[$i]."-";
																																									$query = "SELECT name FROM products WHERE id = '" . $tableOfProd[$i] . "'";
																																									$res = mysqli_query($con, $query);
																																									$fetchNam = mysqli_fetch_assoc($res);
																																									echo $fetchNam['name'] . "-";
																																								}
																																								// echo $tableOfProd[count($tableOfProd)-1];
																																								$queryLastElmnt = "SELECT name FROM products WHERE id = '" . $tableOfProd[count($tableOfProd) - 1] . "'";
																																								$resLst = mysqli_query($con, $queryLastElmnt);
																																								$fetchLst = mysqli_fetch_assoc($resLst);
																																								echo $fetchLst['name'];

																																								mysqli_close($con);
																																							} ?></textarea></div>
    		</div>

    		<div class="adminSelectedUserDivRightName">
    			<div class="adminSelectedProdDivRightNameLeft">quantity : </div>
    			<div class="adminSelectedProdDivRightNameRight"><textarea id="adminPrdctSlctdPricId" class="adminSelectedProdDivRightNameTxtArea" disabled><?php if (count($qttArray) > 0) {
																																								for ($j = 0; $j < count($qttArray) - 1; $j++) {
																																									echo $qttArray[$j] . "-";
																																								}
																																								echo $qttArray[count($qttArray) - 1];
																																							}
																																							?></textarea></div>
    		</div>

    		<div class="adminSelectedUserDivRightName">
    			<div class="adminSelectedProdDivRightNameLeft">created at : </div>
    			<div class="adminSelectedProdDivRightNameRight"><textarea id="adminPrdctSlctdQttId" class="adminSelectedProdDivRightNameTxtArea" disabled><?php echo $fetch['created_at']; ?></textarea></div>
    		</div>
    	</div>


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