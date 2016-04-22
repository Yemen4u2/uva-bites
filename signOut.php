<?php

session_start();

session_destroy();

header("Location: http://localhost/uva-bites/index.html");

?>