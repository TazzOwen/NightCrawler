<?php

/*Stop people from accessing the script manually*/
if (isset($_POST['submit'])) {
	
	include_once 'dbh.inc.php';

	session_start();

	$uid = mysqli_real_escape_string($conn, $_SESSION['u_id']);
	$rid = mysqli_real_escape_string($conn, $_SESSION['checkedin']);
	$rating = mysqli_real_escape_string($conn, $_POST['rating']);
	$review = mysqli_real_escape_string($conn, $_POST['review']);

	//Error handlers
	//Check for empty fields
	if (empty($uid) || empty($bid) || empty($rating)) {
		header('Location: ' . $_SERVER['HTTP_REFERER']); /*Sends them back to the previous page*/
		exit();
	} else {
		$sql = "SELECT * FROM routereviews WHERE routeReview_uid = '$uid' AND routeReview_rid = '$rid'";
		$result = mysqli_query($conn, $sql);
		$queryResult = mysqli_num_rows($result);

		if ($queryResult > 0) {
			$changeReview = "UPDATE routereviews SET routeReview_rating = '$rating', routeReview_review = '$review' WHERE routeReview_uid = '$uid' AND routeReview_rid = '$rid'";
			mysqli_query($conn, $changeReview);
		} else {
			$newReview = "INSERT INTO routereviews (routeReview_uid, routeReview_rid, routeReview_rating, routeReview_review) VALUES ('$uid', '$rid', '$rating', '$review')";
			mysqli_query($conn, $newReview);
		}
		
		$avgSql = "SELECT AVG(routeReview_rating) AS 'average' FROM routereviews WHERE routeReview_rid = '$rid'";
		$avgQuery = mysqli_query($conn, $avgSql);
		while ($row = mysqli_fetch_assoc($avgQuery)) {
			$avg = $row['average'];
			$newAvg = "UPDATE routes SET route_rating = '$avg' WHERE route_id LIKE '$rid' ";
			mysqli_query($conn, $newAvg);
		};

		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit();
	}
}