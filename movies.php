<?php
// Define variables used in the HTML header for this page.
$page = 'movies';
$title = 'Movies';
$description = 'Movies page';

// Display the header which uses the above variables.
include 'includes/header.php';
include 'content/content.php';
?>
<main>
    <?php
	//This will display a list of movies that users can view and purchase if they are logged in.
	$count = 1;
	foreach ($movies as $rate) {
		$count++;
		echo "<section class='movie' id='movie$count' >
				<span class='close'>&times;</span>
				<h2>Movie $count</h2>
				";
		echo "<aside>";
		foreach ($rate as $key => $value) {
			if ($key != "img") {
				$title = ucfirst($key);
				echo "<p>$title : $value</p>";
			}
		}
		echo "</aside>";
		foreach ($rate as $key => $value) {

			if ($key === 'img') {
				echo "<img src='$value' alt='img$count'>";
			}

		}
		//If the user is logged in the will be able to make a purchase otherwise they will be asked to log in.
		if ($userId === -1) {
			echo"<p class='buyitnow'>Please <a href='./login.php'>Log in</a> to purchase!</p>";
		 }else{
			 echo"<p class='buyitnow'>Purchase feature is currently unavailable.</p>";
		 }

		echo "</section>

				";
		foreach ($rate as $key => $value) {
			if ($key === 'img') {
				echo "<img src='$value' class='movie-img' id='img$count' alt='img$count' onclick=\"toggle_visibility('movie$count')\">";
			}
		}

	}
?>
</main>
<?php
// Display the footer.
include 'includes/footer.php';
?>