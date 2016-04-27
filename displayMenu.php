<?php
	$restaurantID = $_POST["restaurantID"];

	//connect to MySQL DB
	$servername = "stardock.cs.virginia.edu";
    $username = "cs4750jgd3hbc";
    $password = "youCanOnlySee";
    $database = "cs4750jgd3hb";

    // Create connection
    $db = new mysqli($servername, $username, $password, $database);
	if($db->connect_error):
		die ("Could not connect to db: " . mysqli_connect_errno());
	endif;

	//display menu for restaurant
	$query = "SELECT food_name, calories, gluten, dairy, vegan FROM Menu NATURAL JOIN Food NATURAL JOIN Nutrition WHERE restaurantID = '$restaurantID'";
	$result = mysqli_query($db, $query) or die ("Invalid Query: " . mysqli_error($db));
	$numRows = mysqli_num_rows($result);

	$menuInfo = Array();
	$temp = Array();
	for($i = 0; $i < $numRows; $i++) {
		$row = mysqli_fetch_array($result);
		$currArray = Array();
		$currArray["foodName"] = $row["food_name"];
		$currArray["calories"] = $row["calories"];
		$currArray["gluten"] = $row["gluten"];
		$currArray["dairy"] = $row["dairy"];
		$currArray["vegan"] = $row["vegan"];
		$temp[] = $currArray;
	}
	$menuInfo["restaurantID"] = $restaurantID;
	$menuInfo["contents"] = $temp;

	$returnData = json_encode($menuInfo);
	echo $returnData;
?>