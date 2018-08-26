<?php
	include_once 'header.php';

	// Get the user information from the database using the id stored in the session
	$userid = mysqli_real_escape_string($conn, $_SESSION['u_uid']);
	$sql = "SELECT * FROM users WHERE user_uid='$userid'";

	// Check that the user actually exists. It should, so I haven't put a check after it
	$result = mysqli_query($conn, $sql);
	$queryResult = mysqli_num_rows($result);

	while ($row = mysqli_fetch_assoc($result)) {
		// From the database: user_id user_first user_last user_email user_uid user_pwd
		echo "<div class=\"card\">
					<h3>Welcome back, ".$row['user_first']." ".$row['user_last']."!</h3>
				</div>

				<div class=\"card\">
					<h3>Your reviews:</h3>";

					$reviewSql = "SELECT * FROM routereviews INNER JOIN routes WHERE routereviews.routeReview_uid='".$row['user_id']."' AND routes.route_uid='".$row['user_id']."'";

					$reviewResult = mysqli_query($conn, $reviewSql);
					$reviewQueryResult = mysqli_num_rows($reviewResult);

					if ($reviewQueryResult > 0) {
						echo "<div>";									
						while ($reviewRow = mysqli_fetch_assoc($reviewResult)) {
							echo "<p><a href='route.php?route_id=".$reviewRow['routeReview_rid']."'>".$reviewRow['route_name']."</a></p>";
						}
						echo "</div>";
					}
					else {
						echo "<div>You haven't reviewed any routes!</div>";
					}
				echo "</div>
				<div class=\"card\">
					<h3>Users following:</h3>";
					if (empty($row['user_following'])) {
						echo "<div>You aren't following anybody</div>";
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

				<div class=\"card\">
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
								echo "<h3><a href='business.php?name=".$businessrow['business_name']."&business_id=".$businessrow['business_id']."'>".$businessrow['business_name']."</a></h3>
									<p>".$businessrow['business_type']."</p>
									<p>".$businessrow['business_address']."</p>
									<p>".$businessrow['business_rating']."</p>";
							}
						}
					}
				echo "</div>

				<div class=\"card\">
					<h3>Your followers:</h3>";
					if (empty($row['user_followers'])) {
						echo "<div>You have no followers</div>";
					}
					else {
						$followerarray = explode(",",$row['user_followers']);
						echo "<p>You have <b>". sizeof($followerarray) . "</b> followers</p>";
						foreach ($followerarray as $follower) {
							$sqlfollower = "SELECT * FROM users WHERE user_id='$follower'";

							$result = mysqli_query($conn, $sqlfollower);
							while ($followrow = mysqli_fetch_assoc($result)) {
								echo "<div>".$followrow['user_uid']."</div>";
							}
						}
					}
				
				echo "</div>";
	}

	include_once 'footer.php';
?>

<!-- DESIGN OVERVIEW
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