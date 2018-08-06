<?php
	include_once 'header.php';

	echo $_SESSION['u_uid'];

	$userid = mysqli_real_escape_string($conn, $_SESSION['u_uid']);
	$sql = "SELECT * FROM users WHERE user_uid='$userid'";

	$result = mysqli_query($conn, $sql);
	$queryResult = mysqli_num_rows($result);

	while ($row = mysqli_fetch_assoc($result)) {
		// user_id user_first user_last user_email user_uid user_pwd
		echo "	<div>
					<h2>".$row['user_id']."</h2>
					<h2>".$row['user_first']."</h2>
					<h2>".$row['user_last']."</h2>
					<p>".$row['user_email']."</p>
					<p>".$row['user_uid']."</p>
					<p>".$row['user_pwd']."</p>
				</div>
				<div>
					<h3>Welcome back, ".$row['user_first']." ".$row['user_last']."!</h3>
				</div>

				<div>
					<h3>Your reviews:</h3>";

					$reviewSql = "SELECT * FROM routereviews INNER JOIN routes WHERE routereviews.routeReview_uid='".$row['user_id']."' AND routes.route_uid='".$row['user_id']."'";

					$reviewResult = mysqli_query($conn, $reviewSql);
					$reviewQueryResult = mysqli_num_rows($reviewResult);

					if ($reviewQueryResult > 0) {
											
						while ($reviewRow = mysqli_fetch_assoc($reviewResult)) {
							echo $reviewRow['route_name'];
						}
					}
					else {
						echo "<p>You haven't reviewed any routes!";
					}
				echo "</div>

				<div>
					<h3>Users following:</h3>";
					if (empty($row['user_following'])) {
						echo "<p>You aren't following anybody</p>";
					}
					else {
						$followingarray = explode(",",$row['user_following']);
						foreach ($followingarray as $following) {
							$sqlfollowing = "SELECT * FROM users WHERE user_id='$following'";

							$result = mysqli_query($conn, $sqlfollowing);
							while ($followingrow = mysqli_fetch_assoc($result)) {
								echo "<p>".$followingrow['user_uid']."</p>";
							}
						}
					}
				echo "</div>

				<div>
					<h3>Businesses following:</h3>";
					if (empty($row['user_businessfollow'])) {
						echo "<p>You aren't following any businesses</p>";
					}
					else {
						$businessarray = explode(",",$row['user_businessfollow']);
						foreach ($businessarray as $business) {
							$sqlbusiness = "SELECT * FROM businesses WHERE business_id='$business'";

							$businessresult = mysqli_query($conn, $sqlbusiness);
							while ($businessrow = mysqli_fetch_assoc($businessresult)) {
								echo "<p>".$businessrow['business_name']."</p>";
							}
						}
					}
				echo "</div>

				<div>
					<h3>Your followers:</h3>";
					if (empty($row['user_followers'])) {
						echo "<p>You have no followers</p>";
					}
					else {
						$followerarray = explode(",",$row['user_followers']);
						foreach ($followerarray as $follower) {
							$sqlfollower = "SELECT * FROM users WHERE user_id='$follower'";

							$result = mysqli_query($conn, $sqlfollower);
							while ($followrow = mysqli_fetch_assoc($result)) {
								echo "<p>".$followrow['user_uid']."</p>";
							}
						}
					}
				
				echo "<p>
				</div>

				";
	}

	include_once 'footer.php';
?>

<!--
		Welcome back, $user_first $user_last

		Your reviews:
		Businesses | Routes
		-------
		| Business/Route Name
		| Your rating
		| Open pop-up for text
		-------

		Users following:
		-------
		| Username - 
		| Followers - 
		| Routes -
		| Reviews - 
		-------

		Businesses following:
		-------
		| Business Name
		| Address
		| Rating
		-------

		People following you:
		-------
		| Number:
		| Username list
		-------

  -->