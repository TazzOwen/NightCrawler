<?php

/*Stop people from accessing the script manually*/
if (isset($_POST['submit'])) {
	
	include_once 'dbh.inc.php';

	session_start();

	$uid = mysqli_real_escape_string($conn, $_SESSION['u_id']);
	$bid = mysqli_real_escape_string($conn, $_SESSION['checkedin']);
	$rating = mysqli_real_escape_string($conn, $_POST['rating']);
	$review = mysqli_real_escape_string($conn, $_POST['review']);

	//Error handlers
	//Check for empty fields
	if (empty($uid) || empty($bid) || empty($rating)) {
		header('Location: ' . $_SERVER['HTTP_REFERER']); /*Sends them back to the previous page*/
		exit();
	} else {
		$sql = "SELECT * FROM businessreviews WHERE businessReview_uid = '$uid' AND businessReview_bid = '$bid'";
		$result = mysqli_query($conn, $sql);
		$queryResult = mysqli_num_rows($result);

		if ($queryResult > 0) {
			$changeReview = "UPDATE businessreviews SET businessReview_rating = '$rating', businessReview_review = '$review' WHERE businessReview_uid = '$uid' AND businessReview_bid = '$bid'";
			mysqli_query($conn, $changeReview);
		} else {
			$newReview = "INSERT INTO businessreviews (businessReview_uid, businessReview_bid, businessReview_rating, businessReview_review) VALUES ('$uid', '$bid', '$rating', '$review')";
			mysqli_query($conn, $newReview);
		}
		
		$avgSql = "SELECT AVG(businessReview_rating) AS 'average' FROM businessreviews WHERE businessReview_bid = '$bid'";
		$avgQuery = mysqli_query($conn, $avgSql);
		while ($row = mysqli_fetch_assoc($avgQuery)) {
			$avg = $row['average'];
			$_SESSION['average'] = $avg;
			$newAvg = "UPDATE businesses SET business_rating = '$avg' WHERE business_id LIKE '$bid' ";
			mysqli_query($conn, $newAvg);
		};

		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit();
	}
}