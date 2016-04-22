<?php

	$restaurantID = $_POST['restaurantID'];

	//Setting up Connection to the database.

	$servername = "stardock.cs.virginia.edu";
	$username = "cs4750jgd3hbd";
	$password = "spring2016";
	$database = "cs4750jgd3hb";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $database);

	//Check to see if the "Add to Menu" or "Remove from Menu" button has been pushed

	if(isSet($_POST['newPhoneNumber']) && $_POST['newPhoneNumber'] != "")
	{
		$newPhoneNumber = rtrim(strip_tags($_POST['newPhoneNumber']));
		$UpdatePhoneNumber = "UPDATE Contact SET phone='$newPhoneNumber' WHERE restaurantID='$restaurantID'";
		mysqli_query($conn, $UpdatePhoneNumber);
	}
	if(isSet($_POST['newEmailAddress']) && $_POST['newEmailAddress'] != "")
	{
		$newEmailAddress = rtrim(strip_tags($_POST['newEmailAddress']));
		$UpdatePhoneNumber = "UPDATE Contact SET email ='$newEmailAddress' WHERE restaurantID='$restaurantID'";
		mysqli_query($conn, $UpdatePhoneNumber);
	}
	if(isSet($_POST['newStreetAddress']) && $_POST['newStreetAddress'] != "")
	{
		$newStreetAddress = rtrim(strip_tags($_POST['newStreetAddress']));
		$UpdateStreetAddress = "UPDATE Location SET street ='$newStreetAddress' WHERE restaurantID='$restaurantID'";
		mysqli_query($conn, $UpdateStreetAddress);
	}
	if(isSet($_POST['newZipCode']) && $_POST['newZipCode'] != "")
	{
		$newZipCode = rtrim(strip_tags($_POST['newZipCode']));
		$UpdateZipCode = "UPDATE Location SET zip ='$newZipCode' WHERE restaurantID='$restaurantID'";
		mysqli_query($conn, $UpdateZipCode);
	}

	header("Location: http://localhost/uva-bites/memberHome.php");

?>