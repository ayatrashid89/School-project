<?php
// Define variables used in the HTML header for this page.
$page = 'user';
$title = 'User';
$description = 'Home page';

// Display the header which uses the above variables.
include './includes/header.php';
if ($userId === -1) {
    header("Location: index.php");
}
?>
<main class="user-page">
<!--If the user is determined to be a customer at the login page then the user will be brought to this page. It will only display their own user information and nothing else.-->
    <?php
$selectuserinfo = "SELECT * FROM users_table WHERE id=?";
$fetch = $dbConnection->prepare($selectuserinfo); //##########
$fetch->execute(array($userId)); //###########
$fetch = $fetch->fetchAll(PDO::FETCH_ASSOC);
$email = $fetch[0]['email'];
$first = $fetch[0]['first'];
$last = $fetch[0]['last'];
$address = $fetch[0]['address'];
$city = $fetch[0]['city'];
$state = $fetch[0]['state'];
$zip = $fetch[0]['zip'];
$phone = $fetch[0]['phonenumber'];
echo "<aside>";
echo "<h1>Hello $first $last</h1>";
echo "<p>Your email : $email</p>";
echo "<p>Your address : $address</p>";
echo "<p>Your city : $city</p>";
echo "<p>Your state : $state</p>";
echo "<p>Your zip : $zip</p>";
echo "<p>Your phone : $phone</p>";

echo "</aside>";
?>

</main>
<?php
// Display the footer.
include './includes/footer.php';