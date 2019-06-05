<?php
// Define variables used in the HTML header for this page.
$page = 'magazine';
$title = 'Magazine';
$description = 'Magazine page';

// Display the header which uses the above variables.
include 'includes/header.php';
include 'content/content.php';
?>
<main>
    <?php
//This will display a list of available magazines on The Star website.
$count = 1;
foreach ($magazines as $cover) {
    $count++;
    echo "<section class='magazine' id='magazine$count' >
            <span class='close'>&times;</span>
            <h2>magazine $count</h2>
            ";
    echo "<aside>";
    foreach ($cover as $key => $value) {
        if ($key != 'img') {
            $title = ucfirst($key);
            echo "<p>$title : $value</p>";
        }
    }
    echo "</aside>";
    foreach ($cover as $key => $value) {

        if ($key === 'img') {
            echo "<img src='$value' alt='img$count'>";
        }

    }
    //If the user is logged in the will be able to make a purchase otherwise they will be asked to log in.
    if ($userId === -1) {
        echo "<p class='buyitnow'>Please <a href='./login.php'>Log in</a> to purchase!</p>";
    } else {
        echo "<p class='buyitnow'>Purchase feature is currently unavailble.</p>";
    }

    echo "</section>

            ";
    foreach ($cover as $key => $value) {
        if ($key === 'img') {
            echo "<img src='$value' class='magazine-img' id='img$count' alt='img$count' onclick=\"toggle_visibility('magazine$count')\">";
        }
    }

}
?>
</main>
<?php
// Display the footer.
include 'includes/footer.php';
?>