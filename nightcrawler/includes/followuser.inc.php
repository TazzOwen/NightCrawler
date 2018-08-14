<?php

include_once 'dbh.inc.php';

session_start();

$userid = $_SESSION['u_id'];
$reviewid = mysqli_real_escape_string($conn, $_POST['reviewer_id']);

//Add the reviewer to users you are following
$usersql = "SELECT * FROM users WHERE user_id='$userid'";
$userresult = mysqli_query($conn, $usersql);

$resultrow = mysqli_fetch_assoc($userresult);

// Checks if anything is in the following array. Stops the implode functon adding a "," at the start
$newuserarray = $resultrow['user_following'];

if (strlen($resultrow['user_following']) > 1) {
	$olduserarray = explode(",", $resultrow['user_following']);
	array_push($olduserarray, $reviewid);
	$newuserarray = implode(",", $olduserarray);
} 

$newusersql = "UPDATE users SET user_following='$newuserarray' WHERE user_id='$userid'";
mysqli_query($conn, $newusersql);

//Add the user to the reviewer's list of followers
$reviewsql = "SELECT * FROM users WHERE user_id='$reviewid'";
$reviewresult = mysqli_query($conn, $reviewsql);

$resultrow = mysqli_fetch_assoc($reviewresult);

$newreviewarray = $resultrow['user_followers'];

if (strlen($resultrow['user_following']) > 1) {
	$oldreviewarray = explode(",", $resultrow['user_followers']);
	array_push($oldreviewarray, $userid);
	$newreviewarray = implode(",", $oldreviewarray);
} 

$oldreviewarray = explode(",", $resultrow['user_followers']);
array_push($oldreviewarray, $reviewid);

$newreviewarray = implode(",", $oldreviewarray);

$newreviewsql = "UPDATE users SET user_followers='$newreviewarray' WHERE user_id='$reviewid'";
mysqli_query($conn, $newreviewsql);

header("Location: ../route.php?route_id=".$_POST['route_id']."&success=".$newreviewarray);

exit();