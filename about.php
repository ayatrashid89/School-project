<?php
// Define variables used in the HTML header for this page.
$page = 'aboutme';
$title = 'About me';
$description = 'About me page';

// Display the header which uses the above variables.
include 'includes/header.php';
?>
<main class="about">

<!--This contains information about the group and the faux company The Star-->
    <aside>
        <h1>About Me</h1>
                <p>
            The Star website designed in 2018 by Ayat Rashid
            Located in the US, The Star provides my customers multimedia goods from around the world. My goal is to
            provide
            quality service, product satisfaction and a variety of
            goods to each of my customers.
        </p>
               <img src="images/me/ayat111.jpg" alt="Picture">
        <p>

            Contact Information

        </p>
        <p>
            Email: ayatrashid@students.highline.edu
        </p>
        <p>
            Phone Number: 206-209-6496
            <ul>
                <li>Customer Service ext. 1</li>
                <li>Delivery Questions ext. 2</li>
                <li>Product Request ext. 3</li>
            </ul>
        </p>
    </aside>
</main>
<?php
// Display the footer.
include 'includes/footer.php';
?>