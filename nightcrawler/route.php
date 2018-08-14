<?php
	include_once 'header.php';
?>

<section class="route-container">

	<div class="main-container">
		<?php
			$route_id = mysqli_real_escape_string($conn, $_GET['route_id']);

			$sql_route = "SELECT * FROM `routes` INNER JOIN users ON routes.route_uid=users.user_id AND routes.route_id='$route_id'";
			$result_route = mysqli_query($conn, $sql_route);

			$routeQueryResults = mysqli_num_rows($result_route);

			//route_id route_uid route_name route_description route_stops route_type route_rating
			// Check the query has any results first
			if ($routeQueryResults > 0) {

				echo "<div class='row'>";
				echo "<div class='leftcolumn'>";
				while ($row = mysqli_fetch_assoc($result_route)) {
					echo "
					<div class='card'>
						<h1>".$row['route_name']."</h1>
						<h3><i>".$row['route_type']."</i></h3>
						<p><em>".$row['route_description']."</em></p></div>";
						// Split the array of stops and call on the business table to get some info
						$stoparray = explode(",",$row['route_stops']);
						foreach ($stoparray as $stop) {
							$sqlstops = "SELECT * FROM businesses WHERE business_id='$stop'";

							$result_stop = mysqli_query($conn, $sqlstops);

							// The actual party where the stops are listed and described
							// business_id business_name business_description business_address business_type business_latitude business_longitude business_rating
							while ($stoprow = mysqli_fetch_assoc($result_stop)) {
								echo "<div class='card'>
								<h2>".$stoprow['business_name']."</h2>
								<p><em>".$stoprow['business_address']."</em></p>
								<p><b>".$stoprow['business_type']."</b></p>
								<p><b>Rating: ".$stoprow['business_rating']."</b></p>
								<p>".$stoprow['business_description']."</p>
								</div>";
							}
						}

					echo "</div>

					<div class='rightcolumn'>
					<div class='card'>
					<h2><em>Rating ".$row['route_rating']."</em></h2>
					<h3>Created by: ".$row['user_uid']."</h3>";
					// Checks if you follow the creator. If not, there is a button to follow this user
					$followcheck = explode(",",$row['user_followers']);
					// Checks you aren't the creator first!
					if ($_SESSION['u_id'] == $row['route_uid']) {
						echo "<p><em>That's you!</em></p>";
					}
					else {
						if (in_array($_SESSION['u_id'], $followcheck)) {
						echo "<button type=\"button\" disabled>You follow this user already</button>";
						}
						else {
							echo "<form action=\"includes/followuser.inc.php\" method=\"POST\">
							<input type=\"hidden\" name=\"reviewer_id\" value=\"".$row['route_uid']."\">
							<input type=\"hidden\" name=\"route_id\" value=\"".$route_id."\"> 
							<button type=\"submit\" name=\"submit\">Follow this user</button>
							</form>";
						}
					}

					echo "</div>
					<div class='card'>
					<h2>Reviews</h2>";
					// Check for reviews and deal with them accordingly
					$sql_review = "SELECT * FROM `routereviews` INNER JOIN users ON routereviews.routeReview_uid=users.user_id AND routereviews.routeReview_rid='$route_id'";
					$result_review = mysqli_query($conn, $sql_review);

					$reviewQueryResults = mysqli_num_rows($result_review);

					if ($reviewQueryResults > 0) {
						while ($reviewrow = mysqli_fetch_assoc($result_review)) {

							echo "
							<div class='card'>
								<h2>".$reviewrow['user_uid']."</h2>
								<p><b>Rating: ".$reviewrow['routeReview_rating']."</b></p>";
								// Checks if the reviewer actually left a text review instead of just a rating - otherwise skips to the next reviewer
								// (Like on the Google store - it just shows the rating if there is no indepth review)
								if (!empty($reviewrow['routeReview_review'])) {
									echo "<p>".$reviewrow['routeReview_review']."</p>";
								}
							echo "</div>";
						}
					} else {
						echo "<p>There are no reviews of this business right now!</p>";
					}
					echo "</div>";
				}

				echo "</div></div>";
			}
			else {
				echo "<div class='card'>No route with this id found!</div>";
			}

		?>
	</div>
</section>
<?php
	include_once 'footer.php'
?>