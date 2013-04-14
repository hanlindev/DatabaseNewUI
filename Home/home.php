<!DOCTYPE html>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Room Booking System</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" />
	<link rel="stylesheet" href="css/homestyle.css" type="text/css"/>
	<link href="ui/css/redmond/jquery-ui-1.10.2.custom.css" rel="stylesheet">
	<script src="ui/js/jquery-1.9.1.js"></script>
	<script src="ui/js/jquery-ui-1.10.2.custom.js"></script>
	<script src="../Modules/jquery.form.js"></script>
	<script>
	$(function() {
		$( ".datepicker" ).datepicker({
			dateFormat: "yy-mm-dd"
		});
		$("#featureToggle").button();
	});
	</script>
	<script>
	var featureShow = false;
	</script>
</head>
<body>
	<!-- Main Page-->
	<div class="mainPage">
		<!-- Navigator bar -->
		<div class="tableDiv navigatorBar">
			<div class="tableDivCell welcomeMessage">
				<?php
				//Check if the current user have the access to current page
				include ('pageaccess.php');
				?>
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
				<!-- Feature selector -->
				<div id="searchCriteria" class="tableDivCell">
					<form action="searchresult.php" method="POST">
						<!-- basic information of hotel -->
						<table border="0" class="features center">
							<tr>
								<td>Country</td>
							</tr>
							<tr>
								<td><input id="country" name="country" type="text" value=""/></td>
							</tr>
							<tr>
								<td>City</td>
							</tr>
							<tr>
								<td><input id="city" name="city" type="text" value=""/></td>
							</tr>
							<tr>
								<td>Street</td>
							</tr>
							<tr>
								<td><input id="street" name="street"  type="text" value=""/></td>
							</tr>
							<tr>
								<td>No Of Rooms To Book</td>
							</tr>
							<tr>
								<td><input id="no_reserving" name="no_reserving"  type="text" value=""/></td>
							</tr>
							<tr>
								<td>Hotel Stars</td>
							</tr>
							<tr>
								<td><select name = "star" >
										<option value="0">Any</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
									</select></td>
							</tr>
							<tr>
								<td>Room Class</td>
							</tr>
							<tr>
								<td><select name="room_class" >
										<option value="0">Any</option>
										<option value="1">Standard</option>
										<option value="2">Superior</option>
										<option value="3">Deluxe</option>
										<option value="4">Executive</option>
										<option value="5">Presidential</option>
									</select></td>
							</tr>
							<tr>
								<td>Bed Size</td>
							</tr>
							<tr>
								<td><select name="bed_size">
										<option value="0">Any</option>
										<option value="1">Single</option>
										<option value="2">Double</option>
										<option value="3">Queen</option>
										<option value="4">Olympic Queen</option>
										<option value="5">King</option>
										<option value="6">California King</option>
									</select></td>
							</tr>
							<tr>
								<td>Bed Number</td>
							</tr>
							<tr>
								<td><select name="bed_no" >
										<option value="0">Any</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
									</select></td>
							</tr>
						</table>
						<!-- features -->
						<table id="featuresTable" class="features" border="0">
							<tr class="center">
								<td colspan="2"><button id="featureToggle" type="button"></button></td>
							</tr>
							<span>
								<tr>
									<td><input type="hidden" name="sustain" value="0">
										<input type="checkbox" name="sustain" value="1">
									</td>
									<td class="featuresRightCol">Sustainable Certified</td>
								</tr>
								<tr>
									<td><input type="hidden" name="aircon" value="0">
										<input type="checkbox" name="aircon" value="1">
									</td>
									<td class="featuresRightCol">Air Conditioner</td>
								</tr>
								<tr>
									<td><input type="hidden" name="meeting" value="0">
										<input type="checkbox" name="meeting" value="1">
									</td>
									<td class="featuresRightCol">Meeting Room</td>
								</tr>
								<tr>
									<td><input type="hidden" name="pets" value="0">
										<input type="checkbox" name="pets" value="1">
									</td>
									<td class="featuresRightCol">Pets Allowed</td>
								</tr>
								<tr>
									<td><input type="hidden" name="restaurant" value="0">
										<input type="checkbox" name="restaurant" value="1">
									</td>
									<td class="featuresRightCol">Restaurant</td>
								</tr>
								<tr>
									<td><input type="hidden" name="carpark" value="0">
										<input type="checkbox" name="carpark" value="1">
									</td>
									<td class="featuresRightCol">Car Park</td>
								</tr>
								<tr>
									<td><input type="hidden" name="internet" value="0">
										<input type="checkbox" name="internet" value="1">
									</td>
									<td class="featuresRightCol">Internet</td>
								</tr>
								<tr>
									<td><input type="hidden" name="child" value="0">
										<input type="checkbox" name="child" value="1">
									</td>
									<td class="featuresRightCol">Child Facilities</td>
								</tr>
								<tr>
									<td><input type="hidden" name="nosmoking" value="0">
										<input type="checkbox" name="nosmoking" value="1">
									</td>
									<td class="featuresRightCol">100% No Smoking</td>
								</tr>
								<tr>
									<td><input type="hidden" name="bizcentre" value="0">
										<input type="checkbox" name="bizcentre" value="1">
									</td>
									<td class="featuresRightCol">Business Centre</td>
								</tr>
								<tr>
									<td><input type="hidden" name="disabled" value="0">
										<input type="checkbox" name="disabled" value="1">
									</td>
									<td class="featuresRightCol">Reduced Mobility Rooms</td>
								</tr>
								<tr>
									<td><input type="hidden" name="fitness" value="0">
										<input type="checkbox" name="fitness" value="1">
									</td>
									<td class="featuresRightCol">Fitness Club</td>
								</tr>
								<tr>
									<td><input type="hidden" name="swim" value="0">
										<input type="checkbox" name="swim" value="1">
									</td>
									<td class="featuresRightCol">Swimming Pool</td>
								</tr>
								<tr>
									<td><input type="hidden" name="thalassotherapy" value="0">
										<input type="checkbox" name="thalassotherapy" value="1">
									</td>
									<td class="featuresRightCol">Thalassotherapy Centre</td>
								</tr>
								<tr>
									<td><input type="hidden" name="golf" value="0">
										<input type="checkbox" name="golf" value="1">
									</td>
									<td class="featuresRightCol">Golf</td>
								</tr>
								<tr>
									<td><input type="hidden" name="tennis" value="0">
										<input type="checkbox" name="tennis" value="1">
									</td>
									<td class="featuresRightCol">Tennis</td>
								</tr>
							</span>
						</table>
						<table class="features center" border="0">
							<tr>
								<td>Check In Date</td>
							</tr>
							<tr>
								<td><input id="indate" name="checkin_date" type="text" class="datepicker" readonly="readonly"/></td>
							</tr>
							<tr>
								<td>Check Out Date</td>
							</tr>
							<tr>
								<td><input id="outdate" name="checkout_date" type="text" class="datepicker" readonly="readonly"/></td>
							</tr>
							<tr>
								<td><input id="search" type="submit" value="Search"/></td>
							</tr>
						</table>
					</form>
				</div>
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
</body>
