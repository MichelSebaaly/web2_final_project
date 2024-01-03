 <?php
	session_start();
	$userNameEmail = $_POST['nameEmail'];
	$userPassword = $_POST['userPassword'];
	$continue = 0;
	$dateTdy = date("Y-m-d");

	$con = mysqli_connect("localhost", "root", "", "web3") or die("unable to connect");

	if (strpos($userNameEmail, "@gmail.com") > 0) {
		$query = "SELECT * FROM users WHERE (email = '" . $userNameEmail . "' AND password = '" . $userPassword . "' AND is_admin = '0')";
		$res = mysqli_query($con, $query);
		if (mysqli_num_rows($res) == 1) {
			$rslt = mysqli_fetch_assoc($res);
			$_SESSION['userName'] = $rslt['user_name'];
			$_SESSION['email'] = $rslt['email'];
			$_SESSION['password'] = $rslt['password'];
			$_SESSION['userId'] = $rslt['id'];
			$_SESSION['phoneNumb'] = $rslt['phoneNumber'];
			$_SESSION['AllMyProducts'] = array();
			$_SESSION['DesignOfMyProducts'] = "";
			$_SESSION['quantityOfEachProduct'] = array();
			$_SESSION['totalPrice'] = 0;
			$_SESSION['priceOfEachProduct'] = array();

			$queryGetAddrss = "SELECT * FROM user_address WHERE user_id = '" . $_SESSION['userId'] . "'";
			$resAddrss = mysqli_query($con, $queryGetAddrss);
			$fetchAddrss = mysqli_fetch_assoc($resAddrss);
			$_SESSION['addressLine'] = $fetchAddrss['address_line'];
			$_SESSION['addressCity'] = $fetchAddrss['city'];
			$_SESSION['addressNearTo'] = $fetchAddrss['near_to'];

			$queryGetSessionId = "SELECT count(session_id) as Numb FROM shopping_session";
			$resGetSession = mysqli_query($con, $queryGetSessionId);
			$fetchGetSession = mysqli_fetch_assoc($resGetSession);
			if ($fetchGetSession['Numb'] == 0) {
				$_SESSION['sessionId'] = 1;
			} else {
				$queryInsertSession = "SELECT MAX(session_id) as max FROM shopping_session";
				$resultInsertSess = mysqli_query($con, $queryInsertSession);
				$resInsertFetch = mysqli_fetch_assoc($resultInsertSess);
				$_SESSION['sessionId'] = $resInsertFetch['max'] + 1;
			}
			echo "true";
			mysqli_close($con);
			exit();
			// }
		} else {
			echo "error with username/email or password";
		}
	} else {
		$query = "SELECT * FROM users WHERE  (user_name = '" . $userNameEmail . "' AND password = '" . $userPassword . "' AND is_admin = '0')";
		$res = mysqli_query($con, $query);
		if (mysqli_num_rows($res) == 1) {
			$rslt = mysqli_fetch_assoc($res);
			$_SESSION['userName'] = $rslt['user_name'];
			$_SESSION['email'] = $rslt['email'];
			$_SESSION['userId'] = $rslt['id'];
			$_SESSION['password'] = $rslt['password'];
			$_SESSION['phoneNumb'] = $rslt['phoneNumber'];
			$_SESSION['AllMyProducts'] = array();
			$_SESSION['DesignOfMyProducts'] = "";
			$_SESSION['quantityOfEachProduct'] = array();
			$_SESSION['totalPrice'] = 0;
			$_SESSION['priceOfEachProduct'] = array();

			$queryGetAddrss = "SELECT * FROM user_address WHERE user_id = '" . $_SESSION['userId'] . "'";
			$resAddrss = mysqli_query($con, $queryGetAddrss);
			$fetchAddrss = mysqli_fetch_assoc($resAddrss);
			$_SESSION['addressLine'] = $fetchAddrss['address_line'];
			$_SESSION['addressCity'] = $fetchAddrss['city'];
			$_SESSION['addressNearTo'] = $fetchAddrss['near_to'];

			$queryGetSessionId = "SELECT count(session_id) as Numb FROM shopping_session";
			$resGetSession = mysqli_query($con, $queryGetSessionId);
			$fetchGetSession = mysqli_fetch_assoc($resGetSession);
			if ($fetchGetSession['Numb'] == 0) {
				$_SESSION['sessionId'] = 1;
			} else {
				$queryInsertSession = "SELECT MAX(session_id) as max FROM shopping_session";
				$resultInsertSess = mysqli_query($con, $queryInsertSession);
				$resInsertFetch = mysqli_fetch_assoc($resultInsertSess);
				$_SESSION['sessionId'] = $resInsertFetch['max'] + 1;
			}
			echo "true";
			mysqli_close($con);
			exit();
			// }
		} else {
			echo "wrong username/email or password";
		}
	}
	?>