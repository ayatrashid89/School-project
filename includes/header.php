<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?php echo $title; ?>
    </title>
    <meta name="description" content="<?php echo $description; ?>">
    <meta name="author" content="">

    <!-- link to external CSS file -->

    <link rel="stylesheet" href="css/style.css?v=1.0" type="text/css">
</head>

<body>
    <header>
        <h1>The Star</h1>
        <?php
			//This sets the timezone to PST and help determine when users last visited the site.		
			date_default_timezone_set('America/Los_Angeles');

			//This links the database connection to the webpages
			include './dbconnection/dbconnection.php';
			?>
        <a href="./index.php" class="logo"><img src="./images/thestarlogo/thestar.png" alt="star logo"></a>

        <!--This links the nav.php to the website's header-->
        <?php include './includes/nav.php';
?>



    </header>
    <video autoplay muted loop id="myVideo" poster="http://bbotiroff.me/video/Modem-lights.jpg">
        <source src="http://bbotiroff.me/video/Modem-lights.mp4" type="video/mp4">
        <source src="http://bbotiroff.me/video/Modem-lights.webm" type="video/webm">
    </video>