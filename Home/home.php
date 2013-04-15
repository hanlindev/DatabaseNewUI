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
	<link rel="stylesheet" href="css/homestyle.css" type="text/css"/>
	<link href="ui/css/redmond/jquery-ui-1.10.2.custom.css" rel="stylesheet">
	<script src="ui/js/jquery-1.9.1.js"></script>
	<script src="ui/js/jquery-ui-1.10.2.custom.js"></script>
	<script src="../Modules/jquery.form.js"></script>
	<script src="../Modules/jquery.cycle.all.js"></script>
	<script src="../Modules/jquery.transit.min.js"></script>
	<script>
	$(function() {
		$( ".datepicker" ).datepicker({
			dateFormat: "yy-mm-dd"
		});
		$("#featureShowButton, #popularShowButton").button({
			icons: {
				primary: "ui-icon-triangle-1-s"
			}
		});
		$("#featureHideButton, #popularHideButton").button({
			icons: {
				primary: "ui-icon-triangle-1-n"
			}
		});
		$("#search").button();
		$("#promotionImg").before('<div id="promoNav">').cycle({
			fx: 'fade',
			speed: 'fast',
			timeout: 3000,
			pager: '#promoNav'
		});
	});
	</script>
	<script>
	$(document).ready(function() {
		$("#welcomeMsg").appendTo("#welcomeDiv");

		$("#listOfFeatures").slideUp("slow");
		$("#featureHideButton").hide();
		// Set the button
		$("#featureShowButton").click(function() {
			$("#listOfFeatures").slideToggle("slow");
			$("#featureShowButton").hide();
			$("#featureHideButton").show();
		});

		$("#featureHideButton").click(function() {
			$("#listOfFeatures").slideToggle("slow");
			$("#featureHideButton").hide();
			$("#featureShowButton").show();
		});

		$("#popularShowButton").hide();
		$("#popularShowButton").click(function() {
			$("#popularHotelTable").slideToggle("slow");
			$("#popularShowButton").hide();
			$("#popularHideButton").show();
		});

		$("#popularHideButton").click(function() {
			$("#popularHotelTable").slideToggle("slow");
			$("#popularHideButton").hide();
			$("#popularShowButton").show();
		});

		$("#testButton").click(function() {
			movePromotion();
		});

		$("#promoNav").addClass("bigNaviPosition");
		$("promotionDiv").addClass("centerFocus");
		
		$("#searchForm").ajaxForm({
			target: "#searchResultDiv",
			success: processSearchResult
		});
	});
	</script>
	<script>
	// functions
	function toLargeImg(aImg) {
		var width = $(aImg).width();
		var height = $(aImg).height();
		alert(width + "haha" + height);
		$(aImg).width(width * 2);
		$(aImg).height(height * 2);
	}

	function movePromotion() {
		$("#promoNav").toggleClass("smallNaviPosition");
		$("#promoNav").toggleClass("bigNaviPosition");
		$("#promotionImg img").toggleClass("scaleImg");
		$("#promotionDiv").toggleClass("centerFocus");
		$("#promotionDiv").toggleClass("cornerFocus");
	}

	// pre-submit callback 
	function showRequest(formData, jqForm, options) { 
	    // formData is an array; here we use $.param to convert it to a string to display it 
	    // but the form plugin does this for you automatically when it submits the data 
	    var queryString = $.param(formData); 
	 
	    // jqForm is a jQuery object encapsulating the form element.  To access the 
	    // DOM element for the form do this: 
	    // var formElement = jqForm[0]; 
	 
	    alert('About to submit: \n\n' + queryString); 
	 
	    // here we could return false to prevent the form from being submitted; 
	    // returning anything other than false will allow the form submit to continue 
	    return true; 
	} 

	function processSearchResult(responseXml) {
		$('#searchResultDiv').fadeIn('slow'); 
		// move promotion away
		movePromotion();
		// Set jquery ui
		$("#searchResultDiv").accordion();
		$(".searchResultSlideshow").cycle({
				fx: 'fade',
				timeout: 5000
		});
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
				<!-- Feature selector -->
				<div id="searchCriteria" class="tableDivCell roundCornerFrame">
					<form id="searchForm" action="searchresult.php" method="POST">
						<!-- basic information of hotel -->
						<table border="0" class="features center">
							<tr>
								<td>Country</td>
							</tr>
							<tr>
								<td><input id="country" name="country" type="text" value="" class="fullLength"/></td>
							</tr>
							<tr>
								<td>City</td>
							</tr>
							<tr>
								<td><input id="city" name="city" type="text" value="" class="fullLength"/></td>
							</tr>
							<tr>
								<td>Street</td>
							</tr>
							<tr>
								<td><input id="street" name="street"  type="text" value="" class="fullLength"/></td>
							</tr>
							<tr>
								<td>No Of Rooms To Book</td>
							</tr>
							<tr>
								<td><input id="no_reserving" name="no_reserving"  type="text" value="" class="fullLength" class="fullLength"/></td>
							</tr>
							<tr>
								<td>Hotel Stars</td>
							</tr>
							<tr>
								<td><select name = "star" class="fullLength">
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
								<td><select name="room_class" class="fullLength">
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
								<td><select name="bed_size" class="fullLength">
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
								<td><select name="bed_no" class="fullLength">
										<option value="0">Any</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
									</select></td>
							</tr>
							<tr id="featureShow" class="center">
								<td><button id="featureShowButton" type="button" style="width: 100%;">Show Features</button></td>
							</tr>
							<tr id="featureHide" class="center">
								<td><button id="featureHideButton" type="button" style="width: 100%;">Hide Features</button></td>
							</tr>
						</table>
						<!-- features -->
						<span id="listOfFeatures">
							<table id="featuresTable" class="features" border="0">
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
							</table>
						</span>
						<table class="features center" border="0">
							<tr>
								<td>Check In Date</td>
							</tr>
							<tr>
								<td><input id="indate" name="checkin_date" type="text" class="datepicker" readonly/></td>
							</tr>
							<tr>
								<td>Check Out Date</td>
							</tr>
							<tr>
								<td><input id="outdate" name="checkout_date" type="text" class="datepicker" readonly/></td>
							</tr>
							<tr>
								<td><input id="search" type="submit" value="Search"/></td>
							</tr>
						</table>
					</form>
				</div>
				<!-- End feature cell-->
				<!-- Middle portion -->
				<div class="tableDivCell middlePortion">
					<!-- Begin result wrapper -->
					<div id="searchResultWrapper">
						<div id="searchResultDiv">
						</div>
					</div>
					<!-- End result wrapper -->
				</div>
				<!-- End middle portion-->

				<!-- Promotion slides -->
				<div id="promotionDiv" class="centerFocus">
					<div id="promotionImg" class="slideshow">
						<img src="images/promotion/burj-al-arab1.jpg"/>
						<img src="images/promotion/burj-al-arab3.jpg"/>
						<img src="images/promotion/jumeirah-beach-hotel1.jpg"/>
						<img src="images/promotion/fullertonhotel.jpg"/>
					</div>
				</div>
				<!--End Promotion Slides -->
				<!-- Right side of table -->
				<div class="tableDivCell">
					<div class="tableDiv">
						<div id="popularTableToggle" class="tableDivCell">
							<button id="popularShowButton" type="button" style="width: 200px;">Popular Hotel Rooms</button>
							<button id="popularHideButton" type="button" style="width: 200px;">Popular Hotel Rooms</button>
						</div>
						<!-- popular rooms table-->
						<div class="tableDivCell positionTopCenter">
							<span id="popularHotelTable">
								<div id="pop_hotel_div">
									<table id="popular_search_table" summary="Top 10 Popular Hotel Rooms" class="resultTable">
										<thread>
										<tr>
											<th>Rank</th>
											<th>Hotel Name</th>
											<th>Room Class</th>
											<th>Bed Size</th>
											<th>No of Beds</th>
										</tr>
										</thread>
										<tbody>
											<?php
											require 'drawPopularBookingTable.php';
											?>
										</tbody>
									</table>
								</div>
							</span>
						</div>
						<!-- End popular rooms table-->
					</div>
				</div>
				<!-- End right side-->
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
