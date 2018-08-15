<?php

include_once 'dbh.inc.php';

session_start();

$userid = $_SESSION['u_id'];
$businessid = mysqli_real_escape_string($conn, $_POST['business_id']);
$businessname = $_POST['business_name'];

//Add the reviewer to users you are following
$usersql = "SELECT * FROM users WHERE user_id='$userid'";
$userresult = mysqli_query($conn, $usersql);

$resultrow = mysqli_fetch_assoc($userresult);

// Checks if anything is in the following array. Stops the implode functon adding a "," at the start
$userarray = $resultrow['user_businessfollow'] . "," . $businessid;

$newusersql = "UPDATE users SET user_businessfollow='$userarray' WHERE user_id='$userid'";
mysqli_query($conn, $newusersql);

//Add the user to the business' list of followers
$businesssql = "SELECT * FROM businesses WHERE business_id='$businessid'";
$businessresult = mysqli_query($conn, $reviewsql);

$resultrow = mysqli_fetch_assoc($businessresult);

$businessarray = $resultrow['business_followers'] . "," . $userid;

$newreviewsql = "UPDATE businesses SET business_followers='$businessarray' WHERE business_id='$businessid'";
mysqli_query($conn, $newreviewsql);

header("Location: ../business.php?business_id=".$businessid."&name=".$businessname);

exit();