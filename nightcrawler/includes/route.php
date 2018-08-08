<?php
	include_once 'header.php';
?>

<section class="route-container">
	<h1>Route Page</h1>

	<div class="main-container">
		<?php
			$route_id = mysqli_real_escape_string($conn, $_GET['route_id']);

			$sql_route = "SELECT * FROM `routes` INNER JOIN users ON routes.route_uid=users.user_id AND routes.route_id='$route_id'";
			$result_route = mysqli_query($conn, $sql_route);

			$routeQueryResults = mysqli_num_rows($result_route);

			//route_id route_uid route_name route_description route_stops route_type route_rating
			// follow user - following user
			// "UPDATE users SET
			// Check the query has any results first
			if ($routeQueryResults > 0) {

				// get user name

				while ($row = mysqli_fetch_assoc($result_route)) {
					echo "
					<div class='route-box'>
						<h2>".$row['route_name']."</h2>
						<h2>".$row['user_uid']."</h2>
						<h2>".$row['route_description']."</h2>
						<p>".$row['route_address']."</p>
						<p>".$row['route_type']."</p>
						<p>Rating ".$row['route_rating']."</p>
					</div>";
				}
			}
			echo "</div>
				<div>";


			$sql_businessreviews = "SELECT * FROM businessreviews WHERE businessReview_bid='$business_id'";
			$result_reviews = mysqli_query($conn, $sql_businessreviews);

			$reviewQueryResults = mysqli_num_rows($result_reviews);

			if ($reviewQueryResults > 0) {
				while ($row = mysqli_fetch_assoc($result_reviews)) {
					
					$sqlname = "SELECT user_uid FROM users WHERE user_id=".$row['businessReview_uid'];
					$review_username = mysqli_query($conn, $sqlname);
					$username = mysqli_fetch_assoc($review_username);
					echo "
					<div class='business-box'>
						<h2>".$username['user_uid']."</h2>

						<h2>".$row['businessReview_rating']."</h2>
						<p>".$row['businessReview_review']."</p>
					</div>";
				}
			} else {
				echo "There are no reviews of this business right now!";
			}
			if (isset($_SESSION['route_checkin'])) {
				//Already travelling route
				if ($_SESSION['route_checkin'] == $business_id) {
					echo "you are checked in";
					echo "<form action=\"includes/businessreview.inc.php\" method=\"POST\">
					Rating:
					<input type=\"number\" id=\"rating\" name=\"rating\"
           				placeholder=\"Min: 1, max: 5\" min=\"1\" max=\"5\" step=\"1\"/></input>
           			Review:
           			<input type=\"text\" id=\"review\" name=\"review\" 
           				placeholder=\"Write a short review of this business if you want\"></input>
           			<input type=\"submit\" name=\"submit\" value=\"Submit\">
           			</form>";
           			echo $_SESSION['route_checkin'];

				} else {
					//Already on another route
					echo "You are checked into another business. Would you like to check into this one instead? 
					<form action=\"includes/checkin.inc.php\" method=\"GET\">
					<input type=\"hidden\" name=\"name\" value=\"".$title."\">
					<input type=\"hidden\" name=\"business_id\" value=\"".$business_id."\"> 
					<input type=\"submit\" name=\"submit\" value=\"Check in\">
					</form>";
				}
			} else {
				//Begin a route
				echo "You are not checked into another business. Would you like to check into this one instead?
					<form action=\"includes/checkin.inc.php\" method=\"GET\">
					<input type=\"hidden\" name=\"name\" value=\"".$title."\">
					<input type=\"hidden\" name=\"business_id\" value=\"".$business_id."\"> 
					<input type=\"submit\" name=\"submit\" value=\"Check in\">
					</form>";
			}
		?>
	</div>
</div>
</section>
<?php
	include_once 'footer.php'
?>