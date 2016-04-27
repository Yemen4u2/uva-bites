 <?php

	
 	//Setting variables equal to user input
	$userName = rtrim(strip_tags($_POST["userName"]));
	$passW = rtrim(strip_tags($_POST["password"]));
	$restaurantName = rtrim(strip_tags($_POST["restaurant"]));
	$streetAddress = rtrim(strip_tags($_POST["streetName"]));
	$zipCode =  rtrim(strip_tags($_POST["zipCode"]));
	$cusine = rtrim(strip_tags($_POST["cusine"]));
	$waitTime = rtrim(strip_tags($_POST["waitTime"]));
	$restaurantRating = rtrim(strip_tags($_POST["rating"]));
	$restaurantCost = rtrim(strip_tags($_POST["cost"]));
	$restaurantPhoneNumber = rtrim(strip_tags($_POST["contactNumber"]));
	$restaurantEmail = rtrim(strip_tags($_POST["contactEmail"]));
	$costOfParking = rtrim(strip_tags($_POST["parkingCost"]));

	//Now we check to see which boxes the user checked. 
	//The variables will be set to true (1) or false (0) based on that.

	if (isset($_POST['sitIn']) && $_POST['sitIn'] == '1')
	{
		$sitIn = 1;
	}
	else
	{
		$sitIn = 0;
	}

	if (isset($_POST['delivery']) && $_POST['delivery'] == '1')
	{
		$delivery = 1;
	}
	else
	{
		$delivery = 0;
	}

	if (isset($_POST['carryout']) && $_POST['carryout'] == '1')
	{
		$carryout = 1;
	}
	else
	{
		$carryout = 0;
	}

	if (isset($_POST['reservation']) && $_POST['reservation'] == '1')
	{
		$reservation = 1;
	}
	else
	{
		$reservation = 0;
	}

	//Same as above except this is for the parking options

	if (isset($_POST['parkingLot']) && $_POST['parkingLot'] == '1')
	{
		$parkingLot = 1;
	}
	else
	{
		$parkingLot = 0;
	}

	if (isset($_POST['streetParking']) && $_POST['streetParking'] == '1')
	{
		$streetParking = 1;
	}
	else
	{
		$streetParking = 0;
	}

	if (isset($_POST['garageParking']) && $_POST['garageParking'] == '1')
	{
		$garageParking = 1;
	}
	else
	{
		$garageParking = 0;
	}


	//ALL VARIABLES HAVE BEEN SET


	//Connect to MySQL DB

	$servername = "stardock.cs.virginia.edu";
    $username = "cs4750jgd3hbd";
    $password = "changeContact";
    $database = "cs4750jgd3hb";

    // Create connection
    $db = new mysqli($servername, $username, $password, $database);
	if($db->connect_error):
		die ("Could not connect to db: " . mysqli_connect_errno());
	endif;

	//check if user already has an account looking through the database for a matching user

	$query = "SELECT * FROM Admins WHERE User_Name='$userName'";
	$result = mysqli_query($db, $query) or die ("Invalid Query: " . mysqli_error($db));
	$rows = mysqli_num_rows($result);

	//if the user does not alread exist in table there will be no rows found

	if($rows < 1)
	{ 

		//Calculate the total number of restaurants in the database to assign new restaurant ID

		$totalResaurant = "SELECT * FROM Restaurant";
		$result = mysqli_query($db, $totalResaurant);
		$restaurantID = mysqli_num_rows($result) + 1;

		//Add restaurant information to database
		
		$addRestaurant = "INSERT INTO Restaurant (restaurantID, restaurant_name, cusine, wait_time) 
						VALUES ('$restaurantID', '$restaurantName', '$cusine', '$waitTime')";
		mysqli_query($db, $addRestaurant);

		//Add user information to database

		$addUser = "INSERT INTO Admins (User_Name, Password, restaurantID) 
					VALUES ('$userName', '$passW', '$restaurantID')";
		mysqli_query($db, $addUser);

		//Add contact information to database

		$addContactInformation = "INSERT INTO Contact (restaurantID, phone, email) 
								VALUES ('$restaurantID', '$restaurantPhoneNumber', '$restaurantEmail')";
		mysqli_query($db, $addContactInformation);

		//Add dining options to database

		$addDiningOptions = "INSERT INTO Dining (restaurantID, sitin, delivery, carryout, reservation)
							VALUES ('$restaurantID', '$sitIn', '$delivery', '$carryout', '$reservation')";
		mysqli_query($db, $addDiningOptions);

		//Add location information to database

		$addRestaurantLocation = "INSERT INTO Location (restaurantID, street, zip)
								VALUES ('$restaurantID', '$streetAddress', '$zipCode')";
		mysqli_query($db, $addRestaurantLocation);

		//Add parking option to database

		$addParkingOptions = "INSERT INTO Parking (restaurantID, ParkingLot, StreetParking, Garage, Cost)
						VALUES ('$restaurantID', '$parkingLot', '$streetParking', '$garageParking', '$costOfParking')";
		mysqli_query($db, $addParkingOptions);

		//Add restaurant rating to database

		$addRestaurantRating = "INSERT INTO Rating (restaurantID, numberOfStars) 
							VALUES ('$restaurantID', '$restaurantRating')";
		mysqli_query($db, $addRestaurantRating);
		
		header("Location: http://localhost/uva-bites/adminLogin.html");
	}
	else
	{
		echo "You are already registered. Please login in.";
	}
?>