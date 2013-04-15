<html>

	<head></head>

	<body>

<?php //This block verify the user identity: match the email and password.
	ob_start();
	include ('pageaccess.php');
	$string = ob_get_contents();
	ob_end_clean();
	require '../Modules/dbhandler.php';
	header('Content-type: text/html');
	
	$ref = $_REQUEST["referenceNo"];
	$checkIn = $_REQUEST["new_Checkin_date"];
	$checkOut = $_REQUEST["new_Checkout_date"];
	
	//echo $ref;
	/*
	echo $checkIn;
	echo $checkOut;
	*/
	try {
		$dbh = new dbhandler();
		if ($dbh->modifyDate($ref, $email, $isAdmin, $checkIn, $checkOut)){
			/*
			echo "<br/>Date of Order $ref has been succesfully changed<br/>";
			echo "<br/>The New Check In Date is $checkIn";
			echo "<br/>The New Check Out Date is $checkOut";
			*/
			echo "<root><message>success</message><where>modify</where></root>";
		}
	else {
		//echo "<br/>Modify Date of order $ref failed!<br/>";
		echo "<root><message>failure</message><where>modify</where></root>";
	}

	}
	catch (Exception $e){
		//echo "<br/>Modify Date of order $ref failed!<br/>";
		echo "<root><message>failure</message><where>modify</where></root>";
	}

	//echo '<a href=userpage.php>Click Here To Go Back To User Page</a><br/>';


?>
</body>
</html>