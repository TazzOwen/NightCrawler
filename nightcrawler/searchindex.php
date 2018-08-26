<?php
	include_once 'header.php';
?>

<!-- Just a basic search page for now. The map feature has not been integrated into the search, but when it does,
this will be the place to ask for a geolocation from the user-->

<div class="main-container">
<div class="centercolumn">
<form action="search.php" method="POST">
	<input type="text" name="search" placeholder="Search">
	<input type="radio" name="searchtype" value="business">Search businesses<br>
  	<input type="radio" name="searchtype" value="routes" checked>Search routes<br>
	<button type="submit" name="submit-search">Search</button>
</form>
</div>
</div>
<?php
	include_once 'footer.php'
?>