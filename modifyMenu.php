<?php

	$restaurantID = $_POST['restaurantID'];
	$foodItem =  $_POST['Food'];

	//Setting up Connection to the database.

	$servername = "stardock.cs.virginia.edu";
	$username = "cs4750jgd3hbb";
	$password = "spring2016";
	$database = "cs4750jgd3hb";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $database);

	//Check to see if the "Add to Menu" or "Remove from Menu" button has been pushed

	if(isSet($_POST['addItem']))
	{
		$AddToMenu = "INSERT INTO Menu VALUES ('$restaurantID', '$foodItem')";
		mysqli_query($conn, $AddToMenu);
	}
	else if(isSet($_POST['removeItem']))
	{
		$RemoveFromMenu = "DELETE FROM cs4750jgd3hb.Menu WHERE restaurantID = '$restaurantID' AND foodID = '$foodItem'";
		mysqli_query($conn, $RemoveFromMenu);
	}

	header("Location: http://localhost/uva-bites/memberHome.php");

?>