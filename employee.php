<?php
// Define variables used in the HTML header for this page.
$page = 'user';
$title = 'User';
$description = 'Home page';

// Display the header which uses the above variables.
include './includes/header.php';
include './includes/function.php';
if ($userId === -1) {
    header("Location: index.php");
}
?>
<main class="employee-page">
    <!--If the user that is logged in is determined to be an employee, then the if statement will bring them to this page. It will display users that have created accounts.-->
    <?php
//This will display the employee/current user information
$selectuserinfo = "SELECT * FROM users_table WHERE id=?";
$fetch = $dbConnection->prepare($selectuserinfo);
$fetch->execute(array($userId));
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
echo "<h1>Hello $first $last (Employee)</h1>";
echo "<p>Your email : $email</p>";
echo "<p>Your address : $address</p>";
echo "<p>Your city : $city</p>";
echo "<p>Your state : $state</p>";
echo "<p>Your zip : $zip</p>";
echo "<p>Your phone : $phone</p>";

echo "</aside>";
?>
<!--If an employee needs to pull a specific user identity they will be able to find using this search bar.-->
    <form method="POST" action="employee.php">
        <h2>Search</h2>
        <p>Last Visited by User</p>
        <select name="search">
            <option value="id">Search by ID</option>
            <option value="email">Search by Email</option>
            <option value="first">Search by First Name</option>
            <option value="last">Search by Last Name</option>
            <option value="city">Search by City</option>
            <option value="state">Search by State</option>
            <option value="phonenumber">Search by Phone Number</option>
        </select>
        <input type="text" name="searchvalue" required />
        <input type="submit" value="Search">
    </form>
    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search = cleanUpString($_POST['search']);
    $searchValue = cleanUpString($_POST['searchvalue']);
    $selectInnerJoin = "SELECT * FROM users_table INNER JOIN last_visited
    ON users_table.id = last_visited.id WHERE users_table.$search=?";
    $fetch = $dbConnection->prepare($selectInnerJoin);
    $fetch->execute(array($searchValue));
    $fetch = $fetch->fetchAll(PDO::FETCH_ASSOC);
    if (empty($fetch)) {
        echo "<h2>No information found under $search = $searchValue</h2>";
		// Display the footer.
		include './includes/footer.php';
    } else {
        echo "<div>";
        echo "<table>";
        echo "<caption><h2>Search Result By $search = $searchValue</h2></caption>";
        echo "<tr>
        <th>Id</th>
        <th>Email</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>City</th>
        <th>State</th>
        <th>Phone Number</th>
        <th>Last Visited date</th>
     </tr>";
        foreach ($fetch as $table) {
            echo "<tr>";
            foreach ($table as $key => $value) {
                if ($key != 'password' && $key != 'isemployee' && $key != 'zip' && $key != 'address') {
                    echo "<td>$value</td>";
                }

            }
            echo "</tr>";

        }
        echo "</table>";
        echo "</div>";
		// Display the footer.
		include './includes/footer.php';
    }

    ?>
    <script>
        window.onload = function() {
            history.replaceState("", "", "employee.php");
        }
    </script>
 <?php
 exit;  }
 ?>   
  





    <?php
//This will display a table with user information
$selectusers = "SELECT * FROM users_table WHERE isemployee=false";
$userFetchData = $dbConnection->query($selectusers);
$userFetchData = $userFetchData->fetchAll(PDO::FETCH_ASSOC);
echo "<div>";
echo "<table>";
echo "<caption><h2>All Users List</h2></caption>";
echo "<tr>
        <th>Id</th>
        <th>Email</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Address</th>
        <th>City</th>
        <th>State</th>
        <th>Zip Code</th>
        <th>Phone Number</th>
     </tr>";
foreach ($userFetchData as $table) {
    echo "<tr>";
    foreach ($table as $key => $value) {
        if ($key != 'password' && $key != 'isemployee') {
            echo "<td>$value</td>";
        }

    }
    echo "</tr>";

}
echo "</table>";
echo "</div>";
?>
</main>

<?php
// Display the footer.
include './includes/footer.php';
?>