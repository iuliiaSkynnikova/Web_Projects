<!DOCTYPE html>
<html>
<head>
	<title>Roster Database</title>
</head>
<body>
<?php
	if ($_SERVER['HTTP_HOST'] =='localhost') {
		$user = "root";
		$password = "";
		$database = "sunnyspotindigo12";
	}	
	else
	{
		$user = "indigo12";
		$password = "story97";
		$database = "indigo12";
	}
	$server = 'localhost';	

	$link = mysqli_connect($server, $user, $password, $database);
	if (!$link) {
		exit("Connection error:" . mysqli_connect());
	}

?>

</body>
</html>