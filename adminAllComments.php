   <?php
	session_start();
	if (!isset($_SESSION['adminId'])) {
		header("Location:adminLogIn.php");
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
			// echo "rosa has logged in";
			$loggedIn = true;
		} else {
			// echo "error";
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

   	<br>

   	<div class="adminHomePageDiv">
   		<div class="adminHomePageDivSearchDiv">
   			Search : <input class="adminHomePageDivSearchInpt" name="productName" placeholder="user comments..." onkeyup="adminFilterComments(this.value);" onfocus="searchCommentIfNotEmpty(this.value);" />
   		</div>

   		<div class="adminHomePageDivProductsDiv">
   			<table id="adminComemntsPageTableId" class="adminHomePageDivProductsDivTable">
   				<tr class="adminProductTabelTrTitle">
   					<th class="userName">Id</th>
   					<th class="userName">user Name</th>
   					<th class="userName">description</th>
   					<th class="userName">date</th>
   				</tr>
   				<?php

					$con = mysqli_connect("localhost", "root", "", "web3") or die("unable to connect");
					$query = "SELECT * FROM comments";
					$res = mysqli_query($con, $query);
					if (mysqli_num_rows($res) > 0) {
						while ($fetch = mysqli_fetch_assoc($res)) {
							$queryGetName = "SELECT user_name FROM users WHERE id = '" . $fetch['user_id'] . "'";
							$resGetName = mysqli_query($con, $queryGetName);
							$fetchGetName = mysqli_fetch_assoc($resGetName);
							echo "<tr class='adminHomePageDivProductsDivTableTr'><td class='userName'>" . $fetch['id'] . "</td><td class='userName'>" . $fetchGetName['user_name'] . "</td><td class='userName'>" . $fetch['description'] . "</td><td class='userName'>" . $fetch['date'] . "</td></tr>";
						}
					} else {
						echo "<tr class='adminHomePageDivProductsDivTableTrEmpty'><td class='name' colspan='4' style='text-align:center;'>no comments with this user name</td></tr>";
					}

					?>
   			</table>
   		</div>
   	</div>

   	<br><br><br><br>

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