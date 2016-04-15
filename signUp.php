 <?php
 	//authentication - checking owner DB to see if users have accounts (checking email and password)

 	if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

	$userName = rtrim(strip_tags($_POST["userName"]));
	$passW = rtrim(strip_tags($_POST["password"]));

	//connect to MySQL DB
	$servername = "stardock.cs.virginia.edu";
    $username = "cs4750jgd3hb";
    $password = "p@ssw0rd";
    $database = "cs4750jgd3hb";

    // Create connection
    $db = new mysqli($servername, $username, $password, $database);
	if($db->connect_error):
		die ("Could not connect to db: " . mysqli_connect_errno());
	endif;

	//check if user already has an account
	$query = "SELECT * FROM Admins WHERE User_Name='$userName' AND Password='$passW'";
	$result = mysqli_query($db, $query) or die ("Invalid Query: " . mysqli_error($db));
	$rows = mysqli_num_rows($result);

	if($rows < 1) { //user does not exist in table
		$query = "INSERT INTO Admins (User_Name, Password) VALUES ('$userName', '$passW')";
		$result = mysqli_query($db, $query) or die ("Invalid Query: " . mysqli_error($db));
		header("Location: http://localhost/uva-bites/memberHome.php");
	} else {
		echo "You are already registered. Please login in.";
		include "signUp.html";
		session_destroy();
	}
?>