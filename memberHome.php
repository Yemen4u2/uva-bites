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

    $RestaurantInformationResult = mysqli_query($conn, "SELECT * 
    						FROM Restaurant NATURAL JOIN Dining NATURAL JOIN Parking NATURAL JOIN Rating
							WHERE restaurantID = '$restaurantID'");
	$RestaurantInformationRow = mysqli_fetch_array($RestaurantInformationResult);
	$restaurant_name = $RestaurantInformationRow['restaurant_name'];
    $cusine = $RestaurantInformationRow['cusine'];
    $wait_time = $RestaurantInformationRow['wait_time'];
    $rating = $RestaurantInformationRow['numberOfStars'];

    //The variables for the dining and parking options are set to Yes or No using if statements
    
    if ($RestaurantInformationRow['sitin'] == 1) { $sitIn = "Yes";} else { $sitIn = "No";}
    if ($RestaurantInformationRow['delivery'] == 1) { $delivery = "Yes";} else { $delivery = "No";}
    if ($RestaurantInformationRow['carryout'] == 1) { $carryout = "Yes";} else { $carryout = "No";}
    if ($RestaurantInformationRow['reservation'] == 1) { $reservation = "Yes";} else { $reservation = "No";}
    if ($RestaurantInformationRow['ParkingLot'] == 1) { $lotOption = "Yes";} else { $lotOption = "No";}
    if ($RestaurantInformationRow['StreetParking'] == 1) { $streetOption = "Yes";} else { $streetOption = "No";}
    if ($RestaurantInformationRow['Garage'] == 1) { $garageOption = "Yes";} else { $garageOption = "No";}
    $parkingCost = $RestaurantInformationRow['Cost'];

    //The output for the restaurant information is stored here.

    $RestaurantOutput = "<b> Resturant Name: </b> $restaurant_name <br />
    					 <b> Cuisine: </b> $cusine <br />
    					 <b> Average Wait Time: </b> $wait_time Minutes <br />
    					 <b> Rating: </b> $rating <br />
    					 <br />
    					 <b><h4>Dining Options</h4></b>
    					 <b> Dine In: </b> $sitIn <br />
    					 <b> Delivery: </b> $delivery <br />
    					 <b> Carryout: </b> $carryout <br />
    					 <br />
    					 <b><h4>Dining Options</h4></b>
    					 <b> Reservation: </b> $reservation <br />
    					 <b> Parking Lot: </b> $lotOption <br />
    					 <b> Street Parking: </b> $streetOption <br />
    					 <b> Garage Parking: </b> $garageOption <br />
    					 <b> Cost: </b> $parkingCost <br />
    					 <br />";

    //Creat table by natural joining Contact and Location table to find the restaurant's email, number and address.

    $ResturantContactResult = mysqli_query($conn, "SELECT * FROM Contact NATURAL JOIN Location
					WHERE restaurantID = '$restaurantID'");
	$ResturantContactRow = mysqli_fetch_array($ResturantContactResult);
    $resturantPhoneNumber = $ResturantContactRow['phone'];
    $restaurantEmail = $ResturantContactRow['email'];
    $restaurantStreet = $ResturantContactRow['street'];
    $restaurantZipCode = $ResturantContactRow['zip'];

    //The output for the contact information is stored here

    $ContactOutput = "<b> Phone: </b> $resturantPhoneNumber <br />
    				  <b> Email: </b> $restaurantEmail <br />
    				  <b> Street Address: </b> $restaurantStreet <br />
    				  <b> Zip Code: </b> $restaurantZipCode <br />
    				  <br />";

    //This SQL query is used to later to create a drop down menu with all the food options

    $FoodQuery = mysqli_query($conn, "SELECT * FROM Food");

    //This SQL query is used to pull up the restaurant menu

    $MenuQuery = mysqli_query($conn, "SELECT food_name FROM Menu NATURAL JOIN Food WHERE restaurantID = '$restaurantID'")

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
				<h2>Welcome <?php echo $userName; ?>!</h2>
			</header>
					<div class="row uniform 50%">
						<div class="12u">
						<h2>Restaurant Information</h2>
						<div class="box">
						<?php
						  	echo "$RestaurantOutput";
						?>
<!-- 						<div class="row uniform">
							<div class="12u\">
							<form>
								<ul class="actions">
								<li><input type="submit" value="Update Restaurant Information" /></li>
								</ul>
							</form>
							</div>
						</div> -->
						</div>
						<h2>Contact Information</h2>
						<div class="box">
						<?php
						  	echo "$ContactOutput";
						?>
<!-- 						<div class="row uniform">
							<div class="12u">
								<ul class="actions">
								<li><input type="submit" value="Update Contact Information" /></li>
								</ul>
							</div>
						</div> -->
						</div>
						<h2>Restaurant Menu</h2>
						<div class="box">
						<h3>Your Restaurant's Menu</h3>
							<?php
								while ($row = mysqli_fetch_array($MenuQuery))
								{
									$MenuItem = $row['food_name'];
									echo "<b> $MenuItem </b>";
									echo "</br>";
								}
							?>
						<br>
						<form action="modifyMenu.php" method="POST">
						<!-- Creating Dynamic Drop Down Menu -->
							<?php 
							echo "<select name='Food'>";

							while ($temp = mysqli_fetch_assoc($FoodQuery))
							{ 
								echo "<option value=\"" . $temp['foodID'] . "\">" . $temp['food_name'] . "</option>"; 
							}

							echo "</select>"; 

							?>
							<br>
							<div class="row uniform">
								<div class="12u">
									<ul class="actions">
										<input type="hidden" name="restaurantID" value="<?php echo $restaurantID; ?>">
										<li><input name="addItem" type="submit" value="Add to Menu" /></li>
										<li><input name="removeItem" type="submit" value="Remove from Menu" /></li>
									</ul>
								</div>
							</div>
							<br>
						</form>
						</div>
						</div>
					</div>
		</section>								
	</body>
</html>