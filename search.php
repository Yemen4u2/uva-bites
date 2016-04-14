<?php
      $servername = "stardock.cs.virginia.edu";
      $username = "cs4750jgd3hb";
      $password = "p@ssw0rd";
      $database = "cs4750jgd3hb";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $database);

      // Check connection
      if ($conn->connect_error) 
      {
        die("Connection failed: " . $conn->connect_error);
      }
      else
      {
      	echo "Connected successfully <br />";
      }

        $parkingOption = $_GET["parkingOption"];
      	$diningOption = $_GET["diningOption"];
      	$rating = $_GET["rating"];

      //First check if a restaurant name was inputted.

      if(isSet($_GET["restaurantName"]) && $_GET["restaurantName"] != "") 
      {

      	if(isSet($_GET["zip"]) && $_GET["zip"] != "")
      	{
      		//Set a value for zip.
      		$zipCode = $_GET["zip"];

      		//Search database for restaurant with matching name and zip code.
      		$result = mysqli_query($conn,
      		"SELECT restaurant_name, cusine, wait_time
      		FROM Restaurant NATURAL JOIN Location NATURAL JOIN Parking NATURAL JOIN Dining NATURAL JOIN Rating
      		WHERE restaurant_name = '$restaurantName' && $parkingOption = '1' && zip = '$zipCode' 
      		&& $diningOption = '1' && numberOfStars >= $rating");
      	}
      	else
      	{
      	//Set a value for resturant name.
      	$restaurantName = $_GET["restaurantName"];

      	//Search database for restaurant with matching name.
      	$result = mysqli_query($conn, 
      	"SELECT restaurant_name, cusine, wait_time
      	FROM Restaurant NATURAL JOIN Parking NATURAL JOIN Dining NATURAL JOIN Rating
      	WHERE restaurant_name = '$restaurantName' && $parkingOption = '1'  
      		  && $diningOption = '1' && numberOfStars >= $rating");
        }

	  }

	  //Second check if a food name was inputted.

	  else if(isSet($_GET["foodName"]) && $_GET["foodName"] != "")
	  {

		$foodName = $_GET["foodName"];

	  	if(isSet($_GET["zip"]) && $_GET["zip"] != "")
      	{
      		//Set a value for zip.
      		$zipCode = $_GET["zip"];

      		$result = mysqli_query($conn, 
	      	"SELECT restaurant_name, cusine, wait_time
	      	 FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Location
	      	 WHERE food_name = '$foodName' && zip = $zipCode");

		}
		else
		{
	      	$result = mysqli_query($conn, 
	      	"SELECT restaurant_name, cusine, wait_time
	      	 FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant
	      	 WHERE food_name = '$foodName'");
      	}
	  }

	  //Third check if a zip code was inputted.

	  else if(isSet($_GET["zip"]) && $_GET["zip"] != "")
	  {
	  	$zipCode = $_GET["zip"];

	  	$result = mysqli_query($conn, 
      	"SELECT restaurant_name, cusine, wait_time
      	 FROM Restaurant NATURAL JOIN Location NATURAL JOIN Parking NATURAL JOIN Dining NATURAL JOIN Rating
      	 WHERE zip = '$zipCode' && $parkingOption = '1' && $diningOption = '1' && numberOfStars >= $rating");
	  }

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
	<body>
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header">
					<h1><a href="index.html">UVA Bites</a> by Thunder Squad</h1>
					<nav id="nav">
						<ul>
							<li><a href="index.html">Home</a></li>
							<li><a href="#" class="button">Sign Up</a></li>
						</ul>
					</nav>
				</header>

			<!-- Main -->
				<section id="main" class="container 75%">

					<header>
						<h2>Here Are Some Places You'd Like To Eat</h2>
					</header>

					<?php

					    $row_cnt = $result->num_rows;
      
					    if($row_cnt == 0) 
					    {
					    	echo "<div class=\"box\">No Results Found</div>";
					    }
					    else
					    {
							while ($row = mysqli_fetch_array($result)) :
							    $restaurant_name = $row['restaurant_name'];
							    $cusine = $row['cusine'];
							    $wait_time = $row['wait_time'];
							    $output = "<b> Resturant Name: </b> $restaurant_name <br /> <b> Cusine: </b> $cusine <br /> <b> Average Wait Time: </b> $wait_time";
							    echo "<div class=\"box\">$output</div>";
							endwhile;
						}
					?>

				</section>

			<!-- Footer -->
				<footer id="footer">
					<ul class="copyright">
						<li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
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