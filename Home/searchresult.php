<?php
require '../Modules/dbhandler.php';
require 'valuenamemapping.php';

/*=========================================================
=            Collecting Data Using POST Method            =
=========================================================*/

$country         = $_POST["country"]; 
$city            = $_POST["city"];		  
$street          = $_POST["street"];
$no_reserving    = $_POST["no_reserving"];
$star            = $_POST['star'];
$roomClass       = $_POST['room_class'];
$bedSize         = $_POST['bed_size'];
$bedNo           = $_POST['bed_no'];
$sustain         = $_POST['sustain'];
$aircon          = $_POST['aircon'];
$meeting         = $_POST['meeting'];
$pets            = $_POST['pets'];
$restaurant      = $_POST['restaurant'];
$carpark         = $_POST['carpark'];
$internet        = $_POST['internet'];
$child           = $_POST['child'];
$nosmoking       = $_POST['nosmoking'];
$bizcentre       = $_POST['bizcentre'];
$disabled        = $_POST['disabled'];
$fitness         = $_POST['fitness'];
$swim            = $_POST['swim'];
$thalassotherapy = $_POST['thalassotherapy'];
$golf            = $_POST['golf'];
$tennis          = $_POST['tennis'];
$checkin_date    = $_POST['checkin_date'];
$checkout_date   = $_POST['checkout_date'];

/*-----  End of Collecting Data Using POST Method  ------*/

/*===========================================================
=            Call Search Function From dbhandler            =
===========================================================*/

$hotelInfo = dbhandler::getAssocArray('country', $country, 'city', $city, 'street', $street, 'star', $star);
$roomInfo = dbhandler::getAssocArray('room_class', $roomClass, 'bed_size', $bedSize, 'no_bed', $bedNo);
$hotelFeatures = dbhandler::getAssocArray('sustain_certified', $sustain, 'aircon', $aircon, 'meeting_rm', $meeting,
'pets_allowed', $pets, 'restaurant', $restaurant, 'car_park', $carpark, 'internet', $internet, 'child_facility', $child,
 'no_smoking', $nosmoking, 'biz_centre', $bizcentre, 'reduced_mobility_rm', $disabled, 'fitness_clus', $fitness,
 'swimming_pool', $swim, 'thalassotherapy_centre', $thalassotherapy, 'golf', $golf, 'tennis', $tennis);
$bookingInfo = dbhandler::getAssocArray('checkin', $checkin_date, 'checkout', $checkout_date);

$dbh = new dbhandler();
try {
	$hotels = $dbh->
			findAvailableRooms($hotelInfo, $roomInfo, $hotelFeatures, $bookingInfo);
}
catch (Exception $e){
	return;
}

/*-----  End of Call Search Function From dbhandler  ------*/


/*=================================================
=            Build Search Result Table            =
=================================================*/

$tableHead =<<<EOD
<table id="search_result" summary="Search Result Table">
	<thread>
		<tr>
			<th>Hotel ID</th>
			<th>Hotel Name</th>
			<th>Availability</th>
			<th>Room Class</th>
			<th>Bed Size</th>
			<th>No of Beds</th>
			<th>Book</th>
		</tr>
	</thread>
	<tbody>
EOD;

if (!$hotels) {
	echo "<root><message>failure</message><root>";
} else {
	$tableContent = "";
	foreach($hotels as $row) {
		$hotelid         = $row["hotelid"];
		$availability    = $row["availability"];
		$availability    = (empty($availability)) ? $row["room_count"] : $availability;
		$room_class      = $row['room_class'];
		$bed_size        = $row['bed_size'];
		$no_bed          = $row['no_bed'];
		$hotelname       = $row['hotelname'];
		$room_class_name = getRoomClassName($room_class);
		$bed_size_name   = getBedSizeName($bed_size);
		
		if ($no_reserving <= $availability){
			$tableContent .= <<<EOD
<tr>
	<td>$hotelid</td>
	<td>$hotelname</td>
	<td>$availability</td>
	<td>$room_class_name</td>
	<td>$bed_size_name</td>
	<td>$no_bed</td>
	<td>
		<button onclick=\"location.href='book.php?hotelid=".$hotelid."&availability=".$availability."&room_class=".$room_class."&bed_size=".$bed_size."&no_bed=".$no_bed."&checkin_date=".$checkin_date."&checkout_date=".$checkout_date."&no_reserving=".$no_reserving."&hotelname=".$hotelname.'\'">Book</button>
	</td>
</tr>
EOD;
		}
	}
	$tableTail = '</tbody></table>';
	$rv = $tableHead . $tableContent . $tableTail;
	echo "<root><message>$rv</message></root>";
?>