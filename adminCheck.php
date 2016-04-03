 <?php
 	session_start();
	//authentication - checking owner DB to see if users have accounts (checking email and password)

	$email = rtrim(strip_tags($_POST["email"]));
	$_SESSION["buyerEmail"] = $email; //create session variable and store user's email
	$password = rtrim(strip_tags($_POST["password"]));

	//connect to MySQL DB ------- CHANGE THIS INFO
	/*
	$db = new mysqli('localhost', 'Maggie', 'happiness', 'HW2');
	if($db->connect_error):
		die ("Could not connect to db: " . $db->connect_error);
	endif;
	*/

	$query = "SELECT * FROM Buyer WHERE Email='$email' AND Password='$password'";
	$result = $db->query($query) or die ("Invalid Query: " . $db->error);
	
	$rows = $result->num_rows;
	if ($rows < 1):
		echo "You are not an authorized user. Please try again.";
		include "adminLogin.php";
		session_destroy();
	else:
		//otherwise, user is an authorized user
		$row = $result->fetch_array();
		$name = stripslashes($row["Name"]);
		$_SESSION["buyerName"] = $name; //create session variable and store user name
		header("Location: adminForm.php");
	endif;
?>