<?php
      $servername = "stardock.cs.virginia.edu";
      $username = "cs4750sma3em";
      $password = "TheOrder5";
      $database = "cs4750sma3em";

      // Create connection
      $conn = new mysqli($servername, $username, $password);

      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      } 
      echo "Connected successfully";
?>