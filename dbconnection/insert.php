<?php
 $sql = "INSERT IGNORE INTO users_table (username, email) 
 VALUES ('$name', '$email')";
 try {
   
 $dbConnection->exec($sql);
 $okay=true;
 

 }catch(PDOException $errors){
   print "Was unable to connect to the database".$errors->getMessage();

 } 

?>