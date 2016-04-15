<?php
	session_start();
	
	if(isset($_SESSION["userName"])) {
		$userName = $_SESSION["userName"];
	} else {
		header("Location: adminLogin.html");
	}
?>
<!DOCTYPE html>
<!--
	Alpha by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>UVABites</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body>
		<div id="page-wrapper">
			<header id="header" class="alt">
				<h1><a href="index.html">UVaBites</a> by Thunder Squad</h1>
				<nav id="nav">
					<ul>
						<li><a href="index.html">Home</a></li>
					</ul>
				</nav>		
			</header>
		</div>
		<center>
			<section id="main" class="container 75%">
				<header>
					<h3>Welcome <?php echo $userName; ?>!</h3>
				</header>
				<div class="box">
					<form action="choiceForms.php" method="POST">
						<div class="row uniform 50%">
							<div class="12u">
								<h4>Would you like to:</h4>
								<input type="radio" name="choice" value="add">create a new restuarant<br>
								<input type="radio" name="choice" value="create">add a new component to your restuarant<br>
						  		<input type="radio" name="choice" value="modify">update a component of your existing restaurant<br>
						  		<br>
						  		<input type="submit" value="Enter">
							</div>
						</div>
					</form>
				</div>
			</section>
		</center>									
	</body>
</html>