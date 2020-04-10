<!DOCTYPE html>
<html lang="en">
<head>
	<title>Accommodation</title>
	<meta charset="utf-8">
	<link rel="icon" href="images/SunnyspotLogo.png">
	<link href="font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" >
	<link href="https://fonts.googleapis.com/css?family=Allura" rel="stylesheet">
	<link rel="stylesheet" type="text/css" media="screen and (max-width: 959px)" href="style.css">
	<link rel="stylesheet" type="text/css" media="screen and (min-width: 960px)" href="styleDesk.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Villas, cabins and camping">
</head>
<body >

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


	<header>
	<div class="Logo">
		<a href="homePage.html"><img id="sunny" src="images/SunnyspotLogo.png" alt="Sunny Spot Logo" width="46" height="46"></a>
		<a href="homePage.html"><h1>Sunny Spot Holidays <span>with Iuliia Skrynnikova!</span></h1></a>
	</div>	

		<nav class="headNav">
			<ul>
				<li class="green"> <a class="anav" href="findUsPage.html">Find us</a></li>
				<li class="purple highlight"> <a class="anav " href="accommodationPage.php">Accommodation</a></li>
				<li class="blue"> <a class="anav" href="campingPage.html">Camping</a></li>
				<li class="red" > <a class="anav" href="thingsToDoPage.html">Things to do</a></li>
				<li class="seagreen"> <a class="anav" href="climatePage.html">Climate</a></li>
				<li class="dark"> <a class="anav" href="contactUsPage.html">Contact us</a></li>
			</ul>
		</nav>
	</header>
			

	
	<div class="wrap">
	<section id="sectionOneAccom">
		<h2 class="textAccom">Accommodation</h2>
		<p>Accommodation options at Sunny Spot Holiday Park include:</p>
		<ul id="dot">
			<li class="liAccom">18 cabins</li>
			<li class="liAccom">50 powered grass sites</li>
			<li class="liAccom">90 powered slab sites</li>
		</ul>

		<h3>Villas, cabins and camping</h3>
		<p>There are 18 different cabins to choose from, from standard cabins, to the deluxe cabins only 50 metres from the
		beach. Cabin linen is provided for all guests.</p>
	</section>

<?php
	$query = "select * FROM tblcabins";
	$result = mysqli_query($link, $query);
	while ($record = mysqli_fetch_array ($result, MYSQLI_ASSOC)){
		$type = $record['cabinType'];
		$description = $record['cabinDescription'];
		$priceNight = $record['pricePerNight'];
		$priceWeek = $record['pricePerWeek'];
		$imageName = $record['photo'];	
?>
<section class="frame">
	<image class="cabin" src="images/cabins/<?=$imageName;?>" alt="<?=  $type; ?>"> 
	<h3> <?=  $type; ?> </h3>    
	<p> <?= $description; ?>  </p>   
	<p>Price/night: $ <?= $priceNight; ?> </p>
	<p>Price/week: $ <?= $priceWeek; ?></p>
</section>
<?php
		
	}
	mysqli_free_result ($result);
	mysqli_close($link);	
?>		

		<div class="clear" ></div>	
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