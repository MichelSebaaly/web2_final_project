 <?php 
	// Import PHPMailer classes into the global namespace 
	use PHPMailer\PHPMailer\PHPMailer; 
	use PHPMailer\PHPMailer\SMTP; 
	use PHPMailer\PHPMailer\Exception; 
 
	// Include library files 
	require 'PHPMailer-master/src/Exception.php'; 
	require 'PHPMailer-master/src/PHPMailer.php'; 
	require 'PHPMailer-master/src/SMTP.php'; 
 
	if((isset($_POST['email']))&&(!empty($_POST['email']))){
		$email = $_POST['email'];
	}
	
	$changePassword = false;
	$alphabet = "abcdefghijklmnopqrstuvwxyz1234567890";
	$pass = array();
	$alpahbetLength = strlen($alphabet)-1;
	for($i = 0 ; $i < 8 ; $i++){
		$rand = rand(0,$alpahbetLength);
		$pass[] = $alphabet[$rand];
	}
	
	// from array to string
	$password = implode($pass);
 
 
	// Create an instance; Pass `true` to enable exceptions 
	$mail = new PHPMailer;
 
	// Server settings 
	//$mail->SMTPDebug = SMTP::DEBUG_SERVER;    //Enable verbose debug output 
	$mail->isSMTP();                            // Set mailer to use SMTP 
	$mail->Host = 'smtp.gmail.com';           // Specify main and backup SMTP servers 
	$mail->SMTPAuth = true;                     // Enable SMTP authentication 
	$mail->Username = 'pierre.hayek@isae.edu.lb';       // SMTP username 
	$mail->Password = 'pierrehayek20.,.';         // SMTP password 
	$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted 
	$mail->Port = 587;                          // TCP port to connect to 
 
	// Sender info 
	$mail->setFrom('pierre.hayek@isae.edu.lb', 'Pharmacy hayek'); 
	// $mail->addReplyTo('reply@example.com', 'SenderName'); 
	
	// Add a recipient 
	$mail->addAddress($email); 
	
	// Set email format to HTML 
	$mail->isHTML(true); 
	
	// Mail subject 
	$mail->Subject = 'Your new password';

	// Mail body content 
	$mail->Body = $password; 
 
	// Send email 
	if(!$mail->send()) { 
		echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
		// echo 'error';
	} else { 
		echo 'Message has been sent.'; 
		$changePassword = true;
	}
	
	if($changePassword){
		$con = mysqli_connect("localhost","root","","web3") or die("unable to connect");
		$query = "UPDATE users SET password = '".$password."' WHERE email = '".$email."'";
		$res = mysqli_query($con,$query);
		if(!$res){
			echo "Error with new password !";
		}
	}
 ?>