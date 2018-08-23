<?php
	include_once 'header.php';
?>
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