<?php
	include_once 'header.php';
?>

<section class="business-container">
	<h1>Business Page</h1>

	<div class="main-container">
		<?php
		
			$title = mysqli_real_escape_string($conn, $_GET['name']);
			$business_id = mysqli_real_escape_string($conn, $_GET['business_id']);

			$sql_business = "SELECT * FROM businesses WHERE business_id='$business_id'";
			$result_business = mysqli_query($conn, $sql_business);

			$businessQueryResults = mysqli_num_rows($result_business);

			//businesses
			//business_id business_name business_description business_address business_type business_latitude business_longitude business_rating

			// Check the query has any results first
			if ($businessQueryResults > 0) {
				while ($row = mysqli_fetch_assoc($result_business)) {
					echo "
					<div class='business-box'>
						<h2>".$row['business_name']."</h2>
						<h2>".$row['business_description']."</h2>
						<p>".$row['business_address']."</p>
						<p>".$row['business_type']."</p>
						<p>Rating ".$row['business_rating']."</p>
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
			if (isset($_SESSION['checkedin'])) {
				if ($_SESSION['checkedin'] == $business_id) {
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
           			echo $_SESSION['checkedin'];

				} else {
					echo "You are checked into another business. Would you like to check into this one instead? 
					<form action=\"includes/checkin.inc.php\" method=\"GET\">
					<input type=\"hidden\" name=\"name\" value=\"".$title."\">
					<input type=\"hidden\" name=\"business_id\" value=\"".$business_id."\"> 
					<input type=\"submit\" name=\"submit\" value=\"Check in\">
					</form>";
				}
			} else {
				echo "You are not checked into another business. Would you like to check into this one instead?
					<form action=\"includes/checkin.inc.php\" method=\"GET\">
					<input type=\"hidden\" name=\"name\" value=\"".$title."\">
					<input type=\"hidden\" name=\"business_id\" value=\"".$business_id."\"> 
					<input type=\"submit\" name=\"submit\" value=\"Check in\">
					</form>";
			}
			echo $_SESSION['checkedin'];
			echo $_SESSION['u_id'];
		?>
	</div>
</div>
</section>
<?php
	include_once 'footer.php'
?>