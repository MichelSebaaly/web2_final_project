 <?php
	$prodName = $_POST['productName'];
	$con = mysqli_connect("localhost","root","","web3") or die ("Unable to connect !");
	$query = "SELECT * FROM products WHERE name = '".$prodName."'";
 ?>