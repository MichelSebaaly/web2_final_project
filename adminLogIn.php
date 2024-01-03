  <!DOCTYPE html>
  <html>

  <head>
  	<link rel="stylesheet" href="style.css">
  	<script src="script.js"></script>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  </head>

  <body style="margin:0px;overflow-x:hidden;">
  	<div class="navDiv">
  		<div class="navDivIcon">

  		</div>

  		<div class="navDivSearch">
  			<div class="navDivSearchDiv">
  				<input id="navDivSearchDivInpId" class="navDivSearchDivInput" placeholder="Search..." onkeyup="searchProducts(this.value);" onfocus="searchProductsIfNotEmpty(this.value);" />
  			</div>
  			<div id="navDivSearchDivToAppId" class="navDivSearchDivToAppTrans">
  				<table id="navDivSearchDivToAppTablId" class="navDivSearchDivToAppTablClass">

  				</table>
  			</div>

  		</div>

  		<div class="navDivLogIn" id="HomePageLogInId">
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
  		<div class="navDivMyBag" id="HomePageMyBagId">
  			<div><img src="images/myBag.png" alt="logInButton" width="40px" height="40px" /></div>
  			<div class="navDivText">My Bag</div>
  			<div class="MyBagDivToApp">
  				<?php
					// if($loggedIn == false){
					echo "you have to log In first !";
					// }else{
					// echo count ($_SESSION['AllMyProducts']);
					// echo $_SESSION['DesignOfMyProducts'];
					// }
					// 
					?>

  			</div>
  		</div>
  	</div>

  	<div class="navigationBar">


  		<div class="NavBarAll navBarHomeButt" id="HomePagNavBarHomeId">
  			<label class="buttStyle">Home&nbsp </label>
  			<img src="images/home.png" alt="searchButton" class="navBarImage" />
  		</div>

  		<div class="NavBarAll navBarBeautyButt">
  			<label class="buttStyle">Beauty&nbsp </label>
  			<img src="images/nav_beauty.png" alt="searchButton" class="navBarImage" />
  			<div class="BeautyDivToApp">
  				<table class="BeautyDivToAppTable">
  					<?php
						$con = mysqli_connect("localhost", "root", "", "web3") or die("unable to connect");
						$query = "SELECT name FROM product_type WHERE product_cat_id IN (SELECT id FROM product_category WHERE name = 'Beauty')";
						$res = mysqli_query($con, $query);
						if (mysqli_num_rows($res) > 0) {
							while ($rslt = mysqli_fetch_assoc($res)) {
								echo "<tr class='BeautyDivToAppTableTr'><td class='BeautyDivToAppTableTd' onclick='openPageCategorie(\"" . $rslt['name'] . "\");'>" . $rslt['name'] . "</td></tr>";
							}
						}
						mysqli_close($con);
						?>
  				</table>
  			</div>
  		</div>

  		<div class="NavBarAll navBarSupplmntsButt">
  			<label class="buttStyle">Supplements&nbsp </label>
  			<img src="images/supplements.png" alt="searchButton" class="navBarImage" />
  			<div class="SupplmntsDivToApp">
  				<table class="BeautyDivToAppTable">
  					<?php
						$con = mysqli_connect("localhost", "root", "", "web3") or die("unable to connect");
						$query = "SELECT name FROM product_type WHERE product_cat_id IN (SELECT id FROM product_category WHERE name = 'Supplements')";
						$res = mysqli_query($con, $query);
						if (mysqli_num_rows($res) > 0) {
							while ($rslt = mysqli_fetch_assoc($res)) {
								echo "<tr class='SupplmntsDivToAppTableTr'><td class='SupplmntsDivToAppTableTd' onclick='openPageCategorie(\"" . $rslt['name'] . "\");'>" . $rslt['name'] . "</td></tr>";
							}
						}
						mysqli_close($con);
						?>
  				</table>
  			</div>
  		</div>

  		<div class="NavBarAll navBarHealthButt">
  			<label class="buttStyle">Health & Wellness&nbsp </label>
  			<img src="images/nav_health.png" alt="searchButton" class="navBarImage" />
  			<div class="HealthDivToApp">
  				<table class="HealthDivToAppTable">
  					<?php
						$con = mysqli_connect("localhost", "root", "", "web3") or die("unable to connect");
						$query = "SELECT name FROM product_type WHERE product_cat_id IN (SELECT id FROM product_category WHERE name = 'Health & Wellness')";
						$res = mysqli_query($con, $query);
						if (mysqli_num_rows($res) > 0) {
							while ($rslt = mysqli_fetch_assoc($res)) {
								echo "<tr class='HealthDivToAppTableTr'><td class='HealthDivToAppTableTd' onclick='openPageCategorie(\"" . $rslt['name'] . "\");'>" . $rslt['name'] . "</td></tr>";
							}
						}
						mysqli_close($con);
						?>
  				</table>
  			</div>
  		</div>

  		<div class="NavBarAll navBarHygieneButt">
  			<label class="buttStyle">Hygiene&nbsp </label>
  			<img src="images/nav_hygiene.png" alt="searchButton" class="navBarImage" />
  			<div class="HygieneDivToApp">
  				<table class="HygieneDivToAppTable">
  					<?php
						$con = mysqli_connect("localhost", "root", "", "web3") or die("unable to connect");
						$query = "SELECT name FROM product_type WHERE product_cat_id IN (SELECT id FROM product_category WHERE name = 'Hygiene')";
						$res = mysqli_query($con, $query);
						if (mysqli_num_rows($res) > 0) {
							while ($rslt = mysqli_fetch_assoc($res)) {
								echo "<tr class='HygieneDivToAppTableTr'><td class='HygieneDivToAppTableTd' onclick='openPageCategorie(\"" . $rslt['name'] . "\");'>" . $rslt['name'] . "</td></tr>";
							}
						}
						mysqli_close($con);
						?>
  				</table>
  			</div>
  		</div>

  		<div class="NavBarAll navBarMenButt">
  			<label class="buttStyle">Men&nbsp </label>
  			<img src="images/nav_man.png" alt="searchButton" class="navBarImage" />
  			<div class="MenDivToApp">
  				<table class="MenDivToAppTable">
  					<?php
						$con = mysqli_connect("localhost", "root", "", "web3") or die("unable to connect");
						$query = "SELECT name FROM product_type WHERE product_cat_id IN (SELECT id FROM product_category WHERE name = 'Men')";
						$res = mysqli_query($con, $query);
						if (mysqli_num_rows($res) > 0) {
							while ($rslt = mysqli_fetch_assoc($res)) {
								echo "<tr class='MenDivToAppTableTr'><td class='MenDivToAppTableTd' onclick='openPageCategorie(\"" . $rslt['name'] . "\");'>" . $rslt['name'] . "</td></tr>";
							}
						}
						mysqli_close($con);
						?>
  				</table>
  			</div>
  		</div>

  		<div class="NavBarAll navBarBabyKidButt">
  			<label class="buttStyle">Baby-Kid&nbsp </label>
  			<img src="images/nav_kid.png" alt="searchButton" class="navBarImage" />
  			<div class="BabyDivToApp">
  				<table class="BabyDivToAppTable">
  					<?php
						$con = mysqli_connect("localhost", "root", "", "web3") or die("unable to connect");
						$query = "SELECT name FROM product_type WHERE product_cat_id IN (SELECT id FROM product_category WHERE name = 'Baby & Kid')";
						$res = mysqli_query($con, $query);
						if (mysqli_num_rows($res) > 0) {
							while ($rslt = mysqli_fetch_assoc($res)) {
								echo "<tr class='BabyDivToAppTableTr'><td class='BabyDivToAppTableTd' onclick='openPageCategorie(\"" . $rslt['name'] . "\");'>" . $rslt['name'] . "</td></tr>";
							}
						}
						mysqli_close($con);
						?>
  				</table>
  			</div>
  		</div>

  		<div class="NavBarAll navBarCoronaButt">
  			<label class="buttStyle">Coronavirus Essentials&nbsp </label>
  			<img src="images/nav_corona.png" alt="searchButton" class="navBarImage" />
  			<div class="CoronaDivToApp">
  				<table class="CoronaDivToAppTable">
  					<?php
						$con = mysqli_connect("localhost", "root", "", "web3") or die("unable to connect");
						$query = "SELECT name FROM product_type WHERE product_cat_id IN (SELECT id FROM product_category WHERE name = 'Corona Virus Essentials')";
						$res = mysqli_query($con, $query);
						if (mysqli_num_rows($res) > 0) {
							while ($rslt = mysqli_fetch_assoc($res)) {
								echo "<tr class='CoronaDivToAppTableTr'><td class='CoronaDivToAppTableTd' onclick='openPageCategorie(\"" . $rslt['name'] . "\");'>" . $rslt['name'] . "</td></tr>";
							}
						}
						mysqli_close($con);
						?>
  				</table>
  			</div>
  		</div>

  		<div class="NavBarAll navBarFoodButt">
  			<label class="buttStyle">Food Cupboard&nbsp </label>
  			<img src="images/nav_food.png" alt="searchButton" class="navBarImage" />
  			<div class="FoodDivToApp">
  				<table class="FoodDivToAppTable">
  					<?php
						$con = mysqli_connect("localhost", "root", "", "web3") or die("unable to connect");
						$query = "SELECT name FROM product_type WHERE product_cat_id IN (SELECT id FROM product_category WHERE name = 'Food Cupboard')";
						$res = mysqli_query($con, $query);
						if (mysqli_num_rows($res) > 0) {
							while ($rslt = mysqli_fetch_assoc($res)) {
								echo "<tr class='FoodDivToAppTableTr'><td class='FoodDivToAppTableTd' onclick='openPageCategorie(\"" . $rslt['name'] . "\");'>" . $rslt['name'] . "</td></tr>";
							}
						}
						mysqli_close($con);
						?>
  				</table>
  			</div>
  		</div>

  	</div>

  	<div id="responseRequestDiv"></div>

  	<div class="adminLogInPageDiv">
  		<div class="signUpLogInPageDivLogInDiv">
  			<div class="signUpLogInPageDivLogInDivLabelDiv">
  				<h2>Login as Admin</h2>
  			</div>
  			<br><br>
  			<div class="signUpLogInPageDivLogInDivUsrName">
  				<label>Username or email address</label><br><br>
  				<input id="adminNameEmailId" name="adminNameEmail" class="signUpLogInPageDivLogInDivUsrNameEmail" />
  			</div>
  			<br><br><br>
  			<div class="signUpLogInPageDivLogInDivUsrName">
  				<label>Password</label><br><br>
  				<input id="adminPasswordId" type="password" name="adminPassword" class="signUpLogInPageDivLogInDivUsrNameEmail" />
  			</div>
  			<br><br><br>
  			<button id="signUpLogInPageDivButtonId" class="signUpLogInPageDivLogInButton" onclick="logInAdmin();"><b>Log In</b></button>
  		</div>
  	</div>

  	<br><br><br>

  	<div class="HomPagDivSeven">
  		<label class="HomPagAbtPharmcy"><b>About Our Pharmacy</b></label>
  		<br>
  		<div class="HomPagDivSevenDivOfRecyclerView">
  			<div class="HomPagDivSevenDivOfRecyclerViewOne">
  				<img src="images/online-shop.png" alt="online-shop" class="HomPagDivSevenDivOfRecyclerViewImage" />
  			</div>
  			<br>
  			<div class="HomPagDivSevenDivOfRecyclerViewTwo">
  				<label class="HomPagDivSevenDivOfRecyclerViewTitle"><b>E-commerce Website</b></label>
  			</div>
  			<div class="HomPagDivSevenDivOfRecyclerViewThree">
  				Pharmacie hayek is a unique online Para pharmacy platform Catering Beauty Health & Wellness.
  			</div>
  		</div>
  		<div class="HomPagDivSevenDivOfRecyclerView">
  			<div class="HomPagDivSevenDivOfRecyclerViewOne">
  				<img src="images/consultant.png" alt="online-shop" class="HomPagDivSevenDivOfRecyclerViewImage" />
  			</div>
  			<br>
  			<div class="HomPagDivSevenDivOfRecyclerViewTwo">
  				<label class="HomPagDivSevenDivOfRecyclerViewTitle"><b>Online Consultations</b></label>
  			</div>
  			<div class="HomPagDivSevenDivOfRecyclerViewThree">
  				Pharmacie hayek offers on 24/7 basis free advices & consultations from accredited health care experts
  			</div>
  		</div>
  		<div class="HomPagDivSevenDivOfRecyclerView">
  			<div class="HomPagDivSevenDivOfRecyclerViewOne">
  				<img src="images/delivery.png" alt="online-shop" class="HomPagDivSevenDivOfRecyclerViewImage" />
  			</div>
  			<br>
  			<div class="HomPagDivSevenDivOfRecyclerViewTwo">
  				<label class="HomPagDivSevenDivOfRecyclerViewTitle"><b>Worldwide Shipping</b></label>
  			</div>
  			<div class="HomPagDivSevenDivOfRecyclerViewThree">
  				Pharmacie hayek Aims to serve you from the comfort of your home Delivery is available all over Lebanon
  			</div>
  		</div>
  		<div class="HomPagDivSevenDivOfRecyclerView">
  			<div class="HomPagDivSevenDivOfRecyclerViewOne">
  				<img src="images/authent.png" alt="online-shop" class="HomPagDivSevenDivOfRecyclerViewImage" />
  			</div>
  			<br>
  			<div class="HomPagDivSevenDivOfRecyclerViewTwo">
  				<label class="HomPagDivSevenDivOfRecyclerViewTitle"><b>Authentic Information</b></label>
  			</div>
  			<div class="HomPagDivSevenDivOfRecyclerViewThree">
  				All health content is written by qualified pharmacists and health professionals
  			</div>
  		</div>

  	</div>

  	<br><br><br>

  	<div class="HomPagDivEight">
  		<table class="HomPagDivEightTable">
  			<tr>
  				<th class="HomPagDivEightTableTh">Who we are</th>
  				<th class="HomPagDivEightTableTh">Our Policies</th>
  				<th class="HomPagDivEightTableTh">Our Shop</th>
  			</tr>
  			<tr>
  				<td class="HomPagDivEightTableTd">About us</td>
  				<td class="HomPagDivEightTableTd">Privacy Policy</td>
  				<td class="HomPagDivEightTableTd">Beauty</td>
  			</tr>
  			<tr>
  				<td class="HomPagDivEightTableTd">My Account</td>
  				<td class="HomPagDivEightTableTd">International Shipping</td>
  				<td class="HomPagDivEightTableTd">Supplements</td>
  			</tr>
  			<tr>
  				<td class="HomPagDivEightTableTd">Terms & Conditions</td>
  				<td class="HomPagDivEightTableTd">Terms & Conditions</td>
  				<td class="HomPagDivEightTableTd">Health & Wellness</td>
  			</tr>
  		</table>
  	</div>
  	<script>
  		$("#HomePageMyBagId").click(function() {
  			<?php if (!isset($_SESSION['userId'])) { ?>
  				alert("you have to log in first !");
  			<?php } else { ?>
  				window.location.href = "orderPage.php";
  			<?php } ?>
  		});

  		$("#HomePageDivOfLogIn").click(function() {
  			window.location.href = "signUpLogInPage.php";
  		});


  		$("#HomePagNavBarHomeId").click(function() {
  			window.location.href = "homePage.php";
  		});

  		var searchDivToApp = document.getElementById("navDivSearchDivToAppId");
  		var searchDivInp = document.getElementById("navDivSearchDivInpId");
  	</script>

  </body>

  </html>