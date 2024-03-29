<?php
require '../Modules/dbhandler.php';
require 'valuenamemapping.php';

/**
 * Draw a table that list all the orders for all users
 * @author Liu    Tuo
 * @return void 
 */
function drawTable()
{
	$dbh = new dbhandler();
	try {
		$booking = $dbh->
findAllBooking();
	}
	catch(Exception $e){
				echo "
<h3>No Booking</h3>
";
		return;
	}


	if (empty($booking)){
		echo "
<h3>No Booking</h3>
";
		return;
	}
	else {
		echo "
<h3>Booking List For All Users</h3>
<table id=\"booking_list\" class=\"resultTable\">
	<thread>
		<tr>
			<th>Ref No</th>
			<th>User ID</th>
			<th>Hotel Name</th>
			<th>Room Class</th>
			<th>Bed Size</th>
			<th>No of Beds</th>
			<th>No of Rooms Booked</th>
			<th>Check In Date</th>
			<th>Check Out Date</th>
			<th>Modify Date</th>
			<th>Cancel Booking</th>
		</tr>
	</thread>
	<tbody>
		";
		$count = -1;
		foreach($booking as $row) {
			$count ++;
			$uid=$row['uid'];
			$ref=$row['ref'];
			$hotel_name = $row['hotelname'];
			$room_class=$row['room_class'];
			$bed_size=$row['bed_size'];
			$no_bed=$row['no_bed'];
			$no_reserving = $row['count'];
			$checkin_date    = $row['checkin'];
			$checkout_date   = $row['checkout'];
			$room_class_name = getRoomClassName($room_class);
			$bed_size_name   = getBedSizeName($bed_size);

			echo "
		<tr>
			<td name=\"refNo".$count."\">$ref</td>
			<td>$uid</td>
			<td>$hotel_name</td>
			<td>$room_class_name</td>
			<td>$bed_size_name</td>
			<td>$no_bed</td>
			<td>$no_reserving</td>
			<td>
				current check in date: ".$checkin_date.
			"
				<input name=\"checkin_date".$count."\" type=\"text\"  value =\"".$checkin_date."\" onchange=\"updateCheckInDate(this,".$count.")\" readonly=\"readonly\" class=\"datepicker\"></td>
			<td>
				current check out date: ".$checkout_date.
			"
				<input name=\"checkout_date".$count."\" type=\"text\" value =\"".$checkout_date."\" onchange=\"updateCheckOutDate(this,".$count.")\" readonly=\"readonly\" class=\"datepicker\"></td>

			<form id=\"modifyForm\" action = \"modifydate.php\" method = \"post\">

				<td>
					<input type=\"submit\" name=\"submit\" value=\"modify date\"></td>
				<input type=\"hidden\" value=\"".$ref."\" name=\"referenceNo\" />
				<input type=\"hidden\" value=\"".$checkin_date."\" name=\"new_Checkin_date\" />
				<input type=\"hidden\" value=\"".$checkout_date."\" name=\"new_Checkout_date\" />
			</form>
			<td>
				<button onclick=\"startAjax('cancelbook.php?ref=".$ref.'\');">Cancel Booking</button>
			</td>
		</tr>
		';
		//<button onclick=\"location.href='cancelbook.php?ref=".$ref.'\'">Cancel Booking</button>
		}
	}
	echo "
	</tbody>
</table>
";
}
/**
 * Draw a table that list all the canceled bookings for all users
 * @author Liu    Tuo
 * @return void 
 */
function drawCancelledOrderTable(){
		$dbh = new dbhandler();
	try {
		$booking = $dbh->
findAllCanceledBooking();
	}
	catch(Exception $e){
				echo "
<h3>No Canceled Booking</h3>
";
		return;
	}


	if (empty($booking)){
		echo "
<h3>No Canceled Booking</h3>
";
		return;
	}
	else {
		echo "
<h3>Canceled Booking List For All Users</h3>
<table id=\"booking_list\" class=\"resultTable\">
	<thread>
		<tr>
			<th>Ref No</th>
			<th>User ID</th>
			<th>Hotel Name</th>
			<th>Room Class</th>
			<th>Bed Size</th>
			<th>No of Beds</th>
			<th>No of Rooms Booked</th>
			<th>Check In Date</th>
			<th>Check Out Date</th>
		</tr>
	</thread>
	<tbody>
		";

		foreach($booking as $row) {

			$uid=$row['uid'];
			$ref=$row['ref'];
			$hotel_name = $row['hotelname'];
			$room_class=$row['room_class'];
			$bed_size=$row['bed_size'];
			$no_bed=$row['no_bed'];
			$no_reserving = $row['count'];
			$checkin_date    = $row['checkin'];
			$checkout_date   = $row['checkout'];
			$room_class_name = getRoomClassName($room_class);
			$bed_size_name   = getBedSizeName($bed_size);

			echo "
		<tr>
			<td>$ref</td>
			<td>$uid</td>
			<td>$hotel_name</td>
			<td>$room_class_name</td>
			<td>$bed_size_name</td>
			<td>$no_bed</td>
			<td>$no_reserving</td>
			<td>$checkin_date</td>
			<td>$checkout_date</td>
		</tr>
		";
		}
	}
	echo "
	</tbody>
</table>
";
}

function phpmyadmin(){
	echo "<div style='height: 150px;'><div class='dbLoginForm'>";
	echo "<h3>Go To Database Management Page</h3>";
	echo "<form id=\"gotopphpmyadmin\"method=\"post\" action=\"../phpMyAdmin/index.php\" name=\"login_form\" target=\"_top\" class=\"login\">
        
            <input type=\"hidden\" name=\"pma_username\" id=\"input_username\" value=\"root\" size=\"24\" class=\"textfield\">
        
        
            <input type=\"hidden\" name=\"pma_password\" id=\"input_password\" value=\"\" size=\"24\" class=\"textfield\">
     
        <input type=\"hidden\" name=\"server\" value=\"1\">   
  
        <input value=\"Go\" type=\"submit\" id=\"input_go\">
    	<input type=\"hidden\" name=\"token\" value=\"19da615435e73d69f4a75462f44694f9\">
</form></div></div>";
}
?>