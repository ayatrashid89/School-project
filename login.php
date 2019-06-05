<?php
// Define variables used in the HTML header for this page.
$page = 'login';
$title = 'login up';
$description = 'Log in page';
$email = "";

// Display the header which uses the above variables.
include 'includes/header.php';
include './includes/function.php';

//If the user is already loogged in this will prevent the user from trying to log in again.
if ($userId != -1) {
    header("Location: index.php");
}
$isError = false;
$errormsg = "";
//Otherwise the user will be given a form to log into the system. The form will search the database to determine whether the user has an account or not.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $mdpass = md5($password);

    $SelectQueryString = "SELECT `password` FROM users_table WHERE email=?"; //
    $fetch = $dbConnection->prepare($SelectQueryString); //##########
    $fetch->execute(array($email)); //###########
    $fetch = $fetch->fetchAll(PDO::FETCH_ASSOC);
    if (empty($fetch)) {
        $isError = true;

    } else {
        if ($fetch[0]['password'] != $mdpass) {
            $isError = true;
        }

    }
    //If the user does not enter the correct login information they will receive an error message
    if ($isError) {
        $errormsg = '<p>The email or password do not match.</p>';
    } else {
        //If the login information is correct they will be redirected to the index page displaying the cookies instead of a sign up and login options.
        setcookie('email', $email, time() + (86400 * 30), "/");
        setcookie('password', $mdpass, time() + (86400 * 30), "/");
        header("Location: index.php");
    }
}
?>
<main class="login">
    <form method="POST">
        <h1>Log In</h1>
        <?php echo "$errormsg"; ?>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Email">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Password">
        <input type="submit" value="Log in">
        <p><a href="./signup.php">Not Registered?</a></p>
    </form>

</main>
<?php

// $email = $_POST['email'];

// echo "<pre>";
// var_dump($fetch);

// $pass = md5($_POST['password']);
// echo "Entered Password: $pass";
// echo "</pre>";
// Display the footer.
include 'includes/footer.php';

?>