<?php

	  $servername = "stardock.cs.virginia.edu";
	  $username = "cs4750jgd3hbc";
	  $password = "youCanOnlySee";
	  $database = "cs4750jgd3hb";

	  // Create connection
	  $conn = new mysqli($servername, $username, $password, $database);

	  // Check connection
	  if ($conn->connect_error) 
	  {
	    die("Connection failed: " . $conn->connect_error);
	  }

	  $TotalAmerican = mysqli_query($conn,
	   "SELECT TotalRestaurants FROM RestaurantStats WHERE cusine = 'American'");
	  $TotalBarbeque = mysqli_query($conn,
	   "SELECT TotalRestaurants FROM RestaurantStats WHERE cusine = 'Barbeque'");
	  $TotalChinese = mysqli_query($conn,
	   "SELECT TotalRestaurants FROM RestaurantStats WHERE cusine = 'Chinese'");
	  $TotalFrench = mysqli_query($conn, 
	  	"SELECT TotalRestaurants FROM RestaurantStats WHERE cusine = 'French'");
	  $TotalItalian = mysqli_query($conn, 
	  	"SELECT TotalRestaurants FROM RestaurantStats WHERE cusine = 'Italian'");
	  $TotalJapanese = mysqli_query($conn, 
	  	"SELECT TotalRestaurants FROM RestaurantStats WHERE cusine = 'Japanese'");
	  $TotalMediterranean = mysqli_query($conn, 
	  	"SELECT TotalRestaurants FROM RestaurantStats WHERE cusine = 'Mediterranean'");
	  $TotalMexican = mysqli_query($conn,
	  	"SELECT TotalRestaurants FROM RestaurantStats WHERE cusine = 'Mexican'");
	  $TotalMiddleEastern = mysqli_query($conn, 
	  	"SELECT TotalRestaurants FROM RestaurantStats WHERE cusine = 'Middle Eastern'");
	  $TotalOrganic = mysqli_query($conn, 
	  	"SELECT TotalRestaurants FROM RestaurantStats WHERE cusine = 'Organic'");
	  $TotalPeruvian = mysqli_query($conn, 
	  	"SELECT TotalRestaurants FROM RestaurantStats WHERE cusine = 'Peruvian'");
	  $TotalSeafood = mysqli_query($conn, 
	  	"SELECT TotalRestaurants FROM RestaurantStats WHERE cusine = 'Seafood'");
	  $TotalThai = mysqli_query($conn, 
	  	"SELECT TotalRestaurants FROM RestaurantStats WHERE cusine = 'Thai'");

	  
	  $TotalAmericanArray = mysqli_fetch_array($TotalAmerican);
	  $TotalBarbequeArray = mysqli_fetch_array($TotalBarbeque);
	  $TotalChineseArray = mysqli_fetch_array($TotalChinese);
	  $TotalFrenchArray = mysqli_fetch_array($TotalFrench);
	  $TotalItalianArray = mysqli_fetch_array($TotalItalian);
	  $TotalJapaneseArray = mysqli_fetch_array($TotalJapanese);
	  $TotalMediterraneanArray = mysqli_fetch_array($TotalMediterranean);
	  $TotalMexicanArray = mysqli_fetch_array($TotalMexican);
	  $TotalMiddleEasternArray = mysqli_fetch_array($TotalMiddleEastern);
	  $TotalOrganicArray = mysqli_fetch_array($TotalOrganic);
	  $TotalPeruvianArray = mysqli_fetch_array($TotalPeruvian);
	  $TotalSeafoodArray = mysqli_fetch_array($TotalSeafood);
	  $TotalThaiArray = mysqli_fetch_array($TotalThai);
	  
	  $TotalAmericanOutput = $TotalAmericanArray['TotalRestaurants'];
	  $TotalBarbequeOutput = $TotalBarbequeArray['TotalRestaurants'];
	  $TotalChineseOutput = $TotalChineseArray['TotalRestaurants'];
	  $TotalFrenchOutput = $TotalFrenchArray['TotalRestaurants'];
	  $TotalItalianOutput = $TotalItalianArray['TotalRestaurants'];
	  $TotalJapaneseOutput = $TotalJapaneseArray['TotalRestaurants'];
	  $TotalMediterraneanOutput = $TotalMediterraneanArray['TotalRestaurants'];
	  $TotalMexicanOutput = $TotalMexicanArray['TotalRestaurants'];
	  $TotalMiddleEasternOutput = $TotalMiddleEasternArray['TotalRestaurants'];
	  $TotalOrganicOutput = $TotalOrganicArray['TotalRestaurants'];
	  $TotalPeruvianOutput = $TotalPeruvianArray['TotalRestaurants'];
	  $TotalSeafoodOutput = $TotalSeafoodArray['TotalRestaurants'];
	  $TotalThaiOutput = $TotalThaiArray['TotalRestaurants'];

?>

<html>
	<head>
		<title>UVA Bites</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
<body class="landing">
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header" class="alt">
					<h1><a href="index.html">UVA Bites</a> by Thunder Squad</h1>
					<nav id="nav">
						<ul>
							<li><a href="index.html">Home</a></li>
							<li><a href="signUp.html">Sign In</a></li>
							<li><a href="signUp.html" class="button">Sign Up</a></li>
						</ul>
					</nav>
				</header>

			<!-- Banner -->
				<section id="banner">
					
				</section>

			<!-- Main -->
				<section id="main" class="container">
			<!-- CTA -->
			
			<section id="container">

				<section class="box special">

					<h2>Restaurant Stats</h2>
					<p>Total Number of Restaurants by Cuisine</p>

					<section class="box special features">
						<div class="features-row">
							<section>
								<h3>Total American Restaurants</h3>
								<?php echo "<h3>$TotalAmericanOutput<h3>"; ?>
							</section>
							<section>
								<h3>Total Barbeque Restaurants</h3>
								<?php echo "<h3>$TotalBarbequeOutput<h3>"; ?>
							</section>
						</div>
						<div class="features-row">
							<section>
								<h3>Total Chinese Restaurants</h3>
								<?php echo "<h3>$TotalChineseOutput<h3>"; ?>
							</section>
							<section>
								<h3>Total French Restaurants</h3>
								<?php echo "<h3>$TotalFrenchOutput<h3>"; ?>
							</section>
						</div>
						<div class="features-row">
							<section>
								<h3>Total Italian Restaurants</h3>
								<?php echo "<h3>$TotalItalianOutput<h3>"; ?>
							</section>
							<section>
								<h3>Total Japanese Restaurants</h3>
								<?php echo "<h3>$TotalJapaneseOutput<h3>"; ?>
							</section>
						</div>
						<div class="features-row">
							<section>
								<h3>Total Mediterranean Restaurants</h3>
								<?php echo "<h3>$TotalMediterraneanOutput<h3>"; ?>
							</section>
							<section>
								<h3>Total Mexican Restaurants</h3>
								<?php echo "<h3>$TotalMexicanOutput<h3>"; ?>
							</section>
						</div>
						<div class="features-row">
							<section>
								<h3>Total Middle Eastern Restaurants</h3>
								<?php echo "<h3>$TotalMiddleEasternOutput<h3>"; ?>
							</section>
							<section>
								<h3>Total Organic Restaurants</h3>
								<?php echo "<h3>$TotalOrganicOutput<h3>"; ?>
							</section>
						</div>
						<div class="features-row">
							<section>
								<h3>Total Peruvian Restaurants</h3>
								<?php echo "<h3>$TotalPeruvianOutput<h3>"; ?>
							</section>
							<section>
								<h3>Total Seafood Restaurants</h3>
								<?php echo "<h3>$TotalSeafoodOutput<h3>"; ?>
							</section>
						</div>
						</div>
					</section>

				</section>

			</section>
			
			<!-- Footer -->
				<footer id="footer">
					<ul class="copyright">
						<li>&copy; Untitled. All rights reserved.</li><li>Design: Thunder Squad</li>
					</ul>
				</footer>

		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrollgress.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>