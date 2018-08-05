<?php
	include_once 'header.php';
?>
<section class="main-container">
	<div class="main-wrapper">
		<h2>Home</h2>
		<?php
			if (isset($_SESSION['u_uid'])) {
				echo "You are logged in!";
			}
			else {
				echo "<form action=\"includes/login.inc.php\" method=\"POST\">
									<input type=\"text\" name=\"uid\" placeholder=\"Username/mail\">
									<input type=\"password\" name=\"pwd\" placeholder=\"password\">
									<button type=\"submit\" name=\"submit\">Login</button>
								</form>
					<!--Trigger/Open The Modal*/-->
					<link rel=\"stylesheet\" type=\"text/css\" href=\"modal.css\">
					<button id=\"myBtn\">Sign Up</button>

					<!-- The Modal -->
					<div id=\"myModal\" class=\"modal\">

				  	<!-- Modal content -->
				  	<div class=\"modal-content\">
				    	<span class=\"close\">&times;</span>";
				    	include "signup.php";
				echo "
				  	</div>

				</div>";
			}
		?>
	</div>
	
</section>

<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

<?php
	include_once 'footer.php'
?>