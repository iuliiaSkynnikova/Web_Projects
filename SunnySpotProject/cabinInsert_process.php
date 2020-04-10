<?php header("Cache-Control:no-cache");?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Cabin Insert Process </title>
	<meta charset="utf-8">
	<link rel="icon" href="images/SunnyspotLogo.png">
	<link href="font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" >
	<link href="https://fonts.googleapis.com/css?family=Allura" rel="stylesheet">
	<link rel="stylesheet" type="text/css" media="screen and (min-width: 960px)" href="styleDesk.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
	<header>
	<div class="Logo">
		<a href="homePage.html"><img id="sunny" src="images/SunnyspotLogo.png" alt="Sunny Spot Logo" width="46" height="46"></a>
		<a href="homePage.html"><h1>Sunny Spot Holidays <span>with Iuliia Skrynnikova!</span></h1></a>
	</div>
	<nav class="headNav">
			<ul>
				<li class="green"> <a class="anav" href="findUsPage.html">Find us</a></li>
				<li class="purple"> <a class="anav " href="accommodationPage.php">Accommodation</a></li>
				<li class="blue"> <a class="anav" href="campingPage.html">Camping</a></li>
				<li class="red" > <a class="anav" href="thingsToDoPage.html">Things to do</a></li>
				<li class="seagreen"> <a class="anav" href="climatePage.html">Climate</a></li>
				<li class="dark"> <a class="anav" href="contactUsPage.html">Contact us</a></li>
			</ul>
		</nav>

	</header>

	<div class="wrap">
	<section id="sectionOneAccom" class="center">
	<div class="greylineAdmin">
	<div class= "textPHP">
		
<?php

	require_once 'sunnyspotindigo12.inc.php';

	
	$type = mysqli_real_escape_string($link, $_POST['type']);
	$description = mysqli_real_escape_string($link, $_POST['description']);
	$priceNight = mysqli_real_escape_string($link, $_POST['priceNight']);
	$priceWeek = mysqli_real_escape_string($link, $_POST['priceWeek']);
	$photo = mysqli_real_escape_string($link, $_POST['photo']);
	



	$query = "insert into tblcabins(cabinType, cabinDescription, pricePerNight, pricePerWeek, photo) value ('$type', '$description', '$priceNight', '$priceWeek', '$photo')";
	$result = mysqli_query($link, $query);

	if ($result == true) {
	$id = mysqli_insert_id($link);	
	echo "Cabin is $type successfully inserted with an ID of $id";
	mysqli_close($link);
	}
	else{
		echo "Error inserting employee into database";
		mysqli_close($link);
		exit();
	}

?>
	</div>
	</div>
	</section>
	</div>

	<footer>
	<div class="foot">
	<nav id="float">
	<a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
	<a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
	<a href="https://pinterest.com/" target="_blank"><i class="fa fa-pinterest-square" aria-hidden="true"></i></a>
	<a href="https://www.youtube.com/" target="_blank"><i class="fa fa-youtube-square" aria-hidden="true"></i></a>	
		</nav>
	<p id="copyright" >COPYRIGHT 2016, RELAX. ALL RIGHTS RESERVED</p>
	<p class="pAdmin"><a class="admin" href="adminMenu.php">Administrative page</a></p>
	</div>
	</footer>


</body>
</html>