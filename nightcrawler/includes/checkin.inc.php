<?php

	session_start();

	$title = $_GET['name'];
	$business_id = $_GET['business_id'];

	$_SESSION['checkedin'] = $business_id;

	header("Location: ../business.php?name=".$title."&business_id=".$business_id."");
	exit();

?>