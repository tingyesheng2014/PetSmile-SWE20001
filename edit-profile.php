<!DOCTYPE html>
<html lang="en">

<?php
include 'config.php';
include 'header.php';

if (isset($_POST['update'])) {
    $Cust_ID = $_SESSION['Cust_ID'];
    $First_Name = $_POST['firstname'];
    $Last_Name = $_POST['lastname'];
    $Phone_No = $_POST['phoneno'];
    $Address = $_POST['address'];
    $City = $_POST['city'];
    $Postcode = $_POST['postcode'];
    $Email = $_POST['email'];

    $updateUserQuery = "UPDATE member SET First_Name='$First_Name', Last_Name='$Last_Name', Phone_No='$Phone_No', Address='$Address', City='$City', Postcode='$Postcode', Email='$Email' WHERE Cust_ID='$Cust_ID'";

    if (mysqli_query($con, $updateUserQuery)) {
        echo '<div class="alert alert-success"><strong>Profile updated successfully!</strong></div>';
    } else {
        echo '<div class="alert alert-danger"><strong>Profile update failed!</strong> Please try again later.</div>';
    }
}

$Cust_ID = $_SESSION['Cust_ID'];
$selectUserQuery = "SELECT * FROM member WHERE Cust_ID='$Cust_ID'";
$userResult = mysqli_query($con, $selectUserQuery);
$userData = mysqli_fetch_assoc($userResult);
?>

    <!-- Carousel Start -->
    <form method="POST" action="edit-profile.php">
    <h2>Edit Profile</h2>

    <!-- Customer Details -->

    <div>
        <label for="custid">Customer ID:</label>
        <input type="text" name="custid" id="custid" value="<?php echo $userData['Cust_ID']; ?>" required readonly>
    </div>

    <div>
        <label for="firstname">First Name:</label>
        <input type="text" name="firstname" id="firstname" value="<?php echo $userData['First_Name']; ?>" required>
    </div>

    <div>
        <label for="lastname">Last Name:</label>
        <input type="text" name="lastname" id="lastname" value="<?php echo $userData['Last_Name']; ?>" required>
    </div>

    <div>
        <label for="phoneno">Phone Number:</label>
        <input type="tel" name="phoneno" id="phoneno" value="<?php echo $userData['Phone_No']; ?>" required>
    </div>

    <div>
        <label for="address">Address:</label>
        <input type="text" name="address" id="address" value="<?php echo $userData['Address']; ?>" required>
    </div>

    <div>
        <label for="city">City:</label>
        <input type="text" name="city" id="city" value="<?php echo $userData['City']; ?>" required>
    </div>

    <div>
        <label for="postcode">Postcode:</label>
        <input type="text" name="postcode" id="postcode" value="<?php echo $userData['Postcode']; ?>" required>
    </div>

    <div>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $userData['Email']; ?>" required>
    </div>

    <div>
    <input type="submit" name="update" value="Update Profile">
    </div>

    </form>

    <a href="edit-petprofile.php" class="btn btn-lg btn-primary px-3 mt-3">Go to Pet Profile</a>

    <a href="logout.php" class="btn btn-primary btn-sm">Logout</a>
    <!-- Carousel End -->

    <?php
    include 'footer.php';
    ?>

</html>
