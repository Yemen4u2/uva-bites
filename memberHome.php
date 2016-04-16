<?php
	session_start();
	
	if(isset($_SESSION["userName"])) {
		$userName = $_SESSION["userName"];
	} else {
		header("Location: adminLogin.html");
	}

	//Setting up Connection to the database.

	$servername = "stardock.cs.virginia.edu";
	$username = "cs4750jgd3hb";
	$password = "p@ssw0rd";
	$database = "cs4750jgd3hb";

	 // Create connection
	$conn = new mysqli($servername, $username, $password, $database);

	$AdminResult = mysqli_query($conn, "SELECT * FROM Admins WHERE User_Name = '$userName'");
	$AdminsRow = mysqli_fetch_array($AdminResult);
	$restaurantID = $AdminsRow['restaurantID'];

	//Creat table by natural joining restaurant, 

    $ResturantInformationResult = mysqli_query($conn, "SELECT * 
    						FROM Restaurant NATURAL JOIN Dining NATURAL JOIN Parking NATURAL JOIN Rating
							WHERE restaurantID = '$restaurantID'");
	$ResturantInformationRow = mysqli_fetch_assoc($ResturantInformationResult);
	$restaurant_name = $ResturantInformationRow['restaurant_name'];
    $cusine = $ResturantInformationRow['cusine'];
    $wait_time = $ResturantInformationRow['wait_time'];
    $rating = $RestaurantInformationRow['numberOfStars'];

    $RestaurantOutput = "<b> Resturant Name: </b> $restaurant_name <br />
    					 <b> Cusine: </b> $cusine <br />
    					 <b> Average Wait Time: </b> $wait_time Minutes <br />
    					 <b> Rating: </b> $rating <br />";

    //Creat table by natural joining Contact and Location table to find the restaurant's email, number and address.

    $ResturantContactResult = mysqli_query($conn, "SELECT * FROM Contact NATURAL JOIN Location
					WHERE restaurantID = '$restaurantID'");
	$ResturantContactRow = mysqli_fetch_array($ResturantContactResult);
    $resturantPhoneNumber = $ResturantContactRow['phone'];
    $restaurantEmail = $ResturantContactRow['email'];
    $restaurantStreet = $ResturantContactRow['street'];
    $restaurantZipCode = $ResturantContactRow['zip'];

    $ContactOutput = "<b> Phone: </b> $resturantPhoneNumber <br />
    				  <b> Email: </b> $restaurantEmail <br />
    				  <b> Street Address: </b> $restaurantStreet <br />
    				  <b> Zip Code: </b> $restaurantZipCode";

?>
<!DOCTYPE html>
<!--
	Alpha by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>UVABites</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body>
		<div id="page-wrapper">
			<header id="header" class="alt">
				<h1><a href="index.html">UVaBites</a> by Thunder Squad</h1>
				<nav id="nav">
					<ul>
						<li><a href="index.html">Home</a></li>
					</ul>
				</nav>		
			</header>
		</div>

		<section id="main" class="container 75%">
			<header>
				<h3>Welcome <?php echo $userName; ?>!</h3>
			</header>
					<div class="row uniform 50%">
						<div class="12u">
						<?php
						  	echo "<div class=\"box\">$RestaurantOutput</div>";
						  	echo "<div class=\"box\">$ContactOutput</div>";
						?>
						</div>
					</div>
		</section>								
	</body>
</html>