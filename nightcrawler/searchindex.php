<?php
	include_once 'header.php';
?>
<div class="business-container">
	<?php
		$sql = "SELECT * FROM businesses";
		$result = mysqli_query($conn, $sql);
		$queryResults = mysqli_num_rows($result);

		//businesses
		//business_id business_name business_description business_address business_type business_latitude business_longitude business_rating

		// Check the query has any results first
		if ($queryResults > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				echo "
				<div class='business-box'>
					<h2>".$row['business_name']."</h2>
					<h2>".$row['business_description']."</h2>
					<p>".$row['business_address']."</p>
					<p>".$row['business_type']."</p>
					<p>".$row['business_latitude']."</p>
					<p>".$row['business_longitude']."</p>
					<p>".$row['business_rating']."</p>
				</div>";
			}
		}
	?>
</div>
	
<form action="search.php" method="POST">
	<input type="text" name="search" placeholder="Search">
	<button type="submit" name="submit-search">Search</button>
</form>

<?php
	include_once 'footer.php'
?>