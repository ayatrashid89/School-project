<?php

//These are the login information that will connect to the database.
$serverName = 'localhost';
$dbName = 'theStar';
$userName = 'ayatrashid';
$password = '1234Toto!@#$';
$dbConnection = null;

try {
	
	//This is how the form will connect to a database, catch if there is an error and then create a table.
    $dbConnection = new PDO("mysql:host=$serverName;dbname=$dbName", $userName, $password);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sqlCreateTable = "CREATE TABLE IF NOT EXISTS `users_table` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `email` varchar(320) NOT NULL,
        `password` longblob NOT NULL,
        `first` varchar(100) NOT NULL,
        `last` varchar(100) NOT NULL,
        `address` text NOT NULL,
        `city` varchar(60) NOT NULL,
        `state` varchar(30) NOT NULL,
        `zip` int(11) NOT NULL,
        `phonenumber` int(11) NOT NULL,
        `isemployee` tinyint(1) NOT NULL DEFAULT '0',
        PRIMARY KEY (`id`),
        UNIQUE KEY `email` (`email`)
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
    $execSQL = $dbConnection->exec($sqlCreateTable);
	
	//If the visitor is logged in the website will start to use the cookies to display information
    function isLoggedIn($dbConnection)
    {

        $id = -1;
        // create  $id = -1;
        if (isset($_COOKIE['email']) && isset($_COOKIE['password'])) {

            $email = $_COOKIE['email'];
            $password = $_COOKIE['password'];
            // check if the cookies are set
            $SelectQueryString = "SELECT `id`, `password` FROM users_table WHERE email=?"; //
            $fetch = $dbConnection->prepare($SelectQueryString); //##########
            $fetch->execute(array($email)); //###########
            $fetch = $fetch->fetchAll(PDO::FETCH_ASSOC);
            // query db by email and get id and password
            if ($fetch[0]['password'] === $password) {
                $id = $fetch[0]['id'];
            }
            // check if password on cookie and db passwrod match
            // $id = db id;
        }
        return $id;
    }

} catch (PDOException $errors) {
    print "Couldn't connect to the database" . $errors->getMessage();
}