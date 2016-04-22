<?php

	$servername = "stardock.cs.virginia.edu";
	$username = "cs4750jgd3hb";
	$password = "p@ssw0rd";
	$database = "cs4750jgd3hb";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $database);

	if (isset($_GET['allAmericanRestaurants']))
	{
		$result = mysqli_query($conn, "SELECT * FROM allAmericanRestaurants");
	}
	else if (isset($_GET['allChineseRestaurants']))
	{
		$result = mysqli_query($conn, "SELECT * FROM allChineseRestaurants");
	}
	else if (isset($_GET['allFrenchRestaurants']))
	{
		$result = mysqli_query($conn, "SELECT * FROM allFrenchRestaurants");
	}
	else if (isset($_GET['allVegetarianRestaurants']))
	{
		$result = mysqli_query($conn, "SELECT * FROM allVegetarianRestaurants");
	}
	else if (isset($_GET['allDairyFreeRestaurants']))
	{
		$result = mysqli_query($conn, "SELECT * FROM allDairyFreeRestaurants");
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
				<li><a href="signUp.html" class="button">Sign Up</a></li>
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

							while ($row = mysqli_fetch_array($result))
							{
								$restaurant_name = $row['restaurant_name'];
							    $cusine = $row['cusine'];
							    $wait_time = $row['wait_time'];
							    $output = "<b> Resturant Name: </b> $restaurant_name <br /> <b> Cusine: </b> $cusine <br /> <b> Average Wait Time: </b> $wait_time Minutes";
								echo "<div class=\"box\">$output</div>";
							}

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