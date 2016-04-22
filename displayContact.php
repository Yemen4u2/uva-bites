<?php
	$restaurantID = $_POST["restaurantID"];

	//connect to MySQL DB
	$servername = "stardock.cs.virginia.edu";
    $username = "cs4750jgd3hbc";
    $password = "spring2016";
    $database = "cs4750jgd3hb";

    // Create connection
    $db = new mysqli($servername, $username, $password, $database);
	if($db->connect_error):
		die ("Could not connect to db: " . mysqli_connect_errno());
	endif;

	header('Content-type: application/json');

	//display contact info for restaurant
	$query = "SELECT phone, email FROM Contact WHERE restaurantID = '$restaurantID'";
	$result = mysqli_query($db, $query) or die ("Invalid Query: " . mysqli_error($db));
	$row = mysqli_fetch_array($result);
	$contactInfo = array();
	$contactInfo["restaurantID"] = $restaurantID;
	$contactInfo["phone"] = $row["phone"];
	$contactInfo["email"] = $row["email"];
	$returnData = json_encode($contactInfo);
	echo $returnData;
?>