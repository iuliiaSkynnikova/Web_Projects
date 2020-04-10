<!DOCTYPE html>
<html lang="en">
<head>
	<title>Cabin Select Table</title>
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
	<section id="sectionOneAccom">
	<h2>Select from the cabin listed:</h2>
<?php
	
	require_once 'sunnyspotindigo12.inc.php';

	$query = "select * FROM tblcabins";
	$result = mysqli_query($link, $query);
	if(!$result)
    {
		echo "Query error: ". mysqli_error($link);
		mysqli_close($link);
		exit();
    }
    if(mysqli_num_rows($result) <1)
	{
		mysql_close($link);
		exit("No employee records found with that criteria");
	}
?>	
  	
    <table class="adminTabel">
    	<tr>
			<th class="adminTH">Cabin ID</th>
	        <th class="adminTH">Cabin Type</th>
			<th class="adminTH">Cabin Description</th>
			<th class="adminTH">Price per Night</th>
			<th class="adminTH">Price per Week</th>
			<th class="adminTH">Photo</th>
			<th class="adminTH">Edit</th>
			<th class="adminTH">Delete</th>
		</tr>


<?php	


		while ($record = mysqli_fetch_array ($result, MYSQLI_ASSOC)){
			$cabinID = $record['cabinID'];
			$type = $record['cabinType'];
			$description = $record['cabinDescription'];
			$priceNight = $record['pricePerNight'];
			$priceWeek = $record['pricePerWeek'];
			$photo = $record['photo'];

?>

		<tr>
			<td class="adminTD"><?= $cabinID; ?></td>
	        <td class="adminTD"><?= $type; ?></td>
	        <td class="adminTD"><?= $description; ?></td>
	        <td class="adminTD"><?= $priceNight; ?></td>
	        <td class="adminTD"><?= $priceWeek; ?></td>
	        <td class="adminTD"><?= $photo; ?></td>
			<td class="adminTD"><a href="cabinUpdate_form.php?CABINID=<?= $cabinID; ?>">Edit</a></td>
			<td class="adminTD"><a class="linkDelete" href="javascript:fnConfirm('cabinDelete_process.php?CABINID=<?= $cabinID; ?>')">Delete</a></td>
		</tr>
<?php 
		}	
		
	    mysqli_close($link);	
?>	

	</table>	
			<p class="contact"></p>
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

<script src="js/confirmDelete.js"> </script>
</body>
</html>