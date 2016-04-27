<?php   
      if(!isset($_SESSION)){ 
        session_start();
      }

      $servername = "stardock.cs.virginia.edu";
      $username = "cs4750jgd3hbc";
      $password = "spring2016";
      $database = "cs4750jgd3hb";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $database);

      // Check connection
      if ($conn->connect_error) 
      {
        die("Connection failed: " . $conn->connect_error);
      }
      else
      {
      	echo "Connected successfully <br />";
      }

      //Check if values have been inputed and then set them equal to variables

      if(isSet($_GET["restaurantName"]) && $_GET["restaurantName"] != "")
      {
      	$sanatizedRestaurantName = InputCleaner($_GET["restaurantName"]);
            $restaurantName = ('%' . $sanatizedRestaurantName . '%');
      }
      if (isSet($_GET["foodName"]) && $_GET["foodName"] != "")
      {
      	$foodName = InputCleaner($_GET["foodName"]);
      }
      if (isSet($_GET["zip"]) && $_GET["zip"] != "")
      {
      	$zipCode = InputCleaner($_GET["zip"]);
      }
      if (isSet($_GET["parkingOption"]) && $_GET["parkingOption"] != "")
      {
      	$parkingOption = InputCleaner($_GET["parkingOption"]);
      }
      if (isSet($_GET["diningOption"]) && $_GET["diningOption"] != "")
      {
      	$diningOption = InputCleaner($_GET["diningOption"]);
      }
      if (isSet($_GET["rating"]) && $_GET["rating"] != "")
      {
      	$rating = InputCleaner($_GET["rating"]);
      }

      //Check to make sure that at least one of the first three criteria were inputed

      if (!isSet($restaurantName) && !isSet($foodName) && !isSet($zipCode))
      {
            header("Location: http://localhost/uva-bites/customer.html");
      }


    //This is the function used to SANITIZE the values that are inputed.

	function InputCleaner($data)
	{
		//remove space bfore and after
		$data = trim($data); 
		//remove slashes
		$data = stripslashes($data);
            //removes tags and remove or encode special characters from a string. 
		$data=(filter_var($data, FILTER_SANITIZE_STRING));

		return $data;
	}


    //Check if just a restaurant name has been set

    if (isSet($restaurantName)) 
    {

      	//Check if the zip code has been inputed

      	if (isSet($zipCode))
      	{

      		//Check for all combination of dining, parking and rating options

      		if (isSet($diningOption) && isSet($parkingOption) && isSet($rating))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurantID, restaurant_name, cusine, wait_time
	      		FROM Restaurant NATURAL JOIN Location NATURAL JOIN Parking NATURAL JOIN Dining NATURAL JOIN Rating
	      		WHERE restaurant_name LIKE '$restaurantName' && $parkingOption = '1' && zip = '$zipCode' 
	      		&& $diningOption = '1' && numberOfStars >= $rating");
      		}
      		elseif (isSet($diningOption) && isSet($parkingOption))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurantID, restaurant_name, cusine, wait_time
	      		FROM Restaurant NATURAL JOIN Location NATURAL JOIN Parking NATURAL JOIN Dining
	      		WHERE restaurant_name LIKE '$restaurantName' && $parkingOption = '1' && zip = '$zipCode' 
	      		&& $diningOption = '1'");
      		}
      		elseif (isSet($parkingOption) && isSet($rating))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurantID, restaurant_name, cusine, wait_time
	      		FROM Restaurant NATURAL JOIN Location NATURAL JOIN Parking NATURAL JOIN Rating
	      		WHERE restaurant_name LIKE '$restaurantName' && $parkingOption = '1' && zip = '$zipCode' 
	      		&& numberOfStars >= $rating");
      		}
      		elseif (isSet($diningOption))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurantID, restaurant_name, cusine, wait_time
	      		FROM Restaurant NATURAL JOIN Location NATURAL JOIN Dining
	      		WHERE restaurant_name LIKE '$restaurantName' && zip = '$zipCode' && $diningOption = '1'");
      		}
      		elseif (isSet($parkingOption))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurantID, restaurant_name, cusine, wait_time
	      		FROM Restaurant NATURAL JOIN Location NATURAL JOIN Parking
	      		WHERE restaurant_name LIKE '$restaurantName' && zip = '$zipCode' && $parkingOption = '1'");
      		}
      		elseif (isSet($rating))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurantID, restaurant_name, cusine, wait_time
	      		FROM Restaurant NATURAL JOIN Location NATURAL JOIN Rating
	      		WHERE restaurant_name LIKE '$restaurantName' && zip = '$zipCode' && numberOfStars >= $rating");
      		}
      		else
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurantID, restaurant_name, cusine, wait_time
	      		FROM Restaurant NATURAL JOIN Location
	      		WHERE restaurant_name LIKE '$restaurantName' && zip = '$zipCode'");
      		}
      	}

      	//If the zip code is not set then still then still check for all combinations

      	else
      	{

      		if (isSet($diningOption) && isSet($parkingOption) && isSet($rating))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurantID, restaurant_name, cusine, wait_time
	      		FROM Restaurant NATURAL JOIN Parking NATURAL JOIN Dining NATURAL JOIN Rating
	      		WHERE restaurant_name LIKE '$restaurantName' && $parkingOption = '1' && $diningOption = '1' 
	      		      && numberOfStars >= $rating");
      		}
      		else if (isSet($diningOption) && isSet($parkingOption))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurantID, restaurant_name, cusine, wait_time
	      		FROM Restaurant NATURAL JOIN Parking NATURAL JOIN Dining
	      		WHERE restaurant_name LIKE '$restaurantName' && $parkingOption = '1' && $diningOption = '1'");
      		}
      		else if (isSet($parkingOption) && isSet($rating))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurantID, restaurant_name, cusine, wait_time
	      		FROM Restaurant NATURAL JOIN Parking NATURAL JOIN Rating
	      		WHERE restaurant_name LIKE '$restaurantName' && $parkingOption = '1' && numberOfStars >= $rating");
      		}
      		else if (isSet($diningOption))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurantID, restaurant_name, cusine, wait_time
	      		FROM Restaurant NATURAL JOIN Dining
	      		WHERE restaurant_name LIKE '$restaurantName' && $diningOption = '1'");
      		}
      		else if (isSet($parkingOption))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurantID, restaurant_name, cusine, wait_time
	      		FROM Restaurant NATURAL JOIN Parking
	      		WHERE restaurant_name LIKE '$restaurantName' && $parkingOption = '1'");
      		}
      		else if (isSet($rating))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurantID, restaurant_name, cusine, wait_time
	      		FROM Restaurant NATURAL JOIN Rating
	      		WHERE restaurant_name LIKE '$restaurantName' && numberOfStars >= $rating");
      		}
      		else
      		{	
                        $result = mysqli_query($conn, 
		      	"SELECT restaurantID,restaurant_name, cusine, wait_time
		      	FROM Restaurant
		      	WHERE restaurant_name LIKE '$restaurantName'");
      		}
                  
      	}  	
    }

    //Check if just a food name has been set

    else if (isSet($foodName))
    {
      	if (isSet($zipCode))
      	{
      		if (isSet($diningOption) && isSet($parkingOption) && isSet($rating))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurantID, restaurant_name, cusine, wait_time
	      		FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Location
	      		NATURAL JOIN Parking NATURAL JOIN Dining NATURAL JOIN Rating
	      		WHERE food_name = '$foodName' && $zipCode = 'zip' && $parkingOption = '1' && $diningOption = '1' 
	      		      && numberOfStars >= $rating");
      		}
      		elseif (isSet($diningOption) && isSet($parkingOption))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurantID, restaurant_name, cusine, wait_time
	      		FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Location
	      		NATURAL JOIN Parking NATURAL JOIN Dining
	      		WHERE food_name = '$foodName' && $zipCode = 'zip' && $parkingOption = '1' && $diningOption = '1'");
      		}
      		elseif (isSet($parkingOption) && isSet($rating))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurantID, restaurant_name, cusine, wait_time
	      		FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Location
	      		NATURAL JOIN Parking NATURAL JOIN Rating
	      		WHERE food_name = '$foodName' && $zipCode = 'zip' && $parkingOption = '1' && numberOfStars >= $rating");
      		}
      		elseif (isSet($diningOption))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurantID, restaurant_name, cusine, wait_time
	      		FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Location NATURAL JOIN Dining
	      		WHERE food_name = '$foodName' && $zipCode = 'zip' && $diningOption = '1'");
      		}
      		elseif (isSet($parkingOption))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurantID, restaurant_name, cusine, wait_time
	      		FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Location NATURAL JOIN Parking
	      		WHERE food_name = '$foodName' && $zipCode = 'zip' && $parkingOption = '1'");
      		}
      		elseif (isSet($rating))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurantID, restaurant_name, cusine, wait_time
	      		FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Location NATURAL JOIN Rating
	      		WHERE food_name = '$foodName' && $zipCode = 'zip' && numberOfStars >= $rating");
      		}
      		else
      		{
      			$result = mysqli_query($conn, 
		      	"SELECT restaurantID, restaurant_name, cusine, wait_time
		      	 FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Location
		      	 WHERE food_name = '$foodName' && zip = $zipCode");
      		}
      	}
      	else
      	{
      		if (isSet($diningOption) && isSet($parkingOption) && isSet($rating))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurantID, restaurant_name, cusine, wait_time
	      		FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant
	      		NATURAL JOIN Parking NATURAL JOIN Dining NATURAL JOIN Rating
	      		WHERE food_name = '$foodName' && $parkingOption = '1' && $diningOption = '1' 
	      		      && numberOfStars >= $rating");
      		}
      		elseif (isSet($diningOption) && isSet($parkingOption))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurantID, restaurant_name, cusine, wait_time
	      		FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Parking NATURAL JOIN Dining
	      		WHERE food_name = '$foodName' && $parkingOption = '1' && $diningOption = '1'");
      		}
      		elseif (isSet($parkingOption) && isSet($rating))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurantID, restaurant_name, cusine, wait_time
	      		FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Parking NATURAL JOIN Rating
	      		WHERE food_name = '$foodName' && $parkingOption = '1' && numberOfStars >= $rating");
      		}
      		elseif (isSet($diningOption))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurantID, restaurant_name, cusine, wait_time
	      		FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Dining
	      		WHERE food_name = '$foodName' && $diningOption = '1'");
      		}
      		elseif (isSet($parkingOption))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurantID, restaurant_name, cusine, wait_time
	      		FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Parking
	      		WHERE food_name = '$foodName' && $parkingOption = '1'");
      		}
      		elseif (isSet($rating))
      		{
      			$result = mysqli_query($conn,
	      		"SELECT restaurantID, restaurant_name, cusine, wait_time
	      		FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Rating
	      		WHERE food_name = '$foodName' && numberOfStars >= $rating");
      		}
      		else
      		{
	      		$result = mysqli_query($conn, 
			    "SELECT restaurantID, restaurant_name, cusine, wait_time
			    FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant
			    WHERE food_name = '$foodName'");
	      	}
      	}
    }

      //Check if just a zip code has been set

    else if (isSet($zipCode))
    {
      	if (isSet($foodName))
      	{
      		if (isSet($diningOption) && isSet($parkingOption) && isSet($rating))
      		{
      			$result = mysqli_query($conn, 
		      	"SELECT restaurantID, restaurant_name, cusine, wait_time
		      	 FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Location 
		      	 NATURAL JOIN Parking NATURAL JOIN Rating NATURAL JOIN Dining
		      	 WHERE food_name = '$foodName' && zip = '$zipCode'
		      	       && $parkingOption = '1' && $diningOption = '1' && numberOfStars >= $rating");
      		}
      		elseif (isSet($diningOption) && isSet($parkingOption))
      		{
      			$result = mysqli_query($conn, 
		      	"SELECT restaurantID, restaurant_name, cusine, wait_time
		      	 FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Location 
		      	 NATURAL JOIN Parking NATURAL JOIN Dining
		      	 WHERE food_name = '$foodName' && zip = '$zipCode'
		      	  && $parkingOption = '1' && $diningOption = '1'");
      		}
      		elseif (isSet($parkingOption) && isSet($rating))
      		{
      			$result = mysqli_query($conn, 
		      	"SELECT restaurantID, restaurant_name, cusine, wait_time
		      	 FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Location 
		      	 NATURAL JOIN Parking NATURAL JOIN Rating
		      	 WHERE food_name = '$foodName' && zip = '$zipCode'
		      	       && $parkingOption = '1' && numberOfStars >= $rating");
      		}
      		elseif (isSet($rating) && isSet($diningOption))
      		{
      			$result = mysqli_query($conn, 
		      	"SELECT restaurantID, restaurant_name, cusine, wait_time
		      	 FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Location 
		      	 NATURAL JOIN Rating NATURAL JOIN Dining
		      	 WHERE food_name = '$foodName' && zip = '$zipCode'
		      	       && $diningOption = '1' && numberOfStars >= $rating");
      		}
      		elseif (isSet($diningOption))
      		{
      			$result = mysqli_query($conn, 
		      	"SELECT restaurantID, restaurant_name, cusine, wait_time
		      	 FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Location 
		      	 NATURAL JOIN Dining
		      	 WHERE food_name = '$foodName' && zip = '$zipCode'
		      	       && $diningOption = '1'");
      		}
      		elseif (isSet($parkingOption))
      		{
      			$result = mysqli_query($conn, 
		      	"SELECT restaurantID, restaurant_name, cusine, wait_time
		      	 FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Location 
		      	 NATURAL JOIN Parking
		      	 WHERE food_name = '$foodName' && zip = '$zipCode'
		      	       && $parkingOption = '1'");
      		}
      		elseif (isSet($rating))
      		{
      			$result = mysqli_query($conn, 
		      	"SELECT restaurantID, restaurant_name, cusine, wait_time
		      	 FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Location 
		      	 NATURAL JOIN Rating
		      	 WHERE food_name = '$foodName' && zip = '$zipCode'
		      	       && numberOfStars >= $rating");
      		}
      		else
      		{
	      		$result = mysqli_query($conn, 
		      	"SELECT restaurantID, restaurant_name, cusine, wait_time
		      	 FROM Food NATURAL JOIN Menu NATURAL JOIN Restaurant NATURAL JOIN Location
		      	 WHERE food_name = '$foodName' && zip = '$zipCode'");
      		}
      	}
      	else
      	{
      		if (isSet($diningOption) && isSet($parkingOption) && isSet($rating))
      		{
      			$result = mysqli_query($conn, 
		      	"SELECT restaurantID, restaurant_name, cusine, wait_time
		      	 FROM Restaurant NATURAL JOIN Location NATURAL JOIN Parking NATURAL JOIN Rating
		      	 NATURAL JOIN Dining
		      	 WHERE zip = '$zipCode' && $parkingOption = '1' && $diningOption = '1' && numberOfStars >= $rating");
      		}
      		elseif (isSet($diningOption) && isSet($parkingOption))
      		{
      			$result = mysqli_query($conn, 
		      	"SELECT restaurantID, restaurant_name, cusine, wait_time
		      	 FROM Restaurant NATURAL JOIN Location NATURAL JOIN Parking NATURAL JOIN Dining
		      	 WHERE zip = '$zipCode' && $parkingOption = '1' && $diningOption = '1'");
      		}
      		elseif (isSet($parkingOption) && isSet($rating))
      		{
      			$result = mysqli_query($conn, 
		      	"SELECT restaurantID, restaurant_name, cusine, wait_time
		      	 FROM Restaurant NATURAL JOIN Location NATURAL JOIN Parking NATURAL JOIN Rating
		      	 WHERE zip = '$zipCode' && $parkingOption = '1' && numberOfStars >= $rating");
      		}
      		elseif (isSet($rating) && isSet($diningOption))
      		{
      			$result = mysqli_query($conn, 
		      	"SELECT restaurantID, restaurant_name, cusine, wait_time
		      	 FROM Restaurant NATURAL JOIN Location NATURAL JOIN Dining NATURAL JOIN Rating
		      	 WHERE zip = '$zipCode' && $diningOption = '1' && numberOfStars >= $rating");
      		}
      		elseif (isSet($diningOption))
      		{
      			$result = mysqli_query($conn, 
		      	"SELECT restaurantID, restaurant_name, cusine, wait_time
		      	 FROM Restaurant NATURAL JOIN Location NATURAL JOIN Dining
		      	 WHERE zip = '$zipCode' && $diningOption = '1'");
      		}
      		elseif (isSet($parkingOption))
      		{
      			$result = mysqli_query($conn, 
		      	"SELECT restaurantID, restaurant_name, cusine, wait_time
		      	 FROM Restaurant NATURAL JOIN Location NATURAL JOIN Parking
		      	 WHERE zip = '$zipCode' && $parkingOption = '1'");
      		}
      		elseif (isSet($rating))
      		{
      			$result = mysqli_query($conn, 
		      	"SELECT restaurantID, restaurant_name, cusine, wait_time
		      	 FROM Restaurant NATURAL JOIN Location NATURAL JOIN Rating
		      	 WHERE zip = '$zipCode' && numberOfStars >= $rating");
      		}
      		else
      		{
	      		$result = mysqli_query($conn, 
		      	"SELECT restaurantID, restaurant_name, cusine, wait_time
		      	 FROM Restaurant NATURAL JOIN Location
		      	 WHERE zip = '$zipCode'");
      		}
      	}
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
            <script type="text/javascript" language="javascript">
                  function processData(buttonChoice, restaurantID) { //choice = button user pushed
                        var httpRequest;

                        if (window.XMLHttpRequest) { // Mozilla, Safari, ...
                            httpRequest = new XMLHttpRequest();
                            if (httpRequest.overrideMimeType) {
                                httpRequest.overrideMimeType('text/xml');
                            }
                        }
                        else if (window.ActiveXObject) { // Older versions of IE
                            try {
                                httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
                                }
                            catch (e) {
                                try {
                                    httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
                                }
                                catch (e) {}
                            }
                        }
                        if (!httpRequest) {
                            alert('Giving up :( Cannot create an XMLHTTP instance');
                            return false;
                        }

                        if(buttonChoice == "menu") {
                              httpRequest.open("POST", "displayMenu.php", true);
                              httpRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                              httpRequest.send("restaurantID="+restaurantID);
                        } 
                        
                        if(buttonChoice == "contact") {
                              httpRequest.open("POST", "displayContact.php", true);
                              httpRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                              httpRequest.send("restaurantID="+restaurantID);
                        } 

                        httpRequest.onreadystatechange = function() { 
                              if(buttonChoice == "menu") {
                                    displayMenu(httpRequest);
                              } else if(buttonChoice == "contact") {
                                    displayContact(httpRequest);
                              }
                        };
                  }

                  function displayMenu(httpRequest) {
                        if(httpRequest.readyState === 4 && httpRequest.status === 200) {
                              var data = httpRequest.responseText;
                              var restaurantID = JSON.parse(data).restaurantID;
                              var contents = JSON.parse(data).contents; //array that holds menu contents
                              
                              var mInfo = document.getElementById('menuInfo_'+restaurantID);
                              if(mInfo != null) {
                                    mInfo.innerHTML = ''; //empty table
                              }

                              //create new table
                              var theTable = document.createElement('table');
                              theTable.setAttribute('id','menuTable');
                              theTable.border = 1;
                              theTable.align = 'center';
                              mInfo.appendChild(theTable);

                              for (var i = 0; i < contents.length; i++) {
                                    if(i == 0) { //1st row - column headings
                                          var hrow = theTable.insertRow();
                                          hrow.align = 'center';
                                          var cell = hrow.insertCell(0);
                                          var cellContents = document.createTextNode("Menu");
                                          cell.style.fontWeight = "bold";
                                          cell.style.textAlign = "center";
                                          cell.appendChild(cellContents);
                                          hrow = theTable.insertRow();
                                          hrow.align = 'center';
                                          cell = hrow.insertCell(0);
                                          cellContents = document.createTextNode("Food Name");
                                          cell.appendChild(cellContents);
                                          cell = hrow.insertCell(1);
                                          cellContents = document.createTextNode("Calories");
                                          cell.appendChild(cellContents);
                                          cell = hrow.insertCell(2);
                                          cellContents = document.createTextNode("Gluten");
                                          cell.appendChild(cellContents);
                                          cell = hrow.insertCell(3);
                                          cellContents = document.createTextNode("Dairy");
                                          cell.appendChild(cellContents);
                                          cell = hrow.insertCell(4);
                                          cellContents = document.createTextNode("Vegan");
                                          cell.appendChild(cellContents);
                                    } else {
                                          var hrow = theTable.insertRow();
                                          hrow.align = 'center';
                                          //1st column - foodName
                                          var cell = hrow.insertCell(0);
                                          var cellContents = document.createTextNode(contents[i]["foodName"]);
                                          cell.appendChild(cellContents);
                                          //2nd column - calories
                                          cell = hrow.insertCell(1);
                                          var cellContents = document.createTextNode(contents[i]["calories"]);
                                          cell.appendChild(cellContents);
                                          //3rd column - gluten
                                          cell = hrow.insertCell(2);
                                          var gluten = contents[i]["gluten"];
                                          if(gluten == 0) {
                                                var no = document.createTextNode("No");
                                                cell.appendChild(no);
                                          } else if(gluten == 1) {
                                                var yes = document.createTextNode("Yes");
                                                cell.appendChild(yes);
                                          }
                                          //4th column - dairy
                                          cell = hrow.insertCell(3);
                                          var dairy = contents[i]["dairy"];
                                          if(dairy == 0) {
                                                var no = document.createTextNode("No");
                                                cell.appendChild(no);
                                          } else if(dairy == 1) {
                                                var yes = document.createTextNode("Yes");
                                                cell.appendChild(yes);
                                          }
                                          //5th column - vegan
                                          cell = hrow.insertCell(4);
                                          var vegan = contents[i]["vegan"];
                                          if(vegan == 0) {
                                                var no = document.createTextNode("No");
                                                cell.appendChild(no);
                                          } else if(vegan == 1) {
                                                var yes = document.createTextNode("Yes");
                                                cell.appendChild(yes);
                                          }
                                    }
                              }
                        }
                  }

                  function displayContact(httpRequest) {
                        if(httpRequest.readyState === 4 && httpRequest.status === 200) {
                              var data = httpRequest.responseText;
                              var restaurantID = JSON.parse(data).restaurantID;
                              var phone = JSON.parse(data).phone;
                              var email = JSON.parse(data).email;
                              var cInfo = document.getElementById('contactInfo_'+restaurantID);
                              cInfo.innerHTML = "<b>Contact Info:</b><br/><b>Phone: </b>"+phone+"<br/> <b>Email: </b>"+email;
                        }
                  }
            </script>
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
                                  $file_contents = '';
					    $row_cnt = $result->num_rows;
      
					    if($row_cnt == 0) 
					    {
					    	echo "<div class=\"box\">No Results Found</div>";
					    }
					    else
					    {
                                          $fp = fopen('export.json', 'w');
							while ($row = mysqli_fetch_array($result)) :
                                              $restaurantID = $row['restaurantID'];
							    $restaurant_name = $row['restaurant_name'];
							    $cusine = $row['cusine'];
							    $wait_time = $row['wait_time'];
							    $output = "<b> Resturant Name: </b> $restaurant_name <br /> <b> Cusine: </b> $cusine <br /> <b> Average Wait Time: </b> $wait_time Minutes";
							    echo "<div class=\"box\">$output";
                                              echo "<br/><br/>";
          
                                          echo 
                                          "<div id='menuInfo_" . $restaurantID . "'>
                                          <input id='menuButton' type='button' value='Menu' onclick='processData(\"menu\", \"$restaurantID\")'/>
                                          </div>";

                                              echo "<br/>";

                                          echo 
                                          "<div id='contactInfo_" . $restaurantID . "'>
                                          <input id='contactButton' type='button' value='Contact' onclick='processData(\"contact\", \"$restaurantID\")'/>
                                          </div>";
      
                                              echo "</div>";

                                              $file_contents = $file_contents . "Restaurant Name: " . json_encode($restaurant_name) ."\n" . "Cuisine: " . json_encode($cusine) . "\n" . "Wait Time: ". json_encode($wait_time);
                                              fwrite($fp, json_encode($restaurant_name) . "\n");
                                              fwrite($fp, json_encode($cusine) . "\n");
                                              fwrite($fp, json_encode($wait_time) . "\n");
                                              fwrite($fp, "\n");
							endwhile;
                                          fclose($fp);
						}

					?>

<!--                               <a href="export.json" download>
                              <button type="submit">Export as JSON file</button>
                              </a> -->
                              <center>
                              <ul class="actions">
                                    <li><a href="export.json" class="button special" download>Download Results</a></li>
                              </ul>
                              </center>

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