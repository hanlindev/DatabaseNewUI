<html>
<body>
	<h1>Login Status</h1>
	<?php
	require 'dbhandler.php';

	$dbh = new dbhandler();
	$result = dbhandler::updateHotel("star=4", "hotelname='Hotel China' AND star=5");
	echo "<p> $result </p>";
	?>
	<a href="../index.html">Back</a>
</body>
</html>