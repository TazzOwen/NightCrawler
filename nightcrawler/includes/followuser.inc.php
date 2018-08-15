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
$userarray = $resultrow['user_following'] . "," . $reviewid;

$newusersql = "UPDATE users SET user_following='$userarray' WHERE user_id='$userid'";
mysqli_query($conn, $newusersql);

//Add the user to the reviewer's list of followers
$reviewsql = "SELECT * FROM users WHERE user_id='$reviewid'";
$reviewresult = mysqli_query($conn, $reviewsql);

$resultrow = mysqli_fetch_assoc($reviewresult);

$reviewarray = $resultrow['user_followers'] . "," . $userid;

$newreviewsql = "UPDATE users SET user_followers='$reviewarray' WHERE user_id='$reviewid'";
mysqli_query($conn, $newreviewsql);

header("Location: ../route.php?route_id=".$_POST['route_id']."&success=".$newreviewarray);

exit();