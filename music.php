<?php
// Define variables used in the HTML header for this page.
$page = 'music';
$title = 'Musics';
$description = 'Musics page';

// Display the header which uses the above variables.
include 'includes/header.php';
include 'content/content.php';
?>
<main>
    <?php
//This will display a list of music from the content.php that users can select
$count = 1;
foreach ($music as $singer) {
    $count++;
    echo "<section class='music' id='music$count' >
				<span class='close'>&times;</span>
				<h2>music $count</h2>
				";
    echo "<aside>";
    foreach ($singer as $key => $value) {
        if ($key != 'img' && $key!='tracklist') {
            {
                $title = ucfirst($key);
                echo "<p>$title : $value</p>";
            }
		}
	}
		foreach ($singer as $key => $value) {
			if ($key ==='tracklist') {
				{
					$title = ucfirst($key);
					echo "<p>$title :</p> $value";
				}
			}
		
    }
    echo "</aside>";
    foreach ($singer as $key => $value) {

        if ($key === 'img') {
            echo "<img src='$value' alt='img$count'>";
        }

    }
    //If the user is logged in the will be able to make a purchase otherwise they will be asked to log in.
    if ($userId === -1) {
        echo "<p class='buyitnow'>Please <a href='./login.php'>Log in</a> to purchase!</p>";
    } else {
        echo "<p class='buyitnow'>Purchase feature is currently unavailable.</p>";
    }
    echo "</section>

				";
    foreach ($singer as $key => $value) {
        if ($key === 'img') {
            echo "<img src='$value' class='music-img' id='img$count' alt='img$count' onclick=\"toggle_visibility('music$count')\">";
        }
    }

}
?>
</main>
<?php
// Display the footer.
include 'includes/footer.php';
?>