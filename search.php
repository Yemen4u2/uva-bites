<?php
      $servername = "stardock.cs.virginia.edu";
      $username = "cs4750jgd3hb";
      $password = "p@ssw0rd";
      $database = "cs4750jgd3hb";

      $test = $_GET["restaurantName"];

      // Create connection
      $conn = new mysqli($servername, $username, $password, $database);

      // Check connection
      if ($conn->connect_error) 
      {
          die("Connection failed: " . $conn->connect_error);
      } 

      echo "Connected successfully";

      $result = mysqli_query($conn, "SELECT restaurant_name FROM Restaurant WHERE restaurantID = '$test'");
      
      if(!$result) 
      {
            die("Database query failed: " . mysqli_error($conn));
      }
      
      while ($row = mysqli_fetch_array($result)) 
      {
            echo "We found it!!!";
      }
?>