<?php
      $servername = "stardock.cs.virginia.edu";
      $username = "cs4750jgd3hb";
      $password = "p@ssw0rd";
      $database = "cs4750jgd3hb";

      // Create connection
      $conn = new mysqli($servername, $username, $password);

      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      } 
      echo "Connected successfully";
?>