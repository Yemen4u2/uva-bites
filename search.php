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

      //Check if values have been inputed and then set them equal to variables

      if(isSet($_GET["restaurantName"]) && $_GET["restaurantName"] != "")
      {
      	$restaurantName = InputCleaner($_GET["restaurantName"]);
      }
      if (isSet($_GET["foodName"]) && $_GET["foodName"] != "")
      {
      	$foodName = InputCleaner($_GET["foodName"]);
      }
      if (isSet($_GET["zip"]) && $_GET["zip"] != "")
      {
      	$zipCode = InputCleaner($_GET["zip"]);
      }
      if (isSet($_GET["parkingOption"]) && $_GET["parkingOption"] != "")
      {
      	$parkingOption = InputCleaner($_GET["parkingOption"]);
      }
      if (isSet($_GET["diningOption"]) && $_GET["diningOption"] != "")
      {
      	$diningOption = InputCleaner($_GET["diningOption"]);
      }
      if (isSet($_GET["rating"]) && $_GET["rating"] != "")
      {
      	$rating = InputCleaner($_GET["rating"]);
      }


    //This is the function used to SANITIZE the values that are inputed.

	function InputCleaner($data)
	{
		//remove space bfore and after
		$data = trim($data); 
		//remove slashes
		$data = stripslashes($data); 
		$data=(filter_var($data, FILTER_SANITIZE_STRING));
		return $data;
	}


    //Check if just a restaurant name has been set

    if (isSet($restaurantName)) 
    {
      	//Check if the zip code has been inputed

      	if (isSet($zipCode))
      	{

      		//Check for all combination of dining, parking and rating options

      		if (isSet($diningOption) && isSet($parkingOption) && isSet($rating))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurant_name, cusine, wait_time
	      		FROM Restaurant NATURAL JOIN Location NATURAL JOIN Parking NATURAL JOIN Dining NATURAL JOIN Rating
	      		WHERE restaurant_name = '$restaurantName' && $parkingOption = '1' && zip = '$zipCode' 
	      		&& $diningOption = '1' && numberOfStars >= $rating");
      		}
      		elseif (isSet($diningOption) && isSet($parkingOption))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurant_name, cusine, wait_time
	      		FROM Restaurant NATURAL JOIN Location NATURAL JOIN Parking NATURAL JOIN Dining
	      		WHERE restaurant_name = '$restaurantName' && $parkingOption = '1' && zip = '$zipCode' 
	      		&& $diningOption = '1'");
      		}
      		elseif (isSet($parkingOption) && isSet($rating))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurant_name, cusine, wait_time
	      		FROM Restaurant NATURAL JOIN Location NATURAL JOIN Parking NATURAL JOIN Rating
	      		WHERE restaurant_name = '$restaurantName' && $parkingOption = '1' && zip = '$zipCode' 
	      		&& numberOfStars >= $rating");
      		}
      		elseif (isSet($diningOption))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurant_name, cusine, wait_time
	      		FROM Restaurant NATURAL JOIN Location NATURAL JOIN Dining
	      		WHERE restaurant_name = '$restaurantName' && zip = '$zipCode' && $diningOption = '1'");
      		}
      		elseif (isSet($parkingOption))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurant_name, cusine, wait_time
	      		FROM Restaurant NATURAL JOIN Location NATURAL JOIN Parking
	      		WHERE restaurant_name = '$restaurantName' && zip = '$zipCode' && $parkingOption = '1'");
      		}
      		elseif (isSet($rating))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurant_name, cusine, wait_time
	      		FROM Restaurant NATURAL JOIN Location NATURAL JOIN Rating
	      		WHERE restaurant_name = '$restaurantName' && zip = '$zipCode' && numberOfStars >= $rating");
      		}
      		else
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurant_name, cusine, wait_time
	      		FROM Restaurant NATURAL JOIN Location
	      		WHERE restaurant_name = '$restaurantName' && zip = '$zipCode'");
      		}
      	}

      	//If the zip code is not set then still then still check for all combinations

      	else
      	{
      		if (isSet($diningOption) && isSet($parkingOption) && isSet($rating))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurant_name, cusine, wait_time
	      		FROM Restaurant NATURAL JOIN Parking NATURAL JOIN Dining NATURAL JOIN Rating
	      		WHERE restaurant_name = '$restaurantName' && $parkingOption = '1' && $diningOption = '1' 
	      		      && numberOfStars >= $rating");
      		}
      		elseif (isSet($diningOption) && isSet($parkingOption))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurant_name, cusine, wait_time
	      		FROM Restaurant NATURAL JOIN Parking NATURAL JOIN Dining
	      		WHERE restaurant_name = '$restaurantName' && $parkingOption = '1' && $diningOption = '1'");
      		}
      		elseif (isSet($parkingOption) && isSet($rating))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurant_name, cusine, wait_time
	      		FROM Restaurant NATURAL JOIN Parking NATURAL JOIN Rating
	      		WHERE restaurant_name = '$restaurantName' && $parkingOption = '1' && numberOfStars >= $rating");
      		}
      		elseif (isSet($diningOption))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurant_name, cusine, wait_time
	      		FROM Restaurant NATURAL JOIN Dining
	      		WHERE restaurant_name = '$restaurantName' && $diningOption = '1'");
      		}
      		elseif (isSet($parkingOption))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurant_name, cusine, wait_time
	      		FROM Restaurant NATURAL JOIN Parking
	      		WHERE restaurant_name = '$restaurantName' && $parkingOption = '1'");
      		}
      		elseif (isSet($rating))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurant_name, cusine, wait_time
	      		FROM Restaurant NATURAL JOIN Rating
	      		WHERE restaurant_name = '$restaurantName' && numberOfStars >= $rating");
      		}
      		else
      		{
      			$result = mysqli_query($conn, 
		      	"SELECT restaurant_name, cusine, wait_time
		      	FROM Restaurant
		      	WHERE restaurant_name = '$restaurantName'");
      		}
      	}  	
    }

    //Check if just a food name has been set

    elseif (isSet($foodName))
    {
      	if (isSet($zipCode))
      	{
      		if (isSet($diningOption) && isSet($parkingOption) && isSet($rating))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurant_name, cusine, wait_time
	      		FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Location
	      		NATURAL JOIN Parking NATURAL JOIN Dining NATURAL JOIN Rating
	      		WHERE food_name = '$foodName' && $zipCode = 'zip' && $parkingOption = '1' && $diningOption = '1' 
	      		      && numberOfStars >= $rating");
      		}
      		elseif (isSet($diningOption) && isSet($parkingOption))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurant_name, cusine, wait_time
	      		FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Location
	      		NATURAL JOIN Parking NATURAL JOIN Dining
	      		WHERE food_name = '$foodName' && $zipCode = 'zip' && $parkingOption = '1' && $diningOption = '1'");
      		}
      		elseif (isSet($parkingOption) && isSet($rating))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurant_name, cusine, wait_time
	      		FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Location
	      		NATURAL JOIN Parking NATURAL JOIN Rating
	      		WHERE food_name = '$foodName' && $zipCode = 'zip' && $parkingOption = '1' && numberOfStars >= $rating");
      		}
      		elseif (isSet($diningOption))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurant_name, cusine, wait_time
	      		FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Location NATURAL JOIN Dining
	      		WHERE food_name = '$foodName' && $zipCode = 'zip' && $diningOption = '1'");
      		}
      		elseif (isSet($parkingOption))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurant_name, cusine, wait_time
	      		FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Location NATURAL JOIN Parking
	      		WHERE food_name = '$foodName' && $zipCode = 'zip' && $parkingOption = '1'");
      		}
      		elseif (isSet($rating))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurant_name, cusine, wait_time
	      		FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Location NATURAL JOIN Rating
	      		WHERE food_name = '$foodName' && $zipCode = 'zip' && numberOfStars >= $rating");
      		}
      		else
      		{
      			$result = mysqli_query($conn, 
		      	"SELECT restaurant_name, cusine, wait_time
		      	 FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Location
		      	 WHERE food_name = '$foodName' && zip = $zipCode");
      		}
      	}
      	else
      	{
      		if (isSet($diningOption) && isSet($parkingOption) && isSet($rating))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurant_name, cusine, wait_time
	      		FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant
	      		NATURAL JOIN Parking NATURAL JOIN Dining NATURAL JOIN Rating
	      		WHERE food_name = '$foodName' && $parkingOption = '1' && $diningOption = '1' 
	      		      && numberOfStars >= $rating");
      		}
      		elseif (isSet($diningOption) && isSet($parkingOption))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurant_name, cusine, wait_time
	      		FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Parking NATURAL JOIN Dining
	      		WHERE food_name = '$foodName' && $parkingOption = '1' && $diningOption = '1'");
      		}
      		elseif (isSet($parkingOption) && isSet($rating))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurant_name, cusine, wait_time
	      		FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Parking NATURAL JOIN Rating
	      		WHERE food_name = '$foodName' && $parkingOption = '1' && numberOfStars >= $rating");
      		}
      		elseif (isSet($diningOption))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurant_name, cusine, wait_time
	      		FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Dining
	      		WHERE food_name = '$foodName' && $diningOption = '1'");
      		}
      		elseif (isSet($parkingOption))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurant_name, cusine, wait_time
	      		FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Parking
	      		WHERE food_name = '$foodName' && $parkingOption = '1'");
      		}
      		elseif (isSet($rating))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurant_name, cusine, wait_time
	      		FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Rating
	      		WHERE food_name = '$foodName' && numberOfStars >= $rating");
      		}
      		else
      		{
	      		$result = mysqli_query($conn, 
			    "SELECT restaurant_name, cusine, wait_time
			    FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant
			    WHERE food_name = '$foodName'");
	      	}
      	}
    }

      //Check if just a zip code has been set

    elseif (isSet($zipCode))
    {
      	if (isSet($foodName))
      	{
      		if (isSet($diningOption) && isSet($parkingOption) && isSet($rating))
      		{
      			$result = mysqli_query($conn, 
		      	"SELECT restaurant_name, cusine, wait_time
		      	 FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Location 
		      	 NATURAL JOIN Parking NATURAL JOIN Rating NATURAL JOIN Dining
		      	 WHERE food_name = '$foodName' && zip = '$zipCode'
		      	       && $parkingOption = '1' && $diningOption = '1' && numberOfStars >= $rating");
      		}
      		elseif (isSet($diningOption) && isSet($parkingOption))
      		{
      			$result = mysqli_query($conn, 
		      	"SELECT restaurant_name, cusine, wait_time
		      	 FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Location 
		      	 NATURAL JOIN Parking NATURAL JOIN Dining
		      	 WHERE food_name = '$foodName' && zip = '$zipCode'
		      	  && $parkingOption = '1' && $diningOption = '1'");
      		}
      		elseif (isSet($parkingOption) && isSet($rating))
      		{
      			$result = mysqli_query($conn, 
		      	"SELECT restaurant_name, cusine, wait_time
		      	 FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Location 
		      	 NATURAL JOIN Parking NATURAL JOIN Rating
		      	 WHERE food_name = '$foodName' && zip = '$zipCode'
		      	       && $parkingOption = '1' && numberOfStars >= $rating");
      		}
      		elseif (isSet($rating) && isSet($diningOption))
      		{
      			$result = mysqli_query($conn, 
		      	"SELECT restaurant_name, cusine, wait_time
		      	 FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Location 
		      	 NATURAL JOIN Rating NATURAL JOIN Dining
		      	 WHERE food_name = '$foodName' && zip = '$zipCode'
		      	       && $diningOption = '1' && numberOfStars >= $rating");
      		}
      		elseif (isSet($diningOption))
      		{
      			$result = mysqli_query($conn, 
		      	"SELECT restaurant_name, cusine, wait_time
		      	 FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Location 
		      	 NATURAL JOIN Dining
		      	 WHERE food_name = '$foodName' && zip = '$zipCode'
		      	       && $diningOption = '1'");
      		}
      		elseif (isSet($parkingOption))
      		{
      			$result = mysqli_query($conn, 
		      	"SELECT restaurant_name, cusine, wait_time
		      	 FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Location 
		      	 NATURAL JOIN Parking
		      	 WHERE food_name = '$foodName' && zip = '$zipCode'
		      	       && $parkingOption = '1'");
      		}
      		elseif (isSet($rating))
      		{
      			$result = mysqli_query($conn, 
		      	"SELECT restaurant_name, cusine, wait_time
		      	 FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Location 
		      	 NATURAL JOIN Rating
		      	 WHERE food_name = '$foodName' && zip = '$zipCode'
		      	       && numberOfStars >= $rating");
      		}
      		else
      		{
	      		$result = mysqli_query($conn, 
		      	"SELECT restaurant_name, cusine, wait_time
		      	 FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Location
		      	 WHERE food_name = '$foodName' && zip = '$zipCode'");
      		}
      	}
      	else
      	{
      		if (isSet($diningOption) && isSet($parkingOption) && isSet($rating))
      		{
      			$result = mysqli_query($conn, 
		      	"SELECT restaurant_name, cusine, wait_time
		      	 FROM Restaurant NATURAL JOIN Location NATURAL JOIN Parking NATURAL JOIN Rating
		      	 NATURAL JOIN Dining
		      	 WHERE zip = '$zipCode' && $parkingOption = '1' && $diningOption = '1' && numberOfStars >= $rating");
      		}
      		elseif (isSet($diningOption) && isSet($parkingOption))
      		{
      			$result = mysqli_query($conn, 
		      	"SELECT restaurant_name, cusine, wait_time
		      	 FROM Restaurant NATURAL JOIN Location NATURAL JOIN Parking NATURAL JOIN Dining
		      	 WHERE zip = '$zipCode' && $parkingOption = '1' && $diningOption = '1'");
      		}
      		elseif (isSet($parkingOption) && isSet($rating))
      		{
      			$result = mysqli_query($conn, 
		      	"SELECT restaurant_name, cusine, wait_time
		      	 FROM Restaurant NATURAL JOIN Location NATURAL JOIN Parking NATURAL JOIN Rating
		      	 WHERE zip = '$zipCode' && $parkingOption = '1' && numberOfStars >= $rating");
      		}
      		elseif (isSet($rating) && isSet($diningOption))
      		{
      			$result = mysqli_query($conn, 
		      	"SELECT restaurant_name, cusine, wait_time
		      	 FROM Restaurant NATURAL JOIN Location NATURAL JOIN Dining NATURAL JOIN Rating
		      	 WHERE zip = '$zipCode' && $diningOption = '1' && numberOfStars >= $rating");
      		}
      		elseif (isSet($diningOption))
      		{
      			$result = mysqli_query($conn, 
		      	"SELECT restaurant_name, cusine, wait_time
		      	 FROM Restaurant NATURAL JOIN Location NATURAL JOIN Dining
		      	 WHERE zip = '$zipCode' && $diningOption = '1'");
      		}
      		elseif (isSet($parkingOption))
      		{
      			$result = mysqli_query($conn, 
		      	"SELECT restaurant_name, cusine, wait_time
		      	 FROM Restaurant NATURAL JOIN Location NATURAL JOIN Parking
		      	 WHERE zip = '$zipCode' && $parkingOption = '1'");
      		}
      		elseif (isSet($rating))
      		{
      			$result = mysqli_query($conn, 
		      	"SELECT restaurant_name, cusine, wait_time
		      	 FROM Restaurant NATURAL JOIN Location NATURAL JOIN Rating
		      	 WHERE zip = '$zipCode' && numberOfStars >= $rating");
      		}
      		else
      		{
	      		$result = mysqli_query($conn, 
		      	"SELECT restaurant_name, cusine, wait_time
		      	 FROM Restaurant NATURAL JOIN Location
		      	 WHERE zip = '$zipCode'");
      		}
      	}
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
							    $output = "<b> Resturant Name: </b> $restaurant_name <br /> <b> Cusine: </b> $cusine <br /> <b> Average Wait Time: </b> $wait_time Minutes";
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