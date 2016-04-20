<?php

	$restaurantID = $_POST['restaurantID'];

	//Setting up Connection to the database.

	$servername = "stardock.cs.virginia.edu";
	$username = "cs4750jgd3hbc";
	$password = "spring2016";
	$database = "cs4750jgd3hb";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $database);

	//Check to see if the "Add to Menu" or "Remove from Menu" button has been pushed

	if(isSet($_POST['newPhoneNumber']))
	{
		$newPhoneNumber = $_POST['newPhoneNumber'];
		$UpdatePhoneNumber = "UPDATE Contact SET phone='$newPhoneNumber' WHERE restaurantID='$restaurantID'";
		mysqli_query($conn, $UpdatePhoneNumber);
	}
	if(isSet($_POST['newEmailAddress']))
	{
		$newEmailAddress = $_POST['newEmailAddress'];
		$UpdatePhoneNumber = "UPDATE Contact SET email ='$newEmailAddress' WHERE restaurantID='$restaurantID'";
		mysqli_query($conn, $UpdatePhoneNumber);
	}
	if(isSet($_POST['newStreetAddress']))
	{
		$newStreetAddress = $_POST['newStreetAddress'];
		$UpdateStreetAddress = "UPDATE Location SET street ='$newStreetAddress' WHERE restaurantID='$restaurantID'";
		mysqli_query($conn, $UpdateStreetAddress);
	}
	if(isSet($_POST['newZipCode']))
	{
		$newZipCode = $_POST['newZipCode'];
		$UpdateZipCode = "UPDATE Location SET zip ='$newZipCode' WHERE restaurantID='$restaurantID'";
		mysqli_query($conn, $UpdateZipCode);
	}

	header("Location: http://localhost/uva-bites/memberHome.php");

?>