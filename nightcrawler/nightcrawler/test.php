<?php
include_once "includes/dbh.inc.php";

$reviewSql = "SELECT * FROM routereviews INNER JOIN routes WHERE routereviews.routeReview_uid='1' AND routes.route_uid='1'";

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
?>