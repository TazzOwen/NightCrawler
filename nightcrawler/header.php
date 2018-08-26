<?php

	session_start();
	include 'includes/dbh.inc.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<div class="header">
  <h1>Nightcrawler</h1>
  <p></p>
</div>

<div class="nav-bar">
	<a href="index.php">Home</a>
	<?php
		if (isset($_SESSION['u_id'])) {
			// "What's Hot" and "Create Route" currently don't link anywhere - they are for some of the EVFs.
			// They were placed there to fill out and design the navigation bar
			echo '<a href="searchindex.php">Search</a></li>
				<a href="index.php">What\'s Hot</a></li>
				<a href="index.php">Create Route</a></li>';
		}
	?>
	<div class="nav-bar" style="float: right">
	<?php
		// Checks the user's session info to see if they are logged in and acts accordingly
		if (isset($_SESSION['u_id'])) {
			echo'<form action="includes/logout.inc.php" method="POST">
					<button type="submit" name="submit">Logout</button>
				</form>';
		} else {
			echo '	<form action="includes/login.inc.php" method="POST">
						<a href="signup.php">Sign up</a>
						<input type="text" name="uid" placeholder="Username/mail">
						<input type="password" name="pwd" placeholder="password">
						<button type="submit" name="submit">Login</button>
					</form>';
		}
	?>
	</div>
</div>