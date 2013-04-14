<?php
//Check if the current user have the access to current page
include ('pageaccess.php');
?>

<!DOCTYPE html>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Room Booking System</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" />
	<link href="ui/css/redmond/jquery-ui-1.10.2.custom.css" rel="stylesheet">
	<script src="ui/js/jquery-1.9.1.js"></script>
	<script src="ui/js/jquery-ui-1.10.2.custom.js"></script>
	<script src="../Modules/jquery.form.js"></script>
	<script>
	$(function() {
		$( ".datepicker" ).datepicker({
			dateFormat: "yy-mm-dd"
		});
	});
	</script>
</head>
<body>
	<div class="mainPage">
		<div class="header">
			<h1 class="headerTitle">Groupate Hotel Booking</h1>
		</div>
		<div class="footer">
			<div class="linkGroup">
				<div class="aLink">
					<a class="aboutus" href="Home/about.php">About Us</a>
				</div>
			</div>
		</div>
	</div>
</body>
