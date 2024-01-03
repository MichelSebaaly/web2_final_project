 <?php
	$addrss = $_POST['addressLine'];
	$city = $_POST['city'];
	$nearTo = $_POST['nearTo'];
	$country = $_POST['country'];
	
	$temps = time();
	$cookAddr = "cook_address";
	$cookCit = "cook_city";
	$cookNearTo = "cook_near_to";
	$cookCountry = "cook_country";
	
	// setCookie($cookAddr);
	// setCookie($cookCit);
	// setCookie($cookNearTo);
	// setCookie($cookCountry);
	
	
		
	
	
		if((isset($_COOKIE[$cookAddr]))&&($_COOKIE[$cookCit])&&($_COOKIE[$cookNearTo])&&($_COOKIE[$cookCountry])){
			echo "cookie > 0 (1)";
		}else{
				echo "cookie < 0";
			}	
		
	
	// if((!isset($_COOKIE[$cookAddr]))&&(!isset($_COOKIE[$cookCit]))&&(!isset($_COOKIE[$cookNearTo]))&&(!isset($_COOKIE[$cookCountry]))){
		// echo "no cookie";
		setCookie($cookAddr,$addrss,$temps);
		setCookie($cookCit,$city,$temps);
		setCookie($cookNearTo,$nearTo,$temps);
		setCookie($cookCountry,$country,$temps);
	// }else{
		// echo "fi cookie";
		// unset($_COOKIE[$cookAddr]);
		// unset($_COOKIE[$cookCit]);
		// unset($_COOKIE[$cookNearTo]);
		// unset($_COOKIE[$cookCountry]);
		// setCookie($cookAddr,null,$temps - 1);
		// setCookie($cookCit,null,$temps - 1);
		// setCookie($cookNearTo,null,$temps - 1);
		// setCookie($cookCountry,null,$temps - 1);
	// }
	
	
	
	// if(isset($_COOKIE)){
		// echo $_COOKIE[$cookAddr]." ".$_COOKIE[$cookCit]." ".$_COOKIE[$cookNearTo]." ".$_COOKIE[$cookCountry];
	// }else{
		// echo "cookie <= 0";
	// }
 ?>