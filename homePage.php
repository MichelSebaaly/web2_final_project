<!-- tozbit l tnen scroll bi alb products cat -->

<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="style.css">
	<script src="script.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
		// load the visualization api and corechart package
		google.charts.load('current', {
			'packages': ['corechart']
		});

		//set a callback to run when the google visualization api is loaded
		google.charts.setOnLoadCallback(getMostCateg);

		//this methods takes a 2 dimensional array and converts it to a DataTable
		//first we have the columns,then the data
		function getMostCateg() {
			var data = google.visualization.arrayToDataTable([
				['type_id', 'number'],
				<?php
				$con = mysqli_connect("localhost", "root", "", "web3") or die("unable to connect");
				$query = "SELECT count(oi.order_id)as numb_ord,pt.name as type_name,pt.id as type_id FROM order_items oi,products p,product_type pt WHERE (oi.product_id = p.id AND p.type_id = pt.id) GROUP BY pt.id ORDER BY numb_ord DESC LIMIT 5";
				$res = mysqli_query($con, $query);
				while ($fetch = mysqli_fetch_assoc($res)) {
					echo "['" . $fetch['type_name'] . "'," . $fetch['numb_ord'] . "],";
				}
				?>
			]);

			//set chart options
			var options = {
				// title: 'Most categories with products',
				is3D: true
			};

			// instantiate and draw our chart, passing in some options
			var chart = new google.visualization.PieChart(document.getElementById('IdDivOfChartDiagram'));
			chart.draw(data, options);
		}
	</script>
</head>

<body style="margin:0px;overflow-x:hidden;">

	<?php

	$loggedIn = false;
	if ((isset($_SESSION['userId'])) && (isset($_SESSION['email']))) {
		$loggedIn = true;
	} else {
		if ((isset($_SESSION['userId'])) && (isset($_SESSION['userName'])) && (!isset($_SESSION['email']))) {
			$loggedIn = true;
		} else {
			$loggedIn = false;
		}
	}

	?>
	<div class="navDiv">
		<div class="navDivIcon">
			<!-- <img src="images/icon.jpeg" class="iconStyle" /> -->
		</div>
		<!-- //Search -->
		<div class="navDivSearch">
			<div class="navDivSearchDiv">
				<input id="navDivSearchDivInpId" class="navDivSearchDivInput" placeholder="Search..." onkeyup="searchProducts(this.value);" onfocus="searchProductsIfNotEmpty(this.value);" />
			</div>
			<div id="navDivSearchDivToAppId" class="navDivSearchDivToAppTrans">
				<table id="navDivSearchDivToAppTablId" class="navDivSearchDivToAppTablClass">
					<?php
					?>
				</table>
			</div>

		</div>
		<!-- Login -->
		<div class="navDivLogIn" id="HomePageLogInId">
			<div id="HomePageDivOfLogIn">
				<div><img src="images/logIn.png" alt="logInButton" width="40px" height="40px" /></div>
				<div class="navDivText">Log In</div>
			</div>

			<div class="LogInDivToApp">
				<div class="LogInDivToAppSignInDiv"><label class="LogInDivToAppSignIn"><b>Sign in</b></label></div>
				<div class="LogInDivToAppCreateAccDiv"><a href="register.php" class="LogInDivToAppCreateAcc">Create an account</a></div>
				<hr>
				<div class="LogInDivToAppUserNameEmailDiv"><label class="LogInDivToAppUserNameEmail">Username or Email</label><br>
					<input name="LogInUserNameEmail" class="LogInDivToAppUserNameEmailClass" id="LogInDivToAppUserNameEmailId" placeholder="Email or User name" />
				</div>
				<div class="LogInDivToAppPasswordDiv"><label class="LogInDivToAppPassword">Password</label><br>
					<input name="LogInPassword" type="password" class="LogInDivToAppPasswordClass" id="LogInDivToAppPassId" placeholder="Password" />
				</div>
				<button class="LogInDivToAppLogInButton" onclick="loginUser(this.id);">Log In</button>
			</div>
		</div>

		<!-- Logout -->
		<div class="navDivLogOutInvisible" id="HomePageLogOutId">
			<div id="HomePageDivOfLogOut">
				<div><img src="images/logOut.png" alt="logOutButton" width="40px" height="40px" /></div>
				<div class="navDivText">Log Out</div>
			</div>
		</div>

		<!-- cart -->
		<div class="navDivMyBag" id="HomePageMyBagId">
			<div id="navDivBagDiv">
				<div><img src="images/myBag.png" alt="logInButton" width="40px" height="40px" /></div>
				<div class="navDivText">My Bag</div>
			</div>
			<div class="MyBagDivToApp">
				<?php
				if ($loggedIn == false) {
					echo "you have to log In first !";
				} else {
					echo $_SESSION['DesignOfMyProducts'];
				}
				?>

			</div>
		</div>


		<!-- profile -->
		<div class="navDivProfile" id="HomePageProfileId" onclick="goToProfilePage();">
			<div><img src="images/moreInfo.png" alt="moreInfo" width="40px" height="40px" /></div>
			<div class="navDivText">Profile</div>
			<!--<div class="MyBagDivToApp">
			<?php
			?>
			
		</div>-->
		</div>
	</div>

	<?php

	if (!$loggedIn) {
	?>
		<script>
			var profile = document.getElementById("HomePageProfileId").classList;
			var logIn = document.getElementById("HomePageLogInId").classList;
			var logOut = document.getElementById("HomePageLogOutId").classList;

			if (logIn.contains("navDivLogInInvisible")) {
				if (logOut.contains("navDivLogOut")) {
					logIn.remove("navDivLogInInvisible");
					logIn.add("navDivLogIn");
					logOut.remove("navDivLogOut");
					logOut.add("navDivLogOutInvisible");

					if (profile.contains("navDivProfile")) {
						profile.remove("navDivProfile");
						profile.add("navDivProfileInvisible");
					}
				}
			} else {
				if (profile.contains("navDivProfile")) {
					profile.remove("navDivProfile");
					profile.add("navDivProfileInvisible");
				}
			}
		</script>

	<?php
	} else {
	?>
		<script>
			var profile = document.getElementById("HomePageProfileId").classList;
			var logIn = document.getElementById("HomePageLogInId").classList;
			var logOut = document.getElementById("HomePageLogOutId").classList;

			if (logIn.contains("navDivLogIn")) {
				if (logOut.contains("navDivLogOutInvisible")) {
					logIn.remove("navDivLogIn");
					logIn.add("navDivLogInInvisible");
					logOut.remove("navDivLogOutInvisible");
					logOut.add("navDivLogOut");


					if (profile.contains("navDivProfileInvisible")) {
						profile.remove("navDivProfileInvisible");
						profile.add("navDivProfile");
					}
				}
			}
		</script>

	<?php
	}
	// if($loggedIn){

	// }

	?>

	<!-- nav Categories -->
	<div class="navigationBar">
		<div class="NavBarAll navBarHomeButt" id="HomePagNavBarHomeId">
			<label class="buttStyle">Home&nbsp </label>
			<img src="images/home.png" alt="searchButton" class="navBarImage" />
		</div>

		<div class="NavBarAll navBarBeautyButt">
			<label class="buttStyle">Beauty&nbsp </label>
			<img src="images/nav_beauty.png" alt="beautyImg" class="navBarImage" />
			<div class="BeautyDivToApp">
				<table class="BeautyDivToAppTable">
					<?php
					$con = mysqli_connect("localhost", "root", "", "web3") or die("unable to connect");
					$query = "SELECT name FROM product_type WHERE product_cat_id IN (SELECT id FROM product_category WHERE name = 'Beauty')";
					$res = mysqli_query($con, $query);
					if (mysqli_num_rows($res) > 0) {
						while ($rslt = mysqli_fetch_assoc($res)) {
							echo "<tr class='BeautyDivToAppTableTr'><td class='BeautyDivToAppTableTd' onclick='openPageCategorie(\"" . $rslt['name'] . "\");'>" . $rslt['name'] . "</td></tr>"; //'openPageCategorie(\".$rslt['name']."\);'
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
					$query = "SELECT name FROM product_type WHERE product_cat_id LIKE (SELECT id FROM product_category WHERE name = 'Supplements')";
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


	<div class="HomePageDivFrstImg">
		<img src="images/klorane_second_image.png" class="HomeFrstImage" />
	</div>

	<br>
	<!-- trending products -->
	<div class="HomPagDivThird">
		<label class="HomPagTrendProdLab"><b>Trending Products</b></label>
		<div class="HomPagDivThirdFlecheDiv">
			<img src="images/left.png" id="HomPagDivThirdPrevButt" class="HomPagDivThirdNextPrev" />
			<img src="images/right.png" id="HomPagDivThirdNextButt" class="HomPagDivThirdNextPrev" />
		</div>
		<br>
		<div class="HomPagDivThirdAllProd">

			<?php
			$con = mysqli_connect("localhost", "root", "", "web3") or die("unable to connect");
			$query = "SELECT * FROM products ORDER BY RAND() limit 8";
			$res = mysqli_query($con, $query);

			while ($rslt = mysqli_fetch_assoc($res)) {
				echo "<div class='HomPagDivThirdDivOfRecyclerViewFrst' onclick='selectThisProduct(\"" . $rslt['id'] . "\");'>";
				echo "<img src='images/" . $rslt['image'] . "' class='HomPagDivThirdProdImages'/>";
				echo "<br><br><div class='HomPagDivThirdProdNam'><b><label class='HomPagDivThirdProdNamLab' onclick='selectThisProduct(\"" . $rslt['id'] . "\");'>" . $rslt['name'] . "</label></b></div>";
				echo "<label class='HomPagDivThirdProdPrice'>" . $rslt['price'] . "L.L.</label>";
				echo "<br><br><div class='HomPagDivThirdProdBuyDiv'><img src='images/shopping-cart.png' class='HomPagDivThirdProdBuyLogo'/>";
				echo "<div class='HomPagDivThirdProdBuyDivLabel'>Add to Cart</div></div>";
				echo "</div>";
			}
			mysqli_close($con);
			?>
		</div>
	</div>

	<br><br><br><br><br><br>

	<div class="HomPagDivFour">
		<label class="HomPagPopProdcts"><b>Popular Categories</b></label>
		<br>
		<div class="HomPagDivFourAllCatg">
			<div class="HomPagDivFourDivOfRecyclerView">
				<img src="images/beauty-blue.png" alt="beauty" class="HomPagDivFourDivOfRecyclerViewImage" /><br><br>
				<label class="HomPagDivFourDivOfRecyclerViewText"><b>Beauty</b></label>
			</div>
			<div class="HomPagDivFourDivOfRecyclerView">
				<img src="images/hair-care-blue.png" alt="beauty" class="HomPagDivFourDivOfRecyclerViewImage" /><br><br>
				<label class="HomPagDivFourDivOfRecyclerViewText"><b>Hair care</b></label>
			</div>
			<div class="HomPagDivFourDivOfRecyclerView">
				<img src="images/sun-care-blue.png" alt="beauty" class="HomPagDivFourDivOfRecyclerViewImage" /><br><br>
				<label class="HomPagDivFourDivOfRecyclerViewText"><b>Sun protection</b></label>
			</div>
			<div class="HomPagDivFourDivOfRecyclerView">
				<img src="images/maternity-blue.png" alt="beauty" class="HomPagDivFourDivOfRecyclerViewImage" /><br><br>
				<label class="HomPagDivFourDivOfRecyclerViewText"><b>Maternity necessities</b></label>
			</div>
			<div class="HomPagDivFourDivOfRecyclerView">
				<img src="images/fitness-blue.png" alt="beauty" class="HomPagDivFourDivOfRecyclerViewImage" /><br><br>
				<label class="HomPagDivFourDivOfRecyclerViewText"><b>Fitness</b></label>
			</div>
			<div class="HomPagDivFourDivOfRecyclerView">
				<img src="images/supplements-blue.png" alt="beauty" class="HomPagDivFourDivOfRecyclerViewImage" /><br><br>
				<label class="HomPagDivFourDivOfRecyclerViewText"><b>Supplements</b></label>
			</div>
			<div class="HomPagDivFourDivOfRecyclerView">
				<img src="images/weight-loss-blue.png" alt="beauty" class="HomPagDivFourDivOfRecyclerViewImage" /><br><br>
				<label class="HomPagDivFourDivOfRecyclerViewText"><b>Weight loss</b></label>
			</div>

		</div>
		<br>

	</div>

	<br><br><br>
	<!-- chart -->
	<div class="divOfChart">
		<label class="HomPagPopProdcts"><b>Popular Products types</b></label>
		<div class="divOfChartDiagram" id="IdDivOfChartDiagram"></div>
	</div>

	<br><br><br>
	<!-- featured brands -->
	<div class="HomPagDivFifth">
		<label class="HomPagFeaturedBrands"><b>Featured Brands</b></label>
		<div class="HomPagDivThirdFlecheDiv">
			<img src="images/left.png" id="HomPagDivFifthPrevButt" class="HomPagDivThirdNextPrev" />
			<img src="images/right.png" id="HomPagDivFifthNextButt" class="HomPagDivThirdNextPrev" />
		</div>
		<br>
		<div class="HomPagDivFifthAllRecyclerView" id="HomPagDivFifthAllRecyclerViewId">
			<div class="HomPagDivFifthDivOfRecyclerView">
				<img src="images/Beesline.jpg" alt="beesline" class="HomPagFeaturedBrandsImage" />
			</div>
			<div class="HomPagDivFifthDivOfRecyclerView">
				<img src="images/mustela.jpg" alt="mustela" class="HomPagFeaturedBrandsImage" />
			</div>
			<div class="HomPagDivFifthDivOfRecyclerView">
				<img src="images/phyto.jpg" alt="phyto" class="HomPagFeaturedBrandsImage" />
			</div>
			<div class="HomPagDivFifthDivOfRecyclerView">
				<img src="images/roge_cavailles.jpg" alt="roge_cavailles" class="HomPagFeaturedBrandsImage" />
			</div>
			<div class="HomPagDivFifthDivOfRecyclerView">
				<img src="images/cetaphil.jpg" alt="cetaphil" class="HomPagFeaturedBrandsImage" />
			</div>
			<div class="HomPagDivFifthDivOfRecyclerView">
				<img src="images/eucerin.jpg" alt="eucerin" class="HomPagFeaturedBrandsImage" />
			</div>
			<div class="HomPagDivFifthDivOfRecyclerViewLast">
				<img src="images/uriage.jpg" alt="uriage" class="HomPagFeaturedBrandsImage" />
			</div>
		</div>
	</div>

	<br><br><br>
	<!-- blogs -->
	<div class="HomPagDivSix">
		<label class="HomPagFeaturedBrands"><b>Our Blogs</b></label>
		<div class="HomPagDivThirdFlecheDiv">
			<img src="images/left.png" id="HomPagDivSixPrevButt" class="HomPagDivThirdNextPrev" />
			<img src="images/right.png" id="HomPagDivSixNextButt" class="HomPagDivThirdNextPrev" />
		</div>
		<br><br>
		<div class="HomPagDivSixDivOfAll">
			<div class="HomPagDivSixDivOfRecyclerViewFrst">
				<img src="images/summer_skincare_routine.jpg" class="HomPagDivSixDivOfRecyclerViewImage" /><br>
				<label class="HomPagDivSixDivOfRecyclerViewLabel"><b>Summer skin care Routine</b></label>
				<div class='HomPagDivSixReadMore'><img src='images/add_black.png' class='HomPagDivSixReadMoreLogo' />
					<div class='HomPagDivSixReadMoreLabel'>Read More</div>
				</div>
			</div>
			<div class="HomPagDivSixDivOfRecyclerView">
				<img src="images/all_about_hyperpigmentation.jpg" class="HomPagDivSixDivOfRecyclerViewImage" /><br>
				<label class="HomPagDivSixDivOfRecyclerViewLabel"><b>All about hyperpigmentation</b></label>
				<div class='HomPagDivSixReadMore'><img src='images/add_black.png' class='HomPagDivSixReadMoreLogo' />
					<div class='HomPagDivSixReadMoreLabel'>Read More</div>
				</div>
			</div>
			<div class="HomPagDivSixDivOfRecyclerView">
				<img src="images/all_you_need_to_know_about_retinol.jpg" class="HomPagDivSixDivOfRecyclerViewImage" /><br>
				<label class="HomPagDivSixDivOfRecyclerViewLabel"><b>all you need to know about retinol</b></label>
				<div class='HomPagDivSixReadMore'><img src='images/add_black.png' class='HomPagDivSixReadMoreLogo' />
					<div class='HomPagDivSixReadMoreLabel'>Read More</div>
				</div>
			</div>
			<div class="HomPagDivSixDivOfRecyclerView">
				<img src="images/winter_skin_care_tips.jpg" class="HomPagDivSixDivOfRecyclerViewImage" /><br>
				<label class="HomPagDivSixDivOfRecyclerViewLabel"><b>winter skin care tips</b></label>
				<div class='HomPagDivSixReadMore'><img src='images/add_black.png' class='HomPagDivSixReadMoreLogo' />
					<div class='HomPagDivSixReadMoreLabel'>Read More</div>
				</div>
			</div>
			<div class="HomPagDivSixDivOfRecyclerView">
				<img src="images/rosacea.jpg" class="HomPagDivSixDivOfRecyclerViewImage" /><br>
				<label class="HomPagDivSixDivOfRecyclerViewLabel"><b>rosacea</b></label>
				<div class='HomPagDivSixReadMore'><img src='images/add_black.png' class='HomPagDivSixReadMoreLogo' />
					<div class='HomPagDivSixReadMoreLabel'>Read More</div>
				</div>
			</div>
			<div class="HomPagDivSixDivOfRecyclerView">
				<img src="images/psoriasis.jpg" class="HomPagDivSixDivOfRecyclerViewImage" /><br>
				<label class="HomPagDivSixDivOfRecyclerViewLabel"><b>psoriasis</b></label>
				<div class='HomPagDivSixReadMore'><img src='images/add_black.png' class='HomPagDivSixReadMoreLogo' />
					<div class='HomPagDivSixReadMoreLabel'>Read More</div>
				</div>
			</div>
			<div class="HomPagDivSixDivOfRecyclerView">
				<img src="images/dry_skin.jpg" class="HomPagDivSixDivOfRecyclerViewImage" /><br>
				<label class="HomPagDivSixDivOfRecyclerViewLabel"><b>dry skin</b></label>
				<div class='HomPagDivSixReadMore'><img src='images/add_black.png' class='HomPagDivSixReadMoreLogo' />
					<div class='HomPagDivSixReadMoreLabel'>Read More</div>
				</div>
			</div>
			<div class="HomPagDivSixDivOfRecyclerViewLst">
				<img src="images/oily_skin.jpg" class="HomPagDivSixDivOfRecyclerViewImage" /><br>
				<label class="HomPagDivSixDivOfRecyclerViewLabel"><b>oily skin</b></label>
				<div class='HomPagDivSixReadMore'><img src='images/add_black.png' class='HomPagDivSixReadMoreLogo' />
					<div class='HomPagDivSixReadMoreLabel'>Read More</div>
				</div>
			</div>
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
				Pharmacie Sebaaly is a unique online Para pharmacy platform Catering Beauty Health & Wellness.
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
				Pharmacie Sebaaly offers on 24/7 basis free advices & consultations from accredited health care experts
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
				Pharmacie Sebaaly Aims to serve you from the comfort of your home Delivery is available all over Lebanon
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
		$("#HomPagDivFifthNextButt").click(function() {
			event.preventDefault();
			$(".HomPagDivFifthAllRecyclerView").animate({
				scrollLeft: "+=260px"
			}, "slow");
		});

		$("#HomPagDivFifthPrevButt").click(function() {
			event.preventDefault();
			$(".HomPagDivFifthAllRecyclerView").animate({
				scrollLeft: "-=260px"
			}, "slow");

		});

		$("#HomPagDivThirdPrevButt").click(function() {
			event.preventDefault();
			$(".HomPagDivThirdAllProd").animate({
				scrollLeft: "-=260px"
			}, "slow");

		});

		$("#HomPagDivThirdNextButt").click(function() {
			event.preventDefault();
			$(".HomPagDivThirdAllProd").animate({
				scrollLeft: "+=260px"
			}, "slow");

		});


		$("#HomePagNavBarHomeId").click(function() {
			window.location.href = "homePage.php";
		});

		$("#HomePageDivOfLogIn").click(function() {
			window.location.href = "signUpLogInPage.php";
		});

		$("#HomePageProfileId").click(function() {
			window.location.href = "profilePage.php";
		});

		$("#HomePageLogOutId").click(function() {
			if (confirm("Do you want to log out?")) {
				window.location.href = "logOutFunction.php";
			} else {
				return;
			}
		});

		$("#HomPagDivSixPrevButt").click(function() {
			event.preventDefault();
			$(".HomPagDivSixDivOfAll").animate({
				scrollLeft: "-=445px"
			}, "slow");
		});

		$("#HomPagDivSixNextButt").click(function() {
			event.preventDefault();
			$(".HomPagDivSixDivOfAll").animate({
				scrollLeft: "+=445px"
			}, "slow");
		});

		$("#MyBagDivToAppAllMyPrdctBtnId").click(function() {
			window.location.href = "orderPage.php";
		});

		$("#navDivBagDiv").click(function() {
			<?php if (!isset($_SESSION['userId'])) { ?>
				alert("you have to log in first !");
			<?php } else { ?>
				window.location.href = "orderPage.php";
			<?php } ?>
		});

		var searchDivToApp = document.getElementById("navDivSearchDivToAppId");
		var searchDivInp = document.getElementById("navDivSearchDivInpId");
	</script>

</body>

</html>