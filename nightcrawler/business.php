<?php
	include_once 'header.php';
?>

<section class="business-container">
	<div class="card">
	<div class="main-container">
		
		<?php
			// TITLE //
			// Gets the business name and id from the url for easy access
			$title = mysqli_real_escape_string($conn, $_GET['name']);
			$business_id = mysqli_real_escape_string($conn, $_GET['business_id']);

			$sql_business = "SELECT * FROM businesses WHERE business_id='$business_id'";
			$result_business = mysqli_query($conn, $sql_business);

			$businessQueryResults = mysqli_num_rows($result_business);

			//From the database - businesses
			//business_id business_name business_description business_address business_type business_latitude business_longitude business_rating

			// Check the query has any results first
			if ($businessQueryResults > 0) {
				while ($row = mysqli_fetch_assoc($result_business)) {
					echo "
					<div class='business-box'>
						<h1>".$row['business_name']."</h1>
						<h2>".$row['business_description']."</h2>
						<p>".$row['business_address']."</p>
						<p>".$row['business_type']."</p>
						<p>Rating ".$row['business_rating']."</p>
					</div>";
					$followcheck = explode(",",$row['business_followers']);
					if (in_array($_SESSION['u_id'], $followcheck)) {
						echo "<button type=\"button\" disabled>You follow this business already</button>";
					}
					else {
						echo "<form action=\"includes/followbusiness.inc.php\" method=\"POST\">
						<input type=\"hidden\" name=\"business_id\" value=\"".$business_id."\">
						<input type=\"hidden\" name=\"business_name\" value=\"".$title."\"> 
						<button type=\"submit\" name=\"submit\">Follow this business</button>
						</form>";
					}
				}
			}
			echo "</div>
				<div>";

			// Lists all the reviews for the business.
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
			// To write a review the user has to check in first.
			if (isset($_SESSION['checkedin'])) {
				if ($_SESSION['checkedin'] == $business_id) {
					echo "<b>You are checked in. Tell others what you think of this business!</b>";
					echo "<form action=\"includes/businessreview.inc.php\" method=\"POST\">
					Rating:
					<input type=\"number\" id=\"rating\" name=\"rating\"
           				placeholder=\"Min: 1, max: 5\" min=\"1\" max=\"5\" step=\"1\"/></input>
           			Review:
           			<input type=\"text\" id=\"review\" name=\"review\" 
           				placeholder=\"Write a short review of this business if you want\"></input>
           			<input type=\"submit\" name=\"submit\" value=\"Submit\">
           			</form>";

				} else {
					echo "<b>You are checked into another business. Would you like to check into this one instead? </b>
					<form action=\"includes/checkin.inc.php\" method=\"GET\">
					<input type=\"hidden\" name=\"name\" value=\"".$title."\">
					<input type=\"hidden\" name=\"business_id\" value=\"".$business_id."\"> 
					<input type=\"submit\" name=\"submit\" value=\"Check in\">
					</form>";
				}
			} else {
				echo "<b>You are not checked into another business. Would you like to check into this one instead? </b>
					<form action=\"includes/checkin.inc.php\" method=\"GET\">
					<input type=\"hidden\" name=\"name\" value=\"".$title."\">
					<input type=\"hidden\" name=\"business_id\" value=\"".$business_id."\"> 
					<input type=\"submit\" name=\"submit\" value=\"Check in\">
					</form>";
			}
		?>
	</div>
	</div>
</div>
</section>
<?php
	include_once 'footer.php'
?>