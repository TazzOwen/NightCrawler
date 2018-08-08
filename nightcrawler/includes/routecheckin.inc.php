<?php

	session_start();

	$route_id = $_GET['business_id'];

	$_SESSION['route_checkin'] = $route_id;

	header("Location: ../route.php?name=".$route_id);
	exit();

?>