<?php
       // Define variables used in the HTML header for this page.
       $page='book';
       $title = 'Books' ;
       $description = 'Books page' ;

       // Display the header which uses the above variables.
       include 'includes/header.php' ;
	   include 'content/content.php';
   ?>
   <main>
   <?php
    $count=1;
	//This echo the list of available books on the websites selection
    foreach ($books  as $readings){
        $count++;
            echo"<section class='book' id='book$count' >
            <span class='close'>&times;</span>
            <h2>book $count</h2>
            ";
            echo"<aside>";
            foreach ($readings as $key =>$value){
                    if($key!='img'){
                        $title=ucfirst($key);
                        echo"<p>$title : $value</p>";
                    }
                   
                
            }
            echo"</aside>";
            foreach ($readings as $key =>$value){
                
                    if($key === 'img') {
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
            foreach ($readings as $key =>$value){
                if($key === 'img') {
                    echo "<img src='$value' class='book-img' id='img$count' alt='img$count' onclick=\"toggle_visibility('book$count')\">";
                }
            }


  
    }
?>
   </main>
   <?php
       // Display the footer.
       include 'includes/footer.php' ;
   ?>

