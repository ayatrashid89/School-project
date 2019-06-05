<nav>

    <!--This will create a link that will bring users back to the index page from whatever page that they are currently on.-->
    <ul>
        <li><a href="./index.php">Home</a></li>

        <!--This will determine whether a visitor is logged in or not. After that it will determine whether the user is an employee or a customer-->
        <?php
$userId = isLoggedIn($dbConnection);
if ($userId != -1) {
    $Selectstr = "SELECT `first`, `last`, `isemployee` FROM users_table WHERE id=?"; //
    $fetch = $dbConnection->prepare($Selectstr); //##########
    $fetch->execute(array($userId)); //###########
    $fetch = $fetch->fetchAll(PDO::FETCH_ASSOC);
    $first = $fetch[0]['first'];
    $last = $fetch[0]['last'];
    $isemployee = $fetch[0]['isemployee'];

    if ($isemployee) {
        echo "<li><a href='./employee.php'>Hello $first $last</a>";
        echo "|<a href='./logout.php'>Log out</a></li>";
    } else {
        echo "<li><a href='./user.php'>Hello $first $last</a>";
        echo "|<a href='./logout.php'>Log out</a></li>";
    }
	//This will set and format the date and time if an employee is logged in to track the employee's login time
    $date = new DateTime();
    $date = $date->format('Y-m-d H:i:s');
    $selectDate = "SELECT `id`,`date` FROM last_visited WHERE id=?"; //
    $fetchDate = $dbConnection->prepare($selectDate); //##########
    $fetchDate->execute(array($userId)); //###########
    $fetchDate = $fetchDate->fetchAll(PDO::FETCH_ASSOC);
    if (empty($fetchDate)) {
        $instertNewDateQuery = "INSERT INTO last_visited (id,date) VALUES ('$userId','$date')";
        $dbConnection->exec($instertNewDateQuery);
    } else {
        $updateNewDateQuery = "UPDATE last_visited
        SET date='$date'
        WHERE id='$userId';
        ";
        $dbConnection->exec($updateNewDateQuery);

    }

} else {
    ?>
        <!--If the visitor is not logged in they will be given an option to create an account or log into an already existing account in the database.-->
        <li><a href="./signup.php">Sign Up</a>| <a href="./login.php">Log In</a></li>
        <?php }
?>
    </ul>
</nav>