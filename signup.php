<?php
// Define variables used in the HTML header for this page.
$page = 'signup';
$title = 'Sign up';
$description = 'Sign up page';

// Display the header which uses the above variables.
include 'includes/header.php';
include './includes/function.php';
if ($userId != -1) {
    header("Location: index.php");
}
?>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$good = false; //switches form to result of the form
$isError = false; // checks error
$first = $last = $password = $confirmPassword = $email = $phone = $address = $city = $state = $zipcode = ""; // assign empty value for inputs
$errFirst = $errLast = $errPassword = $errEmail = $errPhone = $errAddress = $errCity = $errState = $errConPass = $errZip = ""; // assign empty value for errors
$exemail = "";
//This is a form that users can use to register to the website. The form uses a stickey on every entry except for the password to ensure that users are secure.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isValidEmail($_POST['email'])) {
        $errEmail = "Please input valid email";
        $isError = true;
    } else { $email = $_POST['email'];
        $SelectQueryString = "SELECT `id` FROM users_table WHERE email=?"; //
        $fetch = $dbConnection->prepare($SelectQueryString); //##########
        $fetch->execute(array($email)); //###########
        $fetch = $fetch->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($fetch)) {
            $isError = true;
            $exemail = "<p>Email is already taken</p>";
        }
    }
    if (!isValidPassword($_POST['password'])) {
        $errPassword = "Please enter 6 or more characters";
        $isError = true;
    } else {
        $password = $_POST['password'];
    }
    if ($password != $_POST['confirmpass']) {
        $password = "";
        $errConPass = "Confirm your Password";
        $isError = true;
    }
    if (empty(cleanUpString($_POST['address']))) {
        $errAddress = "Please enter your address";
        $isError = true;
    } else {
        $address = cleanUpString($_POST['address']);
    }
    if (empty(cleanUpString($_POST['city']))) {
        $errCity = "Enter the City";
        $isError = true;
    } else {
        $city = cleanUpString($_POST['city']);
    }
    if (empty(isValidZip($_POST['zipcode']))) {
        $errZip = "Please enter valid zip";
        $isError = true;
    } else {
        $zipcode = $_POST['zipcode'];
    }
    if (empty($_POST['states'])) {
        $errState = "Select the state please";
        $isError = true;
    } else {
        $state = $_POST['states'];
    }
    if (empty(cleanUpString($_POST['first']))) { //checks first name with functions
        $errFirst = "Please input your first name";
        $isError = true;
    } else {
        $first = cleanUpString($_POST['first']);
    }

    if (empty(cleanUpString($_POST['last']))) { //checks last name with functions
        $errLast = "Please input your last name";
        $isError = true;
    } else {
        $last = cleanUpString($_POST['last']);
    }

    if (!isValidPhone($_POST['phone'])) { //checks the phone  with functions
        $errPhone = "Input 10 digit phone numbers";
        $isError = true;
    } else {if ($isError) {
        $phone = $_POST['phone'];

    } else { $phone = $_POST['phone'];}
    }

    if ($isError) { // if there is error it will show the form itself.
        $good = false;
    } else { //if there is no any errors, it will display result of the submission.
        $good = true;
    }
}
?>
<main class="register">

    <?php if ($good) {
    try {
        $mdpass = md5($password);
        $sql = "INSERT IGNORE INTO users_table (email,password,first,last,address,city,state,zip,phonenumber) VALUES ('$email','$mdpass','$first','$last','$address','$city','$state','$zipcode','$phone')";
        $dbConnection->exec($sql);
        setcookie('email', $email, time() + (86400 * 30), "/");
        setcookie('password', $mdpass, time() + (86400 * 30), "/");
        header("Location: index.php");

    } catch (PDOException $errors) {
        print "Couldn't connect to the database" . $errors->getMessage();

    }
    ?>
    <?php } else { //it will show the form to submit corectly.
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <h1>Sign Up</h1>
        <?php echo "$exemail"; ?>
        <label for="email">Email
            <?php echo "<span>* $errEmail</span>"; ?></label>
        <input type="email" name="email" placeholder="Email" value="<?php echo $email; ?>" id="email">

        <label for="pass">Password
            <?php echo "<span>* $errPassword</span>"; ?></label>
        <input type="password" name="password" id="pass" placeholder="Password">

        <label for="conpass">Confirm password
            <?php echo "<span>* $errConPass</span>"; ?></label>
        <input type="password" name="confirmpass" id="conpass" placeholder="Confirm Password">

        <label for="first">First name
            <?php echo "<span>* $errFirst</span>"; ?></label>
        <input type="text" name="first" placeholder="First Name" value="<?php echo $first; ?>" id="first">

        <label>Last name
            <?php echo "<span>* $errLast</span>"; ?></label>
        <input type="text" name="last" placeholder="Last Name" value="<?php echo $last; ?>">

        <label for="address">Address
            <?php echo "<span>* $errAddress</span>"; ?></label>
        <input type="text" name="address" placeholder="Address" value="<?php echo $address; ?>" id="address">

        <label for="city">City
            <?php echo "<span>* $errCity</span>"; ?></label>
        <input type="text" name="city" placeholder="City" value="<?php echo $city; ?>" id="city">
        <label for="state">States
            <?php echo "<span>* $errState</span>"; ?></label>
        <select name="states" id="state">
            <?php
//      foreach ($states as $value) {
    //     if ($_POST['states']){
    //         echo"<option value='$state'>$value</option>";
    //     }else{

    //             echo "<option value='$value'>$value</option>";
    //     }
    // }
    foreach ($states as $state1) {
        if (isset($_POST['states']) && $_POST['states'] === $state1) {
            echo "<option value='" . $state1 . "' selected >" . $state1 . "</option>";
        } else {
            echo "<option value='" . $state1 . "'>" . $state1 . "</option>";
        }
    }

    ?>

        </select>
        <label for="zip">Zip Code
            <?php echo "<span>* $errZip</span>"; ?></label>
        <input type="text" name="zipcode" id="zip" placeholder="Zip Code" value="<?php echo $zipcode; ?>">

        <label for="phone">Enter phone number
            <?php echo "<span>* $errPhone</span>"; ?></label>
        <input type="text" name="phone" id="phone" placeholder="(xxx)xxx-xxxx" value="<?php echo $phone; ?>" />


        <input type="submit" value="Register">
        <p><a href="./login.php">Already have an Account?</a></p>

    </form>

    <?php }?>
</main>
<?php
// Display the footer.
include 'includes/footer.php';
?>