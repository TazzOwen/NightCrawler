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
  <p>Resize the browser window to see the effect.</p>
</div>

<div class="nav-bar">
	<a href="index.php">Home</a>
	<?php
		if (isset($_SESSION['u_id'])) {
			echo '<a href="searchindex.php">Search</a></li>
				<a href="index.php">What\'s Hot</a></li>
				<a href="index.php">Create Route</a></li>';
		}
	?>
	<div class="nav-bar" style="float: right">
	<?php
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