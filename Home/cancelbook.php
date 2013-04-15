<?php
	ob_start();
	include ('pageaccess.php');
	$string = ob_get_contents();
	ob_end_clean();
	require '../Modules/dbhandler.php';
	header('Content-type: text/html');

	$ref = $_GET['ref'];
	$dbh = new dbhandler();
	if ($dbh->cancelOrder($ref, $email, $isAdmin)){
		//echo "<br/>Order $ref has been succesfully canceled<br/>";
		echo "<root><message>success</message><where>cancel</where></root>";
	}
	else {
		//echo "<br/>Cancel order $ref failed!<br/>";
		echo "<root><message>failure</message><where>cancel</where></root>";
	}

	//echo '<a href=userpage.php>Click Here To Go Back To User Page</a><br/>';

?>