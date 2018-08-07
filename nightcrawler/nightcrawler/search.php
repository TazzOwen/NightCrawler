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
		$sql = "SELECT * FROM businesses WHERE business_name LIKE '%$search%' OR business_description LIKE '%$search%' OR business_address LIKE '%$search%' OR business_type LIKE '%$search%'";
		$result = mysqli_query($conn, $sql);
		$queryResult = mysqli_num_rows($result);

		echo "There are ".$queryResult." results!";

		if ($queryResult > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				echo "
				<a href='business.php?name=".$row['business_name']."&business_id=".$row['business_id']."'><div class='business-box'>
					<h2>".$row['business_name']."</h2>
					<h2>".$row['business_description']."</h2>
					<p>".$row['business_address']."</p>
					<p>".$row['business_type']."</p>
					<p>".$row['business_latitude']."</p>
					<p>".$row['business_longitude']."</p>
					<p>".$row['business_rating']."</p>
				</div></a>";
			}
		} else {
			echo "There are no results matching your search!";
		}
	}
?>
</div>
</section>