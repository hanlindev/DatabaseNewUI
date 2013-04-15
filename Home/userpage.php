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
	<link rel="stylesheet" href="css/userpagestyle.css" type="text/css" />
	<link href="ui/css/redmond/jquery-ui-1.10.2.custom.css" rel="stylesheet">
	<script src="ui/js/jquery-1.9.1.js"></script>
	<script src="ui/js/jquery-ui-1.10.2.custom.js"></script>
	<script src="../Modules/jquery.form.js"></script>
	<script src="../Modules/jquery.cycle.all.js"></script>
	<script src="../Modules/jquery.transit.min.js"></script>
	<script>
	$(function() {
		$(".datepicker").datepicker({
			dateFormat: "yy-mm-dd"
		});

		$(".aDialog").dialog({
			autoOpen: false,
			width: 400
		});
	});
	</script>
	<script>
	$(document).ready(function() {
		$("#welcomeMsg").appendTo("#welcomeDiv");

		$("#modifyForm").ajaxForm({
			dataType: 'xml',
			success: processResult
		})

		$("#changeUserInfoForm").ajaxForm({
			dataType: 'xml',
			success: processInfoResult
		})
	});
	</script>
	<script>
	function echoValues(index){
	
	 var refNo = "referenceNo";
	 var refValues = document.getElementsByName(refNo);
	 var currentRafValue = refValues[index].value;
	 
	 
	 var checkinDateName = "new_Checkin_date";
	 var checkinDates = document.getElementsByName(checkinDateName);
	 var currentcheckinDate = checkinDates[index].value;
	 
	 var checkoutDateName = "new_Checkout_date";
	 var checkoutDates = document.getElementsByName(checkoutDateName);
	 var currentcheckoutDate = checkoutDates[index].value;
	 
	 alert(currentRafValue + currentcheckinDate + currentcheckoutDate);
	}
	
	function updateCheckInDate(element,index){
	  
		var date = element.value;
		
		var checkinDateName = "new_Checkin_date";
		var checkinDates = document.getElementsByName(checkinDateName);
		checkinDates[index].value = date;
		
	}
	
	function updateCheckOutDate(element,index){
	  
		var date = element.value;
		
		var checkinDateName = "new_Checkin_date";
		var checkinDates = document.getElementsByName(checkinDateName);
		checkinDates[index].value = date;
		
	}
	
	function updateCheckOutDate(element,index){
	  
		var date = element.value;
		
		var checkOutDateName = "new_Checkout_date";
		var checkOutDates = document.getElementsByName(checkOutDateName);
		checkOutDates[index].value = date;
		
	}

	function startAjax(link) {
		$.ajax({
			url: link,
			dataType: 'xml',
			success: processResult
		});
	}

	function processResult(response) {
		var message = $('message', response).text();
		if (message == 'success') {
			$("#successfulDialog").dialog("open");
		} else {
			var source = $('source', response).text();
			if (source == 'modify') {
				$("#failedDialog").dialog("open");
			} else {
				$("#noCancelDialog").dialog("open");
			}
		}
	}

	function processInfoResult(response) {
		var message = $('message', response).text();
		if (message == 'success') {
			$("#successfulInfoDialog").dialog("open");
		} else {
			var source = $('source', response).text();
			$("#failedInfoDialog").dialog("open");
		}
	}
	</script>
</head>
<body>
	<!--<button id="testButton">Test This</button>-->
	<!-- Main Page-->
	<div class="mainPage">
		<!-- Navigator bar -->
		<div class="tableDiv navigatorBar">
			<div id="welcomeDiv" class="tableDivCell welcomeMessage">
			</div>
			<div class="tableDivCell navigatorCell">
				<a href="home.php" id="home">Home</a>
			</div>
			<div class="tableDivCell navigatorCell">
				<a href="userpage.php" id="user">My Account</a>
			</div>
		</div>
		<!-- header -->
		<div class="header">
			<h1 class="headerTitle">Groupate Hotel Booking</h1>
		</div>

		<!-- page content -->
		<div class="pageContent">
			<div class="tableDiv">
				<div id="changeInfoWrapper tableDivCell" style="height: 200px;">
					<div id="changeUserInfoDiv">
						<h3>Change User Info</h3>
						<form id="changeUserInfoForm" action="changeUserInfo.php" method="post">
							<p>User Name:
							<input name="new_user_name" type="text"></p>
							<p>New Password:
							<input name="new_password" type="password"></p>
							<input name="change" type="submit" value="Submit"/>
						</form>
					</div>
				</div>
			</div>
			<div>
				<?php 
					//use php code to get the list of all bookings
					if ($isAdmin) {
						require 'drawAdminTable.php';
						phpmyadmin();
						drawTable();
						drawCancelledOrderTable();

					} else {
						require 'drawUserOrderTable.php';
						drawTable($email);
						drawCancelledOrderTable($email);
					}
					
				?>
			</div>
		</div>
		<div class="footer">
			<div class="linkGroup">
				<div class="aLink">
					<a class="aboutus" href="Home/about.php">About Us</a>
				</div>
			</div>
		</div>
	</div>
	<div id="successfulDialog" title="Thank you!" class="aDialog">
		<p>We have updated your checkin/checkout date or canceled your booking. Please refresh to verify the change. Thank you!</p>
	</div>

	<div id="failedDialog" title="We are sorry!" class="aDialog">
		<p>We can't process your request at this moment. This is probably because there is not enough vacancy. Please try again later or search for another hotel.</p>
	</div>

	<div id="noCancelDialog" title="We are sorry!" class="aDialog">
		<p>Somehow we can't cancel your booking. Please try again later.</p>
	</div>

	<div id="failedInfoDialog" title="We are sorry!" class="aDialog">
		<p>Invalid/conflicting email or no password specified. Please try again.</p>
	</div>
	<div id="successfulInfoDialog" title="Thank you!" class="aDialog">
		<p>User information changed. Thank you!</p>
	</div>

</body>
</html>