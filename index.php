<?php
       // Define variables used in the HTML header for this page.
       $page='index';
       $title = 'Home' ;
       $description = 'Home page' ;

       // Display the header which uses the above variables.
       include 'includes/header.php' ;
   ?>

<main class="homemain">
	<!--This connects to the music page-->
    <a href="./music.php" class="media">
        <section>
            <h2>Musics</h2>
        </section>
    </a>
	<!--This will connect to the movies content page-->
    <a href="./movies.php" class="media">
        <section>
            <h2>Movies</h2>
        </section>
    </a>
	<!--This will connect to the books content page-->
    <a href="./books.php" class="media">
        <section>
            <h2>Books</h2>
        </section>
    </a>
	<!--This will connect to the magazine content page-->
    <a href="./magazine.php" class="media">
        <section>
            <h2>Magazines</h2>
        </section>
    </a>
</main>


<?php
       // Display the footer.
       include 'includes/footer.php' ;
   ?>