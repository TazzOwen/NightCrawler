<?php
	include 'header.php';
?>
<section class="main-container">
<h1>Search page</h1>

<div class="business-container">
<?php
	//businesses
		//business_id business_name business_description business_address business_type business_latitude business_longitude business_rating
	if (isset($_POST['submit-search'])) {
		$search = mysqli_real_escape_string($conn, $_POST['search']);
		if ($_POST['searchtype'] == 'business') {
			$sql = "SELECT * FROM businesses WHERE business_name LIKE '%$search%' OR business_description LIKE '%$search%' OR business_address LIKE '%$search%' OR business_type LIKE '%$search%'";
			$result = mysqli_query($conn, $sql);
			$queryResult = mysqli_num_rows($result);

			echo "There are ".$queryResult." results!";

			if ($queryResult > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					echo "<div class='card'>
					<a href='business.php?name=".$row['business_name']."&business_id=".$row['business_id']."'>
						<h2>".$row['business_name']."</h2></a>
						<p><em>".$row['business_address']."</em></p>
						<p><b>".$row['business_description']."</b></p>
						<p>Type: ".$row['business_type']."</p>
						<p>Rating: ".$row['business_rating']."</p>
					</div>";
				}
			} else {
				echo "There are no results matching your search!";
			}
		}
		if ($_POST['searchtype'] == 'routes') {
			$sql = "SELECT * FROM routes WHERE route_name LIKE '%$search%' OR route_description LIKE '%$search%' OR route_stops LIKE '%$search%' OR route_type LIKE '%$search%'";
			$result = mysqli_query($conn, $sql);
			$queryResult = mysqli_num_rows($result);

			echo "There are ".$queryResult." results!";

			if ($queryResult > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					echo "<div class='card'>
					<a href='route.php?route_id=".$row['route_id']."'>
						<h2>".$row['route_name']."</h2></a>
						<p><em>".$row['route_description']."</em></p>
						<p><b>Number of stops: ".count(explode(",",$row['route_stops']))."</b></p>
						<p>Type: ".$row['route_type']."</p>
						<p>Rating: ".$row['route_rating']."</p>
					</div>";
				}
			} else {
				echo "There are no results matching your search!";
			}
		}
	}
?>
</div>
</section>