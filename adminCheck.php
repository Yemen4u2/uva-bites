 <?php
 	//authentication - checking owner DB to see if users have accounts (checking email and password)

 	session_start();

	$userName = rtrim(strip_tags($_POST["userName"]));
	$passW = rtrim(strip_tags($_POST["password"]));

	//connect to MySQL DB
	$servername = "stardock.cs.virginia.edu";
    $username = "cs4750jgd3hba";
    $password = "iamnotAdmin";
    $database = "cs4750jgd3hb";

    // Create connection
    $db = new mysqli($servername, $username, $password, $database);
	if($db->connect_error):
		die ("Could not connect to db: " . mysqli_connect_errno());
	endif;

	$query = "SELECT * FROM Admins WHERE User_Name='$userName' AND Password='$passW'";
	$result = mysqli_query($db, $query) or die ("Invalid Query: " . mysqli_error($db));
	$rows = mysqli_num_rows($result);

	if ($rows < 1):
		echo "You are not an authorized user. Please try again.";
		include "adminLogin.html";
		session_destroy();
	else:
		//otherwise, user is an authorized user
		$row = $result->fetch_array();
		$name = stripslashes($row["User_Name"]);
		$_SESSION["userName"] = $name; //create session variable and store user name
		header("Location: memberHome.php");
	endif;
?>